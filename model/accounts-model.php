<?php
/*
    Account model for site visitors
*/

function regClient($clientFirstname, $clientLastname, $clientEmail, $clientPassword){
    // Create a connection object using the acme connection function
    $db = acmeConnect();
    // The SQL statement
    $sql = 'INSERT INTO clients (clientFirstname, clientLastname,clientEmail, clientPassword)
        VALUES (:clientFirstname, :clientLastname, :clientEmail, :clientPassword)';
    // Create the prepared statement using the acme connection
    $stmt = $db->prepare($sql);
    // The next four lines replace the placeholders in the SQL
    // statement with the actual values in the variables
    // and tells the database the type of data it is
    $stmt->bindValue(':clientFirstname', $clientFirstname, PDO::PARAM_STR);
    $stmt->bindValue(':clientLastname', $clientLastname, PDO::PARAM_STR);
    $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
    $stmt->bindValue(':clientPassword', $clientPassword, PDO::PARAM_STR);
    // Insert the data
    $stmt->execute();
    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
    // Close the database interaction
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    return $rowsChanged;       
}

// Check for an existing email address
function checkExistingEmail($clientEmail) {
    // Create a connection object using the acme connection function
    $db = acmeConnect();
    // The SQL statement
    $sql = 'SELECT clientEmail FROM clients WHERE clientEmail = :email';
    // Create the prepared statement using the acme connection
    $stmt = $db->prepare($sql);
    // The next line replace the placeholder in the SQL
    $stmt->bindValue(':email', $clientEmail, PDO::PARAM_STR);
    // Retrieve the data
    $stmt->execute();
    $matchEmail = $stmt->fetch(PDO::FETCH_NUM);
    // Close cursor
    $stmt->closeCursor();
    // Check if email already exist
    if(empty($matchEmail)){
        return 0;
    } else {
        return 1;
    }
}

// Get client data based on an email address
function getClient($clientEmail){
    // Create a connection object using the acme connection function
    $db = acmeConnect();
    // The SQL statement
    $sql = 'SELECT clientId, clientFirstname, clientLastname, clientEmail, 
            clientLevel, clientPassword FROM clients WHERE clientEmail = :email';
    // Create the prepared statement using the acme connection
    $stmt = $db->prepare($sql);
    // The next line replace the placeholder in the SQL
    $stmt->bindValue(':email', $clientEmail, PDO::PARAM_STR);
    // Retrieve the data
    $stmt->execute();
    $clientData = $stmt->fetch(PDO::FETCH_ASSOC);
    // Close cursor
    $stmt->closeCursor();
    // Return Client Data
    return $clientData;
}

// Get client data based on an email address
function getClientId($clientId){
    // Create a connection object using the acme connection function
    $db = acmeConnect();
    // The SQL statement
    $sql = 'SELECT clientId, clientFirstname, clientLastname, clientEmail, 
            clientLevel, clientPassword FROM clients WHERE clientId = :clientId';
    // Create the prepared statement using the acme connection
    $stmt = $db->prepare($sql);
    // The next line replace the placeholder in the SQL
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    // Retrieve the data
    $stmt->execute();
    $clientDataById = $stmt->fetch(PDO::FETCH_ASSOC);
    // Close cursor
    $stmt->closeCursor();
    // Return Client Data
    return $clientDataById;
}

function updateClientInfo($clientFirstname, $clientLastname, $clientEmail, $clientId) {
    // Create a connection object using the acme connection function
    $db = acmeConnect();
    // The SQL statement
    $sql = 'UPDATE clients SET clientFirstname = :clientFirstname, clientLastname = :clientLastname, clientEmail = :clientEmail WHERE clientId = :clientId';
    // Create the prepared statement using the acme connection
    $stmt = $db->prepare($sql);
    // The next four lines replace the placeholders in the SQL
    // statement with the actual values in the variables
    // and tells the database the type of data it is
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    $stmt->bindValue(':clientFirstname', $clientFirstname, PDO::PARAM_STR);
    $stmt->bindValue(':clientLastname', $clientLastname, PDO::PARAM_STR);
    $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
    // Insert the data
    $stmt->execute();
    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
    // Close the database interaction
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    return $rowsChanged;       
}

function updateClientPassword($clientPassword, $clientId) {
    // Create a connection object using the acme connection function
    $db = acmeConnect();
    // The SQL statement
    $sql = 'UPDATE clients SET clientPassword = :clientPassword WHERE clientId = :clientId';
    // Create the prepared statement using the acme connection
    $stmt = $db->prepare($sql);
    // The next four lines replace the placeholders in the SQL
    // statement with the actual values in the variables
    // and tells the database the type of data it is
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    $stmt->bindValue(':clientPassword', $clientPassword, PDO::PARAM_STR);
    // Insert the data
    $stmt->execute();
    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
    // Close the database interaction
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    return $rowsChanged;       
}