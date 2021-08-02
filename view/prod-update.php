<?php
    // Checks that a client is "loggedin" AND has a clientLevel greater than "1" to access the view. If not, redirect the client back to the acme controller to deliver the acme home view
    $clientLevel = $_SESSION['clientData']['clientLevel'];

    if ($clientLevel < 2) {
        header('location: /acme/');
        exit;
    }
    // Dynamically generate Sticky Category List
    $categoryList = "<select id='categoryId' name='categoryId' required>";
    $categoryList .= "<option selected disabled value=''>Select a Category</option>";
    foreach($categories as $category){
        $categoryList .= "<option id='$category[categoryId]' value='$category[categoryId]'";
        if(isset($categoryId)){
            if($category['categoryId'] === $categoryId){
                $categoryList .= ' selected ';
            }
        } elseif(isset($prodInfo['categoryId'])){
            if($category['categoryId'] === $prodInfo['categoryId']){
                $categoryList .= ' selected ';
            }
        }
        $categoryList .= ">$category[categoryName]</option>";
    }
    $categoryList .= "</select>";

    if(isset($prodInfo['invName'])){ 
        $pageTitle = "Modify $prodInfo[invName]";
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
                    echo "Modify $prodInfo[invName]";
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
                <legend>Modify the product below. All fields are required</legend> 
                <label for="categoryId" class="top">
                    Category
                    <?php echo $categoryList; ?>
                </label> 

                <label for="invName" class="top">
                    Product Name 
                    <input type="text" name="invName" id="invName" <?php if(isset($invName)){echo "value='$invName'";} elseif(isset($prodInfo['invName'])) { echo "value='$prodInfo[invName]'"; } ?> required placeholder="Product Name" maxlength="50">
                </label>

                <label for="invDescription" class="top">
                    Product Description
                    <textarea name="invDescription" id="invDescription" cols="30" rows="3" placeholder="Product Description" required><?php if(isset($invDescription)){echo $invDescription;} elseif(isset($prodInfo['invDescription'])) { echo $prodInfo['invDescription']; } ?></textarea>
                </label>  

                <label for="invImage" class="top">
                    Product Path (path to image) 
                    <input type="text" name="invImage" id="invImage" required placeholder="Product Path (path to image)" <?php if(isset($invImage)){echo "value='$invImage'";} elseif(isset($prodInfo['invImage'])) { echo "value='$prodInfo[invImage]'"; } ?> maxlength="50">
                </label>

                <label for="invThumbnail" class="top">
                    Product Thumbnail (path to thumbnail)
                    <input type="text" name="invThumbnail" id="invThumbnail" required placeholder="Product Thumbnail (path to thumbnail)" <?php if(isset($invThumbnail)){echo "value='$invThumbnail'";} elseif(isset($prodInfo['invThumbnail'])) { echo "value='$prodInfo[invThumbnail]'"; } ?> maxlength="50">
                </label>

                <label for="invPrice" class="top">
                    Product Price 
                    <input type="number" name="invPrice" id="invPrice" min="0" step="0.01" <?php if(isset($invPrice)){echo "value='$invPrice'";} elseif(isset($prodInfo['invPrice'])) { echo "value='$prodInfo[invPrice]'"; } ?> required maxlength="10">
                </label>

                <label for="invStock" class="top">
                    # in Stock
                    <input type="number" name="invStock" id="invStock" min="0" <?php if(isset($invStock)){echo "value='$invStock'";} elseif(isset($prodInfo['invStock'])) { echo "value='$prodInfo[invStock]'"; } ?> required maxlength="6">
                </label>  
                                
                <label for="invSize" class="top">
                    Shipping Size (W x H x L in inches)
                    <input type="number" name="invSize" id="invSize" min="0" <?php if(isset($invSize)){echo "value='$invSize'";} elseif(isset($prodInfo['invSize'])) { echo "value='$prodInfo[invSize]'"; } ?> required maxlength="6">
                </label>
                                
                <label for="invWeight" class="top">
                    Weight (lbs.)
                    <input type="number" name="invWeight" id="invWeight" min="0" <?php if(isset($invWeight)){echo "value='$invWeight'";} elseif(isset($prodInfo['invWeight'])) { echo "value='$prodInfo[invWeight]'"; } ?> required maxlength="6">
                </label>

                <label for="invLocation" class="top">
                    Location (city name)
                    <input type="text" name="invLocation" id="invLocation" <?php if(isset($invLocation)){echo "value='$invLocation'";} elseif(isset($prodInfo['invLocation'])) { echo "value='$prodInfo[invLocation]'"; } ?> required placeholder="Location (city name)" maxlength="35">
                </label>

                <label for="invVendor" class="top">
                    Product Vendor 
                    <input type="text" name="invVendor" id="invVendor" <?php if(isset($invVendor)){echo "value='$invVendor'";} elseif(isset($prodInfo['invVendor'])) { echo "value='$prodInfo[invVendor]'"; } ?> required placeholder="Product Vendor" maxlength="20">
                </label>

                <label for="invStyle" class="top">
                    Primary Material
                    <input type="text" name="invStyle" id="invStyle" <?php if(isset($invStyle)){echo "value='$invStyle'";} elseif(isset($prodInfo['invStyle'])) { echo "value='$prodInfo[invStyle]'"; } ?> required placeholder="Primary Material" maxlength="20">
                </label>
            </fieldset>
            <input type="submit" value="Update Product" class="submitBtn" name="submit">
            <input type="hidden" name="action" value="updateProd">
            <input type="hidden" name="invId" value="<?php if(isset($prodInfo['invId'])){ echo $prodInfo['invId'];} elseif(isset($invId)){ echo $invId; } ?>">
        </form>
    </section>
        
<?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>