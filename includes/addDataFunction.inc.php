<?php
if(isset($_POST['addCourse'])){
    require 'dbCentralConnect.inc.php';
    $courseID=strtoupper($_POST['courseID']);
    $deptName=$_POST['dept_nameDropdown'];
    $courseTitle=ucwords($_POST['courseTitle']);
    $courseCredit=$_POST['courseCredit'];
    if(empty($courseID)||empty($courseTitle)){
        header('Location: ../php/adminAddCourse.ADM.php?error=emptyField');
        exit();
    }
    if($deptName==='None'){
        header('Location: ../php/adminAddCourse.ADM.php?error=deptNotSelected');
        exit();
    }
    if($courseCredit==='None'){
        header('Location: ../php/adminAddCourse.ADM.php?error=creditNotSelected');
        exit();
    }
    $insertCourse='INSERT INTO course VALUES (?,?,?,?)';
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$insertCourse)){
        header('Location: ../php/adminAddCourse.ADM.php?error=internalMess');
        exit();
    }
    mysqli_stmt_bind_param($stmt,'sssi', $courseID,$courseTitle,$deptName,$courseCredit);
    $result=mysqli_stmt_execute($stmt);
    if(mysqli_errno($conn)===1062){
        header('Location: ../php/adminAddCourse.ADM.php?error=courseExists');
        exit();
    }
    if(!$result){
        header('Location: ../php/adminAddCourse.ADM.php?error=internalMess');
        exit();
    }
    header('Location: ../php/adminAddCourse.ADM.php?success=courseAdded');
    exit();
}

//      START:  Add Instructor

if(isset($_POST['addInstructor'])){
    require '../includes/dbCentralConnect.inc.php';
    $instructorID=$_POST['instructorID'];
    $instructorDept=$_POST['dept_nameDropdown'];
    $instructorName=ucwords($_POST['instructorName']);
    $instructorSalary=$_POST['salaryInstructor'];
    if(empty($instructorID)||empty($instructorName)||empty($instructorSalary)){
        header('Location: ../php/adminAddInstructor.ADM.php?error=emptyField');
        exit();
    }
    if($instructorDept==='None'){
        header('Location: ../php/adminAddInstructor.ADM.php?error=deptNotSelected');
        exit();
    }
    $insertInstructor='INSERT INTO instructor VALUES (?,?,?,?)';
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$insertInstructor)){
        header('Location: ../php/adminAddInstructor.ADM.php?error=internalMess');
        exit();
    }
    mysqli_stmt_bind_param($stmt,'issi',$instructorID,$instructorName,$instructorDept,$instructorSalary);
    $result=mysqli_stmt_execute($stmt);
    if(mysqli_errno($conn)===1062){
        header('Location: ../php/adminAddInstructor.ADM.php?error=instructorExists');
        exit();
    }
    if(!$result){
        header('Location: ../php/adminAddInstructor.ADM.php?error=internalMess');
        exit();
    }
    header('Location: ../php/adminAddInstructor.ADM.php?success=instructorAdded');
    exit();
}

//      END:  Add Instructor

//      START:  Add Student

if(isset($_POST['addStudent'])){
    require '../includes/dbCentralConnect.inc.php';
    $studentID=$_POST['studentID'];
    $studentDept=$_POST['dept_nameDropdown'];
    $studentName=ucwords($_POST['studentName']);
    $studentCGPA=$_POST['studentCGPA'];
    if(empty($studentID)||empty($studentName)){
        header('Location: ../php/adminAddStudent.ADM.php?error=emptyField');
        exit();
    }
    if(empty($studentCGPA)){
        $studentCGPA=NULL;
    }
    if($studentDept==='None'){
        header('Location: ../php/adminAddStudent.ADM.php?error=deptNotSelected');
        exit();
    }
    $insertInstructor='INSERT INTO student VALUES (?,?,?,?)';
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$insertInstructor)){
        header('Location: ../php/adminAddStudent.ADM.php?error=internalMess');
        exit();
    }
    mysqli_stmt_bind_param($stmt,'issi',$studentID,$studentName,$studentDept,$studentCGPA);
    $result=mysqli_stmt_execute($stmt);
    if(mysqli_errno($conn)===1062){
        header('Location: ../php/adminAddStudent.ADM.php?error=studentExists');
        exit();
    }
    if(!$result){
        header('Location: ../php/adminAddStudent.ADM.php?error=internalMess');
        exit();
    }
    header('Location: ../php/adminAddStudent.ADM.php?success=studentAdded');
    exit();
}

//      END:    Add Student

//      START:  Assign to Instructor

if(isset($_POST['assignCourseToInstructor'])){
    require 'dbCentralConnect.inc.php';
    $courseID=$_POST['courseIDDropdown'];
    $sectionID=$_POST['sectionIDDropDown'];
    $semester=$_POST['semesterDropDown'];
    $year=$_POST['yearDropDown'];
    $instructorID=$_POST['instructorDropDown'];
    if($courseID==='None'||$sectionID==='None'||$semester==='None'||$year==='None'||$instructorID==='None'){
        header('Location: ../php/adminAssignToInstructor.ADM.php?error=selectionNotDone');
        exit();
    }
    $insertTeaches='INSERT INTO teaches VALUES (?,?,?,?,?);';
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$insertTeaches)){
        header('Location: ../php/adminAssignToInstructor.ADM.php?error=internalMess');
        exit();
    }
    mysqli_stmt_bind_param($stmt,'isisi',$instructorID,$courseID,$sectionID,$semester,$year);
    $result=mysqli_stmt_execute($stmt);
    if(mysqli_errno($conn)===1062){
        header('Location: ../php/adminAssignToInstructor.ADM.php?error=alreadyAssigned');
        exit();
    }
    if(!$result){
        header('Location: ../php/adminAssignToInstructor.ADM.php?error=internalMess');
        exit();
    }
    header('Location: ../php/adminAssignToInstructor.ADM.php?success=courseAssigned');
    exit();
}

$courseGrade=strtoupper($_POST['courseGrade']);
//      END:    Assign to Instructor

if(isset($_POST['assignCourseToStudent'])){
    require 'dbCentralConnect.inc.php';
    $courseID=$_POST['courseIDDropdown'];
    $sectionID=$_POST['sectionIDDropDown'];
    $semester=$_POST['semesterDropDown'];
    $year=$_POST['yearDropDown'];
    $courseGrade=strtoupper($_POST['courseGrade']);
    $studentID=$_POST['studentDropDown'];
    if($courseID==='None'||$sectionID==='None'||$semester==='None'||$year==='None'||$studentID==='None'){
        header('Location: ../php/adminAssignToStudent.ADM.php?error=selectionNotDone');
        exit();
    }
    if($courseGrade===''){
        $courseGrade=NULL;
    }
    $insertTeaches='INSERT INTO teaches VALUES (?,?,?,?,?);';
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$insertTeaches)){
        header('Location: ../php/adminAssignToStudent.ADM.php?error=internalMess');
        exit();
    }
    mysqli_stmt_bind_param($stmt,'isisi',$instructorID,$courseID,$sectionID,$semester,$year);
    $result=mysqli_stmt_execute($stmt);
    if(mysqli_errno($conn)===1062){
        header('Location: ../php/adminAssignToInstructor.ADM.php?error=alreadyAssigned');
        exit();
    }
    if(!$result){
        header('Location: ../php/adminAssignToInstructor.ADM.php?error=internalMess');
        exit();
    }
    header('Location: ../php/adminAssignToInstructor.ADM.php?success=courseAssigned');
    exit();
}

//      START:  Assign to Student



header('Location: ../');
exit();