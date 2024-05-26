<?php

Middleware::admin();

$conn = new Database( config() );


if(empty($_FILES))
{
    displayError([
        "error" => 406,
        "description" => "Sorry, only JPG, JPEG, PNG & GIF files are allowed",
        "redirect" => "/index.php/admin"
    ]);
    
}
 
try{

    $file_name = $_FILES['image']['name'];
    $temp_name = $_FILES['image']['tmp_name'];
    $folder_path = "View/assets/img/" . $file_name;

    if(move_uploaded_file($temp_name, $folder_path))
    {
        $conn->query("INSERT INTO product_items (product_type, product_name, product_price, product_image) VALUE (:product_type, :product_name, :product_price, :product_image)", [
            "product_type" => $_POST['type'],
            "product_name" => $_POST['product_name'],
            "product_price" => $_POST['product_price'],
            "product_image" => "../" . $folder_path
        ]);

    }

}catch (Exception $e) {

    displayError([
        "error" => 406,
        "description" => $e,
        "redirect" => "/admin"
    ]);

}

redirect("/admin");