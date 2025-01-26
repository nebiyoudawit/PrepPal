<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PrepPal Login</title>
    <link rel="icons" href="./imgs/Copy_of_PrepPal__2_-removebg-preview.png" />
    <link rel="stylesheet" href="./styles/loginpage.css" />
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
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Luckiest+Guy&display=swap"
      rel="stylesheet"
    />
  </head>
  <body>
    <a href="index.php"
      ><img
        src="./imgs/Copy_of_PrepPal-removebg-preview.png"
        width="90"
        height="80"
        alt="PrepPal Logo"
        class="logo"
      />
    </a>
    <div class="container">
      <div class="form-section">
        <h1>WELCOME BACK</h1>
        <p>
          Log in to access your recipe collection and<br />discover new
          favorites.
        </p>
        <form>
          <div class="form-group">
            <label for="username">UserName</label>
            <input
              type="text"
              id="username"
              placeholder="Enter Your User Name"
              required
            />
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input
              type="password"
              id="password"
              placeholder="Enter Your Password"
              required
            />
          </div>
          <div class="button-wrapper">
            <button class="sign-in-btn" type="submit">Sign in</button>
          </div>
        </form>
        <div class="sign-up-link">
          Don't have an account? <a href="signuppage.php">Sign up for free!</a>
        </div>
      </div>
    </div>
    <div class="image-section"></div>
  </body>
</html>
