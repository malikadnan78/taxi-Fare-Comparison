<?php
get_header();

/*
Template Name: Registration
*/
?>
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">


<!-- jQuery library -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>

<!-- Popper JS -->
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
</script>
<!-- <div class="otpl-popup"><a href="javascript:">Login</a></div> -->
<?php
global $current_user;
wp_get_current_user();

if (isset($_REQUEST['register'])) {
    $validate = true;
    $error = $username_err = $email_err = $password_err = null;

    $username = $_REQUEST['username']?? null;
    $email = $_REQUEST['cemail']?? null;
    $password = $_REQUEST['cpass']?? null;
    $password_confirmation = $_REQUEST['conpass'];
    $phone = $_REQUEST['phone'];

    if (! $username) {
        $validate = false;
        $username_err = "Username is required";
    }

    if (! $email) {
        $validate = false;
        $username_err = "Email is required";
    }

    if ($password !== $password_confirmation) {
        $validate = false;
        $password_err = "Password confirmation does not match.";
    }

    if ($validate) {
        // Create the WordPress User object with the basic required information
        $login = $username;
        $user_id = wp_create_user($login, $password, $email);

        if (!$user_id || is_wp_error($user_id)) {
            $error = $user_id->get_error_message();
        } else {
            // $userinfo = array(
            //     'ID' => $user_id,
            //     'first_name' => $firstname,
            //     'last_name' => $lastname,
            // );
        
            // Update the WordPress User object with first and last name.
            //wp_update_user($userinfo);
        
            // Add the company as user metadata
            update_usermeta($user_id, 'phone', $phone);

            if (! isset($_SESSION["bookinuri"])) {
                ?>
                    <script>
                        alert("You are registered now");
                        window.location = "<?=home_url() . "/account";?>";
                    </script>
                <?php
            } else {
                ?>
                    <script>
                        alert("You are registered now");
                        window.location = "<?=$_SESSION["bookinuri"];?>";
                    </script>
                <?php
            }
        }
    }

}

if (is_user_logged_in()) : 

?>
    <p>You're already logged in and have no need to create a user profile.</p>

    <?php else : while (have_posts()) : the_post(); 
    ?>

        <div id="page-<?php the_ID(); ?>">
            <div class="container">
        <div class="row">
            <h2 style="text-align: center;">Please Register</h2>
            <div class="col-md-4">
            </div>
            <div class="col-md-4">
            <?php if (isset($error)): ?>
                <span class="text-danger"><?= $error ?></span>
            <?php endif; ?>
            <form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="post">
                
                    <div class="form-class mb-3">
                       <label for="firstname">User name:</label>
                       <input name="username" id="firstname" value="<?php echo $username?? '' ?>" class="form-control">
                       <?php if (isset($username_err)): ?>
                        <span class="text-danger"><?= $username_err ?></span>
                       <?php endif; ?>
                    </div>

                    <div class="form-class mb-3">
                        <label for="company">Email:</label>
                        <input name="cemail" id="company" type="email" value="<?php echo $email?? '' ?>" class="form-control" required>
                        <?php if (isset($email_err)): ?>
                          <span class="text-danger"><?= $email_err ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="form-class mb-3">
                        <label for="company">Password:</label>
                        <input name="cpass" id="company" type="password"  class="form-control" required>
                        <?php if (isset($password_err)): ?>
                          <span class="text-danger"><?= $password_err ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="form-class mb-3">
                    <label for="company">Confirm Password:</label>
                    <input name="conpass" id="company" type="password" class="form-control" required>

                    </div>

                    <div class="form-class mb-3">
                    <label for="phone">Phone:</label><br>
                    <input type="tel" class="form-control" id="phone" placeholder="" required name="phone">
                    </div>          
                    
                    
                        <input type="hidden" name="full_phone">
                        <div class="invalid-feedback">
                            Please enter a valid Phone.
                        </div>
               <input type="submit" name="register" value="Register" class="form-control" style="margin-bottom:30px">
            </form>
        
            </div>
            <div class="col-md-4">
            </div>
        </div>
    </div>
        
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/css/intlTelInput.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/intlTelInput.min.js"></script>  
<script>
    $(document).ready(function() {
        var phone_number = window.intlTelInput(document.querySelector("#phone"), {
            separateDialCode: true,
            preferredCountries: ["gb"],
            hiddenInput: "full",
            utilsScript: "//cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/utils.js"
        });
    });
</script>

<?php endwhile;
endif; 
get_footer();
?>