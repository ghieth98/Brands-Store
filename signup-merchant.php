<?php
ob_start();
include "connection.php";
$categories = $con->query("SELECT * FROM category");
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

<!--Navbar-->
<nav class="bg-viridian-green-200 border-b shadow-lg rounded lg:mb-2">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">

        <div class="flex flex-col md:flex-row items-center">

            <div class="md:ml-4 mt-3 md:mt-0">
                <a href="shop/cart.php">
                    <div class="mb-5 text-yellow-200">

                        <?php echo $num_items_in_cart = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?>
                        <svg fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                             viewBox="0 0 24 24"
                             stroke="currentColor" class="-mt-px w-5 h-5 text-gray-800">
                            <path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                </a>
            </div>
            <!--Searchbar-->
            <div class="md:ml-4 mt-3 md:mt-0">
                <label for="getName" class="sr-only"></label>
                <div class="relative mt-1">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                             xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                  stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </div>
                    <input type="text" id="getName" data-dropdown-toggle="showData"
                           class="block p-2 pl-10 text-right text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                           placeholder="... ابحث هنا">
                    <div dir="rtl" id="showData"
                         class="z-10 hidden font-normal text-right bg-white divide-y divide-gray-100 rounded-lg shadow w-full">
                        <ul class="py-2 text-sm text-gray-700 "></ul>
                    </div>
                </div>
            </div>


        </div>
        <button data-collapse-toggle="navbar-dropdown" type="button"
                class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200"
                aria-controls="navbar-dropdown" aria-expanded="false">
            <span class="sr-only">Open main menu</span>

        </button>
        <div class="hidden w-full md:block md:w-auto" id="navbar-dropdown">
            <ul class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg md:flex-row md:space-x-8 md:mt-0 md:border-0">

                <li>
                    <a href="login.php"
                       class="block py-2 pl-3 pr-4 text-white rounded hover:bg-viridian-green-500 md:hover:bg-transparent md:hover:text-viridian-green-500 md:p-0">تسجيل
                        دخول</a>
                </li>
                <li>
                    <a href="signup.php"
                       class="block py-2 pl-3 pr-4 text-viridian-green-500 rounded hover:bg-viridian-green-500 md:hover:bg-transparent md:hover:text-viridian-green-500 md:p-0">التسجيل</a>
                </li>
                <li>
                    <a href="shop/brands.php"
                       class="block py-2 pl-3 pr-4 text-white rounded hover:bg-viridian-green-500 md:hover:bg-transparent md:hover:text-viridian-green-500 md:p-0">العلامات
                        التجارية</a>
                </li>

                <li>
                    <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar2"
                            class="flex items-center justify-between w-full py-2 pl-3 pr-4 text-white rounded hover:bg-viridian-green-500 md:hover:bg-transparent md:border-0 md:hover:text-viridian-green-500 md:p-0 md:w-auto">
                        <svg class="w-2.5 h-2.5 mr-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                             fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="m1 1 4 4 4-4"/>
                        </svg>
                        الفئات

                    </button>
                    <!-- Dropdown menu -->
                    <div id="dropdownNavbar2"
                         class="z-10 hidden font-normal text-right bg-white divide-y divide-gray-100 rounded-lg shadow w-32">
                        <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownLargeButton">
                            <?php
                            foreach ($categories as $category) { ?>
                                <li>
                                    <a href="shop/shop.php?category_id=<?php echo $category['category_id'] ?>"
                                       class="block px-4 py-2 hover:bg-gray-100">
                                        <?php
                                        echo $category['name']
                                        ?>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </li>


                <li>
                    <a href="index.php"
                       class="block py-2 pl-3 pr-4 text-white rounded md:bg-transparent md:text-viridian-green-500 md:p-0"
                       aria-current="page">الرئيسية</a>
                </li>
            </ul>

        </div>
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
</nav>
<!--End Navbar-->
<?php
//check if form is submitted
if (isset($_POST['submit'])) {
//Initialize form variables
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = base64_encode($_POST['password']);
    $confirm_password = base64_encode($_POST['confirm_password']);
    $phone = $_POST['phone'];
    $commercial_register = $_POST['record'];
//Query merchant table for email
    $email_query = $con->query("SELECT * FROM merchant WHERE email='$email'");
    $merchants_emails = $email_query->fetchAll();
    $emails_count = $email_query->rowCount();
//validate function
    function validate($data): string
    {
        $data = trim($data);
        $data = stripslashes($data);
        return htmlspecialchars($data);
    }

    $email = validate($email);
    $password = validate($password);
//check if email or password is empty
    if (empty($email)) {
        echo '<div id="alert-2" dir="rtl" class="flex items-center p-4 m-4 text-white rounded-lg bg-red-500 " role="alert">
                                        <div class="ml-3 text-xl font-medium">
الرجاء اضافة البريد الإلكتروني !                                                
                                        </div>
                                        <button type="button" class="mr-auto -mx-1.5 -my-1.5 bg-red-500 text-white rounded-lg focus:ring-2 focus:ring-red-500 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#alert-2" aria-label="Close">
                                            <span class="sr-only">اغلاق</span>
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                            </svg>
                                        </button>
                                     </div>';

    } elseif (empty($password)) {
        echo '<div id="alert-2" dir="rtl" class="flex items-center p-4 m-4 text-white rounded-lg bg-red-500 " role="alert">
                                        <div class="ml-3 text-xl font-medium">
الرجاء اضافة الرقم السري !                                                
                                        </div>
                                        <button type="button" class="mr-auto -mx-1.5 -my-1.5 bg-red-500 text-white rounded-lg focus:ring-2 focus:ring-red-500 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#alert-2" aria-label="Close">
                                            <span class="sr-only">اغلاق</span>
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                            </svg>
                                        </button>
                                     </div>';
    } elseif ($emails_count > 0) {
//Check if email is already in user table
        foreach ($users_emails as $user_email) {
            if ($user_email['email'] == $email) {
                echo '<div id="alert-2" dir="rtl" class="flex items-center p-4 m-4 text-white rounded-lg bg-red-500 " role="alert">
                                        <div class="ml-3 text-xl font-medium">
هذا البريد الإلكتروني موجود مسبقا!                                                
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
    } elseif (strlen($password) <= 8) {
        echo '<div id="alert-2" dir="rtl" class="flex items-center p-4 m-4 text-white rounded-lg bg-red-500 " role="alert">
                                        <div class="ml-3 text-xl font-medium">
كلمة السر يجب ان تكون اكثر من 8 حروف!                                                
                                        </div>
                                        <button type="button" class="mr-auto -mx-1.5 -my-1.5 bg-red-500 text-white rounded-lg focus:ring-2 focus:ring-red-500 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#alert-2" aria-label="Close">
                                            <span class="sr-only">اغلاق</span>
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                            </svg>
                                        </button>
                                     </div>';

    } elseif (preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W_]).*$/', $password)) {
        echo '<div id="alert-2" dir="rtl" class="flex items-center p-4 m-4 text-white rounded-lg bg-red-500 " role="alert">
                                        <div class="ml-3 text-xl font-medium">
يجب أن تحتوي كلمة المرور على حرف واحد على الأقل، رقم واحد على الأقل، ورمز واحد على الأقل!                                                
                                        </div>
                                        <button type="button" class="mr-auto -mx-1.5 -my-1.5 bg-red-500 text-white rounded-lg focus:ring-2 focus:ring-red-500 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#alert-2" aria-label="Close">
                                            <span class="sr-only">اغلاق</span>
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                            </svg>
                                        </button>
                                     </div>';

    } elseif ($password !== $confirm_password) {
        echo '<div id="alert-2" dir="rtl" class="flex items-center p-4 m-4 text-white rounded-lg bg-red-500 " role="alert">
                                        <div class="ml-3 text-xl font-medium">
كلمة السر غير متطابقة!                                                
                                        </div>
                                        <button type="button" class="mr-auto -mx-1.5 -my-1.5 bg-red-500 text-white rounded-lg focus:ring-2 focus:ring-red-500 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#alert-2" aria-label="Close">
                                            <span class="sr-only">اغلاق</span>
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                            </svg>
                                        </button>
                                     </div>';
    } elseif (!preg_match('/^05\d{8}$/', $phone)) {
        echo '<div id="alert-2" dir="rtl" class="flex items-center p-4 m-4 text-white rounded-lg bg-red-500 " role="alert">
                                        <div class="ml-3 text-xl font-medium">
رقم الهاتف غير مسموح!                                                
                                        </div>
                                        <button type="button" class="mr-auto -mx-1.5 -my-1.5 bg-red-500 text-white rounded-lg focus:ring-2 focus:ring-red-500 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#alert-2" aria-label="Close">
                                            <span class="sr-only">اغلاق</span>
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                            </svg>
                                        </button>
                                     </div>';

    } else {
        //Add logo
        if (isset($_FILES['logo'])) {
            $logo = $_FILES['logo'];
            $extension = pathinfo($logo['name'], PATHINFO_EXTENSION);
            $extension = strtolower($extension);
            //            check for logo type
            if (!in_array($extension, ['jpeg', 'png', 'svg', 'jpg'])) {
                echo '<div id="alert-2" dir="rtl" class="flex items-center p-4 m-4 text-white rounded-lg bg-red-500 " role="alert">
                                        <div class="ml-3 text-xl font-medium">
صيغة الملف غير مدعومة!                                                
                                        </div>
                                        <button type="button" class="mr-auto -mx-1.5 -my-1.5 bg-red-500 text-white rounded-lg focus:ring-2 focus:ring-red-500 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#alert-2" aria-label="Close">
                                            <span class="sr-only">اغلاق</span>
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                            </svg>
                                        </button>
                                     </div>';

            } else {
                $logo_name = $logo['name'];
                $upload_path = 'assets/uploads/' . $logo_name;
                move_uploaded_file($_FILES['logo']['tmp_name'], $upload_path);
                //Insert into merchant database
                $sql = "INSERT INTO merchant (name, email, password, phone, commercial_register, logo) VALUES ('$name', '$email', '$password', '$phone', '$commercial_register','$logo_name')";
                $result = $con->exec($sql);
                echo '<div id="alert-2" dir="rtl" class="flex items-center p-4 m-4 text-white rounded-lg bg-green-500 " role="alert">
                                        <div class="ml-3 text-xl font-medium">
                                                    تم إضافة البيانات بنجاح !
                                        </div>
                                        <button type="button" class="mr-auto -mx-1.5 -my-1.5 bg-green-500 text-white rounded-lg focus:ring-2 focus:ring-green-500 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#alert-2" aria-label="Close">
                                            <span class="sr-only">اغلاق</span>
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                            </svg>
                                        </button>
                                     </div>';
//                Redirect to Login page
                header('Location: login.php?merchant=success_msg');

            }
        }
    }


}
?>
<section class="bg-gray-50 ">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto lg:py-8">
        <div class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0  ">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <div class="flex flex-col items-end">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl ">
                        تسجيل حساب جديد
                    </h1>
                </div>
                <div class="flex justify-between text-right  text-sm">
                    <div class="flex flex-col items-end">
                        <a href="signup-merchant.php" class="bg-viridian-green-500 border border-viridian-green-500 text-white px-8 py-3 font-medium
                    rounded hover:bg-transparent hover:text-viridian-green-500">تسجيل حساب تاجر</a>
                    </div>

                    <div class="flex flex-col items-end">
                        <a href="signup.php" class="bg-viridian-green-500 border border-viridian-green-500 text-white px-8 py-3 font-medium
                    rounded hover:bg-transparent hover:text-viridian-green-500">تسجيل حساب مستخدم</a>
                    </div>
                </div>
                <form class="space-y-4 md:space-y-6" method="post" enctype="multipart/form-data">
                    <div class="flex flex-col items-end">

                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 items-end">الاسم</label>
                        <input type="text" name="name" id="name"
                               class="bg-gray-50 text-right border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5   "
                               required="">
                    </div>

                    <div class="flex flex-col items-end">

                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 items-end">البريد
                            الإلكتروني</label>
                        <input type="email" name="email" id="email"
                               class="bg-gray-50 text-right border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5   "
                               required="">
                    </div>

                    <div class="flex flex-col items-end">
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 ">الرقم السري</label>
                        <input type="password" name="password" id="password"
                               class="bg-gray-50 text-right border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5   "
                               required="">
                    </div>
                    <div class="flex flex-col items-end">
                        <label for="confirm_password" class="block mb-2 text-sm font-medium text-gray-900 ">تأكيد الرقم
                            السري</label>
                        <input type="password" name="confirm_password" id="confirm_password"
                               class="bg-gray-50 text-right border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5   "
                               required="">
                    </div>

                    <div class="flex flex-col items-end">
                        <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 ">رقم الهاتف</label>
                        <input type="text" name="phone" id="phone"
                               class="bg-gray-50 text-right border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5   "
                               required="">
                    </div>

                    <div class="flex flex-col items-end">
                        <label for="logo" class="block mb-2 text-sm font-medium text-gray-900 ">الشعار</label>
                        <input type="file" name="logo" id="logo" dir="rtl"
                               class="bg-gray-50 text-right border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5"
                               required="">
                    </div>

                    <div class="flex flex-col items-end">
                        <label for="record" class="block mb-2 text-sm font-medium text-gray-900 ">السجل التجاري (رَقَم
                            وثيقة العمل الحر)</label>
                        <input type="text" name="record" id="record"
                               class="bg-gray-50 text-right border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5   "
                               required="">
                    </div>

                    <div class="mt-2">
                        <button type="submit" name="submit"
                                class="w-full mt-5 bg-green-600 border border-viridian-green-500 text-white px-8 py-3 font-medium
                    rounded hover:bg-transparent hover:text-viridian-green-500">
                            تسجيل
                        </button>
                    </div>
                    <div class="flex flex-col items-end">
                        <p class="text-sm font-light text-gray-500 "> تمتلك حساب؟
                            <a href="login.php" class="font-medium text-green-600 hover:underline">
                                سجل دخول ألأن</a>
                        </p>

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
</body>
</html>
