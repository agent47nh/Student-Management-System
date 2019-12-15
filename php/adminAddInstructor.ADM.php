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
    <title>Add Instructor</title>
</head>
<body>
<div class="leftButton" style="display: inline">
    <button class="backBtn" onclick="location.href='adminLanding.ADM.php'">Back</button>
</div>
<div class="rightButton" style="display: inline; float: right;">
    <button class="logoutBtn" onclick="location.href='../includes/logout.inc.php'">Logout</button>
</div>
<div class="aHead1" style="background-color: rgba(0,0,0,.7)">
    <h1>Add Instructor</h1>
</div>
<?php
    if(isset($_GET['error'])){
        if($_GET['error']==='emptyField'){
            echo '<div class="errorBG"><span class="errorType1"><strong>Error: </strong>One of the fields are empty</span></div>';
        }
        if($_GET['error']==='deptNotSelected'){
            echo '<div class="errorBG"><span class="errorType1"><strong>Error: </strong>Select a department</span></div>';
        }
        if($_GET['error']==='internalMess'){
            echo '<div class="errorBG"><span class="errorType1"><strong>Internal Error: </strong>Contact the Webmaster. We are sorry for the inconvenience caused!</span></div>';
        }
        if($_GET['error']==='instructorExists'){
            echo '<div class="errorBG"><span class="errorType1"><strong>Error: </strong>Instructor already exists!</span></div>';
        }
    }
    if(isset($_GET['success'])&&$_GET['success']==='instructorAdded'){
        echo '<div class="errorBG""><span class="errorType1" style="background-color: rgba(67,160,71,1)"><strong>Success: </strong>The Instructor has been successfully registered</span></div>';
    }
?>
<div class="BackBox" style="text-align: left;background-color: rgba(0,0,0,.7);">
    <form method="POST" action="../includes/addDataFunction.inc.php">
        <label for="instructorID">Instructor ID: </label><br/>
        <input class="inputBox" type="number" name="instructorID" placeholder="Instructor ID"><br/><br/>
        <label for="dept_nameDropdown">Select Department: &nbsp</label>
        <select class="dropDown" name="dept_nameDropdown">
            <option>None</option>
            <?php
            require '../includes/dbCentralConnect.inc.php';
            $getDept='SELECT dept_name FROM department;';
            $stmt=mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt,$getDept)){
                echo '<div class="errorBG">';
                echo '<span class="errorType1">Information fetch failed!</span>';
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
        <label for="instructorName">Instructor Name: </label><br/>
        <input class="inputBox" type="text" name="instructorName" placeholder="Instructor Name" style="text-transform: capitalize"><br/><br/>
        <label for="salaryInstructor">Instructor Salary: &nbsp</label><br/>
        <input class="inputBox" type="number" name="salaryInstructor" placeholder="Salary in US Dollars"><br/><br/>
        <button class="buttons" name="addInstructor" type="submit">Add Instructor</button><br/>
        <button class="buttons" type="reset" style="background-color: rgba(127,0,0,1);">Reset</button>
    </form>
</div>
<div class="errorBG"><span class="errorType1"><strong>Warning: </strong>Confirm the details before clicking 'Add Instructor'</span></div>
</body>
</html>