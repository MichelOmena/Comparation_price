<?php
namespace App\Controllers;

use App\Core\Database;
use App\Models\Product;

class Product_Controller {
    public function handleRequest() {
        $action = $_GET['action'] ?? 'list';

        switch ($action) {
            case 'list':
                $this->listProducts();
                break;
            case 'create':
                $this->createProduct();
                break;
            default:
            echo json_encode(['message' => 'Invalid action']);
            break;
        }
    } 

    private function listProducts() {
        $db = new Database();
        $conn = $db->getConnection();

        $product = new Product($conn);
        $products = $product->getAll(); 

        echo json_encode($products);
    }

    private function createProduct() {
        $data = json_decode(file_get_contents('php://input'), true);
        if (!isset($data['name']) || !isset($data['price'])) {
            echo json_encode(['message' => 'Invalid input']);
            return;
        }

        $db = new Database();
        $conn = $db->getConnection();

        $product = new Product($conn);
        $product->name = $data['name'];
        $product->price = $data['price'];

        if ($product->create()) {
            echo json_encode(['message' => 'Product create successfully']);
        } else {
            echo json_encode(['message' => 'Failed to create product']);
        }
    }
}