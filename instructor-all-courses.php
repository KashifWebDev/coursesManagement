<?php
    require_once "includes/app.php";
    require_once "includes/functions.php";
    $path = ROOT_DIR;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    $title = "All Courses"." | TeachMe How";
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

      <div class="pagetitle d-flex justify-content-between">
          <div>
              <h1>My Courses</h1>
              <nav>
                  <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="<?=ROOT_DIR?>instructorDashboard.php">Dashboard</a></li>
                      <li class="breadcrumb-item">My Courses</li>
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
                              $sql = "SELECT c.id as coursePrimaryKey, c.title, COUNT(l.course_id) AS total_lessons, c.thumbnail, c.access, c.draft, c.courseID
                                        FROM courses c LEFT JOIN lessons l
                                        ON l.course_id = c.id GROUP BY c.id";
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
                                          <a href="instructor-view-course.php?courseID=<?=$row["coursePrimaryKey"]?>" class="btn btn-outline-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Visit Course"><i class="bi bi-box-arrow-up-right me-2"></i>Open Course</a>
                                      </td>
                                  </tr>
                              <?php } ?>


                              <div class="modal fade" id="delModal" tabindex="-1">
                                  <div class="modal-dialog modal-lg">
                                      <div class="modal-content">
                                          <div class="modal-header">
                                              <h5 class="modal-title">Delete Course</h5>
                                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                          </div>
                                          <div class="modal-body">
                                              Are you sure you want to delete this course?
                                          </div>
                                          <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                              <button type="button" class="btn btn-danger">Delete</button>
                                          </div>
                                      </div>
                                  </div>
                              </div><!-- End Large Modal-->
                              
                              
                              
                              
                              
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