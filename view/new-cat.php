<?php
    $pageTitle = 'New Category | Acme Inc.';

     // Checks that a client is "loggedin" AND has a clientLevel greater than "1" to access the view. If not, redirect the client back to the acme controller to deliver the acme home view
    $clientLevel = $_SESSION['clientData']['clientLevel'];

    if ($clientLevel < 2) {
        header('location: /acme/');
        exit;
    }
    
    include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php';    
?>

            <section class="form-container">            
                <h1>Add Category</h1>

                <?php
                    if (isset($message)) {
                        echo $message;
                    }
                ?>

                <form action="/acme/products/" method="post">   
                    <fieldset>
                        <legend>Add a new category of products below</legend>                 
                        <label for="categoryName" class="top">
                            New Category Name 
                            <input type="text" name="categoryName" id="categoryName" <?php if(isset($categoryName)){echo "value='$categoryName'";} ?> required>
                        </label>
                    </fieldset>
                    <input type="submit" name="submit" value="Add Category" class="submitBtn">
                    <input type="hidden" name="action" value="addcat">
                </form>
            </section>
        
<?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>