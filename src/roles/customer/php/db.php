<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "waste360";

// Establish connection
$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die(json_encode(["status" => "error", "message" => "Database connection failed: " . $conn->connect_error]));
}

// Check POST data
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"] ?? null;
    $password = $_POST["password"] ?? null;

    if (!$username || !$password) {
        echo json_encode(["status" => "error", "message" => "Invalid input data"]);
        exit();
    }

    // Example query to insert user
    $stmt = $conn->prepare("INSERT INTO Registered (username, password, created_date) VALUES (?, ?, NOW())");
    if ($stmt) {
        $stmt->bind_param("ss", $username, $password);
        if ($stmt->execute()) {
            echo json_encode(["status" => "success", "message" => "Account created successfully"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Error: " . $stmt->error]);
        }
        $stmt->close();
    } else {
        echo json_encode(["status" => "error", "message" => "Prepared statement error: " . $conn->error]);
    }
}
$conn->close();
