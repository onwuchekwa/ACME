<?php 
    $pageTitle = $categoryName. " Products | Acme, Inc.";
    include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php'; 
?>

    <section>            
        <h1><?php echo $categoryName; ?> Products</h1>
        <?php 
            if(isset($message)){
                echo $message; 
            } 

            if(isset($prodDisplay)){ 
                echo $prodDisplay;
            }
        ?>
    </section>
        
<?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>