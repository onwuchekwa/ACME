<?php 
    $pageTitle = $productInfo['invName'];
    include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php'; 
?>

    <section>            
        <h1><?php echo $productInfo['invName']; ?></h1>
        <p>Product <a href="#bottom" title="go to product reviews">reviews</a> appear at the bottom of the page.</p>
        <?php 
            if(isset($message)){
                echo $message; 
            } 
            
            if(isset($productInfoDisplay)){ 
                echo $productInfoDisplay; 
            }
        
            if(isset($displayThumbNail)){ 
                echo '<hr class="tiny-line" />';
                echo $displayThumbNail; 
            } 
        ?>        
        <hr class="tiny-line" />
    </section>

    <section class="review-form">
        <h2 id="bottom">Customer Reviews</h2>        
    
        <?php 
             if(isset($_SESSION['message'])){
                echo $_SESSION['message']; 
            }

            if(isset($displayCustomerReviewForm)){ 
                echo $displayCustomerReviewForm;  
            } else {
                echo '<p>You must be logged in to review a product. Click <a href="/acme/accounts/index.php?action=login" title="Login to review product">Login</a></p>';
            }                      
        ?>
    </section> 
    <div class="sec-review-display">
        <?php
            if(isset($displayProdReviews)) {
                echo $displayProdReviews;
            } else {
                echo '<p class="review-text">This product has not been reviewed yet.</p>';
            }
        ?>
    </div>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>