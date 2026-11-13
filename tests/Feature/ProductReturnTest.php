<?php

namespace Tests\Feature;

use App\Models\Customer;
use App\Models\Medicine;
use App\Models\ProductReturn;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductReturnTest extends TestCase
{
    use RefreshDatabase;

    public function test_customer_return_removes_stock_and_is_shown_on_dashboard(): void
    {
        $customer = Customer::create(['name' => 'Return Customer']);
        $medicine = $this->medicine(['stock' => 4]);

        $this->post(route('product-returns.store'), [
            'type' => 'customer',
            'customer_id' => $customer->id,
            'medicine_id' => $medicine->id,
            'quantity' => 3,
            'returned_at' => now()->toDateString(),
        ])->assertRedirect(route('dashboard'));

        $this->assertSame(1, $medicine->fresh()->stock);
        $this->assertDatabaseHas('product_returns', [
            'type' => 'customer',
            'medicine_name' => 'Return Medicine',
            'quantity' => 3,
            'customer_name' => 'Return Customer',
        ]);

        $this->get(route('dashboard'))
            ->assertOk()
            ->assertSee('id="openProductReturn"', false)
            ->assertSee('id="returnMedicineSearch"', false)
            ->assertSee('Recent Product Returns')
            ->assertSee('Return Medicine')
            ->assertSee('Return Customer');
    }

    public function test_return_to_company_removes_stock_and_records_company_and_date(): void
    {
        $medicine = $this->medicine(['stock' => 8]);
        $returnDate = now()->subDay()->toDateString();

        $this->post(route('product-returns.store'), [
            'type' => 'company',
            'company_name' => 'Medicine Company',
            'medicine_id' => $medicine->id,
            'quantity' => 5,
            'returned_at' => $returnDate . ' 00:00:00',
        ])->assertRedirect(route('dashboard'));

        $this->assertSame(3, $medicine->fresh()->stock);
        $this->assertDatabaseHas('product_returns', [
            'type' => 'company',
            'company_name' => 'Medicine Company',
            'medicine_name' => 'Return Medicine',
            'quantity' => 5,
            'returned_at' => $returnDate . ' 00:00:00',
        ]);

        $this->get(route('dashboard'))
            ->assertOk()
            ->assertSee('Return Medicine')
            ->assertSee('Medicine Company')
            ->assertSee(\Illuminate\Support\Carbon::parse($returnDate)->format('d M Y'));
    }

    public function test_company_return_cannot_remove_more_than_available_stock(): void
    {
        $medicine = $this->medicine(['stock' => 2]);

        $this->from(route('dashboard'))
            ->post(route('product-returns.store'), [
                'type' => 'company',
                'company_name' => 'Medicine Company',
                'medicine_id' => $medicine->id,
                'quantity' => 3,
                'returned_at' => now()->toDateString(),
            ])
            ->assertRedirect(route('dashboard'))
            ->assertSessionHasErrors('quantity');

        $this->assertSame(2, $medicine->fresh()->stock);
        $this->assertSame(0, ProductReturn::query()->count());
    }

    private function medicine(array $attributes = []): Medicine
    {
        return Medicine::create(array_merge([
            'name' => 'Return Medicine',
            'brand' => 'Medicine Company',
            'category' => 'Tablet',
            'purchase_price' => 1,
            'sell_price' => 2,
            'stock' => 5,
        ], $attributes));
    }
}
