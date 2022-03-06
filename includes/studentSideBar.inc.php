<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link " href="<?=$path?>instructorDashboard.php">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->


        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-journal-text"></i><span>Courses Management</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="<?=$path?>instructor-create-course.php">
                        <i class="bi bi-circle"></i><span>Add New Course</span>
                    </a>
                </li>
                <li>
                    <a href="<?=$path?>instructor-all-courses.php">
                        <i class="bi bi-circle"></i><span>My Courses</span>
                    </a>
                </li>
                <li>
                    <a href="<?=$path?>instructor-my-students.php">
                        <i class="bi bi-circle"></i><span>My Students</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-currency-dollar"></i><span>Coupons Management</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="<?=$path?>instructor-create-coupon.php">
                        <i class="bi bi-circle"></i><span>Add New Coupon</span>
                    </a>
                </li>
                <li>
                    <a href="<?=$path?>instructor-all-coupons.php">
                        <i class="bi bi-circle"></i><span>All Coupon</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#third-collapse" data-bs-toggle="collapse" href="#">
                <i class="bi bi-journal-text"></i><span>Instructors Management</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="third-collapse" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="<?=$path?>instructor-create-course.php">
                        <i class="bi bi-circle"></i><span>Add a Instructor</span>
                    </a>
                </li>
                <li>
                    <a href="<?=$path?>instructor-all-courses.php">
                        <i class="bi bi-circle"></i><span>All Courses</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#forth-collapse" data-bs-toggle="collapse" href="#">
                <i class="bi bi-journal-text"></i><span>Students Management</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="forth-collapse" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="<?=$path?>instructor-create-course.php">
                        <i class="bi bi-circle"></i><span>Add a Student</span>
                    </a>
                </li>
                <li>
                    <a href="<?=$path?>instructor-all-courses.php">
                        <i class="bi bi-circle"></i><span>All Students</span>
                    </a>
                </li>
            </ul>
        </li>


        <li class="nav-heading">Pages</li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="<?=$path?>profile.php">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
            </a>
        </li><!-- End Profile Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="#">
                <i class="bi bi-box-arrow-left"></i>
                <span>Sign Out</span>
            </a>
        </li><!-- End Login Page Nav -->

    </ul>

</aside>