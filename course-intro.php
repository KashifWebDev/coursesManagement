<?php
require_once "includes/app.php";
validateSession();
require_once "includes/functions.php";
$path = ROOT_DIR;
$courseID = sanitizeParam($_GET["courseID"]);
if(isset($_POST["saveIntro"])){
    $selection = sanitizeParam($_POST["theme"]);
    $intro = sanitizeParam($_POST["intro"]);
    $s = "INSERT INTO course_intro (course_id, selection, content) VALUES ($courseID, '$selection', '$intro')";
    if(mysqli_query($con, $s)){
        redirect("instructor-view-course.php?courseID=".$courseID);
    }else{
        echo mysqli_error($con); die(); exit();
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Edit Course Intro</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="<?=$path?>assets/img/logo_top.png" rel="icon">
    <link href="<?=$path?>assets/img/logo_top.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <link href="<?=$path?>/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=$path?>assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

    <link href="<?=$path?>assets/css/style.css?v=<?=rand()?>" rel="stylesheet">
    <link href="<?=$path?>assets/css/radio.css?v=<?=rand()?>" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bs-stepper/dist/css/bs-stepper.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>

</head>
<body>
    <div class="container-fluid w-100 p-0" style="height: 100vh">
        <div class="bg-primary text-white customHeading m-0 ps-3 d-flex align-items-center" style="height: 5vh">
                <h1 style="font-size: larger">Select Intro Template</h1>
        </div>
        <div style="height: 95vh; background-color: #f6f9ff" class="mt-3">

            <div class="container">

                <div id="stepper1" class="bs-stepper linear">
                    <div class="bs-stepper-header" role="tablist">
                        <div class="step" data-target="#test-l-1">
                            <button type="button" class="step-trigger" role="tab" id="stepper1trigger1" aria-controls="test-l-1" aria-selected="false" disabled="disabled">
                                <span class="bs-stepper-circle">1</span>
                                <span class="bs-stepper-label">Select Template</span>
                            </button>
                        </div>
                        <div class="bs-stepper-line"></div>
                        <div class="step active" data-target="#test-l-2">
                            <button type="button" class="step-trigger" role="tab" id="stepper1trigger2" aria-controls="test-l-2" aria-selected="true">
                                <span class="bs-stepper-circle">2</span>
                                <span class="bs-stepper-label">Edit Template</span>
                            </button>
                        </div>
                    </div>
                    <div class="bs-stepper-content">
                        <form action="" method="post">
                            <input type="hidden" name="courseID" value="<?=$courseID?>">
                            <div id="test-l-1" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger1">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <div class="wrapper">
                                                <input type="radio" name="theme" value="theme1" id="option-1" checked>
                                                <label for="option-1" class="option option-1">
                                                    <div class="dot"></div>
                                                    <span>Template 1</span>
                                                </label>
                                            </div>
                                            <div class="card">
                                                <img src="assets/img/course-intro-themes/1.png" class="card-img-top">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <div class="wrapper">
                                                <input type="radio" name="theme" value="theme2" id="option-2">
                                                <label for="option-2" class="option option-2">
                                                    <div class="dot"></div>
                                                    <span>Template 2</span>
                                                </label>
                                            </div>
                                            <div class="card">
                                                <img src="assets/img/course-intro-themes/2.png" class="card-img-top">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <div class="wrapper">
                                                <input type="radio" name="theme" value="theme3" id="option-3">
                                                <label for="option-3" class="option option-3">
                                                    <div class="dot"></div>
                                                    <span>Template 3</span>
                                                </label>
                                            </div>
                                            <div class="card">
                                                <img src="assets/img/course-intro-themes/3.png" class="card-img-top">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex w-100 justify-content-center mt-3">
                                    <button type="button" class="btn btn-primary w-25" onclick="location.href = 'instructor-view-course.php?courseID=<?=$courseID?>';">
                                        <i class="fa-solid fa-chevron-left me-2"></i>
                                        Back to course editor
                                    </button>
                                    <button id="loadTextEditor" type="button" name="saveIntro" class="btn btn-primary w-25 ms-2" onclick="stepper1.next()">
                                        Next
                                        <i class="fa-solid fa-chevron-right ms-2"></i>
                                    </button>
                                </div>
                            </div>
                            <div id="test-l-2" role="tabpanel" class="bs-stepper-pane active dstepper-block" aria-labelledby="stepper1trigger2">
                                <div class="form-group">
                                    <textarea class="tinymce-editor" name="intro">
                                        <p>Hello World!</p>
                                        <p>This is TinyMCE <strong>full</strong> editor</p>
                                    </textarea><!-- End TinyMCE Editor -->
                                </div>

                                <div class="d-flex w-100 justify-content-center mt-3">
                                    <button type="button" class="btn btn-primary w-25" onclick="stepper1.previous()">
                                        Previous
                                        <i class="fa-solid fa-chevron-left ms-2"></i>
                                    </button>
                                    <button type="submit" name="saveIntro" class="btn btn-primary w-25 ms-2" onclick="stepper1.next()">
                                        <i class="fa-solid fa-floppy-disk me-2"></i>
                                        Save
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

        </div>
    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/bs-stepper/dist/js/bs-stepper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="<?=$path?>assets/vendor/tinymce/tinymce.min.js"></script>
<script>
    tinymce.init({
        selector: 'textarea.tinymce-editor',
        plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
        imagetools_cors_hosts: ['picsum.photos'],
        menubar: 'file edit view insert format tools table help',
        toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
        toolbar_sticky: true,
        autosave_ask_before_unload: true,
        autosave_interval: '30s',
        autosave_prefix: '{path}{query}-{id}-',
        autosave_restore_when_empty: false,
        autosave_retention: '2m',
        image_advtab: true,
        link_list: [{
            title: 'My page 1',
            value: 'https://www.tiny.cloud'
        },
            {
                title: 'My page 2',
                value: 'http://www.moxiecode.com'
            }
        ],
        image_list: [{
            title: 'My page 1',
            value: 'https://www.tiny.cloud'
        },
            {
                title: 'My page 2',
                value: 'http://www.moxiecode.com'
            }
        ],
        image_class_list: [{
            title: 'None',
            value: ''
        },
            {
                title: 'Some class',
                value: 'class-name'
            }
        ],
        importcss_append: true,
        file_picker_callback: function(callback, value, meta) {
            /* Provide file and text for the link dialog */
            if (meta.filetype === 'file') {
                callback('https://www.google.com/logos/google.jpg', {
                    text: 'My text'
                });
            }

            /* Provide image and alt text for the image dialog */
            if (meta.filetype === 'image') {
                callback('https://www.google.com/logos/google.jpg', {
                    alt: 'My alt text'
                });
            }

            /* Provide alternative source and posted for the media dialog */
            if (meta.filetype === 'media') {
                callback('movie.mp4', {
                    source2: 'alt.ogg',
                    poster: 'https://www.google.com/logos/google.jpg'
                });
            }
        },
        templates: [{
            title: 'New Table',
            description: 'creates a new table',
            content: '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>'
        },
            {
                title: 'Starting my story',
                description: 'A cure for writers block',
                content: 'Once upon a time...'
            },
            {
                title: 'New list with dates',
                description: 'New List with dates',
                content: '<div class="mceTmpl"><span class="cdate">cdate</span><br /><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>'
            }
        ],
        template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
        template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
        height: 400,
        image_caption: true,
        quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
        noneditable_noneditable_class: 'mceNonEditable',
        toolbar_mode: 'sliding',
        contextmenu: 'link image imagetools table',
        skin:  'oxide',
        content_css:  'default',
        content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
    });
    var stepper1;
    document.addEventListener('DOMContentLoaded', function () {
        stepper1 = new Stepper(document.querySelector('#stepper1'));
    })
    $("#loadTextEditor").click(function (){
        let content = "";
        let value = $('input[name=theme]:checked').val();
        <?php
        $s = "SELECT * FROM course_intro WHERE course_id = $courseID";
        $res = mysqli_query($con, $s);
        if(mysqli_num_rows($res)){
            $row = mysqli_fetch_array($res);
            $data = array('myString' => $row["content"]);
            echo 'content = '.json_encode($data).';';
            echo 'content = content.myString';
        }else{
            ?>
        switch(value) {
            case 'theme1':
                content = '<table style="border-collapse: collapse; width: 100%;"><tbody><tr><td style="width: 17.8984%;"><img src="https://teachmehow.me/assets/img/courses-thumnail/default.jpg" alt="" width="263" height="126"/></td><td style="width: 79.7642%;"><h2>What is Lorem Ipsum?</h2><p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p></td></tr></tbody></table>';
                break;
            case 'theme2':
                content = '<table style="border-collapse: collapse; width: 100%;"> <tbody> <tr> <td style="width: 76.9%;"> <h2>What is Lorem Ipsum?</h2> <p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p></td><td style="width: 20.7626%;"><img src="https://teachmehow.me/assets/img/courses-thumnail/default.jpg" alt="" width="248" height="119"/></td></tr></tbody></table>';
                break;
            case 'theme3':
                content = '<table style="border-collapse: collapse; width: 100%;"><tbody><tr><td style="width: 75.6725%;"><h2>What is Lorem Ipsum?</h2><p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p></td><td style="width: 21.9901%;"><iframe style="width: 345px; height: 193px;" src="https://www.youtube.com/embed/Vl0H-qTclOg?ab_channel=freeCodeCamp" width="345" height="193" allowfullscreen="allowfullscreen"></iframe></td></tr></tbody></table>';
                break;
            default:
                content = "";
        }
        <?php
        }
        ?>

        tinymce.activeEditor.setContent(content);
    });
</script>


</html>