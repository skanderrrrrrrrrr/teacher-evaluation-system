<?php
session_start();
require "db.php";

if (empty($_POST['registration_no']) || empty($_POST['password'])) {
    die("Veuillez remplir tous les champs.");
}

$reg = $_POST['registration_no'];
$pass = $_POST['password'];

/*البحث في جدول الطلاب */
$stmt = $pdo->prepare("SELECT * FROM students WHERE registration_no=?");
$stmt->execute([$reg]);
$student = $stmt->fetch();

if ($student && password_verify($pass, $student['password'])) {
    $_SESSION['role'] = "student";
    $_SESSION['student_reg_no'] = $student['registration_no'];
    $_SESSION['student_name'] = $student['full_name'];

    header("Location: evaluation_page.php");
    exit;
}

/* البحث في جدول الأساتذة*/
$stmt = $pdo->prepare("SELECT * FROM teachers WHERE registration_no=?");
$stmt->execute([$reg]);
$teacher = $stmt->fetch();

if ($teacher && password_verify($pass, $teacher['password'])) {
    $_SESSION['role'] = "teacher";
    $_SESSION['teacher_reg_no'] = $teacher['registration_no'];
    $_SESSION['teacher_name'] = $teacher['full_name'];

    header("Location: teacher_dashboard.php");
    exit;
}

/* البحث في جدول الإدارة */
$stmt = $pdo->prepare("SELECT * FROM admins WHERE registration_no=?");
$stmt->execute([$reg]);
$admin = $stmt->fetch();

if ($admin && password_verify($pass, $admin['password'])) {
    $_SESSION['role'] = "admin";
    $_SESSION['admin_reg_no'] = $admin['registration_no'];
    $_SESSION['admin_name'] = $admin['full_name'];

    header("Location: ranking.php"); 
    exit;
}

$_SESSION['error'] = true;
header("Location: First_login.php");
exit;
