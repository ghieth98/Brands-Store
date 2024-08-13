<?php
include "../connection.php";
$name = $_POST['name'];

$sql = "SELECT * FROM shipping_company WHERE name LIKE '$name%'";
$query = $con->query($sql);

$data = '';
if ($query->rowCount() > 0) {
    while ($company_search = $query->fetch()) {
        $data .= '<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="w-4 p-4"></td>
                                <td class="">

                                </td>
                                <td class="px-6 py-4 font-bold">
                                </td>
                                <td class="px-6 py-4 font-bold">' . $company_search['commercial_register'] . '</td>

                                <td class="px-6 py-4 font-bold">' .
            $company_search['shipping_fees'] .

            '  </td>       
                                                        <td class="px-6 py-4 font-bold">' .
            $company_search['phone'] .

            '  </td>
                                <td class="px-6 py-4 font-bold"> '
            . $company_search['email'] .

            ' </td>
                                <td class="px-6 py-4 font-bold">'
            . $company_search['name'] .

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
