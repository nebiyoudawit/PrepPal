<?php
include './portal/db.php';
session_start();

$error = '';  // Initialize error variable

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get form input
    if (!isset($_POST['username']) || !isset($_POST['password'])) {
        $error = "Please fill out all required fields.";
    } else {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        // Query user data
        $sql = "SELECT * FROM Users WHERE name = '$username'";
        $result = mysqli_query($conn, $sql);

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();

            // Verify password
            if (password_verify($password, $user['password'])) {
                // Set session variables
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['name'] = $user['name'];
                $_SESSION['profile_picture'] = $user['profile_picture'];
                $_SESSION['role'] = $user['role'];

                // Redirect based on role
                if ($user['role'] === 'admin') {
                    header("Location: ./portal/adminpages/admindashboard.php");
                } else {
                    header("Location:./portal/home.php");
                }
                exit;
            } else {
                $error = "Incorrect password. Please try again.";
            }
        } else {
            $error = "Incorrect username. Please try again.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PrepPal Login</title>
    <link rel="icons" href="./imgs/Copy_of_PrepPal__2_-removebg-preview.png" />
    <link rel="stylesheet" href="./styles/loginpage.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
      rel="stylesheet"
    />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Modak&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
      rel="stylesheet"
    />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Luckiest+Guy&display=swap"
      rel="stylesheet"
    />
  </head>
  <body>
    <a href="index.php"
      ><img
        src="./imgs/Copy_of_PrepPal-removebg-preview.png"
        width="90"
        height="80"
        alt="PrepPal Logo"
        class="logo"
      />
    </a>
    <div class="container">
      <div class="form-section">
        <h1>WELCOME BACK</h1>
        <p>
          Log in to access your recipe collection and<br />discover new
          favorites.
        </p>
        <form action="login.php" method="post">
          <div class="form-group">
            <label for="username">UserName</label>
            <input
              type="text"
              id="username"
              name="username"
              placeholder="Enter Your User Name"
              required
            />
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input
              type="password"
              id="password"
              name="password"
              minlength="8"
              placeholder="Enter Your Password"
              required
            />
          </div>
          <div class="button-wrapper">
            <button class="sign-in-btn" type="submit">Sign in</button>
          </div>
        </form>
        <?php if ($error): ?>
                <div class="error-message">
                    <p style="color: red;"><?= $error ?></p>
                </div>
            <?php endif; ?>
        <div class="sign-up-link">
          Don't have an account? <a href="signup.php">Sign up for free!</a>
        </div>
      </div>
    </div>
    <div class="image-section"></div>
  </body>
</html>
