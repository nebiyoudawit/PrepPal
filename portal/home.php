<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PrepPal</title>
  <link rel="stylesheet" href="../styles/home.css">
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
    <?php include 'userpage.php'; ?>
    <main class="main-content">
      <section class="recipes">
        <div class="section-header">
          <h2>Recommend Recipes</h2>
        </div>
        <div class="recipe-cards">
          <!-- Example card -->
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
          <!-- Repeat as needed -->
        </div>
      </section>
      <section class="recipes">
        <div class="section-header">
          <h2>Trending Recipes</h2>
        </div>
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
  </div>
  <script src="https://cdn.lordicon.com/lordicon.js"></script>
</body>
</html>
