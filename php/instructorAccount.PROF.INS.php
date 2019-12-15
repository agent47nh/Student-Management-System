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
    <title>My Profile</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../stylesheets/instructorProfile.css">
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
    <h1 class="head1"><?php
        echo $_SESSION['name'];
        ?>'s Profile</h1>
</div>
<div class="topnav">
    <a class="topnavLeft" href="instructorAssignedCourses.INS.php">Assigned Courses</a>
    <a class="topnavMid" href="instructorLoS.INS.php">List of Students</a>
    <a class="topnavRight" href="instructorAccount.INS.php">Account Settings</a>
</div>
<div class="mainContentBack" style="text-align: left;">
    <?php
    require '../includes/dbCentralConnect.inc.php';
    $insName='N/A';
    $insDept='N/A';
    $insSalary='N/A';
    $insID=$_SESSION['instructor_id'];
    $findInstructorInfo='SELECT * FROM instructor WHERE ID=?';
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$findInstructorInfo)){
        echo '<div class="errorBG">';
        echo '<span class="errorType1">Information fetch failed!</span>';
        echo '<span class="errorType1"> Contact the administrator</span>';
        echo '</div>';
    }
    mysqli_stmt_bind_param($stmt,'i',$insID);
    mysqli_stmt_execute($stmt);
    $result=mysqli_stmt_get_result($stmt);
    if($row=mysqli_fetch_assoc($result)){
        $insName=$row['name'];
        $insDept=$row['dept_name'];
        $insSalary=$row['salary'];
    }
    echo '<div class="mainContentText" style="margin: auto 20px;padding: 0; font-size: large; font-family: Lato-Regular">Identification Number: <br/><strong>'.$insID.'</strong></div><br/>';
    echo '<div class="mainContentText" style="margin: auto 20px;padding: 0; font-size: large; font-family: Lato-Regular">Name: <br/><strong>'.$insName.'</strong></div><br/>';
    echo '<div class="mainContentText" style="margin: auto 20px;padding: 0; font-size: large; font-family: Lato-Regular">Department: <br/><strong>'.$insDept.'</strong></div><br/>';
    echo '<div class="mainContentText" style="margin: auto 20px;padding: 0; font-size: large; font-family: Lato-Regular">Salary: <br/><strong>$'.$insSalary.' USD</strong> per Class</div>';
    ?>
</div>
</body>
</html>
