<?php
require_once '../users/init.php';
require_once $abs_us_root.$us_url_root.'users/includes/header.php';
require_once $abs_us_root.$us_url_root.'users/includes/navigation.php';
if(isset($user) && $user->isLoggedIn()){
}

$id = $_POST["id"];
$finish = "1";
$locked = "2";
$data = [

    'id' => $id,

    'state' => $finish,

];

$sql = "UPDATE thread SET state=:state WHERE id=:id";

$stmt= $pdo->prepare($sql);

$stmt->execute($data);

$data = [

    'id' => $id,

    'state' => $locked,

];

$sql = "UPDATE thread SET locked=:state WHERE id=:id";

$stmt= $pdo->prepare($sql);

$stmt->execute($data);

$stmt = $pdo->prepare('SELECT * FROM `thread` where id=? ');
$stmt->bindParam(1, $id, PDO::PARAM_STR);
$stmt->execute();
$result = $stmt->fetchAll();
if ($stmt->rowCount() != 0) {
    foreach ($result as $row) {
        echo " 

            ";
    }}

    $sub_category = $row["sub_cate"];
$stmt = $pdo->prepare('SELECT * FROM `sub_category` where id=? ');
$stmt->bindParam(1, $sub_category, PDO::PARAM_STR);
$stmt->execute();
$result = $stmt->fetchAll();
if ($stmt->rowCount() != 0) {
    foreach ($result as $row) {
        echo " 

            ";
    }}
    $topics = $row["topics"];
    $math = "1";
    $qmath = $topics - $math;
$data = [

    'id' => $sub_category,

    'state' => $qmath,

];

$sql = "UPDATE sub_category SET topics=:state WHERE id=:id";

$stmt= $pdo->prepare($sql);

$stmt->execute($data);

header("location: /forums/threads.php?id=".$sub_category."  ")
?>

<?php require_once $abs_us_root.$us_url_root.'users/includes/page_footer.php'; // the final html footer copyright row + the external js calls ?>
<!-- Place any per-page javascript here -->
<?php require_once $abs_us_root.$us_url_root.'users/includes/html_footer.php'; // currently just the closing /body and /html ?>
