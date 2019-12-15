<?php
if(isset($_POST['login'])){
    require 'dbCentralConnect.inc.php';
    $uid= $_POST['userName'];
    $password= $_POST['password'];
    $check= 1;
    if(empty($uid)&&empty($password)){                                                              // Error Checking Starts here
        header('Location: ../index.php?error=emptyFields');
        exit();
    }
    if(empty($password)){
        header('Location: ../index.php?error=passNotEntered&uid='.$uid);
        exit();
    }
    if (empty($uid)){
        header('Location: ../index.php?error=userNotEntered');
        exit();
    }                                                                                               // Error checks end here
    if($check){
        $sqlStr='SELECT * FROM login_Admin where member_name=? AND password=?;';
        $stmt=mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sqlStr)){
            header('Location: ../index.php?error=sqlError');
            exit();
        } else {
            mysqli_stmt_bind_param($stmt,'ss', $uid,$password);
            mysqli_stmt_execute($stmt);
            $result=mysqli_stmt_get_result($stmt);
            if($row=mysqli_fetch_assoc($result)) {
                session_start();
                $_SESSION['name'] = $row['Name'];
                $_SESSION['user_id'] = $row['member_id'];
                $_SESSION['userName'] = $row['member_name'];
                $_SESSION['type']='Admin';
                header('Location: ../');
                exit();
            } else  goto STUDENT;
        }
    }
    STUDENT:
    if($check){
        $sqlStr='select name, ID,member_name from student natural join login_Student where member_name=? AND password=?;';
        $stmt=mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sqlStr)){
            header('Location: ../index.php?error=sqlError');
            exit();
        } else {
            mysqli_stmt_bind_param($stmt,'ss', $uid,$password);
            mysqli_stmt_execute($stmt);
            $result=mysqli_stmt_get_result($stmt);
            if($row=mysqli_fetch_assoc($result)) {
                session_start();
                $_SESSION['student_id'] = $row['ID'];
                $_SESSION['name']=$row['name'];
                $_SESSION['userName'] = $row['member_name'];
                $_SESSION['type']='Student';
                header('Location: ../');
                exit();
            } else  goto INSTRUCTOR;
        }
    }
    INSTRUCTOR:
    if($check){
        $sqlStr='select name, ID,member_name from instructor natural join login_Instructor where member_name=? AND password=?;';
        $stmt=mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sqlStr)){
            header('Location: ../index.php?error=sqlError');
            exit();
        } else {
            mysqli_stmt_bind_param($stmt,'ss', $uid,$password);
            mysqli_stmt_execute($stmt);
            $result=mysqli_stmt_get_result($stmt);
            if($row=mysqli_fetch_assoc($result)) {
                session_start();
                $_SESSION['instructor_id'] = $row['ID'];
                $_SESSION['name']=$row['name'];
                $_SESSION['userName'] = $row['member_name'];
                $_SESSION['type']='Instructor';
                header('Location: ../');
                exit();
            } else {
                $check=0;
                header('Location: ../index.php?error=wrongUsrPass');
                exit();
            }
        }
    }
}else{
    header('Location: ../');
    exit();
}