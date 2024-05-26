<?php

Middleware::admin();

$conn = new Database( config() );

try {

    $conn->query("DELETE FROM product_items WHERE id = :id", [
        "id" => $_POST['id']
    ]);

}catch(Exception $e)
{

}

redirect("/admin");