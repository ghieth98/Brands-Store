<?php
include "../../connection.php";
$name = $_POST['name'];

$sql = "SELECT * FROM user WHERE name LIKE '$name%' AND  block=0";
$query = $con->query($sql);

$data = '';
if ($query->rowCount() > 0) {
    while ($customer_search = $query->fetch()) {
        $user_id = $customer_search['user_id'];
        $data .=
            '<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="w-4 p-4"></td>
                                <th class="px-6 pr-8 mr-5 py-4 font-bold text-green-500  hover:text-red-800 dark:text-white">

                                      <a   href="block_user.php?user_id=' . $user_id . '" 
                                       class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-viridian-green-800 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                       aria-label="Block">
                                        <svg class="h-6 w-6 hover:text-red-800" fill="none" stroke="currentColor"
                                             stroke-width="1.5"
                                             viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M14.25 9v6m-4.5 0V9M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </a>

                                </th>
                                <td class="px-6 py-4 font-bold">' . $customer_search['street'] . '
                                    
                                </td>
                                <td class="px-6 py-4 font-bold"> ' . $customer_search['district'] . '
                                </td>
                                <td class="px-6 py-4 font-bold"> ' . $customer_search['city'] . '
                                    
                                </td>
                                <td class="px-6 py-4 font-bold"> ' . $customer_search['email'] . '
                                    
                                </td>
                                <td class="px-6 py-4 font-bold"> ' . $customer_search['name'] .

            ' </td>
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


