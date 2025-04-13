<?php
include 'userpage.php'; 
if (!isset($_SESSION['user_id'])) {
    die("Unauthorized access.");
}
$user_id = $_SESSION['user_id']; // Get logged-in user's ID
if (isset($_POST['recipe_id'])) {
  $recipe_id = intval($_POST['recipe_id']);
  // First, delete the ingredients and instructions associated with this recipe
  $conn->query("DELETE FROM Ingredients WHERE recipe_id = $recipe_id");
  $conn->query("DELETE FROM Instructions WHERE recipe_id = $recipe_id");
  // Then, delete the recipe itself
  $stmt = $conn->prepare("DELETE FROM Recipes WHERE recipe_id = ? AND user_id = ?");
  $stmt->bind_param("ii", $recipe_id, $_SESSION['user_id']);
  if ($stmt->execute()) {
      // Redirect to the recipe list page after deletion
      header("Location: myrecipes.php?success=1");
      exit();
  } else {
      echo "Error: " . $stmt->error;
  }
  $stmt->close();
} else {
  echo "No recipe ID provided!";
}
// Check if form was submitted For new Recipe
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $category = $_POST['category'];
    $description = trim($_POST['description']);
    $difficulty = $_POST['difficulty'];
    $time = intval($_POST['time']); // Time required in minutes
    // Handle image upload
    $upload_dir = "../uploads/recipe-pictures/"; 
    // Check if an image file was uploaded
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image_name = time() . "_" . basename($_FILES['image']['name']); // Unique filename
        $target_file = $upload_dir . $image_name;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        // Validate image type
        $allowed_types = ['jpg', 'jpeg', 'png'];
        if (in_array($imageFileType, $allowed_types)) {
            // Move the uploaded file to the uploads folder
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                $image = $image_name; // Save image filename in database
            } else {
                echo "Error moving uploaded file.";
            }
        } else {
            echo "Invalid file type. Only JPG, JPEG, and PNG allowed.";
        }
    }
    // Insert recipe into the Recipes table
    $sql = "INSERT INTO Recipes (user_id, r_name, image, description, category, difficulty, time) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isssssi", $user_id, $name, $image, $description, $category, $difficulty, $time);
    if ($stmt->execute()) {
        $recipe_id = $stmt->insert_id; // Get the last inserted recipe ID
        // Insert ingredients
        if (!empty($_POST['ingredients'])) {
            $sql_ing = "INSERT INTO Ingredients (recipe_id, name) VALUES (?, ?)";
            $stmt_ing = $conn->prepare($sql_ing);
            foreach ($_POST['ingredients'] as $ingredient) {
                $trimmed_ingredient = trim($ingredient);
                $stmt_ing->bind_param("is", $recipe_id, $trimmed_ingredient);
                $stmt_ing->execute();
            }
        }

        // Insert instructions
        if (!empty($_POST['instructions'])) {
            $sql_ins = "INSERT INTO Instructions (recipe_id, step_number, description) VALUES (?, ?, ?)";
            $stmt_ins = $conn->prepare($sql_ins);
            $step_number = 1;
            foreach ($_POST['instructions'] as $instruction) {
                $trimmed_instruction = trim($instruction);
                $stmt_ins->bind_param("iis", $recipe_id, $step_number, $trimmed_instruction);
                $stmt_ins->execute();
                $step_number++;
            }
        }

        // Redirect to the recipe list page
        header("Location: myrecipes.php?success=1");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}


// Fetch recipes added by this user
$sql = "SELECT * FROM Recipes WHERE user_id = ? ORDER BY created_at DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();


//Search Functionality 
// Handle search input (no category filter)
$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';

// Base query to fetch recipes only from the logged-in user
$sql = "SELECT Recipes.*, Users.name 
        FROM Recipes 
        JOIN Users ON Recipes.user_id = Users.user_id
        WHERE Recipes.user_id = $user_id"; // Filter by user_id

