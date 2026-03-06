<?php

class User {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create($username, $email, $password) {
        $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) return false;

        $stmt->bind_param("sss", $username, $email, $password);

        $ok = $stmt->execute();
        $stmt->close();

        return $ok;
    }

    public function findByEmail($email) {
        $sql = "SELECT id, username, email, password FROM users WHERE email = ? LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) return null;

        $stmt->bind_param("s", $email);
        $stmt->execute();

        $result = $stmt->get_result();
        $user = $result ? $result->fetch_assoc() : null;

        $stmt->close();
        return $user ?: null;
    }
}