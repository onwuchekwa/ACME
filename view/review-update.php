<?php 
    if(isset($reviewInfo['invName'])){ 
        $pageTitle = "$productName Review";
    }

    include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php'; 
?>

    <section class="section-wrapper">            
        <h1>
            <?php
                if(isset($productName)){ 
                   echo "$productName Review";
                }
            ?>
        </h1>
        <p><?php echo $reviewDate; ?></p>

        <?php
            if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
            } elseif (isset($message)) {
                echo $message;
            }
        ?>

        <form action="/acme/reviews/" method="post">
            <fieldset>
                <legend>Modify <?php echo $productName ?></legend>
                <label for="reviewText" class="top">
                    Review Text
                    <textarea name="reviewText" id="reviewText" cols="30" rows="3" placeholder="Leave a product review" required><?php echo $textToEdit ?></textarea>
                </label>
            </fieldset>
            <input type="submit" value="Edit Your Review" class="submitBtn">
            <input type="hidden" name="action" value="editReview">
            <input type="hidden" name="reviewId" value="<?php echo $reviewInfo['reviewId']; ?>">
            <input type="hidden" name="categoryName" value="<?php echo $reviewInfo['categoryName']; ?>">
        </form>
    </section>
        
<?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>