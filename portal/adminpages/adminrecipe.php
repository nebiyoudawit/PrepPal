<?php
include "adminpage.php";
// Handle Delete Recipe
if (isset($_POST['delete_recipe_id'])) {
    $recipe_id = (int)$_POST['delete_recipe_id'];
    $stmt = $conn->prepare("DELETE FROM recipes WHERE recipe_id = ?");
    $stmt->bind_param("i", $recipe_id);
    $stmt->execute();
    $stmt->close();
    header("Location: adminrecipe.php"); // Refresh the page after deletion
    exit();
}
$sql = "
    SELECT 
        r.recipe_id, 
        r.r_name, 
        u.name AS created_by, 
        (SELECT COUNT(*) FROM savedrecipes WHERE recipe_id = r.recipe_id) AS saves, 
        r.likes, 
        r.created_at 
    FROM recipes r
    JOIN users u ON r.user_id = u.user_id
    ORDER BY r.created_at DESC";

$result = $conn->query($sql);

$recipes = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $recipes[] = $row;
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Recipe Page - PrepPal</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="styles/admin-recipe.css" />
</head>
<body>
    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        <header>
            <h1>Manage Recipes</h1>
            <div class="user-profile">
                <span>Admin</span>
            </div>
        </header>

        <!-- Recipes Table -->
        <section class="manage-section">
            <h2>Recipes</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Createdby</th>
                        <th>Saves</th>
                        <th>Likes</th>
                        <th>Creation Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="recipes-table-body">
                <?php foreach ($recipes as $recipe): ?>
                        <tr>
                            <td><?= htmlspecialchars($recipe['recipe_id']) ?></td>
                            <td><?= htmlspecialchars($recipe['r_name']) ?></td>
                            <td><?= htmlspecialchars($recipe['created_by']) ?></td>
                            <td><?= $recipe['saves'] ?></td>
                            <td><?= $recipe['likes'] ?></td>
                            <td><?= $recipe['created_at'] ?></td>
                            <td>
                                <form action="adminrecipe.php" method="POST">
                                    <input type="hidden" name="delete_recipe_id" value="<?php echo $recipe['recipe_id']; ?>" />
                                    <button type="submit" class="delete-recipe-btn delete-btn"><i class="fas fa-trash"></i> Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    </div>
</body>
</html>