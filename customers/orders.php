<?php
session_start();
if (!(isset($_SESSION['email']))) {
    header('Location:../login.php');
}
include "../connection.php";
$customer_id = $_SESSION['customer_id'];
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
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>

    <title>سعودي براند</title>
</head>
<body>


<div class="bg-gray-50 h-screen">
    <!-- Navbar -->
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
                           class="block py-2 pl-3 pr-4 text-white rounded hover:bg-viridian-green-500 md:hover:bg-transparent md:hover:text-viridian-green-500 md:p-0">طلبات
                            الإرجاع</a>
                    </li>
                    <li>
                        <a href="orders.php"
                           class="block py-2 pl-3 pr-4 text-viridian-green-500 rounded hover:bg-viridian-green-500 md:hover:bg-transparent md:hover:text-viridian-green-500 md:p-0">الطلبات</a>
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
                        <span class="self-center text-2xl text-viridian-green-600 font-semibold whitespace-nowrap">سعودي براند</span>
                        <div class="flex">
                            <img src="../assets/images/logo.png" alt="logo" class="h-28">
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->

    <div class="flex flex-col flex-1 w-full">


        <main class="h-full pb-16 overflow-y-auto bg-gray-50">
            <div class="container grid px-6 mx-auto">

                <div class="flex flex-col items-end mr-5">
                    <h2 class="my-6 text-2xl font-semibold text-gray-700">
                        الطلبات
                    </h2>

                </div>

                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">

                    <div class="flex flex-col items-end pr-5 py-5 bg-white">

                        <label for="getName" class="sr-only">Search</label>
                        <div class="relative mb-3 text-right">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 " aria-hidden="true"
                                     xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                          stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                </svg>
                            </div>
                            <input type="text" id="getName"
                                   class="block p-2 pl-10 text-sm text-right text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="... ابحث هنا">
                        </div>


                    </div>

                    <table class="w-full  text-sm text-right text-gray-500 ">

                        <thead class="text-xs text-gray-700 uppercase bg-gray-50  ">
                        <tr>
                            <th scope="col" class="p-4">
                            </th>
                            <th scope="col" class="text-center py-3 ">

                            </th>
                            <th scope="col" class="text-center py-3 ">
                                حالة الطلب
                            </th>
                            <th scope="col" class="text-center py-3">
                                تاريخ التوصيل
                            </th>
                            <th scope="col" class="text-center py-3">
                                السعر
                            </th>

                            <th scope="col" class=" py-3 text-center">
                                الكمية
                            </th>
                            <th scope="col" class=" py-3 text-center">
                                وصف
                            </th>
                            <th scope="col" class=" py-3 text-center">
                                صورة
                            </th>
                            <th scope="col" class=" py-3 text-center">
                                اسم المنتج
                            </th>
                        </tr>
                        </thead>

                        <tbody id="showdata">
                        <?php
                        $orders = $con->query("SELECT * FROM orders join brands.order_product op on orders.order_id = op.order_id join brands.product p on p.product_id = op.product_id WHERE customer_id='$customer_id'");
                        foreach ($orders as $order):?>
                            <tr class="bg-white border-b hover:bg-gray-50 ">
                                <td class="w-4 p-4"></td>
                                <td class="text-center py-4"></td>

                                <td class="text-center py-4 font-bold">
                                <span class="px-2 py-1.5 font-semibold leading-tight text-green-700 bg-green-100 rounded-full">
                                    <?php echo $order['order_status'] ?>
                                </span>
                                </td>

                                <td class="text-center py-4 font-bold">
                                    <?php echo date('i:H Y-M-d', strtotime($order['date'] . ' +3 days')) ?>
                                </td>
                                <td class="text-center py-4 font-bold">
                                    SAR <?php echo ($order['price'] * $order['order_quantity'] + $order['shipping_price'] ) ?>
                                </td>

                                <td class="text-center  py-4 font-bold">
                                    <?php echo $order['order_quantity'] ?>
                                </td>
                                <td class="text-center  py-4 font-bold">
                                    <?php echo substr($order['description'], 0, 100) ?>
                                </td>
                                <td class="text-center py-4">
                                    <div class="flex flex-col items-center">
                                        <img src="../assets/uploads/<?php echo $order['image'] ?>" alt="product image"
                                             class=" w-20 rounded">
                                    </div>
                                </td>
                                <td class="text-center py-4 font-bold">
                                    <?php echo $order['product_name'] ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>


                        </tbody>

                    </table>

                </div>

            </div>
        </main>
    </div>
</div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>
<script>
    $(document).ready(function () {
        $('#getName').on("keyup", function () {
            var getName = $(this).val();
            $.ajax({
                method: 'POST',
                url: 'search_order.php',
                data: {name: getName},
                success: function (response) {
                    $("#showdata").html(response);
                }
            });
        });
    });
</script>
</html>


