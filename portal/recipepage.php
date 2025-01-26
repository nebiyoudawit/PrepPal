<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PrepPal Recipe</title>
    <link rel="icons" href="/imgs/Copy_of_PrepPal__2_-removebg-preview.png" />
    <link rel="stylesheet" href="../styles/recipePage.css" />
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
        <img
          src="../imgs/Copy_of_PrepPal-removebg-preview.png"
          alt="logo"
          width="80"
          height="70"
          class="logo"
        />
      </div>
      <nav>
        <a href="#">Home</a>
        <a href="#">Profile</a>
        <a href="#">MyRecipes</a>
        <a href="#">Saved</a>
      </nav>
      <div class="profile-icon"></div>
    </header>
    <main class="recipe-detail">
      <div class="recipe-card">
        <img
          src="../imgs/Best-Ethiopian-Food.jpg"
          alt="Recipeimage"
          class="recipe-image"
        />
        <div class="recipe-info">
          <div class="recipe-card-header">
            <h1>Bey'aynet</h1>
            <div class="stats">
              <div class="likes stat-container">
                <lord-icon
                  src="https://cdn.lordicon.com/rqfqhnxq.json"
                  trigger="hover"
                  stroke="light"
                  colors="primary:#c71f16,secondary:#c71f16,tertiary:#ffc738,quaternary:#fad3d1,quinary:#f24c00,senary:#ebe6ef"
                  style="width: 40px; height: 40px"
                  class="liked-state"
                >
                </lord-icon>
                <lord-icon
                  src="https://cdn.lordicon.com/rqfqhnxq.json"
                  trigger="hover"
                  stroke="light"
                  colors="primary:#ffffff,secondary:#e4e4e4,tertiary:#ffc738,quaternary:#fad3d1,quinary:#f24c00,senary:#ebe6ef"
                  style="width: 40px; height: 40px"
                  class="notliked-state"
                >
                </lord-icon>
                <span>300</span>
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
                <span>1.5hrs</span>
              </div>
              <div class="saves">
                <lord-icon
                  src="https://cdn.lordicon.com/prjooket.json"
                  trigger="hover"
                  colors="primary:#913710"
                  style="width: 40px; height: 40px"
                  class="notsaved-state"
                >
                </lord-icon>
                <lord-icon
                  src="https://cdn.lordicon.com/oiiqgosg.json"
                  trigger="hover"
                  colors="primary:#913710"
                  style="width: 40px; height: 40px"
                  class="saved-state"
                >
                </lord-icon>
                <span>Save</span>
              </div>
            </div>
          </div>
          <div class="tags">
            <span class="type">Dinner</span>
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
              <span class="skill">Expert</span>
            </div>
          </div>
          <p class="description">
            It's a vegetarian platter featuring a variety of different stews,
            lentils, and vegetables served atop injera.
          </p>
          <h2>Ingredients</h2>
          <ul class="ingredients">
            <li>2-3 large eggs</li>
            <li>Salt, to taste</li>
            <li>Pepper, to taste</li>
            <li>1 tablespoon of butter or oil</li>
            <li>
              Optional fillings: cheese, diced vegetables, cooked meats, herbs
            </li>
          </ul>
          <h2>Instructions</h2>
          <ol class="instructions">
            <li>
              Beat the eggs: In a bowl, beat the eggs with a pinch of salt and
              pepper until they are well mixed. You can add a tablespoon of
              water or milk for a fluffier texture.
            </li>
            <li>
              Heat the pan: Place a non-stick frying pan over medium heat and
              add butter or oil.
            </li>
            <li>
              Cook the omelette: Once the butter is melted and bubbling, pour in
              the eggs. Tilt the pan to ensure the eggs evenly coat the surface.
            </li>
            <li>
              Add fillings (optional): When the eggs begin to set at the edges
              but are still slightly runny in the middle, sprinkle your chosen
              fillings over one half of the omelette.
            </li>
            <li>
              Fold and serve: As the omelette continues to cook, carefully lift
              one edge and fold it over the fillings. Let it cook for another
              minute, then slide it onto a plate.
            </li>
          </ol>
          <h2>Notes and Tips</h2>
          <p>
            For a classic French omelette, cook the eggs quickly over high heat
            and fold them into a tight roll. For a softer, creamier omelette,
            cook them more slowly over low heat.
          </p>
        </div>
      </div>
      <div class="reviews-section">
        <h2>Reviews</h2>
        <div class="add-review">
          <textarea placeholder="Add your review..."></textarea>
          <button>Submit</button>
        </div>
        <div class="review">
          <div class="profile-pic"></div>
            <strong>Ralph Edwards</strong>
            <span class="date">Aug 19, 2021</span>
          <p>
            In mauris porttitor tincidunt mauris massa sit lorem sed
            scelerisque...
          </p>
        </div>
        <a href="#" class="see-more">See 10 more comments</a>
      </div>
    </main>
    <script src="https://cdn.lordicon.com/lordicon.js"></script>
    <script src="../scripts/recipepage.js"></script>
  </body>
</html>
