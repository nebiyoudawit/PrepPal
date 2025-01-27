<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyRecipes</title>
    <link rel="stylesheet" href="../styles/myrec.css">
</head>
<body>
    <?php include 'userpage.php'; ?>
    <div class="search-container">
         <i class="fa fa-search"></i>
         <input type="text" placeholder="Search for recipes" class="search-bar">
    </div>
    <span class="add-recipe"><i class="fa fa-plus"></i>Add</span>
    <section class="recipes">
    <div class="recipe-cards">
    <div class="recipe-card">
            <img src="../imgs/Rustic Bowl of Soup.jpeg" alt="Classic Flan">
            <div class="recipe-card-header">
              <span class="category">Lunch</span>
            <div class="likes-time">
                  <span class="time"
                    ><i class="fa-regular fa-clock"></i> 1.5 hrs</span
                  >
                  <span class="likes"
                    ><i class="fa-regular fa-heart"></i> 300</span
                  >
                  <span class="views"
                    ><i class="fa-regular fa-eye"></i> 500</span>
                </div>
            </div>
            <h3>Classic Flan</h3>
      <p>This is a classic dessert made with a caramelized sugar topping. It's delicious and smooth!</p>
            <div class="recipe-card-footer">
            <span class="edit-recipe"><i class="fa fa-edit"></i> Edit</span>
            <span class="delete-recipe"><i class="fa fa-trash"></i> Delete</span>
          </div>
        </div>    
</section>  
</body>
</html>