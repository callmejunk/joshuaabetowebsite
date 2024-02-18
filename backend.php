<?php
include('conn.php');

if (isset($_POST['add'])) {
    $id = $_POST['uID'];
    $first = $_POST['first'];
    $last = $_POST['last'];
    $course = $_POST['course'];
    $section = $_POST['section'];

    $insertData = $conn->prepare("INSERT INTO records(user_id, FirstName, LastName, Course, Section) VALUES(?, ?, ?, ?, ?)");
    $insertData->execute([$id, $first, $last, $course, $section]);

    header("Location: index.php");
    exit();



    // Logout
    if (isset($_GET['logout'])) {
        session_start();
        unset($_SESSION['logged_in']);
        unset($_SESSION['u_id']);

        header('Location: welcome.php');
    }
}

//Register
if (isset($_POST['register'])) {
    $fName = $_POST['fName'];
    $lName = $_POST['lName'];
    $email = $_POST['email'];
    $pass1 = $_POST['p1'];
    $pass2 = $_POST['p2'];

    if ($pass1 == $pass2) {
        $hash = password_hash($pass1, PASSWORD_DEFAULT);

        $insertUser = $conn->prepare("INSERT INTO users(First,Last,Email,Pass) VALUES(?,?,?,?)");
        $insertUser->execute([
            $fName,
            $lName,
            $email,
            $hash

        ]);

        header('Location:login.php');
        exit();
    } else {
        header('Location:register.php');
    }
}

// logout
if (isset($_GET['logout'])) {
    session_start();
    unset($_SESSION['logged_in']);
    unset($_SESSION['u_id']);

    header('Location: index.php');
}

// update data
if (isset($_POST['update'])) {
    $sID = $_POST['sID'];
    $first = $_POST['first'];
    $last = $_POST['last'];
    $course = $_POST['course'];
    $section = $_POST['section'];

    $updateList = $conn->prepare("UPDATE records SET FirstName=?, LastName=?, Course=?, Section=? WHERE student_id=?");
    $updateList->execute([$first, $last, $course, $section, $sID]);

    $msg = 'Successfully Updated!';
    header("Location: index.php?msg=$msg");
    exit();
}

// Update Profile
if (isset($_POST['editprof'])) {
    $uID = $_POST['uID'];
    $fName = $_POST['fName'];
    $lName = $_POST['lName'];
    $email = $_POST['email'];
    $pass1 = $_POST['p1'];
    $pass2 = $_POST['p2'];

    if ($pass1 == $pass2) {
        $hash = password_hash($pass1, PASSWORD_DEFAULT);

        $updateUser = $conn->prepare("UPDATE users SET First=?, Last=?, Email=?, Pass=?  WHERE user_id=?");
        $updateUser->execute([
            $fName,
            $lName,
            $email,
            $hash,
            $uID

        ]);

        header('Location:index.php');
        exit();
    } else {
        header('Location:editprof.php');
    }
}

// delete data from items
if (isset($_GET['delete'])) {
    $id = $_GET['id'];

    $delete = $conn->prepare("DELETE FROM records WHERE student_id=?");
    $delete->execute([$id]);

    header("Location: index.php");
    exit();
}