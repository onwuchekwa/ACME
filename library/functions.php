<?php

// Check if Email Address is valid
function checkEmail($clientEmail){
    $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
    return $valEmail;
}

// Check the password for a minimum of 8 characters,
// at least one 1 capital letter, at least 1 number and
// at least 1 special character
function checkPassword($clientPassword){
    $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]])(?=.*[A-Z])(?=.*[a-z])([^\s]){8,}$/';
    return preg_match($pattern, $clientPassword);
}

function getNavList($categories) {
    // Build a navigation bar using the $categories array
    $navList = '<ul id="navMenu">';
    $navList .= "<li class='mainMenu active'><a href='/acme/' title='View the Acme home page'>Home</a></li>";
    foreach ($categories as $category) {
        $navList .= "<li class='mainMenu'><a href='/acme/products/?action=category&categoryName=".urlencode($category['categoryName'])."' title='View our $category[categoryName] product line'>$category[categoryName]</a></li>";
    }
    $navList .= '</ul>';
    return $navList;  
}

// Build the categories select list 
function buildCategoryList($categories) {
    $catList = '<select name="categoryId" id="categoryList">'; 
    $catList .= "<option selected disabled value=''>Choose a Category</option>"; 
    foreach ($categories as $category) { 
    $catList .= "<option value='$category[categoryId]'>$category[categoryName]</option>"; 
    } 
    $catList .= '</select>'; 
    return $catList; 
}

// Get products by categoryId 
function getProductsByCategory($categoryId) {
    $db = acmeConnect(); 
    $sql = ' SELECT * FROM inventory WHERE categoryId = :categoryId'; 
    $stmt = $db->prepare($sql); 
    $stmt->bindValue(':categoryId', $categoryId, PDO::PARAM_INT); 
    $stmt->execute(); 
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC); 
    $stmt->closeCursor(); 
    return $products; 
}

// Builds a display of products within an unordered list
function buildProductsDisplay($products){
    $pd = '<ul id="prod-display">';
    foreach ($products as $product) {
        $pd .= '<li>';
        $pd .= '<a class="product-container" href="/acme/products/?action=product-info&invId='.$product['invId'].'&categoryName='.$product['categoryName'].'" title="Click to view this product">';
        $pd .= "<img src='$product[invThumbnail]' alt='Image of $product[invName] on Acme.com'>";
        $pd .= '<hr class="separator">';
        $pd .= "<h2>$product[invName]</h2>";
        $pd .= "<span>$".number_format($product['invPrice'], 2)."</span>";
        $pd .= "</a>";
        $pd .= '</li>';
    }
    $pd .= '</ul>';
    return $pd;
}

//Builds product information Display
function buildProductInformationDisplay($productInfo){
    $pd = '<div class="products">';
    $pd .= '<div class="product-card">';
    $pd .= '<div class="text-container">';
    $pd .= "<p>produced by: <span class='vendor'>$productInfo[invVendor]</span></p>";
    $pd .= "<h3>Price: $".number_format($productInfo['invPrice'], 2)."</h3>";
    $pd .= "<p class='product-stock'>";
    if ($productInfo['invStock'] < 10) {
        $pd .= "<span class='notice'>Only $productInfo[invStock] left. Order soon!</span></p>";
    } else {
        $pd .= "<span class='success'>$productInfo[invStock] items in stock!</span></p>";
    }
    $pd .= "<p class='prod-discription'>$productInfo[invDescription]<br/>";
    $pd .= "Ships from : <span class='vendor'>$productInfo[invLocation]</span><br/><br/>";
    $pd .= "<span class='prod-feature'>Size: $productInfo[invSize] inches (w x h x l) </span><br/>";
    $pd .= "<span class='prod-feature'>Weight: $productInfo[invWeight] lbs</span><br/>";
    $pd .= "<span class='prod-feature'>Made of $productInfo[invStyle]</span></p>";
    $pd .= '</div>';
    $pd .= "<img src='$productInfo[invImage]' alt='An image showing the ACME $productInfo[invName]'>";
    $pd .= '</div>';
    $pd .= '</div>';
    return $pd;
}

/* * ********************************
*  Functions for working with images
* ********************************* */

// Adds "-tn" designation to file name
function makeThumbnailName($image) {
    $i = strrpos($image, '.');
    $image_name = substr($image, 0, $i);
    $ext = substr($image, $i);
    $image = $image_name . '-tn' . $ext;
    return $image;
}

