<?php
ob_start();
session_start();
include "connection.php";
if (isset($_SESSION['user_id'])) {

    $user_id = $_SESSION['user_id'];
}
if (isset($_SESSION['merchant_id'])) {

    $merchant_id = $_SESSION['merchant_id'];
}
if (isset($_SESSION['admin_id'])) {

    $admin_id = $_SESSION['admin_id'];
}
if (isset($_SESSION['shipping_company_id'])) {

    $shipping_company_id = $_SESSION['shipping_company_id'];
}
$merchants = $con->query("SELECT * FROM merchant WHERE status=1");
$categories = $con->query("SELECT * FROM category");
$products = $con->query("SELECT * FROM product  JOIN merchant ON product.merchant_id = merchant.merchant_id  WHERE product.status='عام' LIMIT 4");
?>
<!doctype html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/output.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>

    <title>سعودي براند</title>
</head>

<body class="bg-gray-50">
<!--Navbar-->
<nav class="bg-viridian-green-200 border-b shadow-lg rounded lg:mb-2">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">

        <div class="flex flex-col md:flex-row items-center">
            <?php if (isset($user_id)): ?>
                <div class="md:ml-4 mt-3 md:mt-0">
                    <a href="users/profile.php">
                        <img src="assets/images/profile-user.png" alt="profile image"
                             class="-mt-px w-5 h-5 text-gray-800">
                    </a>
                </div>
            <?php elseif (isset($merchant_id)): ?>
                <div class="md:ml-4 mt-3 md:mt-0">
                    <a href="merchants/products.php">
                        <img src="assets/images/profile-user.png" alt="profile image"
                             class="-mt-px w-5 h-5 text-gray-800">
                    </a>
                </div>
            <?php elseif (isset($admin_id)): ?>
                <div class="md:ml-4 mt-3 md:mt-0">
                    <a href="admin/customer/customers.php">
                        <img src="assets/images/profile-user.png" alt="profile image"
                             class="-mt-px w-5 h-5 text-gray-800">
                    </a>
                </div>
            <?php elseif (isset($shipping_company_id)): ?>
                <div class="md:ml-4 mt-3 md:mt-0">
                    <a href="shipping_company/orders.php">
                        <img src="assets/images/profile-user.png" alt="profile image"
                             class="-mt-px w-5 h-5 text-gray-800">
                    </a>
                </div>
            <?php endif; ?>
            <div class="md:ml-4 mt-3 md:mt-0">
                <a href="shop/cart.php">
                    <div class="mb-5">

                        <?php echo $num_items_in_cart = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?>
                        <svg fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                             viewBox="0 0 24 24"
                             stroke="currentColor" class="-mt-px w-5 h-5 text-gray-800">
                            <path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                </a>
            </div>
            <!--Searchbar-->
            <div class="md:ml-4 mt-3 md:mt-0">
                <label for="getName" class="sr-only"></label>
                <div class="relative mt-1">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                             xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                  stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </div>
                    <input type="text" id="getName" data-dropdown-toggle="showData"
                           class="block p-2 pl-10 text-right text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                           placeholder="... ابحث هنا">
                    <div dir="rtl" id="showData"
                         class="z-10 hidden font-normal text-right bg-white divide-y divide-gray-100 rounded-lg shadow w-full">
                        <ul class="py-2 text-sm text-gray-700 "></ul>
                    </div>
                </div>
            </div>


        </div>
        <button data-collapse-toggle="navbar-dropdown" type="button"
                class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200"
                aria-controls="navbar-dropdown" aria-expanded="false">
            <span class="sr-only">Open main menu</span>

        </button>
        <div class="hidden w-full md:block md:w-auto" id="navbar-dropdown">
            <ul class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg md:flex-row md:space-x-8 md:mt-0 md:border-0">
                <?php if (isset($user_id) || isset($merchant_id) || isset($admin_id) || isset($shipping_company_id)): ?>
                    <li>
                        <a href="logout.php"
                           class="block py-2 pl-3 pr-4 text-white rounded hover:bg-viridian-green-500 md:hover:bg-transparent md:hover:text-viridian-green-500 md:p-0">تسجيل
                            خروج</a>
                    </li>
                <?php else : ?>
                    <li>
                        <a href="login.php"
                           class="block py-2 pl-3 pr-4 text-white rounded hover:bg-viridian-green-500 md:hover:bg-transparent md:hover:text-viridian-green-500 md:p-0">تسجيل
                            دخول</a>
                    </li>
                    <li>
                        <a href="signup.php"
                           class="block py-2 pl-3 pr-4 text-white rounded hover:bg-viridian-green-500 md:hover:bg-transparent md:hover:text-viridian-green-500 md:p-0">التسجيل</a>
                    </li>
                <?php endif; ?>
                <li>
                    <a href="shop/brands.php"
                       class="block py-2 pl-3 pr-4 text-white rounded hover:bg-viridian-green-500 md:hover:bg-transparent md:hover:text-viridian-green-500 md:p-0">العلامات
                        التجارية</a>
                </li>

                <li>
                    <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar2"
                            class="flex items-center justify-between w-full py-2 pl-3 pr-4 text-white rounded hover:bg-viridian-green-500 md:hover:bg-transparent md:border-0 md:hover:text-viridian-green-500 md:p-0 md:w-auto">
                        <svg class="w-2.5 h-2.5 mr-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                             fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="m1 1 4 4 4-4"/>
                        </svg>
                        الفئات

                    </button>
                    <!-- Dropdown menu -->
                    <div id="dropdownNavbar2"
                         class="z-10 hidden font-normal text-right bg-white divide-y divide-gray-100 rounded-lg shadow w-32">
                        <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownLargeButton">
                            <?php
                            foreach ($categories as $category) { ?>
                                <li>
                                    <a href="shop/shop.php?category_id=<?php echo $category['category_id'] ?>"
                                       class="block px-4 py-2 hover:bg-gray-100">
                                        <?php
                                        echo $category['name']
                                        ?>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="index.php"
                       class="block py-2 pl-3 pr-4 text-viridian-green-500 rounded md:bg-transparent md:text-viridian-green-500 md:p-0"
                       aria-current="page">الرئيسية</a>
                </li>
            </ul>

        </div>
        <div class="flex flex-col items-end">
            <a href="index.php">
                <div class="flex flex-row items-center ">
                    <span class="self-center text-2xl text-viridian-green-600 font-semibold whitespace-nowrap">سعودي براند</span>
                    <div class="flex">
                        <img src="assets/images/logo.png" alt="logo" class="h-28">
                    </div>
                </div>
            </a>
        </div>
    </div>
</nav>
<!--End Navbar-->

<!--Hero Section-->
<section class="bg-cover bg-no-repeat bg-center py-36" style="background-image: url('assets/images/banner-bg.jpg');">
    <div class="flex flex-col items-center text-center">
        <div>
            <h1 class="text-6xl text-gray-800 font-medium mb-4 capitalize">
                أهلا و مرحبا بكم في سعودي براند
            </h1>
            <div class="mt-12">
                <div class="flex flex-col items-center">
                    <a href="#brands" class="bg-viridian-green-500 border border-viridian-green-500 text-white px-8 py-3 font-medium
                    rounded-md hover:bg-transparent hover:text-viridian-green-500">تسوق ألأن</a>
                </div>
            </div>
        </div>

    </div>
</section>
<!--End Hero Section-->

<!-- features -->
<section class=" px-8 py-16">
    <div class="w-10/12 grid grid-cols-1 md:grid-cols-3 gap-6 mx-auto justify-center">
        <div class="border border-viridian-green-400 rounded-sm px-3 py-6 flex justify-center items-center gap-5">
            <img src="assets/images/icons/delivery-van.svg" alt="Delivery" class="w-12 h-12 object-contain">
            <div>
                <h4 class="font-medium capitalize text-lg">شحن مجاني</h4>
                <p class="text-gray-500 text-sm"> SAR 200 شحن مجاني فوق</p>
            </div>
        </div>
        <div class="border border-viridian-green-400 rounded-sm px-3 py-6 flex justify-center items-center gap-5">
            <img src="assets/images/icons/money-back.svg" alt="Delivery" class="w-12 h-12 object-contain">
            <div>
                <h4 class="font-medium capitalize text-lg">استرجاع الأموال</h4>
                <p class="text-gray-500 text-sm"> ضمان أرجاع 30 يوم</p>
            </div>
        </div>
        <div class="border border-viridian-green-400 rounded-sm px-3 py-6 flex justify-center items-center gap-5">
            <img src="assets/images/icons/service-hours.svg" alt="Delivery" class="w-12 h-12 object-contain">
            <div>
                <h4 class="font-medium capitalize text-lg">24/7 دعم</h4>
                <p class="text-gray-500 text-sm">دعم العملاء</p>
            </div>
        </div>
    </div>
</section>
<!-- end features -->

<!--Brands-->
<div class="flex flex-col items-center" id="brands">
    <h2 class="text-2xl font-medium text-viridian-green-500 uppercase mb-6">تسوق عن طريق البراند</h2>
</div>
<div class="flex items-center justify-center w-full h-full py-14 sm:py-8 px-4">

    <div class="w-full relative flex items-center justify-center">
        <button aria-label="slide backward"
                class="absolute z-30 left-0 ml-10 focus:outline-none focus:bg-gray-400 focus:ring-2 focus:ring-offset-2 focus:ring-gray-400 cursor-pointer"
                id="prev">
            <svg class="text-viridian-green-400" width="20" height="25" viewBox="0 0 8 14" fill="none"
                 xmlns="http://www.w3.org/2000/svg">
                <path d="M7 1L1 7L7 13" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                      stroke-linejoin="round"/>
            </svg>
        </button>
        <div dir="rtl" class="w-full px-8 h-full mx-auto overflow-x-hidden overflow-y-hidden">
            <div id="slider"
                 class="h-full flex lg:gap-8 md:gap-6 gap-14 items-center justify-start transition ease-out duration-700">
                <?php foreach ($merchants as $merchant): ?>
                    <div class="flex flex-shrink-0 rounded-lg relative w-full sm:w-auto   ">
                        <a href="shop/brand.php?merchant_id=<?php echo $merchant['merchant_id'] ?>">
                            <img src="assets/uploads/<?php echo $merchant['logo'] ?>" alt="black chair and white table"
                                 class="object-contain object-center w-56 h-28"/>
                        </a>
                    </div>
                <?php endforeach; ?>


            </div>
        </div>
        <button aria-label="slide forward"
                class="absolute z-30 right-0 mr-10 focus:outline-none focus:rounded-full focus:bg-gray-400 focus:ring-2 focus:ring-offset-2 focus:ring-gray-400"
                id="next">
            <svg class="text-viridian-green-400" width="20" height="25" viewBox="0 0 8 14" fill="none"
                 xmlns="http://www.w3.org/2000/svg">
                <path d="M1 1L7 7L1 13" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                      stroke-linejoin="round"/>
            </svg>
        </button>
    </div>
</div>
<!--End Brands-->

<!-- categories -->
<section class="px-8 py-16">
    <div class="flex flex-col items-center">
        <h2 class="text-2xl font-medium text-viridian-green-500 uppercase mb-6">تسوق عن طريق الفئة</h2>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
        <div class="relative rounded-sm overflow-hidden group">
            <img src="assets/images/cloth1.jpg" alt="category 1" class="w-full">
            <a href="shop/shop.php?category_id=3"
               class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center text-xl text-white font-roboto font-medium group-hover:bg-opacity-60 transition">الملابس
                و الأزياء</a>
        </div>
        <div class="relative rounded-sm overflow-hidden group">
            <img src="assets/images/books.jpeg" alt="category 1" class="w-full h-full">
            <a href="shop/shop.php?category_id=2"
               class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center text-xl text-white font-roboto font-medium group-hover:bg-opacity-60 transition">الكتب
                والوسائط المطبوعة</a>
        </div>
        <div class="relative rounded-sm overflow-hidden group">
            <img src="assets/images/best-makeup-subscription-boxes-2000-79dec308645649ff831f8b242a6d380f.jpg"
                 alt="category 1" class="w-full">
            <a href="shop/shop.php?category_id=1"
               class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center text-xl text-white font-roboto font-medium group-hover:bg-opacity-60 transition">العناية
                الشخصية و الجمال
            </a>
        </div>
        <div class="relative rounded-sm overflow-hidden group h-96">
            <img src="assets/images/category-1.jpg" alt="category 1" class="w-full h-full">
            <a href="shop/shop.php?category_id=6"
               class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center text-xl text-white font-roboto font-medium group-hover:bg-opacity-60 transition">الأثاث
                و المفروشات</a>
        </div>
        <div class="relative rounded-sm overflow-hidden group h-96">
            <img src="assets/images/electronics.png" alt="category 1" class="w-full h-full">
            <a href="shop/shop.php?category_id=5"
               class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center text-xl text-white font-roboto font-medium group-hover:bg-opacity-60 transition">
                الإلكترونيات و ألأجهزة الكهربائية </a>
        </div>
        <div class="relative rounded-sm overflow-hidden group h-96">
            <img src="assets/images/commdites.jpg" alt="category 1" class="w-full h-full">
            <a href="shop/shop.php?category_id=4"
               class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center text-xl text-white font-roboto font-medium group-hover:bg-opacity-60 transition">السلع
                المنزلية</a>
        </div>
    </div>
</section>
<!-- end categories -->
<?php
if (isset($_POST['product_id'], $_POST['quantity'], $_POST['add_to_cart']) && is_numeric($_POST['product_id']) && is_numeric($_POST['quantity'])) {
    // Set the post variables and make sure they are integers
    $product_id = (int)$_POST['product_id'];
    $quantity = (int)$_POST['quantity'];
    // Check if product exists in database
    $stmt = $con->prepare('SELECT * FROM product WHERE product_id = ?');
    $stmt->execute([$_POST['product_id']]);
    // Fetch the product from the database and return the result as an Array
    $product_cart = $stmt->fetch(PDO::FETCH_ASSOC);
    // Check if the product exists
    if ($product_cart && $quantity > 0) {
        // Create/update the session variable for the cart
        if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
            if (array_key_exists($product_id, $_SESSION['cart'])) {
                // Product exists in cart so just update the quantity
                $_SESSION['cart'][$product_id] += $quantity;
            } else {
                // Product is not in cart so add it
                $_SESSION['cart'][$product_id] = $quantity;
            }
        } else {
            // There are no products in cart, this will add the first product to cart
            $_SESSION['cart'] = array($product_id => $quantity);
        }
    }
    // Prevent form resubmission...
    header("Refresh:1.5");
    $success_msg[] = '! تم ألإضافة الي العربة';

}
?>
<!-- new arrival -->
<div class="px-8 pb-16">
    <div class="flex flex-col items-center">
        <h2 class="text-2xl font-medium text-viridian-green-500 uppercase mb-6">أحدث الإضافات</h2>
    </div>
    <div dir="rtl" class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <?php
        foreach ($products as $product) {
            ?>
            <div class="shadow-2xl rounded overflow-hidden group">
                <div class="relative">
                    <img src="assets/uploads/<?php echo $product['image'] ?>" alt="product 1"
                         style="width: 450px; height: 300px;">
                    <a href="shop/product.php?product_id=<?php echo $product['product_id']; ?>">
                        <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center
                    justify-center gap-2 opacity-0 group-hover:opacity-100 transition">

                        </div>
                    </a>

                </div>
                <div class="flex flex-col  pt-4 pb-3 px-4">
                    <a href="shop/product.php?product_id=<?php echo $product['product_id']; ?>">
                        <h4 class="uppercase font-medium text-xl mb-2 text-gray-800 hover:text-viridian-green-400 transition">
                            <?php
                            echo $product['product_name']
                            ?>
                        </h4>
                    </a>
                    <div class="flex items-baseline mb-1 space-x-2">
                        <p class="text-xl text-viridian-green-400 font-semibold">
                            <?php
                            echo $product['price']
                            ?> SAR
                        </p>
                    </div>

                    <div class="flex items-center">
                        <div class="text-s text-gray-500 ml-3">
                            <?php
                            echo $product['name']
                            ?>
                        </div>
                    </div>


                    <div class="flex items-center">
                        <?php
                        $product_id = $product['product_id'];
                        $comments = $con->query("SELECT AVG(stars) AS stars FROM comment WHERE product_id='$product_id'");
                        foreach ($comments as $comment):?>
                            <?php
                            if (empty($comment['stars'])):?>
                                <div class="flex items-center py-4">
                                </div>
                            <?php else: ?>
                                <div class="flex items-center">
                                    <span style="color: #ffd500; font-size: 24px"><?php echo str_repeat('&#9733;', $comment['stars']) ?> </span>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>

                </div>

                <form method="post">
                    <input value="1" min="0" name="quantity" type="hidden">
                    <input type="hidden" name="product_id" value="<?= $product['product_id'] ?>">
                    <button type="submit" name="add_to_cart"
                            class="block w-full py-2 text-center text-white bg-green-700 border border-viridian-green-400 rounded-b hover:bg-transparent hover:text-viridian-green-400 transition">
                        أضف إلي العربة
                    </button>

                </form>
            </div>
        <?php } ?>
    </div>
