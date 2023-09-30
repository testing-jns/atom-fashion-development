<?php
use \middlewares\GoogleAuth;


use core\Database;

$db = new Database();

$sql = "SELECT count(category) as total, category FROM products GROUP BY category";
$response = $db->query($sql)->execute();
$category_list = $response->resultAll();


$sql = "SELECT code, `name`, category, price, discount, rating, thumbnail_id FROM products ORDER BY code ASC LIMIT 24";
$response = $db->query($sql)->execute();
$all_products = $response->resultAll();


function toRupiah($price)
{
  if (strlen($price) <= 6) {
    return "Rp. " . substr_replace($price, "", -3) . "K";
  }

  $price = intval(substr_replace($price, "", -4)) / 100;
  return "Rp. " . $price . "jt";
}


function getProductImage($thumbnail_id, $multi_images = null)
{
  $db = new Database();
  $sql = "SELECT `image` FROM thumbnails WHERE id = '$thumbnail_id'";
  $product_image = $db->query($sql)->execute();
  if ($multi_images)
    return $product_image->resultAll();
  return $product_image->result()->image;
}

function getDiscount($price, $discount)
{
  if ($discount === 0)
    return $price;
  return $price - ($price / $discount);
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Atom - eCommerce Website</title>

  <!--
    - favicon
  -->
  <link rel="shortcut icon" href="<?= BASE_URL ?>assets/img/home/logo/favicon.ico" type="image/x-icon">

  <!--
    - custom css link
  -->
  <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/products/detail/style.css">

  <!--
    - google font link
  -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
    rel="stylesheet">
  <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

  <!-- <style>
.slider-item {
  
}


</style> -->

</head>

<body>
  <div class="overlay" data-overlay></div>

  <!--
    - HEADER
  -->

  <header>
    <div class="header-main">

      <div class="container">

        <a href="<?= BASE_URL ?>" class="header-logo">
          <img loading="lazy" src="<?= BASE_URL ?>assets/img/home/logo/logo.svg" alt="Atom's logo" width="120"
            height="36">
        </a>

        <div class="header-search-container">

          <input type="search" name="search" class="search-field" placeholder="Enter your product name...">

          <button class="search-btn">
            <ion-icon name="search-outline"></ion-icon>
          </button>

        </div>

        <div class="header-user-actions">

          <!-- <button class="trigger_popup">Let me Pop up</button> -->


          <!-- tambahin quick_login kalo user blm login -->
          <button class="action-btn"
            onclick="<?= $view_data["results"]["success"] ? "location.href = " . BASE_URL . "'/user/wishlist'" : "quick_login()"; ?>">
            <i class="bi bi-heart"></i>
            <?php if ($view_data["results"]["success"]): ?>
              <span class="count">0</span>
            <?php endif; ?>
          </button>

          <button class="action-btn"
            onclick="<?= $view_data["results"]["success"] ? "location.href = " . BASE_URL . "'/user/cart'" : "quick_login()"; ?>">
            <i class="bi bi-cart"></i>
            <?php if ($view_data["results"]["success"]): ?>
              <span class="count">0</span>
            <?php endif; ?>
          </button>

          <button class="action-btn" onclick="location.href = '<?= BASE_URL ?>user/settings'">
            <?php if (!empty($view_data["results"]["picture"])): ?>
              <img src="<?= BASE_URL . "assets/img/users/" . $view_data["results"]["picture"]; ?>" width="45"
                style="border-radius: 100%;">
            <?php else: ?>
              <i class="bi bi-person-circle"></i>
            <?php endif; ?>
          </button>

        </div>

      </div>

    </div>

    <nav class="desktop-navigation-menu">

      <div class="container">

        <ul class="desktop-menu-category-list">

          <li class="menu-category">
            <a href="<?= BASE_URL ?>" class="menu-title">Home</a>
          </li>

          <li class="menu-category">
            <a href="<?= BASE_URL ?>"" class=" menu-title">Categories</a>

            <div class="dropdown-panel">
              <ul class="dropdown-panel-list">

                <li class="menu-title">
                  <a href="<?= BASE_URL ?>products">All</a>
                </li>

                <li class="panel-list-item">
                  <a href="<?= BASE_URL ?>products">Formal</a>
                </li>

                <li class="panel-list-item">
                  <a href="<?= BASE_URL ?>products">Casual</a>
                </li>

                <li class="panel-list-item">
                  <a href="<?= BASE_URL ?>products">Sports</a>
                </li>

                <li class="panel-list-item">
                  <a href="<?= BASE_URL ?>products">Jacket</a>
                </li>

                <li class="panel-list-item">
                  <a href="<?= BASE_URL ?>products">Sunglasses</a>
                </li>
                <li>

                </li>
              </ul>

              <ul class="dropdown-panel-list">

                <li class="menu-title">
                  <a href="<?= BASE_URL ?>category/man">Men's</a>
                </li>

                <li class="panel-list-item">
                  <a href="<?= BASE_URL ?>category/man">Formal</a>
                </li>

                <li class="panel-list-item">
                  <a href="<?= BASE_URL ?>category/man">Casual</a>
                </li>

                <li class="panel-list-item">
                  <a href="<?= BASE_URL ?>category/man">Sports</a>
                </li>

                <li class="panel-list-item">
                  <a href="<?= BASE_URL ?>category/man">Jacket</a>
                </li>

                <li class="panel-list-item">
                  <a href="<?= BASE_URL ?>category/man">Sunglasses</a>
                </li>

                <li class="panel-list-item">
                  <a href="<?= BASE_URL ?>category/man">
                    <img loading="lazy" src="<?= BASE_URL ?>assets/img/home/mens-banner.jpg" alt="men's fashion"
                      width="250" height="119">
                  </a>
                </li>

              </ul>

              <ul class="dropdown-panel-list">

                <li class="menu-title">
                  <a href="<?= BASE_URL ?>category/woman">Women's</a>
                </li>

                <li class="panel-list-item">
                  <a href="<?= BASE_URL ?>category/woman">Formal</a>
                </li>

                <li class="panel-list-item">
                  <a href="<?= BASE_URL ?>category/woman">Casual</a>
                </li>

                <li class="panel-list-item">
                  <a href="<?= BASE_URL ?>category/woman">Perfume</a>
                </li>

                <li class="panel-list-item">
                  <a href="<?= BASE_URL ?>category/woman">Cosmetics</a>
                </li>

                <li class="panel-list-item">
                  <a href="<?= BASE_URL ?>category/woman">Bags</a>
                </li>

                <li class="panel-list-item">
                  <a href="<?= BASE_URL ?>category/woman">
                    <img loading="lazy" src="<?= BASE_URL ?>assets/img/home/womens-banner.jpg" alt="women's fashion"
                      width="250" height="119">
                  </a>
                </li>

              </ul>

            </div>
          </li>

          <li class="menu-category">
            <a href="<?= BASE_URL ?>category/man" class="menu-title">Men's</a>

            <ul class="dropdown-list">

              <li class="dropdown-item">
                <a href="<?= BASE_URL ?>category/man">Shirt</a>
              </li>

              <li class="dropdown-item">
                <a href="<?= BASE_URL ?>category/man">Shorts & Jeans</a>
              </li>

              <li class="dropdown-item">
                <a href="<?= BASE_URL ?>category/man">Safety Shoes</a>
              </li>

              <li class="dropdown-item">
                <a href="<?= BASE_URL ?>category/man">Wallet</a>
              </li>

            </ul>
          </li>

          <li class="menu-category">
            <a href="<?= BASE_URL ?>category/woman" class="menu-title">Women's</a>

            <ul class="dropdown-list">

              <li class="dropdown-item">
                <a href="<?= BASE_URL ?>category/woman">Dress & Frock</a>
              </li>

              <li class="dropdown-item">
                <a href="<?= BASE_URL ?>category/woman">Earrings</a>
              </li>

              <li class="dropdown-item">
                <a href="<?= BASE_URL ?>category/woman">Necklace</a>
              </li>

              <li class="dropdown-item">
                <a href="<?= BASE_URL ?>category/woman">Makeup Kit</a>
              </li>

            </ul>
          </li>

          <li class="menu-category">
            <a href="<?= BASE_URL ?>category/accessories" class="menu-title">Accessories</a>

            <ul class="dropdown-list">

              <li class="dropdown-item">
                <a href="<?= BASE_URL ?>category/accessories">Earrings</a>
              </li>

              <li class="dropdown-item">
                <a href="<?= BASE_URL ?>category/accessories">Couple Rings</a>
              </li>

              <li class="dropdown-item">
                <a href="<?= BASE_URL ?>category/accessories">Necklace</a>
              </li>

              <li class="dropdown-item">
                <a href="<?= BASE_URL ?>category/accessories">Bracelets</a>
              </li>

            </ul>
          </li>

          <li class="menu-category">
            <a href="<?= BASE_URL ?>category/perfume" class="menu-title">Perfume</a>

            <ul class="dropdown-list">

              <li class="dropdown-item">
                <a href="<?= BASE_URL ?>category/perfume">Clothes Perfume</a>
              </li>

              <li class="dropdown-item">
                <a href="<?= BASE_URL ?>category/perfume">Deodorant</a>
              </li>

              <li class="dropdown-item">
                <a href="<?= BASE_URL ?>category/perfume">Flower Fragrance</a>
              </li>

              <li class="dropdown-item">
                <a href="<?= BASE_URL ?>category/perfume">Air Freshener</a>
              </li>

            </ul>
          </li>

          <li class="menu-category">
            <a href="<?= BASE_URL ?>blog" class="menu-title">Blog</a>
          </li>

          <li class="menu-category">
            <a href="<?= BASE_URL ?>" class="menu-title">Hot Offers</a>
          </li>

        </ul>

      </div>

    </nav>

    <div class="mobile-bottom-navigation">

      <button class="action-btn" data-mobile-menu-open-btn>
        <ion-icon name="menu-outline"></ion-icon>
      </button>

      <button class="action-btn"
        onclick="<?= $view_data["results"]["success"] ? "location.href = '" . BASE_URL . "/user/cart'" : "quick_login()"; ?>">
        <ion-icon name="bag-handle-outline"></ion-icon>

        <?php if ($view_data["results"]["success"]): ?>
          <span class="count">0</span>
        <?php endif; ?>
      </button>

      <button class="action-btn">
        <ion-icon name="home-outline"></ion-icon>
      </button>

      <button class="action-btn"
        onclick="<?= $view_data["results"]["success"] ? "location.href = '" . BASE_URL . "/user/wishlist'" : "quick_login()"; ?>">
        <ion-icon name="heart-outline"></ion-icon>

        <?php if ($view_data["results"]["success"]): ?>
          <span class="count">0</span>
        <?php endif; ?>
      </button>

      <button class="action-btn" data-mobile-menu-open-btn>
        <ion-icon name="grid-outline"></ion-icon>
      </button>

    </div>

    <nav class="mobile-navigation-menu  has-scrollbar" data-mobile-menu>

      <div class="menu-top">
        <h2 class="menu-title">Menu</h2>

        <button class="menu-close-btn" data-mobile-menu-close-btn>
          <ion-icon name="close-outline"></ion-icon>
        </button>
      </div>

      <ul class="mobile-menu-category-list">

        <li class="menu-category">
          <a href="#" class="menu-title">Home</a>
        </li>

        <li class="menu-category">

          <button class="accordion-menu" data-accordion-btn>
            <p class="menu-title">Men's</p>

            <div>
              <ion-icon name="add-outline" class="add-icon"></ion-icon>
              <ion-icon name="remove-outline" class="remove-icon"></ion-icon>
            </div>
          </button>

          <ul class="submenu-category-list" data-accordion>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Shirt</a>
            </li>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Shorts & Jeans</a>
            </li>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Safety Shoes</a>
            </li>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Wallet</a>
            </li>

          </ul>

        </li>

        <li class="menu-category">

          <button class="accordion-menu" data-accordion-btn>
            <p class="menu-title">Women's</p>

            <div>
              <ion-icon name="add-outline" class="add-icon"></ion-icon>
              <ion-icon name="remove-outline" class="remove-icon"></ion-icon>
            </div>
          </button>

          <ul class="submenu-category-list" data-accordion>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Dress & Frock</a>
            </li>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Earrings</a>
            </li>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Necklace</a>
            </li>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Makeup Kit</a>
            </li>

          </ul>

        </li>

        <li class="menu-category">

          <button class="accordion-menu" data-accordion-btn>
            <p class="menu-title">Accessories</p>

            <div>
              <ion-icon name="add-outline" class="add-icon"></ion-icon>
              <ion-icon name="remove-outline" class="remove-icon"></ion-icon>
            </div>
          </button>

          <ul class="submenu-category-list" data-accordion>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Earrings</a>
            </li>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Couple Rings</a>
            </li>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Necklace</a>
            </li>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Bracelets</a>
            </li>

          </ul>

        </li>

        <li class="menu-category">

          <button class="accordion-menu" data-accordion-btn>
            <p class="menu-title">Perfume</p>

            <div>
              <ion-icon name="add-outline" class="add-icon"></ion-icon>
              <ion-icon name="remove-outline" class="remove-icon"></ion-icon>
            </div>
          </button>

          <ul class="submenu-category-list" data-accordion>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Clothes Perfume</a>
            </li>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Deodorant</a>
            </li>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Flower Fragrance</a>
            </li>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Air Freshener</a>
            </li>

          </ul>

        </li>

        <li class="menu-category">
          <a href="#" class="menu-title">Blog</a>
        </li>

        <li class="menu-category">
          <a href="#" class="menu-title">Hot Offers</a>
        </li>

      </ul>

      <div class="menu-bottom">

        <ul class="menu-category-list">

          <li class="menu-category">

            <button class="accordion-menu" data-accordion-btn>
              <p class="menu-title">Language</p>

              <ion-icon name="caret-back-outline" class="caret-back"></ion-icon>
            </button>

            <ul class="submenu-category-list" data-accordion>

              <li class="submenu-category">
                <a href="#" class="submenu-title">English</a>
              </li>

              <li class="submenu-category">
                <a href="#" class="submenu-title">Espa&ntilde;ol</a>
              </li>

              <li class="submenu-category">
                <a href="#" class="submenu-title">Fren&ccedil;h</a>
              </li>

            </ul>

          </li>

          <li class="menu-category">
            <button class="accordion-menu" data-accordion-btn>
              <p class="menu-title">Currency</p>
              <ion-icon name="caret-back-outline" class="caret-back"></ion-icon>
            </button>

            <ul class="submenu-category-list" data-accordion>
              <li class="submenu-category">
                <a href="#" class="submenu-title">USD &dollar;</a>
              </li>

              <li class="submenu-category">
                <a href="#" class="submenu-title">EUR &euro;</a>
              </li>
            </ul>
          </li>

        </ul>

        <ul class="menu-social-container">

          <li>
            <a href="#" class="social-link">
              <ion-icon name="logo-facebook"></ion-icon>
            </a>
          </li>

          <li>
            <a href="#" class="social-link">
              <ion-icon name="logo-twitter"></ion-icon>
            </a>
          </li>

          <li>
            <a href="#" class="social-link">
              <ion-icon name="logo-instagram"></ion-icon>
            </a>
          </li>

          <li>
            <a href="#" class="social-link">
              <ion-icon name="logo-linkedin"></ion-icon>
            </a>
          </li>

        </ul>

      </div>

    </nav>

  </header>





  <!--
    - MAIN
  -->

  <main>

    <!--
      - BANNER
    -->

    <!-- <div class="banner">

      <div class="container">

        

      </div>

    </div> -->





    <!--
      - CATEGORY
    -->

    <div class="category">

      <div class="container">

        <div class="category-item-container has-scrollbar">

          <?php foreach ($category_list as $value): ?>

            <div class="category-item">

              <a href="<?= BASE_URL ?>category/<?= $value->category ?>" class="category-img-box">
                <img loading="lazy" src="<?= BASE_URL ?>assets/img/home/menu-category/icons/<?= $value->category ?>.svg"
                  alt="<?= $value->category ?>" width="30">
              </a>

              <div class="category-content-box">

                <a href="<?= BASE_URL ?>category/<?= $value->category ?>" class="category-content-flex">
                  <h3 class="category-item-title">
                    <?= $value->category ?>
                  </h3>
                  <p class="category-item-amount">(
                    <?= $value->total ?>)
                  </p>
                </a>

                <a href="<?= BASE_URL ?>category/<?= $value->category ?>" class="category-btn">Show all</a>

              </div>

            </div>

          <?php endforeach; ?>

        </div>

      </div>

    </div>





    <!--
      - PRODUCT
    -->

    <div class="product-container">
      <div class="container">
        <div class="product-box">
          <div class="product-main">

            <h2 class="title">Mini Gallery Products</h2>

            <div class="product-grid">

              <?php foreach ($all_products as $item): ?>

                <?php
                $images = getProductImage($item->thumbnail_id, true);
                ?>
                <div class="showcase">
                  <div class="showcase-banner">

                    <img loading="lazy" src="<?= BASE_URL ?>assets/img/products/<?= $images[0]->image; ?>"
                      alt="<?= $item->name; ?>" width="300" class="product-img default">
                    <img loading="lazy"
                      src="<?= BASE_URL ?>assets/img/products/<?= $images[1]->image ?? $images[0]->image; ?>"
                      alt="<?= $item->name; ?>" width="300" class="product-img hover">

                    <?php if ($item->discount !== 0): ?>
                      <p class="showcase-badge">
                        <?= $item->discount; ?>%
                      </p>
                    <?php endif; ?>

                    <div class="showcase-actions">

                      <button class="btn-action"
                        onclick="<?= $view_data["results"]["success"] ? "addToWhislist()" : "quick_login()"; ?>">
                        <ion-icon name="heart-outline"></ion-icon>
                      </button>

                      <a href="<?= BASE_URL ?>products/detail/<?= $item->code ?>" class="btn-action">
                        <ion-icon name="eye-outline"></ion-icon>
                      </a>

                      <button class="btn-action"
                        onclick="<?= $view_data["results"]["success"] ? "addToCart()" : "quick_login()"; ?>">
                        <ion-icon name="bag-add-outline"></ion-icon>
                      </button>

                    </div>

                  </div>

                  <div class="showcase-content">

                    <a href="<?= BASE_URL ?>products/detail/<?= $item->code ?>" class="showcase-category">
                      <?= $item->category; ?>
                    </a>

                    <a href="<?= BASE_URL ?>products/detail/<?= $item->code ?>">
                      <h3 class="showcase-title title-limit">
                        <?= $item->name; ?>
                      </h3>
                    </a>

                    <div class="showcase-rating">
                      <?php
                      $max_rating = 5;
                      ?>
                      <?php for ($i = 1; $i <= $item->rating; $i++): ?>
                        <ion-icon name="star"></ion-icon>
                      <?php endfor; ?>
                      <?php for ($i = $item->rating; $i < $max_rating; $i++): ?>
                        <ion-icon name="star-outline"></ion-icon>
                      <?php endfor; ?>
                    </div>

                    <div class="price-box">
                      <p class="price">
                        <?= toRupiah(getDiscount($item->price, $item->discount)); ?>
                      </p>
                      <del>
                        <?= toRupiah($item->price); ?>
                      </del>
                    </div>

                  </div>
                </div>
              <?php endforeach; ?>

            </div>

          </div>
        </div>

      </div>
  </main>


  <footer>
    <div class="quick_login_popup overlay">
      <div class="popup">
        <h2>Quick Login</h2>
        <button type="button" class="close" onclick="close_button()" href="#">&times;</button>
        <div class="content">
          <div class="form login">
            <div class="form-content">
              <form action="" class="form-quick-login" method="POST">
                <div class="field input-field">
                  <input type="email" placeholder="Email" name="email" class="input" required>
                </div>

                <div class="field input-field">
                  <input type="password" placeholder="Password" name="password" class="password" required>
                  <i class='bx bx-hide eye-icon'></i>
                </div>

                <div class="form-link">
                  <a href="#fitur-belom-ada" class="forgot-pass">Forgot password?</a>
                </div>

                <div class="field button-field">
                  <button>Login</button>
                </div>
              </form>
            </div>

            <div class="line"></div>
            <div class="media-options">
              <a href="<?= GoogleAuth::getAuthUrl("LOGIN"); ?>" class="field google">
                <img src="./assets/img/home/google.png" alt="" class="google-img">
                <span>Login with Google</span>
              </a>
            </div>


            <div class="form-link dont-have-account">
              <span>Don't have an account? <a href="<?= BASE_URL ?>signup" class="link signup-link">Signup</a></span>
            </div>
          </div>
        </div>
      </div>


  </footer>




  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!--
    - custom js link
  -->
  <script src="<?= BASE_URL ?>assets/js/products/script.js"></script>
  <script src="<?= BASE_URL ?>assets/js/products/popup-login.js"></script>
  <script src="<?= BASE_URL ?>assets/js/products/quick-login.js"></script>

  <!--
    - ionicon link
  -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>