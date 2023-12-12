<?php
ob_start();
session_start();
include "../connection.php";
if (isset($_SESSION['customer_id'])) {

    $customer_id = $_SESSION['customer_id'];
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
    <title>سعودي براند</title>
</head>
<body class="bg-gray-50">
<?php $success_msg[] = 'تم الطلب بنجاح' ?>

<?php
$query = $con->query("SELECT * FROM order_product join brands.orders o on o.order_id = order_product.order_id join brands.customer u on u.customer_id = o.customer_id group by date desc limit 1");
$query->execute();
$order = $query->fetch();
$order_id = $order['order_id'];

?>
<div dir="rtl" class="h-screen flex flex-col items-center justify-center">
    <div class="bg-white border rounded-lg shadow-lg px-6 py-8 max-w-md mx-auto mt-8">
        <h1 class="font-bold text-2xl my-4 text-center text-green-600">سعودي براند</h1>
        <hr class="mb-2">
        <h1 class="text-lg text-center font-bold">فاتورة</h1>
        <div class="flex justify-between mb-6">


            <div class="text-gray-700">
                <div>التاريخ: <?php echo $order['date'] ?></div>
                <div>الفاتورة #: <?php echo $order['order_id'] ?></div>
            </div>
        </div>
        <div class="mb-8 text-center">
            <h2 class="text-lg font-bold mb-4">مرسل إلي:</h2>
            <div class="text-gray-700 mb-2"><?php echo $order['name'] ?></div>
            <div class="text-gray-700 mb-2"><?php echo $order['street'] ?></div>
            <div class="text-gray-700 mb-2"><?php echo $order['district'] ?></div>
            <div class="text-gray-700 mb-2"><?php echo $order['city'] ?></div>
            <div class="text-gray-700"><?php echo $order['email'] ?></div>
        </div>
        <table class="w-full mb-8 text-center ">
            <thead>
            <tr>
                <th class="text-center font-bold text-gray-700">المنتجات</th>
                <th class=" text-center font-bold text-gray-700">السعر</th>
            </tr>
            </thead>
            <tbody>
            <?php

            $products = $con->query("SELECT * FROM order_product JOIN brands.product p on p.product_id = order_product.product_id WHERE order_id='$order_id'");
            foreach ($products as $product):?>
                <tr>
                    <td class="text-center pl-4 text-gray-700"><?php echo $product['product_name'] ?></td>
                    <td class=" text-center text-gray-700">SAR <?php echo $product['price'] ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
            <tfoot>
            <tr>
                <td class="text-center font-bold text-gray-700">السعر ألإجمالي</td>
                <td class="text-center font-bold text-gray-700">SAR <?php echo $order['total_price'] ?></td>
            </tr>
            <tr class="pt-3">
                <td class="text-center font-bold text-gray-700">مدة التوصيل</td>
                <td class="text-center font-bold text-gray-700">3 أيام</td>
            </tr>
            </tfoot>
        </table>
        <div class="text-gray-700 mb-2 text-center">شكرا لك على ثقتك!</div>
    </div>
    <a href="../index.php" class="bg-viridian-green-500 mt-8 border border-viridian-green-500 mb-5 text-white px-8 py-3 font-medium
                    rounded-md hover:bg-transparent hover:text-viridian-green-500">الذهاب الي الصفحة الرئيسة</a>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<?php include "../alert.php"; ?>
</body>
</html>
