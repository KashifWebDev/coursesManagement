<?php
require_once "includes/app.php";
require_once "includes/functions.php";
$path = ROOT_DIR;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    $title = "Forget Password"." | TeachMe How";
    require "includes/head.inc.php";
    ?>
</head>

<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                <?php if(isset($_GET["accountCreated"])){ ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <h4 class="alert-heading">Account Created</h4>
                            <p>Congrats! Your account was created successfully. To continue using platform, please check your registered email and follow the instructions.</p>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                <?php } ?>
                <?php if(isset($_GET["verified"])){ ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <h4 class="alert-heading">Account Verified!</h4>
                            <p>Congrats! Your account was verified successfully! Please login to continue..</p>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                <?php } ?>

              <div class="d-flex justify-content-center">
                <a href="<?=$path?>" class="logo d-flex align-items-center w-auto">
                  <img src="assets/img/logo_top.png" alt="" style="max-height: 80px;">
                  <span class="d-none d-lg-block fw-bolder d-flex align-items-center justify-content-center flex-column">
                      <p>Teach me</p>
                      <p >How</p>
                  </span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Reset Your password</h5>
                    <p class="text-center small">Please enter your email to reset your password</p>
                  </div>

                  <form class="row g-3 needs-validation" novalidate action="instructorDashboard.php" method="post">

                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Email</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="text" name="username" class="form-control" id="yourUsername" required>
                        <div class="invalid-feedback">Please enter your email.</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit">
                          <i class="bi bi-unlock-fill me-2"></i>
                          Reset Password
                      </button>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0">Don't have account? <a href="register.php">Create an account</a></p>
                      <p class="small mb-0">Forgot Password? <a href="register.php">Reset Your Password Now</a></p>
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