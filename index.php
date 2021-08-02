<?php
    //Acme Controller

    // Create or access a Session
    session_start();

    // Get the database connection file
    require_once 'library/connections.php';
    // Get the acme model for use as needed
    require_once 'model/acme-model.php';
    // Get the accounts model
    require_once 'model/accounts-model.php';
    // Get the functions.php file
    require_once 'library/functions.php';


    // Get the array of categories
    $categories = getCategories();

    // Build a navigation bar using the $categories array
    $navList = getNavList($categories);

    // Check if the firstname cookie exists, get its value
    if(isset($_COOKIE['firstname'])){
        $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_STRING);
    }

    $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
    if ($action == NULL){
        $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
    }

    switch ($action){
        case 'something':
         
            break;
        
        default:
            include 'view/home.php';
    }