<?php
session_start();
if (!(isset($_SESSION['email']))) {
    header('Location:../login.php');
}
include "../connection.php";
$user_id = $_SESSION['user_id'];
$orders = $con->query("SELECT * FROM orders JOIN brands.product p on p.product_id = orders.product_id WHERE user_id='$user_id'");
?>
<!doctype html>
<html lang="ar" x-data="data()">
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
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script src="./assets/js/init-alpine.js"></script>
    <title>متجر براند</title>
</head>
<body>


<div class=" bg-gray-50 h-screen">

    <nav class="bg-viridian-green-200 border-b shadow-lg rounded lg:mb-2">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">

            <div class="flex flex-col md:flex-row items-center"></div>

            <button data-collapse-toggle="navbar-dropdown" type="button"
                    class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200"
                    aria-controls="navbar-dropdown" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
            </button>

            <div class="hidden w-full md:block md:w-auto" id="navbar-dropdown">
                <ul class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg md:flex-row md:space-x-8 md:mt-0 md:border-0">

                    <li>
                        <a href="../logout.php"
                           class="block py-2 pl-3 pr-4 text-white rounded hover:bg-viridian-green-500 md:hover:bg-transparent md:hover:text-viridian-green-500 md:p-0">تسجيل
                            خروج</a>
                    </li>
                    <li>
                        <a href="return_order.php"
                           class="block py-2 pl-3 pr-4  text-viridian-green-500 rounded hover:bg-viridian-green-500 md:hover:bg-transparent md:hover:text-viridian-green-500 md:p-0">طلبات
                            الإرجاع</a>
                    </li>
                    <li>
                        <a href="orders.php"
                           class="block py-2 pl-3 pr-4 text-white rounded hover:bg-viridian-green-500 md:hover:bg-transparent md:hover:text-viridian-green-500 md:p-0">الطلبات</a>
                    </li>
                    <li>
                        <a href="profile.php"
                           class="block py-2 pl-3 pr-4 text-white rounded hover:bg-viridian-green-500 md:hover:bg-transparent md:hover:text-viridian-green-500 md:p-0">الملف
                            الشخصي</a>
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


    <div class="flex flex-col flex-1 w-full">
        <?php
        //            Check if submit is empty
        if (isset($_POST['submit'])) {
            $product = $_POST['product'];
            $description = $_POST['description'];
//            Check if return order has already been issued
            $return_order_query = $con->query("SELECT * FROM return_order WHERE product_id='$product'");
            $return_order_query->execute();
            $return_orders = $return_order_query->fetchAll();
            $return_orders_count = $return_order_query->rowCount();

            if ($return_orders_count > 0) {
                foreach ($return_orders as $return_order) {
                    if ($return_order['product_id'] == $product) {
                        echo '<div id="alert-2" dir="rtl" class="flex items-center p-4 m-4 text-white rounded-lg bg-red-500 " role="alert">
                                        <div class="ml-3 text-xl font-medium">
هذا المنتج ارسل طلبه بالفعل !                                                
                                        </div>
                                        <button type="button" class="mr-auto -mx-1.5 -my-1.5 bg-red-500 text-white rounded-lg focus:ring-2 focus:ring-red-500 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#alert-2" aria-label="Close">
                                            <span class="sr-only">اغلاق</span>
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                            </svg>
                                        </button>
                                     </div>';
                    }
                }
            } else {

//            Add return order to database
                $sql = "INSERT INTO return_order (product_id, user_id, return_date, return_description) VALUES ('$product', '$user_id', NOW(), '$description')";
                $result = $con->exec($sql);
                echo '<div id="alert-2" dir="rtl" class="flex items-center p-4 m-4 text-white rounded-lg bg-green-500 " role="alert">
                                        <div class="ml-3 text-xl font-medium">
                                                    تم إضافة طلب الإرجاع بنجاح !
                                        </div>
                                        <button type="button" class="mr-auto -mx-1.5 -my-1.5 bg-green-500 text-white rounded-lg focus:ring-2 focus:ring-green-500 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#alert-2" aria-label="Close">
                                            <span class="sr-only">اغلاق</span>
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                            </svg>
                                        </button>
                                     </div>';

            }

        }
        ?>

        <main class="h-full pb-16 overflow-y-auto">
            <div class="container grid px-6 mx-auto">
                <!--return order content-->
                <section class="bg-white mt-12">
                    <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
                        <div class="flex flex-col items-end pl-4">
                            <h2 class="mb-4 text-xl font-bold text-gray-900 ">اضف طلب أرجاع</h2>

                        </div>
                        <form class="space-y-4 md:space-y-6" method="post">
                            <div class="flex flex-col items-end">
                                <label for="product" class="block mb-2 text-sm font-medium text-gray-900">اختر
                                    منتج</label>

                                <select id="product" name="product"
                                        class="bg-gray-50 text-right border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5">
                                    <?php foreach ($orders as $order): ?>
                                        <option value="<?php echo $order['product_id'] ?>"><?php echo $order['product_name'] ?></option>
                                    <?php endforeach; ?>

                                </select>
                            </div>

                            <div class="flex flex-col items-end">
                                <label for="description" class="block mb-2 text-sm font-medium text-gray-900 ">سبب
                                    الإرجاع</label>
                                <textarea id="description" rows="4" placeholder="اضف سبب الإرجاع" name="description"
                                          class="bg-gray-50 text-right border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5   "
                                          required=""></textarea>
                            </div>

                            <div class="mt-5">
                                <button type="submit" name="submit"
                                        class="w-full bg-green-700 border border-viridian-green-500 text-white px-8 py-3 font-medium
                                                 rounded hover:bg-transparent hover:text-viridian-green-500">

                                    إضافة
                                </button>
                            </div>

                        </form>
                    </div>
                </section>
                <!--End Shipping company Content-->
            </div>
        </main>
    </div>
</div>
</body>


<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>
</html>

















