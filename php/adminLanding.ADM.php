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
<head>
    <title>Administrator Control</title>
</head>
<body>
    <button onclick="location.href='../includes/logout.inc.php'" class="logoutBtn">Logout</button><br/>
    <div class="aHead1">
        <h1>Good
            <?php
            $dateTime = new DateTime('now');
            if($dateTime->format('H:i')>='06:00' && $dateTime->format('H:i')<='11:59') echo 'Morning';
            elseif($dateTime->format('H:i')>='12:00' && $dateTime->format('H:i')<='15:59') echo 'Afternoon';
            elseif($dateTime->format('H:i')>='16:00' && $dateTime->format('H:i')<='23:59') echo 'Evening';
            else echo 'Greetings';
            ?>, <span>
                <?php
                    echo $_SESSION['name'];
                ?></span>!<br/></h1>
    </div>
    <div class="BackBox">
        <button class="buttons">Switch to Full Menu</button>
    </div>
    <div class="BackBox">
        <button onclick="location.href='adminAddCourse.ADM.php'" class="buttons">Add New Course</button><br/>
        <button onclick="location.href='adminAddInstructor.ADM.php'" class="buttons">Add New Instructor</button><br/>
        <button onclick="location.href='adminAddStudent.ADM.php'" class="buttons">Add New Student</button><br/>
        <button onclick="location.href='adminAssignToInstructor.ADM.php'" class="buttons">Assign Courses to Instructor</button><br/>
        <button onclick="location.href='adminAssignToStudent.ADM.php'" class="buttons">Assign Courses to Student</button><br/>
    </div>
</body>
</html>