<?php
require_once '../../../users/init.php';
require_once $abs_us_root.$us_url_root.'users/includes/header.php';
require_once $abs_us_root.$us_url_root.'users/includes/navigation.php';
if(isset($user) && $user->isLoggedIn()){
}
?>
<div id="page-wrapper">
<?php
$name = $_POST["name"];
$desc = $_POST["desc"];

$stmt = $pdo->prepare('INSERT INTO `category` (`id`, `name`, `cdesc`) VALUES (NULL, ?, ? );');
$stmt->bindParam(1, $name, PDO::PARAM_STR);
$stmt->bindParam(2, $desc, PDO::PARAM_STR);

$stmt->execute();




header("location: index.php")
?>
</div>
        <?php require_once $abs_us_root.$us_url_root.'users/includes/page_footer.php'; // the final html footer copyright row + the external js calls ?>
        <!-- Place any per-page javascript here -->
        <?php require_once $abs_us_root.$us_url_root.'users/includes/html_footer.php'; // currently just the closing /body and /html ?>
