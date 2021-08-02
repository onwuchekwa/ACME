<?php
    /*
        Products Model Controller
    */
    
    // Create or access a Session
    session_start();

    // Get the database connection file
    require_once '../library/connections.php';
    // Get the acme model for use as needed
    require_once '../model/acme-model.php';
    // Get the products model
    require_once '../model/products-model.php';
    // Get the uploads model
    require_once '../model/uploads-model.php';
    // Get the reviews model
    require_once '../model/reviews-model.php';
    // Get the functions library
    require_once '../library/functions.php';


    // Get the array of categories
    $categories = getCategories();

    // Build a navigation bar using the $categories array
    $navList = getNavList($categories);

    $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
    if ($action == NULL){
        $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
    }

    switch ($action){
        case 'new-cat':
            include '../view/new-cat.php';
        break;

        case 'new-prod':
            include '../view/new-prod.php';
        break;

        case 'addcat':
            $categoryName = filter_input(INPUT_POST, 'categoryName', FILTER_SANITIZE_STRING);

            if (empty($categoryName)) {
                $message = '<p class="error">Please provide information for all empty form fields.</p>';
                include '../view/new-cat.php';
                exit;
            }

            $catOutcome = addCategory($categoryName);

            // Check and report the result
            if ($catOutcome === 1) {
                $message = "<p class='success'>Thanks for adding $categoryName!</p>";
                header('location: /acme/products/');
                exit;
            } else {
                $message = "<p class='error'>Sorry, adding $categoryName failed.  Please try again.</p>";
                include '../view/new-cat.php';
                exit;
            }
        break;

        case 'addprod':
            $invName = filter_input(INPUT_POST, 'invName', FILTER_SANITIZE_STRING);
            $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING);
            $invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING);
            $invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING);
            $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT, FILTER_VALIDATE_INT);
            $invSize = filter_input(INPUT_POST, 'invSize', FILTER_SANITIZE_NUMBER_INT, FILTER_VALIDATE_INT);
            $invWeight = filter_input(INPUT_POST, 'invWeight', FILTER_VALIDATE_INT, FILTER_VALIDATE_INT);
            $invLocation = filter_input(INPUT_POST, 'invLocation', FILTER_SANITIZE_STRING);
            $categoryId = filter_input(INPUT_POST, 'categoryId', FILTER_SANITIZE_NUMBER_INT, FILTER_VALIDATE_INT);
            $invVendor = filter_input(INPUT_POST, 'invVendor', FILTER_SANITIZE_STRING);
            $invStyle = filter_input(INPUT_POST, 'invStyle', FILTER_SANITIZE_STRING);

            if (empty($invName) || empty($invDescription) || empty($invImage) || empty($invThumbnail) ||
                    empty($invPrice) || empty($invStock) || empty($invSize) || empty($invWeight) ||
                    empty($invLocation) || empty($categoryId) || empty($invVendor) || empty($invStyle)) {
                $message = '<p class="error">Please provide information for all empty form fields.</p>';
                include '../view/new-prod.php';
                exit;
            }

            if ($invPrice < 1 || $invStock < 1 || $invSize < 1 || $invWeight < 1 ) {
                $message = '<p class="error">Number value for the numeric fields must be greater than zero (0). Try again!</p>';
                include '../view/new-prod.php';
                exit;
            }

            $prodOutcome = addProduct($invName, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invSize, $invWeight, $invLocation, $categoryId, $invVendor, $invStyle);

            // Check and report the result
            if ($prodOutcome === 1) {
                $message = "<p class='success'>Thanks for adding $invName!</p>";
                include '../view/new-prod.php';
                exit;
            } else {
                $message = "<p class='error'>Sorry, $invName was not added.  Please try agian.</p>";
                include '../view/new-prod.php';
                exit;
            }
        break;
        
            /* * ********************************** 
                * Get Inventory Items by categoryId 
                * Used for starting Update & delete process 
                * ********************************** 
            */ 
        case 'getInventoryItems': 
            // Get the categoryId 
            $categoryId = filter_input(INPUT_GET, 'categoryId', FILTER_SANITIZE_NUMBER_INT); 
            // Fetch the products by categoryId from the DB 
            $productsArray = getProductsByCategory($categoryId); 
            // Convert the array to a JSON object and send it back 
            echo json_encode($productsArray); 
        break; 

        case 'mod':
            $invId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
            $prodInfo = getProductInfo($invId);
            if(count($prodInfo) < 1 ){
                $message = 'Sorry, no product information could be found.';
            }
            include '../view/prod-update.php';
            exit;
        break;

        case 'del':
                $invId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
                $prodInfo = getProductInfo($invId);
                if (count($prodInfo) < 1) {
                $message = 'Sorry, no product information could be found.';
            }
            include '../view/prod-delete.php';
            exit;
        break; 

        case 'updateProd':
            $categoryId = filter_input(INPUT_POST, 'categoryId', FILTER_SANITIZE_NUMBER_INT);
            $invName = filter_input(INPUT_POST, 'invName', FILTER_SANITIZE_STRING);
            $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING);
            $invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING);
            $invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING);
            $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT);
            $invSize = filter_input(INPUT_POST, 'invSize', FILTER_SANITIZE_NUMBER_INT);
            $invWeight = filter_input(INPUT_POST, 'invWeight', FILTER_SANITIZE_NUMBER_INT);
            $invLocation = filter_input(INPUT_POST, 'invLocation', FILTER_SANITIZE_STRING);
            $invVendor = filter_input(INPUT_POST, 'invVendor', FILTER_SANITIZE_STRING);
            $invStyle = filter_input(INPUT_POST, 'invStyle', FILTER_SANITIZE_STRING);
            $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);

            if (empty($categoryId) || empty($invName) || empty($invDescription) || empty($invImage) || empty ($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invSize) || empty($invWeight) || empty($invLocation) || empty($invVendor) || empty($invStyle)) {
                $message = '<p class="error">Please complete all information for the updated item! Double check the category of the item.</p>';
                include '../view/prod-update.php';
                exit;
            }

            $updateResult = updateProduct($categoryId, $invName, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invSize, $invWeight, $invLocation, $invVendor, $invStyle, $invId);

            if ($updateResult) {
                $message = "<p class='success'>Congratulations, $invName was successfully updated.</p>";
                $_SESSION['message'] = $message;
                header('location: /acme/products/');
                exit;
            } else {
                $message = "<p class='error'>Error. The new product was not updated.</p>";
                include '../view/prod-update.php';
                exit;
            }
        break;

        case 'deleteProd':
            $invName = filter_input(INPUT_POST, 'invName', FILTER_SANITIZE_STRING);
            $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
                  
            $deleteResult = deleteProduct($invId);
            if ($deleteResult) {
                $message = "<p class='success'>Congratulations, $invName was successfully deleted.</p>";
                $_SESSION['message'] = $message;
                header('location: /acme/products/');
                exit;
            } else {
                $message = "<p class='notice'>Error: $invName was not deleted.</p>";
                $_SESSION['message'] = $message;
                header('location: /acme/products/');
                exit;
            }
        break;

        case 'category':
            // filter, sanitize and store the second value being sent through the URL
            $categoryName = filter_input(INPUT_GET, 'categoryName', FILTER_SANITIZE_STRING);
            // create a variable to store the array of products we hope will be returned from the products model
            $products = getProductsByCategoryName($categoryName);
            // an if - else control structure will be built to see if products were actually returned or not. If "No" then an error message will be built. If "Yes" then the array of products will be sent to custom function to build the HTML around the products and return it to us for display
            if(!count($products)) {
                $message = "<p class='notice'>Sorry, no $categoryName products could be found.</p>";
            } else {
                $prodDisplay = buildProductsDisplay($products);
            }
            include '../view/category.php';
        break;

        case 'product-info':
            $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
            $productInfo = getProductInfo($invId);
            $productImageThumbNail = getProductThumbnails($invId);
            $prodReviews = getSpecificInventoryReview($invId);
            if(!count($productInfo)){
                $message = "<p class='notice'>Sorry, no $invName products could be found.</p>";
            } else {
                $productInfoDisplay = buildProductInformationDisplay($productInfo);
                $displayThumbNail = buildThumbNails($productImageThumbNail); 
                if (isset($_SESSION['loggedin']))            
                    $displayCustomerReviewForm = buildCustomerReviewForm($productInfo);
                if(count($prodReviews) > 0)
                    $displayProdReviews = buildProductReviewDisplay($prodReviews);
                include '../view/product-details.php';
            }
        break;

        default:
            $categoryList = buildCategoryList($categories);
            include '../view/prod-mgmt.php';
        break;
    }
