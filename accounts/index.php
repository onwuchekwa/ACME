<?php
    /*
        Accounts Controller
    */

    // Create or access a Session
    session_start();

    // Get the database connection file
    require_once '../library/connections.php';
    // Get the acme model for use as needed
    require_once '../model/acme-model.php';
    // Get the accounts model
    require_once '../model/accounts-model.php';
    // Get the reviews model
    require_once '../model/reviews-model.php';
    // Get the functions library
    require_once '../library/functions.php';


    // Get the array of categories
    $categories = getCategories();

    // Build a navigation bar using the $categories array
    $navList = getNavList($categories);

    $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
    if ($action == NULL){
        $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
    }

    switch ($action){
        case 'login':
            include '../view/login.php';
        break; 

        case 'logout':
            session_destroy();
            header('Location: /acme/');
        
            setcookie('firstname', '', strtotime('-1 year'), '/');
            exit;
        break;

        case 'registration':            
            include '../view/registration.php';
        break;

        case 'updateClientView':
            include '../view/client-update.php';
            exit;
        break;

        case 'register':
            // Filter and store the data
            $clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING);
            $clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING);
            $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
            $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);

            // Call the validation functions
            $clientEmail = checkEmail($clientEmail);
            $checkPassword = checkPassword($clientPassword);

            // Call the checkExistingEmail function
            $existingEmail = checkExistingEmail($clientEmail);

            // Check for existing email address in the table
            if($existingEmail){
                $message = '<p class="notice">That email address already exists. Do you want to login instead?</p>';
                include '../view/login.php';
                exit;
            }

            // Check for missing data
            if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)) {
                $message = '<p class="error">Please provide information for all empty form fields.</p>';
                include '../view/registration.php';
                exit; 
            }

            // Hash the checked password
            $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

            // Send the data to the model
            $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);

            // Check and report the result
            if($regOutcome === 1){
                setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
                $message = "<p class='success'>Thanks for registering, $clientFirstname. Please use your email and password to login.</p>";
                include '../view/login.php';
                exit;
            } else {
                $message = "<p class='error'>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
                include '../view/registration.php';
                exit;
            }

        break;

        case 'SignIn':
            // Filter and store the data
            $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
            $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);

            // Call the validation functions
            $clientEmail = checkEmail($clientEmail);
            $checkPassword = checkPassword($clientPassword);

            // Run basic checks, return if errors
            if(empty($clientEmail) || empty($checkPassword)) {
                $message = '<p class="error">Please provide a valid email address and password.</p>';
                include '../view/login.php';
                exit; 
            }

            // A valid password exists, proceed with the login process
            // Query the client data based on the email address
            $clientData = getClient($clientEmail);
            // Compare the password just submitted against
            // the hashed password for the matching client
            $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);
            // If the hashes don't match create an error
            // and return to the login view
            if (!$hashCheck) {
                $message = '<p class="notice">Please check your password and try again.</p>';
                include '../view/login.php';
                exit; 
            }

            // A valid user exists, log them in
            $_SESSION['loggedin'] = TRUE;
            // Delete cookie at login
            setcookie('firstname', '', strtotime('-1 year'), '/');
            // Remove the password from the array
            // the array_pop function removes the last
            // element from an array
            array_pop($clientData);
            // Store the array into the session
            $_SESSION['clientData'] = $clientData;            
            // Send them to the admin view
            header("location: /acme/accounts/");
            exit;
        break;

        case 'updateClientInfo':
             // Filter and store the data
             $clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING);
             $clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING);
             $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
             $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
 
             // Call the validation functions
             $clientEmail = checkEmail($clientEmail);
 
             // Call the checkExistingEmail function
             $existingEmail = checkExistingEmail($clientEmail);
 
             // Check if the email address is different than the one in the session
             if($clientEmail != $_SESSION['clientData']['clientEmail']){
                 // Check for existing email address in the table
                if($existingEmail){
                    $message = '<p class="notice">That email address already exists.</p>';
                    include '../view/client-update.php';
                    exit;
                }
            }
 
             // Check for missing data
             if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail)) {
                 $message = '<p class="error">Please provide information for all empty form fields.</p>';
                 include '../view/client-update.php';
                 exit; 
             }
                     
             // Send the data to the model
             $updateInfoOutcome = updateClientInfo($clientFirstname, $clientLastname, $clientEmail, $clientId);

             // Query the client data based on the ID
             $clientData = getClientId($clientId);   
 
             // Check and report the result
             if($updateInfoOutcome === 1){
                 $message = "<p class='success'>Your data has been updated.</p>";
                 $_SESSION['message'] = $message;
                 // Remove the password from the array
                 // the array_pop function removes the last
                 // element from an array
                 array_pop($clientData);            
                 $_SESSION['clientData'] = $clientData;
                 //include '../view/admin.php';
                 header('location: /acme/accounts/'); 
                 exit;
             } else {
                 $message = "<p class='error'>Your data update failed. Please try again.</p>";
                 header('location: /acme/accounts/');
                 exit;
             }
 
        break;

        case 'updateClientPassword':            
            // Filter and store the data
            $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
            $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);

            // Call the validation functions
            $checkPassword = checkPassword($clientPassword);

            // Check for missing data
            if(empty($checkPassword)) {
                $message = '<p class="error">Please provide information for all empty form fields.</p>';
                include '../view/client-update.php';
                exit; 
            }

            // Hash the checked password
            $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

            // Send the data to the model
            $updatePwdOutcome = updateClientPassword($hashedPassword, $clientId);

            // Check and report the result
            if($updatePwdOutcome === 1){
                $message = "<p class='success'>Your password has been updated</p>";
                $_SESSION['message'] = $message;
                header('location: /acme/accounts/');
                exit;
            } else {
                $message = "<p class='error'>Sorry, update of your password failed. Please try again.</p>";
                $_SESSION['message'] = $message;
                header('location: /acme/accounts/');
                exit;
            }
        break;

        default:
            $clientId = $_SESSION['clientData']['clientId'];
            $clientReviewData = getReviewByClient($clientId);
            if (count($clientReviewData) > 0) 
                $displayClientReviews = buildReviewByClient($clientReviewData);
            include '../view/admin.php';
            exit;
        break;
       }