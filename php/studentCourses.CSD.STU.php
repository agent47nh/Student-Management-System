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
    <title>My Courses</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../stylesheets/studentProfile.CDDays.css">
</head>
<body>
<div class="leftButton" style="display: inline">
    <button class="backBtn" onclick="location.href='studentAccount.STU.php'">Back</button>
</div>
<div class="rightButton" style="display: inline; float: right;">
    <button class="logoutBtn" onclick="location.href='../includes/logout.inc.php'">Logout</button>
</div>

<div class="header">
    <h1 class="head1">Current Semester Details</h1>
</div>

<div class="topnav">
    <a class="topnavLeft" href="studentProfile.STU.php">My Profile</a>
    <a class="topnavMid" href="studentCourses.STU.php">My Courses</a>
    <a class="topnavRight" href="studentAccount.STU.php">Account Settings</a>
</div>
<div class="mainContentBack">
    <div class="mainContentText">
        <?php
        include '../includes/dbCentralConnect.inc.php';
        $str='SELECT * FROM course natural join takes WHERE ID=?;';
        $findInsString='SELECT DISTINCT i_id, s_id, i.name FROM advisor join instructor i on advisor.i_id = i.ID where s_id=?;';
        $adviserName='the administrator';
        $stmt=mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$str)){
            $courseID='Data fetch failed';
            $courseName='Data fetch failed';
            $credits='Data fetch failed';
            $deptName='Data fetch failed';
        }else{
            mysqli_stmt_bind_param($stmt,'s',$_SESSION['student_id']);
            mysqli_stmt_execute($stmt);
            $result=mysqli_stmt_get_result($stmt);
            $rowCount=mysqli_num_rows($result);
            while($row=mysqli_fetch_assoc($result)){
                $courseID=$row['course_id'];
                echo '<a class="buttonStyle1" style="margin: auto 5px" href="studentCourses.CSD.STU.php?course='.$courseID.'">'.$courseID.'&nbsp</a>';
            }
            mysqli_stmt_prepare($stmt,$findInsString);
            mysqli_stmt_bind_param($stmt,'s',$_SESSION['student_id']);
            mysqli_stmt_execute($stmt);
            $result=mysqli_stmt_get_result($stmt);
            if($row=mysqli_fetch_assoc($result)){
                $adviserName=$row['name'];
            }
            if(!$rowCount)
                echo '<div class="errorBG"><span class="error2">Courses are NOT Assigned. Please visit your adviser <strong>Prof. '.$adviserName.'</strong></span></div>';
        }
        ?>
    </div>
</div>
<?php
$courseMID='';
$courseName='';
$credits='';
$deptName='';
if(isset($_GET['course'])){
    $sqlStr='SELECT * FROM course where course_id=?';
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sqlStr)){
        $courseMID='Data fetch failed';
        $courseName='Data fetch failed';
        $credits='Data fetch failed';
        $deptName='Data fetch failed';
    }else{
        mysqli_stmt_bind_param($stmt,'s',$_GET['course']);
        mysqli_stmt_execute($stmt);
        $result=mysqli_stmt_get_result($stmt);
        if($row=mysqli_fetch_assoc($result)){
            $courseMID=$row['course_id'];
            $courseName=$row['title'];
            $credits=$row['credits'];
            $deptName=$row['dept_name'];
        }
    }
}
?>
<div class="mainContentBack">
    <div class="mainContentText" style="text-align: left">
        Course ID:<strong>&nbsp<?php
            echo $courseMID;
            ?><br/></strong>
        Course Name:<strong>&nbsp<?php
            echo $courseName;
            ?><br/></strong>
        Credits:<strong>&nbsp<?php
            echo $credits;
            ?><br/></strong>
        Department:<strong>&nbsp<?php
            echo $deptName;
            ?><br/></strong>
    </div>
</div>
</body>
</html>
