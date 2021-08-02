<?php
    $pageTitle = 'Admin Home | Acme Inc.';
    if (!$_SESSION['loggedin']) {
        header("location: /acme/");
    }

    $clientFirstname = $_SESSION['clientData']['clientFirstname'];
    $clientLastname = $_SESSION['clientData']['clientLastname'];
    $clientEmail = $_SESSION['clientData']['clientEmail'];
    $clientLevel = $_SESSION['clientData']['clientLevel'];

    if (isset($_SESSION['message'])) {
        $message = $_SESSION['message'];
    }
?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php'; ?>

            <section>            
                <h1><?php echo $clientFirstname . ' '. $clientLastname; ?></h1>
                <?php 
                    if (isset($_SESSION['message'])) {
                        echo $_SESSION['message'];
                    } elseif (isset($message)) {
                        echo $message;
                    } 
                ?>
                <p>You are logged in.</p>
                <ul>
                    <li>First Name: <?php echo $clientFirstname; ?></li>
                    <li>Last Name: <?php echo $clientLastname; ?></li>
                    <li>Email: <?php echo $clientEmail; ?></li>
                </ul>

                <a class="product-management" href="/acme/accounts/index.php?action=updateClientView" title="Update Account Information">Update Account Information</a>

                <?php
                    if($clientLevel > 1){
                    echo '<h2>Administrative Functions</h2>';
                    echo '<p>Use the link below to manage products.</p>';
                    echo '<p><a class="product-management" title="Manage Products" href="/acme/products/">Manage Products</a></p>';
                    }

                    if (isset($displayClientReviews)) {
                        echo '<h2>Manage Your Product Reviews</h2>';
                        echo $displayClientReviews;
                    }
                ?>
                
            </section>
        
<?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>