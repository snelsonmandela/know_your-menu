<?php
$success = 0;
$user = 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'connect.php';
    $username = $_POST['username'];
    $password = $_POST['password'];
  // Get the selected role from the form

    $sql = "SELECT * FROM `registration` WHERE username='$username'";

    $result = mysqli_query($con, $sql);
    if ($result) {
        $num = mysqli_num_rows($result);
        if ($num > 0) {
            $user = 1;
        } else {
            $sql = "INSERT INTO `registration` (username, password) VALUES ('$username', '$password')";
            $result = mysqli_query($con, $sql);
            if ($result) {
                $success = 1;
            } else {
                die(mysqli_error($con));
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup page</title>
    <link rel="stylesheet" href="signcss.css">
    <style>
       body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
            border-radius: 15px;
            padding: 20px;
            width: 300px;
        }

        .title {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .formLine {
            display: flex;
            flex-direction: column;
            margin-bottom: 15px;
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        input[type="password"] {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 15px;
            font-size: 16px;
        }
        /* Your existing CSS styles here */
        /* Style for the eye icon */
       .password-toggle {
            position: absolute;
            top: 52.56%;
            right: 539px; /* Adjust the right spacing as needed */
            transform: translateY(-50%);
            cursor: pointer;
        }
        button[type="submit"] {
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 20px;
    padding: 10px 20px;
    cursor: pointer;
    font-size: 16px;
    margin: 0 auto; /* Center the button horizontally */
    display: block; /* Ensure block-level display for centering */
}


        p {
            text-align: center;
            margin-top: 15px;
        }

        a {
            
            text-align: center;
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
            margin: 0 auto; /* Center the button horizontally */
    display: block;
    
        }
    </style>
</head>
<body>
    <?php
    if($user){
      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Ohh noo Sorry </strong> User Already Exists
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>';
    }
    ?>
   <?php
   if($success){
    header("Location:themenu.html");
    exit();
   }?>

   

    <section class="container">
    <h1 class="title">Signup</h1>
        <form id="form" method="post">
            <div class="formLine">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="formLine">
                <label for="password">Password:</label>
                
                    <input type="password" id="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                    <!-- Add the eye icon button for toggling password visibility -->
                    <span class="password-toggle" id="togglePassword" onclick="togglePasswordVisibility()">
                        🔑
                    </span>
                </div>
            
            <button type="submit">Signup</button>
        </form>
        <p>Already have an Account?</p>
        <a href="login.php" id="login">Login</a>
    </section>

    <!-- JavaScript to toggle password visibility -->
    <script>
        function togglePasswordVisibility() {
            var passwordInput = document.getElementById("password");
            var togglePasswordButton = document.getElementById("togglePassword");

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                togglePasswordButton.textContent = "🔒";
            } else {
                passwordInput.type = "password";
                togglePasswordButton.textContent = "🔑";
            }
        }
    </script>
</body>
</html>

