<?php
ob_start();
session_start();
include "connection.php";
if (isset($_POST['submit'])){
$otp = $_POST['otp'];
$email = $_SESSION['email'];
if ($otp == $_SESSION['otp']) {
    $user_sql = $con->prepare("SELECT * FROM user WHERE email='$email'");
    $user_result = $user_sql->execute();
    $user = $user_sql->fetch();
    $user_count = $user_sql->rowCount();
    if ($user_count > 0) {
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['email'] = $user['email'];
        unset($_SESSION['otp']);
        header("Location: users/profile.php");
    }
} else {
    echo '<div id="alert-2" dir="rtl" class="flex items-center p-4 m-4 text-white rounded-lg bg-red-500 " role="alert">
                                        <div class="ml-3 text-xl font-medium">
الرقم الذي أدخلته غير صحيح!                                                
                                        </div>
                                        <button type="button" class="mr-auto -mx-1.5 -my-1.5 bg-red-500 text-white rounded-lg focus:ring-2 focus:ring-red-500 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#alert-2" aria-label="Close">
                                            <span class="sr-only">اغلاق</span>
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                            </svg>
                                        </button>
                                     </div>';

}
}
$success_msg[] = 'برجاء الرجوع الي رسائل الايميل للدخول الي موقعنا'
?>
<!doctype html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/output.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.css" rel="stylesheet"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=El+Messiri:wght@400;500;600;700&display=swap" rel="stylesheet">
    <title>سعودي براند</title>
</head>
<body>
<section class="bg-gray-50">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
        <div class="w-full bg-white rounded-lg shadow  md:mt-0 sm:max-w-md xl:p-0  ">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <div class="flex flex-col items-end">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl ">
                        التحقق من كلمة المرور
                    </h1>

                </div>
                <form class="space-y-4 md:space-y-6" method="post">
                    <div class="flex flex-col items-end">
                        <label for="otp" class="block mb-2 text-sm font-medium text-gray-900 ">الرقم السري</label>
                        <input type="password" name="otp" id="otp"
                               class="bg-gray-50 border text-right border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5   "
                               required="">
                    </div>

                    <div class="mt-5">
                        <button type="submit" name="submit"
                                class="w-full text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                            تسجيل الدخول
                        </button>
                    </div>


                </form>
            </div>
        </div>
    </div>
</section>


<!--Footer Section-->
<footer class="bg-viridian-green-200 inset-x-0 bottom-0 mt-3 shadow-lg rounded">
    <div class="w-full max-w-screen-xl mx-auto p-4 md:py-8">
        <div class="sm:flex sm:items-center sm:justify-between">
            <span class="block text-sm text-right text-gray-500 sm:text-center dark:text-gray-400"> 2023 © <span>جميع الحقوق محفوظة</span> سعودي براند</span>

            <div class="flex flex-col items-end">
                <a href="index.php">
                    <div class="flex flex-row items-center ">
                        <span class="self-center text-2xl text-viridian-green-600 font-semibold whitespace-nowrap">سعودي براند</span>
                        <div class="flex">
                            <img src="assets/images/logo.png" alt="logo" class="h-28">
                        </div>
                    </div>
                </a>
            </div>

        </div>
    </div>
</footer>
<!--End Footer Section-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>

<script>
    $(document).ready(function () {
        $('#getName').on("keyup", function () {
            var getName = $(this).val();
            $.ajax({
                method: 'POST',
                url: 'search-product.php',
                data: {name: getName},

                success: function (response) {
                    if (getName.length) {
                        $("#showData").html(response);

                    } else {
                        $("#showData").empty()
                    }
                }
            });
        });
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<?php include "alert.php"; ?>
</body>

</html>

