<?php
require_once '../includes/app.php';

$courseID = sanitizeParam($_POST["courseID"]);
$publicView = isset($_POST["publicView"]) && $_POST["publicView"] ? 1 : 0;

$s = "SELECT * FROM chapters WHERE course_id=$courseID";
$res = mysqli_query($con, $s);
if(mysqli_num_rows($res)){
    while($chapterRow = mysqli_fetch_array($res, MYSQLI_ASSOC)){
        $chapID = $chapterRow["id"];
        ?>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed customColors" type="button" data-bs-toggle="collapse" data-bs-target="#chapter<?=$chapID?>" aria-expanded="false" aria-controls="collapseTwo">
                    <?=$chapterRow["name"]?>
                </button>
            </h2>
            <div id="chapter<?=$chapID?>" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                <div class="accordion-body customColors">
                    <?php
                        $s = "SELECT * FROM lessons WHERE chapter_id=$chapID AND course_id=$courseID";
                        $res1 = mysqli_query($con, $s);
                        if(mysqli_num_rows($res1)){
                        while ($lessonsRow = mysqli_fetch_array($res1, MYSQLI_ASSOC)){
                            ?>
                            <ul class="list-group sortable" id="lessonsListItems">
                                <li class="list-group-item" id="<?=$lessonsRow["id"]?>" onclick="getLessonContent(<?=$lessonsRow["id"]?>)">
                                    <i class="bi bi-grip-vertical me-3"></i><?=$lessonsRow["name"]?>
                                </li>
                            </ul>
                            <?php
                        }
                    }else{
                            ?>  <p class="text-center">No Lessons...</p> <?php
                        }
                        if(!$publicView){
                    ?>
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <button type="button" class="btn w-100 customColors" onclick="addNewLesson(<?=$chapID?>)">
                                <i class="ri-add-box-fill me-2"></i>
                                Add a Lesson
                            </button>
                        </div>
                    </div> <!-- End of Add Lesson -->
                            <?php } ?>

                </div>
            </div>
        </div>
        <?php
    }
}