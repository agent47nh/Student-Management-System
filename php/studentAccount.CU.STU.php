<?php
session_start();
///     Reserved Code START
if(!isset($_SESSION['type'])){
    header('Location: ../');
    exit();
}else{
    if($_SESSION['type']!=='Student'){
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
    <link rel="stylesheet" type="text/css" href="../stylesheets/studentChange.css">
    <link rel="stylesheet" type="text/css" href="../stylesheets/ErrorBoxes.css">
</head>
<body>
<div class="leftButton" style="display: inline">
    <button class="backBtn" onclick="location.href='studentAccount.STU.php'">Back</button>
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
    <a class="topnavLeft" href="studentProfile.STU.php">My Profile</a>
    <a class="topnavMid" href="studentCourses.STU.php">My Courses</a>
    <a class="topnavRight" href="studentAccount.STU.php">Account Settings</a>
</div>
<?php
$_SESSION['accountURI']='studentAccount.CU.STU.php?';
    if(isset($_GET['error'])){
        echo '<div class="errorBG">';
        if($_GET['error']==='userExists'){
            echo '<span class="errorType1">Choose a different Username. Username already taken.</span><br/>';
        }
        if($_GET['error']==='wrongPass'){
            echo '<span class="errorType1">Enter the correct password</span><br/>';
        }
        if($_GET['error']==='queryError'){
            echo '<span class="errorType1">Internal Error</span><br/>';
        }
        if($_GET['error']==='emptyField'){
            echo '<span class="errorType1">Empty Field</span><br/>';
        }
        echo '</div>';
    }
?>
<div class="mainContentBack" style="text-align: center">
    <div class="mainContentText">Current Username<br/><br/><strong><?php echo $_SESSION['userName']?></strong></div><br/>
    <form action="../includes/changeUserName.inc.php" method="POST">
        <input class="inputBox" type="text" name="changeUserName" placeholder="New Username"><br/>
        <input class="inputBox" type="password" name="currentPassword" placeholder="Current Password"><br/>
        <button class="buttonStyle2" type="submit" name="clickChangeUser">Change Username</button><br/>
    </form>
</div>
</body>
</html>