<?php
session_start();
///     Reserved Code START
if(!isset($_SESSION['type'])){
    header('Location: ../');
    exit();
}else{
    if($_SESSION['type']!=='Instructor'){
        header('Location: ../');
        exit();
    }
}
///     Reserved Code END
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Change Username</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../stylesheets/instructorChange.css">
    <link href="../stylesheets/ErrorBoxes.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="leftButton" style="display: inline">
    <button class="backBtn" onclick="location.href='instructorAccount.INS.php'">Back</button>
</div>
<div class="rightButton" style="display: inline; float: right;">
    <button class="logoutBtn" onclick="location.href='../includes/logout.inc.php'">Logout</button>
</div>

<div class="header">
    <h1 class="head1">Account Settings</h1>
</div>

<div class="topnav">
    <a class="topnavLeft" href="instructorAssignedCourses.INS.php">Assigned Courses</a>
    <a class="topnavMid" href="instructorLoS.INS.php">List of Students</a>
    <a class="topnavRight" href="instructorAccount.INS.php">Account Settings</a>
</div>
<?php
if(isset($_GET['error'])){
    echo '<div class="errorBG">';
    echo '<br/><br/>';
    if($_GET['error']==='passNoMatch'){
        echo '<span class="errorType1">Passwords don\'t match</span><br/>';
    }
    if($_GET['error']==='queryError'){
        echo '<span class="errorType1">Internal Error!</span><br/>';
    }
    if($_GET['error']==='wrongPass'){
        echo '<span class="errorType1">Old Password is <strong>INCORRECT</strong></span><br/>';
    }
    if($_GET['error']==='queryError'){
        echo '<span class="errorType1">Internal Error</span><br/>';
    }
    if($_GET['error']==='fieldEmpty'){
        echo '<span class="errorType1">One of the fields are <strong>EMPTY</strong></span><br/>';
    }
    echo '</div>';
}
?>
<div class="mainContentBack" style="text-align: center">
    <div class="mainContentText" style="font-size: larger">Change Password</div><br/><br/>
    <form action="../includes/changePass.inc.php" method="POST">
        <input class="inputBox" type="password" name="oldPassword" placeholder="Old Password"><br/>
        <input class="inputBox" type="password" name="newPassword" placeholder="New Password"><br/>
        <input class="inputBox" type="password" name="newRePassword" placeholder="Re-enter New Password"><br/>
        <button class="buttonStyle2" type="submit" name="clickChangePass">Change Password</button><br/>
    </form>
</div>
</body>
</html>