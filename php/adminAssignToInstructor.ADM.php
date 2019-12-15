<?php
session_start();
///     Reserved Code START
if(!isset($_SESSION['type'])){
    header('Location: ../');
    exit();
}else{
    if($_SESSION['type']!=='Admin'){
        header('Location: ../');
        exit();
    }
}
///     Reserved Code END
?>
<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="../stylesheets/admin.css">
<link rel="stylesheet" type="text/css" href="../stylesheets/adminAC.css">
<link rel="stylesheet" type="text/css" href="../stylesheets/ErrorBoxes.css">
<head>
    <title>Assign Course</title>
</head>
<body>
<div class="leftButton" style="display: inline">
    <button class="backBtn" onclick="location.href='adminLanding.ADM.php'">Back</button>
</div>
<div class="rightButton" style="display: inline; float: right;">
    <button class="logoutBtn" onclick="location.href='../includes/logout.inc.php'">Logout</button>
</div>
<div class="aHead1" style="background-color: rgba(0,0,0,.7)">
    <h1>Assign Course to Instructor</h1>
</div>

<?php
if(isset($_GET['error'])){
    if($_GET['error']==='selectionNotDone'){
        echo '<div class="errorBG"><span class="errorType1"><strong>Error: </strong>Make sure all selections are made</span></div>';
    }
    if($_GET['error']==='internalMess'){
        echo '<div class="errorBG"><span class="errorType1"><strong>Internal Error: </strong>Contact the Webmaster. We are sorry for the inconvenience caused!</span></div>';
    }
    if($_GET['error']==='alreadyAssigned'){
        echo '<div class="errorBG"><span class="errorType1"><strong>Error: </strong>This course has been already assigned to Instructor</span></div>';
    }
}
if(isset($_GET['success'])&&$_GET['success']==='courseAssigned'){
    echo '<div class="errorBG""><span class="errorType1" style="background-color: rgba(67,160,71,1)"><strong>Success: </strong>The course has been successfully assigned to Instructor</span></div>';
}
?>
<div class="BackBox" style="text-align: left;background-color: rgba(0,0,0,.7);">
    <form method="POST" action="../includes/addDataFunction.inc.php">
        <label for="courseIDDropDown">Course ID: </label>
        <select class="dropDown" name="courseIDDropdown">
            <option>None</option>
            <?php
            require '../includes/dbCentralConnect.inc.php';
            $findAllCourses='SELECT DISTINCT course_id FROM section;';
            $stmt=mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt,$findAllCourses)){
                echo '<div class="errorBG">';
                echo '<span class="errorType1">Information fetch failed!</span>';
                echo '<span class="errorType1"> Contact the Webmaster</span>';
                echo '</div>';
            }
            mysqli_stmt_execute($stmt);
            $result=mysqli_stmt_get_result($stmt);
            while ($row=mysqli_fetch_assoc($result)){
                echo '<option>'.$row['course_id'].'</option>';
            }
            ?>
        </select>
        <label for="sectionIDDropDown">Section ID: </label>
        <select class="dropDown" name="sectionIDDropDown">
            <option>None</option>
            <?php
            require '../includes/dbCentralConnect.inc.php';
            $findAllSection='SELECT DISTINCT sec_id FROM section;';
            $stmt=mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt,$findAllSection)){
                echo '<div class="errorBG">';
                echo '<span class="errorType1">Information fetch failed!</span>';
                echo '<span class="errorType1"> Contact the Webmaster</span>';
                echo '</div>';
            }
            mysqli_stmt_execute($stmt);
            $result=mysqli_stmt_get_result($stmt);
            while ($row=mysqli_fetch_assoc($result)){
                echo '<option>'.$row['sec_id'].'</option>';
            }
            ?>
        </select><br/><br/>
        <label for="semesterDropDown">Semester: </label>
        <select class="dropDown" name="semesterDropDown">
            <option>None</option>
            <?php
            require '../includes/dbCentralConnect.inc.php';
            $findAllSemester='SELECT DISTINCT semester FROM section;';
            $stmt=mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt,$findAllSemester)){
                echo '<div class="errorBG">';
                echo '<span class="errorType1">Information fetch failed!</span>';
                echo '<span class="errorType1"> Contact the Webmaster</span>';
                echo '</div>';
            }
            mysqli_stmt_execute($stmt);
            $result=mysqli_stmt_get_result($stmt);
            while ($row=mysqli_fetch_assoc($result)){
                echo '<option>'.$row['semester'].'</option>';
            }
            ?>
        </select>
        <label for="yearDropDown">Year: </label>
        <select class="dropDown" name="yearDropDown">
            <option>None</option>
            <?php
            require '../includes/dbCentralConnect.inc.php';
            $findAllYears='SELECT DISTINCT year FROM section;';
            $stmt=mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt,$findAllYears)){
                echo '<div class="errorBG">';
                echo '<span class="errorType1">Information fetch failed!</span>';
                echo '<span class="errorType1"> Contact the Webmaster</span>';
                echo '</div>';
            }
            mysqli_stmt_execute($stmt);
            $result=mysqli_stmt_get_result($stmt);
            while ($row=mysqli_fetch_assoc($result)){
                echo '<option>'.$row['year'].'</option>';
            }
            ?>
        </select><br/><br/>
        <label for="instructorDropDown">Instructor ID: </label>
        <select class="dropDown" name="instructorDropDown">
            <option>None</option>
            <?php
            require '../includes/dbCentralConnect.inc.php';
            $findAllInstructor='SELECT ID,name FROM instructor;';
            $stmt=mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt,$findAllInstructor)){
                echo '<div class="errorBG">';
                echo '<span class="errorType1">Information fetch failed!</span>';
                echo '<span class="errorType1"> Contact the Webmaster</span>';
                echo '</div>';
            }
            mysqli_stmt_execute($stmt);
            $result=mysqli_stmt_get_result($stmt);
            while ($row=mysqli_fetch_assoc($result)){
                echo '<option value="'.$row['ID'].'">'.$row['ID'].' - '.$row['name'].'</option>';
            }
            ?>
        </select><br/><br/>
        <button class="buttons" style="margin-left: 50px" name="assignCourseToInstructor" type="submit">Assign to Instructor</button><br/>
        <button class="buttons" style="background-color: rgba(127,0,0,1);margin-left: 50px" type="reset">Reset</button>
    </form>
</div>
<div class="errorBG"><span class="errorType1"><strong>Warning: </strong>Confirm the details before clicking 'Assign to Instructor'</span></div>
</body>
</html>