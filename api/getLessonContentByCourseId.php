<?php
require_once '../includes/app.php';

$output = array();

$courseID = sanitizeParam($_POST["courseID"]);
$lessonID = sanitizeParam($_POST["lessonID"]);
$publicView = isset($_POST["publicView"]) && $_POST["publicView"] ? 1 : 0;

$s = "SELECT * FROM courses WHERE id=$courseID";
$res = mysqli_query($con, $s);
$courseRow = mysqli_fetch_array($res);

$s = "SELECT * FROM lessons WHERE course_id=$courseID AND id=$lessonID";
$res = mysqli_query($con, $s);
if(mysqli_num_rows($res)){
    $row = mysqli_fetch_array($res, MYSQLI_ASSOC);
    $content = $url = isset($row["content"]) ? $row["content"] : "";
    $name = isset($row["name"]) ? $row["name"] : "";

    if($row["type"]=="video"){
        if(!$publicView){
        ?>
            <div class="d-flex mb-3">
                  <button class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#EditLesson">
                      <i class="bi bi-pencil me-2"></i>
                      Edit
                  </button>
                  <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delModel">
                      <i class="bi bi-trash-fill me-2"></i>
                      Delete
                  </button>
                </div>
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
                            <button type="button" class="btn btn-danger" onclick="location.href='instructor-view-course.php?delLesson=1&courseID=<?=$courseID?>&&lessonID=<?=$lessonID?>'";">
                            <i class="bi bi-trash3-fill me-2"></i>
                            Delete
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="EditLesson" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title">Edit Lesson</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row g-3">

                                <div class="col-md-12 d-flex align-items-center">
                                    <p class="form-label me-2">Select Lesson Type  </p>
                                    <input type="radio" class="btn-check" name="options_1" id="option_1" autocomplete="off" value="test">
                                    <label class="btn btn-outline-primary me-2" for="option_1" style="margin-right: 10px!important;">
                                        <i class="bi bi-list-check"></i>
                                        Test
                                    </label>

                                    <input type="radio" class="btn-check" name="options_1" id="option_2" autocomplete="off" value="link">
                                    <label class="btn btn-outline-primary me-2" for="option_2">
                                        <i class="ri-links-line"></i>
                                        Link
                                    </label>

                                    <input type="radio" class="btn-check" name="options_1" id="option_3" autocomplete="off" value="file">
                                    <label class="btn btn-outline-primary me-2" for="option_3">
                                        <i class="ri-file-line"></i>
                                        File
                                    </label>

                                    <input type="radio" class="btn-check" name="options_1" id="option_4" autocomplete="off" value="video" checked="">
                                    <label class="btn btn-outline-primary" for="option_4">
                                        <i class="ri-video-fill"></i>
                                        Video
                                    </label>

                                    <input type="radio" class="btn-check" name="options_1" id="option_5" autocomplete="off" value="text">
                                    <label class="btn btn-outline-primary ms-2" for="option_5">
                                        <i class="bi bi-text-left"></i>
                                        Text
                                    </label>

                                </div>

                                <div id="lesssonType_11" style="display: none;">
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
                                                    <button type="submit" class="btn btn-primary w-100 mt-3 rounded-pill submitBtn">
                                                        <i class="bi bi-plus-circle-fill mr-2"></i>
                                                        Save Lesson
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div id="lesssonType_12" style="display: none;">
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
                                                    <button type="submit" class="btn btn-primary w-100 mt-3 rounded-pill submitBtn" id="submitBtn">
                                                        <i class="bi bi-plus-circle-fill mr-2"></i>
                                                        Update Lesson
                                                    </button>
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                                <div id="lesssonType_13" style="display: none;">
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
                                                    <button type="submit" class="btn btn-primary w-100 mt-3 rounded-pill submitBtn" id="submitBtn">
                                                        <i class="bi bi-plus-circle-fill mr-2"></i>
                                                        Update Lesson
                                                    </button>
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                                <div id="lesssonType_14" style="">
                                    <div class="row">
                                        <form action="" method="post" class="row1 g-3">

                                            <input type="hidden" name="courseID" value="<?=$courseID?>">
                                            <input type="hidden" name="lessonID" value="<?=$lessonID?>">

                                            <div class="col-md-12 mb-3">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" id="floatingName" placeholder="Lesson Name" name="lessonName" value="<?=$name?>">
                                                    <label for="floatingName">Lesson Name</label>
                                                </div>
                                            </div>

                                            <div class="col-md-12 mb-3">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" id="floatingVideoLink" placeholder="Enter Embed Link of a video" name="video" value="<?=$url?>">
                                                    <label for="floatingVideoLink">Enter Link of a video</label>
                                                </div>
                                            </div>

                                            <div class="col-md-12 d-flex justify-content-center">
                                                <div class="col-md-6">
                                                    <button type="submit" class="btn btn-primary w-100 mt-3 rounded-pill submitBtn" name="updateLesson_typeVideo" id="submitBtn">
                                                        <i class="bi bi-pencil-fill me-2"></i>
                                                        Edit Lesson
                                                    </button>
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                                <div id="lesssonType_15">
                                    <div class="row">
                                        <form action="" method="post" class="row1 g-3">

                                            <div class="col-md-12 mb-3">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" id="floatingName" placeholder="Lesson Name" name="lessonName">
                                                    <label for="floatingName">Lesson Name</label>
                                                </div>
                                            </div>

                                            <div class="col-md-12 mt-3">
                                      <textarea class="tinymce-editor" name="lessonContent">
                                        <h3><strong><em>Lesson Description here....</em></strong></h3>
                                      </textarea>
                                            </div>

                                            <div class="col-md-12 d-flex justify-content-center">
                                                <div class="col-md-6">
                                                    <button type="submit" class="btn btn-primary w-100 mt-3 rounded-pill submitBtn" name="saveLesson_typeText" id="submitBtn">
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
            <?php } ?>
        <style>
            .videoContainer {
                position: relative;
                width: 100%;
                height: 100%;
            }
            .video {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
            }
        </style>
               <div class="videoContainer">
                   <iframe
                           src="<?=getYoutubeEmbedUrl($content)?>"
                           title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                           allowfullscreen class="video">
                   </iframe>
               </div>
        <?php  echo loadScripts(); ?>
        <script>$( "#lesssonType_14" ).show();</script>
<?php
    }
    if($row["type"]=="text"){
        if(!$publicView){
        ?>
            <div class="d-flex mb-3">
                  <button class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#EditLesson">
                      <i class="bi bi-pencil me-2"></i>
                      Edit
                  </button>
                  <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delModel">
                      <i class="bi bi-trash-fill me-2"></i>
                      Delete
                  </button>
                </div>
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
                            <button type="button" class="btn btn-danger" onclick="location.href='instructor-view-course.php?delLesson=1&courseID=<?=$courseID?>&&lessonID=<?=$lessonID?>'";">
                            <i class="bi bi-trash3-fill me-2"></i>
                            Delete
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="EditLesson" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title">Edit Lesson</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row g-3">

                                <div class="col-md-12 d-flex align-items-center">
                                    <p class="form-label me-2">Select Lesson Type  </p>
                                    <input type="radio" class="btn-check" name="options_1" id="option_1" autocomplete="off" value="test">
                                    <label class="btn btn-outline-primary me-2" for="option_1" style="margin-right: 10px!important;">
                                        <i class="bi bi-list-check"></i>
                                        Test
                                    </label>

                                    <input type="radio" class="btn-check" name="options_1" id="option_2" autocomplete="off" value="link">
                                    <label class="btn btn-outline-primary me-2" for="option_2">
                                        <i class="ri-links-line"></i>
                                        Link
                                    </label>

                                    <input type="radio" class="btn-check" name="options_1" id="option_3" autocomplete="off" value="file">
                                    <label class="btn btn-outline-primary me-2" for="option_3">
                                        <i class="ri-file-line"></i>
                                        File
                                    </label>

                                    <input type="radio" class="btn-check" name="options_1" id="option_4" autocomplete="off" value="video">
                                    <label class="btn btn-outline-primary" for="option_4">
                                        <i class="ri-video-fill"></i>
                                        Video
                                    </label>

                                    <input type="radio" class="btn-check" name="options_1" id="option_5" autocomplete="off" value="text" checked="">
                                    <label class="btn btn-outline-primary ms-2" for="option_5">
                                        <i class="bi bi-text-left"></i>
                                        Text
                                    </label>

                                </div>

                                <div id="lesssonType_11" style="display: none;">
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
                                                    <button type="submit" class="btn btn-primary w-100 mt-3 rounded-pill submitBtn">
                                                        <i class="bi bi-plus-circle-fill mr-2"></i>
                                                        Save Lesson
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div id="lesssonType_12" style="display: none;">
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
                                                    <button type="submit" class="btn btn-primary w-100 mt-3 rounded-pill submitBtn" id="submitBtn">
                                                        <i class="bi bi-plus-circle-fill mr-2"></i>
                                                        Update Lesson
                                                    </button>
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                                <div id="lesssonType_13" style="display: none;">
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
                                                    <button type="submit" class="btn btn-primary w-100 mt-3 rounded-pill submitBtn" id="submitBtn">
                                                        <i class="bi bi-pencil-fill mr-2"></i>
                                                        Update Lesson
                                                    </button>
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                                <div id="lesssonType_14" style="">
                                    <div class="row">
                                        <form action="" method="post" class="row1 g-3">

                                            <input type="hidden" name="courseID" value="<?=$courseID?>">
                                            <input type="hidden" name="lessonID" value="<?=$lessonID?>">

                                            <div class="col-md-12 mb-3">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" id="floatingName" placeholder="Lesson Name" name="lessonName" value="<?=$name?>">
                                                    <label for="floatingName">Lesson Name</label>
                                                </div>
                                            </div>

                                            <div class="col-md-12 mb-3">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" id="floatingVideoLink" placeholder="Enter Embed Link of a video" name="video">
                                                    <label for="floatingVideoLink">Enter Link of a video</label>
                                                </div>
                                            </div>

                                            <div class="col-md-12 d-flex justify-content-center">
                                                <div class="col-md-6">
                                                    <button type="submit" class="btn btn-primary w-100 mt-3 rounded-pill submitBtn" name="editVideo" id="submitBtn">
                                                        <i class="bi bi-pencil-fill me-2"></i>
                                                        Edit Lesson
                                                    </button>
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                                <div id="lesssonType_15" style="display: none;">
                                    <div class="row">
                                        <form action="" method="post" class="row1 g-3">

                                            <input type="hidden" name="courseID" value="<?=$courseID?>">
                                            <input type="hidden" name="lessonID" value="<?=$lessonID?>">

                                            <div class="col-md-12 mb-3">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" id="floatingName" value="<?=$name?>" name="lessonName">
                                                    <label for="floatingName">Lesson Name</label>
                                                </div>
                                            </div>

                                            <div class="col-md-12 mt-3">
                                      <textarea class="tinymce-editor" name="lessonContent">
                                        <?=$content?>
                                      </textarea>
                                            </div>

                                            <div class="col-md-12 d-flex justify-content-center">
                                                <div class="col-md-6">
                                                    <button type="submit" class="btn btn-primary w-100 mt-3 rounded-pill submitBtn" name="updateLesson_typeText" id="submitBtn">
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
            <?php } ?>
            <div class="row h-100">
                <div class="col-md-12 textBckColor h-100" style="overflow-y: auto;">
                    <?=$content?>
                </div>
            </div>
        <style>
            ::-webkit-scrollbar {
                height: 12px;
                width: 12px;
                background: <?=$courseRow["back_clr"];?>;
            }

            ::-webkit-scrollbar-thumb {
                background: <?=$courseRow["front_clr"];?>;
                -webkit-border-radius: 1ex;
                -webkit-box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.75);
            }

            ::-webkit-scrollbar-corner {
                background: #000;
            }
            .textBckColor{
                background-color: <?=$courseRow["back_clr"];?>;
            }

        </style>
        <?php  echo loadScripts(); ?>
        <script>$( "#lesssonType_15" ).show();</script>
<?php
    }
    if($row["type"]=="file"){
        if(!$publicView){
        ?>
            <div class="d-flex mb-3">
                  <button class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#EditLesson">
                      <i class="bi bi-pencil me-2"></i>
                      Edit
                  </button>
                  <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delModel">
                      <i class="bi bi-trash-fill me-2"></i>
                      Delete
                  </button>
                </div>
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
                            <button type="button" class="btn btn-danger" onclick="location.href='instructor-view-course.php?delLesson=1&courseID=<?=$courseID?>&&lessonID=<?=$lessonID?>'";">
                            <i class="bi bi-trash3-fill me-2"></i>
                            Delete
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="EditLesson" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title">Edit Lesson</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row g-3">

                                <div class="col-md-12 d-flex align-items-center">
                                    <p class="form-label me-2">Select Lesson Type  </p>
                                    <input type="radio" class="btn-check" name="options_1" id="option_1" autocomplete="off" value="test">
                                    <label class="btn btn-outline-primary me-2" for="option_1" style="margin-right: 10px!important;">
                                        <i class="bi bi-list-check"></i>
                                        Test
                                    </label>

                                    <input type="radio" class="btn-check" name="options_1" id="option_2" autocomplete="off" value="link">
                                    <label class="btn btn-outline-primary me-2" for="option_2">
                                        <i class="ri-links-line"></i>
                                        Link
                                    </label>

                                    <input type="radio" class="btn-check" name="options_1" id="option_3" autocomplete="off" value="file" checked="">
                                    <label class="btn btn-outline-primary me-2" for="option_3">
                                        <i class="ri-file-line"></i>
                                        File
                                    </label>

                                    <input type="radio" class="btn-check" name="options_1" id="option_4" autocomplete="off" value="video">
                                    <label class="btn btn-outline-primary" for="option_4">
                                        <i class="ri-video-fill"></i>
                                        Video
                                    </label>

                                    <input type="radio" class="btn-check" name="options_1" id="option_5" autocomplete="off" value="text">
                                    <label class="btn btn-outline-primary ms-2" for="option_5">
                                        <i class="bi bi-text-left"></i>
                                        Text
                                    </label>

                                </div>

                                <div id="lesssonType_11" style="display: none;">
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
                                                    <button type="submit" class="btn btn-primary w-100 mt-3 rounded-pill submitBtn">
                                                        <i class="bi bi-plus-circle-fill mr-2"></i>
                                                        Save Lesson
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div id="lesssonType_12" style="display: none;">
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
                                                    <button type="submit" class="btn btn-primary w-100 mt-3 rounded-pill submitBtn" id="submitBtn">
                                                        <i class="bi bi-pencil-fill mr-2"></i>
                                                        Update Lesson
                                                    </button>
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                                <div id="lesssonType_13" style="display: none;">
                                    <div class="row">
                                        <form action="" method="post" class="row1 g-3" enctype="multipart/form-data">

                                            <input type="hidden" name="courseID" value="<?=$courseID?>">
                                            <input type="hidden" name="lessonID" value="<?=$lessonID?>">

                                            <div class="col-md-12 mb-3">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" id="floatingName" value="<?=$name?>" name="lessonName">
                                                    <label for="floatingName">Lesson Name</label>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="inputNumber" class="col-sm-2 col-form-label">File Upload</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" name="fileToUpload" type="file" id="formFile">
                                                </div>
                                            </div>

                                            <div class="col-md-12 d-flex justify-content-center">
                                                <div class="col-md-6">
                                                    <button type="submit" name="updateLesson_typeFile" class="btn btn-primary w-100 mt-3 rounded-pill submitBtn" id="submitBtn">
                                                        <i class="bi bi-plus-circle-fill mr-2"></i>
                                                        Update Lesson
                                                    </button>
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                                <div id="lesssonType_14" style="">
                                    <div class="row">
                                        <form action="" method="post" class="row1 g-3">

                                            <input type="hidden" name="courseID" value="<?=$courseID?>">
                                            <input type="hidden" name="lessonID" value="<?=$lessonID?>">

                                            <div class="col-md-12 mb-3">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" id="floatingName" placeholder="Lesson Name" name="lessonName" value="<?=$name?>">
                                                    <label for="floatingName">Lesson Name</label>
                                                </div>
                                            </div>

                                            <div class="col-md-12 mb-3">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" id="floatingVideoLink" placeholder="Enter Embed Link of a video" name="video">
                                                    <label for="floatingVideoLink">Enter Link of a video</label>
                                                </div>
                                            </div>

                                            <div class="col-md-12 d-flex justify-content-center">
                                                <div class="col-md-6">
                                                    <button type="submit" class="btn btn-primary w-100 mt-3 rounded-pill submitBtn" name="editVideo" id="submitBtn">
                                                        <i class="bi bi-pencil-fill me-2"></i>
                                                        Edit Lesson
                                                    </button>
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                                <div id="lesssonType_15" style="display: none;">
                                    <div class="row">
                                        <form action="" method="post" class="row1 g-3">

                                            <input type="hidden" name="courseID" value="<?=$courseID?>">
                                            <input type="hidden" name="lessonID" value="<?=$lessonID?>">

                                            <div class="col-md-12 mb-3">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" id="floatingName" value="<?=$name?>" name="lessonName">
                                                    <label for="floatingName">Lesson Name</label>
                                                </div>
                                            </div>

                                            <div class="col-md-12 mt-3">
                                      <textarea class="tinymce-editor" name="lessonContent">
                                        <?=$content?>
                                      </textarea>
                                            </div>

                                            <div class="col-md-12 d-flex justify-content-center">
                                                <div class="col-md-6">
                                                    <button type="submit" class="btn btn-primary w-100 mt-3 rounded-pill submitBtn" name="updateLesson_typeText" id="submitBtn">
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
            <?php } ?>
            <div class="row h-100">
                <div class="col-md-12">
                    <?php if(strpos($content,".pdf") !== false){ ?>

                        <embed src="assets/lessonsFiles/<?=$content?>" width="100%" height="100%"
                               type="application/pdf">
                    <?php }else{ ?>
                            <div class="row align-items-center justify-content-center">
                                <div class="customHeading text-center">
                                    <a href="assets/lessonsFiles/<?=$content?>">Click Here</a> to open the attached file.
                                </div>
                            </div>
                    <?php } ?>
                </div>
            </div>
        <?php  echo loadScripts(); ?>
        <script>$( "#lesssonType_13" ).show();</script>
<?php
    }
    if($row["type"]=="link"){
        if(!$publicView){
        ?>
            <div class="d-flex mb-3">
                  <button class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#EditLesson">
                      <i class="bi bi-pencil me-2"></i>
                      Edit
                  </button>
                  <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delModel">
                      <i class="bi bi-trash-fill me-2"></i>
                      Delete
                  </button>
                </div>
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
                            <button type="button" class="btn btn-danger" onclick="location.href='instructor-view-course.php?delLesson=1&courseID=<?=$courseID?>&&lessonID=<?=$lessonID?>'";">
                            <i class="bi bi-trash3-fill me-2"></i>
                            Delete
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="EditLesson" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title">Edit Lesson</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row g-3">

                                <div class="col-md-12 d-flex align-items-center">
                                    <p class="form-label me-2">Select Lesson Type  </p>
                                    <input type="radio" class="btn-check" name="options_1" id="option_1" autocomplete="off" value="test">
                                    <label class="btn btn-outline-primary me-2" for="option_1" style="margin-right: 10px!important;">
                                        <i class="bi bi-list-check"></i>
                                        Test
                                    </label>

                                    <input type="radio" class="btn-check" name="options_1" id="option_2" autocomplete="off" value="link" checked="">
                                    <label class="btn btn-outline-primary me-2" for="option_2">
                                        <i class="ri-links-line"></i>
                                        Link
                                    </label>

                                    <input type="radio" class="btn-check" name="options_1" id="option_3" autocomplete="off" value="file">
                                    <label class="btn btn-outline-primary me-2" for="option_3">
                                        <i class="ri-file-line"></i>
                                        File
                                    </label>

                                    <input type="radio" class="btn-check" name="options_1" id="option_4" autocomplete="off" value="video">
                                    <label class="btn btn-outline-primary" for="option_4">
                                        <i class="ri-video-fill"></i>
                                        Video
                                    </label>

                                    <input type="radio" class="btn-check" name="options_1" id="option_5" autocomplete="off" value="text">
                                    <label class="btn btn-outline-primary ms-2" for="option_5">
                                        <i class="bi bi-text-left"></i>
                                        Text
                                    </label>

                                </div>

                                <div id="lesssonType_11" style="display: none;">
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
                                                    <button type="submit" class="btn btn-primary w-100 mt-3 rounded-pill submitBtn">
                                                        <i class="bi bi-plus-circle-fill mr-2"></i>
                                                        Save Lesson
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div id="lesssonType_12" style="display: none;">
                                    <div class="row">
                                        <form action="" method="post" class="row1 g-3">

                                            <input type="hidden" name="courseID" value="<?=$courseID?>">
                                            <input type="hidden" name="lessonID" value="<?=$lessonID?>">

                                            <div class="col-md-12 mb-3">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" id="floatingName" value="<?=$name?>" name="lessonName">
                                                    <label for="floatingName">Lesson Name</label>
                                                </div>
                                            </div>

                                            <div class="col-md-12 mb-3">
                                                <div class="form-floating">
                                                    <input type="text" name="link" class="form-control" id="floatingTutLink" value="<?=$content?>">
                                                    <label for="floatingTutLink">Enter Link</label>
                                                </div>
                                            </div>

                                            <div class="col-md-12 d-flex justify-content-center">
                                                <div class="col-md-6">
                                                    <button name="updateLesson_typeLink" type="submit" class="btn btn-primary w-100 mt-3 rounded-pill submitBtn" id="submitBtn">
                                                        <i class="bi bi-pencil-fill mr-2"></i>
                                                        Update Lesson
                                                    </button>
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                                <div id="lesssonType_13" style="display: none;">
                                    <div class="row">
                                        <form action="" method="post" class="row1 g-3" enctype="multipart/form-data">

                                            <input type="hidden" name="courseID" value="<?=$courseID?>">
                                            <input type="hidden" name="lessonID" value="<?=$lessonID?>">

                                            <div class="col-md-12 mb-3">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" id="floatingName" value="<?=$name?>" name="lessonName">
                                                    <label for="floatingName">Lesson Name</label>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="inputNumber" class="col-sm-2 col-form-label">File Upload</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" name="fileToUpload" type="file" id="formFile">
                                                </div>
                                            </div>

                                            <div class="col-md-12 d-flex justify-content-center">
                                                <div class="col-md-6">
                                                    <button type="submit" name="updateLesson_typeFile" class="btn btn-primary w-100 mt-3 rounded-pill submitBtn" id="submitBtn">
                                                        <i class="bi bi-plus-circle-fill mr-2"></i>
                                                        Update Lesson
                                                    </button>
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                                <div id="lesssonType_14" style="">
                                    <div class="row">
                                        <form action="" method="post" class="row1 g-3">

                                            <input type="hidden" name="courseID" value="<?=$courseID?>">
                                            <input type="hidden" name="lessonID" value="<?=$lessonID?>">

                                            <div class="col-md-12 mb-3">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" id="floatingName" placeholder="Lesson Name" name="lessonName" value="<?=$name?>">
                                                    <label for="floatingName">Lesson Name</label>
                                                </div>
                                            </div>

                                            <div class="col-md-12 mb-3">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" id="floatingVideoLink" placeholder="Enter Embed Link of a video" name="video">
                                                    <label for="floatingVideoLink">Enter Link of a video</label>
                                                </div>
                                            </div>

                                            <div class="col-md-12 d-flex justify-content-center">
                                                <div class="col-md-6">
                                                    <button type="submit" class="btn btn-primary w-100 mt-3 rounded-pill submitBtn" name="editVideo" id="submitBtn">
                                                        <i class="bi bi-pencil-fill me-2"></i>
                                                        Edit Lesson
                                                    </button>
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                                <div id="lesssonType_15" style="display: none;">
                                    <div class="row">
                                        <form action="" method="post" class="row1 g-3">

                                            <input type="hidden" name="courseID" value="<?=$courseID?>">
                                            <input type="hidden" name="lessonID" value="<?=$lessonID?>">

                                            <div class="col-md-12 mb-3">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" id="floatingName" value="<?=$name?>" name="lessonName">
                                                    <label for="floatingName">Lesson Name</label>
                                                </div>
                                            </div>

                                            <div class="col-md-12 mt-3">
                                      <textarea class="tinymce-editor" name="lessonContent">
                                        <?=$content?>
                                      </textarea>
                                            </div>

                                            <div class="col-md-12 d-flex justify-content-center">
                                                <div class="col-md-6">
                                                    <button type="submit" class="btn btn-primary w-100 mt-3 rounded-pill submitBtn" name="updateLesson_typeText" id="submitBtn">
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
            <?php } ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="row align-items-center justify-content-center">
                        <div class="customHeading text-center">
                            <a target="_blank" href="<?=$content?>">Click Here</a> to open the link.
                        </div>
                    </div>
                </div>
            </div>
        <?php  echo loadScripts(); ?>
        <script>$( "#lesssonType_12" ).show();</script>
<?php
    }
}

