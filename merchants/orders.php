<?php
ob_start();
session_start();
if (!(isset($_SESSION['email']))) {
    header('Location:../login.php');
}
include "../connection.php";

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
                           class="block py-2 pl-3 pr-4 text-viridian-green-500 rounded hover:bg-viridian-green-500 md:hover:bg-transparent md:hover:text-viridian-green-500 md:p-0">الطلبات</a>
                    </li>
                    <li>
                        <a href="products.php"
                           class="block py-2 pl-3 pr-4 text-white rounded hover:bg-viridian-green-500 md:hover:bg-transparent md:hover:text-viridian-green-500 md:p-0">المنتجات</a>
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
                            <th scope="col" class="p-4"></th>
                            <th scope="col" class="text-center py-3 "></th>
                            <th scope="col" class="text-center py-3 "></th>
                            <th scope="col" class="text-center py-3 "></th>
                            <th scope="col" class="text-center py-3 "></th>
                            <th scope="col" class="text-center py-3">
                                تاريخ الطلب
                            </th>
                            <th scope="col" class="text-center py-3">
                                المبلغ الإجمالي
                            </th>

                            <th scope="col" class=" py-3 text-center">
                                العنوان
                            </th>

                            <th scope="col" class=" py-3 text-center">
                                اسم العميل
                            </th>
                            <th scope="col" class=" py-3 text-center">
                                رقم الفاتورة
                            </th>
                        </tr>
                        </thead>

                        <tbody id="showdata">
                        <?php
                        $orders = $con->query("SELECT DISTINCT op.order_id , order_status, date, total_price, district, city, street, name,shipping_price
                                                    FROM order_product op
                                                    JOIN brands.orders o ON o.order_id = op.order_id
                                                    JOIN brands.customer u ON u.customer_id = o.customer_id
                                                    JOIN brands.product p ON p.product_id = op.product_id
                                                    WHERE merchant_id = '$merchant_id'");
                        foreach ($orders as $order):?>

                            <?php
                            if (isset($_POST['submit'])) {
                                $order_status = $_POST['order_status'];
                                $order_id = $_POST['order_id'];
                                $sql = "UPDATE orders SET order_status='$order_status' WHERE order_id='$order_id'";
                                $result = $con->exec($sql);

                                $query = $con->query("SELECT email, name FROM shipping_company JOIN brands.orders o on shipping_company.shipping_company_id = o.shipping_company_id where order_id='$order_id'");
                                $query->execute();
                                $shipping = $query->fetch();

                                require_once "../mail.php";
                                // Require PHPMailer
                                $mail = requirePHPMailer();

                                $mail->setFrom('', 'Acceptance for your application for Saudi Brand Application');
                                $mail->addAddress($shipping['email']);

                                $mail->isHTML(true);
                                $mail->Subject = "Saudi Brand shipment";
                                // Start building the email body
                                $mailBody = "
                                    <body class='font-sans'>
                                        <p class='text-lg'>عزيزي، " . $shipping['name'] . "</p>
                                        <h3 class='text-2xl font-bold mt-4'>
                                            طلبية شحن
                                        </h3>";

                                // Iterate over the products
                                $productQuery = $con->query("SELECT product_name, order_quantity FROM order_product JOIN brands.product p ON p.product_id = order_product.product_id WHERE order_product.order_id='$order_id'");
                                $products = $productQuery->fetchAll();
                                $mailBody .= "<ul class='mt-4 text-lg'>";
                                foreach ($products as $product) {
                                    $mailBody .= "<li>" . $product['product_name'] . " - الكمية: " . $product['order_quantity'] . "</li>";
                                }
                                $mailBody .= "</ul>";

                                // Continue building the email body
                                $mailBody .= "
                                        <h4 class='text-4xl font-bold mt-4 p-4'>
                                           اسم العميل:  " . $order['name'] . "  <br> 
                                             سعر الشحن: " . $order['shipping_price'] . " SAR <br> 
                                             سعر الكلي: " . $order['total_price'] . " SAR <br> 
                                           اخر موعد للتسليم:  " . date('H:i Y-M-D', strtotime($order['date'] . ' +3 days')) . "<br> 
                                         العنوان:    " . $order['district'] . ',' . $order['city'] . ',' . $order['street'] . " 
                                        </h4>
                                        <br><br>
                                        <p class='mt-4'>مع أطيب التحيات،</p>
                                        <b class='text-lg'>منصة سعودي براند</b>
                                ";

                                $mail->Body = $mailBody;

                                if ($mail->send()) {
                                    echo '<div id="alert-2" dir="rtl" class="flex items-center p-4 m-4 text-white rounded-lg bg-green-500 " role="alert">
                                        <div class="ml-3 text-xl font-medium">
                                                    تم ارسال الطلب الي شركة الشحن بنجاح !
                                        </div>
                                        <button type="button" class="mr-auto -mx-1.5 -my-1.5 bg-green-500 text-white rounded-lg focus:ring-2 focus:ring-green-500 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#alert-2" aria-label="Close">
                                            <span class="sr-only">اغلاق</span>
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                            </svg>
                                        </button>
                                     </div>';
                                    header("Refresh:0");
                                } else {
                                    echo '<div id="alert-2" dir="rtl" class="flex items-center p-4 m-4 text-white rounded-lg bg-red-500 " role="alert">
                                        <div class="ml-3 text-xl font-medium">
حدثت مشكلة !                                                
                                        </div>
                                        <button type="button" class="mr-auto -mx-1.5 -my-1.5 bg-red-500 text-white rounded-lg focus:ring-2 focus:ring-red-500 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#alert-2" aria-label="Close">
                                            <span class="sr-only">اغلاق</span>
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                            </svg>
                                        </button>
                                     </div>';
                                    header("Refresh:0");

                                }
                            }
                            ?>
                            <tr class="bg-white border-b hover:bg-gray-50 ">
                                <td class="w-4 p-4"></td>
                                <td class="text-center py-4"></td>
                                <td class="text-center py-4">
                                    <a class="bg-green-500 text-white border border-viridian-green-500 rounded-md hover:bg-transparent hover:text-viridian-green-500 font-medium text-sm px-5 py-2.5 inline-flex items-center"
                                       href="order_product.php?order_id=<?php echo $order['order_id'] ?>">
                                        بيانات الطلب
                                    </a>
                                </td>
                                <td class="text-center py-4">
                                    <?php if ($order['order_status'] == 'قيد الانتظار'): ?>
                                        <form method="post">
                                            <input value="قيد التنفيذ" name="order_status" id="order_status"
                                                   type="hidden">
                                            <input type="hidden" name="order_id"
                                                   value="<?php echo $order['order_id'] ?>">
                                            <button name="submit"
                                                    class="bg-green-500 text-white border border-viridian-green-500 rounded-md hover:bg-transparent hover:text-viridian-green-500 font-medium text-sm px-5 py-2.5 inline-flex items-center"
                                                    type="submit">
                                                تغيير الحالة

                                            </button>
                                        </form>
                                    <?php else: ?>
                                    <?php endif; ?>

                                    <!-- Dropdown menu -->

                                </td>
                                <td class="text-center py-4">
                                   <span class="px-2 py-1.5 font-semibold leading-tight text-green-700 bg-yellow-100 rounded-full">
                                                      <?php echo $order['order_status'] ?>
                                            </span>
                                </td>

                                <td class="text-center py-4 font-bold">
                                    <?php echo date('i:H Y-M-d', strtotime($order['date'])) ?>
                                </td>
                                <td class="text-center py-4 font-bold">
                                    <?php echo $order['total_price'] ?> SAR
                                </td>

                                <td class="text-center  py-4 font-bold">
                                    <?php
                                    echo $order['district'] . ',' . $order['city'] . ',' . $order['street']
                                    ?>
                                </td>

                                <td class="text-center py-4">
                                    <?php
                                    echo $order['name']
                                    ?>
                                </td>
                                <td class="text-center py-4 font-bold">
                                    <?php
                                    echo $order['order_id']
                                    ?>
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
                url: 'order_search.php',
                data: {name: getName},
                success: function (response) {
                    $("#showdata").html(response);
                }
            });
        });
    });
</script>
</html>


