<?php
require_once "includes/app.php";
require_once "includes/functions.php";
$path = ROOT_DIR;
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

                  <form class="row g-3 needs-validation" novalidate method="post" action="index.php?accountCreated=1">

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
                      <input type="email" name="email" class="form-control" id="yourEmail" required>
                      <div class="invalid-feedback">Please enter a valid Email address!</div>
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
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="text" name="username" class="form-control" id="yourUsername" required>
                        <div class="invalid-feedback">Please choose a username.</div>
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
                    </div>

                    <div class="col-md-12 d-flex align-items-center justify-content-center">
                      <p class="form-label" style="margin-right: 10px!important;">I'm a  </p>
                        <input type="radio" class="btn-check" name="options" id="option1" autocomplete="off" checked>
                        <label class="btn btn-outline-primary" for="option1" style="margin-right: 10px!important;">Instructor</label>

                        <input type="radio" class="btn-check" name="options" id="option2" autocomplete="off">
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
                      <button class="btn btn-primary w-100" type="submit">Create Account</button>
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

</body>

</html>