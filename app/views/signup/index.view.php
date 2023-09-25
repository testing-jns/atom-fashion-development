<?php 
use \middlewares\GoogleAuth; 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Atom | Sign Up</title>

    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/account/sign-up-in.css" />
    <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"
    ></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
  </head>
  <body>
    <div class="container sign-up-mode">
      <div class="forms-container">
        <div class="signin-signup">
          <form action="" method="POST" class="sign-up-form">
            <h2 class="title">Sign Up</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" class="first_name" name="first_name" placeholder="First Name" />
            </div>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" class="last_name" name="last_name" placeholder="Last Name" />
            </div>
            <div class="input-field">
              <i class="fas fa-envelope"></i>
              <input type="email" class="email" name="email" placeholder="Email" />
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" class="password" name="password" placeholder="Password" />
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" class="confirm_password" name="confirm_password" placeholder="Confirm Password" />
            </div>
            
            <div class="g-recaptcha" data-sitekey="<?= GOOLE_RECAPTCHA_SITE_KEY ?>"></div>
            
            <button type="submit" class="btn">Sign Up</button>
            <p class="social-text">Or Sign Up with social platforms</p>
            <div class="social-media">
              <!-- <a href="#" class="social-icon">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-twitter"></i>
              </a> -->
              <a href="<?= GoogleAuth::getAuthUrl(); ?>" class="social-icon">
                <i class="fab fa-google"></i>
              </a>
              <!-- <a href="#" class="social-icon">
                <i class="fab fa-linkedin-in"></i>
              </a> -->
            </div>
          </form>
        </div>
      </div>

      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <h3>New here ?</h3>
            <p>
              Lorem ipsum, dolor sit amet consectetur adipisicing elit. Debitis,
              ex ratione. Aliquid!
            </p>
            <button class="btn transparent" id="sign-up-btn">
              Sign Up
            </button>
          </div>
          <img src="<?= BASE_URL ?>assets/img/account/log.svg" class="image" alt="" />
        </div>
        <div class="panel right-panel">
          <div class="content">
            <h3>One of us ?</h3>
            <p>
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum
              laboriosam ad deleniti.
            </p>
            <button class="btn transparent" id="sign-in-btn" onclick="location.href = '/login'">
              Sign In
            </button>
          </div>
          <img src="<?= BASE_URL ?>assets/img/account/register.svg" class="image" alt="" />
        </div>
      </div>
    </div>

    <div class="google-auth-response" data-action="<?= $view_data["meta"]["action"] ?? ''; ?>" data-success="<?= json_encode($view_data["result"]["success"] ?? ''); ?>"></div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="<?= BASE_URL ?>assets/js/account/signup.js"></script>
  </body>
</html>
