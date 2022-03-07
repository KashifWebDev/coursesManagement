<?php
    require_once "includes/app.php";
validateSession();
    require_once "includes/functions.php";
    $path = ROOT_DIR;

    if(isset($_POST["updateUserDetails"])){
        $userID = sanitizeParam($_POST["userID"]);
        $firstName = sanitizeParam($_POST["firstName"]);
        $lastName = sanitizeParam($_POST["lastName"]);
        $email = sanitizeParam($_POST["email"]);

        $s = "UPDATE users SET firstname='$firstName', lastname='$lastName', email='$email'
                WHERE id=$userID";
        if(mysqli_query($con, $s)){
            header('Location: admin-all-teachers.php');
        }else{
            echo mysqli_error($con); exit(); die();
        }
    }
    if(isset($_GET["blockUser"])){
        $blockUser = sanitizeParam($_GET["blockUser"]);
        $newStatus = sanitizeParam($_GET["newStatus"]);

        $s = "UPDATE users SET isBlocked=$newStatus WHERE id=$blockUser";
        if(mysqli_query($con, $s)){
            header('Location: admin-all-teachers.php');
        }else{
            echo mysqli_error($con); exit(); die();
        }
    }
    if(isset($_GET["delUser"])){
        $delUser = sanitizeParam($_GET["delUser"]);

        $s = "DELETE FROM users WHERE id=$delUser";
        if(mysqli_query($con, $s)){
            header('Location: admin-all-teachers.php');
        }else{
            echo mysqli_error($con); exit(); die();
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    $title = "My Instructor"." | TeachMe How";
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

      <div class="pagetitle d-flex justify-content-between">
          <div>
              <h1>Instructors</h1>
              <nav>
                  <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="<?=$path?>instructorDashboard.php">Dashboard</a></li>
                      <li class="breadcrumb-item active">All Instructors</li>
                  </ol>
              </nav>
          </div>
          <div>

<!--              <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addInstructor"><i class="bi bi-person-check-fill me-2"></i>Add New Instructor</button>-->
          </div>
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
                                  <th scope="col">Name</th>
                                  <th scope="col">Email</th>
                                  <th scope="col">Verified</th>
                                  <th scope="col">Courses</th>
                                  <th scope="col">Actions</th>
                              </tr>
                              </thead>
                              <tbody>
                              <?php
                                $s = "SELECT * FROM users WHERE type='Instructor'";
                                $res = mysqli_query($con, $s);
                                if(mysqli_num_rows($res)){
                                    $count = 0;
                                    while($row = mysqli_fetch_array($res)){
                                        $count++;
                                        ?>
                                        <tr>
                                            <th scope="row"><?=$count;?></th>
                                            <td><img style="height: 32px; border-radius: 50%;" class="me-2" src="assets/img/profilePics/<?=$row["pic"]?>" alt=""> <?=$row["firstname"].' '.$row["lastname"];?></td>
                                            <td><?=$row["email"];?></td>
                                            <td class="d-flex justify-content-center" style="font-size: 26px">
                                                <?php if($row["verified"]){ ?>
                                                    <i class="bi bi-check-circle-fill text-success"></i>
                                                <?php } else{ ?>
                                                    <i class="bi bi-x-circle-fill text-danger"></i>
                                                <?php } ?>
                                            </td>
                                            <td><?=3;?></td>
                                            <td>
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editInstructor_<?=$row["id"];?>">
                                                    <i class="bi bi-pencil-fill me-1"></i> Edit
                                                </button>
                                                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#delInstructor_<?=$row["id"];?>">
                                                    <i class="bi bi-trash2-fill me-1"></i> Delete
                                                </button>
                                                <?php
                                                if($row["isBlocked"]){ ?>
                                                    <a href="admin-all-teachers.php?blockUser=<?=$row["id"]?>&newStatus=0" class="btn btn-danger text-white">
                                                        <i class="bi bi-shield-shaded me-1"></i>
                                                        Un Block
                                                    </a>
                                                <?php } else{ ?>
                                                    <a href="admin-all-teachers.php?blockUser=<?=$row["id"]?>&newStatus=1" class="btn btn-danger text-white">
                                                        <i class="bi bi-shield-shaded me-1"></i>
                                                        Block
                                                    </a>
                                                <?php }
                                                ?>
                                            </td>
                                        </tr>


                                        <div class="modal fade" id="editInstructor_<?=$row["id"];?>" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header text-white bg-primary">
                                                        <h5 class="modal-title">Edit Instructor</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <form method="post" action="">
                                                            <input type="hidden" name="userID" value="<?=$row["id"]?>">
                                                            <div class="row">
                                                                <div class="col-md-12 mb-3">
                                                                    <div class="form-floating">
                                                                        <input type="text" class="form-control" name="firstName" id="floatingName" placeholder="First Name" value="<?=$row["firstname"]?>">
                                                                        <label for="floatingName">First Name</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12 mb-3">
                                                                    <div class="form-floating">
                                                                        <input type="text" class="form-control" name="lastName" id="floatingName" placeholder="Last Name" value="<?=$row["lastname"]?>">
                                                                        <label for="floatingName">Last Name</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12 mb-3">
                                                                    <div class="form-floating">
                                                                        <input type="email" class="form-control" name="email" id="floatingName" placeholder="Email" value="<?=$row["email"]?>">
                                                                        <label for="floatingName">Email</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <button type="submit" name="updateUserDetails" class="btn btn-primary w-100">
                                                                        <i class="bi bi-pencil me-1"></i>
                                                                        Update Details
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
                                        </div>

                                        <div class="modal fade" id="delInstructor_<?=$row["id"];?>" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header text-white bg-primary">
                                                        <h5 class="modal-title">Delete User</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to delete this user?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <a href="admin-all-teachers.php?delUser=<?=$row["id"]?>" class="btn btn-primary">Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                              <?php
                                    }
                                }else{
                                    echo "<td>No Instructors found!</td>";
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



  <div class="modal fade" id="addInstructor" tabindex="-1">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header text-white bg-primary">
                  <h5 class="modal-title">Add new instructor</h5>
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
  </div>

  <?=require_once "includes/footer.inc.php";?>

</body>

</html>