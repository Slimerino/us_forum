<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
<?php
require_once '../users/init.php';
require_once $abs_us_root.$us_url_root.'users/includes/header.php';
require_once $abs_us_root.$us_url_root.'users/includes/navigation.php';
?>
<style>
    #page-wrapper {
        background-image: url(" 2.png ");
        background-repeat: no-repeat;
        background-attachment: fixed;
        height: 100%;
        background-position: center;
        background-size: cover;
    }
    .panel-slimey > .panel-heading {
        color: white;
        background: #232526;  /* fallback for old browsers */
        background: -webkit-linear-gradient(to left, #414345, #232526);  /* Chrome 10-25, Safari 5.1-6 */
        background: linear-gradient(to left, #414345, #232526); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
    }

    .effect7
    {
        position:relative;
        -webkit-box-shadow:0 1px 4px rgba(0, 0, 0, 0.3), 0 0 40px rgba(0, 0, 0, 0.1) inset;
        -moz-box-shadow:0 1px 4px rgba(0, 0, 0, 0.3), 0 0 40px rgba(0, 0, 0, 0.1) inset;
        box-shadow:0 1px 4px rgba(0, 0, 0, 0.3), 0 0 40px rgba(0, 0, 0, 0.1) inset;
    }
    .effect7:before, .effect7:after
    {
        content:"";
        position:absolute;
        z-index:-1;
        -webkit-box-shadow:0 0 20px rgba(0,0,0,0.8);
        -moz-box-shadow:0 0 20px rgba(0,0,0,0.8);
        box-shadow:0 0 20px rgba(0,0,0,0.8);
        top:0;
        bottom:0;
        left:10px;
        right:10px;
        -moz-border-radius:100px / 10px;
        border-radius:100px / 10px;
    }
    .effect7:after
    {
        right:10px;
        left:auto;
        -webkit-transform:skew(8deg) rotate(3deg);
        -moz-transform:skew(8deg) rotate(3deg);
        -ms-transform:skew(8deg) rotate(3deg);
        -o-transform:skew(8deg) rotate(3deg);
        transform:skew(8deg) rotate(3deg);
    }

    .forum {
        text-decoration: none;
    }
</style>
<div id="page-wrapper">
    <?php

    echo"
<center>
<form action='new-thread.php' method='post'>
<input type='submit' value='New Thread' class='btn btn'>
<input type=\"hidden\" name=\"id\" value=\"".$_GET["id"]." \">
</form>
</center>
    ";
    ?>


    <?php

    $stmt = $pdo->prepare('SELECT * FROM `thread` where sub_cate=? and state = 0 ORDER BY id DESC');
    $stmt->bindParam(1, $_GET["id"], PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetchAll();
    if ($stmt->rowCount() != 0) {
        foreach ($result as $row) {

            $lock = $row["locked"];
            if ($lock == '2'){
                $lock_status = "
             <i class=\"fas fa-lock\"></i>
";
            }
            else if ($lock == '1'){
                $lock_status = "
             <i class=\"fas fa-lock-open\"></i>
";
            }
            echo " 
<a style='text-decoration: none;' href=\"view-thread.php?id=" . $row["id"] . "\">
         <div class='container'>
         <div class='panel panel-slimey effect7'>
          <div class='panel-heading'>
                ".$row["name"]."    ". $lock_status ."
            </div>
            <div class='panel-body'>
            ". $row["author"] ."
            <br>
            ".$row["replies"] ." replies
</div>
          </div>
            </div>
            </a>
            ";
        }}



    ?>
</div>


<!-- footers -->
<?php require_once $abs_us_root.$us_url_root.'users/includes/page_footer.php'; // the final html footer copyright row + the external js calls ?>

<!-- Place any per-page javascript here -->

<?php require_once $abs_us_root.$us_url_root.'users/includes/html_footer.php'; // currently just the closing /body and /html ?>