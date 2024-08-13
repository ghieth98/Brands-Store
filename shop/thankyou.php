<?php
ob_start();
session_start();
include "../connection.php";
if (isset($_SESSION['user_id'])) {

    $user_id = $_SESSION['user_id'];
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
<?php $success_msg[] = 'تم الطلب بنجاح' ?>

<?php
$query = $con->query("SELECT * FROM orders JOIN brands.user u on u.user_id = orders.user_id JOIN brands.product p on p.product_id = orders.product_id WHERE orders.user_id='$user_id' ORDER BY order_id DESC ");
$query->execute();
$order = $query->fetch();
?>
<div dir="rtl" class="h-screen flex flex-col items-center justify-center">
    <div class="bg-white border rounded-lg shadow-lg px-6 py-8 max-w-md mx-auto mt-8">
        <h1 class="font-bold text-2xl my-4 text-center text-green-600">متجر براند</h1>
        <hr class="mb-2">
        <div class="flex justify-between mb-6">
            <h1 class="text-lg font-bold">فاتورة</h1>
            <div class="text-gray-700">
                <div>التاريخ: <?php echo $order['date'] ?></div>
                <div>الفاتورة #: <?php echo $order['order_id'] ?></div>
            </div>
        </div>
        <div class="mb-8">
            <h2 class="text-lg font-bold mb-4">مرسل إلي:</h2>
            <div class="text-gray-700 mb-2"><?php echo $order['name'] ?></div>
            <div class="text-gray-700 mb-2"><?php echo $order['street'] ?></div>
            <div class="text-gray-700 mb-2"><?php echo $order['district'] ?></div>
            <div class="text-gray-700"><?php echo $order['email'] ?></div>
        </div>
        <table class="w-full mb-8">
            <thead>
            <tr>
                <th class="text-center font-bold text-gray-700">المنتجات</th>
                <th class=" text-center font-bold text-gray-700">السعر</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="text-center pl-4 text-gray-700"><?php echo $order['product_name'] ?></td>
                <td class=" text-center text-gray-700">SAR <?php echo $order['price'] ?></td>
            </tr>
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
        <div class="text-gray-700 mb-2">شكرا لك على ثقتك!</div>
    </div>
    <a href="../index.php" class="bg-viridian-green-500 mt-8 border border-viridian-green-500 mb-5 text-white px-8 py-3 font-medium
                    rounded-md hover:bg-transparent hover:text-viridian-green-500">الذهاب الي الصفحة الرئيسة</a>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<?php include "../alert.php"; ?>
</body>
</html>
