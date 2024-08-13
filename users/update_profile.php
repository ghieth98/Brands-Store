<?php
session_start();
if (!(isset($_SESSION['email']))) {
    header('Location:../login.php');
}
include "../connection.php";
$user_id = $_SESSION['user_id'];
if (isset($_POST['submit'])) {
//                                    Initialize form variables
    $name = $_POST['name'];
    $password = base64_encode($_POST['password']);
    $phone = $_POST['phone'];
    $city = $_POST['city'];
    $street = $_POST['street'];
    $neighborhood = $_POST['neighborhood'];
    $sql = "UPDATE user SET name='$name', password='$password', phone_number='$phone', city='$city', street='$street', district='$neighborhood' WHERE user_id='$user_id'";
    $result = $con->exec($sql);
    header("Location: profile.php");
    echo '<div id="alert-2" dir="rtl" class="flex items-center p-4 m-4 text-white rounded-lg bg-green-500 " role="alert">
                                        <div class="ml-3 text-xl font-medium">
                                                    تم تعديل البيانات !
                                        </div>
                                        <button type="button" class="mr-auto -mx-1.5 -my-1.5 bg-green-500 text-white rounded-lg focus:ring-2 focus:ring-green-500 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#alert-2" aria-label="Close">
                                            <span class="sr-only">اغلاق</span>
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                            </svg>
                                        </button>
                                     </div>';

}

