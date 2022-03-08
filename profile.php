<?php
    require_once "includes/app.php";
validateSession();
    require_once "includes/functions.php";
    $path = ROOT_DIR;

$userID = $_SESSION["userID"];
$s = "SELECT * FROM users WHERE id=$userID";
$res = mysqli_query($con, $s);
$userRow = mysqli_fetch_array($res);

    if(isset($_POST["updateProfile"])){
        $firstName = sanitizeParam($_POST["firstName"]);
        $lastName = sanitizeParam($_POST["lastName"]);
        $email = sanitizeParam($_POST["email"]);
        $about = sanitizeParam($_POST["about"]);

        $profilePic = "";
        //Uplaod bottom logo if set
        if (empty($_FILES['profilePic']['name'])) {
            $profilePic = sanitizeParam($_POST["profilePic"]);
        }
        else{
            $target_dir = "assets/img/profilePics/";
            $target_file = $target_dir . basename($_FILES["profilePic"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            // Check file size
            if ($_FILES["profilePic"]["size"] > 10000000) {
                $uploadErrMsg = "Sorry, your file is too large.";
                $uploadOk = 0;
            }
            if (strtolower($imageFileType) == "php" || strtolower($imageFileType) == "php5" ||
                strtolower($imageFileType) == "shtml" || strtolower($imageFileType) == "php3"
                || strtolower($imageFileType) == "php4" || strtolower($imageFileType) == "php5") {
                $uploadErrMsg = "Sorry, this file extension could not be uploaded!.";
                $uploadOk = 0;
            }

            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "<script>alert('".$uploadErrMsg."');</script>";
            } else {
                if (move_uploaded_file($_FILES["profilePic"]["tmp_name"], $target_file)) {
                    $profilePic = $_FILES["profilePic"]["name"];
                } else {
                    echo "<script>alert('Sorry, there was an error uploading your file.');</script>";
                }
            }
        }

        $s = "UPDATE users SET firstname='$firstName', lastname='$lastName',
               email = '$email', about='$about', pic='$profilePic'
                WHERE id=$userID";
        if(mysqli_query($con, $s)){
            header('Location: profile.php');
        }
    }

    if(isset($_POST["changePass"])){
//        print_r($_POST); exit(); die();
        $oldPass = md5(sanitizeParam($_POST["password"]));
        $newpassword = md5(sanitizeParam($_POST["newpassword"]));
        $renewpassword = md5(sanitizeParam($_POST["renewpassword"]));

        if($oldPass != $userRow["password"]){
            header('Location: profile.php?err=Old password you entered was incorrect!');
        }
        if($newpassword != $renewpassword){
            header('Location: profile.php?err=Confirm Password does not match!');
        }

        $s = "UPDATE users SET password='$newpassword' WHERE id=$userID";
        if(mysqli_query($con, $s)){
            header('Location: profile.php?success=1');
        }
    }

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
          <h1>Profile</h1>
          <nav>
              <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="<?=ROOT_DIR?>instructorDashboard.php">Dashboard</a></li>
                  <li class="breadcrumb-item">Users</li>
                  <li class="breadcrumb-item active">Profile</li>
              </ol>
          </nav>
      </div><!-- End Page Title -->

      <div class="row justify-content-center">
          <div class="col-md-5">
              <?php if(isset($_GET["err"])) { ?>
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      <?=$_GET["err"]?>
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
              <?php } ?>
              <?php if(isset($_GET["success"])) { ?>
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                      Your password was updated successfully!
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
              <?php } ?>
          </div>
      </div>

      <section class="section profile">
          <div class="row">
              <div class="col-xl-4">

                  <div class="card">
                      <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                          <img src="assets/img/profilePics/<?=$userRow["pic"]?>" alt="Profile" class="rounded-circle">
                          <h2><?=$userRow["firstname"].' '.$userRow["lastname"]?></h2>
                          <h3><?=$_SESSION["role"]?></h3>
<!--                          <div class="social-links mt-2">-->
<!--                              <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>-->
<!--                              <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>-->
<!--                              <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>-->
<!--                              <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>-->
<!--                          </div>-->
                      </div>
                  </div>

              </div>

              <div class="col-xl-8">

                  <div class="card">
                      <div class="card-body pt-3">
                          <!-- Bordered Tabs -->
                          <ul class="nav nav-tabs nav-tabs-bordered">

                              <li class="nav-item">
                                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                              </li>

                              <li class="nav-item">
                                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                              </li>

<!--                              <li class="nav-item">-->
<!--                                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings">Settings</button>-->
<!--                              </li>-->

                              <li class="nav-item">
                                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                              </li>

                          </ul>
                          <div class="tab-content pt-2">

                              <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                  <h5 class="card-title">About</h5>
                                  <p class="small fst-italic">
                                      <?=$userRow["about"]?>
                                  </p>

                                  <h5 class="card-title">Profile Details</h5>

                                  <div class="row">
                                      <div class="col-lg-3 col-md-4 label ">Full Name</div>
                                      <div class="col-lg-9 col-md-8"><?=$userRow["firstname"].' '.$userRow["lastname"]?></div>
                                  </div>

                                  <div class="row">
                                      <div class="col-lg-3 col-md-4 label ">Username</div>
                                      <div class="col-lg-9 col-md-8"><?=$userRow["username"]?></div>
                                  </div>

                                  <div class="row">
                                      <div class="col-lg-3 col-md-4 label">Role</div>
                                      <div class="col-lg-9 col-md-8"><?=$userRow["type"]?></div>
                                  </div>

<!--                                  <div class="row">-->
<!--                                      <div class="col-lg-3 col-md-4 label">Address</div>-->
<!--                                      <div class="col-lg-9 col-md-8">A108 Adam Street, New York, NY 535022</div>-->
<!--                                  </div>-->
<!---->
<!--                                  <div class="row">-->
<!--                                      <div class="col-lg-3 col-md-4 label">Phone</div>-->
<!--                                      <div class="col-lg-9 col-md-8">(436) 486-3538 x29071</div>-->
<!--                                  </div>-->

                                  <div class="row">
                                      <div class="col-lg-3 col-md-4 label">Email</div>
                                      <div class="col-lg-9 col-md-8"><?=$userRow["email"]?></div>
                                  </div>

                              </div>

                              <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                                  <!-- Profile Edit Form -->
                                  <form action="" method="post" enctype="multipart/form-data">
                                      <div class="row mb-3">
                                          <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                                          <div class="col-md-8 col-lg-9">
                                              <input type="hidden" name="profilePic" value="<?=$userRow["pic"]?>">
                                              <img src="assets/img/profilePics/<?=$userRow["pic"]?>" alt="Profile">
                                              <div class="pt-2">
                                                  <div class="col-sm-5">
                                                      <input name="profilePic" class="form-control" type="file" id="formFile">
                                                  </div>
                                              </div>
                                          </div>
                                      </div>

                                      <div class="row mb-3">
                                          <label for="fullName" class="col-md-4 col-lg-3 col-form-label">First Name</label>
                                          <div class="col-md-8 col-lg-9">
                                              <input name="firstName" type="text" class="form-control" id="fullName" value="<?=$userRow["firstname"]?>">
                                          </div>
                                      </div>

                                      <div class="row mb-3">
                                          <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Last Name</label>
                                          <div class="col-md-8 col-lg-9">
                                              <input name="lastName" type="text" class="form-control" id="fullName" value="<?=$userRow["lastname"]?>">
                                          </div>
                                      </div>

                                      <div class="row mb-3">
                                          <label for="about" class="col-md-4 col-lg-3 col-form-label">About</label>
                                          <div class="col-md-8 col-lg-9">
                                              <textarea name="about" class="form-control" id="about" style="height: 100px"><?=$userRow["about"]?></textarea>
                                          </div>
                                      </div>

                                      <div class="row mb-3">
                                          <label for="company" class="col-md-4 col-lg-3 col-form-label">Username</label>
                                          <div class="col-md-8 col-lg-9">
                                              <input name="company" type="text" class="form-control" id="company" value="<?=$userRow["username"]?>" disabled>
                                          </div>
                                      </div>

                                      <div class="row mb-3">
                                          <label for="Job" class="col-md-4 col-lg-3 col-form-label">Role</label>
                                          <div class="col-md-8 col-lg-9">
                                              <input name="job" type="text" class="form-control" id="Job" value="<?=$userRow["type"]?>" disabled>
                                          </div>
                                      </div>


                                      <div class="row mb-3">
                                          <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                          <div class="col-md-8 col-lg-9">
                                              <input name="email" type="email" class="form-control" id="Email" value="<?=$userRow["email"]?>">
                                          </div>
                                      </div>

                                      <div class="text-center">
                                          <button type="submit" class="btn btn-primary submitBtn" name="updateProfile">
                                              <i class="bi bi-pencil-fill me-2"></i>
                                              Save Changes
                                          </button>
                                      </div>
                                  </form><!-- End Profile Edit Form -->

                              </div>

                              <div class="tab-pane fade pt-3" id="profile-settings">

                                  <!-- Settings Form -->
                                  <form>

                                      <div class="row mb-3">
                                          <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Email Notifications</label>
                                          <div class="col-md-8 col-lg-9">
                                              <div class="form-check">
                                                  <input class="form-check-input" type="checkbox" id="changesMade" checked>
                                                  <label class="form-check-label" for="changesMade">
                                                      Changes made to your account
                                                  </label>
                                              </div>
                                              <div class="form-check">
                                                  <input class="form-check-input" type="checkbox" id="newProducts" checked>
                                                  <label class="form-check-label" for="newProducts">
                                                      Information on new products and services
                                                  </label>
                                              </div>
                                              <div class="form-check">
                                                  <input class="form-check-input" type="checkbox" id="proOffers">
                                                  <label class="form-check-label" for="proOffers">
                                                      Marketing and promo offers
                                                  </label>
                                              </div>
                                              <div class="form-check">
                                                  <input class="form-check-input" type="checkbox" id="securityNotify" checked disabled>
                                                  <label class="form-check-label" for="securityNotify">
                                                      Security alerts
                                                  </label>
                                              </div>
                                          </div>
                                      </div>

                                      <div class="text-center">
                                          <button type="submit" class="btn btn-primary">Save Changes</button>
                                      </div>
                                  </form><!-- End settings Form -->

                              </div>

                              <div class="tab-pane fade pt-3" id="profile-change-password">
                                  <!-- Change Password Form -->
                                  <form method="post" action="">

                                      <div class="row mb-3">
                                          <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                                          <div class="col-md-8 col-lg-9">
                                              <input name="password" type="password" class="form-control" id="currentPassword">
                                          </div>
                                      </div>

                                      <div class="row mb-3">
                                          <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                                          <div class="col-md-8 col-lg-9">
                                              <input name="newpassword" type="password" class="form-control" id="newPassword">
                                          </div>
                                      </div>

                                      <div class="row mb-3">
                                          <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                                          <div class="col-md-8 col-lg-9">
                                              <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                                          </div>
                                      </div>

                                      <div class="text-center">
                                          <button type="submit" class="btn btn-primary submitBtn" name="changePass">
                                              <i class="bi bi-key me-2"></i>
                                              Change Password
                                          </button>
                                      </div>
                                  </form><!-- End Change Password Form -->

                              </div>

                          </div><!-- End Bordered Tabs -->

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