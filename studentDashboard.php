<?php
    require_once "includes/app.php";
validateSession();
    require_once "includes/functions.php";
    $path = ROOT_DIR;
function myTotalCourses(){
    $id = $_SESSION["userID"];
    $s = "SELECT * FROM users_courses WHERE user_id=$id";
    $res = mysqli_query($GLOBALS["con"], $s);
    return mysqli_num_rows($res);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    $title = "Dashboard"." | TeachMe How";
        require "includes/head.inc.php";
    ?>
</head>

<body>

  <!-- ======= Header ======= -->
    <?=require_once "includes/header.inc.php";?>
  <!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <?=require_once "includes/studentSideBar.inc.php";?>
  <!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Student Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?=ROOT_DIR?>instructorDashboard.php">Dashboard</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">
        <div class="col-lg-12">
          <div class="row">

            <!-- Courses Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">

                <div class="card-body">
                  <h5 class="card-title">My Courses</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-list-check"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?=myTotalCourses()?></h6>
                      <span class="text-muted small pt-2 ps-1">Enrolled Courses</span>
                    </div>
                  </div>
                </div>

              </div>
            </div>
            <!-- Recent Sales -->
            <div class="col-12">
              <div class="card recent-sales">

                <div class="card-body">
                  <h5 class="card-title">Other Courses <span> You might like</span></h5>

                  <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Instructor</th>
                        <th scope="col">Course</th>
                        <th scope="col">Price</th>
                        <th scope="col">Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $s = "SELECT * FROM courses WHERE draft=0";
                      $res = mysqli_query($con, $s);
                      while($row = mysqli_fetch_array($res)){
                          $instructorID = $row["instructor_id"];
                          $badge = "";
                          $badgeTxt = "";
                          if($row["access"]=="Free"){
                            $badge = "success";
                            $badgeTxt = "Free";
                          }
                          if($row["access"]=="Registration"){
                            $badge = "secondary";
                            $badgeTxt = "Registration";
                          }
                          if($row["access"]=="Paid"){
                            $badge = "primary";
                            $badgeTxt = "Paid";
                          }
                          if($row["access"]=="Password"){
                            $badge = "danger";
                            $badgeTxt = "Password";
                          }
                          $s = "SELECT concat(firstname,' ',lastname) as fullName FROM users WHERE id=$instructorID";
                          $res1 = mysqli_query($con, $s);
                          $row1 = mysqli_fetch_array($res1);
                          ?>
                          <tr>
                              <th scope="row"><a href="#">#<?=$row["id"]?></a></th>
                              <td><?=$row1["fullName"]?></td>
                              <td><a target="_blank" href="course-<?=$row["courseID"]?>" class="text-primary"><?=$row["title"]?></a></td>
                              <td><?=$row["price"]?>$</td>
                              <td><span class="badge bg-<?=$badge?>"><?=$badgeTxt?></span></td>
                          </tr>
                      <?php
                      }
                      ?>
                    </tbody>
                  </table>

                </div>

              </div>
            </div><!-- End Recent Sales -->

          </div>
        </div>
      </div>
    </section>

  </main><!-- End #main -->


  <?=require_once "includes/footer.inc.php";?>

</body>

</html>