<?php
include 'userpage.php';

// Fetch trending recipes with the author's username
$sql = "SELECT Recipes.*, Users.name 
        FROM Recipes 
        JOIN Users ON Recipes.user_id = Users.user_id 
        ORDER BY Recipes.likes DESC 
        LIMIT 3";
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
  <title>PrepPal</title>
  <link rel="stylesheet" href="/PrepPal/styles/userstyles/home.css">
  <link rel="icons" href="./imgs/Copy_of_PrepPal__2_-removebg-preview.png" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet"
  />
  <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    rel="stylesheet"
  />
</head>
<body>
  <h2 class="title">Trending Recipes</h2>
  <main class="main-content">
    <?php while ($recipe = mysqli_fetch_assoc($result)): ?>
      <div class="recipe-card">
      <a href="recipepage.php?id=<?= $recipe['recipe_id'] ?>">
          <img src="/PrepPal/uploads/recipe-pictures/<?php echo $recipe['image']; ?>" alt="<?php echo $recipe['name']; ?>">
          <div class="recipe-card-header">
            <span class="category"><?php echo $recipe['category']; ?></span>
            <div class="likes-time">
              <span class="time">
                <i class="fa-regular fa-clock"></i> <?php echo $recipe['time']; ?> mins
              </span>
              <span class="likes">
                <i class="fa-regular fa-heart"></i> <?php echo $recipe['likes']; ?>
              </span>
            </div>
          </div>
          <h3><?php echo $recipe['r_name']; ?></h3>
          <div class="desc">
            <p><?php echo $recipe['description']; ?></p>
          </div>
          <div class="recipe-card-footer">
            <p class="author">by <strong><?php echo $recipe['name']; ?></strong></p>  <!-- FIXED AUTHOR -->
            <div class="diff-cont">
              <lord-icon
                src="https://cdn.lordicon.com/xjsqfzte.json"
                trigger="in"
                delay="1500"
                state="in-reveal"
                colors="primary:#121331,secondary:#848484"
                style="width:30px;height:30px">
              </lord-icon>
              <span class="dificulty"><?php echo $recipe['difficulty']; ?></span>
            </div>
          </div>
          </a>
      </div>
    <?php endwhile; ?>
  </main>
  <script src="https://cdn.lordicon.com/lordicon.js"></script>
</body>
</html>
