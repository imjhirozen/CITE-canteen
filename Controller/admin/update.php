<?php

Middleware::admin();

$conn = new Database( config() );

try {

    $conn->query("UPDATE product_items SET product_type = :product_type, product_name = :product_name, product_price = :product_price WHERE id = :id", [
        "product_type" => $_POST['type'],
        "product_name" => $_POST['product'],
        "product_price" => $_POST['price'],
        "id" => $_POST['id']
    ]);

}catch (Exception $e)  {


}

redirect("/admin");

