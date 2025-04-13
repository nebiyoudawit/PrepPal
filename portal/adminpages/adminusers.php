<?php
include 'adminpage.php';
// Handle Delete User
if (isset($_POST['delete_user_id'])) {
    $user_id = (int)$_POST['delete_user_id'];
    $stmt = $conn->prepare("DELETE FROM users WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->close();
    header("Location: admindashboard.php"); // Refresh the page after deletion
    exit();
}

// Pagination Variables
$users_per_page = 5;
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $users_per_page;

// Fetch total users count
$total_users_result = $conn->query("SELECT COUNT(*) AS total FROM users");
$total_users_row = $total_users_result->fetch_assoc();
$total_users = $total_users_row['total'];
$total_pages = ceil($total_users / $users_per_page);

// Fetch users with LIMIT
$sql = "SELECT user_id, name, email, created_at FROM users ORDER BY created_at DESC LIMIT ?, ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $offset, $users_per_page);
$stmt->execute();
$result = $stmt->get_result();
$users = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();

// Fetch user details if a user is selected
$selected_user = null;
$liked_recipes = [];
$saved_recipes = [];
$created_recipes = [];

if (isset($_GET['user_id'])) {
    $user_id = (int)$_GET['user_id'];

    // Get user details
    $stmt = $conn->prepare("SELECT name, email FROM users WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $user_result = $stmt->get_result();
    $selected_user = $user_result->fetch_assoc();
    $stmt->close();

    // Get liked recipes
    $stmt = $conn->prepare("
        SELECT r.r_name 
        FROM recipes r 
        JOIN likes l ON r.recipe_id = l.recipe_id 
        WHERE l.user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $liked_result = $stmt->get_result();
    while ($row = $liked_result->fetch_assoc()) {
        $liked_recipes[] = $row['r_name'];
    }
    $stmt->close();

    // Get saved recipes
    $stmt = $conn->prepare("
        SELECT r.r_name 
        FROM recipes r 
        JOIN savedrecipes s ON r.recipe_id = s.recipe_id 
        WHERE s.user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $saved_result = $stmt->get_result();
    while ($row = $saved_result->fetch_assoc()) {
        $saved_recipes[] = $row['r_name'];
    }
    $stmt->close();

    // Get created recipes
    $stmt = $conn->prepare("SELECT r_name FROM recipes WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $created_result = $stmt->get_result();
    while ($row = $created_result->fetch_assoc()) {
        $created_recipes[] = $row['r_name'];
    }
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Manage Users - PrepPal</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="styles/admin-users.css" />
</head>
<body>
    <div class="main-content">
        <header>
            <h1>Manage Users</h1>
        </header>

        <!-- Users Table -->
        <section class="manage-section">
            <h2>Users</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Joined</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr onclick="window.location.href='adminusers.php?user_id=<?= $user['user_id'] ?>&page=<?= $page ?>'">
                            <td><?= htmlspecialchars($user['user_id']) ?></td>
                            <td><?= htmlspecialchars($user['name']) ?></td>
                            <td><?= htmlspecialchars($user['email']) ?></td>
                            <td><?= htmlspecialchars($user['created_at']) ?></td>
                            <td>
                            <form action="admindashboard.php" method="POST">
                                <input type="hidden" name="delete_user_id" value="<?php echo $user['user_id']; ?>" />
                                <button type="submit" class="delete-user-btn delete-btn"><i class="fas fa-trash"></i> Delete</button>
                            </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <!-- Pagination Controls -->
            <div class="pagination">
                <?php if ($page > 1): ?>
                    <a href="?page=<?= $page - 1 ?>" class="prev">« Prev</a>
                <?php endif; ?>

                <span>Page <?= $page ?> of <?= $total_pages ?></span>

                <?php if ($page < $total_pages): ?>
                    <a href="?page=<?= $page + 1 ?>" class="next">Next »</a>
                <?php endif; ?>
            </div>
        </section>

        <!-- User Details (Liked, Saved, Created Recipes) -->
        <?php if ($selected_user): ?>
            <section id="user-details">
                <h2>User Details</h2>
                <p><strong>Name:</strong> <?= htmlspecialchars($selected_user['name']) ?></p>
                <p><strong>Email:</strong> <?= htmlspecialchars($selected_user['email']) ?></p>

                <h3>Liked Recipes</h3>
                <ul>
                    <?php foreach ($liked_recipes as $recipe): ?>
                        <li><?= htmlspecialchars($recipe) ?></li>
                    <?php endforeach; ?>
                    <?php if (empty($liked_recipes)) echo "<li>None</li>"; ?>
                </ul>

                <h3>Saved Recipes</h3>
                <ul>
                    <?php foreach ($saved_recipes as $recipe): ?>
                        <li><?= htmlspecialchars($recipe) ?></li>
                    <?php endforeach; ?>
                    <?php if (empty($saved_recipes)) echo "<li>None</li>"; ?>
                </ul>

                <h3>Created Recipes</h3>
                <ul>
                    <?php foreach ($created_recipes as $recipe): ?>
                        <li><?= htmlspecialchars($recipe) ?></li>
                    <?php endforeach; ?>
                    <?php if (empty($created_recipes)) echo "<li>None</li>"; ?>
                </ul>
            </section>
        <?php endif; ?>
    </div>
</body>
</html>
