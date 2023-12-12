<?php
session_start();
include "../connection.php";
$merchant_id = $_SESSION['merchant_id'];
$name = $_POST['name'];
$sql = "SELECT * FROM return_order JOIN brands.product p on p.product_id = return_order.product_id WHERE merchant_id='$merchant_id' AND product_name LIKE '$name%'";
$query = $con->query($sql);

$data = '';
if ($query->rowCount() > 0) {

    while ($return_order = $query->fetch()) {
        $return_order_id = $return_order['return_order_id'];
        $data .= '<tr class="bg-white border-b hover:bg-gray-50 ">
                                <td class="w-4 p-4"></td>
                                <td class="text-center py-4 font-bold"></td>
                                <td dir="rtl" class="text-center py-4">
                                    <form method="post">
                                        <label for="order_status">
                                            <select name="return_order_status" id="return_order_status">

                                                <option class="w-full text-sm font-medium text-gray-900 rounded"
                                                        value="مقبول">
                                                    مقبول
                                                </option>
                                                <option class="w-full text-sm font-medium text-gray-900 rounded"
                                                        value="مرفوض">
                                                    مرفوض
                                                </option>
                                                <option class="w-full text-sm font-medium text-gray-900 rounded"
                                                        value="تم ارجاع المبلغ">
                                                    تم ارجاع المبلغ
                                                </option>
                                            </select>

                                        </label>
                                        <input type="hidden" name="product_id"
                                               value="' .$return_order['product_id'] .' ">
                                        <button name="submit" type="submit"
                                                class="bg-green-500 text-white border border-viridian-green-500 rounded-md hover:bg-transparent hover:text-viridian-green-500 font-medium text-sm px-5 py-2.5 inline-flex items-center">
                                            تغيير الحالة
                                        </button>
                                    </form>
                                </td>

                                <td class="text-center py-4 font-bold">
                                <span class="px-2 py-1.5 font-semibold leading-tight text-green-700 bg-green-100 rounded-full">
                                 '.$return_order['return_order_status'].' 
                                </span>
                                </td>
                                <td class="text-center py-4 font-bold">
                                    '. $return_order['price'] .' SAR
                                </td>

                                <td class="text-center py-4 font-bold">
                                   '.  $return_order['description'].' 
                                </td>
                                <td class="text-center py-4">
                                    <div class="flex flex-col items-center">
                                        <img src="../assets/uploads/'.$return_order['image'] .'"
                                             alt="product image"
                                             class=" w-20 rounded">
                                    </div>
                                </td>
                                <td class="text-center py-4 font-bold">
                                     '.$return_order['product_name'].' 
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
                                <td class="px-6 py-4 font-bold"></td>

                                <td class="px-6 py-4 text-lg font-bold">لا يوجد </td>
                                <td class="px-6 py-4 font-bold"> </td>
                                <td class="px-6 py-4 font-bold"></td>
                            </tr>';

}


echo $data;

