<?php

const BASEPATH = __DIR__;

function dd( $test )
{
    echo "<pre>";
    var_dump( $test );
    echo "<pre>";
    die();
}

function redirect( $path )
{
    header("location: /index.php{$path}");
    exit();
}

function view( $path, $attribute = [] )
{   
    extract($attribute);
    return require "View/" . $path;
}

function config()
{
    return require '_config/config.php';
}

function displayError( $error = [] )
{
    extract($error);
    return require "View/error/index.error.php";
    die();
}