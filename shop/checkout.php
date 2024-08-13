<?php
ob_start();
session_start();
if (!(isset($_SESSION['customer_id']))) {
    header('Location: ../login.php');
}
include "../connection.php";
include "cart_functions.php";
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

$shipping_query = $con->query("SELECT * FROM merchant left join brands.shipping_company sc on sc.shipping_company_id = merchant.shipping_company_id");
$shipping_query->execute();
$shipping= $shipping_query->fetch();
?>
<!doctype html>
<html lang="ar" xmlns="http://www.w3.org/1999/html">
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

<!-- wrapper -->
<div class="flex flex-row  text-right h-screen items-start px-8 pb-16 pt-8 gap-6">

    <div class="w-full">
        <?php
        if (isset($_POST['submit'])) {
            $price = $_POST['total'];
            $shipping_company = $shipping['shipping_company_id'];
            $shipping_price = $new_tax;
            if ($price <= 0) {
                echo '<div id="alert-2" dir="rtl" class="flex items-center p-4 m-4 text-white rounded-lg bg-red-500 " role="alert">
                                        <div class="ml-3 text-xl font-medium">
برجاء اضافة منتجات أولا !                                                
                                        </div>
                                        <button type="button" class="mr-auto -mx-1.5 -my-1.5 bg-red-500 text-white rounded-lg focus:ring-2 focus:ring-red-500 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#alert-2" aria-label="Close">
                                            <span class="sr-only">اغلاق</span>
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                            </svg>
                                        </button>
                                     </div>';

            } else {
                $sql = "INSERT INTO orders (customer_id, shipping_company_id, date, total_price, shipping_price) VALUES ('$customer_id','$shipping_company',  NOW(), '$price', '$shipping_price') ";
                $result = $con->exec($sql);
                $order_id = $con->lastInsertId();
                foreach ($products as $product) {
                    $product_id = $product['product_id'];
                    $quantity = $products_in_cart[$product_id]; // Retrieve quantity directly from $products_in_cart

                    // Insert the order products
                    $sql2 = "INSERT INTO order_product (order_id, product_id, order_quantity) VALUES ('$order_id', '$product_id', '$quantity')";
                    $result2 = $con->exec($sql2);

                    // Update product quantity
                    $new_quantity = $product['quantity'] - $quantity;
                    $sql3 = "UPDATE product SET quantity='$new_quantity' WHERE product_id='$product_id'";
                    $result3 = $con->exec($sql3);
                }

                unset($_SESSION['cart']);

                header('Location: thankyou.php?message=success_msg');
            }
        }
        ?>
        <div dir="rtl" class=" bg-white col-span-4 w-full border border-gray-200 p-4 rounded">
            <h4 class="text-gray-800 text-lg mb-4 font-medium uppercase">تفاصيل الطلب</h4>
            <?php foreach ($products as $product): ?>
                <div class="space-y-2">
                    <div class="flex justify-between pb-3">
                        <div>
                            <h5 class="text-gray-800 font-medium">
                                <?php echo $product['product_name']; ?>
                            </h5>
                        </div>
                        <p class="text-gray-600 flex flex-col items-center">
                            x <?php echo $products_in_cart[$product['product_id']] ?>
                        </p>
                        <p class="text-gray-800 font-medium">
                            SAR <?php echo $product['price'] * $products_in_cart[$product['product_id']] ?>
                        </p>
                    </div>

                </div>
            <?php endforeach; ?>


            <div class="flex justify-between border-b border-gray-200 mt-1 text-gray-800 font-medium py-3 uppercase">
                <p>المجموع الفرعي</p>
                <p>SAR <?php echo $subtotal ?></p>
            </div>

            <div class="flex justify-between border-b border-gray-200 mt-1 text-gray-800 font-medium py-3 uppercase">
                <p>مصاريف شركة الشحن</p>
                <p>SAR <?php echo $merchant_fees ?></p>
            </div>
            <div class="flex justify-between border-b border-gray-200 mt-1 text-gray-800 font-medium py-3 uppercase">
                <p>مصاريف شحن التاجر</p>
                <p>SAR <?php echo $shipping_fees ?></p>
            </div>

            <div class="flex justify-between text-gray-800 font-medium py-3 uppercase">
                <label for="subtotal" class="font-semibold">المبلغ ألإجمالي</label>
                <p>SAR <?php echo $total ?></p>
            </div>

        </div>

    </div>

    <div class="col-span-8 border w-full bg-white border-gray-200 p-4 rounded">
        <h3 class="text-lg font-medium capitalize mb-4">الدفع</h3>
        <?php

        $query = $con->query("SELECT * FROM customer WHERE customer_id='$customer_id'");

        $query->execute();
        $customer = $query->fetch();
        ?>
        <form method="post">
            <div class="space-y-4 md:space-y-6">
                <div class="flex flex-col items-end">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 items-end">الاسم</label>
                    <input dir="rtl" type="text" name="name" id="name" value="<?php echo $customer['name'] ?>" disabled
                           class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5   "
                           required="">
                </div>

                <div class="flex flex-col items-end">

                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 items-end">البريد
                        الإلكتروني</label>
                    <input dir="rtl" type="email" name="email" id="email" value="<?php echo $customer['email'] ?>" disabled
                           class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5   "
                           required="">
                </div>

                <div class="flex flex-col items-end">
                    <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 ">رقم الهاتف</label>
                    <input dir="rtl" type="text" name="phone" id="phone" value="<?php echo $customer['phone_number'] ?>"
                           disabled
                           class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5   "
                           required="">
                </div>

                <div class="flex flex-col items-end">
                    <label for="city" class="block mb-2 text-sm font-medium text-gray-900 ">المدينة</label>
                    <input dir="rtl" type="text" name="city" id="city" value="<?php echo $customer['city'] ?>" disabled
                           class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5   "
                           required="">
                </div>

                <div class="flex flex-col items-end">
                    <label for="street" class="block mb-2 text-sm font-medium text-gray-900 ">الشارع</label>
                    <input dir="rtl" type="text" name="street" id="street" value="<?php echo $customer['street'] ?>"
                           disabled
                           class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5   "
                           required="">
                </div>

                <div class="flex flex-col items-end">
                    <label for="payment_methods" class="block mb-2 text-sm font-medium text-gray-900 ">طرق الدفع</label>
                    <select required name="payment_methods" dir="rtl"
                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5   ">
                        <option value="كريدت كارد">كريدت كارد</option>
                        <option selected value="الدفع نقدا">الدفع نقدا</option>
                        <option value="فيزا">فيزا</option>
                    </select>
                </div>

                <div class="flex flex-col items-end">
                    <label for="neighborhood" class="block mb-2 text-sm font-medium text-gray-900 ">الحي</label>
                    <input dir="rtl" type="text" name="neighborhood" id="neighborhood"
                           value="<?php echo $customer['district'] ?>" disabled
                           class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5   "
                           required="">
                </div>
                <div class="flex flex-col items-end">
                    <label for="shipping_company" class="block mb-2 text-sm font-medium text-gray-900 ">شركة الشحن</label>
                    <input dir="rtl" type="text" name="shipping_company" id="shipping_company"
                           value="<?php echo $shipping['name'] ?>" disabled
                           class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5   "
                           required="">

                </div>


            </div>
            <input type="hidden" name="total" value="<?php echo $total ?>">
            <button type="submit" name="submit"
                    class="block mt-5 w-full py-3 px-4 text-center text-white bg-green-600 border border-viridian-green-500 rounded-md hover:bg-transparent hover:text-viridian-green-500 transition font-medium">
                إتمام الدفع
            </button>
        </form>

    </div>

</div>
<!-- ./wrapper -->

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
