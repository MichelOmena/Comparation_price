<?php
use PHPUnit\Framework\TestCase;
use App\Models\Product;
use App\Core\Database;

class ProductTest extends TestCase {
    private $db;
    private $product;

    protected function setUP(): void {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->product = new Product($this->db);
    }

    public function testGetAllProducts() {
        $products = $this->product->getAll();
        $this->assertIsArray($products);
    }

    public function testCreateProduct() {
        $this->product->name = 'Test Product';
        $this->product->price = 99.99;
        $this->assertTrue($this->product->create());
    }
}