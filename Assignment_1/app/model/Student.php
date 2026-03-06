<?php

class Student {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function readAll() {
        $sql = "SELECT id, student_id, name, email FROM students ORDER BY id DESC";
        $result = $this->conn->query($sql);

        $students = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $students[] = $row;
            }
        }

        return $students;
    }

    public function create($studentId, $name, $email) {
        $sql = "INSERT INTO students (student_id, name, email) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) return false;

        $stmt->bind_param("sss", $studentId, $name, $email);

        $ok = $stmt->execute();
        $stmt->close();

        return $ok;
    }

    public function deleteById($id) {
        $sql = "DELETE FROM students WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) return false;

        $stmt->bind_param("i", $id);

        $ok = $stmt->execute();
        $stmt->close();

        return $ok;
    }
}