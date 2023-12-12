<?php
session_start();
if (!(isset($_SESSION['email']))) {
    header('Location:../login.php');
}
include "../connection.php";

$merchant_id = $_SESSION['merchant_id'];
$shipping_companies = $con->query("SELECT * FROM shipping_company");
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
                        <a href="return_order.php"
                           class="block py-2 pl-3 pr-4 text-white rounded hover:bg-viridian-green-500 md:hover:bg-transparent md:hover:text-viridian-green-500 md:p-0">طلبات
                            الإرجاع</a>
                    </li>
                    <li>
                        <a href="orders.php"
                           class="block py-2 pl-3 pr-4 text-white rounded hover:bg-viridian-green-500 md:hover:bg-transparent md:hover:text-viridian-green-500 md:p-0">الطلبات</a>
                    </li>
                    <li>
                        <a href="products.php"
                           class="block py-2 pl-3 pr-4 text-viridian-green-500 rounded hover:bg-viridian-green-500 md:hover:bg-transparent md:hover:text-viridian-green-500 md:p-0">المنتجات</a>
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
        <?php
        if (isset($_POST['submit'])){
            $shipping_company = $_POST['shipping_company'];
            $sql = "UPDATE merchant SET  shipping_company_id='$shipping_company' WHERE merchant_id='$merchant_id'";
            $result = $con->exec($sql);
            echo '<div id="alert-2" dir="rtl" class="flex items-center p-4 m-4 text-white rounded-lg bg-green-500 " role="alert">
                                        <div class="ml-3 text-xl font-medium">
                                                    تم اختيار شركة الشحن !
                                        </div>
                                        <button type="button" class="mr-auto -mx-1.5 -my-1.5 bg-green-500 text-white rounded-lg focus:ring-2 focus:ring-green-500 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#alert-2" aria-label="Close">
                                            <span class="sr-only">اغلاق</span>
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                            </svg>
                                        </button>
                                     </div>';


        }
        ?>

        <main class="h-full pb-16 overflow-y-auto ">
            <div class="container grid px-8  mx-auto">

                <!--Add Product Content-->
                <section class="bg-white shadow-xl rounded-lg mt-12">
                    <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
                        <div class="flex flex-col items-end pl-4">
                            <h2 class="mb-4 text-xl font-bold text-gray-900 ">اختر شركة الشحن</h2>
                        </div>

                        <form class="space-y-4 md:space-y-6 " method="post" enctype="multipart/form-data">

                            <div class="flex flex-col items-end">
                                <label for="shipping_company"
                                       class="block mb-2 text-sm font-medium text-gray-900 ">شركة الشحن</label>
                                <select dir="rtl" type="text" name="shipping_company" id="shipping_company"
                                        class="bg-gray-50 text-right border border-gray-300 sm:text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5"  >
                                    <?php
                                    foreach ($shipping_companies as $shipping_company) :?>
                                        <option value="<?php echo $shipping_company['shipping_company_id'] ?>"><?php echo $shipping_company['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="flex flex-col items-end">
                                <label for="fees"
                                       class="block mb-2 text-sm font-medium text-gray-900 ">رسوم الشحن</label>
                                <input type="number" name="fees" id="fees"
                                       class="bg-gray-50 text-right border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5"
                                       required="">
                            </div>

                            <div class="mt-5">
                                <button type="submit" name="submit"
                                        class="w-full text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                    إضافة
                                </button>
                            </div>

                        </form>
                    </div>
                </section>
                <!--End add product Content-->
            </div>
        </main>
    </div>

</div>
</body>


<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>
</html>


