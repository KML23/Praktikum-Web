<?php

    header("Content-type: application/json;");

    include "../app/Routes/ProductsRoutes.php";

    use app\Routes\ProductRoutes;

    $method = $_SERVER['REQUEST_METHOD'];
    $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    $productRoutes = new ProductRoutes;
    $productRoutes->handle($method, $path);
?>