<?php 

require_once __DIR__.'/../../vendor/autoload.php';
use Scandioop\Controllers\ProductController;



class ProductService{

       private $productController;

    public function __construct() {
        $this->productController = new ProductController();
    }

    public function executeSave() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $postData = $_POST;
            
            $this->productController->saveProduct($postData);

            header("Location: /Scandioop/");
            exit();
        }
    }

}

$productService = new ProductService();
$productService->executeSave();

?>