// Build images display for image management view
function buildImageDisplay($imageArray) {
    $id = '<ul id="image-display">';
    foreach ($imageArray as $image) {
        $id .= '<li>';
        $id .= "<img src='$image[imgPath]' title='$image[invName] image on Acme.com' alt='$image[invName] image on Acme.com'>";
        $id .= "<p><a href='/acme/uploads?action=delete&imgId=$image[imgId]&filename=$image[imgName]' title='Delete the image'>Delete $image[imgName]</a></p>";
        $id .= '</li>';
    }
    $id .= '</ul>';
    return $id;
}

// Build the products select list
function buildProductsSelect($products) {
    $prodList = '<select name="invId" id="invId" required>';
    $prodList .= "<option selected disabled value=''>Choose a Product</option>";
    foreach ($products as $product) {
        $prodList .= "<option value='$product[invId]'>$product[invName]</option>";
    }
    $prodList .= '</select>';
    return $prodList;
}

// Handles the file upload process and returns the path
// The file path is stored into the database
function uploadFile($name) {
    // Gets the paths, full and local directory
    global $image_dir, $image_dir_path;
    if (isset($_FILES[$name])) {
        // Gets the actual file name
        $filename = $_FILES[$name]['name'];
        if (empty($filename)) {
            return;
        }
        // Get the file from the temp folder on the server
        $source = $_FILES[$name]['tmp_name'];
        // Sets the new path - images folder in this directory
        $target = $image_dir_path . '/' . $filename;
        // Moves the file to the target folder
        move_uploaded_file($source, $target);
        // Send file for further processing
        processImage($image_dir_path, $filename);
        // Sets the path for the image for Database storage
        $filepath = $image_dir . '/' . $filename;
        // Returns the path where the file is stored
        return $filepath;
    }
}

// Processes images by getting paths and 
// creating smaller versions of the image
function processImage($dir, $filename) {
    // Set up the variables
    $dir = $dir . '/';
   
    // Set up the image path
    $image_path = $dir . $filename;
   
    // Set up the thumbnail image path
    $image_path_tn = $dir.makeThumbnailName($filename);
   
    // Create a thumbnail image that's a maximum of 200 pixels square
    resizeImage($image_path, $image_path_tn, 200, 200);
   
    // Resize original to a maximum of 500 pixels square
    resizeImage($image_path, $image_path, 500, 500);
}

// Checks and Resizes image
function resizeImage($old_image_path, $new_image_path, $max_width, $max_height) {
     
    // Get image type
    $image_info = getimagesize($old_image_path);
    $image_type = $image_info[2];
   
    // Set up the function names
    switch ($image_type) {
        case IMAGETYPE_JPEG:
            $image_from_file = 'imagecreatefromjpeg';
            $image_to_file = 'imagejpeg';
        break;

        case IMAGETYPE_GIF:
            $image_from_file = 'imagecreatefromgif';
            $image_to_file = 'imagegif';
        break;

        case IMAGETYPE_PNG:
            $image_from_file = 'imagecreatefrompng';
            $image_to_file = 'imagepng';
        break;

        default:
            return;
   } // ends the resizeImage function
   
    // Get the old image and its height and width
    $old_image = $image_from_file($old_image_path);
    $old_width = imagesx($old_image);
    $old_height = imagesy($old_image);
   
    // Calculate height and width ratios
    $width_ratio = $old_width / $max_width;
    $height_ratio = $old_height / $max_height;
   
    // If image is larger than specified ratio, create the new image
    if ($width_ratio > 1 || $height_ratio > 1) {
   
        // Calculate height and width for the new image
        $ratio = max($width_ratio, $height_ratio);
        $new_height = round($old_height / $ratio);
        $new_width = round($old_width / $ratio);
    
        // Create the new image
        $new_image = imagecreatetruecolor($new_width, $new_height);
   
        // Set transparency according to image type
        if ($image_type == IMAGETYPE_GIF) {
            $alpha = imagecolorallocatealpha($new_image, 0, 0, 0, 127);
            imagecolortransparent($new_image, $alpha);
        }
    
        if ($image_type == IMAGETYPE_PNG || $image_type == IMAGETYPE_GIF) {
            imagealphablending($new_image, false);
            imagesavealpha($new_image, true);
        }
    
        // Copy old image to new image - this resizes the image
        $new_x = 0;
        $new_y = 0;
        $old_x = 0;
        $old_y = 0;
        imagecopyresampled($new_image, $old_image, $new_x, $new_y, $old_x, $old_y, $new_width, $new_height, $old_width, $old_height);
    
        // Write the new image to a new file
        $image_to_file($new_image, $new_image_path);
        // Free any memory associated with the new image
        imagedestroy($new_image);
     } else {
        // Write the old image to a new file
        $image_to_file($old_image, $new_image_path);
     }
     // Free any memory associated with the old image
     imagedestroy($old_image);
} // ends the if - else began on line 36

