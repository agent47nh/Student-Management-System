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
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="../stylesheets/instructor.css">
<head>
    <title>Instructor Information</title>
</head>
<body>
<button class="logoutBtn" onclick="location.href='../includes/logout.inc.php'">Logout</button><br/>
<div class="aHead1">
    <h1>Good <?php
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
    <button class="buttons" onclick="location.href='instructorAssignedCourses.INS.php'">Assigned Courses</button><br/>
    <button class="buttons" onclick="location.href='instructorLoS.INS.php'">List of Students</button><br/>
    <button class="buttons" onclick="location.href='instructorAccount.INS.php'">Account Settings</button><br/>
</div>
</body>
</html>