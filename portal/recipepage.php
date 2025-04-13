<?php
session_start();
include 'db.php'; // Database connection

// Get user ID from session
$user_id = $_SESSION['user_id'] ?? null;

// Check if recipe ID is in the URL
if (!isset($_GET['id'])) {
    die("Recipe not found.");
}

$recipe_id = $_GET['id'];

// Fetch recipe details
$stmt = $conn->prepare("SELECT * FROM recipes WHERE recipe_id = ?");
$stmt->bind_param("i", $recipe_id);
$stmt->execute();
$result = $stmt->get_result();
$recipe = $result->fetch_assoc();

if (!$recipe) {
    die("Recipe not found.");
}

// Fetch ingredients
$stmt = $conn->prepare("SELECT name FROM ingredients WHERE recipe_id = ?");
$stmt->bind_param("i", $recipe_id);
$stmt->execute();
$ingredients = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

// Fetch instructions
$stmt = $conn->prepare("SELECT step_number, description FROM instructions WHERE recipe_id = ? ORDER BY step_number");
$stmt->bind_param("i", $recipe_id);
$stmt->execute();
$instructions = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

// Fetch reviews
$stmt = $conn->prepare("
    SELECT reviews.review_id, reviews.comment, reviews.created_at, reviews.user_id, users.name, users.profile_picture
    FROM reviews
    JOIN users ON reviews.user_id = users.user_id
    WHERE reviews.recipe_id = ?
    ORDER BY reviews.created_at DESC
");
$stmt->bind_param("i", $recipe_id);
$stmt->execute();
$reviews = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

// Handle review submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['review'])) {
    $review_comment = $_POST['review'];
    
    // Ensure review is not empty
    if (!empty($review_comment)) {
        // Insert review into the database
        $stmt = $conn->prepare("INSERT INTO reviews (user_id, recipe_id, comment, created_at) VALUES (?, ?, ?, NOW())");
        $stmt->bind_param("iis", $user_id, $recipe_id, $review_comment);
        $stmt->execute();
        $stmt->close();
        
        // Reload page to reflect new review
        header("Location: recipepage.php?id=$recipe_id");
        exit();
    }
}

// Handle comment deletion
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_review_id']) && $user_id !== null) {
    $delete_review_id = $_POST['delete_review_id'];
    
    // Check if the review belongs to the current user
    $stmt = $conn->prepare("SELECT * FROM reviews WHERE review_id = ? AND user_id = ?");
    $stmt->bind_param("ii", $delete_review_id, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        // Delete the review
        $stmt = $conn->prepare("DELETE FROM reviews WHERE review_id = ?");
        $stmt->bind_param("i", $delete_review_id);
        $stmt->execute();
    }
    
    $stmt->close();
    // Reload page after deletion
    header("Location: recipepage.php?id=$recipe_id");
    exit();
}


// Handle save action
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'save' && $user_id !== null) {
  $recipe_id = $_POST['recipe_id'];

  // Check if the recipe is already saved
  $stmt = $conn->prepare("SELECT * FROM savedrecipes WHERE user_id = ? AND recipe_id = ?");
  $stmt->bind_param("ii", $user_id, $recipe_id);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
      // If saved, remove it
      $stmt = $conn->prepare("DELETE FROM savedrecipes WHERE user_id = ? AND recipe_id = ?");
      $stmt->bind_param("ii", $user_id, $recipe_id);
      $stmt->execute();
  } else {
      // If not saved, add it
      $stmt = $conn->prepare("INSERT INTO savedrecipes (user_id, recipe_id) VALUES (?, ?)");
      $stmt->bind_param("ii", $user_id, $recipe_id);
      $stmt->execute();
  }

  $stmt->close();
  header("Location: recipepage.php?id=$recipe_id");
  exit();
}


// Check if the user has saved this recipe
$stmt = $conn->prepare("SELECT * FROM savedrecipes WHERE user_id = ? AND recipe_id = ?");
$stmt->bind_param("ii", $user_id, $recipe_id);
$stmt->execute();
$is_saved = $stmt->get_result()->num_rows > 0; // Returns true if saved

