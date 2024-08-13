<?php
ob_start();
session_start();
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
}
if (isset($_SESSION['merchant_id'])) {

    $session_merchant_id = $_SESSION['merchant_id'];
}
if (isset($_SESSION['admin_id'])) {

    $admin_id = $_SESSION['admin_id'];
}
if (isset($_SESSION['shipping_company_id'])) {

    $shipping_company_id = $_SESSION['shipping_company_id'];
}
include "../connection.php";
$product_id = isset($_GET['product_id']) && is_numeric($_GET['product_id']) ? intval($_GET['product_id']) : 0;
$categories = $con->query("SELECT * FROM category");
$query = $con->prepare("SELECT * FROM product JOIN merchant ON product.merchant_id = merchant.merchant_id  WHERE  product_id='$product_id'");
$query->execute();
$product = $query->fetch();
$comments = $con->query("SELECT * FROM comment LEFT JOIN brands.user u on comment.user_id = u.user_id WHERE product_id='$product_id'");
$comment_count = $comments->rowCount();

$message = isset($_GET['message']);
?>

<!doctype html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="../assets/css/output.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.css" rel="stylesheet"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=El+Messiri:wght@400;500;600;700&display=swap" rel="stylesheet">
    <title>سعودي براند</title>
</head>
<body class="bg-gray-50">

<!--Navbar-->
<nav class="bg-viridian-green-200 border-b shadow-lg rounded lg:mb-2">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">

        <div class="flex flex-col md:flex-row items-center">
            <?php if (isset($user_id)): ?>
                <div class="md:ml-4 mt-3 md:mt-0">
                    <a href="../users/profile.php">
                        <img src="../assets/images/profile-user.png" alt="profile image"
                             class="-mt-px w-5 h-5 text-gray-800">
                    </a>
                </div>
            <?php elseif (isset($session_merchant_id)): ?>
                <div class="md:ml-4 mt-3 md:mt-0">
                    <a href="../merchants/products.php">
                        <img src="../assets/images/profile-user.png" alt="profile image"
                             class="-mt-px w-5 h-5 text-gray-800">
                    </a>
                </div>
            <?php elseif (isset($admin_id)): ?>
                <div class="md:ml-4 mt-3 md:mt-0">
                    <a href="../admin/customer/customers.php">
                        <img src="../assets/images/profile-user.png" alt="profile image"
                             class="-mt-px w-5 h-5 text-gray-800">
                    </a>
                </div>
            <?php elseif (isset($shipping_company_id)): ?>
                <div class="md:ml-4 mt-3 md:mt-0">
                    <a href="../shipping_company/orders.php">
                        <img src="../assets/images/profile-user.png" alt="profile image"
                             class="-mt-px w-5 h-5 text-gray-800">
                    </a>
                </div>
            <?php endif; ?>
            <div class="md:ml-4 mt-3 md:mt-0">
                <a href="cart.php">
                    <div class="mb-5 text-yellow-200">

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
                        <a href="../logout.php"
                           class="block py-2 pl-3 pr-4 text-white rounded hover:bg-viridian-green-500 md:hover:bg-transparent md:hover:text-viridian-green-500 md:p-0">تسجيل
                            خروج</a>
                    </li>
                <?php else : ?>
                    <li>
                        <a href="../login.php"
                           class="block py-2 pl-3 pr-4 text-white rounded hover:bg-viridian-green-500 md:hover:bg-transparent md:hover:text-viridian-green-500 md:p-0">تسجيل
                            دخول</a>
                    </li>
                    <li>
                        <a href="../signup.php"
                           class="block py-2 pl-3 pr-4 text-white rounded hover:bg-viridian-green-500 md:hover:bg-transparent md:hover:text-viridian-green-500 md:p-0">التسجيل</a>
                    </li>
                <?php endif; ?>
                <li>
                    <a href="brands.php"
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
                                    <a href="shop.php?category_id=<?php echo $category['category_id'] ?>"
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
                    <a href="../index.php"
                       class="block py-2 pl-3 pr-4 text-white rounded md:bg-transparent md:text-viridian-green-500 md:p-0"
                       aria-current="page">الرئيسية</a>
                </li>
            </ul>

        </div>
        <div class="flex flex-col items-end">
            <a href="../index.php">
                <div class="flex flex-row items-center ">
                    <span class="self-center text-2xl text-viridian-green-600 font-semibold whitespace-nowrap">سعودي براند</span>
                    <div class="flex">
                        <img src="../assets/images/logo.png" alt="logo" class="h-28">
                    </div>
                </div>
            </a>
        </div>
    </div>
</nav>
<!--End Navbar-->


