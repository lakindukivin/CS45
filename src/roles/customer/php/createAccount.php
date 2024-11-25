<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    if ($password !== $confirmPassword) {
        echo json_encode(["status" => "error", "message" => "Passwords do not match"]);
        exit;
    }

    // Hash the password for security
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Insert customer data into Customer table
    $customerSql = "INSERT INTO Customer (customer_name, customer_contact, customer_address) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($customerSql);
    $stmt->bind_param("sss", $name, $phone, "Not Provided");
    $stmt->execute();
    $customerId = $stmt->insert_id;
    $stmt->close();

    // Insert user data into Registered table
    $registeredSql = "INSERT INTO Registered (customer_id, username, password, created_date) VALUES (?, ?, ?, NOW())";
    $stmt = $conn->prepare($registeredSql);
    $stmt->bind_param("iss", $customerId, $email, $hashedPassword);
    $stmt->execute();
    $stmt->close();

    echo json_encode(["status" => "success", "message" => "Account created successfully"]);
}
