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
    require '../includes/dbCentralConnect.inc.php';
    $sqlStr='SELECT dept_name, tot_crd FROM student WHERE name=?';
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sqlStr)){
        $dept_name='Data fetch failed';
        $CGPA='Data fetch failed';
    }else{
        mysqli_stmt_bind_param($stmt,'s',$_SESSION['name']);
        mysqli_stmt_execute($stmt);
        $result=mysqli_stmt_get_result($stmt);
        if($row=mysqli_fetch_assoc($result)){
            $dept_name=$row['dept_name'];
            $CGPA=$row['tot_crd'];
        }
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
    <link rel="stylesheet" type="text/css" href="../stylesheets/studentProfile.BI.css">
</head>
<body>
<div class="leftButton" style="display: inline">
    <button class="backBtn" onclick="location.href='studentLanding.STU.php'">Back</button>
</div>
<div class="rightButton" style="display: inline; float: right;">
    <button class="logoutBtn" onclick="location.href='../includes/logout.inc.php'">Logout</button>
</div>

<div class="header">
    <h1 class="head1">My Basic Information</h1>
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
    <span class="mainContentText">
        Student ID: <strong><?php
            echo $_SESSION['student_id']
            ?></strong>
    </span>
    <span class="mainContentText">
        Student Name: <strong><?php
            echo $_SESSION['name']
            ?></strong>
    </span>
    <span class="mainContentText">
        CGPA: <strong><?php
            echo $CGPA.' out of 4.00';
            ?></strong>
    </span>
    <span class="mainContentText">
        Department: <strong>
            <?php
        echo $dept_name;?>
        </strong>
    </span>
    <span class="mainContentText">
        Adviser: <strong>
            <?php
            $adviserName='the Administrator';
            $findInsString='SELECT DISTINCT i_id, s_id, i.name FROM advisor join instructor i on advisor.i_id = i.ID where s_id=?;';
            mysqli_stmt_prepare($stmt,$findInsString);
            mysqli_stmt_bind_param($stmt,'s',$_SESSION['student_id']);
            mysqli_stmt_execute($stmt);
            $result=mysqli_stmt_get_result($stmt);
            if($row=mysqli_fetch_assoc($result)){
                $adviserName=$row['name'];
            }
            echo 'Prof. '.$adviserName;?>
        </strong>
    </span>
    <span class="mainContentText">
        University Email ID: <strong><?php
            echo $_SESSION['student_id']
            ?>@std.eul.edu.tr</strong>
    </span>
</div>
</body>
</html>
