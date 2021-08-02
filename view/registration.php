<?php 
    $pageTitle = 'Client Registration | Acme Inc.';
    include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php'; 
?>

            <section class="form-container">            
                <h1>Acme Registraion</h1>

                <?php
                    if (isset($message)) {
                        echo $message;
                    }
                ?>

                <form action="/acme/accounts/index.php" method="post">   
                    <fieldset>
                        <legend>All fields are required</legend> 
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

                        <label for="clientPassword" class="top">
                            Password
                            <span>Passwords must be at least 8 characters and contain at least 1 number, capital letter, and special character</span>
                            <input type="password" name="clientPassword" id="clientPassword" pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required maxlength="255">
                        </label>
                    </fieldset>
                    <input type="submit" value="Register" class="submitBtn">
                    <input type="hidden" name="action" value="register">
                </form>
            </section>
        
<?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>