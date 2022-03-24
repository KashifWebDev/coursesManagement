<?php
    require_once "includes/app.php";
validateSession();
    require_once "includes/functions.php";
    $path = ROOT_DIR;

    if(isset($_POST["addCoupon"])){
        $name = sanitizeParam($_POST["name"]);
        $code = sanitizeParam($_POST["code"]);
        $date = $_POST["date"];
        $userID = $_SESSION["userID"];
        foreach ($_POST["courses"] as $course){
            $s = "INSERT INTO coupons(user_id, name, code, exp_date, course_id) VALUES 
                ($userID, '$name', '$code', '$date', $course)";
            mysqli_query($con, $s);
        }
        ///// Redirect to either instructor or admin
        if($_SESSION["role"]=="Admin"){
            redirect("admin-all-coupons.php");
        }else{
            redirect("instructor-all-coupons.php");
        }

    }
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
  <?php
  if($_SESSION["role"]=="Admin"){
      require_once "includes/adminSideBar.inc.php";
  }
  if($_SESSION["role"]=="Instructor"){
      require_once "includes/instructorSideBar.inc.php";
  }
  if($_SESSION["role"]=="Student"){
      require_once "includes/studentSideBar.inc.php";
  }
  ?>
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
                          <form action="" method="post">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="col-md-12">
                                        <label for="inputNanme4" class="form-label">Coupon Name</label>
                                        <input type="text" class="form-control" id="inputNanme4" name="name">
                                    </div>

                                    <div class="col-md-12">
                                        <label for="inputNumber" class="col-sm-8 col-form-label">Coupon Code</label>
                                        <div class="col-sm-12">
                                            <input name="code" class="form-control" type="text" id="formFile" value="<?=generateRandomString()?>">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <label for="expiryDate" class="col-sm-12 col-form-label">Expiry Date</label>
                                        <div class="col-sm-12">
                                            <input class="form-control" type="date" name="date" id="expiryDate">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="row mb-3">
                                        <label class="col-sm-12 col-form-label">Select Course(s) <span class="text-muted ms-2">(Select Ctrl to select multiple)</span></label>
                                        <div class="col-sm-12">
                                            <select class="form-select" multiple="" name="courses[]" aria-label="multiple select example">
                                                <?php
                                                    $s = "SELECT * FROM courses WHERE is_deleted=0";
                                                    $res = mysqli_query($con, $s);
                                                    while($row = mysqli_fetch_array($res)){
                                                        ?>
                                                        <option value="<?=$row["id"]?>"><?=$row["title"]?></option>
                                                <?php
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                              <div class="row justify-content-center mt-3">
                                  <div class="col-md-6">
                                      <button type="submit" name="addCoupon" class="btn btn-primary w-100 mt-3 rounded-pill submitBtn">
                                          <i class="bi bi-plus-circle me-2"></i>
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

  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script>
      $('.submitBtn').on('click', function() {
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