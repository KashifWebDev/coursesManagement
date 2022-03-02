<?php

require_once "includes/app.php";
require_once "includes/functions.php";
$path = ROOT_DIR;
if (isset($_POST["signUp"])){
    $firstName = sanitizeParam($_POST["firstName"]);
    $lastName = sanitizeParam($_POST["lastName"]);
    $email = sanitizeParam($_POST["email"]);
    $contactNum = sanitizeParam($_POST["contactNum"]);
    $address = sanitizeParam($_POST["address"]);
    $username = sanitizeParam($_POST["username"]);
    $password = md5(sanitizeParam($_POST["password"]));
    $confirmPassword = sanitizeParam($_POST["confirmPassword"]);
    $userType = sanitizeParam($_POST["options"]);

    $sql= "SELECT * FROM users WHERE username = '$username'";
    $checkUserName = mysqli_query($con, $sql);
    if(mysqli_num_rows($checkUserName)>0) {
        redirect('register.php?username=err');
    }
    $sql= "SELECT * FROM users WHERE email = '$email'";
    $checkEmail = mysqli_query($con, $sql);
    if(mysqli_num_rows($checkEmail)>0) {
        redirect('register.php?email=err');
    }

    $sql = "INSERT INTO users(firstname, lastname, email, contactNum, address, username, password, type) VALUES
            ('$firstName','$lastName','$email','$contactNum','$address','$username','$password','$userType')";
    if(mysqli_query($con, $sql)){
        $newID = mysqli_insert_id($con);
        $to = $email;
        $subject = 'Welcome to TeachMeHow';
        $from = 'no-reply@teachmehow.me';

// To send HTML mail, the Content-type header must be set
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Create email headers
        $headers .= 'From: '.$from."\r\n".
            'Reply-To: '.$from."\r\n" .
            'X-Mailer: PHP/' . phpversion();

// Compose a simple HTML email message
        $message = '<html><body>';
        $message .= '<h2>Welcome!</h2>';
        $message .= '<p style="font-size:18px;margin-left: 15px; margin-bottom: 28px;">Your account was created successfully! Please click on the following buttton to verify the account.</p>';
        $message .= '<a href="https://teachmehow.me/verifyAccount/'.$newID.'" style="background: black; color: white; padding: 11px 22px; font-size: larger; margin-left: 15px; border-radius: 20px;text-decoration: none;">Verify Account Now</a>';
        $message .= '</body></html>';

// Sending email
        if(mail($to, $subject, $message, $headers)){
            redirect('index.php?accountCreated=1');
        } else{
            echo 'Unable to send email. Please try again.';exit();die();
        }
    }
}
function redirect($addr){
    error_reporting(E_ALL | E_WARNING | E_NOTICE);
    ini_set('display_errors', TRUE);
    flush();

    echo '<script>window.location.replace("'.$addr.'");</script>';
    echo '<script>window.location("'.$addr.'");</script>';
//    header('Location: '.$addr);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    $title = "Register"." | TeachMe How";
    require "includes/head.inc.php";
    ?>
</head>

<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-6 col-md-10 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center">
                <a href="<?=$path?>" class="logo d-flex align-items-center w-auto">
                    <img src="assets/img/logo_top.png" alt="">
<!--                  <span class="d-none d-lg-block">NiceAdmin</span>-->
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                    <p class="text-center small">Enter your personal details to create account</p>
                  </div>

                  <form class="row g-3 needs-validation1" novalidate method="post" action="">

                    <div class="col-md-6">
                      <label for="firstName" class="form-label">First Name</label>
                      <input type="text" name="firstName" class="form-control" id="firstName" required>
                      <div class="invalid-feedback">Please, enter your first name!</div>
                    </div>

                    <div class="col-md-6">
                      <label for="lastName" class="form-label">Last Name</label>
                      <input type="text" name="lastName" class="form-control" id="lastName" required>
                      <div class="invalid-feedback">Please, enter your last name!</div>
                    </div>

                    <div class="col-md-6">
                      <label for="yourEmail" class="form-label">Your Email</label>
                      <input type="email" name="email" class="form-control<?php if(isset($_GET["email"])){echo " border-danger";} ?>" id="yourEmail" required>
                      <div class="invalid-feedback">Please enter a valid Email address!</div>
                        <?php if(isset($_GET["email"])){ ?>
                            <div class="text-danger w-100">Email already taken!</div>
                        <?php } ?>
                    </div>

                    <div class="col-md-6">
                      <label for="yourContactNum" class="form-label">Contact #</label>
                      <input type="text" name="contactNum" class="form-control" id="yourContactNum" required>
                      <div class="invalid-feedback">Please enter a valid contact number!</div>
                    </div>

                    <div class="col-md-6">
                      <label for="yourAddress" class="form-label">Your Address</label>
                      <input type="text" name="address" class="form-control" id="yourAddress" required>
                      <div class="invalid-feedback">Please enter a valid Address!</div>
                    </div>

                    <div class="col-md-6">
                      <label for="yourUsername" class="form-label">Username</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text<?php if(isset($_GET["username"])){echo " border-danger";} ?>" id="inputGroupPrepend">@</span>
                        <input type="text" name="username" class="form-control<?php if(isset($_GET["username"])){echo " border-danger";} ?>" id="yourUsername" required>
                        <div class="invalid-feedback">Please choose a username.</div>
                          <?php if(isset($_GET["username"])){ ?>
                              <div class="text-danger w-100">Username already taken!</div>
                          <?php } ?>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <label for="yourPassword" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control" id="yourPassword" required>
                      <div class="invalid-feedback">Please enter your password!</div>
                    </div>

                    <div class="col-md-6">
                      <label for="confirmPassword" class="form-label">Confirm Password</label>
                      <input type="password" name="confirmPassword" class="form-control" id="confirmPassword" required>
                      <div class="invalid-feedback">Renter the same password!</div>
                      <div class="pwdNotMatch text-danger">Password do not match!</div>
                    </div>

                    <div class="col-md-12 d-flex align-items-center justify-content-center">
                      <p class="form-label" style="margin-right: 10px!important;">I'm a  </p>
                        <input type="radio" class="btn-check" name="options" value="Instructor" id="option1" autocomplete="off" checked>
                        <label class="btn btn-outline-primary" for="option1" style="margin-right: 10px!important;">Instructor</label>

                        <input type="radio" class="btn-check" name="options" value="Student" id="option2" autocomplete="off">
                        <label class="btn btn-outline-primary" for="option2">Student</label>
                    </div>

                    <div class="col-md-12">
                      <div class="form-check">
                        <input class="form-check-input" name="terms" type="checkbox" value="" id="acceptTerms" required>
                        <label class="form-check-label" for="acceptTerms">I agree and accept the <a href="#">terms and conditions</a></label>
                        <div class="invalid-feedback">You must agree before submitting.</div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <button class="btn btn-primary w-100" type="submit" name="signUp" id="submitBtn">Create Account</button>
                    </div>
                    <div class="col-md-12">
                      <p class="small mb-0">Already have an account? <a href="<?=$path?>">Log in</a></p>
                    </div>
                  </form>

                </div>
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/chart.js/chart.min.js"></script>
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  <script src="assets/vendor/jquery/jquery.min.js"></script>

  <script>
      $(".pwdNotMatch").hide();
      var needsValidation = document.querySelectorAll('.needs-validation1')

      Array.prototype.slice.call(needsValidation)
          .forEach(function(form) {
              form.addEventListener('submit', function(event) {
                  if (!form.checkValidity()) {
                      event.preventDefault()
                      event.stopPropagation()
                      $('#submitBtn').text("Create Account");
                  }

                  if($("#yourPassword").val()!=$("#confirmPassword").val() &&
                      $("#confirmPassword").val()!=""){
                      $(".pwdNotMatch").show();
                      event.preventDefault()
                      event.stopPropagation()
                      $('#submitBtn').text("Create Account");
                  }

                  form.classList.add('was-validated')
              }, false)
          })

      $('#submitBtn').on('click', function() {
          var $this = $(this);
          var loadingText = '<div class="spinner-border text-light" role="status"></div>';
          if ($(this).html() !== loadingText) {
              $this.data('original-text', $(this).html());
              $this.html(loadingText);
          }
      });
  </script>

</body>

</html>