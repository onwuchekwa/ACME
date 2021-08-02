<?php
     // Checks that a client is "loggedin" AND has a clientLevel greater than "1" to access the view. If not, redirect the client back to the acme controller to deliver the acme home view
    $clientLevel = $_SESSION['clientData']['clientLevel'];

    if ($clientLevel < 2) {
        header('location: /acme/');
        exit;
    }

    if (isset($_SESSION['message'])) {
        $message = $_SESSION['message'];
    }
 
    $pageTitle = 'Product Management | Acme Inc.';
    include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php'; 
?>

    <section class="section-wrapper">     
                
        <h1>Product Management</h1>
        <p>Welcome to the product management page.  Please chose an option:</p>

        <ul>
            <li><a href="/acme/products/index.php?action=new-cat">Add a new category</a></li>  
            <li><a href="/acme/products/index.php?action=new-prod">Add a new product</a></li> 
        </ul>

        <form>
            <?php
                $tableContent = '<h2>Products By Category</h2>';
                $tableContent .= '<fieldset>';
                $tableContent .= '<legend>Choose a category to see those products</legend>';
                $tableContent .= '<label for="categoryList" class="top">Category';
                $tableContent .= $categoryList;
                $tableContent .= '</label><br><noscript>';
                $tableContent .= '<p><strong>JavaScript Must Be Enabled to Use this Page.</strong></p></noscript>';
                $tableContent .= '<table id="productsDisplay"></table>';
                $tableContent .= '</fieldset>';
                
                if (isset($message)) { 
                    echo $message; 
                } 

                if (isset($categoryList)) { 
                    echo $tableContent;
                }
            ?>
        </form>
    </section>
        
<?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>