<?php
// Start a session
session_start();

// Connect to the MySQL database
$servername = "localhost";
$username = "root";
$password = "Ashish-root@123";
$dbname = "gpt_login";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Get the form data
  $username = $_POST['username'];
  $password = $_POST['password'];

  // TODO: Validate the username and password

  // Check if the username and password are valid
  $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // Set the session variable
    $_SESSION['username'] = $username;

    // Redirect the user to a new page
    header('Location: newpage.php');
    exit;
  } else {
    // Display an error message
    echo 'Invalid username or password.';
  }
}

// Close the database connection
$conn->close();
?>

<!-- Display the login form -->
<form method="post">
  <label for="username">Username:</label>
  <input type="text" name="username" id="username"><br>

  <label for="password">Password:</label>
  <input type="password" name="password" id="password"><br>

  <input type="submit" value="Login">
</form>
