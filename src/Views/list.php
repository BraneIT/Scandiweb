<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Scandioop/public/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <div class="header-wrapper">
        <h2>Product List</h2>
        <div class="buttons-wrapper">
            <a href="./add-product" id="" class="buttons">ADD</a>
            <button type="submit" name="mass_delete" id="delete-product-btn" class="buttons" value="MASS DELETE">MASS DELETE</button>
            </div>
    </div>
    <form method="post" action="/Scandioop/src/Services/DeleteProductsService.php" class="margin" id="delete-product-form">
    <div class="grid">
    <div class="product-wrapper">   
    <?php
        require_once __DIR__.'/../../vendor/autoload.php';
        use Scandioop\Controllers\ProductController;
   
        $productController = new ProductController();
        $products = $productController->getAllProducts();
        
        if(!empty($products)){    
        foreach($products as $product){
            ?>   
            <div class="product-container">
                <input type="checkbox" name="product_delete[]" class="delete-checkbox" value="<?=$product['sku'] ?>" >
                <h4 class="sku"><?=$product['sku'];?></h4>
                <h4><?=$product['name']?></h4>
                <h4><?=$product['price']?> $</h4>
                <div class="value-container">
                    <?php               
                        $formattedAttributeValue = $productController->formatAttributeValues($product['productTypeId'], $product['attributes']);
                            
                    ?>
                <h4><?= $formattedAttributeValue?></h4>
                </div>
            </div>
            <?php
        }
        }
        ?>
    </div>
    </div>    
    </form>
    <div class="footer">
        <p>Scandiweb Test assignment</p>
    </div>
    <script src="/Scandioop/public/app.js"></script>
</body>
</html>