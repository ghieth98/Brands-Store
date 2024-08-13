<?php
include "../connection.php";
if (isset($_POST['product_id'], $_POST['quantity']) && is_numeric($_POST['product_id']) && is_numeric($_POST['quantity'])) {
    // Set the post variables and make sure they are integers
    $product_id = (int)$_POST['product_id'];
    $quantity = (int)$_POST['quantity'];
    // Check if product exists in database
    $stmt = $con->prepare('SELECT * FROM product WHERE product_id = ?');
    $stmt->execute([$_POST['product_id']]);
    // Fetch the product from the database and return the result as an Array
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    // Check if the product exists
    if ($product && $quantity > 0) {
        // Create/update the session variable for the cart
        if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
            if (array_key_exists($product_id, $_SESSION['cart'])) {
                // Product exists in cart so just update the quantity
                $_SESSION['cart'][$product_id] += $quantity;
            } else {
                // Product is not in cart so add it
                $_SESSION['cart'][$product_id] = $quantity;
            }
        } else {
            // There are no products in cart, this will add the first product to cart
            $_SESSION['cart'] = array($product_id => $quantity);
        }
    }
    // Prevent form resubmission...
header("Location: cart.php");
    exit();
}

// Send the user to the place order page if they click the Place Order button, also the cart should not be empty
if (isset($_POST['checkout']) && !empty($_SESSION['cart'])) {
    header('Location: checkout.php');
    exit;
}

// Check the session variable for products in cart
$products_in_cart = $_SESSION['cart'] ?? array();
$products = array();
$subtotal = 0.00;
$total = 0.00;
$tax = 5 / 100;
// If there are products in cart
if ($products_in_cart) {
    // There are products in the cart, so we need to select those products from the database
    // Products in cart array to question mark string array, we need the SQL statement to include IN (?,?,?,...etc)
    $array_to_question_marks = implode(',', array_fill(0, count($products_in_cart), '?'));
    $stmt = $con->prepare('SELECT * FROM product JOIN brands.merchant m on m.merchant_id = product.merchant_id JOIN brands.shipping_company sc on sc.shipping_company_id = m.shipping_company_id WHERE product.product_id IN (' . $array_to_question_marks . ')');
    // We only need the array keys, not the values, the keys are the id's of the products
    $stmt->execute(array_keys($products_in_cart));
    // Fetch the products from the database and return the result as an Array
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // Calculate the subtotal
    foreach ($products as $product) {
        $subtotal += (float)$product['price'] * (int)$products_in_cart[$product['product_id']];
        $merchant_fees = $product['fees'];
        $shipping_fees = $product['shipping_fees'];
        $new_tax = $shipping_fees + $merchant_fees;
        $total = $subtotal + $new_tax;

    }
}


