<?php
include "adminpage.php";
// Handle Delete Recipe
if (isset($_POST['delete_recipe_id'])) {
    $recipe_id = (int)$_POST['delete_recipe_id'];
    $stmt = $conn->prepare("DELETE FROM recipes WHERE recipe_id = ?");
    $stmt->bind_param("i", $recipe_id);
    $stmt->execute();
    $stmt->close();
    header("Location: admindashboard.php"); // Refresh the page after deletion
    exit();
}

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

// Handle Delete Review
if (isset($_POST['delete_review_id'])) {
    $review_id = (int)$_POST['delete_review_id'];
    $stmt = $conn->prepare("DELETE FROM reviews WHERE review_id = ?");
    $stmt->bind_param("i", $review_id);
    $stmt->execute();
    $stmt->close();
    header("Location: admindashboard.php"); // Refresh the page after deletion
    exit();
}


// Fetch total counts
$recipeCountQuery = $conn->query("SELECT COUNT(*) AS total FROM recipes");
$recipeCount = $recipeCountQuery->fetch_assoc()['total'];

$userCountQuery = $conn->query("SELECT COUNT(*) AS total FROM users");
$userCount = $userCountQuery->fetch_assoc()['total'];

$reviewCountQuery = $conn->query("SELECT COUNT(*) AS total FROM reviews");
$reviewCount = $reviewCountQuery->fetch_assoc()['total'];

// Fetch recipes
$recipesQuery = $conn->query("SELECT recipe_id, r_name, category FROM recipes");

// Fetch users
$usersQuery = $conn->query("SELECT user_id, name, email FROM users");

// Fetch reviews
$reviewsQuery = $conn->query("SELECT reviews.review_id, recipes.r_name AS recipe, users.name, reviews.comment 
                              FROM reviews 
                              JOIN recipes ON reviews.recipe_id = recipes.recipe_id 
                              JOIN users ON reviews.user_id = users.user_id");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard - PrepPal</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
</head>
<body>
    <!-- Main Content -->
    <div class="main-content">
    <header>
  <h1>Admin Dashboard</h1>
            <div class="user-profile">
                <span>Admin</span>
            </div>
        </header>
        <!-- Dashboard Overview -->
        <section class="dashboard-overview">
            <div class="card">
                <i class="fas fa-utensils"></i>
                <h3>Total Recipes</h3>
                <p><?php echo $recipeCount; ?></p>
            </div>
            <div class="card">
                <i class="fas fa-users"></i>
                <h3>Total Users</h3>
                <p><?php echo $userCount; ?></p>
            </div>
            <div class="card">
                <i class="fas fa-comments"></i>
                <h3>Total Reviews</h3>
                <p><?php echo $reviewCount; ?></p>
            </div>
        </section>

        <!-- Manage Recipes -->
        <section class="manage-section">
            <h2>Manage Recipes</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $recipesQuery->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['recipe_id']; ?></td>
                            <td><?php echo htmlspecialchars($row['r_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['category']); ?></td>
                            <td>
                                <form action="admindashboard.php" method="POST">
                                    <input type="hidden" name="delete_recipe_id" value="<?php echo $row['recipe_id']; ?>" />
                                    <button type="submit" class="delete-recipe-btn delete-btn"><i class="fas fa-trash"></i> Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </section>

        <!-- Manage Users -->
        <section class="manage-section">
            <h2>Manage Users</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $usersQuery->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['user_id']; ?></td>
                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                            <td>
                            <form action="admindashboard.php" method="POST">
                                <input type="hidden" name="delete_user_id" value="<?php echo $row['user_id']; ?>" />
                                <button type="submit" class="delete-user-btn delete-btn"><i class="fas fa-trash"></i> Delete</button>
                            </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </section>

        <!-- Manage Reviews -->
        <section class="manage-section">
            <h2>Manage Reviews</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Recipe</th>
                        <th>User</th>
                        <th>Review</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $reviewsQuery->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['review_id']; ?></td>
                            <td><?php echo htmlspecialchars($row['recipe']); ?></td>
                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                            <td><?php echo htmlspecialchars($row['comment']); ?></td>
                            <td>
                            <form action="admindashboard.php" method="POST">
                                <input type="hidden" name="delete_review_id" value="<?php echo $row['review_id']; ?>" />
                                <button type="submit" class="delete-review-btn delete-btn"><i class="fas fa-trash"></i> Delete</button>
                            </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </section>
    </div>
</body>
</html>