<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Medicine;
use App\Models\ProductReturn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class ProductReturnController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => ['required', 'in:customer,company'],
            'medicine_id' => ['required', 'exists:medicines,id'],
            'quantity' => ['required', 'integer', 'min:1'],
            'returned_at' => ['required', 'date', 'before_or_equal:today'],
            'customer_id' => ['required_if:type,customer', 'nullable', 'exists:customers,id'],
            'company_name' => ['required_if:type,company', 'nullable', 'string', 'max:255'],
        ]);

        DB::transaction(function () use ($validated) {
            $medicine = Medicine::query()
                ->whereKey($validated['medicine_id'])
                ->lockForUpdate()
                ->firstOrFail();
            $quantity = (int) $validated['quantity'];
            $customer = null;
            $companyName = null;

            if ($validated['type'] === 'customer') {
                $customer = Customer::query()->findOrFail($validated['customer_id']);
            } else {
                $companyName = trim($validated['company_name']);
            }

            if ($medicine->stock < $quantity) {
                throw ValidationException::withMessages([
                    'quantity' => ["Only {$medicine->stock} units of {$medicine->name} are currently in stock."],
                ]);
            }

            $medicine->decrement('stock', $quantity);

            ProductReturn::create([
                'type' => $validated['type'],
                'medicine_id' => $medicine->id,
                'medicine_name' => $medicine->name,
                'quantity' => $quantity,
                'customer_id' => $customer?->id,
                'customer_name' => $customer?->name,
                'company_name' => $companyName,
                'returned_at' => $validated['returned_at'],
            ]);
        });

        return redirect()
            ->route('dashboard')
            ->with('success', 'Product return recorded successfully.');
    }
}
