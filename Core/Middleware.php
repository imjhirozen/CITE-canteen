<?php

class Middleware {

    public static function auth()
    {  
        return empty($_SESSION) ? redirect("/login") : '';
    }

    public static function admin()
    {  

        if(!empty($_SESSION['role']))
        {
            return $_SESSION['role'] != 'admin' ? redirect('/') : '';   
        }

        return redirect('/login');

    }

}