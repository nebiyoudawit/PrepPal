<!DOCTYPE html>
< lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipes</title>
    <link rel="stylesheet" href="../styles/recipes.css">
</head>
    <?php include 'userpage.php'; ?>
    <div class="search-container">
         <i class="fa fa-search"></i>
         <input type="text" placeholder="Search for recipes" class="search-bar">
    </div>
    <div class="search-category">
        <span class="breakfast">Breakfast</span>
        <span class="lunch">Lunch</span>
        <span class="dinner">Dinner</span>
        <span class="dessert">Dessert</span>
        <span class="snack">Snacks</span>
    </div>
    <h2>Recipes</h2>
<section class="search-result">
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
                </div>
            </div>
            <h3>Classic Flan</h3>
      <p>This is a classic dessert made with a caramelized sugar topping. It's delicious and smooth!</p>
            <div class="recipe-card-footer">
            <p class="author">by <strong>usermedia</strong></p>
            <div class="diff-cont">
            <lord-icon
    src="https://cdn.lordicon.com/xjsqfzte.json"
    trigger="in"
    delay="1500"
    state="in-reveal"
    colors="primary:#121331,secondary:#848484"
    style="width:30px;height:30px">
</lord-icon>
            <span class="dificulty">
            Expert</span>
</div>
            </div>
          </div>
        </div>
</section>
</main>
</body>
</html>