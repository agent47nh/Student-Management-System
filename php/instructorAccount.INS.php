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
    <title>Account Settings</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../stylesheets/instructorProfile.css">
    <link href="../stylesheets/ErrorBoxes.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="leftButton" style="display: inline">
    <button class="backBtn" onclick="location.href='instructorLanding.INS.php'">Back</button>
</div>
<div class="rightButton" style="display: inline; float: right;">
    <button class="logoutBtn" onclick="location.href='../includes/logout.inc.php'">Logout</button>
</div>

<div class="header">
    <h1 class="head1"><?php
        echo $_SESSION['name'];
        ?>'s Account Settings</h1>
</div>
<div class="topnav">
    <a class="topnavLeft" href="instructorAssignedCourses.INS.php">Assigned Courses</a>
    <a class="topnavMid" href="instructorLoS.INS.php">List of Students</a>
    <a class="topnavRight" href="instructorAccount.INS.php">Account Settings</a>
</div>
<?php
$_SESSION['accountURI']='instructorAccount.CU.INS.php?';
$_SESSION['accountURI1']='instructorAccount.CP.INS.php?';
if(isset($_GET['success'])){
    echo '<div class="errorBG">';
    echo '<br/><br/>';
    if($_GET['success']==='passwordUpdated'){
        echo '<span class="errorType1" style="background-color: rgba(67,160,71,1)">Password successfully updated</span><br/>';
    }
    if($_GET['success']==='userNameUpdated'){
        echo '<span class="errorType1" style="background-color: rgba(67,160,71,1)">Username successfully updated</span><br/>';
    }
    echo '</div>';
}
?>
<div class="mainContentBack">
    <div class="mainContentText">Current Username<br/><br/><strong><?php echo $_SESSION['userName']?></strong></div><br/>
    <button class="mainContent" onclick="location.href='instructorAccount.PROF.INS.php'">My Profile</button>
    <button class="mainContent" onclick="location.href='instructorAccount.CU.INS.php'">Change Username</button><br/>
    <button class="mainContent" onclick="location.href='instructorAccount.CP.INS.php'">Change Password</button>
</div>
</body>
</html>
