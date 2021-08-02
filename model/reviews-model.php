<?php

    // Insert a review
    function addReview($invId, $clientId, $reviewText) {
        // Create a connection object from the acme connection function
        $db = acmeConnect();
        // The SQL statement
        $sql = 'INSERT INTO reviews (reviewText, invId, clientId) VALUES (:reviewText, :invId, :clientId)';
        // Create the prepared statement using the acme connection
        $stmt = $db->prepare($sql);
        // The next three lines replace the placeholders in the SQL
        // statement with the actual values in the variables
        // and tells the database the type of data it is
        $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
        $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
        $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
        // Insert the data
        $stmt->execute();
        // Ask how many rows changed as a result of our insert
        $rowsChanged = $stmt->rowCount();
        // Close the database interaction
        $stmt->closeCursor();
        // Return the indication of success (rows changed)
        return $rowsChanged;
    }

    // Get reviews for a specific inventory item
    function getSpecificInventoryReview($invId) {
        // Create a connection object from the acme connection function
        $db = acmeConnect();
        // The SQL statement
        $sql = 'SELECT clientFirstname, clientLastname, reviewText, reviewDate FROM reviews r JOIN clients c ON r.clientId = c.clientId WHERE invId = :invId ORDER BY reviewDate DESC';
        // Create the prepared statement using the acme connection
        $stmt = $db->prepare($sql);
        // The next line replace the placeholders in the SQL
        // statement with the actual values in the variables
        // and tells the database the type of data it is
        $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
        // Get the data
        $stmt->execute();
        $prodReviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // Close the database interaction
        $stmt->closeCursor();
        // Return the indication of success
        return $prodReviews;
    }

    // Get reviews written by a specific client
    function getReviewByClient($clientId) {
        // Create a connection object from the acme connection function
        $db = acmeConnect();
        // The SQL statement
        $sql = 'SELECT invName, reviewId, reviewDate, categoryName FROM clients c JOIN reviews r ON c.clientId = r.clientId JOIN inventory i ON r.invId = i.invId JOIN categories ct ON i.categoryId = ct.categoryId WHERE r.clientId = :clientId ORDER BY reviewDate DESC';
        // Create the prepared statement using the acme connection
        $stmt = $db->prepare($sql);
        // The next line replace the placeholders in the SQL
        // statement with the actual values in the variables
        // and tells the database the type of data it is
        $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
        // Get the data
        $stmt->execute();
        $clientReviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // Close the database interaction
        $stmt->closeCursor();
        // Return the indication of success
        return $clientReviews;
    }

    // Get a specific review
    function getSpecificReview($reviewId) {
        // Create a connection object from the acme connection function
        $db = acmeConnect();
        // The SQL statement
        $sql = 'SELECT invName, reviewId, reviewDate, reviewText, r.clientId, categoryName FROM clients c JOIN reviews r ON c.clientId = r.clientId JOIN inventory i ON r.invId = i.invId JOIN categories ct ON i.categoryId = ct.categoryId WHERE r.reviewId = :reviewId';
        // Create the prepared statement using the acme connection
        $stmt = $db->prepare($sql);
        // The next line replace the placeholders in the SQL
        // statement with the actual values in the variables
        // and tells the database the type of data it is
        $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
        // Get the data
        $stmt->execute();
        $clientReviews = $stmt->fetch(PDO::FETCH_ASSOC);
        // Close the database interaction
        $stmt->closeCursor();
        // Return the indication of success
        return $clientReviews;
    }

    // Update a specific review
    function updateClientReview($reviewText, $reviewId) {
         // Create a connection object from the acme connection function
         $db = acmeConnect();
         // The SQL statement
         $sql = 'UPDATE reviews SET reviewText = :reviewText WHERE reviewId = :reviewId';
         // Create the prepared statement using the acme connection
         $stmt = $db->prepare($sql);
         // The next two lines replace the placeholders in the SQL
         // statement with the actual values in the variables
         // and tells the database the type of data it is
         $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
         $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
         // Insert the data
         $stmt->execute();
         // Ask how many rows changed as a result of our insert
         $rowsChanged = $stmt->rowCount();
         // Close the database interaction
         $stmt->closeCursor();
         // Return the indication of success (rows changed)
         return $rowsChanged;
    }

    // Delete a specific review
    function deleteClientReview($reviewId) {
        // Create a connection object from the acme connection function
        $db = acmeConnect();
        // The SQL statement
        $sql = 'DELETE FROM reviews WHERE reviewId = :reviewId';
        // Create the prepared statement using the acme connection
        $stmt = $db->prepare($sql);
        // The next line replace the placeholders in the SQL
        // statement with the actual values in the variables
        // and tells the database the type of data it is
        $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
        // Insert the data
        $stmt->execute();
        // Ask how many rows changed as a result of our insert
        $rowsChanged = $stmt->rowCount();
        // Close the database interaction
        $stmt->closeCursor();
        // Return the indication of success (rows changed)
        return $rowsChanged;
    }