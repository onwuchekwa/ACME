<?php
    if (isset($_SESSION['loggedin'])){
        $clientFirstname = $_SESSION['clientData']['clientFirstname'];
        $login_session = $_SESSION['loggedin'];
    }
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Acme Inc. portal for Sunday Ogbonnaya Onwuchekwa in CIT 336: Web Backend Development at Brigham Young University - Idaho">
    <meta name="author" content="Sunday Ogbonnaya Onwuchekwa" />

    <title><?php echo "$pageTitle"; ?></title>

    <link rel="shortcut icon" href="/acme/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/acme/favicon.ico" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Sriracha%7CVollkorn:400,700&display=swap" rel="stylesheet"> 
    <link href="/acme/css/styles.css" rel="stylesheet" media="screen">
</head>

<body>
    <div class="content-wrapper">
    <header>
        <a href="/acme/" title="Redirect to the Home page">
            <img src="/acme/images/site/logo.gif" alt="ACME Company Logo" class="logo">
        </a>
        
        <div class="my-account">
            <?php 
                if (isset($login_session) == TRUE) {
                    echo '<a href="/acme/accounts/" title="View my Profile" class="account-action"><span>Welcome '. $clientFirstname .'</span></a>&nbsp;&nbsp; | &nbsp;&nbsp;<a href="/acme/accounts/index.php?action=logout" title="Logout and return to the home page." class="account-action"><span>Logout</span></a>';
                } else {
                    echo '<a href="/acme/accounts/index.php?action=login" title="Redirect to the My Account" class="account-action"><img src="/acme/images/site/account.gif" alt="ACME Company Logo"><span>My Account</span></a>';
                }
            ?>
        </div>
    </header>

    <?php 
        include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/navigation.php'; 
    ?>
    <main>