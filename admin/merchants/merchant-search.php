<?php
include "../../connection.php";
$name = $_POST['name'];

$sql = "SELECT * FROM merchant WHERE name LIKE '$name%' AND status=1";
$query = $con->query($sql);

$data = '';
if ($query->rowCount() > 0) {

    while ($merchant_search = $query->fetch()) {
        $data .= '<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="w-4 p-4"></td>
                                <td class=""></td>
                              
                              <td class="px-6 py-4 font-bold hover:text-green-500">
                                        <a href="'. $merchant_search['commercial_register_link'] .'">
                                            '. $merchant_search['commercial_register'] . '  
                                        </a>
                                    </td>
                                 <td class="text-center py-4">
                                        <div class="flex flex-col items-end">
                                            <img src="../../assets/uploads/' . $merchant_search['logo'] . '" alt="product image"
                                                 class=" w-20 rounded">
                                        </div>
                                    </td>
                                <td class="px-6 py-4 font-bold">' .
                                        $merchant_search['phone'] .

                                '  </td>
                                <td class="px-6 py-4 font-bold"> '
            . $merchant_search['email'] .

            ' </td>
                                <td class="px-6 py-4 font-bold">'
            . $merchant_search['name'] .

            '</td>
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

