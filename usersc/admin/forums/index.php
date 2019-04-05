<?php
require_once '../../../users/init.php';
require_once $abs_us_root.$us_url_root.'users/includes/header.php';
require_once $abs_us_root.$us_url_root.'users/includes/navigation.php';
if(isset($user) && $user->isLoggedIn()){
}
?>
<?php if (!securePage($_SERVER['PHP_SELF'])){die();}?>
<div id="page-wrapper">
    <center>
<a href="categories.php" class="btn btn-default">Add Category</a> <a href="sub-categories.php" class="btn btn-default">Sub Categories</a>
    </center>
    <br>
</div>
<!-- footers -->
<?php require_once $abs_us_root.$us_url_root.'users/includes/page_footer.php'; // the final html footer copyright row + the external js calls ?>

<!-- Place any per-page javascript here -->


<?php require_once $abs_us_root.$us_url_root.'users/includes/html_footer.php'; // currently just the closing /body and /html ?>
