<?php
require_once '../../../users/init.php';
require_once $abs_us_root.$us_url_root.'users/includes/header.php';
require_once $abs_us_root.$us_url_root.'users/includes/navigation.php';
if(isset($user) && $user->isLoggedIn()){
}
?>
<?php if (!securePage($_SERVER['PHP_SELF'])){die();}?>
<div id="page-wrapper">
    <div class="container">
    <div class="panel panel-primary">
        <div class="panel-heading">
            Add New Category
        </div>
        <div class="panel-body">
    <form action="step2_c.php" method="post">
        Category Name: <input type="text" name="name"><br>
        Category Description: <input type="text" name="desc"><br>
        <input type="submit" class="btn btn-default">
    </form>
        </div>
    </div>
    </div>
</div>
<!-- footers -->
<?php require_once $abs_us_root.$us_url_root.'users/includes/page_footer.php'; // the final html footer copyright row + the external js calls ?>

<!-- Place any per-page javascript here -->


<?php require_once $abs_us_root.$us_url_root.'users/includes/html_footer.php'; // currently just the closing /body and /html ?>
