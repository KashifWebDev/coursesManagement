<?php
    require_once "includes/app.php";
validateSession();
    require_once "includes/functions.php";
    $path = ROOT_DIR;
    $courseID = sanitizeParam($_GET["courseID"]);

    if(isset($_POST["updateChapterTitle"])){
        $lessonName = sanitizeParam($_POST["chapterName"]);
        $link = sanitizeParam($_POST["link"]);

        $courseID = sanitizeParam($_POST["courseID"]);
        $lessonID = sanitizeParam($_POST["lessonID"]);

        $s = "UPDATE lessons SET name='$lessonName' WHERE course_id=$courseID AND id=$lessonID";
        if(mysqli_query($con, $s)){
            header('Location: instructor-view-course.php?courseID='.$courseID);
        }
    }

    if(isset($_GET["delChapter"])){
        $courseID = sanitizeParam($_GET["courseID"]);
        $lessonID = sanitizeParam($_GET["lessonID"]);

        $s = "DELETE FROM lessons WHERE course_id=$courseID AND id=$lessonID";
        if(mysqli_query($con, $s)){
            header('Location: instructor-view-course.php?courseID='.$courseID);
        }
    }

    if(isset($_POST["saveLesson_typeVideo"])){
        $lessonName = $_POST["lessonName"]=="" ? "Lesson Name" : sanitizeParam($_POST["lessonName"]);
        $video = sanitizeParam($_POST["video"]);

        $s = "INSERT INTO lessons (course_id, name, type, content) VALUES
                ($courseID, '$lessonName', 'video', '$video')";
        if(mysqli_query($con, $s)){
            header('Location: instructor-view-course.php?courseID='.$courseID);
        }
    }

    if(isset($_POST["saveLesson_typeLink"])){
        $lessonName = $_POST["lessonName"]=="" ? "Lesson Name" : sanitizeParam($_POST["lessonName"]);
        $link = sanitizeParam($_POST["link"]);

        $s = "INSERT INTO lessons (course_id, name, type, content) VALUES
                ($courseID, '$lessonName', 'link', '$link')";
        if(mysqli_query($con, $s)){
            header('Location: instructor-view-course.php?courseID='.$courseID);
        }
    }

    if(isset($_POST["updateLesson_typeLink"])){
        $lessonName = $_POST["lessonName"]=="" ? "Lesson Name" : sanitizeParam($_POST["lessonName"]);
        $link = sanitizeParam($_POST["link"]);
        $lessonType = sanitizeParam($_POST["selectedLessonType"]);

        $courseID = sanitizeParam($_POST["courseID"]);
        $lessonID = sanitizeParam($_POST["lessonID"]);

        $s = "UPDATE lessons SET name='$lessonName',content='$link', type='$lessonType' 
              WHERE course_id=$courseID AND id=$lessonID";
        if(mysqli_query($con, $s)){
            header('Location: instructor-view-course.php?courseID='.$courseID);
        }
    }

    if(isset($_POST["updateLessonAccess"])){
        $accessType = $_POST["accessType"]=="1" ? 1:0;

        $courseID = sanitizeParam($_POST["courseID"]);
        $lessonID = sanitizeParam($_POST["lessonID"]);

        $s = "UPDATE lessons SET is_free=$accessType
                WHERE course_id=$courseID AND id=$lessonID";
        if(mysqli_query($con, $s)){
            header('Location: instructor-view-course.php?courseID='.$courseID);
        }
    }

    if(isset($_POST["saveLesson_typeText"])){
        $lessonName = $_POST["lessonName"]=="" ? "Lesson Name" : sanitizeParam($_POST["lessonName"]);
        $lessonContent = sanitizeParam($_POST["lessonContent"]);

        $s = "INSERT INTO lessons (course_id, name, type, content) VALUES
                ($courseID, '$lessonName', 'text', '$lessonContent')";
        if(mysqli_query($con, $s)){
            header('Location: instructor-view-course.php?courseID='.$courseID);
        }
    }

    if(isset($_POST["saveLesson_typeFile"])){
        $lessonName = $_POST["lessonName"]=="" ? "Lesson Name" : sanitizeParam($_POST["lessonName"]);

        $target_dir = "assets/lessonsFiles/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $fileName = $_FILES["fileToUpload"]["name"];
        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 10000000) {
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
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    $s = "INSERT INTO lessons (course_id, name, type, content) VALUES
                    ($courseID, '$lessonName', 'file', '$fileName')";
                    if(mysqli_query($con, $s)){
                        header('Location: instructor-view-course.php?courseID='.$courseID);
                    }
            } else {
                echo "<script>alert('Sorry, there was an error uploading your file.');</script>";
            }
        }
    }

    if(isset($_POST["updateLesson_typeFile"])){
        $lessonName = sanitizeParam($_POST["lessonName"]);
        $lessonType = sanitizeParam($_POST["selectedLessonType"]);

        $courseID = sanitizeParam($_POST["courseID"]);
        $lessonID = sanitizeParam($_POST["lessonID"]);

        $target_dir = "assets/lessonsFiles/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $fileName = $_FILES["fileToUpload"]["name"];
        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) {
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
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    $s = "UPDATE lessons SET name='$lessonName', content='$fileName', type='$lessonType' 
                            WHERE course_id=$courseID AND id=$lessonID";
                    if(mysqli_query($con, $s)){
                        header('Location: instructor-view-course.php?courseID='.$courseID);
                    }
            } else {
                echo "<script>alert('Sorry, there was an error uploading your file.');</script>";
            }
        }
    }

    if(isset($_POST["addChapter"])){
        $chapterName = sanitizeParam($_POST["chapterName"]);
        $courseID = sanitizeParam($_POST["courseID"]);

        $s = "INSERT INTO lessons (course_id, name, is_chapter)
              VALUES ($courseID, '$chapterName', 1)";
        if(mysqli_query($con, $s)){
            header('Location: instructor-view-course.php?courseID='.$courseID);
        }
    }

    if(isset($_POST["saveColors"])){

        $back = sanitizeParam($_POST["back"]);
        $front = sanitizeParam($_POST["front"]);
        $bgType = sanitizeParam($_POST["bgType"]);
        $txtLessonBackground = sanitizeParam($_POST["txtLessonBackground"]);
        $courseTitleBg = sanitizeParam($_POST["courseTitleBg"]);
        $courseTitleFg = sanitizeParam($_POST["courseTitleFg"]);
        $signBgColor = isset($_POST["signBgColor"]) ? sanitizeParam($_POST["signBgColor"]) : '';
        $signFgColor = isset($_POST["signFgColor"]) ? sanitizeParam($_POST["signFgColor"]) : '';

        $bottomLogo = "";
       //Uplaod bottom logo if set
        if (empty($_FILES['bottomLogo']['name'])) {
            $bottomLogo = sanitizeParam($_POST["bottomLogoSelected"]);
        }
        else{
            $target_dir = "assets/img/bottomLogo/";
            $target_file = $target_dir . basename($_FILES["bottomLogo"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            // Check file size
            if ($_FILES["bottomLogo"]["size"] > 10000000) {
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
                if (move_uploaded_file($_FILES["bottomLogo"]["tmp_name"], $target_file)) {
                    $bottomLogo = $_FILES["bottomLogo"]["name"];
                } else {
                    echo "<script>alert('Sorry, there was an error uploading your file.');</script>";
                }
            }
        }
        if($bgType=="image"){
            if (empty($_FILES['fileToUpload']['name'])) {
                $fileName = sanitizeParam($_POST["selectedImg"]);
                $s = "UPDATE courses SET back_clr='$back', front_clr='$front',page_background_type='image',
                          page_background_image='$fileName', txtLessonBackground='$txtLessonBackground', courseTitleBg='$courseTitleBg',
                        courseTitleFg='$courseTitleFg', signFgColor='$signFgColor', signBgColor='$signBgColor', bottomLogo='$bottomLogo'
                            WHERE id=$courseID ";
                if(mysqli_query($con, $s)){
                    header('Location: instructor-view-course.php?courseID='.$courseID);
                }
            }
            else{
                $target_dir = "assets/img/course-bg/";
                $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                $fileName = $_FILES["fileToUpload"]["name"];
                // Check file size
                if ($_FILES["fileToUpload"]["size"] > 10000000) {
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
                    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                        $s = "UPDATE courses SET back_clr='$back', front_clr='$front',page_background_type='image',
                          page_background_image='$fileName', txtLessonBackground='$txtLessonBackground',
                        courseTitleBg='$courseTitleBg', courseTitleFg='$courseTitleFg',
                         signFgColor='$signFgColor', signBgColor='$signBgColor', bottomLogo='$bottomLogo' WHERE id=$courseID ";
                        if(mysqli_query($con, $s)){
                            header('Location: instructor-view-course.php?courseID='.$courseID);
                        }
                    } else {
                        echo "<script>alert('Sorry, there was an error uploading your file.');</script>";
                    }
                }
            }
        }
        if($bgType=="color"){
            $bgColor = sanitizeParam($_POST["bgColor"]);
            $s = "UPDATE courses SET back_clr='$back', front_clr='$front',page_background_type='color',
                          page_background_color='$bgColor', txtLessonBackground='$txtLessonBackground',
                            courseTitleBg='$courseTitleBg', courseTitleFg='$courseTitleFg',
                   signFgColor='$signFgColor', signBgColor='$signBgColor', bottomLogo='$bottomLogo' 
                    WHERE id=$courseID ";
            if(mysqli_query($con, $s)){
                header('Location: instructor-view-course.php?courseID='.$courseID);
            }
        }
    }

    if(isset($_POST["updateLesson_typeVideo"])){
        $lessonName = sanitizeParam($_POST["lessonName"]);
        $lessonType = sanitizeParam($_POST["selectedLessonType"]);
        $video = sanitizeParam($_POST["video"]);

        $courseID = sanitizeParam($_POST["courseID"]);
        $lessonID = sanitizeParam($_POST["lessonID"]);

        $s = "UPDATE lessons SET name='$lessonName', content='$video', type='$lessonType' WHERE course_id=$courseID AND id=$lessonID";
        if(mysqli_query($con, $s)){
            header('Location: instructor-view-course.php?courseID='.$courseID);
        }
    }

    if(isset($_POST["updateLesson_typeText"])){
        $lessonName = sanitizeParam($_POST["lessonName"]);
        $lessonContent = sanitizeParam($_POST["lessonContent"]);
        $lessonType = sanitizeParam($_POST["selectedLessonType"]);

        $courseID = sanitizeParam($_POST["courseID"]);
        $lessonID = sanitizeParam($_POST["lessonID"]);

        $s = "UPDATE lessons SET name='$lessonName', content='$lessonContent', type='$lessonType' WHERE course_id=$courseID AND id=$lessonID";
        if(mysqli_query($con, $s)){
            header('Location: instructor-view-course.php?courseID='.$courseID);
        }
    }

    if(isset($_POST["updateDraftStatus"])){
        $setStatus = $_POST["setStatus"]=="active" ? 0:1;

        $s = "UPDATE courses SET draft=$setStatus WHERE id=$courseID";
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

    if(isset($_GET["delCourse"])){
        $courseID = sanitizeParam($_GET["delCourse"]);

        $s = "DELETE FROM courses WHERE id=$courseID";
        if(mysqli_query($con, $s)){
            header('Location: instructor-all-courses.php');
        }
    }

    if(isset($_POST["editCourse"])){
//        print_r($_POST);exit();die();
        $course_title = sanitizeParam($_POST["course_title"]);
        $randomCourseID = sanitizeParam($_POST["courseID"]);
        $access_type = sanitizeParam($_POST["access_type"]);
        $timeLimit = sanitizeParam($_POST["timeLimit"]);
        $timeLimitValue = sanitizeParam($_POST["timeLimitValue"]);
        $reg_req_email = isset($_POST["reg_req_email"]) ? 1 : 0;
        $reg_req_phone = isset($_POST["reg_req_phone"]) ? 1 : 0;
        $reg_req_address = isset($_POST["reg_req_address"]) ? 1 : 0;
        $reg_req_tos = isset($_POST["reg_req_tos"]) ? 1 : 0;
        $price = sanitizeParam($_POST["price"]);
        $paypal_email = sanitizeParam($_POST["paypal_email"]);
        $instructor_name = sanitizeParam($_POST["instructor_name"]);
        $course_description = sanitizeParam($_POST["course_description"]);
        $aboutInstructor = sanitizeParam($_POST["aboutInstructor"]);
        $instructorPicture = sanitizeParam($_POST["instructorPicture"]);
        $coursePassword = $_POST["coursePassword"]=="" ? null : $_POST["coursePassword"];
        $website = sanitizeParam($_POST["website"]);
        $facebook = sanitizeParam($_POST["facebook"]);
        $insta = sanitizeParam($_POST["insta"]);
        $linkedin = sanitizeParam($_POST["linkedin"]);
        $currency = sanitizeParam($_POST["currency"]);
        $fancy_title = sanitizeParam($_POST["fancy_title"]);

        if($access_type=="Free"){
            $timeLimitValue = $timeLimitValue = $reg_req_tos = $reg_req_address = $reg_req_phone = $reg_req_email = $paypal_email = null;
            $price = 0;
        }
        if($access_type=="Registration"){
            $paypal_email = null;
            $price = 0;
        }
        if($access_type=="Paid"){
            $timeLimitValue = $timeLimitValue = $reg_req_tos = $reg_req_address = $reg_req_phone = $reg_req_email = null;
        }

        if (empty($_FILES['instructorPictureUpload']['name'])) {
            $instructorPicture = sanitizeParam($_POST["instructorPicture"]);
        }
        else{
            $target_dir = "assets/img/instructorPic/";
            $target_file = $target_dir . basename($_FILES["instructorPictureUpload"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            // Check file size
            if ($_FILES["bottomLogo"]["size"] > 10000000) {
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
                if (move_uploaded_file($_FILES["instructorPictureUpload"]["tmp_name"], $target_file)) {
                    $instructorPicture = $_FILES["instructorPictureUpload"]["name"];
                } else {
                    echo "<script>alert('Sorry, there was an error uploading your file.');</script>";
                }
            }
        }

        $s = "UPDATE courses SET title='$course_title',access='$access_type',description='$course_description',courseID='$randomCourseID',
              timeLimitType='$timeLimit',timeLimitType='$timeLimitValue',registration_required_email='$reg_req_email',
              registration_required_phone='$reg_req_phone',registration_required_address='$reg_req_address',
              registration_required_tos='$reg_req_tos',price='$price',paypal_email='$paypal_email',
                   instructor_name='$instructor_name', coursePassword='$coursePassword', aboutInstructor='$aboutInstructor',
                   instructorPicture='$instructorPicture', instructur_website='$website', instructur_insta='$insta',
                   instructur_facebook='$facebook', instructur_linkedin='$linkedin', currency='$currency', fancy_title='$fancy_title'
                WHERE id=$courseID";
//        echo $s; exit(); die();
        if(!mysqli_query($con, $s)){
            echo mysqli_error($con); exit(); die();
        }
    if(mysqli_query($con, $s)){
        header('Location: instructor-view-course.php?courseID='.$courseID);
    }
}

    if(isset($_POST['uploadImg'])) {
//        print_r($_POST); exit(); die();
        $target_dir = "assets/img/courses-thumnail/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        $fileName = $_FILES["fileToUpload"]["name"];
        if ($check !== false) {
//            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            $uploadErrMsg = "File is not an image.";
            $uploadOk = 0;
        }
        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 999999) {
            $uploadErrMsg = "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif") {
            $uploadErrMsg = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "<script>alert('".$uploadErrMsg."');</script>";
            echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } elseif ($uploadOk==1) {
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
    $instructorID = $courseRow["instructor_id"];

    $s = "SELECT concat(firstname,' ',lastname) as fullName, about FROM users WHERE id=$instructorID";
    $res = mysqli_query($con, $s);
    $instructorRow = mysqli_fetch_array($res);
    $instructor_name = $instructorRow["fullName"];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    $title = $courseRow["title"]." | TeachMe How";
        require "includes/head.inc.php";
    ?>
    <style>
        /* Let's get this party started */
        .sidebar1::-webkit-scrollbar {
            width: 12px;
        }

        /* Track */
        .sidebar1::-webkit-scrollbar-track {
            -webkit-border-radius: 10px;
            border-radius: 10px;
        }

        /* Handle */
        .sidebar1::-webkit-scrollbar-thumb {
            -webkit-border-radius: 10px;
            border-radius: 10px;
            background: <?=$courseRow["front_clr"]?>;
            -webkit-box-shadow: inset 0 0 0 <?=$courseRow["back_clr"]?>;
        }
    </style>
</head>
<?php
if($courseRow["page_background_type"]=="image"){
    $bgImg = $courseRow["page_background_image"];
    $style = "background-image: url('assets/img/course-bg/$bgImg');";
}else{
    $bgClr = $courseRow["page_background_color"];
    $style = "background-color: $bgClr";
}
?>
<body style="<?=$style?>">

   <div style="width: 95%; height: 95vh" class="mx-auto pt-4">
    <div class="mainDiv text-white h-100 position-relative">
        <header id="header" class="header m-0 row titleColors" style="border-top-right-radius: 40px;border-top-left-radius: 40px;">

            <div class="col-md-8 d-flex justify-content-end align-items-center">
                <!--        <i class="bi bi-list toggle-sidebar-btn mb-2 me-3" id="lsnHeading"></i>-->
                <h2 style="height: 40px;" class="mb-0"><?=$courseRow["fancy_title"];?></h2>
            </div>
            <div class="col-md-4 header-nav d-flex justify-content-end">
                <ul class="d-flex align-items-center">

                    <a href="instructor-all-courses.php" class="btn btn-danger text-white">
                        <i class="bi bi-house-fill"></i>
                    </a>
                    <button class="btn btn-primary btn-outline-dark customColors ms-2" data-bs-toggle="modal" data-bs-target="#colorPickerModal">
                        <i class="bi bi-palette"></i>
                    </button>
                    <button class="btn btn-secondary ms-2" data-bs-toggle="modal" data-bs-target="#draftCourseModel">
                        <i class="ri-save-3-line me-1"></i>
                    </button>
                    <button class="btn btn-primary ms-2"  data-bs-toggle="modal" data-bs-target="#editCourse">
                        <i class="bi bi-pencil-fill me-1"></i>
                    </button>
                    <a target="_blank" class="btn btn-info text-white ms-2" href="course-<?=$courseRow["courseID"]?>">
                        <i class="bi bi-eye-fill"></i>
                    </a>

                </ul>
            </div>


        </header>

        <aside id="sidebar" class="sidebar customColors p-0 m-0" style=";z-index: 999; top: 0; position: absolute; overflow-x: hidden;border-top-left-radius: 40px;border-bottom-left-radius: 40px;overflow: hidden;">
            <div class="d-flex flex-column h-100 pe-0 pb-0" style="overflow: hidden">
                <div class="d-flex justify-content-center sticky-top w-100">
                    <form action="" method="post" id="image_upload_form" enctype="multipart/form-data">
                        <div class="position-relative viewCourseThumbnail">
                            <img style="max-height: 120px;transition: .4s ease-in-out;"
                                 id="courseImgThumbnail" src="assets/img/courses-thumnail/<?=$courseRow["thumbnail"];?>"
                                 alt="Profile" class="">
                            <button type="button" id="courseImageChange" class="btn btn-primary w-75">
                                <i class="bi bi-image-fill me-2"></i>
                                Upload
                            </button>
                        </div>
                        <input id='fileid' type='file' name="fileToUpload" hidden/>
                        <input id="proceedUploadImage" name="uploadImg" type="submit"  hidden/>
                    </form>
                </div>
                <div class="w-100 sidebar1" style="overflow-y: scroll">
                    <div class="col-md-12 justify-content-center pb-3 customColors">
                        <div class="d-flex justify-content-around align-items-center mb-3">
                            <h3 class="customHeading text-center customColors" id="lsnHeading"></h3>
                        </div>
                        <div id="lessonsList">
                            <div id="loader" class="my-3 d-flex justify-content-center align-items-center">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                                <span class="ms-2">Fetching Lessons..</span>
                            </div>
                            <id id="ChaptersList"></id>
                        </div>

                        <hr>
                        <button class="btn w-100 customColors" data-bs-toggle="modal" data-bs-target="#addNewLesson">
                            <i class="bi bi-plus-square-dotted"></i>
                            <span>Add a Lesson</span>
                        </button>
                        <button class="btn w-100 customColors mt-2" data-bs-toggle="modal" data-bs-target="#addChapter">
                            <i class="bi bi-plus-square-dotted"></i>
                            <span>Add a Chapter</span>
                        </button>
                    </div>
                </div>
<!--                <div class="w-100 mt-auto sticky-bottom" style="; height: fit-content;">-->
<!--                    <div class="siteSignature text-center bg-light">-->
<!--                        <div class="d-flex align-items-center justify-content-center bottomSignatureBg">-->
<!--                            <img src="assets/img/logo_top.png" alt="Site Logo" height="70px">-->
<!--                            <div class="d-flex flex-column ps-2 fw-bold">-->
<!--                                <p class="m-0 bottomSignature" style="font-size: larger">Created With</p>-->
<!--                                <p class="m-0 bottomSignature">TeachMeHow.me</p>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
                <div class="w-100 mt-auto sticky-bottom" style="; height: fit-content;">
                    <div class="siteSignature text-center bg-light">
                        <div class="d-flex align-items-center justify-content-center customColors">
                            <img src="assets/img/bottomLogo/<?=$courseRow["bottomLogo"]?>" alt="Site Logo" class="" height="120px">
                        </div>
                    </div>
                </div>
            </div>
        </aside>

        <main id="main" class="main pb-0 mb-0 mt-0" style="padding-right: 0px !important; padding-left: 0px; padding-top: 0px; position: absolute; left: 0; right: 0; top: 60px; bottom: 0;">

            <div class="d-flex flex-column h-100">
                <div class="customColors" style="height: 80%;">
                    <div id="loader1" class="my-3 d-flex justify-content-center align-items-center">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <span class="ms-2">Fetching Lessons..</span>
                    </div>
                    <div id="courseContent" class="w-100 customColors" style="height: 100%">
                        <div class="row justify-content-center h-100 customColors w-100">
                            <div class="col-md-12 justify-content-center h-100">
                                <div id="loader1" class="my-3 loader1 justify-content-center align-items-center">
                                    <div class="spinner-border text-primary" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                    <span class="ms-2">Fetching Lessons..</span>
                                </div>
                                <div id="courseContent" class="h-100">
                                    <div id="placeholderIcon" class="d-flex align-items-center justify-content-center">
                                        <div class="container-fluid p-5 text-white text-center h-100 d-flex flex-column justify-content-center customColors">
                                            <h1 class="customColors">Start adding new lessons to the course!</h1>
                                            <p style="font-size: larger" class="customColors">Please use the left menu to add/edit lessosn and chapters!</p>
                                            <div class="alert alert-info mx-auto d-flex align-items-center" role="alert">
                                                <i class="bi bi-bell-fill fw-bold me-2" style="font-size: x-large"></i> Use <i class="bi bi-grip-vertical fw-bold"></i> Icon to reposition lessons. Drag the lesson to top to make it intro
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <section class="section col-md-12 bg-white" style="height: 20%;border-bottom-right-radius: 40px;">
                    <div class="align-items-center d-flex flex-row h-100 justify-content-evenly">
                        <div class="d-flex flex-row flex-lg-colmumn align-items-start align-items-center h-100" style="text-align: -webkit-center;">
                            <img src="assets/img/instructorPic/<?=$courseRow["instructorPicture"]?>" alt="Profile" class="rounded-circle" style="max-height: 90px;">
                            <div class="d-flex flex-column ms-2">
                                <h2 style="font-size: 24px; font-weight: 700; color: #2c384e; margin: 10px 0 0 0;"><?=$courseRow["instructor_name"]?></h2>
                                <h3 style="font-size: 18px; color: #2c384e;">Instructor</h3>
                                <div class="social-links">
                                    <?php if(!empty($courseRow["instructur_website"])) echo '<a target="_blank" href="'.$courseRow["instructur_website"].'" class="twitter"><i class="bi bi-globe"></i></a>'; ?>
                                    <?php if(!empty($courseRow["instructur_facebook"])) echo '<a target="_blank" href="'.$courseRow["instructur_facebook"].'" class="twitter"><i class="bi bi-facebook"></i></a>'; ?>
                                    <?php if(!empty($courseRow["instructur_insta"])) echo '<a target="_blank" href="'.$courseRow["instructur_insta"].'" class="twitter"><i class="bi bi-instagram"></i></a>'; ?>
                                    <?php if(!empty($courseRow["instructur_linkedin"])) echo '<a target="_blank" href="'.$courseRow["instructur_linkedin"].'" class="twitter"><i class="bi bi-linkedin"></i></a>'; ?>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-column h-100 justify-content-center w-50">
                            <h5 class="card-title d-lg-block d-md-none m-0 p-0">About Instructor</h5>
                            <p class="small fst-italic text-dark">
                                <?php echo limit_text($courseRow["aboutInstructor"], 40); ?>
                            </p>
                        </div>
                    </div>
                </section>
            </div>
        </main>
    </div>
</div>

   <div class="modal fade" id="aboutInstructorTextModal" tabindex="-1">
       <div class="modal-dialog">
           <div class="modal-content">
               <div class="modal-header bg-primary text-white ">
                   <h5 class="modal-title">About Instructor</h5>
                   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
                   <?=$courseRow["aboutInstructor"]?>
               </div>
               <div class="modal-footer">
                   <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
               </div>
           </div>
       </div>
   </div>

  <div class="modal fade" id="addNewLesson" tabindex="-1">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header bg-primary text-white">
                  <h5 class="modal-title">Add Lesson</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <div class="row g-3">

                      <div class="col-md-12 d-flex align-items-center">
                          <p class="form-label me-2">Select Lesson Type  </p>
<!--                          <input type="radio" class="btn-check" name="options" id="option11" autocomplete="off" checked="" value="test">-->
<!--                          <label class="btn btn-outline-primary me-2" for="option11" style="margin-right: 10px!important;">-->
<!--                              <i class="bi bi-list-check"></i>-->
<!--                              Test-->
<!--                          </label>-->

                          <input type="radio" class="btn-check" name="options" id="option22" autocomplete="off" value="link" checked>
                          <label class="btn btn-outline-primary me-2" for="option22">
                              <i class="ri-links-line"></i>
                              Link
                          </label>

                          <input type="radio" class="btn-check" name="options" id="option33" autocomplete="off" value="file">
                          <label class="btn btn-outline-primary me-2" for="option33">
                              <i class="ri-file-line"></i>
                              File
                          </label>

                          <input type="radio" class="btn-check" name="options" id="option44" autocomplete="off" value="video">
                          <label class="btn btn-outline-primary" for="option44">
                              <i class="ri-video-fill"></i>
                              Video
                          </label>

                          <input type="radio" class="btn-check" name="options" id="option55" autocomplete="off" value="text">
                          <label class="btn btn-outline-primary ms-2" for="option55">
                              <i class="bi bi-text-left"></i>
                              Text
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
                                          <button type="submit" class="btn btn-primary w-100 mt-3 rounded-pill submitBtn">
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
                              <form action="" method="post" class="row1 g-3">
                                  <div class="col-md-12 mb-3">
                                      <div class="form-floating">
                                          <input type="text" class="form-control" id="floatingName" placeholder="Lesson Name" name="lessonName">
                                          <label for="floatingName">Lesson Name</label>
                                      </div>
                                  </div>

                                  <div class="col-md-12 mb-3">
                                      <div class="form-floating">
                                          <input type="text" name="link" class="form-control" id="floatingTutLink" placeholder="Enter Link">
                                          <label for="floatingTutLink">Enter Link</label>
                                      </div>
                                  </div>

                                  <div class="col-md-12 d-flex justify-content-center">
                                      <div class="col-md-6">
                                          <button type="submit" name="saveLesson_typeLink" class="btn btn-primary w-100 mt-3 rounded-pill submitBtn" id="submitBtn">
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
                              <form action="" method="post" class="row1 g-3" enctype="multipart/form-data">

                                  <div class="col-md-12 mb-3">
                                      <div class="form-floating">
                                          <input type="text" class="form-control" id="floatingName" placeholder="Lesson Name" name="lessonName">
                                          <label for="floatingName">Lesson Name</label>
                                      </div>
                                  </div>

                                  <div class="row mb-3">
                                      <label for="inputNumber" class="col-sm-2 col-form-label">File Upload</label>
                                      <div class="col-sm-10">
                                          <input class="form-control" type="file" id="formFile" name="fileToUpload">
                                      </div>
                                  </div>

                                  <div class="col-md-12 d-flex justify-content-center">
                                      <div class="col-md-6">
                                          <button name="saveLesson_typeFile" type="submit" class="btn btn-primary w-100 mt-3 rounded-pill submitBtn" id="submitBtn">
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
                                          <button type="submit" class="btn btn-primary w-100 mt-3 rounded-pill submitBtn" name="saveLesson_typeVideo" id="submitBtn">
                                              <i class="bi bi-plus-circle-fill me-2"></i>
                                              Save Lesson
                                          </button>
                                      </div>
                                  </div>

                              </form>
                          </div>
                      </div>
                      <div id="lesssonType_5" style="display: none;">
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

  <div class="modal fade" id="editCourse" tabindex="-1">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header bg-primary text-light">
                  <h5 class="modal-title">Edit Course</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <form class="row g-3" action="" method="post" enctype="multipart/form-data">
                      <div class="col-md-12">
                          <label for="inputNanme4" class="form-label">Course Title</label>
                          <input type="text" class="form-control" id="inputNanme4" name="course_title" value="<?=$courseRow["title"]?>">
                      </div>
                      <div class="col-md-12 mt-3">
                          <label for="inputNanme4" class="form-label">Customize your title here</label>
                          <textarea class="tinymce-editor-small" style="height: 20px;" name="fancy_title" id="fancyTitle">
                                 <?=$courseRow["fancy_title"]?>
                           </textarea>
                      </div>
                      <div class="col-md-12">
                          <label for="inputNanme4" class="form-label">Link to the course publication</label>
                          <div class="input-group mb-3">
                              <span class="input-group-text" id="basic-addon3">https://teachmehow.me/course-</span>
                              <input type="text" name="courseID" class="form-control" value="<?=$courseRow["courseID"]?>">
                          </div>
                      </div>
                      <h5 class="card-title">Payment Settings</h5>
                      <div class="col-md-12 d-flex align-items-center">
                          <p class="mb-0 me-2">Payment Settings And Course Access</p>

                          <input type="radio" class="btn-check" name="access_type" id="option1" autocomplete="off" value="Free" " <?php if($courseRow["access"]=="Free") echo "checked"; ?>>
                          <label class="btn btn-outline-success me-2" for="option1">
                              <i class="ri-book-open-line me-2"></i>Free
                          </label>

                          <input type="radio" class="btn-check" name="access_type" id="option2" autocomplete="off" value="Registration" <?php if($courseRow["access"]=="Registration") echo "checked"; ?>>
                          <label class="btn btn-outline-success me-2" for="option2">
                              <i class="ri-login-box-fill me-2"></i>Registration
                          </label>

                          <input type="radio" class="btn-check" name="access_type" id="option3" autocomplete="off" value="Paid" <?php if($courseRow["access"]=="Paid") echo "checked"; ?>>
                          <label class="btn btn-outline-success me-2" for="option3">
                              <i class="ri-paypal-fill me-2"></i>Paid
                          </label>

                          <input type="radio" class="btn-check" name="access_type" id="option4" autocomplete="off" value="Password" <?php if($courseRow["access"]=="Password") echo "checked"; ?>>
                          <label class="btn btn-outline-success me-2" for="option4">
                              <i class="ri-key-2-fill me-2"></i>Password
                          </label>
                      </div>
                      <div id="registration" class="row">
                          <div class="col-md-12 mt-2">
                              <p>Time Limit for students</p>
                              <div class="input-group mb-3">
                                  <select class="form-select" id="selectTimeLimitFactor" name="timeLimit">
                                      <option value="Without Time Limit" <?php if($courseRow["title"]=="Without Time Limit") echo "selected"; ?>>Without Time Limit</option>
                                      <option value="Days" <?php if($courseRow["title"]=="Days") echo "selected"; ?>>Days</option>
                                      <option value="Months" <?php if($courseRow["title"]=="Months") echo "selected"; ?>>Months</option>
                                      <option value="Years" <?php if($courseRow["title"]=="Years") echo "selected"; ?>>Years</option>
                                  </select>
                                  <input type="text" class="form-control" id="timeLimitValueId" value="0" name="timeLimitValue">
                              </div>
                          </div>

                      </div>
                      <div id="paid" class="row mt-2">
                          <div class="col-md-6">
                              <label for="inputNanme4" class="form-label">Price</label>
                              <input type="number" class="form-control" id="inputNanme4" name="price" value="<?=$courseRow["price"]?>">
                          </div>
                          <div class="col-md-6">
                              <label for="inputNanme4" class="form-label">Paypal Client ID</label>
                              <input type="text" class="form-control" id="inputNanme4" name="paypal_email" value="<?=$courseRow["paypal_email"]?>">
                          </div>
                          <div class="col-md-6 mt-2">
                              <label for="validationTooltip04" class="form-label">Currency</label>
                              <select class="form-select" id="validationTooltip04" name="currency">
                                  <option value="USD" <?php if($courseRow["currency"]=="USD") echo " selected"; ?>>United States dollar</option>
                                  <option value="AUD" <?php if($courseRow["currency"]=="AUD") echo " selected"; ?>>Australian dollar</option>
                                  <option value="BRL" <?php if($courseRow["currency"]=="BRL") echo " selected"; ?>>Brazilian real</option>
                                  <option value="CAD" <?php if($courseRow["currency"]=="CAD") echo " selected"; ?>>Canadian dollar</option>
                                  <option value="CNY" <?php if($courseRow["currency"]=="CNY") echo " selected"; ?>>Chinese Renmenbi</option>
                                  <option value="DKK" <?php if($courseRow["currency"]=="DKK") echo " selected"; ?>>Danish krone</option>
                                  <option value="EUR" <?php if($courseRow["currency"]=="EUR") echo " selected"; ?>>Euro</option>
                                  <option value="JPY" <?php if($courseRow["currency"]=="JPY") echo " selected"; ?>>Japanese yen</option>
                                  <option value="MYR" <?php if($courseRow["currency"]=="MYR") echo " selected"; ?>>Malaysian ringgit</option>
                                  <option value="MXN" <?php if($courseRow["currency"]=="MXN") echo " selected"; ?>>Mexican peso</option>
                                  <option value="TWD" <?php if($courseRow["currency"]=="TWD") echo " selected"; ?>>New Taiwan dollar</option>
                                  <option value="NZD" <?php if($courseRow["currency"]=="NZD") echo " selected"; ?>>New Zealand dollar</option>
                                  <option value="PHP" <?php if($courseRow["currency"]=="PHP") echo " selected"; ?>>Philippine peso</option>
                                  <option value="JPB" <?php if($courseRow["currency"]=="JPB") echo " selected"; ?>>Pound sterling</option>
                                  <option value="RUB" <?php if($courseRow["currency"]=="RUB") echo " selected"; ?>>Russian ruble</option>
                                  <option value="SGD" <?php if($courseRow["currency"]=="SGD") echo " selected"; ?>>Singapore dollar</option>
                                  <option value="SEK" <?php if($courseRow["currency"]=="SEK") echo " selected"; ?>>Swedish krona</option>
                              </select>
                              <div class="invalid-tooltip">
                                  Please select a valid state.
                              </div>
                          </div>
                      </div>
                      <div id="Password" class="row mt-2">
                          <div class="col-md-12">
                              <label for="inputNanme4" class="form-label">Course Password</label>
                              <input type="password" name="coursePassword" class="form-control w-50" id="inputNanme4" value="<?=$courseRow["coursePassword"]?>">
                          </div>
                      </div>
                      <h5 class="card-title">About Course</h5>
                      <div class="col-md-6">
                          <label for="inputNanme4" class="form-label">Instructor Name</label>
                          <input type="text" name="instructor_name" class="form-control" id="inputNanme4" value="<?=$courseRow["instructor_name"]?>">
                      </div>
                      <div class="col-md-6">
                          <div class="row mb-3">
                              <label for="inputNumber" class="col col-form-label">Instructor Picture</label>
                              <div class="col-sm-10">
                                  <input type="hidden" name="instructorPicture" value="<?=$courseRow["instructorPicture"]?>">
                                  <input class="form-control" type="file" id="formFile" name="instructorPictureUpload">
                              </div>
                          </div>
                      </div>

                      <div class="col-sm-12 col-md-12">
                          <label for="inputAddress5" class="form-label">About Instructor <i>(40 words)</i></label>
                          <textarea class="form-control w-100" rows="3" name="aboutInstructor"><?=$courseRow["aboutInstructor"]?></textarea>
                      </div>

                      <input type="hidden" name="course_description" value="<?=$courseRow["description"]?>">
<!--                      <div class="col-md-12 mt-3">-->
<!--                                  <textarea class="tinymce-editor" name="course_description">-->
<!--                                     --><?//=$courseRow["description"]?>
<!--                                  </textarea>-->
<!--                      </div>-->

                      <h5 class="card-title">Social Media Links</h5>
                      <div class="row">
                          <div class="col-md-6">
                              <label for="inputNanme4" class="form-label">Instructor' Website</label>
                              <input type="text" name="website" class="form-control" id="inputNanme4" value="<?=$courseRow["instructur_website"]?>">
                          </div>
                          <div class="col-md-6">
                              <label for="inputNanme4" class="form-label">Instructor' Facebook</label>
                              <input type="text" name="facebook" class="form-control" id="inputNanme4" value="<?=$courseRow["instructur_facebook"]?>">
                          </div>
                          <div class="col-md-6">
                              <label for="inputNanme4" class="form-label">Instructor' Instagram</label>
                              <input type="text" name="insta" class="form-control" id="inputNanme4" value="<?=$courseRow["instructur_insta"]?>">
                          </div>
                          <div class="col-md-6">
                              <label for="inputNanme4" class="form-label">Instructor' LinkedIn</label>
                              <input type="text" name="linkedin" class="form-control" id="inputNanme4" value="<?=$courseRow["instructur_linkedin"]?>">
                          </div>
                      </div>

                      <div class="row justify-content-center">
                          <div class="col-md-6">
                              <button name="editCourse" type="submit" class="btn btn-primary w-100 mt-3 rounded-pill submitBtn" id="submitBtn">
                                  <i class="bi bi-pencil-fill me-2"></i>
                                  Update Course
                              </button>
                          </div>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>

  <div class="modal fade" id="delCourseModel" tabindex="-1">
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
                  <button id="submitBtn2" type="button" class="btn btn-danger" onclick="location.href = 'instructor-view-course.php?delCourse=<?=$courseID?>'">
                      <i class="bi bi-trash3-fill me-2"></i>
                      Delete
                  </button>
              </div>
          </div>
      </div>
  </div>

  <div class="modal fade" id="draftCourseModel" tabindex="-1">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header bg-secondary text-white">
                  <h5 class="modal-title">Update Course Status</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <form action="" method="post">
                      <fieldset class="row mb-3">
                          <div class="col-sm-10">
                              <div class="form-check">
                                  <input class="form-check-input" type="radio" name="setStatus" id="gridRadios" value="active" <?php if(!$courseRow["draft"]) echo "checked"; ?>>
                                  <label class="form-check-label" for="gridRadios">
                                      Set course active
                                  </label>
                              </div>
                          </div>
                          <div class="col-sm-10">
                              <div class="form-check">
                                  <input class="form-check-input" type="radio" name="setStatus" id="gridRadios1" value="draft" <?php if($courseRow["draft"]) echo "checked"; ?>>
                                  <label class="form-check-label" for="gridRadios1">
                                      Set as Draft
                                  </label>
                              </div>
                          </div>
                      </fieldset>
                      <div class="row justify-content-around">
                          <div class="col-md-6">
                              <button type="submit" name="updateDraftStatus" class="btn btn-secondary w-100" id="submitBtn1">
                                  <i class="ri-save-3-line me-2"></i>
                                  Save Changes
                              </button>
                          </div>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>

  <div class="modal fade" id="colorPickerModal" tabindex="-1">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header bg-primary text-white">
                  <h5 class="modal-title">Menu Color Selection</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <form action="" method="post" enctype="multipart/form-data">
                      <div class="row">
                          <div class="col-md-6">
                              <div class="row mb-3">
                                  <label for="inputColor" class="col-sm-8 col-form-label">Menu Background Color</label>
                                  <div class="col-sm-2">
                                      <input type="color" name="back" class="form-control form-control-color"
                                             id="bgcolor" value="<?=$courseRow["back_clr"]?>" title="Choose your color">
                                  </div>
                              </div>
                              <div class="row mb-3">
                                  <label for="inputColor" class="col-sm-8 col-form-label">Menu Text Color</label>
                                  <div class="col-sm-2">
                                      <input type="color" name="front"
                                             class="form-control form-control-color" id="frontColor" value="<?=$courseRow["front_clr"]?>" title="Choose your color">
                                  </div>
                              </div>
                              <div class="row mb-3">
                                  <label for="inputColor" class="col-sm-8 col-form-label">Course Title Background</label>
                                  <div class="col-sm-2">
                                      <input type="color" name="courseTitleBg"
                                             class="form-control form-control-color" id="txtLessonBackground" value="<?=$courseRow["courseTitleBg"]?>" title="Choose your color">
                                  </div>
                              </div>
                              <div class="row mb-3">
                                  <label for="inputColor" class="col-sm-8 col-form-label">Course Title Foreground</label>
                                  <div class="col-sm-2">
                                      <input type="color" name="courseTitleFg"
                                             class="form-control form-control-color" id="txtLessonBackground" value="<?=$courseRow["courseTitleFg"]?>" title="Choose your color">
                                  </div>
                              </div>
                              <div class="row mb-3">
                                  <label for="inputColor" class="col-sm-8 col-form-label">Text Lesson Background</label>
                                  <div class="col-sm-2">
                                      <input type="color" name="txtLessonBackground"
                                             class="form-control form-control-color" id="txtLessonBackground" value="<?=$courseRow["txtLessonBackground"]?>" title="Choose your color">
                                  </div>
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="row mb-3">
                                  <label for="inputColor" class="col-sm-6 col-form-label">Page Background Type</label>
                                  <div class="col-sm-6">
                                      <div class="form-check form-check-inline">
                                          <input class="form-check-input" type="radio" name="bgType" id="inlineRadio2" value="color" <?php if($courseRow["page_background_type"]=="color") echo "checked"; ?>>
                                          <label class="form-check-label" for="inlineRadio2">Color</label>
                                      </div>
                                      <div class="form-check form-check-inline">
                                          <input class="form-check-input" type="radio" name="bgType" id="inlineRadio1" value="image" <?php if($courseRow["page_background_type"]=="image") echo "checked"; ?>>
                                          <label class="form-check-label" for="inlineRadio1">Image</label>
                                      </div>
                                  </div>
                              </div>
                              <div id="selectBgImg">
                                  <div class="d-flex justify-content-end me-3 mb-3">
                                      <input type="hidden" value="<?=$courseRow["page_background_image"]?>" name="selectedImg">
                                      <img src="assets/img/course-bg/<?=$courseRow["page_background_image"]?>" alt="Background Image" height="100px;">
                                  </div>
                                  <div class="row mb-3">
                                      <label for="inputNumber" class="col-sm-6 col-form-label">Select Image</label>
                                      <div class="col-sm-6">
                                          <input class="form-control" type="file" id="formFile" name="fileToUpload">
                                      </div>
                                  </div>
                              </div>
                              <div class="row mb-3" id="selectBgClr">
                                  <label for="inputColor" class="col-sm-8 col-form-label">Page Background Color</label>
                                  <div class="col-sm-2">
                                      <input type="color" name="bgColor"
                                             class="form-control form-control-color" id="frontColor" value="<?=$courseRow["page_background_color"]?>" title="Choose your color">
                                  </div>
                              </div>
                              <hr>
                              <div class="row mb-3">
                                  <label for="inputNumber" class="col-sm-6 col-form-label">Menu Bottom Logo</label>
                                  <div class="col-sm-6">
                                      <input class="form-control" type="file" id="formFile" name="bottomLogo">
                                  </div>
                              </div>
                              <div class="d-flex justify-content-end me-3 mb-3">
                                  <input type="hidden" value="<?=$courseRow["bottomLogo"]?>" name="bottomLogoSelected">
                                  <img src="assets/img/bottomLogo/<?=$courseRow["bottomLogo"]?>" alt="Background Image" height="100px;">
                              </div>
                          </div>
                      </div>
                      <hr>
                      <div class="row justify-content-center">
                          <div class="col-md-6">
                              <button class="btn btn-primary w-100 submitBtn" id="submitBtn" name="saveColors">
                                  <i class="ri-save-fill me-2"></i>
                                  Save Configurations
                              </button>
                          </div>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>

  <div class="modal fade" id="addChapter" tabindex="-1">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header bg-primary text-white">
                  <h5 class="modal-title">Introduce new chapter</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <form action="" method="post">
                      <input type="hidden" name="courseID" value="<?=$courseID?>">
                      <div class="row mb-3">
                          <label for="inputText" class="col-sm-4 col-form-label">
                              Chapter Title:
                          </label>
                          <div class="col-sm-8">
                              <input type="text" class="form-control" name="chapterName" required>
                          </div>
                      </div>
                      <hr>
                      <div class="row justify-content-center">
                          <div class="col-md-6">
                              <button class="btn btn-primary w-100" id="submitBtn" name="addChapter">
                                  <i class="ri-add-box-fill me-2"></i>
                                  Add Chapter
                              </button>
                          </div>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>



   <!-- Vendor JS Files -->
   <script src="<?=$path?>assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
   <script src="<?=$path?>assets/vendor/php-email-form/validate.js"></script>
   <script src="<?=$path?>assets/vendor/quill/quill.min.js"></script>
   <script src="<?=$path?>assets/vendor/tinymce/tinymce.min.js"></script>
   <script src="<?=$path?>assets/vendor/simple-datatables/simple-datatables.js"></script>
   <script src="<?=$path?>assets/vendor/chart.js/chart.min.js"></script>
   <script src="<?=$path?>assets/vendor/apexcharts/apexcharts.min.js"></script>
   <script src="<?=$path?>assets/vendor/echarts/echarts.min.js"></script>

   <!-- Template Main JS File -->
   <script src="<?=$path?>assets/js/main.js?v=<?=rand()?>"></script>

   <script src="assets/vendor/jquery/jquery.min.js"></script>

   <script src="assets/vendor/jquery/jquery-ui.js"></script>
   <link rel="stylesheet" href="assets/vendor/jquery/jquery-ui.css">

   <script>
       var chaptersArray = [];

       $("#registration").hide();
       $("#paid").hide();
       $("#Password").hide();
       $("input#timeLimitValueId").hide();
       $('input[type=radio][name=access_type]').change(function() {
           if (this.value == 'Free') {
               $("#registration").hide();
               $("#Password").hide();
               $("#paid").hide();
           }
           else if (this.value == 'Registration') {
               $("#registration").show();
               $("#Password").hide();
               $("#paid").hide();
           }
           else if (this.value == 'Paid') {
               $("#registration").hide();
               $("#Password").hide();
               $("#paid").show();
           }
           else if (this.value == 'Password') {
               $("#registration").hide();
               $("#paid").hide();
               $("#Password").show();
           }
       });

       hideAll();
       $( "#lesssonType_2" ).show();
       getLessons();
       implementColors();
       // loader('none');
       loader1('none');

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
       });

       $('input[name="options"]').change(function() {
           console.log(this.value);
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
           else if (this.value == 'text') {
               $( "#lesssonType_5" ).show();
           }
       });

       $( "#selectBgImg" ).hide();
       $( "#selectBgClr" ).hide();

       <?php
       $cls = $courseRow["page_background_type"]=="color" ? "selectBgClr" : "selectBgImg";
       echo '$( "#'.$cls.'" ).show();';
       ?>

       $('input[name="bgType"]').change(function() {
           console.log(this.value);
           if (this.value == 'image') {
               $( "#selectBgImg" ).show();
               $( "#selectBgClr" ).hide();
           }
           else{
               $( "#selectBgImg" ).hide();
               $( "#selectBgClr" ).show();
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

       $('#selectTimeLimitFactor').change(function() {
           if($(this).val()==="Days" || $(this).val()==="Months" || $(this).val()==="Years"){
               $("input#timeLimitValueId").show();
           }else{
               $("input#timeLimitValueId").hide();
           }
       });

       $('.submitBtn').on('click', function() {
           var $this = $(this);
           var loadingText = '<div class="spinner-border text-light" role="status"></div>';
           if ($(this).html() !== loadingText) {
               $this.data('original-text', $(this).html());
               $this.html(loadingText);
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
       $('#submitBtn1').on('click', function() {
           var $this = $(this);
           var loadingText = '<div class="spinner-border text-light" role="status"></div>';
           if ($(this).html() !== loadingText) {
               $this.data('original-text', $(this).html());
               $this.html(loadingText);
           }
       });
       $('#submitBtn2').on('click', function() {
           var $this = $(this);
           var loadingText = '<div class="spinner-border text-light" role="status"></div>';
           if ($(this).html() !== loadingText) {
               $this.data('original-text', $(this).html());
               $this.html(loadingText);
           }
       });

       $('#bgcolor').on('input',
           function() {
               $('.customColors').css('background-color', $(this).val());
               $('#lessonsListItems li').css('background-color', $(this).val());
           }
       );

       $('.signBgColor').on('input',
           function() {
               $('.bottomSignatureBg').css('background-color', $(this).val());
           }
       );

       $('.signFgColor').on('input',
           function() {
               $('.bottomSignature').css('color', $(this).val());
           }
       );

       $('#frontColor').on('input',
           function() {
               $('li.list-group-item').css('color', $(this).val());
               $('.customColors').css('color', $(this).val());
               $('#lsnHeading').css('color', $(this).val());
           }
       );

       $('#frontColor').on('input',
           function() {
               $('li.list-group-item').css('color', $(this).val());
               $('.customColors').css('color', $(this).val());
               $('#lsnHeading').css('color', $(this).val());
           }
       );

       function hideAll() {
           $( "#lesssonType_1" ).hide();
           $( "#lesssonType_2" ).hide();
           $( "#lesssonType_3" ).hide();
           $( "#lesssonType_4" ).hide();
           $( "#lesssonType_5" ).hide();
       }

       function makeListSortable() {
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
       }

       function getLessonsOfChapters() {
           $.ajax({
               url: "api/getLessonsByCourseId.php",
               type: "post",
               data: {
                   courseID: <?=$courseID?>,
                   chapterIDs: chaptersArray,
               },
               success: function(response) {
                   loader('none');
                   var lessons = $.parseJSON(response);
                   var length = Object.keys(lessons).length;
                   if(length){
                       $("#chapter_id_"+chapterID).append('<ul class="list-group sortable" id="lessonsListItems"></ul>');
                       for (lesson of lessons) {
                           $("#chapter_id_"+chapterID+" #lessonsListItems").append('<li class="list-group-item" id="'+lesson.id+'" onclick="getLessonContent('+lesson.id+')"><i class="bi bi-grip-vertical me-3"></i>'+lesson.name+'</li>');
                       }
                   }else{
                       $("#chapter_id_"+chapterID).append('<hr><h5 class="text-center">No Lessons Found</h5>');
                   }
                   implementColors();
               },
               error: function(xhr) {
                   alert("Error while fetching courses!\n "+xhr);
               }
           });
       }

       function getLessonContent(lessonID) {

           console.log('li#'+lessonID);
           $(".editDelBtns").hide();
           $('li#'+lessonID).append("" +
               "<span class='editDelBtns float-end ms-auto'>" +
                   "<button data-bs-toggle='modal' data-bs-target='#EditLesson' class='btn customColors me-2'><i class='bi bi-pencil-fill'></i></button>" +
                   "<button data-bs-toggle='modal' data-bs-target='#delModel' class='btn customColors'><i class='bi bi-trash2-fill'></i></button>" +
               "</span>");
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
                   implementColors();
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
           $('.loader1').attr('style','display:'+visible+' !important');
       }

       function placeHolderIcon(visible) {
           $('#placeholderIcon').attr('style','display:'+visible+' !important');
       }

       function addNewLesson(chapID) {
           console.log(chapID);
           $("#addNewLesson").modal('show');
           $(".addLessonUnderChapterInputBox").val(chapID);
       }


       function getLessons() {
           loader('block');
           $.ajax({
               url: "api/getChaptersAndLessons.php",
               type: "post",
               data: {
                   courseID: <?=$courseID?>
               },
               success: function(response) {
                   $("#ChaptersList").html(response);
                   implementColors();
                   makeListSortable();
                   loader('none');
               },
               error: function(xhr) {
                   alert("Error while fetching courses!\n "+xhr);
               }
           });
       }

       function implementColors() {
           $('.customColors').css('background-color', '<?=$courseRow["back_clr"]?>');
           $('.list-group-item').css('background-color', '<?=$courseRow["back_clr"]?>');
           $('.titleColors').css('background-color', '<?=$courseRow["courseTitleBg"]?>');

           $('.titleColors').css('color', '<?=$courseRow["courseTitleFg"]?>');
           $('.list-group-item').css('color', '<?=$courseRow["front_clr"]?>');
           $('.customColors').css('color', '<?=$courseRow["front_clr"]?>');
           $('.bottomSignature').css('color', '<?=$courseRow["signFgColor"]?>');
           $('.bottomSignatureBg').css('background', '<?=$courseRow["signBgColor"]?>');
           $('#lsnHeading').css('color', '<?=$courseRow["front_clr"]?>');
           $("button.customColors").css('border', '1px solid <?=$courseRow["front_clr"]?>');
       }
   </script>

   <div class="toast" id="myToast">
       <div class="toast-header">
           <strong class="me-auto"><i class="bi-gift-fill"></i> We miss you!</strong>
           <small>10 mins ago</small>
           <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
       </div>
       <div class="toast-body">
           It's been a long time since you visited us. We've something special for you. <a href="#">Click here!</a>
       </div>
   </div>
   <script>
       $("#myToast").toast("show");
   </script>

</body>

</html>