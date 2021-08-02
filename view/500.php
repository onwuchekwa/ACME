<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Acme Inc. portal for Sunday Ogbonnaya Onwuchekwa in CIT 336: Web Backend Development at Brigham Young University - Idaho">

    <title>Error 500 | ACME Inc.</title>

    <link rel="shortcut icon" href="/acme/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
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
            <a href="/" title="Redirect to the My Account">
                <img src="/acme/images/site/account.gif" alt="ACME Company Logo"><span>&nbsp;My Account</span>
            </a>
        </div>
    </header>

    <nav>
        <input type="checkbox" id="menu-area">
        <label for="menu-area" onclick="">Menu</label>
        <ul>
            <li class="active"><a href="#" title="home" class="active">Home</a></li>
            <li><a href="#" title="cannon">Cannon</a></li>
            <li><a href="#" title="explosive">Explosive</a></li>
            <li><a href="#" title="misc">Misc</a></li>
            <li><a href="#" title="rocket">Rocket</a></li>
            <li><a href="#" title="trap">Trap</a></li>
        </ul>
    </nav>
    
    <main>

            <section>            
                <h1>Server Error</h1>
                <p>Sorry, the server experienced a problem.</p>
            </section>
                  
<?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>