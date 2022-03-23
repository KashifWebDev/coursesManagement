<?php
    require_once "includes/app.php";
validateSession();
    require_once "includes/functions.php";
    $path = ROOT_DIR;

if(isset($_POST["updateDraftStatus"])){
    $setStatus = $_POST["setStatus"]=="active" ? 0:1;
    $courseID = sanitizeParam($_POST["courseID"]);

    $s = "UPDATE courses SET draft=$setStatus WHERE id=$courseID";
    if(mysqli_query($con, $s)){
        header('Location: instructor-all-courses.php');
    }
}
if(isset($_GET["del"])){
    $courseID = sanitizeParam($_GET["del"]);

    $s = "UPDATE courses SET is_deleted=1 WHERE id=$courseID";
    if(mysqli_query($con, $s)){
        header('Location: instructor-all-courses.php');
    }else{
        echo mysqli_error($con);
    }
}
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
              <h1>All Courses</h1>
              <nav>
                  <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="<?=ROOT_DIR?>instructorDashboard.php">Dashboard</a></li>
                      <li class="breadcrumb-item">All Courses</li>
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
                              $sql = "SELECT c.id as coursePrimaryKey, c.title, COUNT(l.course_id) AS total_lessons, c.thumbnail, c.access,
                                        c.draft, c.courseID, c.draft, c.instructor_id 
                                        FROM courses c LEFT JOIN lessons l
                                        ON l.course_id = c.id
                                        WHERE c.is_deleted=0  GROUP BY c.id";
                              $res = mysqli_query($con, $sql);
                              while($row = mysqli_fetch_array($res)){
                                  $badgeClass = $row["draft"]==0 ? "success" : "warning";
                                  $badgeTxt = $row["draft"]==0 ? "Active" : "Draft";
                              ?>
                                  <tr>
                                      <th scope="row"><?=$row["coursePrimaryKey"]?></th>
                                      <td>
                                          <img style="max-height: 40px;" class="me-2 img-thumbnail" src="assets/img/courses-thumnail/<?=$row["thumbnail"]?>" alt="Course Thumbnail">
                                          <?=$row["title"]?>
                                      </td>
                                      <td><?=$row["total_lessons"]?></td>
                                      <td><?=$row["access"]?></td>
                                      <td>
                                          <span style="border-radius: 10px" class="bg-<?=$badgeClass?> text-white px-2 py-1"><?=$badgeTxt?></span>
                                      </td>
                                      <td>
                                          <a href="instructor-view-course.php?courseID=<?=$row["coursePrimaryKey"]?>" class="btn btn-primary">
                                              <i class="bi bi-box-arrow-up-right me-2"></i>
                                              Edit Course
                                          </a>
                                          <button class="btn btn-secondary ms-1" data-bs-toggle="modal" data-bs-target="#draftCourseModel_<?=$row["coursePrimaryKey"]?>">
                                              <i class="ri-save-3-line me-1"></i> Status
                                          </button>
                                          <button id="submitBtn2" type="button" class="btn btn-danger ms-1" data-bs-toggle="modal" data-bs-target="#delCourseModel_<?=$row["coursePrimaryKey"]?>">
                                              <i class="bi bi-trash2-fill me-2"></i>
                                              Delete
                                          </button>
                                          <a target="_blank" class="btn btn-info text-white ms-1" href="course-<?=$row["courseID"]?>">
                                              <i class="bi bi-eye-fill"></i> Preview
                                          </a>
                                      </td>
                                  </tr>

                                  <div class="modal fade" id="delCourseModel_<?=$row["coursePrimaryKey"]?>" tabindex="-1">
                                      <div class="modal-dialog">
                                          <div class="modal-content">
                                              <div class="modal-header bg-danger text-white">
                                                  <h5 class="modal-title">Delete Course</h5>
                                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                              </div>
                                              <div class="modal-body">
                                                  Are you sure you want to delete this course?
                                              </div>
                                              <div class="modal-footer">
                                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                  <a href="instructor-all-courses.php?del=<?=$row["coursePrimaryKey"]?>" class="btn btn-danger">
                                                      Delete
                                                  </a>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="modal fade" id="draftCourseModel_<?=$row["coursePrimaryKey"]?>" tabindex="-1">
                                      <div class="modal-dialog">
                                          <div class="modal-content">
                                              <div class="modal-header bg-secondary text-white">
                                                  <h5 class="modal-title">Update Course Status</h5>
                                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                              </div>
                                              <div class="modal-body">
                                                  <form action="" method="post">
                                                      <input type="hidden" name="courseID" value="<?=$row["coursePrimaryKey"]?>">
                                                      <fieldset class="row mb-3">
                                                          <div class="col-sm-10">
                                                              <div class="form-check">
                                                                  <input class="form-check-input" type="radio" name="setStatus" id="gridRadios" value="active" <?php if(!$row["draft"]) echo "checked"; ?>>
                                                                  <label class="form-check-label" for="gridRadios">
                                                                      Set course active
                                                                  </label>
                                                              </div>
                                                          </div>
                                                          <div class="col-sm-10">
                                                              <div class="form-check">
                                                                  <input class="form-check-input" type="radio" name="setStatus" id="gridRadios1" value="draft" <?php if($row["draft"]) echo "checked"; ?>>
                                                                  <label class="form-check-label" for="gridRadios1">
                                                                      Set as Draft
                                                                  </label>
                                                              </div>
                                                          </div>
                                                      </fieldset>
                                                      <div class="row justify-content-around">
                                                          <div class="col-md-6">
                                                              <button type="submit" name="updateDraftStatus" class="btn btn-secondary w-100" id="submitBtn1">
                                                                  <i class="ri-save-3-line me-2"></i>
                                                                  Save Changes
                                                              </button>
                                                          </div>
                                                      </div>
                                                  </form>
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