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
    <title>List of Students</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../stylesheets/instructorProfile.css">
    <link rel="stylesheet" type="text/css" href="../stylesheets/instructorLoS.css">
    <link rel="stylesheet" type="text/css" href="../stylesheets/ErrorBoxes.css">
</head>
<body>
<div class="leftButton" style="display: inline">
    <button class="backBtn" onclick="location.href='instructorLanding.INS.php'">Back</button>
</div>
<div class="rightButton" style="display: inline; float: right;">
    <button class="logoutBtn" onclick="location.href='../includes/logout.inc.php'">Logout</button>
</div>

<div class="header">
    <h1 class="head1">List of Students</h1>
</div>

<div class="topnav">
    <a class="topnavLeft" href="instructorAssignedCourses.INS.php">Assigned Courses</a>
    <a class="topnavMid" href="instructorLoS.INS.php">List of Students</a>
    <a class="topnavRight" href="instructorAccount.INS.php">Account Settings</a>
</div>
<div class="mainContentBack" style="padding: 0; margin-bottom: 0">
    <div class="mainContentText" style="padding: 30px 0 0">
        <a class="buttonStyle1" href="instructorLoS.ADV.INS.php">Advising</a>
        <a class="buttonStyle1" href="instructorLoS.CRS.INS.php">By Courses Assigned</a>
        <br/><br/>
    </div>
</div>
<?php
require '../includes/dbCentralConnect.inc.php';

//Known Issue: Any Student information can be accessed using the GET method

if(isset($_GET['courseID'],$_GET['year'],$_GET['semester'],$_GET['studentID'])){
    echo '<div class="mainContentBack" style="text-align: left; padding: 20px">';
    $studentID=$_GET['studentID'];
    $studentName='Fetch Failed!';
    $studentDept='Fetch Failed!';
    $studentCGPA='Fetch Failed!';
    $getStudentInfo='SELECT name,dept_name, tot_crd FROM student where ID=?';
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$getStudentInfo)){
        echo '<div class="errorBG">';
        echo '<span class="errorType1">Student Information fetch failed!</span>';
        echo '<span class="errorType1"> Contact the administrator</span>';
        echo '</div>';
    }
    mysqli_stmt_bind_param($stmt,'s',$studentID);
    mysqli_stmt_execute($stmt);
    $result=mysqli_stmt_get_result($stmt);
    while($row=mysqli_fetch_assoc($result)){
        $studentName=$row['name'];
        $studentDept=$row['dept_name'];
        $studentCGPA=$row['tot_crd'];
    }
    echo '<span class="mainContentText" style="color: white; font-size:large ">Student ID: <strong><br/>'.$studentID.'</strong></span><br/><br/>';
    echo '<span class="mainContentText" style="color: white; font-size:large ">Student Name: <strong><br/>'.$studentName.'</strong></span><br/><br/>';
    echo '<span class="mainContentText" style="color: white; font-size:large ">Department: <strong><br/>'.$studentDept.'</strong></span><br/><br/>';
    echo '<span class="mainContentText" style="color: white; font-size:large ">CGPA: <strong><br/>'.$studentCGPA.'</strong></span><br/><br/>';
    echo '</div>';

}elseif(isset($_GET['courseID'],$_GET['year'],$_GET['semester'])){
    $courseID=$_GET['courseID'];
    $yearCourse=$_GET['year'];
    $semester=$_GET['semester'];
    $findStudent='SELECT ID FROM takes WHERE course_id=? AND year=? AND semester=?';
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$findStudent)){
        echo '<div class="errorBG"><span class="errorType1">Data Fetch failed!</span></div>';
    }
    mysqli_stmt_bind_param($stmt,'sis',$courseID,$yearCourse,$semester);
    mysqli_stmt_execute($stmt);
    $result=mysqli_stmt_get_result($stmt);
    $rowCount=mysqli_num_rows($result);
    if(!$rowCount){
        echo '<div class="errorBG"><span class="errorType1">Internal Error</span></div>';
    }
    echo '<div class="tableContainer">';
    echo '<div class="tableText" style="color: white">List of Students taking <strong>'.$courseID.'</strong></div> <br/>';
    echo '<table>';
    echo '<tr><th class="tableText" style="padding-top: 10px">Student ID</th><th class="tableText" style="padding-top: 10px">Name</th><th class="tableText" style="padding-top: 10px">Department</th></tr>';
    while($row=mysqli_fetch_assoc($result)){
        $stuID=$row['ID'];
        $findStudentInfo='SELECT * FROM student WHERE ID=?';
        $stmt1=mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt1,$findStudentInfo)){
            echo '<div class="errorBG"><span class="errorType1">Data Fetch failed!</span></div>';
        }
        mysqli_stmt_bind_param($stmt1,'i',$stuID);
        mysqli_stmt_execute($stmt1);
        $result1=mysqli_stmt_get_result($stmt1);
        if($row1=mysqli_fetch_assoc($result1)){
            echo '<tr>
            <td>
            <a class="buttonStyle1" style="padding: 5px 25px; margin: 10px; border-radius: 0; background-color: rgba(2,99,169,0.5);" href="instructorLoS.CRS.INS.php?courseID='.$courseID.'&year='.$yearCourse.'&semester='.$semester.'&studentID='.$stuID.'">'.$stuID.'</a>
            </td>
            <td>
            <a class="buttonStyle1" style="padding: 5px 25px; margin: 10px; border-radius: 0; background-color: rgba(2,99,169,0.5);" href="instructorLoS.CRS.INS.php?courseID='.$courseID.'&year='.$yearCourse.'&semester='.$semester.'&studentID='.$stuID.'">'.$row1['name'].'</a>
            </td>
            <td>
            <span class="tableText"><strong>'.$row1['dept_name'].'</strong></span>
            </td>
            </tr>';
        }
    }
}
if(!isset($_GET['courseID'],$_GET['year'],$_GET['semester'])){
    $insID=$_SESSION['instructor_id'];
    $findInsCourses= 'SELECT * FROM teaches where ID=?';
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$findInsCourses)){
        echo '<div class="errorBG"><span class="errorType1">Data Fetch failed!</span></div>';
    }
    mysqli_stmt_bind_param($stmt,'s',$insID);
    mysqli_stmt_execute($stmt);
    $result=mysqli_stmt_get_result($stmt);
    $rowCount=mysqli_num_rows($result);
    if(!$rowCount){
        echo '<div class="errorBG"><span class="errorType1">Internal Error</span></div>';
    }
    echo '<div class="tableContainer">';
    echo '<div class="tableText" style="color: white">List of Courses</div> <br/>';
    echo '<table>';
    echo '<tr><th class="tableText" style="padding-top: 10px">Course ID</th><th class="tableText" style="padding-top: 10px">Semester</th><th class="tableText" style="padding-top: 10px">Year</th></tr>';
    while($row=mysqli_fetch_assoc($result)){
        echo '<tr>
            <td>
            <a class="buttonStyle1" style="padding: 5px 25px; margin: 10px; border-radius: 0; background-color: rgba(2,99,169,0.5);" href="instructorLoS.CRS.INS.php?courseID='.$row['course_id'].'&year='.$row['year'].'&semester='.$row['semester'].'">'.$row['course_id'].'</a>
            </td>
            <td>
            <span class="tableText"><strong>'.$row['semester'].'</strong></span>
            </td>
            <td>
            <span class="tableText"><strong>'.$row['year'].'</strong></span>
            </td>
            </tr>';
    }
    echo '</table>';
}
?>
</body>
</html>
