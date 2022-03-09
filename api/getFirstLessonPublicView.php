<?php
require_once '../includes/app.php';

$output = array();

$courseID = sanitizeParam($_POST["courseID"]);
$publicView = isset($_POST["publicView"]) && $_POST["publicView"] ? 1 : 0;

$s = "SELECT * FROM courses WHERE id=$courseID";
$res = mysqli_query($con, $s);
$courseRow = mysqli_fetch_array($res);

if($courseRow["access"]=="Free"){
    $firstClass = "col-md-12 h-100";
    $secondClass = "d-none";
}
if($courseRow["access"]=="Registration" || $courseRow["access"]=="Paid"){
    $firstClass = "col-md-7 h-100";
    $secondClass = "col-md-5 h-100";
}

$s = "SELECT * FROM lessons WHERE course_id=$courseID ORDER BY arrange_order ASC LIMIT 1";
$res = mysqli_query($con, $s);
if(mysqli_num_rows($res)){
    $row = mysqli_fetch_array($res, MYSQLI_ASSOC);
    $content = $url = isset($row["content"]) ? $row["content"] : "";
    $name = isset($row["name"]) ? $row["name"] : "";

    if($row["type"]=="video"){
        ?>
        <div class="row h-100">
            <div class="<?=$firstClass?>">
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
            </div>
            <div class="<?=$secondClass?>">
                <?php
                if($courseRow["access"]=="Registration" && $courseRow["coursePassword"]==""){
                    echo signUp();
                }
                if($courseRow["access"]=="Paid" && $courseRow["coursePassword"]==""){
                    echo paypal();
                }
                if($courseRow["coursePassword"]!=""){
                    echo passwordProtected();
                }
                ?>
            </div>
        </div>
<?php
    }
    if($row["type"]=="text"){
        ?>
        <div class="row h-100">
            <div class="<?=$firstClass?>">
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
                    <?php if(!is_null($courseRow["txtLessonBackground"])){ ?>
                    .textBckColor{
                        background-color: <?=$courseRow["txtLessonBackground"];?>;
                    }
                    <?php } ?>

                </style>
                <?php  echo loadScripts(); ?>
                <script>$( "#lesssonType_15" ).show();</script>
            </div>
            <div class="<?=$secondClass?>">
                <?php
                if($courseRow["access"]=="Registration" && $courseRow["coursePassword"]==""){
                    echo signUp();
                }
                if($courseRow["access"]=="Paid" && $courseRow["coursePassword"]==""){
                    echo paypal();
                }
                if($courseRow["coursePassword"]!=""){
                    echo passwordProtected();
                }
                ?>
            </div>
        </div>
<?php
    }
    if($row["type"]=="file"){
        ?>
        <div class="row h-100">
            <div class="<?=$firstClass?>">
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
            </div>
            <div class="<?=$secondClass?>">
                <?php
                if($courseRow["access"]=="Registration" && $courseRow["coursePassword"]==""){
                    echo signUp();
                }
                if($courseRow["access"]=="Paid" && $courseRow["coursePassword"]==""){
                    echo paypal();
                }
                if($courseRow["coursePassword"]!=""){
                    echo passwordProtected();
                }
                ?>
            </div>
        </div>
<?php
    }
    if($row["type"]=="link"){
        ?>
        <div class="row h-100">
            <div class="<?=$firstClass?>">
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
            </div>
            <div class="<?=$secondClass?> <?=$courseRow["coursePassword"]?>">
                <?php
                if($courseRow["access"]=="Registration" && $courseRow["coursePassword"]==""){
                    echo signUp();
                }
                if($courseRow["access"]=="Paid" && $courseRow["coursePassword"]==""){
                    echo paypal();
                }
                if($courseRow["coursePassword"]!=""){
                    echo passwordProtected();
                }
                ?>
            </div>
        </div>
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

function signUp(){
    return '
    <div class="w-100 pe-2 mt-2 d-flex flex-column align-items-center justify-content-center">


        <div class="card mb-3">

            <div class="card-body text-dark">

                <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                    <p class="text-center small">Please sign up to get the course subscription...</p>
                </div>

                <form class="row g-3 needs-validation" novalidate="" method="post" action="">

                    <div class="col-md-6">
                        <label for="firstName" class="form-label">First Name</label>
                        <input type="text" name="firstName" class="form-control" id="firstName" required="">
                        <div class="invalid-feedback">Please, enter your first name!</div>
                    </div>

                    <div class="col-md-6">
                        <label for="lastName" class="form-label">Last Name</label>
                        <input type="text" name="lastName" class="form-control" id="lastName" required="">
                        <div class="invalid-feedback">Please, enter your last name!</div>
                    </div>

                    <div class="col-md-6">
                        <label for="yourEmail" class="form-label">Your Email</label>
                        <input type="email" name="email" class="form-control" id="yourEmail" required="">
                        <div class="invalid-feedback">Please enter a valid Email address!</div>
                    </div>

                    <div class="col-md-6">
                        <label for="yourUsername" class="form-label">Username</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text" id="inputGroupPrepend">@</span>
                            <input type="text" name="username" class="form-control" id="yourUsername" required="">
                            <div class="invalid-feedback">Please choose a username.</div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="yourPassword" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="yourPassword" required="">
                        <div class="invalid-feedback">Please enter your password!</div>
                    </div>

                    <div class="col-md-6">
                        <label for="confirmPassword" class="form-label">Confirm Password</label>
                        <input type="password" name="confirmPassword" class="form-control" id="confirmPassword" required="">
                        <div class="invalid-feedback">Renter the same password!</div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-check">
                            <input class="form-check-input" name="terms" type="checkbox" value="" id="acceptTerms" required="">
                            <label class="form-check-label" for="acceptTerms">I agree and accept the <a href="#">terms and conditions</a></label>
                            <div class="invalid-feedback">You must agree before submitting.</div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button class="btn btn-primary w-100" type="submit">Create Account</button>
                    </div>
                    <div class="col-md-12">
                        <p class="small mb-0">Already have an account? <a href="./">Log in</a></p>
                    </div>
                </form>

            </div>
        </div>

    </div>
';
}

function paypal(){
    return '
    <div class="w-100 mt-5 d-flex flex-column align-items-center justify-content-center">


        <div class="card mb-3">

            <div class="card-body text-dark">

                <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Buy Course</h5>
                    <p class="text-center small">Please buy this course to proceed...</p>
                </div>

                <form >
                    <div class="col-md-12">
                        <button class="btn btn-warning w-100 ">
                        <i class="ri-paypal-fill"></i>
                        Buy Now
                        </button>
                    </div>
                </form>

            </div>
        </div>

    </div>
';
}

function passwordProtected(){
    return '
    <div class="w-100 mt-5 d-flex flex-column align-items-center justify-content-center">


        <div class="card mb-3">

            <div class="card-body text-dark">

                <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">
                    <i class="bi bi-key-fill me-2"></i> Password Protected
</h5>
                    <p class="text-center small">Please enter password to unlock...</p>
                    <form action="">
                        <div class="form-floating mb-3">
                          <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
                          <label for="floatingPassword">Password</label>
                        </div>
                        <div class="col-md-12">
                            <button class="btn btn-outline-dark w-100 ">
                            <i class="bi bi-shield-lock me-2"></i>
                            Unlock
                            </button>
                        </div>
                    </form>
                </div>


            </div>
        </div>

    </div>
';
}