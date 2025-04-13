<?php
include 'userpage.php'; // Ensure session is started and DB is included

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Initialize variables for profile data
$username = $email = $profile_picture = '';
$update_error = '';

// Fetch current user details
$sql = "SELECT name, email, profile_picture FROM users WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
$stmt->close();

// Update username, email, password, and profile picture
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $profile_picture = $user['profile_picture']; // Default to current picture

// If a new profile picture is uploaded
if (isset($_FILES['profile-input']) && $_FILES['profile-input']['error'] === UPLOAD_ERR_OK) {
    $uploadDir =  $_SERVER['DOCUMENT_ROOT'] . '/PrepPal/uploads/user-pictures/';
    $profile_picture_path= $uploadDir . basename($_FILES['profile-input']['name']);
    move_uploaded_file($_FILES['profile-input']['tmp_name'], $profile_picture_path);
    $profile_picture = basename($_FILES['profile-input']['name']);
}

    // If password is provided, update it
    if (!empty($password)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE users SET name = ?, email = ?, password = ?, profile_picture = ? WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $username, $email, $hashedPassword, $profile_picture, $user_id);
    } else {
        $sql = "UPDATE users SET name = ?, email = ?, profile_picture = ? WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $username, $email, $profile_picture, $user_id);
    }

    if ($stmt->execute()) {
        // Update the session variables
        $_SESSION['name'] = $username; // Update username in session
        $_SESSION['profile_picture'] = $profile_picture; // Update profile picture in session
        
        // Redirect with success message
         header("Location: profile.php?success=1");
        exit();
    } else {
        // Handle error in updating the profile
        $update_error = "Error updating the profile.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page - PrepPal</title>
    <link rel="stylesheet" href="/PrepPal/styles/userstyles/profile.css">
</head>
<body>

    <div class="profile-container">
        <h2>My Profile</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <!-- Display Profile Picture -->
            <div class="profile-picture">
                <img src="/PrepPal/uploads/user-pictures/<?= htmlspecialchars($user['profile_picture']) ?>" alt="Profile Picture" id="profileImage">
                <input type="file" name="profile-input" id="profilePictureInput" accept="image/*">
            </div>

            <!-- Display Username -->
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" value="<?= htmlspecialchars($user['name']) ?>" required>
            </div>

            <!-- Display Email -->
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
            </div>

            <!-- Display Password (with placeholder, but not pre-filled) -->
            <div class="form-group">
                <label for="password">New Password:</label>
                <input type="password" id="password" name="password" placeholder="Leave empty to keep current password" minlength="8">
            </div>

            <!-- Save and Cancel Buttons -->
            <div class="form-actions">
                <button type="submit" class="save-btn">Save</button>
                <button type="button" class="cancel-btn" onclick="window.location.href='home.php'">Cancel</button>
            </div>
        </form>
        <?php if ($update_error): ?>
            <div class="error-message"><?php echo $update_error; ?></div>
        <?php elseif (isset($_GET['success'])): ?>
            <div class="success-message">Profile updated successfully!</div>
        <?php endif; ?>
    </div>
<script>
    document.getElementById("profilePictureInput").addEventListener("change", function (event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            document.getElementById("profileImage").src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
});
</script>
</body>
</html>
