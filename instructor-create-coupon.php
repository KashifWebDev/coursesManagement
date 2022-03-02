<?php
    require_once "includes/app.php";
validateSession();
    require_once "includes/functions.php";
    $path = ROOT_DIR;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    $title = "Create Coupon"." | TeachMe How";
        require "includes/head.inc.php";
    ?>
</head>

<body>

  <!-- ======= Header ======= -->
    <?=require_once "includes/header.inc.php";?>
  <!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <?=require_once "includes/instructorSideBar.inc.php";?>
  <!-- End Sidebar-->

  <main id="main" class="main">

      <div class="pagetitle">
          <h1>Create New Course</h1>
          <nav>
              <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="<?=ROOT_DIR?>instructorDashboard.php">Dashboard</a></li>
                  <li class="breadcrumb-item">Create a coupon</li>
              </ol>
          </nav>
      </div><!-- End Page Title -->

      <section class="section">
          <div class="row justify-content-center">
              <div class="col-lg-12">

                  <div class="card">
                      <div class="card-body">
                          <h5 class="card-title">Generate a new Coupon</h5>

                          <!-- Floating Labels Form -->
                          <form class="row g-3">
                              <div class="col-md-6">
                                  <label for="inputNanme4" class="form-label">Course Title</label>
                                  <input type="text" class="form-control" id="inputNanme4">
                              </div>

                              <div class="col-md-6">
                                  <label for="inputNumber" class="col-sm-8 col-form-label">Coupon Code</label>
                                  <div class="col-sm-10">
                                      <input class="form-control" type="text" id="formFile" value="<?=generateRandomString()?>" disabled>
                                  </div>
                              </div>

                              <div class="col-md-6">
                                  <label for="expiryDate" class="col-sm-8 col-form-label">Expiry Date</label>
                                  <div class="col-sm-10">
                                      <input class="form-control" type="date" id="expiryDate">
                                  </div>
                              </div>

                              <div class="col-md-6">
                                  <label for="inputState" class="form-label">Select course for coupon</label>
                                  <select id="inputState" class="form-select">
                                      <option>Course 1</option>
                                      <option>Course 2</option>
                                      <option>Course 3</option>
                                      <option>Course 4</option>
                                      <option>Course 5</option>
                                  </select>
                              </div>

                              <div class="row justify-content-center">
                                  <div class="col-md-6">
                                      <button type="submit" class="btn btn-primary w-100 mt-3 rounded-pill">
                                          <i class="bi bi-plus-circle-fill mr-2"></i>
                                          Generate Coupon Code
                                      </button>
                                  </div>
                              </div>
                          </form><!-- End floating Labels Form -->

                      </div>
                  </div>

              </div>
          </div>
      </section>
  </main><!-- End #main -->


  <?=require_once "includes/footer.inc.php";?>

</body>

</html>
<?php
function generateRandomString($length = 6) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
?>