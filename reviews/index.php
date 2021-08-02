<?php
     /*
        Reviews Controller
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
        case 'addNewReview':
            $reviewText = filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_STRING);
            $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT, FILTER_VALIDATE_INT);
            $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT, FILTER_VALIDATE_INT);
            $categoryName = filter_input(INPUT_POST, 'categoryName', FILTER_SANITIZE_STRING);

            // Check if the fields are empty
            if (empty($reviewText) || empty($invId) || empty($clientId)) {
                $_SESSION['message'] = '<p class="error">Please enter a review for this product.</p>';
                header("location: /acme/products/?action=product-info&invId=$invId&categoryName=$categoryName");
                exit;
            }

            // Send data to the review model
            $reviewOutcome = addReview($invId, $clientId, $reviewText);

            // Check and report result
            if ($reviewOutcome === 1) {
                $_SESSION['message'] = "<p class='success'>Thanks for adding your review.</p>";
                header("location: /acme/products/?action=product-info&invId=$invId&categoryName=$categoryName");
                exit;
            } else {
                $_SESSION['message'] = '<p class="error">An error occurred. Please, try again.</p>';
                header("location: /acme/products/?action=product-info&invId=$invId&categoryName=$categoryName");
                exit;
            }
                
        break;

        case 'deliverEditReview':
            $reviewId = filter_input(INPUT_GET, 'reviewId', FILTER_SANITIZE_NUMBER_INT, FILTER_VALIDATE_INT);
            $reviewInfo = getSpecificReview($reviewId);
            if (count($reviewInfo) < 1) {
                $message = "<p class='error'>Sorry, no review could be found.</p>";
              } else {
                if($_SESSION['clientData']['clientId'] == $reviewInfo['clientId']){
                    $productName = $reviewInfo['invName'];
                    $reviewDate = "Reviewed on ". date('j F, Y', strtotime($reviewInfo['reviewDate']));
                    $textToEdit = $reviewInfo['reviewText'];
                }       
            }    
            include '../view/review-update.php';
            exit;
        break;

        case 'editReview':
            $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT, FILTER_VALIDATE_INT);
            $reviewText = filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_STRING);
            $categoryName = filter_input(INPUT_POST, 'categoryName', FILTER_SANITIZE_STRING);

            if (empty($reviewId) || empty($reviewText)){
                $_SESSION['message'] = "<p class='error'>Review text cannot be empty.</p>";
                header("location: /acme/reviews?action=deliverEditReview&reviewId=$reviewId&categoryName=$categoryName");
                exit;
            }

            $reviewInfo = getSpecificReview($reviewId);
            if($reviewText == $reviewInfo['reviewText']) {
                $_SESSION['message'] = "<p class='error'>You did not make any change(s)</p>";
                header("location: /acme/reviews?action=deliverEditReview&reviewId=$reviewId&categoryName=$categoryName");
                exit;
            } else {
                $updateReviewOutcome = updateClientReview($reviewText, $reviewId);

                if($updateReviewOutcome === 1) {
                    $_SESSION['message'] = "<p class='success'>Your review was updated succesfully.</p>";
                    header("location: /acme/accounts/");
                    exit;
                } else {
                    $_SESSION['message'] = "<p class='error'>An error occurred. Please, try again!</p>";
                    header("location: /acme/reviews?action=deliverEditReview&reviewId=$reviewId&categoryName=$categoryName");
                    exit;
                }
            }
        break;

        case 'deliverDeleteReview':
            $reviewId = filter_input(INPUT_GET, 'reviewId', FILTER_SANITIZE_NUMBER_INT, FILTER_VALIDATE_INT);
            $categoryName = filter_input(INPUT_POST, 'categoryName', FILTER_SANITIZE_STRING);
            $reviewInfo = getSpecificReview($reviewId);
            if (count($reviewInfo) < 1) {
                $message = "<p class='error'>Sorry, no review could be found.</p>";
              } else {
                if($_SESSION['clientData']['clientId'] == $reviewInfo['clientId']){
                    $productName = $reviewInfo['invName'];
                    $reviewDate = "Reviewed on ". date('j F, Y', strtotime($reviewInfo['reviewDate']));
                    $textToEdit = $reviewInfo['reviewText'];
                }  
            }         
            include '../view/review-delete.php';
            exit;
        break;

        case 'deleteReview':
            $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT, FILTER_VALIDATE_INT);
           
            $deleteReviewOutcome = deleteClientReview($reviewId);

            if($deleteReviewOutcome ) {
                $_SESSION['message'] = "<p class='success'>Your review was deleted succesfully.</p>";
                header("location: /acme/accounts/");
                exit;
            } else {
                $_SESSION['message'] = "<p class='error'>An error occurred. Please, try again!</p>";
                header("location: /acme/reviews?action=deliverDeleteReview&reviewId=$reviewId&categoryName=$categoryName");
                exit;
            }
        break;

        default:
            include '../view/admin.php';
        break;
    }