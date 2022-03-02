<?php
require_once '../includes/app.php';

$courseID = sanitizeParam($_POST["courseID"]);
$publicView = isset($_POST["publicView"]) && $_POST["publicView"] ? 1 : 0;

$s = "SELECT * FROM lessons WHERE course_id=$courseID ORDER BY arrange_order ASC";
$res1 = mysqli_query($con, $s);
if(mysqli_num_rows($res1)){
    ?> <ul class="list-group <?php if(!$publicView) echo "sortable"; ?>" id="lessonsListItems"> <?php
    while ($lessonsRow = mysqli_fetch_array($res1, MYSQLI_ASSOC)){
        $isChap = $lessonsRow["is_chapter"];
        $chap_class = $isChap ? "fw-bold mt-4" : "fw-light ms-2";
        ?>
            <li class="list-group-item <?=$chap_class?>" id="<?=$lessonsRow["id"]?>" <?php if(!$isChap){ ?> onclick="getLessonContent(<?=$lessonsRow["id"]?>)" <?php } ?>>
                <?php if(!$publicView){ ?> <i class="bi bi-grip-vertical me-3" style=""></i> <?php } ?>
                <?php if($publicView && !$isChap){ ?> <i class="bi bi-circle me-3" style="font-size: 6px; margin-right: 8px; line-height: 0; border-radius: 50%;"></i> <?php } ?>
                <?=$lessonsRow["name"]?>
            </li>
        <?php
    }
    ?> </ul> <?php
}else{
    ?>  <p class="text-center">No Lessons...</p> <?php
}