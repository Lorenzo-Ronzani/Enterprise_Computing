<?php
session_start();

require_once __DIR__ . "/../app/controllers/AuthController.php";
require_once __DIR__ . "/../app/controllers/StudentController.php";

$authController = new AuthController();
$studentController = new StudentController();


$page = $_GET["page"] ?? "students";


// POST ROUTES 
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // AUTH
    if (isset($_POST["register_user"])) {
        $authController->register($_POST);
    } 
    else if (isset($_POST["login_user"])) {
        $authController->login($_POST);
    } 
    else if (isset($_POST["logout_user"])) {
        $authController->logout();
    }

    // STUDENTS
    else if (isset($_POST["add_student"])) {
        $studentController->store($_POST);
    } 
    else if (isset($_POST["delete_student"])) {
        $studentController->delete($_POST["id"] ?? null);
    }
    header("Location: " . $_SERVER["PHP_SELF"]);
    exit;
}

$publicPages = ["login", "register"];
if (!isset($_SESSION["user_id"]) && !in_array($page, $publicPages)) {
    $page = "login";
}

if ($page === "login") {
    $authController->showLogin();
    exit;
}

if ($page === "register") {
    $authController->showRegister();
    exit;
}

if ($page === "students") {
    $studentController->index();
    exit;
}

if ($page === "students_create") {
    $studentController->create();
    exit;
}

http_response_code(404);
echo "404 - Page not found";