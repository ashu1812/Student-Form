<?php
// Check if form is submitted
if (isset($_POST['submit'])) {
  // Get form data
  $name = $_POST['name'];
  $email = $_POST['email'];

  // Get file data
  $filename = $_FILES['file']['name'];
  $filetmp = $_FILES['file']['tmp_name'];

  // Move file to uploads directory
  $upload_dir = 'uploads/';
  move_uploaded_file($filetmp, $upload_dir.$filename);

  // Connect to database
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "portal";
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Insert data into database
  $sql = "INSERT INTO form_data (id, name, email, filename) VALUES ('$name', '$email', '$filename')";
  if ($conn->query($sql) === TRUE) {
    echo "Data inserted successfully.";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

  // Close database connection
  $conn->close();
}
?>