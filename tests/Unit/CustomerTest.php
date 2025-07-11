<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Customers;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CustomerTest extends TestCase
{
    use RefreshDatabase;

    public function test_customer_creation()
    {
        // Create a fake user
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->post('/customer', [
            'name' => 'John Doe',
            'phone' => '1234567890',
            'address' => '123 Main St',
        ]);

        // Try to create a customer
        $response->assertRedirect('/customer');
        $this->assertDatabaseHas('customers', [
            'name' => 'John Doe',
            'phone' => '1234567890',
            'address' => '123 Main St',
        ]);

        // Check that validation error is thrown for unique title
        // $response->assertSessionHasErrors(['name' => 'The name has already been taken.']);
    }

    public function test_customer_update()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $customer = Customers::factory()->create([
            'name' => 'John Doe',
            'phone' => '9876543210',
            'address' => '456 Elm St',
        ]);

        $response = $this->put("/customer/{$customer->id}", [
            'name' => 'Diriansyah',
            'phone' => '08123456789',
            'address' => 'Pasar Senen',
        ]);

        $response->assertRedirect('/customer');
        $this->assertDatabaseHas('customers', [
            'name' => 'Diriansyah',
            'phone' => '08123456789',
            'address' => 'Pasar Senen',
        ]);
    }
}
