<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminDashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_open_dashboard_and_crud_pages(): void
    {
        $admin = User::factory()->create();
        $admin->roles()->attach(Role::create(['name' => 'admin']));

        $category = Category::create([
            'name' => 'Test Category',
            'status' => true,
        ]);

        $product = Product::create([
            'category_id' => $category->id,
            'user_id' => $admin->id,
            'name' => 'Test Product',
            'price' => 10,
            'stock' => 5,
            'minstock' => 1,
            'discount' => 0,
            'status' => true,
        ]);

        $this->actingAs($admin)->get(route('admin.index'))
            ->assertOk()
            ->assertSee('Total Products');

        $this->actingAs($admin)->get(route('admin.categories.index'))
            ->assertOk()
            ->assertSee($category->name);

        $this->actingAs($admin)->get(route('admin.products.index'))
            ->assertOk()
            ->assertSee($product->name);
    }

    public function test_non_admin_cannot_open_admin_dashboard(): void
    {
        $this->actingAs(User::factory()->create())
            ->get(route('admin.index'))
            ->assertForbidden();
    }
}
