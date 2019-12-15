<?php
if(isset($_POST['clickChangeUser'])){
    session_start();
    require 'dbCentralConnect.inc.php';
    $resultCount=0;
    $newUser=$_POST['changeUserName'];
    $uri = $_SESSION['accountURI'];
    if(empty($newUser)){
        header('Location: ../php/'.$uri.'error=emptyField');
        exit();
    }
    /*  START:  Checking for existing username  */
    $sqlStrStu='SELECT member_name FROM login_Student WHERE member_name= BINARY ?';
    $sqlStrIns='SELECT member_name FROM login_Instructor WHERE member_name= BINARY ?';
    $sqlStrAdm='SELECT member_name FROM login_Admin WHERE member_name= BINARY ?';
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sqlStrStu)){
        header('Location: ../php/'.$uri.'error=queryField');
        exit();
    }
    mysqli_stmt_bind_param($stmt,'s',$newUser);
    mysqli_stmt_execute($stmt);
    $result=mysqli_stmt_get_result($stmt);
    $resultCount+=mysqli_num_rows($result);
    if(!mysqli_stmt_prepare($stmt,$sqlStrIns)){
        header('Location: ../php/'.$uri.'error=queryError');
        exit();
    }
    mysqli_stmt_bind_param($stmt,'s',$newUser);
    mysqli_stmt_execute($stmt);
    $result=mysqli_stmt_get_result($stmt);
    $resultCount+=mysqli_num_rows($result);
    if(!mysqli_stmt_prepare($stmt,$sqlStrAdm)){
        header('Location: ../php/'.$uri.'error=queryError');
        exit();
    }
    mysqli_stmt_bind_param($stmt,'s',$newUser);
    mysqli_stmt_execute($stmt);
    $result=mysqli_stmt_get_result($stmt);
    $resultCount+=mysqli_num_rows($result);
    if($resultCount){
        header('Location: ../php/'.$uri.'error=userExists');
        exit();
    }
    $loginType=$_SESSION['type'];
    if($loginType==='Student'){
        $currentUserName=$_SESSION['userName'];
        $password=$_POST['currentPassword'];
        //  START: Verify Password

        $checkPassQuery="SELECT * FROM `login_Student` WHERE `member_name`= BINARY ? AND `password`= BINARY ?";
        if(!mysqli_stmt_prepare($stmt,$checkPassQuery)){
            header('Location: ../php/studentAccount.CU.STU.php?error=queryError');
            exit();
        }
        mysqli_stmt_bind_param($stmt,'ss',$currentUserName,$password);
        mysqli_stmt_execute($stmt);
        $result=mysqli_stmt_get_result($stmt);
        if(!$row=mysqli_fetch_assoc($result)) {
            header('Location: ../php/studentAccount.CU.STU.php?error=wrongPass');
            exit();
        }
        //  END: Verify Password
        //  START: Update Username
        $studentStr='UPDATE `login_Student` SET `member_name`= ? WHERE `member_name` LIKE ?;';
        if(!mysqli_stmt_prepare($stmt,$studentStr)){
            header('Location: ../php/studentAccount.CU.STU.php?error=queryError');
            exit();
        }
        mysqli_stmt_bind_param($stmt,'ss',$newUser, $currentUserName);
        mysqli_stmt_execute($stmt);
        if(!mysqli_stmt_affected_rows($stmt)){
            header('Location: ../php/studentAccount.CU.STU.php?error=queryError');
            exit();
        }
        $_SESSION['userName']=$newUser;
        header('Location: ../php/studentAccount.STU.php?success=userNameUpdated');
        exit();

        //  END: Updating Username
    }
    if($loginType==='Instructor'){
        $currentUserName=$_SESSION['userName'];
        $password=$_POST['currentPassword'];
        //  START: Verify Password

        $checkPassQuery="SELECT * FROM `login_Instructor` WHERE `member_name`= BINARY ? AND `password`= BINARY ?";
        if(!mysqli_stmt_prepare($stmt,$checkPassQuery)){
            header('Location: ../php/instructorAccount.CU.INS.php?error=queryError');
            exit();
        }
        mysqli_stmt_bind_param($stmt,'ss',$currentUserName,$password);
        mysqli_stmt_execute($stmt);
        $result=mysqli_stmt_get_result($stmt);
        if(!$row=mysqli_fetch_assoc($result)) {
            header('Location: ../php/instructorAccount.CU.INS.php?error=wrongPass');
            exit();
        }
        //  END: Verify Password
        //  START: Update Username
        $studentStr='UPDATE `login_Instructor` SET `member_name`= ? WHERE `member_name` LIKE ?;';
        if(!mysqli_stmt_prepare($stmt,$studentStr)){
            header('Location: ../php/instructorAccount.CU.INS.php?error=queryError');
            exit();
        }
        mysqli_stmt_bind_param($stmt,'ss',$newUser, $currentUserName);
        mysqli_stmt_execute($stmt);
        if(!mysqli_stmt_affected_rows($stmt)){
            header('Location: ../php/instructorAccount.CU.INS.php?error=queryError');
            exit();
        }
        $_SESSION['userName']=$newUser;
        header('Location: ../php/instructorAccount.INS.php?success=userNameUpdated');
        exit();
    }
    if($loginType==='Admin'){
//        Here goes code
    }

    /*  END:    Check Login Type    */
}else{
    header('Location: ../');
    exit();
}