// Check if user has already liked this recipe
$stmt = $conn->prepare("SELECT * FROM likes WHERE user_id = ? AND recipe_id = ?");
$stmt->bind_param("ii", $user_id, $recipe_id);
$stmt->execute();
$is_liked = $stmt->get_result()->num_rows > 0;
$stmt->close();

// Handle Like action
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["action"]) && $_POST["action"] === "like") {
    if ($is_liked) {
        // Unlike the recipe
        $stmt = $conn->prepare("DELETE FROM likes WHERE user_id = ? AND recipe_id = ?");
        $stmt->bind_param("ii", $user_id, $recipe_id);
        $stmt->execute();
        $stmt->close();

        // Decrease like count
        $stmt = $conn->prepare("UPDATE recipes SET likes = likes - 1 WHERE recipe_id = ?");
        $stmt->bind_param("i", $recipe_id);
        $stmt->execute();
        $stmt->close();
    } else {
        // Like the recipe
        $stmt = $conn->prepare("INSERT INTO likes (user_id, recipe_id) VALUES (?, ?)");
        $stmt->bind_param("ii", $user_id, $recipe_id);
        $stmt->execute();
        $stmt->close();

        // Increase like count
        $stmt = $conn->prepare("UPDATE recipes SET likes = likes + 1 WHERE recipe_id = ?");
        $stmt->bind_param("i", $recipe_id);
        $stmt->execute();
        $stmt->close();
    }

    // Redirect to refresh the page and update UI
    header("Location: recipepage.php?id=" . $recipe_id);
    exit();
}



$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PrepPal Recipe</title>
    <link rel="icons" href="/imgs/Copy_of_PrepPal__2_-removebg-preview.png" />
    <link rel="stylesheet" href="/PrepPal/styles/userstyles/recipePage.css" />
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
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
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

<header class="navbar">
    <div class="logo">
        <a href="home.php"><img src="../imgs/Copy_of_PrepPal-removebg-preview.png" alt="logo" width="80" height="70"></a>
    </div>
    <nav>
        <a href="home.php">Home</a>
        <a href="recipes.php">Recipes</a>
        <a href="myrecipes.php">MyRecipes</a>
        <a href="saved.php">Saved</a>
    </nav>
    <img src="/PrepPal/uploads/user-pictures/<?php echo $_SESSION['profile_picture']; ?>" alt="Profile Picture" class="profile-pic">
</header>

<main class="recipe-detail">
    <div class="recipe-card">
    <img src="../uploads/recipe-pictures/<?php echo isset($recipe['image']) && !empty($recipe['image']) ? htmlspecialchars($recipe['image']) : 'default-recipe.jpg'; ?>" 
     alt="<?php echo isset($recipe['r_name']) ? htmlspecialchars($recipe['r_name']) : 'Recipe Image'; ?>"
     class="recipe-image">
        <div class="recipe-info">
            <div class="recipe-card-header">
                <h1><?= htmlspecialchars($recipe['r_name']) ?></h1>
                <div class="stats">
                <div class="likes stat-container">
    <form method="POST" action="recipepage.php?id=<?= $recipe_id ?>" class="like-form">
        <input type="hidden" name="recipe_id" value="<?= $recipe_id ?>">
        <input type="hidden" name="action" value="like">

        <!-- Default "Not Liked" Icon -->
        <lord-icon
            src="https://cdn.lordicon.com/rqfqhnxq.json"
            trigger="hover"
            stroke="light"
            colors="primary:#ffffff,secondary:#e4e4e4,tertiary:#ffc738,quaternary:#fad3d1,quinary:#f24c00,senary:#ebe6ef"
            style="width: 40px; height: 40px; <?= $is_liked ? 'display: none;' : 'display:inline;' ?>"
            class="notliked-state"
        ></lord-icon>

        <!-- "Liked" Icon (Hidden by Default) -->
        <lord-icon
            src="https://cdn.lordicon.com/rqfqhnxq.json"
            trigger="hover"
            stroke="light"
            colors="primary:#c71f16,secondary:#c71f16,tertiary:#ffc738,quaternary:#fad3d1,quinary:#f24c00,senary:#ebe6ef"
            style="width: 40px; height: 40px; <?= $is_liked ? 'display: inline;' : 'display: none;' ?>"
            class="liked-state"
        ></lord-icon>

        <span><?= $recipe['likes'] ?></span>
    </form>
