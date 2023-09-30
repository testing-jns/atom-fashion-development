<?php
use \middlewares\GoogleAuth;
use core\Controller;

$controll = new Controller();

$display_products = $controll->model("products/DisplayProducts");

$category_list = $display_products->categoryList();
$best_sellers = $display_products->bestSellers();
$new_arrivals = $display_products->newArrivals();
$trending = $display_products->trending();
$top_rated = $display_products->topRated();
$deal_of_the_day = $display_products->dealOfTheDay();
$mini_products_gallery = $display_products->miniProductsGallery();

if ($view_data["results"]["success"]) {
  $customer_info = $controll->model("customers/InfoCustomers");
  $total_wishlist = $customer_info->execute()->getTotalProductInWishlist();
  $total_cart = $customer_info->execute()->getTotalProductInCart();
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
  <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/home/style-prefix.css">

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
    - MODAL
  -->

  <div class="modal" data-modal>

    <div class="modal-close-overlay" data-modal-overlay></div>

    <div class="modal-content">

      <button class="modal-close-btn" data-modal-close>
        <ion-icon name="close-outline"></ion-icon>
      </button>

      <div class="newsletter-img">
        <img loading="lazy" src="<?= BASE_URL ?>assets/img/home/newsletter.png" alt="subscribe newsletter" width="400" height="400">
      </div>

      <div class="newsletter">

        <form action="" method="POST">

          <div class="newsletter-header">

            <h3 class="newsletter-title">Subscribe Newsletter.</h3>

            <p class="newsletter-desc">
              Subscribe the <b>Atom Fashion</b> to get latest products and discount update.
            </p>

          </div>

          <input type="email" name="email" class="email-field" placeholder="Email Address" required>

          <button type="submit" class="btn-newsletter">Subscribe</button>

        </form>

      </div>

    </div>

  </div>





  <!--
    - NOTIFICATION TOAST
  -->

  <div class="notification-toast" data-toast>

    <button class="toast-close-btn" data-toast-close>
      <ion-icon name="close-outline"></ion-icon>
    </button>

    <div class="toast-banner">
      <img loading="lazy" src="<?= BASE_URL ?>assets/img/home/products/jewellery-1.jpg" alt="Rose Gold Earrings" width="80" height="70">
    </div>

    <div class="toast-detail">

      <p class="toast-message">
        Someone in new just bought
      </p>

      <p class="toast-title">
        Rose Gold Earrings
      </p>

      <p class="toast-meta">
        <time datetime="PT2M">2 Minutes</time> ago
      </p>

    </div>

  </div>





  <!--
    - HEADER
  -->

  <header>
    <div class="header-top" style="<?= $view_data["results"]["success"] ? "display: none" : ""; ?>">

      <div class="container">

        <ul class="header-social-container">

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

        <div class="header-alert-news">
          <p>
            <b>Free Shipping</b>
            This Week Order Over - Rp. 500 K
          </p>
        </div>

        <div class="header-top-actions">
          <div type="button" class="button-action-about me-2 fs-4" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip"
        data-bs-title="This top tooltip is themed via CSS variables." onclick="location.href = '<?= BASE_URL ?>about'">
            <i class="bi bi-info-circle"></i>
            <span class="tooltiptext">About Atom Fashion</span>
          </div>
          <button type="button" class="btn btn-sm btn-outline-success" onclick="location.href = '<?= BASE_URL ?>login'">LogIn</button>
          <button type="button" class="btn btn-sm btn-success btn-outline-white" onclick="location.href = '<?= BASE_URL ?>signup'">SignUp</button>
        </div>

      </div>

    </div>

    <div class="header-main">

      <div class="container">

        <a href="<?= BASE_URL ?>" class="header-logo">
          <img loading="lazy" src="<?= BASE_URL ?>assets/img/home/logo/logo.svg" alt="Atom's logo" width="120" height="36">
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
          <button class="action-btn" onclick="<?= $view_data["results"]["success"] ? "location.href = '" . BASE_URL . "user/wishlist'" : "quick_login()"; ?>">
            <i class="bi bi-heart"></i>
            <?php if ($view_data["results"]["success"]): ?>
                <span class="count wishlist-quantity"><?= $total_wishlist; ?></span>
            <?php endif; ?>
          </button>

          <button class="action-btn" onclick="<?= $view_data["results"]["success"] ? "location.href ='" . BASE_URL . "user/cart'" : "quick_login()"; ?>">
            <i class="bi bi-cart"></i>
            <?php if ($view_data["results"]["success"]): ?>
                <span class="count cart-quantity"><?= $total_cart; ?></span>
            <?php endif; ?>
          </button>

          <button class="action-btn" onclick="location.href = '<?= BASE_URL ?>user/settings'">
            <?php if (!empty($view_data["results"]["picture"])): ?>
                  <img src="<?= BASE_URL . "assets/img/users/" . $view_data["results"]["picture"]; ?>" width="45" style="border-radius: 100%;">
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
            <a href="<?= BASE_URL ?>products" class="menu-title">Categories</a>

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
                    <img loading="lazy" src="<?= BASE_URL ?>assets/img/home/mens-banner.jpg" alt="men's fashion" width="250" height="119">
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
                    <img loading="lazy" src="<?= BASE_URL ?>assets/img/home/womens-banner.jpg" alt="women's fashion" width="250" height="119">
                  </a>
                </li>

              </ul>

            </div>
          </li>

          <li class="menu-category">
            <a href="<?= BASE_URL ?>products" class="menu-title">PRODUCTS</a>
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

        </ul>

      </div>

    </nav>

    <div class="mobile-bottom-navigation">

      <button class="action-btn" data-mobile-menu-open-btn>
        <ion-icon name="menu-outline"></ion-icon>
      </button>

      <button class="action-btn" onclick="<?= $view_data["results"]["success"] ? "location.href = '" . BASE_URL . "user/cart'" : "quick_login()"; ?>">
        <ion-icon name="bag-handle-outline"></ion-icon>

        <?php if ($view_data["results"]["success"]): ?>
                <span class="count">0</span>
            <?php endif; ?>
      </button>

      <button class="action-btn" onclick="<?= $view_data["results"]["success"] ? "location.href = '" . BASE_URL . "user/settings'" : "quick_login()"; ?>">
        <ion-icon name="home-outline"></ion-icon>
      </button>

      <button class="action-btn" onclick="<?= $view_data["results"]["success"] ? "location.href = '" . BASE_URL . "user/wishlist'" : "quick_login()"; ?>">
        <ion-icon name="heart-outline"></ion-icon>

        <?php if ($view_data["results"]["success"]): ?>
                <span class="count">0</span>
            <?php endif; ?>
      </button>

      <button class="action-btn" data-mobile-menu-open-btn>
        <ion-icon name="grid-outline"></ion-icon>
      </button>

    </div>

    <nav class="mobile-navigation-menu has-scrollbar" data-mobile-menu>

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

    <div class="banner">

      <div class="container">

        <div class="slider-container">
        <!-- <div class="slider-container has-scrollbar"> -->

          <div class="slider-item">

            <img loading="lazy" src="<?= BASE_URL ?>assets/img/home/banner-1.jpg" alt="women's latest fashion sale" class="banner-img">

            <div class="banner-content">

              <p class="banner-subtitle">Trending item</p>

              <h2 class="banner-title">Women's latest fashion sale</h2>

              <p class="banner-text">
                Starting at Rp. <b>100K</b>
              </p>

              <a href="<?= BASE_URL ?>products" class="banner-btn">Shop now</a>

            </div>

          </div>

          <div class="slider-item">

            <img loading="lazy" src="<?= BASE_URL ?>assets/img/home/banner-2.jpg" alt="modern sunglasses" class="banner-img">

            <div class="banner-content">

              <p class="banner-subtitle">Trending accessories</p>

              <h2 class="banner-title">Modern sunglasses</h2>

              <p class="banner-text">
                Starting at Rp. <b>70K</b>
              </p>

              <a href="<?= BASE_URL ?>products" class="banner-btn">Shop now</a>

            </div>

          </div>

          <div class="slider-item">

            <img loading="lazy" src="<?= BASE_URL ?>assets/img/home/banner-3.jpg" alt="new fashion summer sale" class="banner-img">

            <div class="banner-content">

              <p class="banner-subtitle">Sale Offer</p>

              <h2 class="banner-title">New fashion summer sale</h2>

              <p class="banner-text">
                Starting at Rp. <b>120K</b>
              </p>

              <a href="<?= BASE_URL ?>products" class="banner-btn">Shop now</a>

            </div>

          </div>

        </div>

      </div>

    </div>





    <!--
      - CATEGORY
    -->

    <div class="category">

      <div class="container">

        <div class="category-item-container has-scrollbar">

        <?php foreach ($category_list as $value): ?>

              <div class="category-item">

                <a href="<?= BASE_URL ?>category/<?= $value->category ?>" class="category-img-box">
                  <img loading="lazy" src="<?= BASE_URL ?>assets/img/home/menu-category/icons/<?= $value->category ?>.svg" alt="<?= $value->category ?>" width="30">
                </a>

                <div class="category-content-box">

                  <a href="<?= BASE_URL ?>category/<?= $value->category ?>" class="category-content-flex">
                    <h3 class="category-item-title"><?= $value->category ?></h3>
                    <p class="category-item-amount">(<?= $value->total ?>)</p>
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
        

        <div class="sidebar has-scrollbar" data-mobile-menu>

          <div class="sidebar-category">

            <div class="sidebar-top">
              <h2 class="sidebar-title">Category</h2>

              <button class="sidebar-close-btn" data-mobile-menu-close-btn>
                <ion-icon name="close-outline"></ion-icon>
              </button>
            </div>

            <ul class="sidebar-menu-category-list">

              <li class="sidebar-menu-category">

                <button class="sidebar-accordion-menu" data-accordion-btn>

                  <div class="menu-title-flex">
                    <img loading="lazy" src="<?= BASE_URL ?>assets/img/home/icons/dress.svg" alt="clothes" width="20" height="20"
                      class="menu-title-img">

                    <p class="menu-title">Clothes</p>
                  </div>

                  <div>
                    <ion-icon name="add-outline" class="add-icon"></ion-icon>
                    <ion-icon name="remove-outline" class="remove-icon"></ion-icon>
                  </div>

                </button>

                <ul class="sidebar-submenu-category-list" data-accordion>

                  <li class="sidebar-submenu-category">
                    <a href="<?= BASE_URL ?>category/clothes" class="sidebar-submenu-title">
                      <p class="product-name">Shirt</p>
                      <data value="300" class="stock" title="Available Stock">300</data>
                    </a>
                  </li>

                  <li class="sidebar-submenu-category">
                    <a href="<?= BASE_URL ?>category/clothes" class="sidebar-submenu-title">
                      <p class="product-name">shorts & jeans</p>
                      <data value="60" class="stock" title="Available Stock">60</data>
                    </a>
                  </li>

                  <li class="sidebar-submenu-category">
                    <a href="<?= BASE_URL ?>category/clothes" class="sidebar-submenu-title">
                      <p class="product-name">jacket</p>
                      <data value="50" class="stock" title="Available Stock">50</data>
                    </a>
                  </li>

                  <li class="sidebar-submenu-category">
                    <a href="<?= BASE_URL ?>category/clothes" class="sidebar-submenu-title">
                      <p class="product-name">dress & frock</p>
                      <data value="87" class="stock" title="Available Stock">87</data>
                    </a>
                  </li>

                </ul>

              </li>

              <li class="sidebar-menu-category">

                <button class="sidebar-accordion-menu" data-accordion-btn>

                  <div class="menu-title-flex">
                    <img loading="lazy" src="<?= BASE_URL ?>assets/img/home/icons/shoes.svg" alt="footwear" class="menu-title-img" width="20"
                      height="20">

                    <p class="menu-title">Footwear</p>
                  </div>

                  <div>
                    <ion-icon name="add-outline" class="add-icon"></ion-icon>
                    <ion-icon name="remove-outline" class="remove-icon"></ion-icon>
                  </div>

                </button>

                <ul class="sidebar-submenu-category-list" data-accordion>

                  <li class="sidebar-submenu-category">
                    <a href="<?= BASE_URL ?>category/footwear" class="sidebar-submenu-title">
                      <p class="product-name">Sports</p>
                      <data value="45" class="stock" title="Available Stock">45</data>
                    </a>
                  </li>

                  <li class="sidebar-submenu-category">
                    <a href="<?= BASE_URL ?>category/footwear" class="sidebar-submenu-title">
                      <p class="product-name">Formal</p>
                      <data value="75" class="stock" title="Available Stock">75</data>
                    </a>
                  </li>

                  <li class="sidebar-submenu-category">
                    <a href="<?= BASE_URL ?>category/footwear" class="sidebar-submenu-title">
                      <p class="product-name">Casual</p>
                      <data value="35" class="stock" title="Available Stock">35</data>
                    </a>
                  </li>

                  <li class="sidebar-submenu-category">
                    <a href="<?= BASE_URL ?>category/footwear" class="sidebar-submenu-title">
                      <p class="product-name">Safety Shoes</p>
                      <data value="26" class="stock" title="Available Stock">26</data>
                    </a>
                  </li>

                </ul>

              </li>

              <li class="sidebar-menu-category">

                <button class="sidebar-accordion-menu" data-accordion-btn>

                  <div class="menu-title-flex">
                    <img loading="lazy" src="<?= BASE_URL ?>assets/img/home/icons/jewelry.svg" alt="clothes" class="menu-title-img" width="20"
                      height="20">

                    <p class="menu-title">Accessories</p>
                  </div>

                  <div>
                    <ion-icon name="add-outline" class="add-icon"></ion-icon>
                    <ion-icon name="remove-outline" class="remove-icon"></ion-icon>
                  </div>

                </button>

                <ul class="sidebar-submenu-category-list" data-accordion>

                  <li class="sidebar-submenu-category">
                    <a href="<?= BASE_URL ?>category/accessories" class="sidebar-submenu-title">
                      <p class="product-name">Earrings</p>
                      <data value="46" class="stock" title="Available Stock">46</data>
                    </a>
                  </li>

                  <li class="sidebar-submenu-category">
                    <a href="<?= BASE_URL ?>category/accessories" class="sidebar-submenu-title">
                      <p class="product-name">Couple Rings</p>
                      <data value="73" class="stock" title="Available Stock">73</data>
                    </a>
                  </li>

                  <li class="sidebar-submenu-category">
                    <a href="<?= BASE_URL ?>category/accessories" class="sidebar-submenu-title">
                      <p class="product-name">Necklace</p>
                      <data value="61" class="stock" title="Available Stock">61</data>
                    </a>
                  </li>

                </ul>

              </li>

              <li class="sidebar-menu-category">

                <button class="sidebar-accordion-menu" data-accordion-btn>

                  <div class="menu-title-flex">
                    <img loading="lazy" src="<?= BASE_URL ?>assets/img/home/icons/perfume.svg" alt="perfume" class="menu-title-img" width="20"
                      height="20">

                    <p class="menu-title">Perfume</p>
                  </div>

                  <div>
                    <ion-icon name="add-outline" class="add-icon"></ion-icon>
                    <ion-icon name="remove-outline" class="remove-icon"></ion-icon>
                  </div>

                </button>

                <ul class="sidebar-submenu-category-list" data-accordion>

                  <li class="sidebar-submenu-category">
                    <a href="<?= BASE_URL ?>category/perfume" class="sidebar-submenu-title">
                      <p class="product-name">Clothes Perfume</p>
                      <data value="12" class="stock" title="Available Stock">12 pcs</data>
                    </a>
                  </li>

                  <li class="sidebar-submenu-category">
                    <a href="<?= BASE_URL ?>category/perfume" class="sidebar-submenu-title">
                      <p class="product-name">Deodorant</p>
                      <data value="60" class="stock" title="Available Stock">60 pcs</data>
                    </a>
                  </li>

                  <li class="sidebar-submenu-category">
                    <a href="<?= BASE_URL ?>category/perfume" class="sidebar-submenu-title">
                      <p class="product-name">jacket</p>
                      <data value="50" class="stock" title="Available Stock">50 pcs</data>
                    </a>
                  </li>

                  <li class="sidebar-submenu-category">
                    <a href="<?= BASE_URL ?>category/perfume" class="sidebar-submenu-title">
                      <p class="product-name">dress & frock</p>
                      <data value="87" class="stock" title="Available Stock">87 pcs</data>
                    </a>
                  </li>

                </ul>

              </li>

              <li class="sidebar-menu-category">

                <button class="sidebar-accordion-menu" data-accordion-btn>

                  <div class="menu-title-flex">
                    <img loading="lazy" src="<?= BASE_URL ?>assets/img/home/icons/cosmetics.svg" alt="cosmetics" class="menu-title-img" width="20"
                      height="20">

                    <p class="menu-title">Cosmetics</p>
                  </div>

                  <div>
                    <ion-icon name="add-outline" class="add-icon"></ion-icon>
                    <ion-icon name="remove-outline" class="remove-icon"></ion-icon>
                  </div>

                </button>

                <ul class="sidebar-submenu-category-list" data-accordion>

                  <li class="sidebar-submenu-category">
                    <a href="<?= BASE_URL ?>category/cosmetics" class="sidebar-submenu-title">
                      <p class="product-name">Shampoo</p>
                      <data value="68" class="stock" title="Available Stock">68</data>
                    </a>
                  </li>

                  <li class="sidebar-submenu-category">
                    <a href="<?= BASE_URL ?>category/cosmetics" class="sidebar-submenu-title">
                      <p class="product-name">Sunscreen</p>
                      <data value="46" class="stock" title="Available Stock">46</data>
                    </a>
                  </li>

                  <li class="sidebar-submenu-category">
                    <a href="<?= BASE_URL ?>category/cosmetics" class="sidebar-submenu-title">
                      <p class="product-name">Body Wash</p>
                      <data value="79" class="stock" title="Available Stock">79</data>
                    </a>
                  </li>

                  <li class="sidebar-submenu-category">
                    <a href="<?= BASE_URL ?>category/cosmetics" class="sidebar-submenu-title">
                      <p class="product-name">Makeup Kit</p>
                      <data value="23" class="stock" title="Available Stock">23</data>
                    </a>
                  </li>

                </ul>

              </li>

              <li class="sidebar-menu-category">

                <button class="sidebar-accordion-menu" data-accordion-btn>

                  <div class="menu-title-flex">
                    <img loading="lazy" src="<?= BASE_URL ?>assets/img/home/icons/glasses.svg" alt="glasses" class="menu-title-img" width="20"
                      height="20">

                    <p class="menu-title">Glasses</p>
                  </div>

                  <div>
                    <ion-icon name="add-outline" class="add-icon"></ion-icon>
                    <ion-icon name="remove-outline" class="remove-icon"></ion-icon>
                  </div>

                </button>

                <ul class="sidebar-submenu-category-list" data-accordion>

                  <li class="sidebar-submenu-category">
                    <a href="<?= BASE_URL ?>category/glasses" class="sidebar-submenu-title">
                      <p class="product-name">Sunglasses</p>
                      <data value="50" class="stock" title="Available Stock">50</data>
                    </a>
                  </li>

                  <li class="sidebar-submenu-category">
                    <a href="<?= BASE_URL ?>category/glasses" class="sidebar-submenu-title">
                      <p class="product-name">Lenses</p>
                      <data value="48" class="stock" title="Available Stock">48</data>
                    </a>
                  </li>

                </ul>

              </li>

              <li class="sidebar-menu-category">

                <button class="sidebar-accordion-menu" data-accordion-btn>

                  <div class="menu-title-flex">
                    <img loading="lazy" src="<?= BASE_URL ?>assets/img/home/icons/bag.svg" alt="bags" class="menu-title-img" width="20" height="20">

                    <p class="menu-title">Bags</p>
                  </div>

                  <div>
                    <ion-icon name="add-outline" class="add-icon"></ion-icon>
                    <ion-icon name="remove-outline" class="remove-icon"></ion-icon>
                  </div>

                </button>

                <ul class="sidebar-submenu-category-list" data-accordion>

                  <li class="sidebar-submenu-category">
                    <a href="<?= BASE_URL ?>category/bags" class="sidebar-submenu-title">
                      <p class="product-name">Shopping Bag</p>
                      <data value="62" class="stock" title="Available Stock">62</data>
                    </a>
                  </li>

                  <li class="sidebar-submenu-category">
                    <a href="<?= BASE_URL ?>category/bags" class="sidebar-submenu-title">
                      <p class="product-name">Gym Backpack</p>
                      <data value="35" class="stock" title="Available Stock">35</data>
                    </a>
                  </li>

                  <li class="sidebar-submenu-category">
                    <a href="<?= BASE_URL ?>category/bags" class="sidebar-submenu-title">
                      <p class="product-name">Purse</p>
                      <data value="80" class="stock" title="Available Stock">80</data>
                    </a>
                  </li>

                  <li class="sidebar-submenu-category">
                    <a href="<?= BASE_URL ?>category/bags" class="sidebar-submenu-title">
                      <p class="product-name">Wallet</p>
                      <data value="75" class="stock" title="Available Stock">75</data>
                    </a>
                  </li>

                </ul>

              </li>

            </ul>

          </div>

          <div class="product-showcase">

            <h3 class="showcase-heading">best sellers</h3>

            <div class="showcase-wrapper">

              <div class="showcase-container">

                <?php foreach ($best_sellers as $item) : ?>
                <div class="showcase">

                  <a href="<?= BASE_URL ?>products/detail/<?= $item->code ?>" class="showcase-img-box">
                    <img loading="lazy" src="<?= BASE_URL ?>assets/img/products/<?= $display_products->getProductImages($item->thumbnail_id); ?>" alt="<?= $item->name; ?>" width="75" height="75" class="showcase-img">
                  </a>




                  <div class="showcase-content">
                    <a href="<?= BASE_URL ?>products/detail/<?= $item->code ?>">
                      <h4 class="showcase-title"><?= $item->name; ?></h4>
                    </a>

                    <div class="showcase-rating">
                      <?php 
                      $max_rating = 5;
                      ?>
                      <?php for ($i = 1; $i <= $item->rating; $i++) : ?>
                      <ion-icon name="star"></ion-icon>
                      <?php endfor; ?>
                      <?php for ($i = $item->rating; $i < $max_rating; $i++) : ?>
                        <ion-icon name="star-outline"></ion-icon>
                      <?php endfor; ?>
                    </div>

                    <div class="price-box">
                      <del><?= $display_products->toRupiah($item->price); ?></del>
                      <p class="price"><?= $display_products->toRupiah($display_products->getDiscount($item->price, $item->discount)); ?></p>
                    </div>

                  </div>

                </div>
                <?php endforeach; ?>
                
              </div>
            </div>
          </div>
        </div>



        <div class="product-box">

          <!--
            - PRODUCT MINIMAL
          -->

          <div class="product-minimal">

            <div class="product-showcase">

              <h2 class="title">New Arrivals</h2>

              <div class="showcase-wrapper has-scrollbar">

              <?php foreach ($new_arrivals as $index => $item): ?>
                    <?php if ($index === 0 || $index === 4): ?>
                        <div class="showcase-container">
                    <?php endif; ?>

                      <div class="showcase">

                        <a href="<?= BASE_URL ?>products/detail/<?= $item->code ?>" class="showcase-img-box">
                          <img loading="lazy" src="<?= BASE_URL ?>assets/img/products/<?= $display_products->getProductImages($item->thumbnail_id); ?>" alt="<?= $item->name; ?>" width="70" height="70" class="showcase-img">
                        </a>

                        <div class="showcase-content">

                          <a href="<?= BASE_URL ?>products/detail/<?= $item->code ?>">
                            <h4 class="showcase-title"><?= $item->name; ?></h4>
                          </a>

                          <a href="<?= BASE_URL ?>products/detail/<?= $item->code ?>" class="showcase-category"><?= $item->category; ?></a>

                          <div class="price-box">
                            <p class="price"><?= $display_products->toRupiah($display_products->getDiscount($item->price, $item->discount)); ?></p>
                            <del><?= $display_products->toRupiah($item->price); ?></del>
                          </div>

                        </div>

                      </div>

                    <?php if ($index === 3 || $index === 7): ?>
                        </div>
                    <?php endif; ?>

              <?php endforeach; ?>

              </div>
            </div>

            <div class="product-showcase">
            
              <h2 class="title">Trending</h2>
            
              <div class="showcase-wrapper  has-scrollbar">
            
              <?php foreach ($trending as $index => $item): ?>

              <?php if ($index === 0 || $index === 4): ?>
                  <div class="showcase-container">
              <?php endif; ?>

                <div class="showcase">

                  <a href="<?= BASE_URL ?>products/detail/<?= $item->code ?>" class="showcase-img-box">
                    <img loading="lazy" src="<?= BASE_URL ?>assets/img/products/<?= $display_products->getProductImages($item->thumbnail_id); ?>" alt="<?= $item->name; ?>" width="70" height="70" class="showcase-img">
                  </a>

                  <div class="showcase-content">

                    <a href="<?= BASE_URL ?>products/detail/<?= $item->code ?>">
                      <h4 class="showcase-title"><?= $item->name; ?></h4>
                    </a>

                    <a href="<?= BASE_URL ?>products/detail/<?= $item->code ?>" class="showcase-category"><?= $item->category; ?></a>

                    <div class="price-box">
                      <p class="price"><?= $display_products->toRupiah($display_products->getDiscount($item->price, $item->discount)); ?></p>
                      <del><?= $display_products->toRupiah($item->price); ?></del>
                    </div>

                  </div>

                </div>

              <?php if ($index === 3 || $index === 7): ?>
                  </div>
              <?php endif; ?>

              <?php endforeach; ?>
                
              </div>
            
            </div>

            <div class="product-showcase">
            
              <h2 class="title">Top Rated</h2>
            
              <div class="showcase-wrapper  has-scrollbar">
            
              <?php foreach ($top_rated as $index => $item): ?>


              <?php if ($index === 0 || $index === 4): ?>
                  <div class="showcase-container">
              <?php endif; ?>

                <div class="showcase">

                  <a href="<?= BASE_URL ?>products/detail/<?= $item->code ?>" class="showcase-img-box">
                    <img loading="lazy" src="<?= BASE_URL ?>assets/img/products/<?= $display_products->getProductImages($item->thumbnail_id); ?>" alt="<?= $item->name; ?>" width="70" height="70" class="showcase-img">
                  </a>

                  <div class="showcase-content">

                    <a href="<?= BASE_URL ?>products/detail/<?= $item->code ?>">
                      <h4 class="showcase-title"><?= $item->name; ?></h4>
                    </a>

                    <a href="<?= BASE_URL ?>products/detail/<?= $item->code ?>" class="showcase-category"><?= $item->category; ?></a>

                    <div class="price-box">
                      <p class="price"><?= $display_products->toRupiah($display_products->getDiscount($item->price, $item->discount)); ?></p>
                      <del><?= $display_products->toRupiah($item->price); ?></del>
                    </div>

                  </div>

                </div>

              <?php if ($index === 3 || $index === 7): ?>
                  </div>
              <?php endif; ?>

            <?php endforeach; ?>  


            </div>
            </div>

          </div>



          <!--
            - PRODUCT FEATURED
          -->

          <div class="product-featured">

            <h2 class="title">Deal of the day</h2>

            <div class="showcase-wrapper has-scrollbar">

            <?php foreach ($deal_of_the_day as $item) : ?>
              <div class="showcase-container">

                <div class="showcase">
                  
                  <div class="showcase-banner">
                    <img loading="lazy" src="<?= BASE_URL ?>assets/img/products/<?= $display_products->getProductImages($item->thumbnail_id); ?>" alt="<?= $item->name; ?>" class="showcase-img" >
                  </div>

                  <div class="showcase-content">
                    
                    <div class="showcase-rating">
                      <?php 
                      $max_rating = 5;
                      ?>
                      <?php for ($i = 1; $i <= $item->rating; $i++) : ?>
                      <ion-icon name="star"></ion-icon>
                      <?php endfor; ?>
                      <?php for ($i = $item->rating; $i < $max_rating; $i++) : ?>
                        <ion-icon name="star-outline"></ion-icon>
                      <?php endfor; ?>
                    </div>

                    <a href="<?= BASE_URL ?>products/detail/<?= $item->code ?>">
                      <h3 class="showcase-title"><?= $item->name ?></h3>
                    </a>

                    <p class="showcase-desc description-limit" onclick="location.href = '<?= BASE_URL ?>products/detail/<?= $item->code ?>'">
                      <?= $item->description ?>
                    </p>

                    <div class="price-box">
                      <p class="price"><?= $display_products->toRupiah($display_products->getDiscount($item->price, $item->discount)); ?></p>

                      <del><?= $display_products->toRupiah($item->price); ?></del>
                    </div>

                    <button class="add-cart-btn" onclick="<?= $view_data["results"]["success"] ? "addToCart('$item->code')" : "quick_login()"; ?>">add to cart</button>

                    <div class="showcase-status">
                      <div class="wrapper">
                        <p>
                          already sold: <b><?= $item->sold; ?></b>
                        </p>

                        <p>
                          available: <b><?= $item->stock; ?></b>
                        </p>
                      </div>

                      <?php 
                      $percentage = ($item->sold / $item->stock) * 100;
                      ?>
                      <!--  -->
                      <div class="showcase-status-bar">
                        <div class="bar-status" style="width: <?= $percentage; ?>%;"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

            <?php endforeach; ?>

            </div>

          </div>



          <!--
            - PRODUCT GRID
          -->

          <div class="product-main">

            <h2 class="title">Mini Gallery Products</h2>

            <div class="product-grid">

              <?php foreach ($mini_products_gallery as $item) : ?>

                <?php 
                  $images = $display_products->getProductImages($item->thumbnail_id, true);
                ?>
              <div class="showcase">
                <div class="showcase-banner">

                  <img loading="lazy" src="<?= BASE_URL ?>assets/img/products/<?= $images[0]->image;?>" alt="<?= $item->name; ?>" width="300" class="product-img default">
                  <img loading="lazy" src="<?= BASE_URL ?>assets/img/products/<?= $images[1]->image ?? $images[0]->image; ?>" alt="<?= $item->name; ?>" width="300" class="product-img hover">

                  <?php if ($item->discount !== 0) : ?>
                  <p class="showcase-badge"><?= $item->discount; ?>%</p>
                  <?php endif; ?>

                  <div class="showcase-actions">

                    <button class="btn-action" onclick="<?= $view_data["results"]["success"] ? "addToWishlist('$item->code')" : "quick_login()"; ?>">
                      <ion-icon name="heart-outline"></ion-icon>
                    </button>

                    <a href="<?= BASE_URL ?>products/detail/<?= $item->code ?>" class="btn-action">
                      <ion-icon name="eye-outline"></ion-icon>
                    </a>

                    <button class="btn-action" onclick="<?= $view_data["results"]["success"] ? "addToCart('$item->code')" : "quick_login()"; ?>">
                      <ion-icon name="bag-add-outline"></ion-icon>
                    </button>

                  </div>

                </div>

                <div class="showcase-content">

                  <a href="<?= BASE_URL ?>products/detail/<?= $item->code ?>" class="showcase-category"><?= $item->category; ?></a>

                  <a href="<?= BASE_URL ?>products/detail/<?= $item->code ?>">
                    <h3 class="showcase-title title-limit"><?= $item->name; ?></h3>
                  </a>

                  <div class="showcase-rating">
                  <?php 
                      $max_rating = 5;
                      ?>
                      <?php for ($i = 1; $i <= $item->rating; $i++) : ?>
                      <ion-icon name="star"></ion-icon>
                      <?php endfor; ?>
                      <?php for ($i = $item->rating; $i < $max_rating; $i++) : ?>
                        <ion-icon name="star-outline"></ion-icon>
                      <?php endfor; ?>
                  </div>

                  <div class="price-box">
                      <p class="price"><?= $display_products->toRupiah($display_products->getDiscount($item->price, $item->discount)); ?></p>
                      <del><?= $display_products->toRupiah($item->price); ?></del>
                  </div>

                </div>
              </div>
              <?php endforeach; ?>

            </div>

          </div>

        </div>

      </div>

    </div>





    <!--
      - TESTIMONIALS, CTA & SERVICE
    -->

    <div>

      <div class="container">

        <div class="testimonials-box">

          <!--
            - TESTIMONIALS
          -->

          <div class="testimonial">

            <h2 class="title">testimonial</h2>

            <div class="testimonial-card">

              <img loading="lazy" src="<?= BASE_URL ?>assets/img/home/ceo-and-founder-atom-fashion-sp.png" alt="alan doe" class="testimonial-banner" width="80" height="80">

              <p class="testimonial-name">Atom S. P.</p>

              <p class="testimonial-title">CEO & Founder Invision</p>

              <img loading="lazy" src="<?= BASE_URL ?>assets/img/home/icons/quotes.svg" alt="quotation" class="quotation-img" width="26">

              <p class="testimonial-desc">
                Lorem ipsum dolor sit amet consectetur Lorem ipsum
                dolor dolor sit amet.
              </p>

            </div>

          </div>



          <!--
            - CTA
          -->

          <div class="cta-container">

            <img loading="lazy" src="<?= BASE_URL ?>assets/img/home/cta-banner.jpg" alt="summer collection" class="cta-banner">

            <a href="#" class="cta-content">

              <p class="discount">25% Discount</p>

              <h2 class="cta-title">Summer collection</h2>

              <p class="cta-text">Starting @ $10</p>

              <button class="cta-btn">Shop now</button>

            </a>

          </div>



          <!--
            - SERVICE
          -->

          <div class="service">

            <h2 class="title">Our Services</h2>

            <div class="service-container">

              <a href="#" class="service-item">

                <div class="service-icon">
                  <ion-icon name="boat-outline"></ion-icon>
                </div>

                <div class="service-content">

                  <h3 class="service-title">Worldwide Delivery</h3>
                  <p class="service-desc">For Order Over $100</p>

                </div>

              </a>

              <a href="#" class="service-item">
              
                <div class="service-icon">
                  <ion-icon name="rocket-outline"></ion-icon>
                </div>
              
                <div class="service-content">
              
                  <h3 class="service-title">Next Day delivery</h3>
                  <p class="service-desc">UK Orders Only</p>
              
                </div>
              
              </a>

              <a href="#" class="service-item">
              
                <div class="service-icon">
                  <ion-icon name="call-outline"></ion-icon>
                </div>
              
                <div class="service-content">
              
                  <h3 class="service-title">Best Online Support</h3>
                  <p class="service-desc">Hours: 8AM - 11PM</p>
              
                </div>
              
              </a>

              <a href="#" class="service-item">
              
                <div class="service-icon">
                  <ion-icon name="arrow-undo-outline"></ion-icon>
                </div>
              
                <div class="service-content">
              
                  <h3 class="service-title">Return Policy</h3>
                  <p class="service-desc">Easy & Free Return</p>
              
                </div>
              
              </a>

              <a href="#" class="service-item">
              
                <div class="service-icon">
                  <ion-icon name="ticket-outline"></ion-icon>
                </div>
              
                <div class="service-content">
              
                  <h3 class="service-title">30% money back</h3>
                  <p class="service-desc">For Order Over $100</p>
              
                </div>
              
              </a>

            </div>

          </div>

        </div>

      </div>

    </div>





    <!--
      - BLOG
    -->

    <div class="blog">

      <div class="container">

        <div class="blog-container has-scrollbar">

          <div class="blog-card">

            <a href="#">
              <img loading="lazy" src="<?= BASE_URL ?>assets/img/home/blog-1.jpg" alt="Clothes Retail KPIs 2021 Guide for Clothes Executives" width="300" class="blog-banner">
            </a>

            <div class="blog-content">

              <a href="#" class="blog-category">Fashion</a>

              <a href="#">
                <h3 class="blog-title">Clothes Retail KPIs 2021 Guide for Clothes Executives.</h3>
              </a>

              <p class="blog-meta">
                By <cite>Mr Joko</cite> / <time datetime="2022-04-06">Apr 06, 2022</time>
              </p>

            </div>

          </div>

          <div class="blog-card">
          
            <a href="#">
              <img loading="lazy" src="<?= BASE_URL ?>assets/img/home/blog-2.jpg" alt="Curbside fashion Trends: How to Win the Pickup Battle."
                class="blog-banner" width="300">
            </a>
          
            <div class="blog-content">
          
              <a href="#" class="blog-category">Clothes</a>
          
              <h3>
                <a href="#" class="blog-title">Curbside fashion Trends: How to Win the Pickup Battle.</a>
              </h3>
          
              <p class="blog-meta">
                By <cite>Mr Fahrul</cite> / <time datetime="2022-01-18">Jan 18, 2022</time>
              </p>
          
            </div>
          
          </div>

          <div class="blog-card">
          
            <a href="#">
              <img loading="lazy" src="<?= BASE_URL ?>assets/img/home/blog-3.jpg" alt="EBT vendors: Claim Your Share of SNAP Online Revenue."
                class="blog-banner" width="300">
            </a>
          
            <div class="blog-content">
          
              <a href="#" class="blog-category">Shoes</a>
          
              <h3>
                <a href="#" class="blog-title">EBT vendors: Claim Your Share of SNAP Online Revenue.</a>
              </h3>
          
              <p class="blog-meta">
                By <cite>Mr Lontong</cite> / <time datetime="2022-02-10">Feb 10, 2022</time>
              </p>
          
            </div>
          
          </div>

          <div class="blog-card">
          
            <a href="#">
              <img loading="lazy" src="<?= BASE_URL ?>assets/img/home/blog-4.jpg" alt="Curbside fashion Trends: How to Win the Pickup Battle."
                class="blog-banner" width="300">
            </a>
          
            <div class="blog-content">
          
              <a href="#" class="blog-category">Electronics</a>
          
              <h3>
                <a href="#" class="blog-title">Curbside fashion Trends: How to Win the Pickup Battle.</a>
              </h3>
          
              <p class="blog-meta">
                By <cite>Mr Jhuanes</cite> / <time datetime="2022-03-15">Mar 15, 2022</time>
              </p>
          
            </div>
          
          </div>

        </div>

      </div>

    </div>

  </main>





  <!--
    - FOOTER
  -->

  <footer>

    <div class="footer-category">

      <div class="container">

        <h2 class="footer-category-title">Brand directory</h2>

        <div class="footer-category-box">

          <h3 class="category-box-title">Fashion :</h3>

          <a href="#" class="footer-category-link">T-shirt</a>
          <a href="#" class="footer-category-link">Shirts</a>
          <a href="#" class="footer-category-link">shorts & jeans</a>
          <a href="#" class="footer-category-link">jacket</a>
          <a href="#" class="footer-category-link">dress & frock</a>
          <a href="#" class="footer-category-link">innerwear</a>
          <a href="#" class="footer-category-link">hosiery</a>

        </div>

        <div class="footer-category-box">
          <h3 class="category-box-title">footwear :</h3>
        
          <a href="#" class="footer-category-link">sport</a>
          <a href="#" class="footer-category-link">formal</a>
          <a href="#" class="footer-category-link">Boots</a>
          <a href="#" class="footer-category-link">casual</a>
          <a href="#" class="footer-category-link">cowboy shoes</a>
          <a href="#" class="footer-category-link">safety shoes</a>
          <a href="#" class="footer-category-link">Party wear shoes</a>
          <a href="#" class="footer-category-link">Branded</a>
          <a href="#" class="footer-category-link">Firstcopy</a>
          <a href="#" class="footer-category-link">Long shoes</a>
        </div>

        <div class="footer-category-box">
          <h3 class="category-box-title">jewellery :</h3>
        
          <a href="#" class="footer-category-link">Necklace</a>
          <a href="#" class="footer-category-link">Earrings</a>
          <a href="#" class="footer-category-link">Couple rings</a>
          <a href="#" class="footer-category-link">Pendants</a>
          <a href="#" class="footer-category-link">Crystal</a>
          <a href="#" class="footer-category-link">Bangles</a>
          <a href="#" class="footer-category-link">bracelets</a>
          <a href="#" class="footer-category-link">nosepin</a>
          <a href="#" class="footer-category-link">chain</a>
          <a href="#" class="footer-category-link">Earrings</a>
          <a href="#" class="footer-category-link">Couple rings</a>
        </div>

        <div class="footer-category-box">
          <h3 class="category-box-title">cosmetics :</h3>
        
          <a href="#" class="footer-category-link">Shampoo</a>
          <a href="#" class="footer-category-link">Bodywash</a>
          <a href="#" class="footer-category-link">Facewash</a>
          <a href="#" class="footer-category-link">makeup kit</a>
          <a href="#" class="footer-category-link">liner</a>
          <a href="#" class="footer-category-link">lipstick</a>
          <a href="#" class="footer-category-link">prefume</a>
          <a href="#" class="footer-category-link">Body soap</a>
          <a href="#" class="footer-category-link">scrub</a>
          <a href="#" class="footer-category-link">hair gel</a>
          <a href="#" class="footer-category-link">hair colors</a>
          <a href="#" class="footer-category-link">hair dye</a>
          <a href="#" class="footer-category-link">sunscreen</a>
          <a href="#" class="footer-category-link">skin loson</a>
          <a href="#" class="footer-category-link">liner</a>
          <a href="#" class="footer-category-link">lipstick</a>
        </div>

      </div>

    </div>

    <div class="footer-nav">

      <div class="container">

        <ul class="footer-nav-list">

          <li class="footer-nav-item">
            <h2 class="nav-title">Popular Categories</h2>
          </li>

          <li class="footer-nav-item">
            <a href="#" class="footer-nav-link">Fashion</a>
          </li>

          <li class="footer-nav-item">
            <a href="#" class="footer-nav-link">Electronic</a>
          </li>

          <li class="footer-nav-item">
            <a href="#" class="footer-nav-link">Cosmetic</a>
          </li>

          <li class="footer-nav-item">
            <a href="#" class="footer-nav-link">Health</a>
          </li>

          <li class="footer-nav-item">
            <a href="#" class="footer-nav-link">Watches</a>
          </li>

        </ul>

        <ul class="footer-nav-list">
        
          <li class="footer-nav-item">
            <h2 class="nav-title">Products</h2>
          </li>
        
          <li class="footer-nav-item">
            <a href="#" class="footer-nav-link">Prices drop</a>
          </li>
        
          <li class="footer-nav-item">
            <a href="#" class="footer-nav-link">New products</a>
          </li>
        
          <li class="footer-nav-item">
            <a href="#" class="footer-nav-link">Best sales</a>
          </li>
        
          <li class="footer-nav-item">
            <a href="#" class="footer-nav-link">Contact us</a>
          </li>
        
          <li class="footer-nav-item">
            <a href="#" class="footer-nav-link">Sitemap</a>
          </li>
        
        </ul>

        <ul class="footer-nav-list">
        
          <li class="footer-nav-item">
            <h2 class="nav-title">Our Company</h2>
          </li>
        
          <li class="footer-nav-item">
            <a href="#" class="footer-nav-link">Delivery</a>
          </li>
        
          <li class="footer-nav-item">
            <a href="#" class="footer-nav-link">Legal Notice</a>
          </li>
        
          <li class="footer-nav-item">
            <a href="#" class="footer-nav-link">Terms and conditions</a>
          </li>
        
          <li class="footer-nav-item">
            <a href="#" class="footer-nav-link">About us</a>
          </li>
        
          <li class="footer-nav-item">
            <a href="#" class="footer-nav-link">Secure payment</a>
          </li>
        
        </ul>

        <ul class="footer-nav-list">
        
          <li class="footer-nav-item">
            <h2 class="nav-title">Services</h2>
          </li>
        
          <li class="footer-nav-item">
            <a href="#" class="footer-nav-link">Prices drop</a>
          </li>
        
          <li class="footer-nav-item">
            <a href="#" class="footer-nav-link">New products</a>
          </li>
        
          <li class="footer-nav-item">
            <a href="#" class="footer-nav-link">Best sales</a>
          </li>
        
          <li class="footer-nav-item">
            <a href="#" class="footer-nav-link">Contact us</a>
          </li>
        
          <li class="footer-nav-item">
            <a href="#" class="footer-nav-link">Sitemap</a>
          </li>
        
        </ul>

        <ul class="footer-nav-list">

          <li class="footer-nav-item">
            <h2 class="nav-title">Contact</h2>
          </li>

          <li class="footer-nav-item flex">
            <div class="icon-box">
              <ion-icon name="location-outline"></ion-icon>
            </div>

            <address class="content">
              419 State 414 Rte
              Beaver Dams, New York(NY), 14812, USA
            </address>
          </li>

          <li class="footer-nav-item flex">
            <div class="icon-box">
              <ion-icon name="call-outline"></ion-icon>
            </div>

            <a href="tel:+607936-8058" class="footer-nav-link">(607) 936-8058</a>
          </li>

          <li class="footer-nav-item flex">
            <div class="icon-box">
              <ion-icon name="mail-outline"></ion-icon>
            </div>

            <a href="mailto:example@gmail.com" class="footer-nav-link">example@gmail.com</a>
          </li>

        </ul>

        <ul class="footer-nav-list">

          <li class="footer-nav-item">
            <h2 class="nav-title">Follow Us</h2>
          </li>

          <li>
            <ul class="social-link">

              <li class="footer-nav-item">
                <a href="#" class="footer-nav-link">
                  <ion-icon name="logo-facebook"></ion-icon>
                </a>
              </li>

              <li class="footer-nav-item">
                <a href="#" class="footer-nav-link">
                  <ion-icon name="logo-twitter"></ion-icon>
                </a>
              </li>

              <li class="footer-nav-item">
                <a href="#" class="footer-nav-link">
                  <ion-icon name="logo-linkedin"></ion-icon>
                </a>
              </li>

              <li class="footer-nav-item">
                <a href="#" class="footer-nav-link">
                  <ion-icon name="logo-instagram"></ion-icon>
                </a>
              </li>

            </ul>
          </li>

        </ul>

      </div>

    </div>


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
                        <img src="<?= BASE_URL ?>assets/img/home/google.png" alt="" class="google-img">
                        <span>Login with Google</span>
                    </a>
                </div>

                
                <div class="form-link dont-have-account">
                        <span>Don't have an account? <a href="<?= BASE_URL ?>signup" class="link signup-link">Signup</a></span>
                    </div>
            </div>
    </div>
  </div>
</div>


    <div class="footer-bottom">

      <div class="container">

        <img loading="lazy" src="<?= BASE_URL ?>assets/img/home/payment.png" alt="payment method" class="payment-img">

        <p class="copyright">
          Copyright &copy; <a href="#">Atom</a> all rights reserved.
        </p>

      </div>

    </div>

  </footer>



  
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!--
    - custom js link
  -->
  <script src="<?= BASE_URL ?>assets/js/home/script.js"></script>
  <script src="<?= BASE_URL ?>assets/js/home/popup-login.js"></script>
  <script src="<?= BASE_URL ?>assets/js/home/quick-login.js"></script>

  <script src="<?= BASE_URL ?>assets/js/home/wishlist.js"></script>
  <script src="<?= BASE_URL ?>assets/js/home/cart.js"></script>

  <!--
    - ionicon link
  -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>
</html>