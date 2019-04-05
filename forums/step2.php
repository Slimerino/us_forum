<?php
require_once '../users/init.php';
require_once $abs_us_root.$us_url_root.'users/includes/header.php';
require_once $abs_us_root.$us_url_root.'users/includes/navigation.php';
if(isset($user) && $user->isLoggedIn()){
}
?>

<?php
$comment = $_POST["message"];
$title = $_POST["title"];
$id = $_POST["id"];
$username = $_POST["username"];
$author_id = $_POST["author_id"];
$date = date("Y/m/d");
$time = date("h:i:sa");
$locked = "1";
$replies = "0";
$rank = "0";

$stmt = $pdo->prepare('INSERT INTO `thread` (`id`, `name`, `author`, `author_id`, `message`, `locked`, `sub_cate`, `replies`, `state`) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?,?);');
$stmt->bindParam(1, $title, PDO::PARAM_STR);
$stmt->bindParam(2, $username, PDO::PARAM_STR);
$stmt->bindParam(3, $author_id, PDO::PARAM_STR);
$stmt->bindParam(4, $comment, PDO::PARAM_STR);
$stmt->bindParam(5, $locked, PDO::PARAM_STR);
$stmt->bindParam(6, $id, PDO::PARAM_STR);
$stmt->bindParam(7, $replies, PDO::PARAM_STR);
$stmt->bindParam(8, $rank, PDO::PARAM_STR);
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


header("location: /forums/category.php?id=".$id."  ")
?>
<?php
$stmt = $pdo->prepare('SELECT * FROM `sub_category` where id=? ');
$stmt->bindParam(1, $id, PDO::PARAM_STR);
$stmt->execute();
$result = $stmt->fetchAll();
if ($stmt->rowCount() != 0) {
    foreach ($result as $row) {
        $reply = $row["topics"];

        $amount_2 = "1";

        $finish = $reply + $amount_2;

        $data = [

            'id' => $id,

            'state' => $finish,

        ];

        $sql = "UPDATE sub_category SET topics=:state WHERE id=:id";

        $stmt= $pdo->prepare($sql);

        $stmt->execute($data);
        ?>
        <?php require_once $abs_us_root.$us_url_root.'users/includes/page_footer.php'; // the final html footer copyright row + the external js calls ?>
        <!-- Place any per-page javascript here -->
        <?php require_once $abs_us_root.$us_url_root.'users/includes/html_footer.php'; // currently just the closing /body and /html ?>
    <? }} ?>