<?php

$conn = new Database( config() );

try {

    $conn->query("INSERT INTO users (username, password, email, birthdate, full_name, user_id) VALUES(:username, :password, :email, :birthdate, :full_name, :user_id)", [
        "username" => $_POST['username'],
        "password" => password_hash($_POST['password'], PASSWORD_DEFAULT),
        "email" => $_POST['email'],
        "birthdate" => $_POST['birthdate'],
        "full_name" => $_POST['firstname'] . ' ' . $_POST['middle_name'] . ' ' . $_POST['lastname'],
        "user_id" => rand(1000, 9999)
    ]);

}catch (Exception $e){
    
    displayError([
        "error" => 406,
        "description" => "USERNAME IS ALREADY EXIST",
        "redirect" => "/index.php/registration"
    ]);

}finally {

    redirect("/login");

}

