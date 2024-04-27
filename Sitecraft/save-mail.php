<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the email from the form
    $email = $_POST["email"];

    // Validate and save the email
    if (!empty($email)) {
        // Replace these values with your database credentials
        $host = "127.0.0.1";
        $username = "root";
        $password = "";
        $database = "userdata";

        // Create a connection to the database
        $conn = new mysqli($host, $username, $password, $database);

        // Check the connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Insert the email into the subscribers table
        $sql = "INSERT INTO subscribers (email) VALUES ('$email')";

        if ($conn->query($sql) === TRUE) {
            echo "Subscription successful!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Close the database connection
        $conn->close();
    } else {
        echo "Invalid email address";
    }
}
?>
