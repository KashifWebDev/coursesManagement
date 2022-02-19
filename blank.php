<?php
require_once "includes/app.php";
require_once "includes/functions.php";
$path = ROOT_DIR;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    $title = "Blank Page"." | TeachMe How";
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
      <h1>Blank Page</h1>
      <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?=ROOT_DIR?>instructorDashboard.php">Dashboard</a></li>
          <li class="breadcrumb-item">Pages</li>
          <li class="breadcrumb-item active">Blank</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-6">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Example Card</h5>
              <p>This is an examle page with no contrnt. You can use it as a starter for your custom pages.</p>
            </div>
          </div>

        </div>

        <div class="col-lg-6">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Example Card</h5>
              <p>This is an examle page with no contrnt. You can use it as a starter for your custom pages.</p>
            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

<?=require_once "includes/footer.inc.php";?>

</body>

</html>