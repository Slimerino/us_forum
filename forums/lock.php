<?php
require_once '../users/init.php';
require_once $abs_us_root.$us_url_root.'users/includes/header.php';
require_once $abs_us_root.$us_url_root.'users/includes/navigation.php';
if(isset($user) && $user->isLoggedIn()){
}

$id = $_POST["id"];
$finish = "2";
$data = [

    'id' => $id,

    'state' => $finish,

];

$sql = "UPDATE thread SET locked=:state WHERE id=:id";

$stmt= $pdo->prepare($sql);

$stmt->execute($data);
header("location: /forums/view-thread.php?id=".$id."  ")
?>

<?php require_once $abs_us_root.$us_url_root.'users/includes/page_footer.php'; // the final html footer copyright row + the external js calls ?>
<!-- Place any per-page javascript here -->
<?php require_once $abs_us_root.$us_url_root.'users/includes/html_footer.php'; // currently just the closing /body and /html ?>