</div>
<!-- ./new arrival -->

<!-- ads -->
<div class="px-8 pb-16">

    <div aria-label="#about" class="2xl:container 2xl:mx-auto lg:py-16 lg:px-20 md:py-12 md:px-6 py-9 px-4">
        <div class="flex flex-col lg:flex-row justify-between gap-8">
            <div class="w-full lg:w-8/12">
                <img class="w-full h-full" src="https://i.ibb.co/FhgPJt8/Rectangle-116.png" alt="A group of People"/>
            </div>
            <div class=" w-full lg:w-5/12 flex flex-col justify-center text-right text-center">
                <h1 class="text-3xl lg:text-4xl font-bold leading-9 text-gray-800  pb-4">من نحن</h1>
                <p class="font-normal text-base leading-6 text-xl text-gray-600 ">
                    متجرنا الإلكتروني هو وجهتك المثالية لاكتشاف وشراء البراندات السعودية عبر الإنترنت. نحن نهدف إلى
                    تعزيز المنتجات المحلية وتقديم مجموعة متنوعة من العلامات التجارية السعودية ذات الجودة العالية
                    والتصاميم الرائعة لعملائنا.
                </p>

                <p class="font-normal pt-3 text-base leading-6 text-xl text-gray-600">
                    يتميز متجرنا بتوفير تجربة تسوق ممتعة وسهلة للعملاء. يمكن للعملاء تصفح مجموعتنا المتنوعة من البراندات
                    السعودية المشهورة وعرض التفاصيل والمعلومات حول كل براند بسهولة. نحن نعمل على توفير وصف دقيق لكل
                    براند يشمل معلومات حول تاريخ البراند وقصته ومفهومه والمنتجات التي يقدمها.
                </p>


            </div>

        </div>

    </div>

