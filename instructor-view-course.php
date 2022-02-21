<?php
    require_once "includes/app.php";
    require_once "includes/functions.php";
    $path = ROOT_DIR;
    $courseID = sanitizeParam($_GET["courseID"]);
    if(isset($_POST["addVideo"])){
        $lessonName = sanitizeParam($_POST["lessonName"]);
        $video = sanitizeParam($_POST["video"]);
        $s = "INSERT INTO lessons (course_id, name, type, content) VALUES ($courseID, '$lessonName', 'video', '$video')";
        if(mysqli_query($con, $s)){
            header('Location: instructor-view-course.php?courseID='.$courseID);
        }
    }
    if(isset($_POST["editVideo"])){
        $lessonName = sanitizeParam($_POST["lessonName"]);
        $video = sanitizeParam($_POST["video"]);

        $courseID = sanitizeParam($_POST["courseID"]);
        $lessonID = sanitizeParam($_POST["lessonID"]);

        $s = "UPDATE lessons SET name='$lessonName', content='$video' WHERE course_id=$courseID AND id=$lessonID";
        if(mysqli_query($con, $s)){
            header('Location: instructor-view-course.php?courseID='.$courseID);
        }
    }
    if(isset($_GET["delLesson"])){
        $courseID = sanitizeParam($_GET["courseID"]);
        $lessonID = sanitizeParam($_GET["lessonID"]);

        $s = "DELETE FROM lessons WHERE id=$lessonID AND course_id=$courseID";
        if(mysqli_query($con, $s)){
            header('Location: instructor-view-course.php?courseID='.$courseID);
        }
    }
    if(isset($_POST["editCourse"])){
    $title = sanitizeParam($_POST["title"]);
    $access = sanitizeParam($_POST["options"]);
    $description = sanitizeParam($_POST["description"]);

    $s = "UPDATE courses SET title='$title', access='$access',description='description'  WHERE id=$courseID";
    if(mysqli_query($con, $s)){
        header('Location: instructor-view-course.php?courseID='.$courseID);
    }
}
    if(isset($_POST['uploadImg'])) {
        $target_dir = "assets/img/courses-thumnail/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        $fileName = $_FILES["fileToUpload"]["name"];
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
//                echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
                    $s = "UPDATE courses SET thumbnail='$fileName' WHERE id=$courseID";
//                    echo $s; exit(); die();
                    mysqli_query($con, $s);
                    header('Location: instructor-view-course.php?courseID='.$courseID);
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }

    $s = "SELECT * FROM courses WHERE id=$courseID";
    $res = mysqli_query($con, $s);
    $courseRow = mysqli_fetch_array($res);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    $title = "Lesson Name"." | TeachMe How";
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

      <div class="card">
          <div class="card-body p-2">
              <div class="row">
                  <div class="col-md-3 d-flex flex-column align-items-center">
                      <form action="" method="post" id="image_upload_form"  enctype="multipart/form-data">
                          <div class="course-img-container w-100">
                              <img id="courseImgThumbnail" src="assets/img/courses-thumnail/<?=$courseRow["thumbnail"];?>" alt="Profile" class="img-thumbnail h-100 w-100">
                              <button type="button" id="courseImageChange" class="btn btn-primary">
                                  <i class="bi bi-image-fill me-2"></i>
                                  Upload
                              </button>
                          </div>
                          <input id='fileid' type='file' name="fileToUpload" hidden/>
                          <input id="proceedUploadImage" name="uploadImg" type="submit"  hidden/>
                      </form>
                  </div>
                  <div class="col-md-9">
                      <div class="d-flex align-items-center">
                          <h2 class="mb-2 customHeading">
                              <?=$courseRow["title"];?>
                          </h2>
                          <span class="badge bg-info ms-3" style="height: fit-content"><?=$courseRow["access"];?></span>
                          <button class="btn btn-outline-secondary ms-3"  data-bs-toggle="modal" data-bs-target="#editCourse">
                              <i class="bi bi-pencil-fill" style="font-size: initial"></i>
                          </button>
                      </div>
                      <p class="small fst-italic">
                          <?=$courseRow["description"];?>
                      </p>
                  </div>
              </div>
          </div>
      </div>

      <div class="modal fade" id="editCourse" tabindex="-1">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header bg-primary text-light">
                      <h5 class="modal-title">Edit Course</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                      <form class="row g-3" action="" method="post">
                          <div class="col-md-12">
                              <label for="inputNanme4" class="form-label">Course Title</label>
                              <input type="text" class="form-control" id="inputNanme4" value="<?=$courseRow["title"];?>" name="title">
                          </div>

                          <div class="col-md-12 d-flex flex-column">
                              <p class="me-2">Select Course Access</p>

                              <div>
                                  <input type="radio" class="btn-check" name="options" id="option4" autocomplete="off" value="Draft" <?=$courseRow["access"]=="Draft"?"checked":"";?>>
                                  <label class="btn btn-outline-info me-2" for="option4">Draft</label>

                                  <input type="radio" class="btn-check" name="options" id="option1" autocomplete="off" value="Free" <?=$courseRow["access"]=="Free"?"checked":"";?>>
                                  <label class="btn btn-outline-secondary me-2" for="option1">Free</label>

                                  <input type="radio" class="btn-check" name="options" id="option2" autocomplete="off" value="Registration" <?=$courseRow["access"]=="Registration"?"checked":"";?>>
                                  <label class="btn btn-outline-danger me-2" for="option2">Registration</label>

                                  <input type="radio" class="btn-check" name="options" id="option3" autocomplete="off" value="Paid" <?=$courseRow["access"]=="Paid"?"checked":"";?>>
                                  <label class="btn btn-outline-success me-2" for="option3">Paid</label>
                              </div>
                          </div>

                          <div class="col-md-12">
                              <textarea class="tinymce-editor" name="description">
                                    <?=$courseRow["description"];?>
                              </textarea>
                          </div>

                          <div class="row justify-content-center">
                              <div class="col-md-6">
                                  <button type="submit" id="submitBtn" class="btn btn-primary w-100 mt-3 rounded-pill" name="editCourse">
                                      <i class="bi bi-pencil-fill me-2"></i>
                                      Edit Course
                                  </button>
                              </div>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>

      <section class="section">
          <div class="row">
              <div class="col-lg-12">

                  <div class="card">
                      <div class="card-body p-2">
                          <div class="row">
                              <div class="col-md-3 justify-content-center shadow-lg pb-3">
                                  <h3 class="customHeading text-center">Lessons</h3>
                                  <div id="lessonsList">
                                      <div id="loader" class="my-3 d-flex justify-content-center align-items-center">
                                          <div class="spinner-border text-primary" role="status">
                                              <span class="visually-hidden">Loading...</span>
                                          </div>
                                          <span class="ms-2">Fetching Lessons..</span>
                                      </div>
                                  </div>
                                  <hr>
                                  <button class="btn btn-outline-primary w-100"  data-bs-toggle="modal" data-bs-target="#addNewLesson">
                                      <i class="bi bi-plus-square-dotted"></i>
                                      Add a Lesson
                                  </button>
                              </div>
                              <div class="col-md-9">
                                  <div class="col-md-12 justify-content-center">
                                      <div id="loader1" class="my-3 d-flex justify-content-center align-items-center">
                                          <div class="spinner-border text-primary" role="status">
                                              <span class="visually-hidden">Loading...</span>
                                          </div>
                                          <span class="ms-2">Fetching Lessons..</span>
                                      </div>
                                      <div id="courseContent">
                                          <div id="placeholderIcon" class="d-flex align-items-center justify-content-center">
