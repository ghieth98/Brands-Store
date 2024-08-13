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
                                <td class="text-center py-4">

                                    <button id="dropdownRadioBgHoverButton" data-dropdown-toggle="dropdownRadioBgHover"
                                            class="bg-green-500 text-white border border-viridian-green-500 rounded-md hover:bg-transparent hover:text-viridian-green-500 font-medium text-sm px-5 py-2.5 inline-flex items-center"
                                            type="button">
                                        <svg class="w-2.5 h-2.5 mr-2.5" aria-hidden="true"
                                             xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                  stroke-width="2" d="m1 1 4 4 4-4"/>
                                        </svg>
                                        تغيير الحالة

                                    </button>
                                    <form method="post">
                                        <!-- Dropdown menu -->

                                        <div id="dropdownRadioBgHover"
                                             class="z-10 hidden w-44 bg-white divide-y divide-gray-100 rounded-lg shadow">
                                            <ul class="p-3 space-y-1 text-sm text-gray-700"
                                                aria-labelledby="dropdownRadioBgHoverButton">
                                                <li>
                                                    <div class="flex items-center p-2 rounded hover:bg-gray-100">
                                                        <label for="default-radio-4"
                                                               class="w-full text-sm font-medium text-gray-900 rounded">مقبول</label>
                                                        <input type="hidden" value="مقبول" name="return_order_status1">
                                                        <button id="default-radio-4" type="submit"
                                                                name="accepted"
                                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="flex items-center p-2 rounded hover:bg-gray-100">
                                                        <label for="default-radio-5"
                                                               class="w-full text-sm font-medium text-gray-900 rounded">مرفوض</label>
                                                        <input type="hidden" value="مرفوض" name="return_order_status2">
                                                        <button id="default-radio-5" type="submit"
                                                                name="refused"
                                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="flex items-center p-2 rounded hover:bg-gray-100">
                                                        <label for="default-radio-6"
                                                               class="w-full text-sm font-medium text-gray-900 rounded">تم
                                                            أرجاع
                                                            المبلغ</label>
                                                        <input type="hidden" value="تم ارجاع المبلغ"
                                                               name="return_order_status3">
                                                        <button id="default-radio-6" type="submit"
                                                                name="refunded"
                                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </form>
                                </td>

                                <td class="text-center py-4 font-bold">
                                <span class="px-2 py-1.5 font-semibold leading-tight text-green-700 bg-green-100 rounded-full">
                                ' . $return_order['return_order_status'] . '
                                </span>
                                </td>
                                <td class="text-center py-4 font-bold">
                                   ' . $return_order['price'] . ' SAR
                                </td>

                                <td class="text-center py-4 font-bold">
                                   ' . $return_order['description'] . ' 
                                </td>
                                <td class="text-center py-4">
                                    <div class="flex flex-col items-center">
                                        <img src="../assets/uploads/' . $return_order['image'] . '"
                                             alt="product image"
                                             class=" w-20 rounded">
                                    </div>
                                </td>
                                <td class="text-center py-4 font-bold">
                                  ' . $return_order['product_name'] . ' 
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

                                <td class="px-6 py-4 text-lg font-bold">لا يوجد </td>
                                <td class="px-6 py-4 font-bold"> </td>
                                <td class="px-6 py-4 font-bold"></td>
                            </tr>';

}


echo $data;

