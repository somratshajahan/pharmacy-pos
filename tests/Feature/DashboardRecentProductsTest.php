<?php

namespace Tests\Feature;

use App\Models\Medicine;
use App\Models\Sale;
use App\Models\SaleItem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardRecentProductsTest extends TestCase
{
    use RefreshDatabase;

    public function test_dashboard_displays_recently_added_products(): void
    {
        Medicine::create([
            'name' => 'Recent Napa',
            'generic_name' => 'Paracetamol',
            'brand' => 'Square',
            'category' => 'Tablet',
            'purchase_price' => 1.50,
            'sell_price' => 2.00,
            'stock' => 12,
        ]);

        $this->get(route('dashboard'))
            ->assertOk()
            ->assertSee('Recently Added / Updated Products')
            ->assertSee('Recent Napa')
            ->assertSee('Paracetamol')
            ->assertSee('Square');
    }

    public function test_updated_products_are_shown_before_older_products(): void
    {
        $updatedMedicine = Medicine::create([
            'name' => 'Updated Napa',
            'generic_name' => 'Paracetamol',
            'brand' => 'Square',
            'category' => 'Tablet',
            'purchase_price' => 1.50,
            'sell_price' => 2.00,
            'stock' => 12,
            'created_at' => now()->subDays(2),
            'updated_at' => now()->subDays(2),
        ]);
        Medicine::create([
            'name' => 'Recently Added Napa',
            'generic_name' => 'Paracetamol',
            'brand' => 'Square',
            'category' => 'Tablet',
            'purchase_price' => 1.50,
            'sell_price' => 2.00,
            'stock' => 12,
            'created_at' => now()->subDay(),
            'updated_at' => now()->subDay(),
        ]);

        $updatedMedicine->update(['stock' => 13]);

        $this->get(route('dashboard'))
            ->assertOk()
            ->assertSeeInOrder(['Updated Napa', 'Recently Added Napa']);
    }

    public function test_inventory_alert_endpoints_reflect_current_product_data(): void
    {
        $medicine = Medicine::create([
            'name' => 'Alert Napa',
            'category' => 'Tablet',
            'stock' => 2,
            'stock_alert' => 5,
            'expiry' => now()->addDays(30)->toDateString(),
        ]);

        $this->getJson(route('lowStock'))
            ->assertOk()
            ->assertJsonFragment(['name' => 'Alert Napa', 'stock' => 2]);
        $this->getJson(route('upcomingExpiry'))
            ->assertOk()
            ->assertJsonFragment(['name' => 'Alert Napa', 'stock' => 2]);

        $medicine->update([
            'stock' => 20,
            'expiry' => now()->addYear()->toDateString(),
        ]);

        $this->getJson(route('lowStock'))
            ->assertOk()
            ->assertExactJson([]);
        $this->getJson(route('upcomingExpiry'))
            ->assertOk()
            ->assertExactJson([]);
    }

    public function test_recent_sales_show_the_names_of_sold_products(): void
    {
        $sale = Sale::create([
            'invoice_no' => 'INV-RECENT-001',
            'total' => 6.00,
            'paid' => 6.00,
            'due' => 0,
        ]);
        SaleItem::create([
            'sale_id' => $sale->id,
            'medicine_name' => 'Napa Extra',
            'price' => 3.00,
            'quantity' => 2,
        ]);

        $this->get(route('dashboard'))
            ->assertOk()
            ->assertSee('Medicines (Qty)')
            ->assertSee('Napa Extra (Qty: 2)');
    }
}