// Apply search filter (search by recipe name or description)
if (!empty($search)) {
    $sql .= " AND (Recipes.r_name LIKE '%$search%' OR Recipes.description LIKE '%$search%')";
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
    <title>MyRecipes</title>
    <link rel="stylesheet" href="/PrepPal/styles/userstyles/myrec.css">
</head>
<bd>
    <!-- Recipe List Container -->
    <div id="recipe-list-container">
    <div class="search-container">
    <form method="GET" action="myrecipes.php" id="searchForm">
        <i class="fa fa-search" id="searchIcon"></i> 
        <input type="text" name="search" placeholder="Search for recipes" class="search-bar" value="<?php echo htmlspecialchars($search); ?>">
    </form>
</div>
        <span class="add-recipe" id="show-add-recipe"><i class="fa fa-plus"></i>Add</span>
        <section class="recipes">
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($recipe = $result->fetch_assoc()): ?> 
                      <div class="recipe-card">
                      <form action="myrecipes.php" method="post" style="display=inline;"> 
                      <input type="hidden" name="recipe_id" value="<?php echo $recipe['recipe_id']; ?>">
                      <a href="recipepage.php?id=<?= $recipe['recipe_id'] ?>" style="text-decoration: none;">     
                      <img src="../uploads/recipe-pictures/<?php echo htmlspecialchars($recipe['image']); ?>" alt="Recipe-Picture"></a> 
                            <div class="recipe-card-header">
                                <span class="category"><?php echo htmlspecialchars($recipe['category']); ?></span>
                                <div class="likes-time">
                                    <span class="time"><i class="fa-regular fa-clock"></i> <?php echo $recipe['time']; ?> mins</span>
                                    <span class="likes"><i class="fa-regular fa-heart"></i> <?php echo $recipe['likes']; ?></span>
                                </div>
                            </div>
                            <h3><?php echo htmlspecialchars($recipe['r_name']); ?></h3>
                            <p><?php echo htmlspecialchars($recipe['description']); ?></p>
                            <div class="recipe-card-footer">
                            <a href="myrecipes.php?edit_id=<?= $recipe['recipe_id']?>"><span class="edit-recipe"><i class="fa fa-edit"></i><strong> Edit</strong></span></a>
                                <span class="delete-recipe"><i class="fa fa-trash"></i><strong> Delete</strong></span>
                            </div>
                        </div>
                        </form>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>No recipes found. Add your first recipe!</p>
                <?php endif; ?>
                
        </section>  
    </div>

    <!-- Add Recipe Form Container (Hidden by Default) -->
    <div id="add-recipe-container" style="display: none;">
        <form action="myrecipes.php" method="post" enctype="multipart/form-data">
        <label>Recipe Name:</label><br>
        <input type="text" name="name" required class="name">
        <label>Category:</label>
        <select name="category" required class="cat">
            <option value="breakfast">Breakfast</option>
            <option value="lunch">Lunch</option>
            <option value="dinner">Dinner</option>
            <option value="snacks">Snacks</option>
            <option value="dessert">Dessert</option>
        </select><br>
        <label>Description:</label><br>
        <textarea name="description" required class="description"></textarea>
        <label>Difficulty:</label>
        <select name="difficulty" required class="diff">
            <option value="easy">Easy</option>
            <option value="medium">Medium</option>
            <option value="hard">Hard</option>
        </select><br>
        <div class="time-input">
          <label>Time Required:</label>
            <input type="number" name="time" min="1" placeholder="Enter time" required>
            <span>mins</span>
        </div>
        <label>Ingredients:</label>
        <div id="ingredients-container">
    <div class="ingredient">
        <input type="text" name="ingredients[]" placeholder="Enter ingredient" required>
        <span class="remove-ingredient">×</span> <!-- "x" icon -->
    </div>
</div>
        <button type="button" id="add-ingredient">+ Add Ingredient</button>
        <label>Instructions:</label>
        <div id="instructions-container">
    <div class="instruction">
        <input type="text" name="instructions[]" placeholder="Step 1" required>
        <span class="remove-instruction">×</span> <!-- "x" icon -->
    </div>
</div>
        <button type="button" id="add-instruction">+ Add Step</button>
        <div class="file-container">
        <label>Upload Image:</label>
        <input type="file" name="image" accept=".jpg, .jpeg, .png"required>
        </div> 
            <button type="submit">Add Recipe</button>
            <button type="button" id="cancel-add-recipe">Cancel</button>
        </form>
    </div>

    <?php


$user_id = $_SESSION['user_id']; // Get logged-in user's ID

// Initialize variables before the conditional check
$ingredients = [];
$instructions = [];

$ingredientCount = 0;
$instructionCount = 0;

// Check if 'edit_id' is set in the URL
if (isset($_GET['edit_id'])) {
    $edit_id = intval($_GET['edit_id']);
    
    // Fetch the recipe data to fill the form
    $stmt = $conn->prepare("SELECT * FROM Recipes WHERE recipe_id = ? AND user_id = ?");
    $stmt->bind_param("ii", $edit_id, $user_id);
    $stmt->execute();
    $recipe_result = $stmt->get_result();
    $stmt->close();

    if ($recipe_result->num_rows > 0) {
        $recipe = $recipe_result->fetch_assoc();

        // Fetch ingredients for the recipe
        $stmt = $conn->prepare("SELECT name FROM Ingredients WHERE recipe_id = ?");
        $stmt->bind_param("i", $edit_id);
        $stmt->execute();
        $ingredients_result = $stmt->get_result();
        $stmt->close();
        
        // Populate ingredients array
        while ($row = $ingredients_result->fetch_assoc()) {
            $ingredients[] = $row['name'];
            $ingredientCount++;
        }

        // Fetch instructions for the recipe
        $stmt = $conn->prepare("SELECT step_number, description FROM Instructions WHERE recipe_id = ? ORDER BY step_number");
        $stmt->bind_param("i", $edit_id);
        $stmt->execute();
        $instructions_result = $stmt->get_result();
        $stmt->close();
        
        // Populate instructions array
        while ($row = $instructions_result->fetch_assoc()) {
            $instructions[] = $row['description'];
            $instructionCount++;
        }


    } else {
        echo "Recipe not found or unauthorized.";
        exit();
    }
}

?>

<!-- Edit Recipe Form Container (Hidden by Default) -->
<div id="edit-recipe-container" style="display: <?= isset($_GET['edit_id']) ? 'flex' : 'none' ?>;"> 
    <form method="POST" action="edit-recipe.php" enctype="multipart/form-data">
        <input type="hidden" name="recipe_id" value="<?php echo $recipe['recipe_id']; ?>">
        <label>Recipe Name:</label><br>
        <input type="text" name="name" value="<?php echo $recipe['r_name']; ?>" required>
        <label>Category:</label>
        <select name="category" required class="cat">
            <option value="breakfast" <?= ($recipe['category'] ?? '') == 'breakfast' ? 'selected' : '' ?>>Breakfast</option>
            <option value="lunch" <?= ($recipe['category'] ?? '') == 'lunch' ? 'selected' : '' ?>>Lunch</option>
            <option value="dinner" <?= ($recipe['category'] ?? '') == 'dinner' ? 'selected' : '' ?>>Dinner</option>
            <option value="snacks" <?= ($recipe['category'] ?? '') == 'snacks' ? 'selected' : '' ?>>Snacks</option>
            <option value="dessert" <?= ($recipe['category'] ?? '') == 'dessert' ? 'selected' : '' ?>>Dessert</option>
        </select><br>
        <label>Description:</label><br>
        <textarea name="description" required class="description"><?= htmlspecialchars($recipe['description'] ?? '') ?></textarea>
        <label>Difficulty:</label>
        <select name="difficulty" required class="diff">
            <option value="easy" <?= ($recipe['difficulty'] ?? '') == 'easy' ? 'selected' : '' ?>>Easy</option>
            <option value="medium" <?= ($recipe['difficulty'] ?? '') == 'medium' ? 'selected' : '' ?>>Medium</option>
            <option value="hard" <?= ($recipe['difficulty'] ?? '') == 'hard' ? 'selected' : '' ?>>Hard</option>
        </select><br>
        <div class="time-input">
            <label>Time Required:</label>
            <input type="number" name="time" min="1" required value="<?= htmlspecialchars($recipe['time'] ?? '') ?>">
            <span>mins</span>
        </div>
        <!-- Ingredients -->
        <label>Ingredients:</label>
        <div id="ingredients-container-edit">
            <?php if (!empty($ingredients)): ?>
                <?php foreach ($ingredients as $ingredient): ?>
                    <div class="ingredient">
                        <input type="text" name="ingredients[]" value="<?= htmlspecialchars($ingredient) ?>" required>
                        <span class="remove-ingredient">×</span> <!-- "x" icon -->
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="ingredient"><input type="text" name="ingredients[]" placeholder="Enter ingredient" required></div>
                <span class="remove-ingredient">×</span> <!-- "x" icon -->
                <?php endif; ?>
        </div>
        <button type="button" id="edit-ingredient">+ Add Ingredient</button>
        <!-- Instructions -->
        <label>Instructions:</label>
        <div id="instructions-container-edit">
            <?php if (!empty($instructions)): ?>
                <?php foreach ($instructions as $index => $instruction): ?>
                    <div class="instruction">
                        <input type="text" name="instructions[]" value="<?= htmlspecialchars($instruction) ?>" required>
                        <span class="remove-instruction">×</span> <!-- "x" icon -->
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="instruction"><input type="text" name="instructions[]" placeholder="Step 1" required>
                <span class="remove-instruction">×</span> <!-- "x" icon -->
            </div>
            <?php endif; ?>
        </div>
        <button type="button" id="edit-instruction">+ Add Step</button>
        <div class="file-container">
            <label>Upload Image:</label>
            <input type="file" name="image" accept=".jpg, .jpeg, .png"  value="<?php $recipe['image']?>">
        </div>
        <button type="submit">Save</button>
        <button type="button" id="cancel-edit-recipe">Cancel</button>
    </form>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const recipeListContainer = document.getElementById("recipe-list-container");
    const editRecipeContainer = document.getElementById("edit-recipe-container");
    
     // Function to get URL parameters
     function getUrlParam(param) {
        const urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(param);
    }

    // Check if edit_id exists in the URL
    if (getUrlParam("edit_id")) {
        recipeListContainer.style.display = "none";
        editRecipeContainer.style.display = "flex";
    }
    
    
    let ingredientCount = <?php echo $ingredientCount; ?>;
    let instructionCount = <?php echo $instructionCount; ?>;
    // Add ingredient functionality
    document.getElementById("edit-ingredient").addEventListener("click", function () {
        console.log("Add Ingredient button clicked");
        ingredientCount++;  // Increment ingredient count
        
        // Get the ingredients container
        let ingredientContainer = document.getElementById("ingredients-container-edit");

        // Create new ingredient input and append it to the container
        let newIngredient = document.createElement("div");
        newIngredient.classList.add("ingredient");
        newIngredient.innerHTML = `<input type="text" name="ingredients[]" placeholder="Enter ingredient ${ingredientCount}" required>`;
        ingredientContainer.appendChild(newIngredient);
    });

    // Add instruction functionality
    document.getElementById("edit-instruction").addEventListener("click", function () {
        instructionCount++;  // Increment instruction count
        
        // Get the instructions container
        let instructionContainer = document.getElementById("instructions-container-edit");

        // Create new instruction input and append it to the container
        let newInstruction = document.createElement("div");
        newInstruction.classList.add("instruction");
        newInstruction.innerHTML = `<input type="text" name="instructions[]" placeholder="Step ${instructionCount}" required>`;
        instructionContainer.appendChild(newInstruction);
    });

    // Cancel button to go back to the recipes page
    const cancelEditRecipeBtn = document.getElementById("cancel-edit-recipe");
    if (cancelEditRecipeBtn) {
        cancelEditRecipeBtn.addEventListener("click", function () {
            window.location.href = "myrecipes.php"; // Redirect to recipe list page
        });
    }
});
</script>

    <script src="/PrepPal/scripts/userscripts/myrecipe.js"></script>
    <script src="/PrepPal/scripts/userscripts/userpage.js"></script>
</body>
</html>