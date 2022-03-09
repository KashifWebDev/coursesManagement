<!-- ======= Footer ======= -->
<footer id="footer" class="footer">
    <div class="copyright">
        &copy; Copyright <strong><span>CourseMaker</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
<!--        Designed by <a href="https://kashifali.me/">Kashif Ali</a>-->
    </div>
</footer><!-- End Footer -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

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

<?php echo isset($_SESSION["impersonate"]) && $_SESSION["impersonate"] == true ? "<script>document.getElementById('main').style.marginTop = '95px';</script>": "" ?>

