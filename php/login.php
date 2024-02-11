<?php
session_start(); // Start session for user authentication

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve login form data
    $loginEmail = $_POST['loginEmail'];
    $loginPassword = $_POST['loginPassword'];

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'test');

    if ($conn->connect_error) {
        echo "$conn->connect_error";
        die("Connection Failed: " . $conn->connect_error);
    } else {
        // Prepare and execute a SELECT query to verify user credentials
        $stmt = $conn->prepare("SELECT * FROM registration WHERE email = ? AND password = ?");
        $stmt->bind_param("ss", $loginEmail, $loginPassword);
        $stmt->execute();

        // Fetch the result
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // User is authenticated, set session variables and redirect to a dashboard or home page
            $_SESSION['loggedIn'] = true;
            header("Location: dashboard.php"); // Redirect to the dashboard or home page
            exit();
        } else {
            // Invalid credentials, display an error message or redirect to the login page
            echo "Invalid username or password";
        }

        $stmt->close();
        $conn->close();
    }
}
?>
