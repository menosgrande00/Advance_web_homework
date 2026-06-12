<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ShoppingFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_can_manage_cart_but_checkout_requires_login(): void
    {
        $product = $this->product(stock: 3);

        $this->post(route('cart.store', $product), ['quantity' => 2])
            ->assertSessionHas('cart.'.$product->id, 2);

        $this->get(route('cart.index'))->assertOk()->assertSee($product->name)->assertSee('200.00 TL');

        $this->patch(route('cart.update', $product), ['quantity' => 4])
            ->assertSessionHasErrors('quantity');

        $this->get(route('checkout.create'))->assertRedirect(route('login'));

        $this->delete(route('cart.destroy', $product))
            ->assertSessionMissing('cart.'.$product->id);
    }

    public function test_checkout_creates_order_snapshots_items_and_reduces_stock(): void
    {
        $user = User::factory()->create();
        $product = $this->product(stock: 5);

        $response = $this->actingAs($user)
            ->withSession(['cart' => [$product->id => 2]])
            ->post(route('checkout.store'), $this->checkoutData());

        $order = Order::firstOrFail();
        $response->assertRedirect(route('orders.show', $order))->assertSessionMissing('cart');
        $this->assertDatabaseHas('orders', ['user_id' => $user->id, 'total' => 200, 'status' => 'pending']);
        $this->assertDatabaseHas('order_items', ['product_name' => $product->name, 'quantity' => 2, 'subtotal' => 200]);
        $this->assertSame(3, $product->fresh()->stock);
    }

    public function test_checkout_rolls_back_when_stock_is_insufficient(): void
    {
        $user = User::factory()->create();
        $product = $this->product(stock: 1);

        $this->actingAs($user)
            ->withSession(['cart' => [$product->id => 2]])
            ->post(route('checkout.store'), $this->checkoutData())
            ->assertSessionHasErrors('cart');

        $this->assertDatabaseCount('orders', 0);
        $this->assertSame(1, $product->fresh()->stock);
    }

    public function test_admin_can_filter_orders_and_cancellation_restores_stock_only_once(): void
    {
        $admin = User::factory()->create();
        $admin->roles()->attach(Role::create(['name' => 'admin']));
        $product = $this->product(stock: 3);
        $order = $this->orderWithItem($product, quantity: 2);

        $this->actingAs($admin)->get(route('admin.orders.index', ['status' => 'pending']))
            ->assertOk()->assertSee($order->order_number);

        $this->patch(route('admin.orders.update-status', $order), ['status' => 'cancelled']);
        $this->assertSame(5, $product->fresh()->stock);
        $this->assertNotNull($order->fresh()->cancelled_at);

        $this->patch(route('admin.orders.update-status', $order), ['status' => 'processing']);
        $this->patch(route('admin.orders.update-status', $order), ['status' => 'cancelled']);
        $this->assertSame(5, $product->fresh()->stock);
    }

    public function test_users_can_only_view_their_own_orders_and_non_admins_cannot_manage_them(): void
    {
        $owner = User::factory()->create();
        $other = User::factory()->create();
        $order = $this->orderWithItem($this->product(), user: $owner);

        $this->actingAs($owner)->get(route('orders.show', $order))->assertOk()->assertSee($order->order_number);
        $this->actingAs($other)->get(route('orders.show', $order))->assertForbidden();
        $this->actingAs($other)->get(route('admin.orders.index'))->assertForbidden();
    }

    public function test_search_only_returns_active_products_in_active_categories(): void
    {
        $visible = $this->product(name: 'Blue Desk Lamp');
        $hidden = $this->product(name: 'Blue Hidden Lamp', status: false);
        $hiddenCategory = Category::create(['name' => 'Hidden', 'status' => false]);
        $hiddenByCategory = $this->product(name: 'Blue Secret Lamp', category: $hiddenCategory);

        $this->get(route('search', ['q' => 'Blue']))
            ->assertOk()
            ->assertSee($visible->name)
            ->assertDontSee($hidden->name)
            ->assertDontSee($hiddenByCategory->name);
    }

    public function test_admin_can_upload_and_replace_category_homepage_image(): void
    {
        Storage::fake('public');
        $admin = User::factory()->create();
        $admin->roles()->attach(Role::create(['name' => 'admin']));

        $this->actingAs($admin)->post(route('admin.categories.store'), [
            'name' => 'Office',
            'status' => 1,
            'image' => UploadedFile::fake()->create('office.jpg', 10, 'image/jpeg'),
        ])->assertRedirect(route('admin.categories.index'));

        $category = Category::firstOrFail();
        Storage::disk('public')->assertExists($category->image);
        $oldImage = $category->image;

        $this->put(route('admin.categories.update', $category), [
            'name' => 'Office',
            'status' => 1,
            'image' => UploadedFile::fake()->create('new-office.webp', 10, 'image/webp'),
        ])->assertRedirect(route('admin.categories.index'));

        Storage::disk('public')->assertMissing($oldImage);
        Storage::disk('public')->assertExists($category->fresh()->image);
        $this->get(route('home'))->assertSee($category->fresh()->image_url);
    }

    private function product(
        string $name = 'Desk Lamp',
        int $stock = 5,
        bool $status = true,
        ?Category $category = null,
    ): Product {
        $category ??= Category::create(['name' => 'Office', 'status' => true]);

        return Product::create([
            'category_id' => $category->id,
            'name' => $name,
            'price' => 100,
            'stock' => $stock,
            'minstock' => 0,
            'discount' => 0,
            'status' => $status,
        ]);
    }

    private function checkoutData(): array
    {
        return [
            'customer_name' => 'Test Customer',
            'phone' => '5551234567',
            'address' => 'Test delivery address',
            'note' => 'Leave at reception',
        ];
    }

    private function orderWithItem(Product $product, int $quantity = 1, ?User $user = null): Order
    {
        $order = Order::create([
            'user_id' => ($user ?? User::factory()->create())->id,
            'order_number' => 'ORD-TEST-'.uniqid(),
            'customer_name' => 'Test Customer',
            'phone' => '5551234567',
            'address' => 'Test address',
            'total' => 100 * $quantity,
            'status' => 'pending',
        ]);
        $order->items()->create([
            'product_id' => $product->id,
            'product_name' => $product->name,
            'unit_price' => 100,
            'quantity' => $quantity,
            'subtotal' => 100 * $quantity,
        ]);

        return $order;
    }
}
