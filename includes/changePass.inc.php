<?php
if(isset($_POST['clickChangePass'])){
    require '../includes/dbCentralConnect.inc.php';
    session_start();
    $loginType=$_SESSION['type'];
    $userName=$_SESSION['userName'];
    $oldPassword=$_POST['oldPassword'];
    $newPassword=$_POST['newPassword'];
    $newRePassword=$_POST['newRePassword'];
    $uri = $_SESSION['accountURI1'];
    if(empty($oldPassword)||empty($newPassword)||empty($newRePassword)){
        header('Location: ../php/'.$uri.'error=fieldEmpty');
        exit();
    }
    if($newPassword!==$newRePassword){
        header('Location: ../php/'.$uri.'error=passNoMatch');
        exit();
    }
    if($loginType==='Student'){
        $changePassQuery='UPDATE `login_Student` SET `password`= BINARY ? WHERE `member_name` LIKE BINARY ? AND `password` LIKE BINARY ?;';
        $stmt=mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$changePassQuery)){
            header('Location: ../php/studentAccount.CP.STU.php?error=queryError');
            exit();
        }
        mysqli_stmt_bind_param($stmt,'sss',$newPassword,$userName,$oldPassword);
        mysqli_stmt_execute($stmt);
        if(!mysqli_stmt_affected_rows($stmt)){
            header('Location: ../php/studentAccount.CP.STU.php?error=wrongPass');
            exit();
        }
        header('Location: ../php/studentAccount.STU.php?success=passwordUpdated');
        exit();
    }
    if($loginType==='Instructor'){
        $changePassQuery='UPDATE `login_Instructor` SET `password`= BINARY ? WHERE `member_name` LIKE BINARY ? AND `password` LIKE BINARY ?;';
        $stmt=mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$changePassQuery)){
            header('Location: ../php/instructorAccount.CP.INS.php?error=queryError');
            exit();
        }
        mysqli_stmt_bind_param($stmt,'sss',$newPassword,$userName,$oldPassword);
        mysqli_stmt_execute($stmt);
        if(!mysqli_stmt_affected_rows($stmt)){
            header('Location: ../php/instructorAccount.CP.INS.php?error=wrongPass');
            exit();
        }
        header('Location: ../php/instructorAccount.INS.php?success=passwordUpdated');
        exit();
    }
}else{
    header('Location: ../');
    exit();
}