<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Medicine;
use App\Models\Sale;
use App\Models\SaleItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class SaleController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => ['nullable', 'exists:customers,id'],
            'items' => ['required', 'array', 'min:1'],
            'items.*.medicine_id' => ['required', 'exists:medicines,id'],
            'items.*.quantity' => ['required', 'integer', 'min:1'],
            'paid' => ['required', 'numeric', 'min:0'],
            'discount' => ['required', 'numeric', 'min:0'],
        ]);

        try {
            $sale = DB::transaction(function () use ($validated) {
                $customer = null;

                if (! empty($validated['customer_id'])) {
                    $customer = Customer::query()
                        ->lockForUpdate()
                        ->findOrFail($validated['customer_id']);
                }

                $lineItems = [];
                $total = 0;

                foreach ($validated['items'] as $item) {
                    $medicine = Medicine::query()
                        ->whereKey($item['medicine_id'])
                        ->where('is_active', true)
                        ->lockForUpdate()
                        ->first();

                    if (! $medicine) {
                        throw ValidationException::withMessages([
                            'items' => ['One or more medicines are invalid or inactive.'],
                        ]);
                    }

                    if ($medicine->stock < $item['quantity']) {
                        throw ValidationException::withMessages([
                            'items' => ["{$medicine->name} does not have enough stock."],
                        ]);
                    }

                    $price = (float) $medicine->sell_price;
                    $quantity = (int) $item['quantity'];
                    $total += $price * $quantity;

                    $lineItems[] = [
                        'medicine' => $medicine,
                        'medicine_name' => $medicine->name,
                        'price' => $price,
                        'quantity' => $quantity,
                    ];
                }

                $sub_total = round($total, 2);
                $discount= round((float) $validated['discount'], 2);
                $total = round($sub_total - $discount, 2);
                $paid = round((float) $validated['paid'], 2);

                if ($paid > $total) {
                    throw ValidationException::withMessages([
                        'paid' => ['Paid amount cannot be greater than total amount.'],
                    ]);
                }

                $due = round($total - $paid, 2);

                if ($due > 0 && ! $customer) {
                    throw ValidationException::withMessages([
                        'customer_id' => ['Customer is required when sale has due.'],
                    ]);
                }

                $sale = Sale::create([
                    'customer_id' => $customer?->id,
                    'total' => $total,
                    'paid' => $paid,
                    'due' => $due,
                    'discount' => $discount,
                    'invoice_no' => $this->generateInvoiceNo(),
                ]);

                foreach ($lineItems as $lineItem) {
                    $lineItem['medicine']->decrement('stock', $lineItem['quantity']);

                    SaleItem::create([
                        'sale_id' => $sale->id,
                        'medicine_name' => $lineItem['medicine_name'],
                        'price' => $lineItem['price'],
                        'quantity' => $lineItem['quantity'],
                    ]);
                }

                if ($customer && $due > 0) {
                    $customer->increment('total_due', $due);
                }

                return $sale->load(['items', 'customer']);
            });

            return response()->json([
                'message' => 'Sale completed successfully.',
                'sale_id' => $sale->id,
                'invoice_no' => $sale->invoice_no,
                'redirect_url' => route('invoice.show', $sale),
            ]);
        } catch (ValidationException $exception) {
            throw $exception;
        } catch (\Throwable $exception) {
            return response()->json([
                'message' => 'Sale could not be completed.',
                'error' => $exception->getMessage(),
            ], 500);
        }
    }

    private function generateInvoiceNo(): string
    {
        $date = now()->format('Ymd');
        $prefix = "INV-{$date}-";

        $latestForToday = Sale::query()
            ->where('invoice_no', 'like', $prefix . '%')
            ->latest('id')
            ->value('invoice_no');

        $nextNumber = 1;

        if ($latestForToday) {
            $parts = explode('-', $latestForToday);
            $nextNumber = ((int) end($parts)) + 1;
        }

        return $prefix . str_pad((string) $nextNumber, 4, '0', STR_PAD_LEFT);
    }
}
