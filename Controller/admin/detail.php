<?php

Middleware::admin();

$conn = new Database( config() );

try {

    $result = $conn->query("SELECT * FROM product_items WHERE id = :id", [
        'id' => $_GET['id']
    ])->fetch();

}catch (Exception $e) {
    echo $e;
}

view("admin/edit.view.php", [
    'value' => $result
]);