// Build Thumbnails to be displays in the Product Details
function buildThumbNails($productThumbNails) {
    $id = '<h2>Product Thumbnails</h2>';
    $id .= '<ul id="image-display">';
    foreach ($productThumbNails as $image) {
    $id .= '<li>';
    $id .= "<img src='$image[imgPath]' title='$image[imgName] image on Acme.com' alt='$image[imgName] image on Acme.com'>";
    $id .= '</li>';
    }
    $id .= '</ul>';
    return $id;
  }

  //Build customer review form
  function buildCustomerReviewForm($productData) {
    $screenName = substr($_SESSION['clientData']['clientFirstname'], 0, 1) . $_SESSION['clientData']['clientLastname'];
    $rd = '<form action="/acme/reviews/" method="post">';
    $rd .= '<fieldset>';
    $rd .= '<legend>Review the '.$productData['invName'].'</legend>';
    $rd .= '<label for="screenName" class="top">Screen Name';
    $rd .= '<input type="text" name="screenName" id="screenName" value="'.$screenName.'" readonly>';
    $rd .= '</label>';
    $rd .= '<label for="reviewText" class="top">Review';
    $rd .= '<textarea name="reviewText" id="reviewText" cols="30" rows="3" placeholder="Leave a product review" required></textarea>';
    $rd .= '</label>';
    $rd .= '</fieldset>';
    $rd .= '<input type="submit" value="Add Your Review" class="submitBtn">';
    $rd .= '<input type="hidden" name="action" value="addNewReview">';
    $rd .= '<input type="hidden" name="invId" value="'.$productData['invId'].'">';
    $rd .= '<input type="hidden" name="categoryName" value="'.$productData['categoryName'].'">';
    $rd .= '<input type="hidden" name="clientId" value="'.$_SESSION['clientData']['clientId'].'">';
    $rd .= '</form>';
    return $rd;
  }

  // Build product review display
  function buildProductReviewDisplay($displayReviews) { 
      $dr = '<ul id="display-review">';
      foreach($displayReviews as $displayReview){
        $reviewDate = date('j F, Y', strtotime($displayReview['reviewDate']));
        $screenName = substr($displayReview['clientFirstname'], 0, 1) . $displayReview['clientLastname'];
        $dr .= '<li>';
        $dr .= '<span class="bold-screen-name">'.$screenName;
        $dr .= '</span> <span class="wrote">wrote on '.$reviewDate. ':</span>';
        $dr .= '<span class="review-text">'.$displayReview['reviewText'];
        $dr .= '</span>';
        $dr .= '</li>';
      }  
      $dr .= '</ul>';
      return $dr;
  }

  function  buildReviewByClient($clientReviews) {
    $rl = "<ul id='client-review'>";
      foreach($clientReviews as $clientReview) {
        $reviewedDate = date("j F, Y", strtotime($clientReview['reviewDate']));
          $rl .= '<li>';
          $rl .= "<span class='prod-name'>$clientReview[invName]";
          $rl .= "</span> (Reviewed on $reviewedDate): ";
          $rl .= "<a href='/acme/reviews?action=deliverEditReview&reviewId=$clientReview[reviewId]&categoryName=$clientReview[categoryName]' title='Click to edit review'>Edit</a>";
          $rl .= " | ";
          $rl .= "<a href='/acme/reviews?action=deliverDeleteReview&reviewId=$clientReview[reviewId]&categoryName=$clientReview[categoryName]' title='Click to delete review'>Delete</a>";
          $rl .= "</li>";
      }
      $rl .= "</ul>";
      return $rl;
  }
  