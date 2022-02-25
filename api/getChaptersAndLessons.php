<?php
require_once '../includes/app.php';

$courseID = sanitizeParam($_POST["courseID"]);
$publicView = isset($_POST["publicView"]) && $_POST["publicView"] ? 1 : 0;

$s = "SELECT * FROM lessons WHERE course_id=$courseID ORDER BY arrange_order ASC";
$res1 = mysqli_query($con, $s);
if(mysqli_num_rows($res1)){
    ?> <ul class="list-group <?php if(!$publicView) echo "sortable"; ?>" id="lessonsListItems"> <?php
    while ($lessonsRow = mysqli_fetch_array($res1, MYSQLI_ASSOC)){
        $chap_class = $lessonsRow["is_chapter"] ? "fw-bold mt-4 border h5" : "";
        ?>
            <li class="list-group-item <?=$chap_class?>" id="<?=$lessonsRow["id"]?>" onclick="getLessonContent(<?=$lessonsRow["id"]?>)">
                <?php if(!$publicView){ ?> <i class="bi bi-grip-vertical me-3"></i> <?php } ?>
                <?=$lessonsRow["name"]?>
            </li>
        <?php
    }
    ?> </ul> <?php
}else{
    ?>  <p class="text-center">No Lessons...</p> <?php
}