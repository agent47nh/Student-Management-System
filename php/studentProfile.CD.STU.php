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
    <title><?php
        echo $_SESSION['name'];
        ?>'s
        Profile</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../stylesheets/studentProfile.CD.css">
</head>
<body>
<div class="leftButton" style="display: inline">
    <button class="backBtn" onclick="location.href='studentLanding.STU.php'">Back</button>
</div>
<div class="rightButton" style="display: inline; float: right;">
    <button class="logoutBtn" onclick="location.href='../includes/logout.inc.php'">Logout</button>
</div>

<div class="header">
    <h1 class="head1">My Class Details</h1>
</div>

<div class="topnav">
    <a class="topnavLeft" href="studentProfile.STU.php">My Profile</a>
    <a class="topnavMid" href="studentCourses.STU.php">My Courses</a>
    <a class="topnavRight" href="studentAccount.STU.php">Account Settings</a>
</div>
<div id="sideBar">
    <a class="buttons" href="studentProfile.BI.STU.php">
        Basic Info
    </a><br/>
    <a class="buttons" href="studentProfile.CD.STU.php">
        Class Details
    </a>
</div>
<div class="mainContentBack">
    <div class="mainContentText">
        <?php
        if(isset($_GET['dayClass'])){
            if($_GET['dayClass']==='Monday'){
                echo '<a class="buttonStyle1" href="studentProfile.CD.STU.php?dayClass=Monday" style="background-color: rgba(76,105,80,0.9);">Monday&nbsp</a>';
                echo '<a class="buttonStyle1" href="studentProfile.CD.STU.php?dayClass=Tuesday">Tuesday&nbsp</a>';
                echo '<a class="buttonStyle1" href="studentProfile.CD.STU.php?dayClass=Wednesday">Wednesday&nbsp</a>';
                echo '<a class="buttonStyle1" href="studentProfile.CD.STU.php?dayClass=Thursday">Thursday&nbsp</a>';
                echo '<a class="buttonStyle1" href="studentProfile.CD.STU.php?dayClass=Friday">Friday&nbsp</a>';
                echo '<a class="buttonStyle1" href="studentProfile.CD.STU.php?dayClass=Saturday">Saturday&nbsp</a>';
                echo '<a class="buttonStyle1" href="studentProfile.CD.STU.php?dayClass=Sunday">Sunday&nbsp</a>';
            }
            if($_GET['dayClass']==='Tuesday'){
                echo '<a class="buttonStyle1" href="studentProfile.CD.STU.php?dayClass=Monday">Monday&nbsp</a>';
                echo '<a class="buttonStyle1" href="studentProfile.CD.STU.php?dayClass=Tuesday" style="background-color: rgba(76,105,80,0.9);">Tuesday&nbsp</a>';
                echo '<a class="buttonStyle1" href="studentProfile.CD.STU.php?dayClass=Wednesday">Wednesday&nbsp</a>';
                echo '<a class="buttonStyle1" href="studentProfile.CD.STU.php?dayClass=Thursday">Thursday&nbsp</a>';
                echo '<a class="buttonStyle1" href="studentProfile.CD.STU.php?dayClass=Friday">Friday&nbsp</a>';
                echo '<a class="buttonStyle1" href="studentProfile.CD.STU.php?dayClass=Saturday">Saturday&nbsp</a>';
                echo '<a class="buttonStyle1" href="studentProfile.CD.STU.php?dayClass=Sunday">Sunday&nbsp</a>';
            }
            if($_GET['dayClass']==='Wednesday'){
                echo '<a class="buttonStyle1" href="studentProfile.CD.STU.php?dayClass=Monday">Monday&nbsp</a>';
                echo '<a class="buttonStyle1" href="studentProfile.CD.STU.php?dayClass=Tuesday">Tuesday&nbsp</a>';
                echo '<a class="buttonStyle1" href="studentProfile.CD.STU.php?dayClass=Wednesday" style="background-color: rgba(76,105,80,0.9);">Wednesday&nbsp</a>';
                echo '<a class="buttonStyle1" href="studentProfile.CD.STU.php?dayClass=Thursday">Thursday&nbsp</a>';
                echo '<a class="buttonStyle1" href="studentProfile.CD.STU.php?dayClass=Friday">Friday&nbsp</a>';
                echo '<a class="buttonStyle1" href="studentProfile.CD.STU.php?dayClass=Saturday">Saturday&nbsp</a>';
                echo '<a class="buttonStyle1" href="studentProfile.CD.STU.php?dayClass=Sunday">Sunday&nbsp</a>';
            }
            if($_GET['dayClass']==='Thursday'){
                echo '<a class="buttonStyle1" href="studentProfile.CD.STU.php?dayClass=Monday">Monday&nbsp</a>';
                echo '<a class="buttonStyle1" href="studentProfile.CD.STU.php?dayClass=Tuesday">Tuesday&nbsp</a>';
                echo '<a class="buttonStyle1" href="studentProfile.CD.STU.php?dayClass=Wednesday">Wednesday&nbsp</a>';
                echo '<a class="buttonStyle1" href="studentProfile.CD.STU.php?dayClass=Thursday" style="background-color: rgba(76,105,80,0.9);">Thursday&nbsp</a>';
                echo '<a class="buttonStyle1" href="studentProfile.CD.STU.php?dayClass=Friday">Friday&nbsp</a>';
                echo '<a class="buttonStyle1" href="studentProfile.CD.STU.php?dayClass=Saturday">Saturday&nbsp</a>';
                echo '<a class="buttonStyle1" href="studentProfile.CD.STU.php?dayClass=Sunday">Sunday&nbsp</a>';
            }
            if($_GET['dayClass']==='Friday'){
                echo '<a class="buttonStyle1" href="studentProfile.CD.STU.php?dayClass=Monday">Monday&nbsp</a>';
                echo '<a class="buttonStyle1" href="studentProfile.CD.STU.php?dayClass=Tuesday">Tuesday&nbsp</a>';
                echo '<a class="buttonStyle1" href="studentProfile.CD.STU.php?dayClass=Wednesday">Wednesday&nbsp</a>';
                echo '<a class="buttonStyle1" href="studentProfile.CD.STU.php?dayClass=Thursday">Thursday&nbsp</a>';
                echo '<a class="buttonStyle1" href="studentProfile.CD.STU.php?dayClass=Friday" style="background-color: rgba(76,105,80,0.9);">Friday&nbsp</a>';
                echo '<a class="buttonStyle1" href="studentProfile.CD.STU.php?dayClass=Saturday">Saturday&nbsp</a>';
                echo '<a class="buttonStyle1" href="studentProfile.CD.STU.php?dayClass=Sunday">Sunday&nbsp</a>';
            }
            if($_GET['dayClass']==='Saturday'){
                echo '<a class="buttonStyle1" href="studentProfile.CD.STU.php?dayClass=Monday">Monday&nbsp</a>';
                echo '<a class="buttonStyle1" href="studentProfile.CD.STU.php?dayClass=Tuesday">Tuesday&nbsp</a>';
                echo '<a class="buttonStyle1" href="studentProfile.CD.STU.php?dayClass=Wednesday">Wednesday&nbsp</a>';
                echo '<a class="buttonStyle1" href="studentProfile.CD.STU.php?dayClass=Thursday">Thursday&nbsp</a>';
                echo '<a class="buttonStyle1" href="studentProfile.CD.STU.php?dayClass=Friday">Friday&nbsp</a>';
                echo '<a class="buttonStyle1" href="studentProfile.CD.STU.php?dayClass=Saturday" style="background-color: rgba(76,105,80,0.9);">Saturday&nbsp</a>';
                echo '<a class="buttonStyle1" href="studentProfile.CD.STU.php?dayClass=Sunday">Sunday&nbsp</a>';
            }
            if($_GET['dayClass']==='Sunday'){
                echo '<a class="buttonStyle1" href="studentProfile.CD.STU.php?dayClass=Monday">Monday&nbsp</a>';
                echo '<a class="buttonStyle1" href="studentProfile.CD.STU.php?dayClass=Tuesday">Tuesday&nbsp</a>';
                echo '<a class="buttonStyle1" href="studentProfile.CD.STU.php?dayClass=Wednesday">Wednesday&nbsp</a>';
                echo '<a class="buttonStyle1" href="studentProfile.CD.STU.php?dayClass=Thursday">Thursday&nbsp</a>';
                echo '<a class="buttonStyle1" href="studentProfile.CD.STU.php?dayClass=Friday">Friday&nbsp</a>';
                echo '<a class="buttonStyle1" href="studentProfile.CD.STU.php?dayClass=Saturday">Saturday&nbsp</a>';
                echo '<a class="buttonStyle1" href="studentProfile.CD.STU.php?dayClass=Sunday" style="background-color: rgba(76,105,80,0.9);">Sunday&nbsp</a>';
            }
        }
        if(!isset($_GET['dayClass'])){
            echo '<a class="buttonStyle1" href="studentProfile.CD.STU.php?dayClass=Monday">Monday&nbsp</a>';
            echo '<a class="buttonStyle1" href="studentProfile.CD.STU.php?dayClass=Tuesday">Tuesday&nbsp</a>';
            echo '<a class="buttonStyle1" href="studentProfile.CD.STU.php?dayClass=Wednesday">Wednesday&nbsp</a>';
            echo '<a class="buttonStyle1" href="studentProfile.CD.STU.php?dayClass=Thursday">Thursday&nbsp</a>';
            echo '<a class="buttonStyle1" href="studentProfile.CD.STU.php?dayClass=Friday">Friday&nbsp</a>';
            echo '<a class="buttonStyle1" href="studentProfile.CD.STU.php?dayClass=Saturday">Saturday&nbsp</a>';
            echo '<a class="buttonStyle1" href="studentProfile.CD.STU.php?dayClass=Sunday">Sunday&nbsp</a>';
        }
        ?>
    </div>
</div>
</body>
</html>
