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
    $title = "All Coupons"." | TeachMe How";
        require "includes/head.inc.php";
    ?>
</head>

<body>

  <!-- ======= Header ======= -->
    <?=require_once "includes/header.inc.php";?>
  <!-- End Header -->

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

  <main id="main" class="main">

      <div class="pagetitle">
          <h1>All Coupons</h1>
          <nav>
              <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="<?=$path?>instructorDashboard.php">Dashboard</a></li>
                  <li class="breadcrumb-item active">All Coupons</li>
              </ol>
          </nav>
      </div><!-- End Page Title -->

      <section class="section">
          <div class="row">
              <div class="col-lg-12">

                  <div class="card">
                      <div class="card-body">

                          <!-- Table with stripped rows -->
                          <table class="table datatable">
                              <thead>
                              <tr>
                                  <th scope="col">#</th>
                                  <th scope="col">Coupon Code</th>
                                  <th scope="col">Course Name</th>
                                  <th scope="col">Expiry Date</th>
                              </tr>
                              </thead>
                              <tbody>
                              <tr>
                                  <th scope="row">1</th>
                                  <td>YxZPKZ</td>
                                  <td>Designer</td>
                                  <td>2016-05-25</td>
                              </tr>
                              <tr>
                                  <th scope="row">2</th>
                                  <td>rh3M75</td>
                                  <td>Developer</td>
                                  <td>2014-12-05</td>
                              </tr>
                              <tr>
                                  <th scope="row">3</th>
                                  <td>74QxLK</td>
                                  <td>Finance</td>
                                  <td>2011-08-12</td>
                              </tr>
                              <tr>
                                  <th scope="row">4</th>
                                  <td>4hITkb</td>
                                  <td>HR</td>
                                  <td>2012-06-11</td>
                              </tr>
                              <tr>
                                  <th scope="row">5</th>
                                  <td>t7a3Cq</td>
                                  <td>Dynamic Division Officer</td>
                                  <td>2011-04-19</td>
                              </tr>
                              </tbody>
                          </table>
                          <!-- End Table with stripped rows -->

                      </div>
                  </div>

              </div>
          </div>
      </section>

  </main><!-- End #main -->


  <?=require_once "includes/footer.inc.php";?>

</body>

</html>