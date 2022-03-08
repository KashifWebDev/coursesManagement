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
    $title = "My Courses"." | TeachMe How";
        require "includes/head.inc.php";
    ?>
</head>

<body>

  <!-- ======= Header ======= -->
    <?=require_once "includes/header.inc.php";?>
  <!-- End Header -->
<?php
      require_once "includes/studentSideBar.inc.php";
  ?>

  <main id="main" class="main">

      <div class="pagetitle d-flex justify-content-between">
          <div>
              <h1>My Courses</h1>
              <nav>
                  <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="<?=$path?>instructorDashboard.php">Dashboard</a></li>
                      <li class="breadcrumb-item active">My Courses</li>
                  </ol>
              </nav>
          </div>
          <div>

<!--              <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#basicModal"><i class="bi bi-person-check-fill me-2"></i>Add New Student</button>-->
<!--              <button type="button" class="btn btn-success" ><i class="ri-file-excel-line me-2" style="font-size: 17px;"></i>Export All</button>-->
          </div>
      </div><!-- End Page Title -->

      <div class="modal fade" id="basicModal" tabindex="-1">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title">Enroll New Student</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">

                      <form>
                          <div class="row">
                              <div class="col-md-12 mb-3">
                                  <div class="form-floating">
                                      <input type="text" class="form-control" id="floatingName" placeholder="First Name">
                                      <label for="floatingName">First Name</label>
                                  </div>
                              </div>
                              <div class="col-md-12 mb-3">
                                  <div class="form-floating">
                                      <input type="text" class="form-control" id="floatingName" placeholder="Last Name">
                                      <label for="floatingName">Last Name</label>
                                  </div>
                              </div>
                              <div class="col-md-12 mb-3">
                                  <div class="form-floating">
                                      <input type="email" class="form-control" id="floatingName" placeholder="Email">
                                      <label for="floatingName">Email</label>
                                  </div>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-md-6">
                                  <button type="button" class="btn btn-primary w-100">
                                      <i class="ri-mail-send-line me-1"></i>
                                      Send Invitation
                                  </button>
                              </div>
                              <div class="col-md-6">
                                  <button type="button" class="btn btn-secondary w-100" data-bs-dismiss="modal">
                                      <i class="ri-close-circle-line"></i>
                                      Cancel
                                  </button>
                              </div>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
      </div><!-- End Basic Modal-->

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
                                  <th scope="col">Name</th>
                                  <th scope="col">Course</th>
                                  <th scope="col">Start Date</th>
                              </tr>
                              </thead>
                              <tbody>
                              <?php
                              $s = "SELECT * FROM users WHERE type='Student'";
                              $res = mysqli_query($con, $s);
                              while($row = mysqli_fetch_array($res)){
                                  ?>
                                  <tr>
                                      <th scope="row"><?=$row["id"]?></th>
                                      <td><img style="height: 32px; border-radius: 50%;" class="me-2" src="assets/img/profilePics/<?=$row["pic"]?>" alt="Profile Pic"><?=$row["firstname"].' '.$row["lastname"]?></td>
                                      <td>Graphic Designing Course</td>
                                      <td>2016-05-25</td>
                                  </tr>
                                  <?php
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