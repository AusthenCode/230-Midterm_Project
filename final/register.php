<?php
session_start();

// DB connection
$conn = new mysqli("localhost", "root", "", "bookifydb");

// check connection
if ($conn -> connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// When form submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // insert
    $stmt = $conn->prepare("
        INSERT INTO users (username, email, password, role, is_admin)
        VALUES (?, ?, ?, 'user', 0)
    ");
    $stmt->bind_param("sss", $username, $email, $hashed_password);

    if ($stmt->execute()) {
        // success → send user to login
        header("Location: login.php");
        exit;
    } else {
        $error = "Error: " . $stmt->error;
    }

}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>

<h2>Create Account</h2>

<form method="POST">
    <input type="text" name="username" placeholder="Username" required><br><br>
    <input type="email" name="email" placeholder="Email" required><br><br>
    <input type="password" name="password" placeholder="Password" required><br><br>

    <button type="submit">Register</button>
</form>

<?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

</body>
</html>
