<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PrepPal</title>
  <link rel="stylesheet" href="../styles/userpage.css">
  <link rel="icons" href="./imgs/Copy_of_PrepPal__2_-removebg-preview.png" />
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
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Galindo&display=swap"
      rel="stylesheet"
    />
</head>
<body>
  <div class="container">
  <?php
  // Get the current file name
  $current_page = basename($_SERVER['PHP_SELF']);
?>

<aside class="sidebar">
  <div class="logo">
    <img src="../imgs/Copy_of_PrepPal-removebg-preview.png" alt="PrepPal Logo">
  </div>
  <nav>
    <ul>
      <li class="<?= $current_page == 'home.php' ? 'active' : '' ?>"><a href="home.php" >Home</a></li>
      <li class="<?= $current_page == 'recipes.php' ? 'active' : '' ?>"><a href="recipes.php">Recipes</a></li>
      <li class="<?= $current_page == 'myrecipes.php' ? 'active' : '' ?>"><a href="myrecipes.php">My Recipes</a></li>
      <li class="<?= $current_page == 'saved.php' ? 'active' : '' ?>"><a href="saved.php">Saved</a></li>
      <li class="<?= $current_page == 'logout.php' ? 'active' : '' ?>"><a href="logout.php">Logout</a></li>
    </ul>
  </nav>
</aside> 
    <header>
        <h1>Hello, Nebiyou_D</h1>
        <div class="profile">
          <img src="profile.jpg" alt="Profile Picture">
          <span>Nebiyou_D</span>
        </div>
      </header>
    <hr>
  </body>
</html>
