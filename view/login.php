<?php 
    $pageTitle = 'User Login | Acme Inc.';
    include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php'; 
?>

            <section class="form-container">            
                <h1>Acme Login</h1>

                <?php
                    if (isset($message)) {
                        echo $message;
                    }
                ?>

                <form action="/acme/accounts/" method="post">   
                    <fieldset>
                        <legend>Enter Your Credentials</legend>                 
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
                    <input type="submit" name="submit" value="Login" class="submitBtn">
                    <input type="hidden" name="action" value="SignIn">
                </form>
                <span class="register">Not a Member?</span>
                <a href="/acme/accounts/index.php?action=registration" title="Create an Account">Create an Account</a>
            </section>
        
<?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>