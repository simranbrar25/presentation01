<?php
$servername = "localhost";
$username = "root"; // Change this to your database username
$password = ""; // Change this to your database password
$database = "presentation";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Prepare and bind parameters
  $stmt = $conn->prepare("INSERT INTO feedback (name, email, message) VALUES (?, ?, ?)");
  $stmt->bind_param("sss", $name, $email, $message);

  // Set parameters
  $name = $_POST['name'];
  $email = $_POST['email'];
  $message = $_POST['message'];

  // Execute the query
  if ($stmt->execute()) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $stmt->error;
  }

  // Close statement
  $stmt->close();
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head> <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
       
        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
       
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
       
        table th, table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
       
        table th {
            background-color: #f2f2f2;
        }
       
        table tr:hover {
            background-color: #f5f5f5;
        }

        .btn {
            display: block;
            width: 120px;
            padding: 10px;
            text-align: center;
            margin: 20px auto;
            background-color: #4caf50;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }

        .btn:hover {
            background-color: #45a049;
        }
    </style>
  <title>Feedback Form</title>
</head>
<body>
  <h2>Feedback Form</h2>
  <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label for="name">Name:</label><br>
    <input type="text" id="name" name="name" required><br>
    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email" required><br>
    <label for="message">Message:</label><br>
    <textarea id="message" name="message" required></textarea><br><br>
    <input type="submit" value="Submit">
  </form>
</body>
</html>
