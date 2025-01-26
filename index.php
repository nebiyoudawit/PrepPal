<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PrepPal</title>
    <link rel="icons" href="./imgs/Copy_of_PrepPal__2_-removebg-preview.png" />
    <link rel="stylesheet" href="./styles/landingPage.css" />
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
    <!-- Header Section -->
    <header>
      <a href="index.php"
         ><img
          src="imgs/Copy_of_PrepPal-removebg-preview.png"
          alt="logo"
          width="90"
          height="80"
          class="logo"
      /></a>
      <nav class="navbar">
        <ul>
          <li><a href="#home">HOME</a></li>
          <li><a href="#recipes">RECIPES</a></li>
          <li><a href="#features">FEATURES</a></li>
          <li><a href="#contact">CONTACT US</a></li>
          <li><a href="loginpage.php" class="login-btn">LOGIN</a></li>
          <li><a href="signuppage.php" class="signup-btn">SIGN UP</a></li>
        </ul>
      </nav>
    </header>

    <!-- Hero Section -->
    <section class="hero-section">
      <div class="hero-img" id="home">
        <img
          src="./imgs/Ellipse 1 (1).png"
          alt="food"
          class="circle-food"
          width="425"
          height="425"
        />
        <img
          src="./imgs/Ellipse 19.png"
          alt="background circle"
          class="back-col"
          width="255"
          height="475"
        />
        <img
          src="./imgs/Rectangle 12.png"
          alt="hero-img"
          class="main-b"
          style="display: block"
        />
      </div>
      <div class="hero-text">
        <h1 class="fade-in">Discover Recipes,<br />Delight Your Taste Buds</h1>
        <p class="header-description fade-in">
          Find recipes you’ll love, organize your favorites,<br />
          and make every meal unforgettable.
        </p>
        <a href="loginpage.php" class="browse-recipes-btn">
          Browse recipes <i class="fa-solid fa-chevron-right"></i>
        </a>
      </div>
    </section>
    <!-- Recipes Section -->
    <section class="recipe-section" id="recipes">
      <div class="recipe-text">
        <h2 class="fade-in">Popular Recipes</h2>
        <p class="fade-in">
          Check out the most loved recipes from our community! These dishes are
          tried, tested, and adored by food enthusiasts just like you. Find your
          next favorite recipe and join the conversation!
        </p>
      </div>
      <div class="carousel-container fade-in">
        <div class="carousel">
          <div class="carousel-item" id="item1">
            <a href="loginpage.php">
            <div class="card">
              <img src="imgs/Delectable Flan Dessert.jpeg" alt="Classic Flan" />
              <div class="card-details">
                <span class="category">Dessert</span>
                <div class="likes-time">
                  <span class="time"
                    ><i class="fa-regular fa-clock"></i> 1.5 hrs</span
                  >
                  <span class="likes"
                    ><i class="fa-regular fa-heart"></i> 300</span
                  >
                </div>
              </div>
              <h3 class="title">Classic Flan</h3>
              <span class="desc-title">Description</span>
              <p class="description">
                A smooth and creamy custard dessert with a rich caramel sauce on
                top, perfect for any special occasion or sweet craving.
              </p>
            </div>
          </div>
        </a>
          <div class="carousel-item" id="item2">
            <a href="loginpage.php">
            <div class="card">
              <img src="imgs/Best-Ethiopian-Food.jpg" alt="Bey'aynet" />
              <div class="card-details">
                <span class="category">Dinner</span>
                <div class="likes-time">
                  <span class="time"
                    ><i class="fa-regular fa-clock"></i>1 hr</span
                  >
                  <span class="likes"
                    ><i class="fa-regular fa-heart"></i>250</span
                  >
                </div>
              </div>
              <h3 class="title">Bey'aynet</h3>
              <span class="desc-title">Description</span>
              <p class="description">
                It's a vegetarian platter featuring a variety of different
                stews, lentils, and vegetables served atop injera.
              </p>
            </div>
            </a>
          </div>
          <div class="carousel-item" id="item3">
            <a href="loginpage.php">
            <div class="card">
              <img src="imgs/Rustic Bowl of Soup.jpeg" alt="Creamy Vegetable" />
              <div class="card-details">
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
              <h3 class="title">Creamy Vegetable</h3>
              <span class="desc-title">Description</span>
              <p class="description">
                A hearty and nutritious soup featuring a creamy base, chunks of
                fresh vegetables, and garnished with slices of cucumber and a
                dollop of sour cream or yogurt.
              </p>
            </div>
            </a>
          </div>
        </div>
        <!-- Arrow buttons -->
        <button class="arrow left-arrow" id="prevBtn">&#10094;</button>
        <button class="arrow right-arrow" id="nextBtn">&#10095;</button>
      </div>
    </section>
    <section class="stat-section">
      <div class="stat-data">
        <div class="data-holder">
          <lord-icon
            src="https://cdn.lordicon.com/qhkvfxpn.json"
            trigger="loop"
            delay="1000"
            colors="primary:#99755c"
            style="width: 60px; height: 80px"
          >
          </lord-icon>
          <div class="stat-desc">
            <span class="stat-num">89</span>
            <span class="fade-in">New Recipes Daily</span>
          </div>
        </div>
        <div class="data-holder mid">
          <lord-icon
            src="https://cdn.lordicon.com/flydzqpr.json"
            trigger="loop"
            stroke="bold"
            colors="primary:#e4e4e4,secondary:#ebe6ef,tertiary:#99755c"
            style="width: 80px; height: 80px"
          >
          </lord-icon>
          <div class="stat-desc">
            <span class="stat-num">1000</span>
            <span class="fade-in">Premium Recipes</span>
          </div>
        </div>
        <div class="data-holder bot">
          <lord-icon
            src="https://cdn.lordicon.com/mwhabkof.json"
            trigger="loop"
            stroke="bold"
            state="hover-wave"
            colors="primary:#121331,secondary:#f9c9c0,tertiary:#99755c,quaternary:#0000,quinary:#ebe6ef"
            style="width: 80px; height: 80px"
          >
          </lord-icon>
          <div class="stat-desc">
            <span class="stat-num">400</span>
            <span class="fade-in">Active Users</span>
          </div>
        </div>
      </div>
      <div class="stat-text">
        <h2 class="fade-in">A Growing Recipe Community You’ll Love!</h2>
        <p class="fade-in">
          Join thousands of food enthusiasts sharing and exploring incredible
          recipes every day.
        </p>
      </div>
    </section>
    <!--Features Section-->
    <section class="features-section" id="features">
      <h2 style="text-align: center" class="fade-in">Why Choose PrepPal?</h2>
      <div class="f-container">
        <div class="features">
          <lord-icon
            src="https://cdn.lordicon.com/kkvxgpti.json"
            trigger="loop"
            delay="500"
            state="in-search"
            colors="primary:#2c3e50"
            style="width: 100px; height: 100px"
            class="fade-in"
            >
          </lord-icon>
          <span>Browse Recipes</span>
          <p class="fade-in">
            Search, filter, and explore a variety of recipes from different
            cuisines.
          </p>
        </div>
        <div class="features">
          <lord-icon
            src="https://cdn.lordicon.com/njrwmskv.json"
            trigger="loop"
            delay="0"
            stroke="bold"
            state="in-calm"
            colors="primary:#e4e4e4,secondary:#f24c00,tertiary:#ffc738"
            style="width: 100px; height: 100px"
            class="fade-in"
            >
          </lord-icon>
          <span>Add Your Own Recipes</span>
          <p class="fade-in">
            Become a contributor and add your favorite recipes to our library.
          </p>
        </div>
        <div class="features">
          <lord-icon
            src="https://cdn.lordicon.com/oaazmevq.json"
            trigger="loop"
            delay="500"
            stroke="bold"
            state="in-reveal"
            colors="primary:#e4e4e4,secondary:#ebe6ef,tertiary:#2c3e50,quaternary:#a66037,quinary:#2c3e50,senary:#2c3e50,septenary:#f9c9c0,octonary:#f24c00"
            style="width: 100px; height: 100px"
            class="fade-in"
            >
          </lord-icon>
          <span>Save & Organize</span>
          <p class="fade-in">Create your own collection by saving your favorite recipes.</p>
        </div>
      </div>
    </section>
    <section class="last-cta">
        <div class="cta-description">
          <h2 class="fade-in">Your Recipe Adventure Awaits!</h2>
          <p class="fade-in">Sign up to unlock a world of delicious recipes, save your favorites, and share your own culinary creations.</p>
          <a class="last-cta-btn fade-in" href="signuppage.php">GET STARTED</a>
        </div>
        <img src="./imgs/2.png" alt="backgroundimg" class="back-col2">
        <img src="./imgs/e3.png" alt="" class="circle-food2 fade-in">
    </section>
    <!--footer-->
    <footer id="contact">
      <img
          src="./imgs/Copy_of_PrepPal__4_-removebg-preview.png"
          alt="logo"
          width="90"
          height="80"
          class="logo"
      />
      <div class="foot-texts">
        <p>Discover the ultimate recipe library, where food lovers come together to explore, save, and share delicious creations.</p>
        <div class="subscribe-sec">
          <span>Subscribe to stay tuned for new recipes and latest updates.</span>
          <input type="email" placeholder="example@gmail.com">
          <a class="subscribe-btn">Subscribe</a>
        </div>
        <div class="contact-sec">
          <span>CONTACT US</span>
          <span>0918739281</span>
          <span>preppal_support@gamil.com</span>
        </div>
      </div>
      <hr>
      <span style="text-align: center; color: white">©2025 All Rights Reserved</span>
    </footer>
    <script src="./scripts/landing-page.js"></script>
    <script src="https://cdn.lordicon.com/lordicon.js"></script>
  </body>
</html>
