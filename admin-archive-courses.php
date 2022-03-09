<?php
    require_once "includes/app.php";
validateSession();
    require_once "includes/functions.php";
    $path = ROOT_DIR;

if(isset($_GET["del"])){
    $courseID = sanitizeParam($_GET["del"]);

    $s = "UPDATE courses SET is_deleted=0 WHERE id=$courseID";
    if(mysqli_query($con, $s)){
        header('Location: admin-archive-courses.php');
    }else{
        echo mysqli_error($con);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    $title = "Archive Courses"." | TeachMe How";
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

      <div class="pagetitle d-flex justify-content-between">
          <div>
              <h1>Archive Courses</h1>
              <nav>
                  <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="<?=ROOT_DIR?>instructorDashboard.php">Dashboard</a></li>
                      <li class="breadcrumb-item">Archive Courses</li>
                  </ol>
              </nav>
          </div>
          <a class="btn btn-primary" href="instructor-create-course.php"><i class="bi bi-cloud-plus me-2"></i>Add a New Course</a>
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
                                  <th scope="col">Course Title</th>
                                  <th scope="col">Lessons</th>
                                  <th scope="col">Access Type</th>
                                  <th scope="col">Status</th>
                                  <th scope="col">Actions</th>
                              </tr>
                              </thead>
                              <tbody>
                              <?php
                              $sql = "SELECT c.id as coursePrimaryKey, c.title, COUNT(l.course_id) AS total_lessons, c.thumbnail, c.access, c.draft, c.courseID, c.draft
                                        FROM courses c LEFT JOIN lessons l
                                        ON l.course_id = c.id WHERE c.is_deleted=1 GROUP BY c.id";
                              $res = mysqli_query($con, $sql);
                              while($row = mysqli_fetch_array($res)){
                                  $badgeClass = $row["draft"]==0 ? "success" : "warning";
                                  $badgeTxt = $row["draft"]==0 ? "Active" : "Draft";
                              ?>
                                  <tr>
                                      <th scope="row"><?=$row["coursePrimaryKey"]?></th>
                                      <td>
                                          <img style="max-height: 40px;" class="me-2 img-thumbnail" src="assets/img/courses-thumnail/<?=$row["thumbnail"]?>?> alt="">
                                          <?=$row["title"]?>
                                      </td>
                                      <td><?=$row["total_lessons"]?></td>
                                      <td><?=$row["access"]?></td>
                                      <td>
                                          <span style="border-radius: 10px" class="bg-<?=$badgeClass?> text-white px-2 py-1"><?=$badgeTxt?></span>
                                      </td>
                                      <td>
                                          <button id="submitBtn2" type="button" class="btn btn-danger ms-1" data-bs-toggle="modal" data-bs-target="#delCourseModel_<?=$row["coursePrimaryKey"]?>">
                                              <i class="ri-recycle-fill me-2"></i>
                                              Restore
                                          </button>
                                      </td>
                                  </tr>

                                  <div class="modal fade" id="delCourseModel_<?=$row["coursePrimaryKey"]?>" tabindex="-1">
                                      <div class="modal-dialog">
                                          <div class="modal-content">
                                              <div class="modal-header bg-danger text-white">
                                                  <h5 class="modal-title">Restore Course</h5>
                                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                              </div>
                                              <div class="modal-body">
                                                  Are you sure you want to restore this course?
                                              </div>
                                              <div class="modal-footer">
                                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                  <a href="admin-archive-courses.php?del=<?=$row["coursePrimaryKey"]?>" class="btn btn-danger">
                                                      Restore
                                                  </a>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              <?php } ?>

                              
                              </tbody>
                          </table>
                          <!-- End Table with stripped rows -->

                      </div>
                  </div>

              </div>
          </div>
      </section>

  </main><!-- End #main -->



  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script>
      $(document).ready(function(){
          $('[data-bs-toggle="tooltip"]').tooltip();
      });
  </script>

  <?=require_once "includes/footer.inc.php";?>

</body>

</html>