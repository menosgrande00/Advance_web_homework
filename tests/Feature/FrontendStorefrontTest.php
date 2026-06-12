<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FrontendStorefrontTest extends TestCase
{
    use RefreshDatabase;

    public function test_homepage_shows_active_store_content_without_unimplemented_features(): void
    {
        $activeCategory = Category::create(['name' => 'Active Category', 'status' => true]);
        $inactiveCategory = Category::create(['name' => 'Hidden Category', 'status' => false]);

        $activeProduct = $this->createProduct($activeCategory, 'Visible Product', true);
        $this->createProduct($activeCategory, 'Hidden Product', false);
        $this->createProduct($inactiveCategory, 'Product in Hidden Category', true);

        $this->get(route('home'))
            ->assertOk()
            ->assertSee('Welcome to Product Store')
            ->assertSee($activeCategory->name)
            ->assertSee($activeProduct->name)
            ->assertDontSee($inactiveCategory->name)
            ->assertDontSee('Hidden Product')
            ->assertDontSee('Product in Hidden Category')
            ->assertSee('Cart (0)')
            ->assertSee('Search products')
            ->assertDontSee('Newsletter');
    }

    public function test_active_category_and_product_pages_are_available(): void
    {
        $category = Category::create([
            'name' => 'Office',
            'description' => 'Useful office products.',
            'status' => true,
        ]);
        $product = $this->createProduct($category, 'Desk Lamp', true);

        $this->get(route('categories.show', $category))
            ->assertOk()
            ->assertSee($category->description)
            ->assertSee($product->name);

        $this->get(route('products.show', $product))
            ->assertOk()
            ->assertSee($product->name)
            ->assertSee('Available Stock')
            ->assertSee('Add To Cart');
    }

    public function test_inactive_category_and_product_pages_return_not_found(): void
    {
        $activeCategory = Category::create(['name' => 'Active', 'status' => true]);
        $inactiveCategory = Category::create(['name' => 'Inactive', 'status' => false]);
        $inactiveProduct = $this->createProduct($activeCategory, 'Inactive Product', false);
        $hiddenProduct = $this->createProduct($inactiveCategory, 'Hidden Product', true);

        $this->get(route('categories.show', $inactiveCategory))->assertNotFound();
        $this->get(route('products.show', $inactiveProduct))->assertNotFound();
        $this->get(route('products.show', $hiddenProduct))->assertNotFound();
    }

    public function test_navigation_changes_for_guests_users_and_admins(): void
    {
        $this->get(route('home'))
            ->assertSee('Login')
            ->assertSee('Register')
            ->assertDontSee('Admin Panel')
            ->assertDontSee('Logout');

        $user = User::factory()->create();

        $this->actingAs($user)->get(route('home'))
            ->assertSee('Logout')
            ->assertDontSee('Admin Panel')
            ->assertDontSee('Register');

        $admin = User::factory()->create();
        $admin->roles()->attach(Role::create(['name' => 'admin']));

        $this->actingAs($admin)->get(route('home'))
            ->assertSee('Admin Panel')
            ->assertSee('Logout');
    }

    private function createProduct(Category $category, string $name, bool $status): Product
    {
        return Product::create([
            'category_id' => $category->id,
            'name' => $name,
            'price' => 100,
            'stock' => 5,
            'minstock' => 1,
            'discount' => 0,
            'status' => $status,
        ]);
    }
}
