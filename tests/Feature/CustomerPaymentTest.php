<?php

namespace Tests\Feature;

use App\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CustomerPaymentTest extends TestCase
{
    use RefreshDatabase;

    public function test_customer_payment_reduces_due_and_saves_history(): void
    {
        dd(app()->environment());
        $customer = Customer::create([
            'name' => 'Karim',
            'phone' => '01800000000',
            'total_due' => 100,
        ]);

        $response = $this->post(route('customers.payment', $customer), [
            'amount' => 35,
            'note' => 'Partial collection',
        ]);

        $response->assertRedirect(route('customers.show', $customer));

        $customer->refresh();

        $this->assertEquals('65.00', $customer->total_due);
        $this->assertDatabaseHas('payments', [
            'customer_id' => $customer->id,
            'amount' => 35.00,
            'note' => 'Partial collection',
        ]);
    }
}
