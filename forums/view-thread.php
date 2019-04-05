
<?php
require_once '../users/init.php';
require_once $abs_us_root.$us_url_root.'users/includes/header.php';
require_once $abs_us_root.$us_url_root.'users/includes/navigation.php';
?>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
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
        border-color: black;
        background: #232526;
        background: -webkit-linear-gradient(to left, #414345, #232526);
        background: linear-gradient(to left, #414345, #232526);
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

    $stmt = $pdo->prepare('SELECT * FROM `thread` where id=? ');
    $stmt->bindParam(1, $_GET["id"], PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetchAll();
    if ($stmt->rowCount() != 0) {
        foreach ($result as $row) {
            $lock = $row["locked"];
            if ($lock == '2'){
                $lock_status = "
            
             <div class='panel panel-slimey'>
             <div class='panel-heading'>
             Post a Comment
</div>
             <div class='panel-body'>
             <b>This thread is locked so you are unable to post comments</b>
             
</div>
             </div>
";
            }
            else if ($lock == '1'){
                $lock_status = "
<form action='reply.php' method='post' id='comment'>
             <div class='panel panel-slimey'>
             <div class='panel-heading'>
             Post a Comment
</div>
             <div class='panel-body'>
             <textarea rows=\"4\" cols=\"150\" name=\"comment\" form=\"comment\">Post your comment </textarea>
             <br>
             <input type=\"hidden\" name=\"id\" value=\"".$row["id"]." \" >
             <input type=\"hidden\" name=\"username\" value=\"".$user->data()->username." \">
             <input type=\"hidden\" name=\"author_id\" value=\"".$user->data()->id." \">
             <input class='btn btn' type='submit'>
</div>
             </div>
             </form>
";
            }
            echo " 
 <div class=\"meme\">
         <div class='container'>
         
         <div class='row'>
         <div class=\"col-md-4\">
         <div class='panel panel-slimey '>
         <div class='panel-heading'>
            User Info
</div>
<div class='panel-body'>
   <center> <i class=\"fas fa-user fa-7x\"></i><br>
          <h3><b>". $row["author"] ."</b></h3> <br>
          <a href=\"/users/profile.php?id=".$row["author_id"]."\" class=\"btn btn-default btn-block\">Profile</a>
   </center>
</div>
</div>
</div>
<div class=\"col-md-8\">
         <div class='panel panel-slimey '>
          <div class='panel-heading'>
                ".$row["name"]." 
            </div>
            <div class='panel-body'>
            ". $row["message"] ."
</div>
</div>
          </div>
            </div>
        </div>
            ";
        }}
    echo "
<div class='container'>
".$lock_status."
</div>
";

    $stmt = $pdo->prepare('SELECT * FROM `forum_comment` where thread_id=? ORDER BY id DESC');
    $stmt->bindParam(1, $_GET["id"], PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetchAll();
    if ($stmt->rowCount() != 0) {
        foreach ($result as $row) {
            echo " 
         <div class='container'>
  
         <div class='panel panel-slimey'>
         <div class='panel-heading'>
         
            Comment <br>".$row["date"] ."  ".$row["time"]."
</div>
<div class='panel-body'>
<div class='row'>
<div class=\"col-md-4\">
   <center> <i class=\"fas fa-user fa-3x\"></i><br>
          <h3><b>". $row["author"] ."</b></h3> <br>
          <a href=\"/users/profile.php?id=".$row["author_id"]."\" class=\"btn btn-default btn-block\">Profile</a>
          
   </center>
   </div>
   <div class=\"col-md-8\">
   ".$row["message"] ."
</div>
   </div>
</div>
</div>
</div>
            ";
        }}

    if(hasPerm([2],$user->data()->id)){
        echo "
        <div class='container'>
        <div class='panel panel-slimey'>
        <div class='panel-heading'>
        Moderation
        </div>
        <div class='panel-body'>
        <form action='lock.php' method='post'>
        <input type='submit' value='Lock' class='btn btn'>
        <input type=\"hidden\" name=\"id\" value=\"".$row["id"]." \" >
</form>
        <form action='unlock.php' method='post'>
        <input type='submit' value='Unlock' class='btn btn'>
        <input type=\"hidden\" name=\"id\" value=\"".$row["id"]." \" >
</form>
                <form action='delete.php' method='post'>
        <input type='submit' value='Delete' class='btn btn'>
        <input type=\"hidden\" name=\"id\" value=\"".$row["id"]." \" >
</form>
        </div>
        </div>
        </div>
       
        </div>
        ";
    }

    ?>
</div>

<!-- footers -->
<?php require_once $abs_us_root.$us_url_root.'users/includes/page_footer.php'; // the final html footer copyright row + the external js calls ?>

<!-- Place any per-page javascript here -->

<?php require_once $abs_us_root.$us_url_root.'users/includes/html_footer.php'; // currently just the closing /body and /html ?>