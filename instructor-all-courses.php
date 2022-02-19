<?php
    require_once "includes/app.php";
    require_once "includes/functions.php";
    $path = ROOT_DIR;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    $title = "My Profile"." | TeachMe How";
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
          <h1>My Courses</h1>
          <nav>
              <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="<?=ROOT_DIR?>instructorDashboard.php">Dashboard</a></li>
                  <li class="breadcrumb-item">My Courses</li>
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
                                  <th scope="col">Course Name</th>
                                  <th scope="col">Lessons</th>
                              </tr>
                              </thead>
                              <tbody>
                              <tr>
                                  <th scope="row">1</th>
                                  <td>Brandon Jacob</td>
                                  <td>28</td>
                              </tr>
                              <tr>
                                  <th scope="row">2</th>
                                  <td>Bridie Kessler</td>
                                  <td>35</td>
                              </tr>
                              <tr>
                                  <th scope="row">3</th>
                                  <td>Ashleigh Langosh</td>
                                  <td>45</td>
                              </tr>
                              <tr>
                                  <th scope="row">4</th>
                                  <td>Angus Grady</td>
                                  <td>34</td>
                              </tr>
                              <tr>
                                  <th scope="row">5</th>
                                  <td>Raheem Lehner</td>
                                  <td>47</td>
                              </tr>
                              <tr>
                                  <th scope="row">6</th>
                                  <td>Brandon Jacob</td>
                                  <td>28</td>
                              </tr>
                              <tr>
                                  <th scope="row">7</th>
                                  <td>Bridie Kessler</td>
                                  <td>35</td>
                              </tr>
                              <tr>
                                  <th scope="row">8</th>
                                  <td>Ashleigh Langosh</td>
                                  <td>45</td>
                              </tr>
                              <tr>
                                  <th scope="row">9</th>
                                  <td>Angus Grady</td>
                                  <td>34</td>
                              </tr>
                              <tr>
                                  <th scope="row">10</th>
                                  <td>Raheem Lehner</td>
                                  <td>47</td>
                              </tr>
                              <tr>
                                  <th scope="row">11</th>
                                  <td>Brandon Jacob</td>
                                  <td>28</td>
                              </tr>
                              <tr>
                                  <th scope="row">12</th>
                                  <td>Bridie Kessler</td>
                                  <td>35</td>
                              </tr>
                              <tr>
                                  <th scope="row">13</th>
                                  <td>Ashleigh Langosh</td>
                                  <td>45</td>
                              </tr>
                              <tr>
                                  <th scope="row">14</th>
                                  <td>Angus Grady</td>
                                  <td>34</td>
                              </tr>
                              <tr>
                                  <th scope="row">15</th>
                                  <td>Raheem Lehner</td>
                                  <td>47</td>
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