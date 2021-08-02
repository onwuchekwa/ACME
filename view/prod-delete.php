<?php
    // Checks that a client is "loggedin" AND has a clientLevel greater than "1" to access the view. If not, redirect the client back to the acme controller to deliver the acme home view
    $clientLevel = $_SESSION['clientData']['clientLevel'];

    if ($clientLevel < 2) {
        header('location: /acme/');
        exit;
    }
    
    if(isset($prodInfo['invName'])){ 
        $pageTitle = "Delete $prodInfo[invName]";
    } elseif(isset($invName)) { 
        $pageTitle = $invName; 
    }
    $pageTitle .= " | ACME Inc.";
?>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php'; ?>

    <section class="form-container">            
        <h1>
            <?php 
                if(isset($prodInfo['invName'])) { 
                    echo "Delete $prodInfo[invName]";
                } elseif(isset($invName)) { 
                    echo $invName; 
                }
            ?>
        </h1>

        <?php
            if (isset($message)) {
                echo $message;
            }
        ?>

        <form action="/acme/products/" method="post">   
            <fieldset>
                <legend>Confirm if this is the correct product to be deleted because the delete cannot be undone</legend> 
                <label for="invName" class="top">
                    Product Name 
                    <input type="text" name="invName" id="invName" <?php if(isset($prodInfo['invName'])) {echo "value='$prodInfo[invName]'"; }?> placeholder="Product Name" maxlength="50" readonly>
                </label>

                <label for="invDescription" class="top">
                    Product Description
                    <textarea name="invDescription" id="invDescription" cols="30" rows="3" placeholder="Product Description" readonly><?php if(isset($prodInfo['invDescription'])) {echo $prodInfo['invDescription']; } ?></textarea>
                </label>  
            </fieldset>
            <input type="submit" value="Delete Product" class="submitBtn" name="submit">
            <input type="hidden" name="action" value="deleteProd">
            <input type="hidden" name="invId" value="<?php if(isset($prodInfo['invId'])){ echo $prodInfo['invId'];} ?>">
        </form>
    </section>
        
<?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>