<!-- product-detail -->
<div class="px-8 pt-4 grid grid-cols-2 gap-6">

    <div class="flex flex-col items-end text-right">
        <h2 class="text-3xl font-medium uppercase mb-2">
            <?php
            echo $product['product_name']
            ?>
        </h2>
        <div class="flex items-center">
            <?php
            $product_id = $product['product_id'];
            $comments_stars = $con->query("SELECT AVG(stars) AS stars FROM comment WHERE product_id='$product_id'");
            foreach ($comments_stars as $comments_star):?>
                <?php
                if (empty($comments_star['stars'])):?>
                    <div class="flex items-center py-4">
                    </div>
                <?php else: ?>
                    <div class="flex items-center">
                        <span style="color: #ffd500; font-size: 24px"><?php echo str_repeat('&#9733;', $comments_star['stars']) ?> </span>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>

        <div class="space-y-2">
            <p class="text-gray-800 font-semibold space-x-2">
                <span> متاح</span>
                <span class="text-green-600">: <?php echo $product['quantity'] ?></span>
            </p>

            <p class="space-x-2">

                <span class="text-gray-600 ">براند</span>
                <a href="brand.php?merchant_id=<?php echo $product['merchant_id'] ?>">
                    <span class="text-gray-800 text-lg hover:text-green-500 font-semibold">: <?php
                        echo $product['name']
                        ?></span>
                </a>
            </p>
            <p class="space-x-2">
                <span class="text-gray-600">فئة</span>
                <span class="text-gray-800 font-semibold">: <?php
                    echo $product['category_id']
                    ?></span>
            </p>


        </div>
        <div class="flex items-baseline mb-1 space-x-2 font-roboto mt-4">
            <p class="text-xl text-viridian-green-500 font-semibold">
                <?php
                echo $product['price']
                ?> SAR</p>
        </div>

        <p class="mt-4 text-gray-600">
            <?php
            echo $product['description']
            ?>
        </p>

        <?php
        if (isset($_POST['product_id'], $_POST['quantity'], $_POST['add_to_cart']) && is_numeric($_POST['product_id']) && is_numeric($_POST['quantity'])) {
            // Set the post variables and make sure they are integers
            $product_id = (int)$_POST['product_id'];
            $quantity = (int)$_POST['quantity'];
            // Check if product exists in database
            $stmt = $con->prepare('SELECT * FROM product WHERE product_id = ?');
            $stmt->execute([$_POST['product_id']]);
            // Fetch the product from the database and return the result as an Array
            $product = $stmt->fetch(PDO::FETCH_ASSOC);
            // Check if the product exists
            if ($product && $quantity > 0) {
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
        <form method="post">
            <div class="mt-4 flex flex-col items-end">
                <h3 class="text-sm text-gray-800 uppercase mb-1">الكَمّيَّة</h3>
                <div class="flex border border-gray-300 text-gray-600 divide-x divide-gray-300 w-max">
                    <input value="1" dir="rtl" min="0" name="quantity" type="number" max="<?= $product['quantity'] ?>">
                </div>
            </div>
            <input type="hidden" name="product_id" value="<?= $product['product_id'] ?>">
            <div class=" flex gap-3 border-b border-gray-200 pb-5 pt-5">
                <button type="submit" name="add_to_cart"
                        class="bg-green-500 border border-viridian-green-500 text-white px-8 py-2 font-medium rounded uppercase flex items-center gap-2 hover:bg-transparent hover:text-viridian-green-500 transition">
                    أضف إلي العربة
                </button>
            </div>
        </form>

    </div>

    <div class="flex flex-col items-end text-right">
        <img src="../assets/uploads/<?php echo $product['image'] ?>" alt="product" class="w-full"
             style="width: 900px; height: 600px;">
    </div>


</div>
<!-- ./product-detail -->

<!-- description -->
<div class="px-8 pb-16 pt-8 flex flex-col items-end text-right">
    <h2 class="border-b border-gray-200 text-xl font-roboto text-gray-800 pb-3 font-medium">معلومات المنتج</h2>
    <div class="w-3/5 pt-6">
        <div class="text-gray-600">
            <p class="mt-4 text-lg">
                <?php
                echo $product['description']
                ?>
            </p>
        </div>

    </div>
</div>
<!-- ./description -->

<div class="px-8 py-12 lg:py-16">
    <?php
    if (isset($_POST['comment'])) {
        $review = $_POST['review'];
        if (empty($user_id)) {
            $warning_msg[] = 'برجاء تسجيل الدخول لأضافه تعليق';
        } elseif (empty($_POST['rating'])) {
            $warning_msg[] = 'برجاء اضافة تقييم';
        } else {
            $stars = $_POST['rating'];
            $sql = "INSERT INTO comment (product_id, user_id, comment, stars, date) VALUES ('$product_id', '$user_id', '$review', '$stars', NOW())";
            $result = $con->exec($sql);
            header("Refresh:2");
            $success_msg[] = 'تم اضافة التعليق';
        }

    }
    ?>
    <div class="flex flex-col text-right">

        <div class="flex flex-col justify-between items-end text-right mb-6">
            <h2 class="text-lg lg:text-2xl font-bold text-gray-900 dark:text-white">التعليقات
                (<?php echo $comment_count ?>)</h2>
        </div>
        <?php if (empty($user_id)): ?>
        <?php else: ?>
            <form class="mb-6" method="post">

                <div class="py-2 px-4 mb-4 bg-white rounded-lg rounded-t-lg border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                    <label for="review" class="sr-only">Your comment</label>
                    <textarea id="review" rows="4" name="review"
                              class="px-0 w-full text-sm text-gray-900 border-0 focus:ring-0 focus:outline-none text-right"
                              placeholder="اضف تعليق" required></textarea>
                </div>
                <div class="flex flex-col text-right items-end">
                    <!-- Rating Values 1-5 -->

                    <div class="flex">
                        <div class="flex items-center mr-4">
                            <input id="rating" type="radio" value="5" name="rating">
                            <label for="rating" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                5 &#9733;
                            </label>
                        </div>
                        <div class="flex items-center mr-4">
                            <input id="rating" type="radio" value="4" name="rating">
                            <label for="rating" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                4 &#9733;
                            </label>
                        </div>
                        <div class="flex items-center mr-4">
                            <input id="rating" type="radio" value="3" name="rating">
                            <label for="rating" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                3 &#9733;
                            </label>
                        </div>
                        <div class="flex items-center mr-4">
                            <input id="rating" type="radio" value="2" name="rating">
                            <label for="rating" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                2 &#9733;
                            </label>
                        </div>
                        <div class="flex items-center mr-4">
                            <input id="rating" type="radio" value="1" name="rating">
                            <label for="rating" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                1 &#9733;
                            </label>
                        </div>


                    </div>


                    <button type="submit" name="comment"
                            class="bg-green-500 mt-4 border border-viridian-green-500 text-white px-8 py-2 font-medium rounded uppercase flex items-center gap-2 hover:bg-transparent hover:text-viridian-green-500 transition">
                        أضف تعليق
                    </button>
                </div>

            </form>
        <?php endif; ?>
        <?php

        foreach ($comments as $comment):
            ?>
            <article class="p-6 mb-6 text-base bg-white rounded-lg ">
                <footer class="flex flex-col justify-between items-end text-right mb-2">
                    <div class="flex items-center">
                        <p class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white">
                            <?php echo $comment['name']
                            ?>
                        </p>
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            <time><?php echo $comment['date'] ?></time>
                        </p>
                    </div>
                </footer>
                <div class="flex flex-col items-end text-right">

                    <p class="text-gray-500 dark:text-gray-400"><?php echo $comment['comment'] ?></p>
                </div>
            </article>
            <?php
            if (empty($comment['reply'])): ?>

            <?php else: ?>
                <article class="p-6 mb-3 mr-8 lg:mr-12 text-base bg-white rounded-lg ">
                <footer class="flex flex-col justify-between items-end mb-2 text-right">
                    <div class="flex items-center">

                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            <time><?php echo $comment['date'] ?></time>
                        </p>
                    </div>

                </footer>


                <p class="text-gray-500 dark:text-gray-400"><?php echo $comment['reply'] ?></p>
            <?php endif; ?>
            </article>
        <?php endforeach; ?>


    </div>

</div>


<!--Footer Section-->
<footer class="bg-viridian-green-200 inset-x-0 bottom-0 mt-3 shadow-lg rounded">
    <div class="w-full max-w-screen-xl mx-auto p-4 md:py-8">
        <div class="sm:flex sm:items-center sm:justify-between">
            <span class="block text-sm text-right text-gray-500 sm:text-center dark:text-gray-400"> 2023 © <span>جميع الحقوق محفوظة</span> سعودي براند</span>


            <div class="flex flex-col items-end">
                <a href="../index.php">
                    <div class="flex flex-row items-center ">
                        <span class="self-center text-2xl text-viridian-green-600 font-semibold whitespace-nowrap">سعودي براند</span>
                        <div class="flex">
                            <img src="../assets/images/logo.png" alt="logo" class="h-28">
                        </div>
                    </div>
                </a>
            </div>

        </div>
    </div>
</footer>
<!--End Footer Section-->

<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $('#getName').on("keyup", function () {
            var getName = $(this).val();
            $.ajax({
                method: 'POST',
                url: '../search-product.php',
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
<?php include "../alert.php"; ?>
</body>
</html>