</div>
              <div class="time stat-container">
                <lord-icon
                  src="https://cdn.lordicon.com/mwikjdwh.json"
                  trigger="in"
                  state="loop-clock"
                  colors="primary:#913710"
                  style="width: 40px; height: 40px"
                >
                </lord-icon>
                <span><?= $recipe['time']?> mins</span>
              </div>
              <div class="saves">
    <form method="POST" action="recipepage.php?id=<?= $recipe_id ?>" class="save-form">
        <input type="hidden" name="recipe_id" value="<?= $recipe_id ?>">
        <input type="hidden" name="action" value="save">

        <!-- "Save" Icon (Show if Not Saved) -->
        <lord-icon
            src="https://cdn.lordicon.com/prjooket.json"
            trigger="hover"
            colors="primary:#913710"
            style="width: 40px; height: 40px; <?= $is_saved ? 'display:none;' : 'display:inline;' ?>"
            class="notsaved-state"
        ></lord-icon>

        <!-- "Saved" Icon (Show if Already Saved) -->
        <lord-icon
            src="https://cdn.lordicon.com/oiiqgosg.json"
            trigger="hover"
            colors="primary:#913710"
            style="width: 40px; height: 40px; <?= $is_saved ? 'display:inline;' : 'display:none;' ?>"
            class="saved-state"
        ></lord-icon>

        <span><?= $is_saved ? "Saved" : "Save" ?></span>
    </form>
</div>

                </div>
            </div>
            <div class="tags">
                <span class="type"><?= htmlspecialchars($recipe['category']) ?></span>
                <div class="difficulty">
              <lord-icon
                src="https://cdn.lordicon.com/jfwzwlls.json"
                trigger="in"
                delay="1000"
                state="in-speed"
                colors="primary:#5c0a33"
                style="width: 50px; height: 50px"
              >
              </lord-icon>
              <span class="skill"><?= htmlspecialchars($recipe['difficulty']) ?></span>
            </div>
            </div>
            <p class="description"><?= nl2br(htmlspecialchars($recipe['description'])) ?></p>
            <h2>Ingredients</h2>
            <ul class="ingredients">
                <?php foreach ($ingredients as $ingredient): ?>
                    <li><?= htmlspecialchars($ingredient['name']) ?></li>
                <?php endforeach; ?>
            </ul>

            <h2>Instructions</h2>
            <ol class="instructions">
                <?php foreach ($instructions as $instruction): ?>
                    <li><?= htmlspecialchars($instruction['description']) ?></li>
                <?php endforeach; ?>
            </ol>
        </div>
    </div>



    <div class="reviews-section">
    <h2>Reviews</h2>

    <!-- Review Submission Form -->
    <div class="add-review">
        <form method="POST" action="recipepage.php?id=<?= $recipe_id ?>">
            <textarea name="review" placeholder="Add your review..."></textarea>
            <button type="submit">Submit</button>
        </form>
    </div>

    <!-- Display Existing Reviews -->
    <?php foreach ($reviews as $review): ?>
        <div class="review">
            <!-- Display user profile picture -->
            <div class="review-user-info">
                <img src="../uploads/user-pictures/<?= htmlspecialchars($review['profile_picture']) ?>" alt="<?= htmlspecialchars($review['name']) ?>" class="review-user-img" />
                <strong><?php echo htmlspecialchars($review['name']); ?> </strong>
                <span class="date"><?php echo date('M d, Y', strtotime($review['created_at'])); ?></span>
            </div>
            <p><?php echo htmlspecialchars($review['comment']); ?></p>

            <!-- Check if the logged-in user is the review owner and allow delete -->
            <?php if ($user_id == $review['user_id']): ?>
                <form method="POST" action="recipepage.php?id=<?= $recipe_id ?>" style="display: inline;">
                    <input type="hidden" name="delete_review_id" value="<?= $review['review_id'] ?>">
                    <button type="submit" class="delete-review-btn">Delete</button>
                </form>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
</div>
</main>
<script src="https://cdn.lordicon.com/lordicon.js"></script>
<script src="/PrepPal/scripts/userscripts/recipepage.js"></script>
</body>
</html>