<!--                                              <i style="font-size: 155px;" class="ri-play-list-2-fill text-secondary"></i>-->
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>

                  <hr>

                  <div class="card">
                      <div class="card-body p-2">
                          <div class="row">
                              <div class="col-md-2 d-flex flex-column align-items-center">
                                  <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle" style="max-width: 80px;">
                                  <h2 style="font-size: 24px; font-weight: 700; color: #2c384e; margin: 10px 0 0 0;">Kevin Anderson</h2>
                                  <h3 style="font-size: 18px;">Instructor</h3>
                              </div>
                              <div class="col-md-10">
                                  <h5 class="card-title">About Instructor</h5>
                                  <p class="small fst-italic">Sunt est soluta temporibus accusantium neque nam maiores cumque temporibus. Tempora libero non est unde veniam est qui dolor.
                                      Ut sunt iure rerum quae quisquam autem eveniet perspiciatis
                                      odit. Fuga sequi sed ea saepe at unde.</p>
                              </div>
                          </div>
                      </div>
                  </div>

              </div>
          </div>
      </section>

  </main><!-- End #main -->


  <!-- Add New Lesson Modal-->
  <div class="modal fade" id="addNewLesson" tabindex="-1">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title">Add Lesson</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <div class="row g-3">

                      <div class="col-md-12 d-flex align-items-center">
                          <p class="form-label me-2">Select Lesson Type  </p>
                          <input type="radio" class="btn-check" name="options" id="option11" autocomplete="off" checked="" value="test">
                          <label class="btn btn-outline-info me-2" for="option11" style="margin-right: 10px!important;">
                              <i class="bi bi-list-check"></i>
                              Test
                          </label>

                          <input type="radio" class="btn-check" name="options" id="option22" autocomplete="off" value="link">
                          <label class="btn btn-outline-info me-2" for="option22">
                              <i class="ri-links-line"></i>
                              Link
                          </label>

                          <input type="radio" class="btn-check" name="options" id="option33" autocomplete="off" value="file">
                          <label class="btn btn-outline-info me-2" for="option33">
                              <i class="ri-file-line"></i>
                              File
                          </label>

                          <input type="radio" class="btn-check" name="options" id="option44" autocomplete="off" value="video">
                          <label class="btn btn-outline-info" for="option44">
                              <i class="ri-video-fill"></i>
                              Video
                          </label>

                      </div>

                      <div id="lesssonType_1" style="">
                          <div class="row">
                              <form action="instructor-all-courses.php" method="post" class="row g-3">
                                  <input type="hidden" name="selectedOption" value="test">
                                  <div class="col-md-12 mb-3">
                                      <div class="form-floating">
                                          <input type="text" class="form-control" id="floatingName" placeholder="Test Name">
                                          <label for="floatingName">Test Name</label>
                                      </div>
                                  </div>
                                  <hr>

                                  <div class="col-md-12 mb-3">
                                      <div class="form-floating">
                                          <input type="text" class="form-control" id="floatignQuestion" placeholder="Enter the question">
                                          <label for="floatignQuestion">Type the question</label>
                                      </div>
                                  </div>

                                  <div class="col-md-12 mb-2 d-flex">
                                      <div class="col-10">
                                          <div class="form-floating">
                                              <input type="text" class="form-control" id="floatingAnsw1" placeholder="Enter Answer" name="q1ans1">
                                              <label for="floatingEmail">Enter First Answer</label>
                                          </div>
                                      </div>
                                      <div class="ms-2">
                                          <div class="form-check">
                                              <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="q1correct1">
                                              <label class="form-check-label" for="gridRadios1">
                                                  Select
                                              </label>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-md-12 mb-2 d-flex">
                                      <div class="col-10">
                                          <div class="form-floating">
                                              <input type="text" class="form-control" id="floatingAnsw1" placeholder="Enter Answer" name="q1ans2">
                                              <label for="floatingEmail">Enter Second Answer (Optional)</label>
                                          </div>
                                      </div>
                                      <div class="ms-2">
                                          <div class="form-check">
                                              <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="q1correct2">
                                              <label class="form-check-label" for="gridRadios2">
                                                  Select
                                              </label>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-md-12 mb-2 d-flex">
                                      <div class="col-10">
                                          <div class="form-floating">
                                              <input type="text" class="form-control" id="floatingAnsw1" placeholder="Enter Answer" name="q1ans3">
                                              <label for="floatingEmail">Enter Third Answer (Optional)</label>
                                          </div>
                                      </div>
                                      <div class="ms-2">
                                          <div class="form-check">
                                              <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios3" value="q1correct3">
                                              <label class="form-check-label" for="gridRadios3">
                                                  Select
                                              </label>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-md-12 mb-2 d-flex">
                                      <div class="col-10">
                                          <div class="form-floating">
                                              <input type="text" class="form-control" id="floatingAnsw1" placeholder="Enter Answer" name="q1ans4">
                                              <label for="floatingEmail">Enter Forth Answer (Optional)</label>
                                          </div>
                                      </div>
                                      <div class="ms-2">
                                          <div class="form-check">
                                              <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios4" value="q1correct4">
                                              <label class="form-check-label" for="gridRadios4">
                                                  Select
                                              </label>
                                          </div>
                                      </div>
                                  </div>

                                  <div class="col-md-12 d-flex justify-content-center">
                                      <div class="col-md-6">
                                          <button type="submit" class="btn btn-primary w-100 mt-3 rounded-pill">
                                              <i class="bi bi-plus-circle-fill mr-2"></i>
                                              Save Lesson
                                          </button>
                                      </div>
                                  </div>
                              </form>
                          </div>
                      </div>
                      <div id="lesssonType_2" style="display: none;">
                          <div class="row">
                              <form action="instructor-all-courses.php" method="post" class="row1 g-3">
                                  <div class="col-md-12 mb-3">
                                      <div class="form-floating">
                                          <input type="text" class="form-control" id="floatingTutLink" placeholder="Enter Link">
                                          <label for="floatingTutLink">Enter Link</label>
                                      </div>
                                  </div>

                                  <div class="col-md-12 d-flex justify-content-center">
                                      <div class="col-md-6">
                                          <button type="submit" class="btn btn-primary w-100 mt-3 rounded-pill">
                                              <i class="bi bi-plus-circle-fill mr-2"></i>
                                              Save Lesson
                                          </button>
                                      </div>
                                  </div>

                              </form>
                          </div>
                      </div>
                      <div id="lesssonType_3" style="display: none;">
                          <div class="row">
                              <form action="instructor-all-courses.php" method="post" class="row1 g-3">
                                  <div class="row mb-3">
                                      <label for="inputNumber" class="col-sm-2 col-form-label">File Upload</label>
                                      <div class="col-sm-10">
                                          <input class="form-control" type="file" id="formFile">
                                      </div>
                                  </div>

                                  <div class="col-md-12 d-flex justify-content-center">
                                      <div class="col-md-6">
                                          <button type="submit" class="btn btn-primary w-100 mt-3 rounded-pill">
                                              <i class="bi bi-plus-circle-fill mr-2"></i>
                                              Save Lesson
                                          </button>
                                      </div>
                                  </div>

                              </form>
                          </div>
                      </div>
                      <div id="lesssonType_4" style="display: none;">
                          <div class="row">
                              <form action="" method="post" class="row1 g-3">
                                  <div class="col-md-12 mb-3">
                                      <div class="form-floating">
                                          <input type="text" class="form-control" id="floatingName" placeholder="Lesson Name" name="lessonName">
                                          <label for="floatingName">Lesson Name</label>
                                      </div>
                                  </div>

                                  <div class="col-md-12 mb-3">
                                      <div class="form-floating">
                                          <input type="text" class="form-control" id="floatingVideoLink" placeholder="Enter Embed Link of a video" name="video">
                                          <label for="floatingVideoLink">Enter Embed Link of a video</label>
                                      </div>
                                  </div>

                                  <div class="col-md-12 d-flex justify-content-center">
                                      <div class="col-md-6">
                                          <button type="submit" class="btn btn-primary w-100 mt-3 rounded-pill" name="addVideo" id="submitBtn">
                                              <i class="bi bi-plus-circle-fill me-2"></i>
                                              Save Lesson
                                          </button>
                                      </div>
                                  </div>

                              </form>
                          </div>
                      </div>

                  </div>
              </div>
          </div>
      </div>
  </div>
  <!-- Add New Lesson Modal -->

  

  <?=require_once "includes/footer.inc.php";?>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

  <script>
      loader('none');
      loader1('none');
      hideAll();
      $( "#lesssonType_1" ).show();
      getLessons();


      $("#courseImageChange").click(function() {
          // document.getElementById('fileid').click();
          $("#fileid").click();
          // document.getElementById('fileid').click();
      });

      $("#fileid").change(function() {
          $("#proceedUploadImage").click();
      });

      $(document).ready(function(){
          $('[data-bs-toggle="tooltip"]').tooltip();
          $('.sortable').sortable({
              stop:function()
              {
                  var ids = '';
                  $('.sortable li.list-group-item').each(function(){
                      loader('block');
                      id = $(this).attr('id');
                      if(ids=='')
                      {
                          ids = id;
                      }
                      else
                      {
                          ids = ids+','+id;
                      }
                  })
                  $.ajax({
                      url:'api/instructorReArrangeOrderLessons.php',
                      data:'ids='+ids,
                      type:'post',
                      success:function(data)
                      {
                          var output = $.parseJSON(data);
                          console.log(output.refresh);
                          loader('none');
                      }
                  })
              }
          });
      });

      $('input[name="options"]').change(function() {
          hideAll();
          if (this.value == 'test') {
              $( "#lesssonType_1" ).show();
          }
          else if (this.value == 'link') {
              $( "#lesssonType_2" ).show();
          }
          else if (this.value == 'file') {
              $( "#lesssonType_3" ).show();
          }
          else if (this.value == 'video') {
              $( "#lesssonType_4" ).show();
          }
      });

      $('#submitBtn').on('click', function() {
          var $this = $(this);
          var loadingText = '<div class="spinner-border text-light" role="status"></div>';
          if ($(this).html() !== loadingText) {
              $this.data('original-text', $(this).html());
              $this.html(loadingText);
          }
      });

      function hideAll() {
          $( "#lesssonType_1" ).hide();
          $( "#lesssonType_2" ).hide();
          $( "#lesssonType_3" ).hide();
          $( "#lesssonType_4" ).hide();
      }

      function getLessons() {
          loader('block');
          $.ajax({
              url: "api/getLessonsByCourseId.php",
              type: "post",
              data: {
                  courseID: <?=$courseID?>,
              },
              success: function(response) {
                  loader('none');
                  var lessons = $.parseJSON(response);
                  var length = Object.keys(lessons).length;
                  if(length){
                      $('#lessonsList').append('<ul class="list-group sortable" id="lessonsListItems"></ul>');
                      for (lesson of lessons) {
                          $("#lessonsList ul").append('<li class="list-group-item" id="'+lesson.id+'" onclick="getLessonContent('+lesson.id+')">'+lesson.name+'</li>');
                      }
                  }else{
                      $('#lessonsList').append('<hr><h5 class="text-center">No Lessons Found</h5>');
                  }
              },
              error: function(xhr) {
                  alert("Error while fetching courses!\n "+xhr);
              }
          });
      }

      function getLessonContent(lessonID) {
          placeHolderIcon("block");
          $('#courseContent').empty();
          loader1('block');
          $.ajax({
              url: "api/getLessonContentByCourseId.php",
              type: "post",
              data: {
                  courseID: <?=$courseID?>,
                  lessonID: lessonID,
              },
              success: function(response) {
                  loader1('none');
                  if(response==""){
                      $('#courseContent').empty();
                  }else{
                      $('#courseContent').append(response);
                  }
              },
              error: function(xhr) {
                  alert("Error while fetching courses!\n "+xhr);
              }
          });
      }

      function loader(visible) {
          $('#loader').attr('style','display:'+visible+' !important');
      }
      function loader1(visible) {
          $('#loader1').attr('style','display:'+visible+' !important');
      }
      function placeHolderIcon(visible) {
          $('#placeholderIcon').attr('style','display:'+visible+' !important');
      }
  </script>

</body>

</html>