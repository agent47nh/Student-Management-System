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
    <title>Add Course</title>
</head>
<body>
<div class="leftButton" style="display: inline">
    <button class="backBtn" onclick="location.href='adminLanding.ADM.php'">Back</button>
</div>
<div class="rightButton" style="display: inline; float: right;">
    <button class="logoutBtn" onclick="location.href='../includes/logout.inc.php'">Logout</button>
</div>
<div class="aHead1" style="background-color: rgba(0,0,0,.7)">
    <h1>Add Course</h1>
</div>
<?php
if(isset($_GET['error'])){
    if($_GET['error']==='emptyField'){
        echo '<div class="errorBG"><span class="errorType1"><strong>Error: </strong>One of the fields are empty</span></div>';
    }
    if($_GET['error']==='deptNotSelected'){
        echo '<div class="errorBG"><span class="errorType1"><strong>Error: </strong>Select a department</span></div>';
    }
    if($_GET['error']==='creditNotSelected'){
        echo '<div class="errorBG"><span class="errorType1"><strong>Error: </strong>Select number of credits</span></div>';
    }
    if($_GET['error']==='internalMess'){
        echo '<div class="errorBG"><span class="errorType1"><strong>Internal Error: </strong>Contact the Webmaster. We are sorry for the inconvenience caused!</span></div>';
    }
    if($_GET['error']==='courseExists'){
        echo '<div class="errorBG"><span class="errorType1"><strong>Error: </strong>Course already exists</span></div>';
    }
}
if(isset($_GET['success'])&&$_GET['success']==='courseAdded'){
        echo '<div class="errorBG""><span class="errorType1" style="background-color: rgba(67,160,71,1)"><strong>Success: </strong>Course has been added to the database</span></div>';
}
?>
<div class="BackBox" style="text-align: left;background-color: rgba(0,0,0,.7);">
    <form method="POST" action="../includes/addDataFunction.inc.php">
        <label for="courseID">Course ID: </label><br/>
        <input class="inputBox" type="text" name="courseID" placeholder="Example: XXX-XXX or XX-XXX" style="text-transform: uppercase"><br/><br/>
        <label for="dept_nameDropdown">Select Department: &nbsp</label>
        <select class="dropDown" name="dept_nameDropdown">
            <option>None</option>
            <?php
                require '../includes/dbCentralConnect.inc.php';
                $getDept='SELECT dept_name FROM department;';
                $stmt=mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt,$getDept)){
                    echo '<div class="errorBG">';
                    echo '<span class="errorType1">Student Information fetch failed!</span>';
                    echo '<span class="errorType1"> Contact the Webmaster</span>';
                    echo '</div>';
                }
                mysqli_stmt_execute($stmt);
                $result=mysqli_stmt_get_result($stmt);
                while ($row=mysqli_fetch_assoc($result)){
                    echo '<option>'.$row['dept_name'].'</option>';
                }
            ?>
        </select><br/><br/>
        <label for="courseTitle">Course Title: </label><br/>
        <input class="inputBox" type="text" name="courseTitle" placeholder="Course Title" style="text-transform: capitalize"><br/><br/>
        <label for="courseCredit">Course Credits: &nbsp</label>
        <select class="dropDown" name="courseCredit">
            <option>None</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
            <option>6</option>
        </select><br/><br/>
        <button class="buttons" name="addCourse" type="submit">Add Course</button><br/>
        <button class="buttons" type="reset" style="background-color: rgba(127,0,0,1);">Reset</button>
    </form>
</div>
<div class="errorBG"><span class="errorType1"><strong>Warning: </strong>Confirm the details before clicking 'Add Course'</span></div>
</body>
</html>