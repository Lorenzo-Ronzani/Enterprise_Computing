<?php
require_once __DIR__ . "/../config/Database.php";
require_once __DIR__ . "/../model/User.php";

class AuthController {
    private $userModel;

    public function __construct() {
        $database = new Database();
        $db = $database->connect();
        $this->userModel = new User($db);
    }

    public function showLogin() {
        include __DIR__ . "/../view/auth/LoginView.php";
    }

    public function showRegister() {
        include __DIR__ . "/../view/auth/RegisterView.php";
    }

    public function register($data) {
        $username = trim($data["username"] ?? "");
        $email = trim($data["email"] ?? "");
        $password = $data["password"] ?? "";

        if ($username === "" || $email === "" || $password === "") {
            $_SESSION["message"] = "All fields are required.";
            header("Location: " . $_SERVER["PHP_SELF"] . "?page=register");
            exit;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION["message"] = "Invalid email format.";
            header("Location: " . $_SERVER["PHP_SELF"] . "?page=register");
            exit;
        }

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $created = $this->userModel->create($username, $email, $passwordHash);

        if ($created) {
            $_SESSION["message"] = "Account created! Please login.";
            header("Location: " . $_SERVER["PHP_SELF"] . "?page=login");
            exit;
        }

        $_SESSION["message"] = "Failed to register. Email may already exist.";
        header("Location: " . $_SERVER["PHP_SELF"] . "?page=register");
        exit;
    }

    public function login($data) {
        $email = trim($data["email"] ?? "");
        $password = $data["password"] ?? "";

        if ($email === "" || $password === "") {
            $_SESSION["message"] = "Email and password are required.";
            header("Location: " . $_SERVER["PHP_SELF"] . "?page=login");
            exit;
        }

        $user = $this->userModel->findByEmail($email);

        if (!$user) {
            $_SESSION["message"] = "Invalid credentials.";
            header("Location: " . $_SERVER["PHP_SELF"] . "?page=login");
            exit;
        }

        if (!password_verify($password, $user["password"])) {
            $_SESSION["message"] = "Invalid credentials.";
            header("Location: " . $_SERVER["PHP_SELF"] . "?page=login");
            exit;
        }

        // Login 
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["username"] = $user["username"];

        header("Location: " . $_SERVER["PHP_SELF"] . "?page=students");
        exit;
    }

    public function logout() {
        session_unset();
        session_destroy();

        session_start();
        $_SESSION["message"] = "Logged out.";

        header("Location: " . $_SERVER["PHP_SELF"] . "?page=login");
        exit;
    }
}