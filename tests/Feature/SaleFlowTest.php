<?php

namespace Tests\Feature;

use App\Models\Customer;
use App\Models\Medicine;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SaleFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_sale_reduces_stock_and_updates_customer_due(): void
    {
        $customer = Customer::create([
            'name' => 'Rahim',
            'phone' => '01700000000',
            'total_due' => 0,
        ]);

        $medicine = Medicine::create([
            'name' => 'Napa',
            'generic_name' => 'Paracetamol',
            'brand' => 'Square',
            'category' => 'Tablet',
            'barcode' => 'TEST-100',
            'purchase_price' => 1.50,
            'sell_price' => 2.00,
            'stock' => 10,
            'is_active' => true,
        ]);

        $response = $this->postJson(route('sales.store'), [
            'customer_id' => $customer->id,
            'items' => [
                [
                    'medicine_id' => $medicine->id,
                    'quantity' => 3,
                ],
            ],
            'paid' => 4,
        ]);

        $response->assertOk()
            ->assertJsonPath('invoice_no', fn ($value) => str_starts_with($value, 'INV-'));

        $medicine->refresh();
        $customer->refresh();

        $this->assertSame(7, $medicine->stock);
        $this->assertEquals('2.00', $customer->total_due);
        $this->assertDatabaseHas('sales', [
            'customer_id' => $customer->id,
            'total' => 6.00,
            'paid' => 4.00,
            'due' => 2.00,
        ]);
        $this->assertDatabaseHas('sale_items', [
            'medicine_name' => 'Napa',
            'quantity' => 3,
        ]);
    }

    public function test_sale_rejects_when_stock_is_not_enough(): void
    {
        $medicine = Medicine::create([
            'name' => 'Ace',
            'generic_name' => 'Paracetamol',
            'brand' => 'Beximco',
            'category' => 'Tablet',
            'barcode' => 'TEST-200',
            'purchase_price' => 1.50,
            'sell_price' => 2.00,
            'stock' => 2,
            'is_active' => true,
        ]);

        $response = $this->postJson(route('sales.store'), [
            'items' => [
                [
                    'medicine_id' => $medicine->id,
                    'quantity' => 5,
                ],
            ],
            'paid' => 10,
        ]);

        $response->assertStatus(422);

        $medicine->refresh();

        $this->assertSame(2, $medicine->stock);
        $this->assertDatabaseCount('sales', 0);
    }
}
