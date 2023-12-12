<?php
session_start();
include "../connection.php";
$name = $_POST['name'];
$sql = "SELECT * FROM orders join brands.order_product op on orders.order_id = op.order_id join brands.product p on p.product_id = op.product_id WHERE  product_name LIKE '$name%'";
$query = $con->query($sql);

$data = '';
if ($query->rowCount() > 0) {
    while ($order = $query->fetch()) {
        $order_id = $order['order_id'];

        $data .= '<tr class="bg-white border-b hover:bg-gray-50 ">
                                <td class="w-4 p-4"></td>
                                <td class="text-center py-4"></td>

                                <td class="text-center py-4 font-bold">
                                <span class="px-2 py-1.5 font-semibold leading-tight text-green-700 bg-green-100 rounded-full">
                                  '.   $order['order_status'] .' 
                                </span>
                                </td>

                                <td class="text-center py-4 font-bold">
                                    '. date('i:H Y-M-d', strtotime($order['date'] . ' +3 days')).' 
                                </td>
                                <td class="text-center py-4 font-bold">
                                    SAR  '.($order['price'] * $order['order_quantity'] + $order['shipping_price'] ).' 
                                </td>
 <td class="text-center  py-4 font-bold">
                                    '. $order['order_quantity'] .'
                                </td>
                                <td class="text-center  py-4 font-bold">
                                     '.substr($order['description'], 0, 100).' 
                                </td>
                                <td class="text-center py-4">
                                    <div class="flex flex-col items-center">
                                        <img src="../assets/uploads/'.$order['image'].' " alt="product image"
                                             class=" w-20 rounded">
                                    </div>
                                </td>
                                <td class="text-center py-4 font-bold">
                                    '. $order['product_name'].' 
                                </td>
                            </tr>';


    }

} else {
    $data .= '<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="w-4 p-4"></td>
                                <td class="">    </td>
                                <td class="px-6 py-4 font-bold"> </td>
                                <td class="px-6 py-4 font-bold"></td>
                                <td class="px-6 py-4 text-lg font-bold">لا يوجد </td>

                                <td class="px-6 py-4  font-bold"></td>
                                <td class="px-6 py-4 font-bold"> </td>
                                <td class="px-6 py-4 font-bold"></td>
                            </tr>';

}

echo $data;
