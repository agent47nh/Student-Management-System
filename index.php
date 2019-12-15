<?php
session_start();
    include 'includes/dbCentralConnect.inc.php';
if(isset($_SESSION['type'])){
    if($_SESSION['type']==='Admin'){
        header('Location: php/adminLanding.ADM.php');
        exit();
    }
    if($_SESSION['type']==='Student'){
        header('Location: php/studentLanding.STU.php');
        exit();
    }
    if($_SESSION['type']==='Instructor'){
        header('Location: php/instructorLanding.INS.php');
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Better OIBS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="stylesheets/main.css" rel="stylesheet" type="text/css">
    <link href="stylesheets/ErrorBoxes.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<body>
<div class="outHead1">
    <h1 class="head1">Welcome to Better OIBS</h1>
</div>
<div class="BackBox">
    <form action="includes/login.inc.php" method="POST">
        <?php
            if(isset($_GET['uid'])){
                echo '<i id="icoUser" class="material-icons">account_circle</i>';
                echo '<input class="inputBox" type="text" name="userName" placeholder="Username" value="'.$_GET['uid'].'"><br/>';
            } else{
                echo '<i id="icoUser" class="material-icons">account_circle</i>';
                echo '<input class="inputBox" type="text" name="userName" placeholder="Username"><br/>';
            }
        ?>
        <i id="icoPass" class="material-icons">vpn_key</i>
        <input class="inputBox" type="password" name="password" placeholder="Password"><br>
        <button class="button" name="login" type="submit">Login</button>
    </form>
</div>
<?php
    if(isset($_GET['error'])){
        echo '<div class="errorBG">';
        if($_GET['error']==='emptyFields'){
            echo '<span class="errorType1">Fields are empty!</span><br/>';
        }
        if($_GET['error']==='passNotEntered'){
            echo '<span class="errorType1">Please enter your Password.</span><br/>';
        }
        if($_GET['error']==='userNotEntered'){
            echo '<span class="errorType1">Please enter your Username.</span><br/>';
        }
        if($_GET['error']==='sqlError'){
            echo '<span class="errorType1">Connection to Server Failed!</span><br/>';
        }
        if($_GET['error']==='wrongUsrPass'){
            echo '<span class="errorType1">Wrong Username or Password!</span><br/>';
        }
        echo '</div>';
    }
?>
</body>
</html>