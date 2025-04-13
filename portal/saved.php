<?php
include 'userpage.php'; // Ensure session is started and DB is included

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login if not logged in
    exit();
}

$user_id = $_SESSION['user_id']; // Get logged-in user ID
$search = isset($_GET['search']) ? trim($_GET['search']) : '';

// Base SQL Query
$sql = "
    SELECT r.recipe_id, r.r_name, r.description, r.image, r.category, r.difficulty, r.time, r.likes, u.name 
    FROM savedrecipes s
    JOIN recipes r ON s.recipe_id = r.recipe_id
    JOIN users u ON r.user_id = u.user_id
    WHERE s.user_id = ?";

// Add search filter if user is searching
if (!empty($search)) {
    $sql .= " AND (r.r_name LIKE ? OR r.description LIKE ?)";
}

$stmt = $conn->prepare($sql);

// If searching, bind parameters for LIKE query
if (!empty($search)) {
    $searchTerm = "%$search%";
    $stmt->bind_param("iss", $user_id, $searchTerm, $searchTerm);
} else {
    $stmt->bind_param("i", $user_id);
}

$stmt->execute();
$result = $stmt->get_result();
$saved_recipes = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saved Recipes</title>
    <link rel="stylesheet" href="/PrepPal/styles/userstyles/saved.css">
    <script src="https://kit.fontawesome.com/your-fontawesome-kit.js" crossorigin="anonymous"></script>
</head>
<body>
    <h2>Saved Recipes</h2>

    <!-- Search Bar -->
    <div class="search-container">
        <form method="GET" action="saved.php" id="searchForm">
            <i class="fa fa-search" id="searchIcon"></i>
            <input type="text" name="search" placeholder="Search for recipes" class="search-bar" 
                   value="<?php echo htmlspecialchars($search); ?>">
        </form>
    </div>
    <section class="recipes">
        <?php if (empty($saved_recipes)): ?>
            <p>No saved recipes yet.</p>
        <?php else: ?>
            <?php foreach ($saved_recipes as $recipe): ?>
                <div class="recipe-card">
                <a href="recipepage.php?id=<?= $recipe['recipe_id'] ?>">    
                <img src="/PrepPal/uploads/recipe-pictures/<?= htmlspecialchars($recipe['image']) ?>" alt="<?= htmlspecialchars($recipe['r_name']) ?>">
                    <div class="recipe-card-header">
                        <span class="category"><?= htmlspecialchars($recipe['category']) ?></span>
                        <div class="likes-time">
                            <span class="time"><i class="fa-regular fa-clock"></i> <?= htmlspecialchars($recipe['time']) ?></span>
                            <span class="likes"><i class="fa-regular fa-heart"></i> <?= $recipe['likes'] ?></span>
                        </div>
                    </div>
                    <h3><?= htmlspecialchars($recipe['r_name']) ?></h3>
                    <p><?= htmlspecialchars($recipe['description']) ?></p>
                    <div class="recipe-card-footer">
                        <p class="author">by <strong><?= htmlspecialchars($recipe['name']) ?></strong></p>
                        <div class="diff-cont">
                            <lord-icon
                                src="https://cdn.lordicon.com/xjsqfzte.json"
                                trigger="in"
                                delay="1500"
                                state="in-reveal"
                                colors="primary:#121331,secondary:#848484"
                                style="width:30px;height:30px">
                            </lord-icon>
                            <span class="dificulty"><?= htmlspecialchars($recipe['difficulty']) ?></span>
                        </div>
                    </div>
                    </a>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </section>
    <script src="/PrepPal/scripts/userscripts/userpage.js"></script>
</body>
</html>
