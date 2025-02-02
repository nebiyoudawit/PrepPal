<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PrepPal SignUp</title>
    <link rel="icons" href="./imgs/Copy_of_PrepPal__2_-removebg-preview.png" />
    <link rel="stylesheet" href="./styles/signupPage.css" />
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
    <div class="image-section"></div>
    <div class="container">
      <div class="form-section">
        <h1>Create Account</h1>
        <form>
          <div class="form-group profile">
            <div class="icon-container" id="icon-container">
              <lord-icon
                src="https://cdn.lordicon.com/hrjifpbq.json"
                trigger="in"
                delay="500"
                state="in-account"
                colors="primary:#794628"
                style="width: 100px; height: 100px"
              >
              </lord-icon>
            </div>
            <input type="file" id="profile-input" accept="image/*" />
            <span class="profile-info">Upload Profile Picture</span>
            <div class="image-preview" id="image-preview"></div>
          </div>
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
            <label for="email">Enter Your Email</label>
            <input
              type="email"
              id="password"
              placeholder="Enter Your Email"
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
            <button class="sign-up-btn" type="submit">Create Account</button>
          </div>
        </form>
        <div class="log-in-link">
            Already have an account?<a href="loginpage.html">Log in</a>
        </div>
      </div>
    </div>
    <script src="https://cdn.lordicon.com/lordicon.js"></script>
    <script src="/scripts/signup-page.js"></script>
  </body>
</html>
