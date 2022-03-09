<?php
$userID = $_SESSION["userID"];
$s = "SELECT pic FROM users WHERE id=$userID";
$res = mysqli_query($con, $s);
$picRow = mysqli_fetch_array($res);
$userPic = $picRow["pic"];
?>

<header id="header" class="header fixed-top" style="height: auto;<?=isset($_SESSION["impersonate"]) && $_SESSION["impersonate"] == true ? "margin-bottom: 147px": ""?>">
    <?php if(isset($_SESSION["impersonate"]) && $_SESSION["impersonate"] == true) { ?>
        <div class="row text-dark bg-warning-light" style="backgroundd-color: #ec8e1f7a;font-size: 15px; font-family: 'Open Sans';max-height: 45px;">
            <div class="col-md-1" style="padding-top:2px; text-align: right;">

                <i class="bi bi-person-bounding-box" style="font-size: 27px;"></i>

            </div>
            <div class="col-md-6" style="padding-top:8px;">

                <b>You are currently impersonating <?=$_SESSION["fullName"]?>.</b>

            </div>
            <div class="col-md-3">
                <a href="switchAdmin.php?admin=1">
                    <div style="text-align: right;">
                        <button type="button" id="btnSave" class="btn btn-warning">
                            <i class="bi bi-arrow-return-left me-2"></i>Return to Super Admin
                        </button>
                    </div>
                </a>
            </div>

        </div>
    <?php } ?>
    <div class="d-flex align-items-center">
        <div class="d-flex align-items-center justify-content-between">
            <a href="#" class="logo d-flex align-items-center">
                <img src="<?=$path?>assets/img/logo_top.png" alt="">
                <span class="d-none d-lg-block">TeachMe How</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->


        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">

                <li class="nav-item d-block d-lg-none">
                    <a class="nav-link nav-icon search-bar-toggle " href="#">
                        <i class="bi bi-search"></i>
                    </a>
                </li><!-- End Search Icon-->


                <li class="nav-item dropdown pe-3">

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <img src="assets/img/profilePics/<?=$userPic?>" alt="Profile" class="rounded-circle">
                        <span class="d-none d-md-block dropdown-toggle ps-2"><?=$_SESSION["firstName"]?></span>
                    </a><!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6><?=$_SESSION["fullName"]?></h6>
                            <span><?=$_SESSION["role"]?></span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="profile.php">
                                <i class="bi bi-person"></i>
                                <span>My Profile</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="profile.php">
                                <i class="bi bi-gear"></i>
                                <span>Account Settings</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="includes/logout.php">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign Out</span>
                            </a>
                        </li>

                    </ul><!-- End Profile Dropdown Items -->
                </li><!-- End Profile Nav -->

            </ul>
        </nav><!-- End Icons Navigation -->
    </div>

</header>