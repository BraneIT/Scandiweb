<?php 

require_once __DIR__.'/../../vendor/autoload.php';
use Scandioop\Controllers\ProductController;



class ProductService{

       private $productController;

    public function __construct() {
        $this->productController = new ProductController();
    }

    public function executeDelete() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $postData = $_POST;
            
            $all_sku = $postData['product_delete'];
            $this->productController->deleteProducts($all_sku);

            header("Location: /Scandioop/");
            exit();
        }
    }
}

$productService = new ProductService();
$productService->executeDelete();

?>