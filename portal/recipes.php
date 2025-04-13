<?php
include 'userpage.php';

// Handle search input and category selection
$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';
$category = isset($_GET['category']) ? mysqli_real_escape_string($conn, $_GET['category']) : '';

// Base query to fetch recipes
$sql = "SELECT Recipes.*, Users.name 
        FROM Recipes 
        JOIN Users ON Recipes.user_id = Users.user_id";

// Apply filters if search or category is selected
if (!empty($search) || !empty($category)) {
    $sql .= " WHERE";
    if (!empty($search)) {
        $sql .= " (Recipes.r_name LIKE '%$search%' OR Recipes.category LIKE '%$search%')";
    }
    if (!empty($category)) {
        if (!empty($search)) {
            $sql .= " AND";
        }
        $sql .= " Recipes.category = '$category'";
    }
}

$sql .= " ORDER BY Recipes.created_at DESC";

$result = mysqli_query($conn, $sql);
if (!$result) {
    die("Error fetching recipes: " . mysqli_error($conn));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipes</title>
    <link rel="stylesheet" href="/PrepPal/styles/userstyles/recipes.css">
</head>
<div class="search-container">
    <form method="GET" action="recipes.php" id="searchForm">
        <i class="fa fa-search" id="searchIcon"></i> 
        <input type="text" name="search" placeholder="Search for recipes" class="search-bar" value="<?php echo htmlspecialchars($search); ?>">
    </form>
</div>
    <div class="search-category">
        <a href="recipes.php?category=Breakfast"><span class="breakfast">Breakfast</span></a>
        <a href="recipes.php?category=Lunch"><span class="lunch">Lunch</span></a>
        <a href="recipes.php?category=Dinner"><span class="dinner">Dinner</span></a>
        <a href="recipes.php?category=Dessert"><span class="dessert">Dessert</span></a>
        <a href="recipes.php?category=Snacks"><span class="snack">Snacks</span></a>
    </div>
    <h2>Recipes</h2>
<section class="search-result">
    <?php while ($recipe = mysqli_fetch_assoc($result)): ?>
                <div class="recipe-card">
                <a href="recipepage.php?id=<?= $recipe['recipe_id'] ?>">    
                <img src="/PrepPal/uploads/recipe-pictures/<?php echo $recipe['image']; ?>" alt="<?php echo $recipe['r_name']; ?>">
                    <div class="recipe-card-header">
                        <span class="category"><?php echo $recipe['category']; ?></span>
                        <div class="likes-time">
                            <span class="time"><i class="fa-regular fa-clock"></i> <?php echo $recipe['time']; ?> mins</span>
                            <span class="likes"><i class="fa-regular fa-heart"></i> <?php echo $recipe['likes']; ?></span>
                        </div>
                    </div>
                    <h3><?php echo $recipe['r_name']; ?></h3>
                    <div class="desc">
                        <p><?php echo $recipe['description']; ?></p>
                    </div>
                    <div class="recipe-card-footer">
                        <p class="author">by <strong><?php echo $recipe['name']; ?></strong></p>
                        <div class="diff-cont">
                            <lord-icon
                                src="https://cdn.lordicon.com/xjsqfzte.json"
                                trigger="in"
                                delay="1500"
                                state="in-reveal"
                                colors="primary:#121331,secondary:#848484"
                                style="width:30px;height:30px">
                            </lord-icon>
                            <span class="difficulty"><?php echo $recipe['difficulty']; ?></span>
                        </div>
                    </div>
                    </a>
                </div>
            <?php endwhile; ?>
         <!-- Display a message if no results found -->
         <?php if (mysqli_num_rows($result) == 0): ?>
                <p class="no-results">No recipes found for "<?php echo htmlspecialchars($search ?: $category); ?>"</p>
            <?php endif; ?>
</section>
</main>
<script src="https://cdn.lordicon.com/lordicon.js"></script>
<script src="/PrepPal/scripts/userpage.js"></script>
</body>
</html>