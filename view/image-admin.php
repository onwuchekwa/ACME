<?php 
    if (isset($_SESSION['message'])) {
        $message = $_SESSION['message'];
    }

    $pageTitle = "Image Management";

    include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php'; ?>

    <section class="form-container">            
        <h1>Image Management</h1>

        <?php
            if (isset($message)) {
                echo $message;
            }
        ?>

        <form action="/acme/uploads/" method="post" enctype="multipart/form-data">   
            <fieldset>
                <legend>Add New Product Image</legend> 
                <label for="invItem" class="top">
                    Product
                    <?php echo $prodSelect; ?>
                </label> 

                <label for="file1" class="top">
                    Upload Image: 
                    <input type="file" name="file1" id="file1">
                </label>
            </fieldset>
            <input type="submit" value="Upload" class="submitBtn" name="submit">
            <input type="hidden" name="action" value="upload">
        </form>
    </section>

    <section class="image-container">
        <fieldset>
            <legend>Existing Images</legend> 
            <p class="notice">If deleting an image, delete the thumbnail too and vice versa.</p>
            <?php
                if (isset($imageDisplay)) {
                    echo $imageDisplay;
                } 
            ?>
        </fieldset>
    </section>
        
<?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>