</div>
<!-- ./ads -->

<!--Footer Section-->
<footer class="bg-viridian-green-200 inset-x-0 bottom-0 mt-3 shadow-lg rounded">
    <div class="w-full max-w-screen-xl mx-auto p-4 md:py-8">
        <div class="sm:flex sm:items-center sm:justify-between">
            <span class="block text-sm text-right text-gray-500 sm:text-center dark:text-gray-400"> 2023 © <span>جميع الحقوق محفوظة</span> سعودي براند</span>


            <div class="flex flex-col items-end">
                <a href="index.php">
                    <div class="flex flex-row items-center ">
                        <span class="self-center text-2xl text-viridian-green-600 font-semibold whitespace-nowrap">سعودي براند</span>
                        <div class="flex">
                            <img src="assets/images/logo.png" alt="logo" class="h-28">
                        </div>
                    </div>
                </a>
            </div>

        </div>
    </div>
</footer>
<!--End Footer Section-->

<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>
<script>
    let defaultTransform = 0;

    function goNext() {
        defaultTransform = defaultTransform - 398;
        var slider = document.getElementById("slider");
        if (Math.abs(defaultTransform) >= slider.scrollWidth / 1.7) defaultTransform = 0;
        slider.style.transform = "translateX(" + defaultTransform + "px)";
    }

    next.addEventListener("click", goNext);

    function goPrev() {
        var slider = document.getElementById("slider");
        if (Math.abs(defaultTransform) === 0) defaultTransform = 0;
        else defaultTransform = defaultTransform + 398;
        slider.style.transform = "translateX(" + defaultTransform + "px)";
    }

    prev.addEventListener("click", goPrev);

</script>
<script>
    $(document).ready(function () {
        $('#getName').on("keyup", function () {
            var getName = $(this).val();
            $.ajax({
                method: 'POST',
                url: 'search-product.php',
                data: {name: getName},

                success: function (response) {
                    if (getName.length) {
                        $("#showData").html(response);

                    } else {
                        $("#showData").empty()
                    }
                }
            });
        });
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<?php include "alert.php"; ?>
</body>

</html>
