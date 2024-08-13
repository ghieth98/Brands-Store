<?php
ob_start();
session_start();
include "../connection.php";
$categories = $con->query("SELECT * FROM category");
if (isset($_SESSION['customer_id'])) {

    $customer_id = $_SESSION['customer_id'];
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
    <title>متجر براند</title>
</head>
<body class="bg-gray-50">

<!--Navbar-->
<nav class="bg-viridian-green-200 border-b shadow-lg rounded lg:mb-2">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">

        <div class="flex flex-col md:flex-row items-center">
            <?php if (isset($customer_id)): ?>
                <div class="md:ml-4 mt-3 md:mt-0">
                    <a href="../customers/profile.php">
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

                <?php if (isset($customer_id) || isset($merchant_id) || isset($admin_id) || isset($shipping_company_id)): ?>
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
                    <span class="self-center text-2xl text-viridian-green-600 font-semibold whitespace-nowrap">متجر براند</span>
                    <div class="flex">
                        
                    </div>
                </div>
            </a>
        </div>
    </div>
</nav>
<!--End Navbar-->
<?php
include "cart_functions.php";
?>
<div class="px-8 flex flex-row text-right h-screen items-start  pt-8 gap-6">
    <div class="w-full">
        <?php if (empty($_SESSION['cart'])):  ?>
        <?php else:  ?>
        <form action="checkout.php" method="post">
            <div class="col-span-4 w-full border border-gray-200 p-4 rounded">
                <h4 class="text-gray-800 text-lg mb-4 font-medium uppercase">تفاصيل الطلب</h4>
                <?php foreach ($products as $product): ?>

                    <div class="space-y-2">
                        <div class="flex justify-between pb-3">
                            <p class="text-gray-800 font-medium">
                                SAR <?php echo $product['price'] * $products_in_cart[$product['product_id']] ?>
                            </p>
                            <p class="text-gray-600 flex flex-col items-center">
                                x <?php echo $products_in_cart[$product['product_id']] ?>
                            </p>
                            <div>
                                <h5 class="text-gray-800 font-medium">   <?php echo $product['product_name']; ?></h5>
                            </div>
                        </div>

                    </div>
                <?php endforeach; ?>

                <div class="flex justify-between border-b border-gray-200 mt-1 text-gray-800 font-medium py-3 uppercase">
                    <p>SAR <?php echo $subtotal ?></p>
                    <p>المجموع الفرعي</p>
                </div>

                <div class="flex justify-between border-b border-gray-200 mt-1 text-gray-800 font-medium py-3 uppercase">
                    <p>SAR <?php echo $merchant_fees ?></p>
                    <p>مصاريف شركة الشحن</p>
                </div>
                <div class="flex justify-between border-b border-gray-200 mt-1 text-gray-800 font-medium py-3 uppercase">
                    <p>SAR <?php echo $shipping_fees ?></p>
                    <p>مصاريف شحن التاجر</p>
                </div>

                <div class="flex justify-between text-gray-800 font-medium py-3 uppercase">
                    <p>SAR <?php echo $total ?></p>
                    <p class="font-semibold">المبلغ ألإجمالي</p>
                </div>

                <?php if (empty($products_in_cart)): ?>

                <?php else : ?>
                    <button name="checkout" type="submit"
                            class="block mt-3 w-full py-3 px-4 text-center text-white bg-green-600 border border-viridian-green-500 rounded-md hover:bg-transparent hover:text-viridian-green-500 transition font-medium">
                        الذهاب
                        إلي الدفع
                    </button>
                <?php endif ?>
            </div>
        </form>
        <?php endif;  ?>
    </div>

    <div class="pt-4 w-full col-span-4">
        <div class="bg-white mt-8 rounded-lg shadow-md p-6 mb-4">
            <table class="w-full text-sm text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                    </th>
                    <th scope="col" class="px-6 py-3">
                        المبلغ ألإجمالي
                    </th>
                    <th scope="col" class="px-6 py-3">
                        الكمية
                    </th>
                    <th scope="col" class="px-6 py-3">
                        السعر
                    </th>
                    <th scope="col" class="px-6 py-3">
                        الاسم
                    </th>
                </tr>
                </thead>
                <tbody>
                <?php if (empty($products)): ?>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        </th>
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        </th>
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            لا يوجد منتجات في العربة

                        </th>
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        </th>
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        </th>
                    </tr>
                <?php else: ?>
                    <?php foreach ($products as $product): ?>

                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">

                            </th>
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                SAR <?php echo $product['price'] * $products_in_cart[$product['product_id']] ?>
                            </th>
                            <td class="px-6 py-4">
                                <?php echo $products_in_cart[$product['product_id']] ?>
                            </td>
                            <td class="px-6 py-4">
                                SAR <?php echo $product['price'] ?>
                            </td>
                            <td class="px-6 py-4">
                                <?php echo $product['product_name']; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>


<!--Footer Section-->
<footer class="bg-viridian-green-200 inset-x-0 bottom-0 mt-3 shadow-lg rounded">
    <div class="w-full max-w-screen-xl mx-auto p-4 md:py-8">
        <div class="sm:flex sm:items-center sm:justify-between">
            <span class="block text-sm text-right text-gray-500 sm:text-center dark:text-gray-400"> 2023 © <span>جميع الحقوق محفوظة</span> متجر براند</span>


            <div class="flex flex-col items-end">
                <a href="../index.php">
                    <div class="flex flex-row items-center ">
                        <span class="self-center text-2xl text-viridian-green-600 font-semibold whitespace-nowrap">متجر براند</span>
                        <div class="flex">
                            
                        </div>
                    </div>
                </a>
            </div>

        </div>
    </div>
</footer>
<!--End Footer Section-->


</body>
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
</html>
