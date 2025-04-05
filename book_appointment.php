<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "health_hub";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $doctor = $_POST['doctor'];
    $appointment_date = $_POST['date'];
    $reason = $_POST['reason'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO appointments (name, email, phone, doctor, appointment_date, reason) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $name, $email, $phone, $doctor, $appointment_date, $reason);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Appointment booked successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>