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
    <title>Assigned Courses</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../stylesheets/ErrorBoxes.css">
    <link rel="stylesheet" type="text/css" href="../stylesheets/instructorProfile.css">
    <link rel="stylesheet" type="text/css" href="../stylesheets/instructorLoS.css">
</head>
<body>
<?php
if(isset($_GET['courseID'])){
    echo '<div class="leftButton" style="display: inline">
    <button class="backBtn" onclick="location.href=\'instructorAssignedCourses.INS.php\'">Back</button>
</div>';
}
if(!isset($_GET['courseID'])){
    echo '<div class="leftButton" style="display: inline">
    <button class="backBtn" onclick="location.href=\'instructorLanding.INS.php\'">Back</button>
</div>';
}
?>

<div class="rightButton" style="display: inline; float: right;">
    <button class="logoutBtn" onclick="location.href='../includes/logout.inc.php'">Logout</button>
</div>

<div class="header">
    <h1 class="head1">Assigned Courses</h1>
</div>

<div class="topnav">
    <a class="topnavLeft" href="instructorAssignedCourses.INS.php">Assigned Courses</a>
    <a class="topnavMid" href="instructorLoS.INS.php">List of Students</a>
    <a class="topnavRight" href="instructorAccount.INS.php">Account Settings</a>
</div>
<?php
require '../includes/dbCentralConnect.inc.php';
if(!isset($_GET['courseID'])){
    $findAssignedCourses='SELECT * FROM teaches WHERE ID=?';
    $insID=$_SESSION['instructor_id'];
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$findAssignedCourses)){
        echo '<div class="errorBG">';
        echo '<span class="errorType1">Course Information fetch failed!</span>';
        echo '<span class="errorType1"> Contact the administrator</span>';
        echo '</div>';
    }
    mysqli_stmt_bind_param($stmt,'i',$insID);
    mysqli_stmt_execute($stmt);
    $result=mysqli_stmt_get_result($stmt);
    echo '<div class="tableContainer" style="margin-top: 0">';
    echo '<div class="tableText" style="color: white">List of Assigned Courses</div> <br/>';
    echo '<table>';
    echo '<tr><th class="tableText" style="padding-top: 10px">Course ID</th><th class="tableText" style="padding-top: 10px">Semester</th><th class="tableText" style="padding-top: 10px">Year</th><th class="tableText" style="padding-top: 10px">Building</th><th class="tableText" style="padding-top: 10px">Room No.</th></tr>';
    while($row=mysqli_fetch_assoc($result)){
        $resultCourseID=$row['course_id'];
        $resultSemester=$row['semester'];
        $resultYear=$row['year'];
        $resultBuilding='N/A';
        $resultRoom_no='N/A';
        $findLocation='SELECT building, room_no FROM section WHERE course_id=? AND semester=? AND year=?';
        $stmt1=mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt1,$findLocation)){
            echo '<div class="errorBG">';
            echo '<span class="errorType1">Class location Information fetch failed!</span>';
            echo '<span class="errorType1"> Contact the administrator</span>';
            echo '</div>';
        }
        mysqli_stmt_bind_param($stmt1,'ssi', $resultCourseID,$resultSemester,$resultYear);
        mysqli_stmt_execute($stmt1);
        $result1=mysqli_stmt_get_result($stmt1);
        if($row1=mysqli_fetch_assoc($result1)){
            $resultBuilding=$row1['building'];
            $resultRoom_no=$row1['room_no'];
        }
        echo '<tr>
            <td>
            <a class="buttonStyle1" style="padding: 5px 25px; margin: 10px; border-radius: 0; background-color: rgba(2,99,169,0.5);" href="instructorAssignedCourses.INS.php?courseID='.$resultCourseID.'">'.$resultCourseID.'</a>
            </td>
            <td>
            <span class="tableText"><strong>'.$resultSemester.'</strong></span>
            </td>
            <td>
            <span class="tableText"><strong>'.$resultYear.'</strong></span>
            </td>
            <td>
            <span class="tableText"><strong>'.$resultBuilding.'</strong></span>
            </td>
            <td>
            <span class="tableText"><strong>'.$resultRoom_no.'</strong></span>
            </td>
            </tr>';
    }
    echo '</table>';
}
if(isset($_GET['courseID'])){
    echo '<div class="mainContentBack" style="text-align: left; padding: 20px">';
    $courseID=$_GET['courseID'];
    $findCourseInfo='SELECT * FROM course WHERE course_id=?';
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$findCourseInfo)){
        echo '<div class="errorBG">';
        echo '<span class="errorType1">Course Information fetch failed!</span>';
        echo '<span class="errorType1"> Contact the administrator</span>';
        echo '</div>';
    }
    mysqli_stmt_bind_param($stmt,'s',$courseID);
    mysqli_stmt_execute($stmt);
    $result=mysqli_stmt_get_result($stmt);
    if ($row=mysqli_fetch_assoc($result)){
        echo '<span class="mainContentText" style="color: white; font-size:large ">Course ID: <strong><br/>'.$row['course_id'].'</strong></span><br/><br/>';
        echo '<span class="mainContentText" style="color: white; font-size:large ">Course Title: <strong><br/>'.$row['title'].'</strong></span><br/><br/>';
        echo '<span class="mainContentText" style="color: white; font-size:large ">Department: <strong><br/>'.$row['dept_name'].'</strong></span><br/><br/>';
        echo '<span class="mainContentText" style="color: white; font-size:large ">Credits: <strong><br/>'.$row['credits'].'</strong></span><br/><br/>';
        echo '</div>';
    }
}
?>
</body>
</html>