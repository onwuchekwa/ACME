<?php
    // Checks that a client is "loggedin." If not, redirect the client back to the acme account to deliver the acme login view
  
    if (!$_SESSION['loggedin']) {
        header('location: /acme/accounts/');
        exit;
    }

    $pageTitle = 'Update Account';

    $clientFirstname = $_SESSION['clientData']['clientFirstname'];
    $clientLastname = $_SESSION['clientData']['clientLastname'];
    $clientEmail = $_SESSION['clientData']['clientEmail'];
    $clientId = $_SESSION['clientData']['clientId'];
 
    include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php'; 
?>

            <section class="section-wrapper">            
                <h1>Account Update</h1>
                <?php if (isset($message)) {echo $message;} ?>
                <form action="/acme/accounts/" method="post">   
                    <fieldset>
                        <legend>Use this form to update your name and email</legend> 
                        <label for="clientFirstname" class="top">
                            First name 
                            <input type="text" name="clientFirstname" id="clientFirstname" placeholder="First name" <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";} ?> required maxlength="15">
                        </label>

                        <label for="clientLastname" class="top">
                            Last name
                            <input type="text" name="clientLastname" id="clientLastname" placeholder="Last name" <?php if(isset($clientLastname)){echo "value='$clientLastname'";} ?> required maxlength="25">
                        </label>                
                        <label for="clientEmail" class="top">
                            Email Address 
                            <input type="email" name="clientEmail" id="clientEmail" placeholder="someone@domainname.com" <?php if(isset($clientEmail)){echo "value='$clientEmail'";} ?> required maxlength="40">
                        </label>
                    </fieldset>
                    <input type="submit" value="Update My Information" class="submitBtn" name="submit">
                    <input type="hidden" name="action" value="updateClientInfo">
                    <input type="hidden" name="clientId" value="<?php if(isset($clientData['clientId'])){ echo $clientData['clientId'];} elseif(isset($clientId)){ echo $clientId; } ?>">
                </form>

                <h2>Change Password</h2>
                <?php if (isset($message)) {echo $message;} ?>
                <form action="/acme/accounts/" method="post">   
                    <fieldset>
                        <legend>Use this form to change your password</legend>  
                        <label for="clientPassword" class="top">
                            New Password
                            <span>Passwords must be at least 8 characters and contain at least 1 number, capital letter, and special character</span>
                            <input type="password" name="clientPassword" id="clientPassword" pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required maxlength="255">
                        </label>
                    </fieldset>
                    <input type="submit" value="Change My Password" class="submitBtn">
                    <input type="hidden" name="action" value="updateClientPassword">
                    <input type="hidden" name="clientId" value="<?php if(isset($clientData['clientId'])){ echo $clientData['clientId'];} elseif(isset($clientId)){ echo $clientId; } ?>">
                </form>
            </section>
        
<?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>