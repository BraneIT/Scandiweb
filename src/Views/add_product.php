<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Scandioop/public/style.css">
    
    <title>Document</title>
</head>
<body>
    <div class="header-wrapper">
        <h2>Add Product</h2>
        <div class="buttons-wrapper">
            <button type="submit" id="save-form-btn" name="save_product" class="buttons">SAVE </button>
            <a href="./" id="delete-product-btn" class="buttons">CANCEL</a>
        </div>
    </div>
    
    <form id="product_form" method="post" action="/Scandioop/src/Services/AddProductService.php" class="margin">
        <div class="input_container">
            <label for="sku">SKU</label>
            <input type="text" name="sku" id="sku" placeholder="Enter SKU">
            <p class="hidden input_error" id="sku_error" ></p>
            <label for="name">NAME</label>
            <input type="text" name="name" id="name" placeholder="Enter name">
            <p class="hidden input_error" id="name_error"></p>       
            <label for="price">PRICE ($)</label>
            <input type="text" name="price" id="price" placeholder="Enter price">
            <p class="hidden input_error" id="price_error"></p> 
            <label for="">Type Switcher</label>
            <select id="productType" name="productType" class="type_switcher" onchange="show()">
                <option>Select type</option>
                <option value="DVD">DVD</option>
                <option value="Book">Book</option>
                <option value="Furniture">Furniture</option>
            </select>
            <p id="type_error" class="hidden input_error"></p>
            <div class="attribute_container">
            <div id="DVD" class="hidden" >
                <label for="size">Size (MB)</label>
                <input type="text" id="size" name="size" placeholder="Enter size">
                <p id="size_error" class="hidden input_error"></p>
                <p class="description">Please, provide size of DVD</p>
            </div>
            <div id="Book" class="hidden">
                <label for="size">Weight (KG)</label>
                <input type="text" id="weight" name="weight" placeholder="Enter weight">
                <p id="weight_error" class="hidden input_error"></p>
                <p class="description">Please, provide weight of book</p>
            </div>
            <div id="Furniture" class="hidden">
                <label for="size">Height (CM)</label>
                <input type="text" id="height" name="height" placeholder="Enter height">
                <p id="height_error" class="hidden input_error"></p>
                <label for="size">Width (CM)</label>
                <input type="text" id="width" name="width" placeholder="Enter width">
                <p id="width_error" class="hidden input_error"></p>
                <label for="size">Length (CM)</label>
                <input type="text" id="length" name="length" placeholder="Enter length">
                <p id="length_error" class="hidden input_error"></p>
                <p class="description">Please, provide dimensions of the furniture</p>
            </div>
            </div>
        </div>
    </form>   
  <div class="footer">
        <p>Scandiweb Test assignment</p>
  </div>
  
  <script src="/Scandioop/public/app.js"></script>
</body>
</html>