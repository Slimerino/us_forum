<?php
require_once '../../../users/init.php';
require_once $abs_us_root.$us_url_root.'users/includes/header.php';
require_once $abs_us_root.$us_url_root.'users/includes/navigation.php';
if(isset($user) && $user->isLoggedIn()){
}
?>
<div id="page-wrapper">
    <div class="container">
    <div class="panel panel-primary">
        <div class="panel-heading">
            Adding Sub Categories
        </div>
        <div class="panel-body">
    <form action='step2_sc.php' method='post'>
        Name: <input type='text' name='name'><br>
        Desc: <input type='text' name='desc'><br>
        Which Category to be under<br>
<?php
$stmt = $pdo->prepare('SELECT * FROM `category` ');
$stmt->execute();
$result = $stmt->fetchAll();
if ($stmt->rowCount() != 0) {
    foreach ($result as $row) {
        echo " 
                <input type=\"radio\" name=\"category\" value=\"".$row["id"]." \" checked>".$row["name"]."<br>                              
            ";
    }}
?>
        <input type="submit" class="btn btn-default">
    </form>
        </div>
    </div>
    </div>
</div>

<?php require_once $abs_us_root.$us_url_root.'users/includes/page_footer.php'; // the final html footer copyright row + the external js calls ?>
<!-- Place any per-page javascript here -->
<?php require_once $abs_us_root.$us_url_root.'users/includes/html_footer.php'; // currently just the closing /body and /html ?>
