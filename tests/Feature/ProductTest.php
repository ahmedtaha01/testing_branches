<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    private User $user;
    private User $admin;
    // public function __construct()
    // {
    //     $this->user = User::factory()->create();

    // }

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->admin = User::factory()->create(['is_admin' => true]);
    }
    
    public function test_products_page_is_200(): void
    {
        $response = $this->actingAs($this->user)->get('/products');

        $response->assertStatus(200);
        
    }

    public function test_products_page_doesnt_contains_data()
    {
        
        $response = $this->actingAs($this->user)->get('/products');
        $response->assertStatus(200);
        $response->assertSee('No data');
    }

    public function test_products_page_contains_data()
    {
        
        $products = Product::factory(10)->create();
        $product = $products->last();
        $response = $this->actingAs($this->user)->get('/products');
        $response->assertStatus(200);
        $response->assertDontSee('No data');
        $response->assertViewHas('products',function($collection)use ($product){
            return $collection->contains($product);
        });
    }

    public function test_admin_should_see_create_product_button()
    {

        $response = $this->actingAs($this->admin)->get('products');

        $response->assertSee('create product');
    }

    public function test_non_admin_should_not_see_create_product_button()
    {
        $response = $this->actingAs($this->user)->get('products');

        $response->assertDontSee('create product');
    }

    public function test_admin_can_access_create_product_page()
    {
        $response = $this->actingAs($this->admin)->get('products/create');

        $response->assertStatus(200);
    }

    public function test_non_admin_can_not_access_create_product_page()
    {
        $response = $this->actingAs($this->user)->get('products/create');

        $response->assertStatus(403);
    }

    public function test_create_product_successfully()
    {
        $response = $this->actingAs($this->admin)->post('products',[
            'name'          => 'car',
            'description'   => 'it is a car',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('products');
        $this->assertDatabaseHas('products',[
            'name'          => 'car',
            'description'   => 'it is a car',
        ]);
        $latestProduct = Product::latest()->first();
        $this->assertEquals('car',$latestProduct['name']);
        $this->assertEquals('it is a car',$latestProduct['description']);
    }

}
