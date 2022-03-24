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
                                  <th scope="col">Coupon Name</th>
                                  <th scope="col">Coupon Code</th>
                                  <th scope="col">Course</th>
                                  <th scope="col">Expiry Date</th>
                              </tr>
                              </thead>
                              <tbody>
                              <?php
                                $s = "SELECT * FROM coupons";
                                $res = mysqli_query($con, $s);
                                if(mysqli_num_rows($res)){
                                    $count = 1;
                                    while($row = mysqli_fetch_array($res)){
                                        $courseID = $row["course_id"];
                                        $s = "SELECT * FROM courses WHERE id=$courseID";
                                        $res1 = mysqli_query($con, $s);
                                        $course = mysqli_fetch_array($res1);
                                        ?>
                                        <tr>
                                            <th scope="row"><?=$count?></th>
                                            <td><?=$row["name"]?></td>
                                            <td><?=$row["code"]?></td>
                                            <td><?=$course["title"]?></td>
                                            <td><?=date("d-m-Y", strtotime($row["exp_date"]))?></td>
                                        </tr>
                              <?php
                                        $count++;
                                    }
                                }
                              ?>
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