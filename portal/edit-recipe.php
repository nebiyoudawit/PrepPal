<?php
include 'userpage.php';

if (!isset($_SESSION['user_id'])) {
    die("Unauthorized access.");
}

$user_id = $_SESSION['user_id']; // Get logged-in user's ID

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get recipe ID and data from the form
    $recipe_id = intval($_POST['recipe_id']);
    $name = trim($_POST['name']);
    $category = $_POST['category'];
    $description = trim($_POST['description']);
    $difficulty = $_POST['difficulty'];
    $time = intval($_POST['time']); // Time required in minutes
    $upload_dir = "../uploads/recipe-pictures/";

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image_name = time() . "_" . basename($_FILES['image']['name']); // Unique filename
        $target_file = $upload_dir . $image_name;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        // Validate image type
        $allowed_types = ['jpg', 'jpeg', 'png'];
        if (in_array($imageFileType, $allowed_types)) {
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                $image = $image_name; // Save image filename
            } else {
                echo "Error moving uploaded file.";
            }
        } else {
            echo "Invalid file type. Only JPG, JPEG, and PNG allowed.";
        }
    }

    // Update recipe in the Recipes table
    $sql = "UPDATE Recipes SET r_name = ?, image = ?, description = ?, category = ?, difficulty = ?, time = ? WHERE recipe_id = ? AND user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssiii", $name, $image, $description, $category, $difficulty, $time, $recipe_id, $user_id);

    if ($stmt->execute()) {
        // Delete old ingredients and instructions
        $conn->query("DELETE FROM Ingredients WHERE recipe_id = $recipe_id");
        $conn->query("DELETE FROM Instructions WHERE recipe_id = $recipe_id");

        // Insert new ingredients
        if (!empty($_POST['ingredients'])) {
            $sql_ing = "INSERT INTO Ingredients (recipe_id, name) VALUES (?, ?)";
            $stmt_ing = $conn->prepare($sql_ing);
            foreach ($_POST['ingredients'] as $ingredient) {
                $trimmed_ingredient = trim($ingredient);
                $stmt_ing->bind_param("is", $recipe_id, $trimmed_ingredient);
                $stmt_ing->execute();
            }
        }

        // Insert new instructions
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
?>

