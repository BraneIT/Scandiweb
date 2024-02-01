<?php
namespace Scandioop\Controllers;

require_once __DIR__.'/../../vendor/autoload.php';
use Scandioop\Includes\DatabaseConnection;
use Scandioop\Models\Product;
use Scandioop\Models\DVD;
use Scandioop\Models\Book;
use Scandioop\Models\Furniture;

use PDO;
use PDOException;



class ProductController
{
      private $databaseConnection;

    public function __construct()
    {
        $this->databaseConnection = new DatabaseConnection();
    } 
     private function fetchProductTypeId($productType)
    {
        $pdo = $this->databaseConnection->getConnection();
        $statement = $pdo->prepare("SELECT id FROM product_types WHERE name = :product_type");
        $statement->bindValue(':product_type', $productType, PDO::PARAM_STR);
        $statement->execute();
        $result = $statement->fetchColumn();
        return $result;
            
    }

      private function fetchAttributeId($attributeName, $productType)
    {
        $pdo = $this->databaseConnection->getConnection();
        $statement = $pdo->prepare("SELECT id FROM attributes WHERE name = :attribute_name AND product_type_id = :product_type_id");
        $statement->bindValue(':attribute_name', $attributeName, PDO::PARAM_STR);
        $statement->bindValue(':product_type_id', $this->fetchProductTypeId($productType), PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchColumn();
    }

    public function saveProduct($postData)
    {
        $productType = $postData['productType'];
        $productTypeId = $this->fetchProductTypeId($productType);
        if ($this->isSkuExists($postData['sku'])) {       
            header('Location: /Scandioop/add-product');
        } 

        $productClassName = 'Scandioop\\Models\\' . $productType;
        $product = new $productClassName();

        $product->setSku($postData['sku']);
        $product->setName($postData['name']);
        $product->setPrice($postData['price']);
        $product->setProductTypeId($productTypeId);
        $this->saveToDatabase($product);
        $attributeMap = [
           'DVD' => ['size'],
           'Book' => ['weight'],
           'Furniture' => ['height', 'width', 'length']
        ];
        $attributes = $attributeMap[$productType];
        foreach ($attributes as $attribute) {
        $getterMethod = 'set' . ucfirst($attribute);
        $product->$getterMethod($postData[$attribute]);
        $attributeId = $this->fetchAttributeId($attribute, $productType);
        $attributeValue = $postData[$attribute];
        $productSku = $product->getSku();
        $this->saveAttribute($productSku, $attributeId, $attributeValue);
        }      
        header('Location: /Scandioop/');
        exit;
    }
    
     public function isSkuExists($sku)
    {   
         $pdo = $this->databaseConnection->getConnection();
        $query = "SELECT COUNT(*) as count FROM products WHERE sku = :sku";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':sku', $sku, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return ($result['count'] > 0);
    }

      public function saveToDatabase($product)
    {
        $sql = "INSERT INTO products (sku, name, price, product_type_id) VALUES (:sku, :name, :price, :product_type_id)";

        $pdo = $this->databaseConnection->getConnection();
        $stmt = $pdo->prepare($sql);
        $sku = $product->getSku();
        $name = $product->getName();
        $price = $product->getPrice();
        $productTypeId = $product->getProductTypeId();
        $stmt->bindValue(':sku', $sku);
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':price', $price);
        $stmt->bindValue(':product_type_id', $productTypeId);
        $stmt->execute();   
    }

     public function saveAttribute($productSku, $attributeId, $attributeValue)
    {
        $sql = "INSERT INTO product_attributes (product_sku, attribute_id, value) VALUES (:product_sku, :attribute_id, :value)";
        $pdo = $this->databaseConnection->getConnection();
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':product_sku', $productSku);
        $stmt->bindValue(':attribute_id', $attributeId);
        $stmt->bindValue(':value', $attributeValue);
        $stmt->execute();
    }

    
    public function getAllProducts()
    {
        $database = new DatabaseConnection();
        $pdo = $database->getConnection();

        $result = $pdo->query("SELECT * FROM products ORDER BY sku");
        if ($result->rowCount() > 0) {
        
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $sku = $row['sku'];
            $name = $row['name'];
            $price = $row['price'];
            $productTypeId = $row['product_type_id'];
            $attributes = $pdo->query("SELECT attribute_id, value FROM product_attributes WHERE product_sku = '$sku'");
            $productData = [
                'sku' => $sku,
                'name' => $name,
                'price' => $price,
                'productTypeId' => $productTypeId,
                'attributes' => $attributes->fetchAll(PDO::FETCH_ASSOC) // 
            ];
            $products[] = $productData; 
        }
        return $products;
            }
         else {
            echo '<p>No products found.</p>';
        }
    }

    public function formatAttributeValues($productType, $attributes)
    {
        $attributeMap = [
            1 => 'Size: %s MB',
            2 => 'Weight: %s KG',
            3 => 'Dimensions: %s x %s x %s',
        ];

        if (array_key_exists($productType, $attributeMap)) 
        {
            $displayFormat = $attributeMap[$productType];
            $attributeValues = array_column($attributes, 'value');
            return vsprintf($displayFormat, $attributeValues);
        }
    }
  
    public function deleteProducts()
    {
        if (empty($_POST['product_delete'])) {
            header("Location: /Scandioop/");
            exit();
        }
        $database = new DatabaseConnection();
        $pdo = $database->getConnection();
        $all_sku = $_POST['product_delete'];
        $placeholders = implode(',', array_fill(0, count($all_sku), '?'));
        $deleteStatement = $pdo->prepare("DELETE FROM products WHERE sku IN ($placeholders)");
        $i = 1;
        foreach ($all_sku as $sku) {
            $deleteStatement->bindValue($i++, $sku);
        }
        $deleteStatement->execute();
    }
}
?>

