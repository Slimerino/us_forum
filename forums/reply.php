<?php
require_once '../users/init.php';
require_once $abs_us_root.$us_url_root.'users/includes/header.php';
require_once $abs_us_root.$us_url_root.'users/includes/navigation.php';
if(isset($user) && $user->isLoggedIn()){
}
?>

<?php
$comment = $_POST["comment"];
$id = $_POST["id"];
$username = $_POST["username"];
$author_id = $_POST["author_id"];
$date = date("Y/m/d");
$time = date("h:i:sa");




$stmt = $pdo->prepare('INSERT INTO `forum_comment` (`id`, `author`, `author_id`, `message`, `thread_id`, `date`, `time`) VALUES (NULL, ?, ?, ?, ?, ?, ?);');
$stmt->bindParam(1, $username, PDO::PARAM_STR);
$stmt->bindParam(2, $author_id, PDO::PARAM_STR);
$stmt->bindParam(3, $comment, PDO::PARAM_STR);
$stmt->bindParam(4, $id, PDO::PARAM_STR);
$stmt->bindParam(5, $date, PDO::PARAM_STR);
$stmt->bindParam(6, $time, PDO::PARAM_STR);
$stmt->execute();


echo $comment;
echo "<br>";
echo $id;
echo "<br>";
echo $username;
echo "<br>";
echo $author_id;
echo "<br>";
echo $date;
echo "<br>";
echo $time;


header("location: /forums/view-thread.php?id=".$id."  ")
?>
<?php
$stmt = $pdo->prepare('SELECT * FROM `thread` where id=? ');
$stmt->bindParam(1, $id, PDO::PARAM_STR);
$stmt->execute();
$result = $stmt->fetchAll();
if ($stmt->rowCount() != 0) {
foreach ($result as $row) {
$reply = $row["replies"];

$amount_2 = "1";

$finish = $reply + $amount_2;

$data = [

    'id' => $id,

    'state' => $finish,

];

$sql = "UPDATE thread SET replies=:state WHERE id=:id";

$stmt= $pdo->prepare($sql);

$stmt->execute($data);
?>
<?php require_once $abs_us_root.$us_url_root.'users/includes/page_footer.php'; // the final html footer copyright row + the external js calls ?>
<!-- Place any per-page javascript here -->
<?php require_once $abs_us_root.$us_url_root.'users/includes/html_footer.php'; // currently just the closing /body and /html ?>
<? }} ?>