<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $login_username = $_POST["login_username"];
    $login_password = $_POST["login_password"];

    // Validate and sanitize input (you should add more validation)
    $login_username = htmlspecialchars(trim($login_username));

    // Hash the provided password for comparison with the stored hashed password
    // $hashedLoginPassword = password_hash($login_password, PASSWORD_BCRYPT);

    // Check user credentials against the database (replace this with your database logic)
    $servername = "127.0.0.1";
    $username_db = "root";
    $password_db = "";
    $dbname = "userdata";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username_db, $password_db);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->bindParam(':username', $login_username);
        $stmt->execute(); 

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Verify password
            if ($user['password']==$login_password) {
                // Password is correct, login successful
                echo "Login successful!";
                header('Location: index.html');
        exit;
                
                // Redirect or perform further actions
            } else {
                // Invalid password
                echo "Invalid password!";
            }
        }
         else {
           
            echo "User not found!";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    $conn = null;
}
?>