function loadScripts(){
    return '
        <script>
            hideAll1();
            function hideAll1() {
                $( "#lesssonType_11" ).hide();
                $( "#lesssonType_12" ).hide();
                $( "#lesssonType_13" ).hide();
                $( "#lesssonType_14" ).hide();
                $( "#lesssonType_15" ).hide();
            }

            $(\'input[name="options_1"]\').change(function() {
            hideAll1();
            //console.log(this.value);
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
            else if (this.value == \'text\') {
            $( "#lesssonType_15" ).show();
            }
            });
            
            var useDarkMode = window.matchMedia(\'(prefers-color-scheme: dark)\').matches;
               tinymce.init({
    selector: \'textarea.tinymce-editor\',
    plugins: \'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons\',
    imagetools_cors_hosts: [\'picsum.photos\'],
    menubar: \'file edit view insert format tools table help\',
    toolbar: \'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl\',
    toolbar_sticky: true,
    autosave_ask_before_unload: true,
    autosave_interval: \'30s\',
    autosave_prefix: \'{path}{query}-{id}-\',
    autosave_restore_when_empty: false,
    autosave_retention: \'2m\',
    image_advtab: true,
    link_list: [{
        title: \'My page 1\',
        value: \'https://www.tiny.cloud\'
      },
      {
        title: \'My page 2\',
        value: \'http://www.moxiecode.com\'
      }
    ],
    image_list: [{
        title: \'My page 1\',
        value: \'https://www.tiny.cloud\'
      },
      {
        title: \'My page 2\',
        value: \'http://www.moxiecode.com\'
      }
    ],
    image_class_list: [{
        title: \'None\',
        value: \'\'
      },
      {
        title: \'Some class\',
        value: \'class-name\'
      }
    ],
    importcss_append: true,
    file_picker_callback: function(callback, value, meta) {
      /* Provide file and text for the link dialog */
      if (meta.filetype === \'file\') {
        callback(\'https://www.google.com/logos/google.jpg\', {
          text: \'My text\'
        });
      }

      /* Provide image and alt text for the image dialog */
      if (meta.filetype === \'image\') {
        callback(\'https://www.google.com/logos/google.jpg\', {
          alt: \'My alt text\'
        });
      }

      /* Provide alternative source and posted for the media dialog */
      if (meta.filetype === \'media\') {
        callback(\'movie.mp4\', {
          source2: \'alt.ogg\',
          poster: \'https://www.google.com/logos/google.jpg\'
        });
      }
    },
    templates: [{
        title: \'New Table\',
        description: \'creates a new table\',
        content: \'<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>\'
      },
      {
        title: \'Starting my story\',
        description: \'A cure for writers block\',
        content: \'Once upon a time...\'
      },
      {
        title: \'New list with dates\',
        description: \'New List with dates\',
        content: \'<div class="mceTmpl"><span class="cdate">cdate</span><br /><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>\'
      }
    ],
    template_cdate_format: \'[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]\',
    template_mdate_format: \'[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]\',
    height: 300,
    image_caption: true,
    quickbars_selection_toolbar: \'bold italic | quicklink h2 h3 blockquote quickimage quicktable\',
    noneditable_noneditable_class: \'mceNonEditable\',
    toolbar_mode: \'sliding\',
    contextmenu: \'link image imagetools table\',
    skin:  \'oxide\',
    content_css:  \'default\',
    content_style: \'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }\'
  });
      
      

      $(\'.submitBtn\').on(\'click\', function() {
          var $this = $(this);
          var loadingText = \'<div class="spinner-border text-light" role="status"></div>\';
          if ($(this).html() !== loadingText) {
              $this.data(\'original-text\', $(this).html());
              $this.html(loadingText);
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