<?php
include "connection.php";
$name = $_POST['name'];

$sql = "SELECT * FROM product WHERE product.product_name LIKE '$name%'";
$query = $con->query($sql);

$data = '';
if ($query->rowCount() > 0) {
    while ($product_search = $query->fetch()) {
        $product_id = $product_search['product_id'];

        $data .= '           <ul>

                                <li class="border-b p-2 hover:bg-gray-50">
                                        <a href="shop/product.php?product_id=' . $product_id . '">
                                        ' . $product_search['product_name'] . '
                                        </a>
                              
                                </li>

                        </ul>';
    }

} else {
    $data .= '<p class="text-center"> لا يوجد </p>';
}
echo $data;

