<?php
require_once '../includes/app.php';

$output = array();

$courseID = sanitizeParam($_POST["courseID"]);
$lessonID = sanitizeParam($_POST["lessonID"]);
$s = "SELECT * FROM lessons WHERE course_id=$courseID AND id=$lessonID";
$res = mysqli_query($con, $s);
if(mysqli_num_rows($res)){
    $row = mysqli_fetch_array($res, MYSQLI_ASSOC);
    if($row["type"]=="video"){
        echo video($courseID, $lessonID, $row);
    }else{
        echo general($courseID, $lessonID);
    }
}

function general($courseID, $lessonID){
    return editDel($courseID, $lessonID);
}

function editDel($courseID, $lessonID){
    return '
    
      <div class="d-flex mb-3">
          <button class="btn btn-success me-2" data-bs-toggle="modal" data-bs-target="#EditLesson">
              <i class="bi bi-pencil me-2"></i>
              Edit
          </button>
          <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delModel">
              <i class="bi bi-trash-fill me-2"></i>
              Delete
          </button>
      </div>
      
      
        <!-- Del Lesson Modal-->
      <div class="modal fade" id="delModel" tabindex="-1">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                      <h5 class="modal-title">Delete Lesson</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      Are you sure you want to delete this lesson?
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-danger" onclick="location.href = \'instructor-view-course.php?delLesson=1&courseID='.$courseID.'&&lessonID='.$lessonID.'\';">
                            <i class="bi bi-trash3-fill me-2"></i>
                            Delete
                      </button>
                    </div>
                  </div>
                </div>
              </div>
        <!-- End Del Lesson Modal-->
    ';
}

function video($courseID, $lessonID, $row){
    $url = isset($row["content"]) ? $row["content"] : "";
    $name = isset($row["name"]) ? $row["name"] : "";



    return editDel($courseID, $lessonID).'
    <iframe width="560" height="315"
     src="'.getYoutubeEmbedUrl($url).'"
     title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
      allowfullscreen>
    </iframe>
      
      
        <!-- Edit Lesson Modal-->
      <div class="modal fade" id="EditLesson" tabindex="-1">
          <div class="modal-dialog modal-lg">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title">Edit Lesson</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                      <div class="row g-3">
    
                          <div class="col-md-12 d-flex align-items-center">
                              <p class="form-label me-2">Select Lesson Type  </p>
                              <input type="radio" class="btn-check" name="options_1" id="option1" autocomplete="off" checked="" value="test">
                              <label class="btn btn-outline-info me-2" for="option1" style="margin-right: 10px!important;">
                                  <i class="bi bi-list-check"></i>
                                  Test
                              </label>
    
                              <input type="radio" class="btn-check" name="options_1" id="option2" autocomplete="off" value="link">
                              <label class="btn btn-outline-info me-2" for="option2">
                                  <i class="ri-links-line"></i>
                                  Link
                              </label>
    
                              <input type="radio" class="btn-check" name="options_1" id="option3" autocomplete="off" value="file">
                              <label class="btn btn-outline-info me-2" for="option3">
                                  <i class="ri-file-line"></i>
                                  File
                              </label>
    
                              <input type="radio" class="btn-check" name="options_1" id="option4" autocomplete="off" value="video" checked>
                              <label class="btn btn-outline-info" for="option4">
                                  <i class="ri-video-fill"></i>
                                  Video
                              </label>
    
                          </div>
    
                          <div id="lesssonType_11" style="">
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
                                                  <i class="bi bi-pencil-fill me-2"></i>
                                                  Edit Lesson
                                              </button>
                                          </div>
                                      </div>
                                  </form>
                              </div>
                          </div>
                          <div id="lesssonType_12">
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
                                                  <i class="bi bi-pencil-fill me-2"></i>
                                                  Edit Lesson
                                              </button>
                                          </div>
                                      </div>
    
                                  </form>
                              </div>
                          </div>
                          <div id="lesssonType_13">
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
                                                  <i class="bi bi-pencil-fill me-2"></i>
                                                  Edit Lesson
                                              </button>
                                          </div>
                                      </div>
    
                                  </form>
                              </div>
                          </div>
                          <div id="lesssonType_14">
                              <div class="row">
                                  <form action="" method="post" class="row1 g-3">
                                        
                                       <input type="hidden" name="courseID" value="'.$courseID.'">
                                       <input type="hidden" name="lessonID" value="'.$lessonID.'">
                                        
                                      <div class="col-md-12 mb-3">
                                          <div class="form-floating">
                                              <input type="text" class="form-control" id="floatingName" placeholder="Lesson Name" name="lessonName" value="'.$name.'">
                                              <label for="floatingName">Lesson Name</label>
                                          </div>
                                      </div>
                                  
                                      <div class="col-md-12 mb-3">
                                          <div class="form-floating">
                                              <input type="text" class="form-control" id="floatingVideoLink"
                                               placeholder="Enter Embed Link of a video" value="'.htmlentities($url).'" name="video">
                                              <label for="floatingVideoLink">Enter Embed Link of a video</label>
                                          </div>
                                      </div>
    
                                      <div class="col-md-12 d-flex justify-content-center">
                                          <div class="col-md-6">
                                              <button type="submit" class="btn btn-primary w-100 mt-3 rounded-pill" id="submitBtn" name="editVideo">
                                                  <i class="bi bi-pencil-fill me-2"></i>
                                                  Edit Lesson
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
      <!-- Edit Lesson Modal -->
      
      <script>
      hideAll1();
      function hideAll1() {
          $( "#lesssonType_11" ).hide();
          $( "#lesssonType_12" ).hide();
          $( "#lesssonType_13" ).hide();
          $( "#lesssonType_14" ).hide();
      }
      $( "#lesssonType_14" ).show();
      
      
      $(\'input[name="options_1"]\').change(function() {
          hideAll1();
          if (this.value == \'test\') {
              $( "#lesssonType_11" ).show();
          }
          else if (this.value == \'link\') {
              $( "#lesssonType_12" ).show();
          }
          else if (this.value == \'file\') {
              $( "#lesssonType_13" ).show();
          }
          else if (this.value == \'video\') {
              $( "#lesssonType_14" ).show();
          }
      });
      </script>
    ';
}


function getYoutubeEmbedUrl($url)
{
    $shortUrlRegex = '/youtu.be\/([a-zA-Z0-9_-]+)\??/i';
    $longUrlRegex = '/youtube.com\/((?:embed)|(?:watch))((?:\?v\=)|(?:\/))([a-zA-Z0-9_-]+)/i';

    if (preg_match($longUrlRegex, $url, $matches)) {
        $youtube_id = $matches[count($matches) - 1];
    }

    if (preg_match($shortUrlRegex, $url, $matches)) {
        $youtube_id = $matches[count($matches) - 1];
    }
    return 'https://www.youtube.com/embed/' . $youtube_id ;
}