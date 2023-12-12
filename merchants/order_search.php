<?php
session_start();
include "../connection.php";
$merchant_id = $_SESSION['merchant_id'];
$name = $_POST['name'];
$sql = "SELECT DISTINCT op.order_id , order_status, date, total_price, district, city, street, name
                                                    FROM order_product op
                                                    JOIN brands.orders o ON o.order_id = op.order_id
                                                    JOIN brands.customer u ON u.customer_id = o.customer_id
                                                    JOIN brands.product p ON p.product_id = op.product_id where merchant_id='$merchant_id' AND name LIKE '$name%'";
$query = $con->query($sql);

$data = '';
if ($query->rowCount() > 0) {
    while ($order = $query->fetch()) {
        $order_id = $order['order_id'];

        $data .= '<tr class="bg-white border-b hover:bg-gray-50 ">
                                <td class="w-4 p-4"></td>
                                <td class="text-center py-4"></td>
                                <td class="text-center py-4">
                                    <a class="bg-green-500 text-white border border-viridian-green-500 rounded-md hover:bg-transparent hover:text-viridian-green-500 font-medium text-sm px-5 py-2.5 inline-flex items-center"
                                       href="order_product.php?order_id=' . $order_id . '">
                                        بيانات الطلب
                                    </a>
                                </td>
                               <td class="text-center py-4">
                         
                                        <form method="post">
                                            <input value="قيد التنفيذ" name="order_status" id="order_status"
                                                   type="hidden">
                                            <input type="hidden" name="order_id"
                                                   value=" ' . $order['order_id'] . '">
                                            <button name="submit"
                                                    class="bg-green-500 text-white border border-viridian-green-500 rounded-md hover:bg-transparent hover:text-viridian-green-500 font-medium text-sm px-5 py-2.5 inline-flex items-center"
                                                    type="submit">
                                                تغيير الحالة

                                            </button>
                                        </form>
                         
                                    
                                </td>
                                <td class="text-center py-4">
                                   <span class="px-2 py-1.5 font-semibold leading-tight text-green-700 bg-yellow-100 rounded-full">
                                                    ' . $order['order_status'] . ' 
                                            </span>
                                </td>
                                <td class="text-center py-4 font-bold">
                                    ' . date('i:H Y-M-d', strtotime($order['date'])) . ' 
                                </td>
                                <td class="text-center py-4 font-bold">
                                  ' . $order['total_price'] . 'SAR
                                </td>
                                <td class="text-center  py-4 font-bold">
                                    ' . $order['district'] . ',' . $order['city'] . ',' . $order['street'] . '
                                </td>
                                <td class="text-center py-4">
                                    ' . $order['name'] . ' 
                                </td>
                                <td class="text-center py-4 font-bold">
                                    ' . $order['order_id'] . '                                    
                                </td>
                            </tr>';
    }

} else {
    $data .= '<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="w-4 p-4"></td>
                                <td class="">

                                </td>
                                <td class="px-6 py-4 font-bold">
                                </td>
                                <td class="px-6 py-4 font-bold"></td>
                                <td class="px-6 py-4 text-lg font-bold"></td>
                                <td class="px-6 py-4 text-lg font-bold"></td>
                                <td class="px-6 py-4 text-lg font-bold">لا يوجد </td>
                                <td class="px-6 py-4 text-lg font-bold"></td>
                                <td class="px-6 py-4 font-bold"> </td>
                                <td class="px-6 py-4 font-bold"></td>
                            </tr>';

}

echo $data;

