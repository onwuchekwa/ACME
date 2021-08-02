<?php 
    if(isset($reviewInfo['invName'])){ 
        $pageTitle = "Delete $productName Review";
    }

    include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php'; 
?>

    <section class="section-wrapper">            
        <h1>
            <?php
                if(isset($productName)){ 
                   echo "Delete $productName Review";
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
                <legend>Delete <?php echo $productName ?> Review</legend>
                <label for="reviewText" class="top">
                    Review Text
                    <textarea name="reviewText" id="reviewText" cols="30" rows="3" readonly><?php echo $textToEdit ?></textarea>
                </label>
                <p class="delete-warning">Once a review is deleted, it cannot be undone</p>
            </fieldset>
            <input type="submit" value="Delete Your Review" class="submitBtn">
            <input type="hidden" name="action" value="deleteReview">
            <input type="hidden" name="reviewId" value="<?php echo $reviewInfo['reviewId']; ?>">
            <input type="hidden" name="categoryName" value="<?php echo $reviewInfo['categoryName']; ?>">
        </form>
    </section>
        
<?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>