<?php

namespace Tests\Feature;

use App\Models\Medicine;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MedicineNameValidationTest extends TestCase
{
    use RefreshDatabase;

    public function test_medicine_category_is_a_selection_with_supported_categories(): void
    {
        $this->get(route('medicines.index'))
            ->assertOk()
            ->assertSee('name="category"', false)
            ->assertSee('value="Tablet"', false)
            ->assertSee('value="Capsule"', false)
            ->assertSee('value="Syrup"', false)
            ->assertSee('value="Drop"', false)
            ->assertSee('value="Suppository"', false)
            ->assertSee('value="Device"', false)
            ->assertSee('value="Spray"', false)
            ->assertSee('value="Solution"', false)
            ->assertSee('value="Cream"', false)
            ->assertSee('value="Ointment"', false)
            ->assertSee('value="Sachets"', false)
            ->assertSee('value="Injection"', false)
            ->assertSee('value="Syringe"', false)
            ->assertSee('value="Pampers"', false)
            ->assertDontSee('list="medicineSuggestions"', false)
            ->assertSee('<div id="medicineSuggestions"', false)
            ->assertSee("category: row.querySelector('select[name=\"category\"]')", false);
    }

    public function test_medicine_add_form_focuses_the_brand_name_field(): void
    {
        $this->get(route('medicines.index'))
            ->assertOk()
            ->assertSee('<input id="name" name="name" value="" autocomplete="off" autofocus required>', false);
    }

    public function test_medicines_can_be_added_with_drop_suppository_device_spray_injection_syringe_and_pampers_categories(): void
    {
        foreach (['Drop', 'Suppository', 'Device', 'Spray', 'Injection', 'Syringe', 'Pampers'] as $category) {
            $this->post(route('medicines.store'), [
                'name' => $category . ' Product',
                'category' => $category,
                'purchase_price' => 1.50,
                'sell_price' => 2.00,
                'stock' => 10,
                'stock_alert' => 5,
                'expiry' => '2027-01-01',
                'is_active' => 1,
            ])->assertRedirect(route('medicines.index'));

            $this->assertDatabaseHas('medicines', [
                'name' => $category . ' Product',
                'category' => $category,
            ]);
        }
    }

    public function test_medicine_can_be_added_with_sachets_category(): void
    {
        $response = $this->post(route('medicines.store'), [
            'name' => 'ORS Sachet',
            'category' => 'Sachets',
            'purchase_price' => 1.50,
            'sell_price' => 2.00,
            'stock' => 10,
            'stock_alert' => 5,
            'expiry' => '2027-01-01',
            'is_active' => 1,
        ]);

        $response->assertRedirect(route('medicines.index'));
        $response->assertSessionHas('success', "Medicine 'ORS Sachet' added successfully.");
        $this->assertDatabaseHas('medicines', [
            'name' => 'ORS Sachet',
            'category' => 'Sachets',
        ]);
    }

    public function test_medicine_category_can_be_changed_when_updating(): void
    {
        $medicine = Medicine::create([
            'name' => 'Esonix 20',
            'category' => 'Capsule',
            'purchase_price' => 6.00,
            'sell_price' => 7.00,
            'stock' => 49,
        ]);

        $response = $this->putJson(route('medicines.update', $medicine->id), [
            'name' => 'Esonix 20',
            'category' => 'Tablet',
            'purchase_price' => 6.00,
            'sell_price' => 7.00,
            'stock' => 49,
            'add' => 0,
            'stock_alert' => 14,
            'is_active' => 1,
        ]);

        $response->assertOk()
            ->assertJsonPath('success', true);
        $this->assertDatabaseHas('medicines', [
            'id' => $medicine->id,
            'category' => 'Tablet',
        ]);
    }

    public function test_existing_medicine_names_are_suggested_by_name(): void
    {
        Medicine::create([
            'name' => 'Esonix 20',
            'generic_name' => 'Esomeprazole',
            'category' => 'Capsule',
            'purchase_price' => 6.00,
            'sell_price' => 7.00,
        ]);
        Medicine::create([
            'name' => 'Napa',
            'generic_name' => 'Paracetamol',
            'category' => 'Tablet',
            'purchase_price' => 1.00,
            'sell_price' => 2.00,
        ]);

        $this->getJson(route('medicines.suggestions', ['query' => 'Eson']))
            ->assertOk()
            ->assertExactJson(['Esonix 20']);
    }

    public function test_same_brand_name_can_be_added_in_a_different_category(): void
    {
        Medicine::create([
            'name' => 'Esonix 20',
            'category' => 'Tablet',
            'barcode' => 'TEST-001',
            'purchase_price' => 1.50,
            'sell_price' => 2.00,
        ]);

        $response = $this->post(route('medicines.store'), [
            'name' => 'Esonix 20',
            'category' => 'Capsule',
            'purchase_price' => 1.50,
            'sell_price' => 2.00,
            'stock' => 10,
            'stock_alert' => 5,
            'expiry' => '2027-01-01',
            'is_active' => 1,
        ]);

        $response->assertRedirect(route('medicines.index'));
        $this->assertDatabaseHas('medicines', [
            'name' => 'Esonix 20',
            'category' => 'Capsule',
        ]);
        $this->assertDatabaseCount('medicines', 2);
    }

    public function test_same_brand_name_and_category_are_rejected_when_adding(): void
    {
        Medicine::create([
            'name' => 'Esonix 20',
            'category' => 'Tablet',
            'barcode' => 'TEST-001',
            'purchase_price' => 1.50,
            'sell_price' => 2.00,
        ]);

        $response = $this->from(route('medicines.index'))->post(route('medicines.store'), [
            'name' => 'Esonix 20',
            'category' => 'Tablet',
            'purchase_price' => 1.50,
            'sell_price' => 2.00,
            'stock' => 10,
            'stock_alert' => 5,
            'expiry' => '2027-01-01',
            'is_active' => 1,
        ]);

        $response->assertRedirect(route('medicines.index'))
            ->assertSessionHasErrors([
                'name' => 'This brand name already exists in the selected category.',
            ]);
        $this->assertDatabaseCount('medicines', 1);
    }

    public function test_same_brand_name_and_category_are_rejected_when_updating(): void
    {
        Medicine::create([
            'name' => 'Esonix 20',
            'category' => 'Tablet',
            'barcode' => 'TEST-001',
            'purchase_price' => 1.50,
            'sell_price' => 2.00,
        ]);
        $medicine = Medicine::create([
            'name' => 'Napa',
            'category' => 'Tablet',
            'barcode' => 'TEST-002',
            'purchase_price' => 1.50,
            'sell_price' => 2.00,
        ]);

        $response = $this->putJson(route('medicines.update', $medicine->id), [
            'name' => 'Esonix 20',
            'category' => 'Tablet',
            'purchase_price' => 1.50,
            'sell_price' => 2.00,
            'stock' => 10,
            'stock_alert' => 5,
            'expiry' => '2027-01-01',
        ]);

        $response->assertUnprocessable()
            ->assertJsonPath('errors.name.0', 'This brand name already exists in the selected category.');
        $this->assertDatabaseHas('medicines', [
            'id' => $medicine->id,
            'name' => 'Napa',
        ]);
    }

    public function test_category_must_be_selected_from_the_available_options(): void
    {
        $response = $this->from(route('medicines.index'))->post(route('medicines.store'), [
            'name' => 'Esonix 20',
            'category' => 'Unlisted category',
            'purchase_price' => 1.50,
            'sell_price' => 2.00,
            'stock' => 10,
            'stock_alert' => 5,
            'expiry' => '2027-01-01',
        ]);

        $response->assertRedirect(route('medicines.index'))
            ->assertSessionHasErrors('category');
        $this->assertDatabaseCount('medicines', 0);
    }
}
