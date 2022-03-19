<?php

require_once "includes/app.php";
require_once "includes/functions.php";
$path = ROOT_DIR;
$id = sanitizeParam($_GET["id"]);

$s = "SELECT * FROM `forgetpass` forgetpass ORDER BY ID DESC LIMIT 1";
$qry = mysqli_query($con, $s);
$row = mysqli_fetch_array($qry);
$pinOnServer = $row["code"];
$userID = $row["user_id"];

if(isset($_POST["resetPass"])){
    $otp = sanitizeParam($_POST["otp"]);
    if($pinOnServer==$otp){
        redirect("forgetPass_resetPass.php?id=$userID");
    }else{
        redirect("forgetPass_pin.php?id=$id&msg=NotFound");
    }
}
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


              <div class="d-flex justify-content-center mb-3">
                <a href="<?=$path?>" class="logo d-flex align-items-center w-auto">
                  <img src="assets/img/logo_top.png" alt="" style="max-height: 80px;">
                  <span class="d-none d-lg-block fw-bolder d-flex align-items-center justify-content-center flex-column">
                      <p>Teach me</p>
                      <p >How</p>
                  </span>
                </a>
              </div><!-- End Logo -->

                <?php if(isset($_GET["msg"]) && $_GET["msg"]=="NotFound"){ ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        OTP was not matched. Please try again!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php } ?>

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Reset Your password</h5>
                    <p class="text-center small">Please enter OTP we sent you on registered Email</p>
                  </div>

                  <form class="row g-3 needs-validation" novalidate action="" method="post">

                    <div class="col-12">
                      <label for="yourUsername" class="form-label">OTP</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">#</span>
                        <input type="number" name="otp" class="form-control" id="yourUsername" required>
                        <div class="invalid-feedback">Please enter OTP</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit" name="resetPass">
                          <i class="bi bi-unlock-fill me-2"></i>
                          Continue
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