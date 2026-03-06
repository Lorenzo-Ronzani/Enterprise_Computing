<?php
require_once __DIR__ . "/../config/Database.php";
require_once __DIR__ . "/../model/Student.php";

class StudentController {
    private $studentModel;

    public function __construct() {
        $database = new Database();
        $db = $database->connect();
        $this->studentModel = new Student($db);
    }

    private function checkAuth() {
        if (!isset($_SESSION["user_id"])) {
            $_SESSION["message"] = "Please login first.";
            header("Location: " . $_SERVER["PHP_SELF"] . "?page=login");
            exit;
        }
    }

    public function index() {
        $this->checkAuth();
        $students = $this->studentModel->readAll();
        include __DIR__ . "/../view/students/StudentListView.php";
    }

    public function create() {
        $this->checkAuth();
        include __DIR__ . "/../view/students/StudentCreateView.php";
    }

    public function store($data) {
        $this->checkAuth();

        $studentId = trim($data["student_id"] ?? "");
        $name = trim($data["name"] ?? "");
        $email = trim($data["email"] ?? "");

        if ($studentId === "" || $name === "" || $email === "") {
            $_SESSION["message"] = "All fields are required.";
            header("Location: " . $_SERVER["PHP_SELF"] . "?page=students_create");
            exit;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION["message"] = "Invalid email format.";
            header("Location: " . $_SERVER["PHP_SELF"] . "?page=students_create");
            exit;
        }

        $ok = $this->studentModel->create($studentId, $name, $email);

        $_SESSION["message"] = $ok ? "Student created!" : "Failed to create student (maybe duplicate student_id).";
        header("Location: " . $_SERVER["PHP_SELF"] . "?page=students");
        exit;
    }

    public function delete($id) {
        $this->checkAuth();

        if (!$id) {
            $_SESSION["message"] = "Invalid student id.";
            header("Location: " . $_SERVER["PHP_SELF"] . "?page=students");
            exit;
        }

        $ok = $this->studentModel->deleteById((int)$id);

        $_SESSION["message"] = $ok ? "Student deleted!" : "Failed to delete student.";
        header("Location: " . $_SERVER["PHP_SELF"] . "?page=students");
        exit;
    }
}