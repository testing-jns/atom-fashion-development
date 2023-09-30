<?php
use core\Controller;

$controll = new Controller();

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
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/user/style.css">
    <!-- <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/home/style-prefix.css"> -->

    <!--
    - google font link
  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>

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
                        onclick="<?= $view_data["results"]["success"] ? "location.href = '" . BASE_URL . "user/wishlist'" : "quick_login()"; ?>">
                        <i class="bi bi-heart"></i>
                        <?php if ($view_data["results"]["success"]): ?>
                            <span class="count"><?= $total_wishlist; ?></span>
                        <?php endif; ?>
                    </button>

                    <button class="action-btn"
                        onclick="<?= $view_data["results"]["success"] ? "location.href = '" . BASE_URL . "user/cart'" : "quick_login()"; ?>">
                        <i class="bi bi-cart"></i>
                        <?php if ($view_data["results"]["success"]): ?>
                            <span class="count"><?= $total_cart; ?></span>
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
                        <a href="<?= BASE_URL ?>" class="menu-title">Categories</a>

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
                                        <img loading="lazy" src="<?= BASE_URL ?>assets/img/home/mens-banner.jpg"
                                            alt="men's fashion" width="250" height="119">
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
                                        <img loading="lazy" src="<?= BASE_URL ?>assets/img/home/womens-banner.jpg"
                                            alt="women's fashion" width="250" height="119">
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

            <button class="action-btn"
                onclick="<?= $view_data["results"]["success"] ? "location.href = '" . BASE_URL . "user/cart'" : "quick_login()"; ?>">
                <ion-icon name="bag-handle-outline"></ion-icon>

                <?php if ($view_data["results"]["success"]): ?>
                    <span class="count">0</span>
                <?php endif; ?>
            </button>

            <button class="action-btn">
                <ion-icon name="home-outline"></ion-icon>
            </button>

            <button class="action-btn"
                onclick="<?= $view_data["results"]["success"] ? "location.href = '" . BASE_URL . "user/wishlist'" : "quick_login()"; ?>">
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


        <div class="container user-settings">
            <div class="mini-products-toggle" onclick="showProductsMenu()">
                <div id="menuToggle">
                    <input type="checkbox" />
                    <span></span>
                    <span></span>
                    <span></span>
                    <div class="tes"></div>
                </div>
            </div>
            <div class="user-mini-profile">
                <div class="person ms-2 mt-2 fw-bold">
                    <i class="bi bi-person fs-3"></i>
                    <span class="fs-4">Jhuanes</span>
                </div>
            </div>

            <div class="user-menu-settings">
                <nav class="navbar navbar-expand-lg bg-body-tertiary rounded">
                    <div class="container-fluid">
                        <div class="collapse navbar-collapse d-flex justify-content-center">
                            <ul class="navbar-nav fw-bold">
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="#">Biodata</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Alamat</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Notifikasi</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Kemanan</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>

    </header>





    <!--
    - MAIN
  -->

    <main>


    </main>





    <script>
        function showProductsMenu() {
            document.querySelector(".desktop-navigation-menu").classList.toggle("active")
        }
    </script>
    <!--
    - FOOTER
  -->
    <!-- 
  <footer>


  </footer> -->

    <!--
    - custom js link
  -->
    <script src="<?= BASE_URL ?>assets/js/user/script.js"></script>

    <!--
    - ionicon link
  -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>