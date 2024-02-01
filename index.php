<?php
require_once __DIR__.'/vendor/autoload.php';
// echo $_SERVER['REQUEST_URI'];
?>

<?php
use Scandioop\Router\Router;
Router::handle(method:'GET', path:'/', filename:'./src/Views/list.php');
Router::handle(method:'GET', path:'/add-product', filename:'./src/Views/add_product.php');

Router::defaultRoute();

?>