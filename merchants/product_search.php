<?php
session_start();
include "../connection.php";
$merchant_id = $_SESSION['merchant_id'];
$name = $_POST['name'];
$sql = "SELECT * FROM product WHERE product_name LIKE '$name%' AND merchant_id='$merchant_id'";
$query = $con->query($sql);

$data = '';

if ($query->rowCount() > 0) {

    while ($product = $query->fetch()) {
        $product_id = $product['product_id'];
        $data .= '<tr class="bg-white border-b hover:bg-gray-50 ">
                                <td class="w-4 p-4"></td>
                                <td class="text-center pl-10 py-4 font-bold">
                                    <div class="flex flex-row ">
                                        <a href="edit_product.php?product_id=' . $product_id . '"
                                           class="pr-8">
                                            <svg class="h-6 w-6 text-viridian-green-500 hover:text-red-800" fill="none"
                                                 stroke="currentColor"
                                                 stroke-width="1.5" viewBox="0 0 24 24"
                                                 xmlns="http://www.w3.org/2000/svg"
                                                 aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"></path>
                                                تعديل
                                            </svg>

                                        </a>
                                        <a href="comments_product.php?product_id= ' . $product_id . '">
                                            <svg fill="none" class="h-6 w-6 text-viridian-green-500 hover:text-red-800"
                                                 stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"
                                                 xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 01-.825-.242m9.345-8.334a2.126 2.126 0 00-.476-.095 48.64 48.64 0 00-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0011.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155"></path>
                                            </svg>

                                        </a>
                                    </div>
                                </td>


                                <td class="text-center py-4">
               <label for="status"
                                           class="relative inline-flex items-center mr-5 cursor-pointer">

                                            <span class="px-2 py-1.5 font-semibold leading-tight text-green-700 bg-green-100 rounded-full">
                                                
                                                ' . $product['status'] . '
                                                  
                                            </span>


                                    </label>
                                </td>

                                <td class="text-center py-4 font-bold">
                                    SAR ' . $product['price'] . ' 
                                </td>

                                <td class="text-center py-4 font-bold">
                                    
                                    ' . substr($product['description'], 0, 100) . '
                                    
                                </td>
                                <td class="text-center py-4 ">
                                    <div class="flex flex-col  items-center">
                                        <img src="../assets/uploads/' . $product['image'] . ' " alt="product image"
                                             class=" w-20 rounded">
                                    </div>
                                </td>
                                <td class="text-center py-4 font-bold">
                                   ' . $product['product_name'] . ' 
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


