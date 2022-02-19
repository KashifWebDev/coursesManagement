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
          <a class="btn btn-primary" href="instructor-create-course.php">Add a New Course</a>
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
                                  <th scope="col">Course Name</th>
                                  <th scope="col">Lessons</th>
                                  <th scope="col">Actions</th>
                              </tr>
                              </thead>
                              <tbody>
                              <tr>
                                  <th scope="row">1</th>
                                  <td>Brandon Jacob</td>
                                  <td>28</td>
                                  <td>
                                      <a href="instructor-edit-course.php" class="btn btn-outline-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Edit Course"><i class="bi bi-pencil-fill"></i></a>
                                      <button type="button" class="btn btn-outline-danger"  data-bs-toggle="modal" data-bs-target="#delModal"><i class="bi bi-trash2-fill"></i></button>
                                      <a target="_blank"  href="instructor-course-lessons.php" class="btn btn-outline-secondary"  data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Open Link"><i class="bi bi-box-arrow-up-right"></i></a>
                                      <a href="instructor-course-lessons.php" class="btn btn-outline-success"><i class="bi bi-blockquote-left"></i>Lessons</a>
                                  </td>
                              </tr>
                              <tr>
                                  <th scope="row">2</th>
                                  <td>Bridie Kessler</td>
                                  <td>35</td>
                                  <td>
                                      <a href="instructor-edit-course.php" class="btn btn-outline-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Edit Course"><i class="bi bi-pencil-fill"></i></a>
                                      <button type="button" class="btn btn-outline-danger"  data-bs-toggle="modal" data-bs-target="#delModal"><i class="bi bi-trash2-fill"></i></button>
                                      <a target="_blank"  href="instructor-course-lessons.php" class="btn btn-outline-secondary"  data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Open Link"><i class="bi bi-box-arrow-up-right"></i></a>
                                      <a href="instructor-course-lessons.php" class="btn btn-outline-success"><i class="bi bi-blockquote-left"></i>Lessons</a>
                                  </td>
                              </tr>
                              <tr>
                                  <th scope="row">3</th>
                                  <td>Ashleigh Langosh</td>
                                  <td>45</td>
                                  <td>
                                      <a href="instructor-edit-course.php" class="btn btn-outline-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Edit Course"><i class="bi bi-pencil-fill"></i></a>
                                      <button type="button" class="btn btn-outline-danger"  data-bs-toggle="modal" data-bs-target="#delModal"><i class="bi bi-trash2-fill"></i></button>
                                      <a target="_blank"  href="instructor-course-lessons.php" class="btn btn-outline-secondary"  data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Open Link"><i class="bi bi-box-arrow-up-right"></i></a>
                                      <a href="instructor-course-lessons.php" class="btn btn-outline-success"><i class="bi bi-blockquote-left"></i>Lessons</a>
                                  </td>
                              </tr>
                              <tr>
                                  <th scope="row">4</th>
                                  <td>Angus Grady</td>
                                  <td>34</td>
                                  <td>
                                      <a href="instructor-edit-course.php" class="btn btn-outline-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Edit Course"><i class="bi bi-pencil-fill"></i></a>
                                      <button type="button" class="btn btn-outline-danger"  data-bs-toggle="modal" data-bs-target="#delModal"><i class="bi bi-trash2-fill"></i></button>
                                      <a target="_blank"  href="instructor-course-lessons.php" class="btn btn-outline-secondary"  data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Open Link"><i class="bi bi-box-arrow-up-right"></i></a>
                                      <a href="instructor-course-lessons.php" class="btn btn-outline-success"><i class="bi bi-blockquote-left"></i>Lessons</a>
                                  </td>
                              </tr>
                              <tr>
                                  <th scope="row">5</th>
                                  <td>Raheem Lehner</td>
                                  <td>47</td>
                                  <td>
                                      <a href="instructor-edit-course.php" class="btn btn-outline-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Edit Course"><i class="bi bi-pencil-fill"></i></a>
                                      <button type="button" class="btn btn-outline-danger"  data-bs-toggle="modal" data-bs-target="#delModal"><i class="bi bi-trash2-fill"></i></button>
                                      <a target="_blank"  href="instructor-course-lessons.php" class="btn btn-outline-secondary"  data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Open Link"><i class="bi bi-box-arrow-up-right"></i></a>
                                      <a href="instructor-course-lessons.php" class="btn btn-outline-success"><i class="bi bi-blockquote-left"></i>Lessons</a>
                                  </td>
                              </tr>
                              <tr>
                                  <th scope="row">6</th>
                                  <td>Brandon Jacob</td>
                                  <td>28</td>
                                  <td>
                                      <a href="instructor-edit-course.php" class="btn btn-outline-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Edit Course"><i class="bi bi-pencil-fill"></i></a>
                                      <button type="button" class="btn btn-outline-danger"  data-bs-toggle="modal" data-bs-target="#delModal"><i class="bi bi-trash2-fill"></i></button>
                                      <a target="_blank"  href="instructor-course-lessons.php" class="btn btn-outline-secondary"  data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Open Link"><i class="bi bi-box-arrow-up-right"></i></a>
                                      <a href="instructor-course-lessons.php" class="btn btn-outline-success"><i class="bi bi-blockquote-left"></i>Lessons</a>
                                  </td>
                              </tr>
                              <tr>
                                  <th scope="row">7</th>
                                  <td>Bridie Kessler</td>
                                  <td>35</td>
                                  <td>
                                      <a href="instructor-edit-course.php" class="btn btn-outline-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Edit Course"><i class="bi bi-pencil-fill"></i></a>
                                      <button type="button" class="btn btn-outline-danger"  data-bs-toggle="modal" data-bs-target="#delModal"><i class="bi bi-trash2-fill"></i></button>
                                      <a target="_blank"  href="instructor-course-lessons.php" class="btn btn-outline-secondary"  data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Open Link"><i class="bi bi-box-arrow-up-right"></i></a>
                                      <a href="instructor-course-lessons.php" class="btn btn-outline-success"><i class="bi bi-blockquote-left"></i>Lessons</a>
                                  </td>
                              </tr>
                              <tr>
                                  <th scope="row">8</th>
                                  <td>Ashleigh Langosh</td>
                                  <td>45</td>
                                  <td>
                                      <a href="instructor-edit-course.php" class="btn btn-outline-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Edit Course"><i class="bi bi-pencil-fill"></i></a>
                                      <button type="button" class="btn btn-outline-danger"  data-bs-toggle="modal" data-bs-target="#delModal"><i class="bi bi-trash2-fill"></i></button>
                                      <a target="_blank"  href="instructor-course-lessons.php" class="btn btn-outline-secondary"  data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Open Link"><i class="bi bi-box-arrow-up-right"></i></a>
                                      <a href="instructor-course-lessons.php" class="btn btn-outline-success"><i class="bi bi-blockquote-left"></i>Lessons</a>
                                  </td>
                              </tr>
                              <tr>
                                  <th scope="row">9</th>
                                  <td>Angus Grady</td>
                                  <td>34</td>
                                  <td>
                                      <a href="instructor-edit-course.php" class="btn btn-outline-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Edit Course"><i class="bi bi-pencil-fill"></i></a>
                                      <button type="button" class="btn btn-outline-danger"  data-bs-toggle="modal" data-bs-target="#delModal"><i class="bi bi-trash2-fill"></i></button>
                                      <a target="_blank"  href="instructor-course-lessons.php" class="btn btn-outline-secondary"  data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Open Link"><i class="bi bi-box-arrow-up-right"></i></a>
                                      <a href="instructor-course-lessons.php" class="btn btn-outline-success"><i class="bi bi-blockquote-left"></i>Lessons</a>
                                  </td>
                              </tr>
                              <tr>
                                  <th scope="row">10</th>
                                  <td>Raheem Lehner</td>
                                  <td>47</td>
                                  <td>
                                      <a href="instructor-edit-course.php" class="btn btn-outline-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Edit Course"><i class="bi bi-pencil-fill"></i></a>
                                      <button type="button" class="btn btn-outline-danger"  data-bs-toggle="modal" data-bs-target="#delModal"><i class="bi bi-trash2-fill"></i></button>
                                      <a target="_blank"  href="instructor-course-lessons.php" class="btn btn-outline-secondary"  data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Open Link"><i class="bi bi-box-arrow-up-right"></i></a>
                                      <a href="instructor-course-lessons.php" class="btn btn-outline-success"><i class="bi bi-blockquote-left"></i>Lessons</a>
                                  </td>
                              </tr>
                              <tr>
                                  <th scope="row">11</th>
                                  <td>Brandon Jacob</td>
                                  <td>28</td>
                                  <td>
                                      <a href="instructor-edit-course.php" class="btn btn-outline-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Edit Course"><i class="bi bi-pencil-fill"></i></a>
                                      <button type="button" class="btn btn-outline-danger"  data-bs-toggle="modal" data-bs-target="#delModal"><i class="bi bi-trash2-fill"></i></button>
                                      <a target="_blank"  href="instructor-course-lessons.php" class="btn btn-outline-secondary"  data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Open Link"><i class="bi bi-box-arrow-up-right"></i></a>
                                      <a href="instructor-course-lessons.php" class="btn btn-outline-success"><i class="bi bi-blockquote-left"></i>Lessons</a>
                                  </td>
                              </tr>
                              <tr>
                                  <th scope="row">12</th>
                                  <td>Bridie Kessler</td>
                                  <td>35</td>
                                  <td>
                                      <a href="instructor-edit-course.php" class="btn btn-outline-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Edit Course"><i class="bi bi-pencil-fill"></i></a>
                                      <button type="button" class="btn btn-outline-danger"  data-bs-toggle="modal" data-bs-target="#delModal"><i class="bi bi-trash2-fill"></i></button>
                                      <a target="_blank"  href="instructor-course-lessons.php" class="btn btn-outline-secondary"  data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Open Link"><i class="bi bi-box-arrow-up-right"></i></a>
                                      <a href="instructor-course-lessons.php" class="btn btn-outline-success"><i class="bi bi-blockquote-left"></i>Lessons</a>
                                  </td>
                              </tr>
                              <tr>
                                  <th scope="row">13</th>
                                  <td>Ashleigh Langosh</td>
                                  <td>45</td>
                                  <td>
                                      <a href="instructor-edit-course.php" class="btn btn-outline-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Edit Course"><i class="bi bi-pencil-fill"></i></a>
                                      <button type="button" class="btn btn-outline-danger"  data-bs-toggle="modal" data-bs-target="#delModal"><i class="bi bi-trash2-fill"></i></button>
                                      <a target="_blank"  href="instructor-course-lessons.php" class="btn btn-outline-secondary"  data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Open Link"><i class="bi bi-box-arrow-up-right"></i></a>
                                      <a href="instructor-course-lessons.php" class="btn btn-outline-success"><i class="bi bi-blockquote-left"></i>Lessons</a>
                                  </td>
                              </tr>
                              <tr>
                                  <th scope="row">14</th>
                                  <td>Angus Grady</td>
                                  <td>34</td>
                                  <td>
                                      <a href="instructor-edit-course.php" class="btn btn-outline-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Edit Course"><i class="bi bi-pencil-fill"></i></a>
                                      <button type="button" class="btn btn-outline-danger"  data-bs-toggle="modal" data-bs-target="#delModal"><i class="bi bi-trash2-fill"></i></button>
                                      <a target="_blank"  href="instructor-course-lessons.php" class="btn btn-outline-secondary"  data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Open Link"><i class="bi bi-box-arrow-up-right"></i></a>
                                      <a href="instructor-course-lessons.php" class="btn btn-outline-success"><i class="bi bi-blockquote-left"></i>Lessons</a>
                                  </td>
                              </tr>
                              <tr>
                                  <th scope="row">15</th>
                                  <td>Raheem Lehner</td>
                                  <td>47</td>
                                  <td>
                                      <a href="instructor-edit-course.php" class="btn btn-outline-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Edit Course"><i class="bi bi-pencil-fill"></i></a>
                                      <button type="button" class="btn btn-outline-danger"  data-bs-toggle="modal" data-bs-target="#delModal"><i class="bi bi-trash2-fill"></i></button>
                                      <a target="_blank"  href="instructor-course-lessons.php" class="btn btn-outline-secondary"  data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Open Link"><i class="bi bi-box-arrow-up-right"></i></a>
                                      <a href="instructor-course-lessons.php" class="btn btn-outline-success"><i class="bi bi-blockquote-left"></i>Lessons</a>
                                  </td>
                              </tr>
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



  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script>
      $(document).ready(function(){
          $('[data-bs-toggle="tooltip"]').tooltip();
      });
  </script>

  <?=require_once "includes/footer.inc.php";?>

</body>

</html>