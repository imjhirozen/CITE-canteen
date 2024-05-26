<?php

Middleware::auth();

$conn = new Database( config() );


try {

    $result = $conn->query("SELECT * FROM product_items WHERE id >= :id", [
        'id' => 1
    ])->fetchAll();
    
    // Step 1: Convert the data to JSON
    $jsonData = json_encode($result, JSON_PRETTY_PRINT);

    // Step 2: Write the JSON data to a file
    $file = 'Model/json/product.json';

    if (!file_put_contents($file, $jsonData)) 
    {
        displayError([
            "error" => 404,
            "description" => "FIle is not created make sure the file path is correct",
            "redirect" => "/index.php/"
        ]);
    }
    


}catch (Exception $e) {
    echo $e;
}


view('home/index.view.php');