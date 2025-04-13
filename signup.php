<?php
include './portal/db.php';

// Start the session
session_start();

// Initialize error variable
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if form fields are set
    if (!isset($_POST['username']) || !isset($_POST['email']) || !isset($_POST['password'])) {
        $error = "Please fill out all required fields.";
    } else {
        $name = mysqli_real_escape_string($conn, $_POST['username']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $profile_picture = '';

        // Check if email already exists
        $sql_check_email = "SELECT * FROM Users WHERE email = '$email'";
        $result_check_email = mysqli_query($conn, $sql_check_email);

        if ($result_check_email->num_rows > 0) {
            $error = "This email is already registered. Please use a different email.";
        } else {
            // Handle profile picture upload
            if (isset($_FILES['profile-input']) && $_FILES['profile-input']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = __DIR__ . '/uploads/user-pictures/';
                $profile_picture_path= $uploadDir . basename($_FILES['profile-input']['name']);
                move_uploaded_file($_FILES['profile-input']['tmp_name'], $profile_picture_path);
                $profile_picture = basename($_FILES['profile-input']['name']);
            }
            else {
                $profile_picture = './uploads/default-profile.png';
            }
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert user into the database
            $sql = "INSERT INTO Users (name, email, password, profile_picture) 
                    VALUES ('$name', '$email', '$hashed_password', '$profile_picture')";

            if (mysqli_query($conn, $sql)) {
                // Retrieve the user_id of the newly inserted user
                $user_id = mysqli_insert_id($conn);

                // Store username and user_id in the session
                $_SESSION['name'] = $name;
                $_SESSION['user_id'] = $user_id;
                $_SESSION['profile_picture']= $profile_picture;

                // Redirect to the home page
                header("Location: ./portal/home.php");
                exit();
            } else {
                $error = "Error: " . mysqli_error($conn);
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PrepPal SignUp</title>
    <link rel="icons" href="./imgs/Copy_of_PrepPal__2_-removebg-preview.png" />
    <link rel="stylesheet" href="./styles/signupPage.css" />
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
    <div class="image-section"></div>
    <div class="container">
      <div class="form-section">
        <h1>Create Account</h1>
        <form method="POST" action="signup.php" enctype="multipart/form-data">
          <div class="form-group profile">
            <div class="icon-container" id="icon-container">
              <lord-icon
                src="https://cdn.lordicon.com/hrjifpbq.json"
                trigger="in"
                delay="500"
                state="in-account"
                colors="primary:#794628"
                style="width: 100px; height: 100px"
              >
              </lord-icon>
            </div>
            <input type="file" id="profile-input" accept="image/*" name="profile-input">
            <span class="profile-info">Upload Profile Picture</span>
            <div class="image-preview" id="image-preview"></div>
          </div>
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
            <label for="email">Enter Your Email</label>
            <input
              type="email"
              name="email"
              id="password"
              placeholder="Enter Your Email"
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
            <button class="sign-up-btn" type="submit">Create Account</button>
          </div>
        </form>
        <?php if ($error): ?>
            <div class="error-message">
                <p style="color: red;"><?= $error ?></p>
            </div>
        <?php endif; ?>
        <div class="log-in-link">
            Already have an account?<a href="login.php">Log in</a>
        </div>
      </div>
    </div>
    <script src="https://cdn.lordicon.com/lordicon.js"></script>
    <script src="./scripts/signup-page.js"></script>
  </body>
</html>
