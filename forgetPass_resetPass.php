<?php

require_once "includes/app.php";
require_once "includes/functions.php";
$path = ROOT_DIR;
$userID = sanitizeParam($_GET["id"]);

if(isset($_POST["reset"])){
    $pass1 = sanitizeParam($_POST["pass1"]);
    $pass2 = sanitizeParam($_POST["pass2"]);
    if($pass1!=$pass2){
        redirect("forgetPass_resetPass.php?id=$userID&msg=Failed");
    }

    $newPass = md5($pass1);
    $s = "UPDATE users SET password = '$newPass' WHERE id=$userID";
    if(mysqli_query($con, $s)){
        redirect("index.php?reset=done");
    }else{
        echo mysqli_error($con);exit(); die();
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
    $title = "Reset Password"." | TeachMe How";
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

                <?php if(isset($_GET["Failed"])){ ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Password was not matched! Please try again.
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
                    <h5 class="card-title text-center pb-0 fs-4">Reset Password</h5>
                    <p class="text-center small">Please enter New Password</p>
                  </div>

                  <form class="row g-3 needs-validation" novalidate action="" method="post">

                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Enter Password</label>
                      <div class="input-group has-validation">
                        <input type="password" name="pass1" class="form-control" id="yourUsername" required>
                        <div class="invalid-feedback">Please enter your password..</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Confirm Password</label>
                      <input type="password" name="pass2" class="form-control" id="yourPassword" required>
                      <div class="invalid-feedback">Please confirm your password!</div>
                    </div>

                    <div class="col-12">
                      <button class="btn btn-primary w-100" name="reset" type="submit">
                          <i class="bi bi-unlock-fill me-2"></i>
                          Change Password
                      </button>
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