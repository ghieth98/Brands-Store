<?php
ob_start();
session_start();
if (!(isset($_SESSION['email']))) {
    header('Location:../login.php');
}
$merchant_id = $_SESSION['merchant_id'];
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
                            الخروج</a>
                    </li>
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


        <main class="h-full pb-16 overflow-y-auto bg-gray-50">
            <div class="container grid px-6 mx-auto">


                <div class="flex flex-col items-end mr-5">
                    <h2 class="my-6 text-2xl font-semibold text-gray-700">
                        المنتجات
                    </h2>
                </div>

                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">

                    <div class="flex flex-col items-end pr-5 pt-3  bg-white">
                        <a href="add_product.php" class="bg-viridian-green-500 mt-3 mb-3 px-8 py-3 border border-viridian-green-500 text-white font-medium
                    rounded-md hover:bg-transparent hover:text-viridian-green-500">اضف منتج</a>

                        <a href="shipping_company.php" class="bg-viridian-green-500 mt-3 mb-3 px-8 py-3 border border-viridian-green-500 text-white font-medium
                    rounded-md hover:bg-transparent hover:text-viridian-green-500">اختر شركة الشحن</a>

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

                    <table class="w-full text-sm text-right text-gray-500 ">

                        <thead class="text-xs text-gray-700 uppercase bg-gray-50  ">
                        <tr>
                            <th scope="col" class="p-4">
                            </th>
                            <th scope="col" class="text-center py-3 ">

                            </th>
                            <th scope="col" class="text-center py-3">
                                الحالة
                            </th>
                            <th scope="col" class="text-center py-3">
                                السعر
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
                        include "../connection.php";

                        $products = $con->query("SELECT * FROM product WHERE merchant_id='$merchant_id'");
                        foreach ($products as $product):?>
                            <tr class="bg-white border-b hover:bg-gray-50 ">
                                <td class="w-4 p-4"></td>
                                <td class="text-center pl-10 py-4 font-bold">
                                    <div class="flex flex-row ">
                                        <a href="edit_product.php?product_id=<?php echo $product['product_id'] ?>"
                                           class="pr-8">
                                            <svg class="h-6 w-6 text-viridian-green-500 hover:text-red-800" fill="none"
                                                 stroke="currentColor"
                                                 stroke-width="1.5" viewBox="0 0 24 24"
                                                 xmlns="http://www.w3.org/2000/svg"
                                                 aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"></path>
                                                تعديل
                                            </svg>

                                        </a>
                                        <a href="comments_product.php?product_id=<?php echo $product['product_id'] ?>">
                                            <svg fill="none" class="h-6 w-6 text-viridian-green-500 hover:text-red-800"
                                                 stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"
                                                 xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 01-.825-.242m9.345-8.334a2.126 2.126 0 00-.476-.095 48.64 48.64 0 00-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0011.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155"></path>
                                            </svg>

                                        </a>
                                    </div>
                                </td>


                                <td class="text-center py-4">

                                    <label for="status"
                                           class="relative inline-flex items-center mr-5 cursor-pointer">

                                            <span class="px-2 py-1.5 font-semibold leading-tight text-green-700 bg-green-100 rounded-full">
                                                  <?php
                                                  echo $product['status']
                                                  ?>
                                            </span>


                                    </label>

                                </td>

                                <td class="text-center py-4 font-bold">
                                    SAR <?php echo $product['price']; ?>
                                </td>

                                <td class="text-center py-4 font-bold">
                                    <?php
                                    echo substr($product['description'], 0, 100)
                                    ?>
                                </td>
                                <td class="text-center py-4 ">
                                    <div class="flex flex-col  items-center">
                                        <img src="../assets/uploads/<?php echo $product['image'] ?>" alt="product image"
                                             class=" w-20 rounded">
                                    </div>
                                </td>
                                <td class="text-center py-4 font-bold">
                                    <?php echo $product['product_name'] ?>
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
                url: 'product_search.php',
                data: {name: getName},
                success: function (response) {
                    $("#showdata").html(response);
                }
            });
        });
    });
</script>
</html>


