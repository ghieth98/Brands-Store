<?php
session_start();
if (!(isset($_SESSION['email']))) {
    header('Location:../login.php');
}
include "../connection.php";
$user_id = $_SESSION['user_id'];
$query = $con->query("SELECT * FROM user WHERE  user_id='$user_id'");
$query->execute();
$user = $query->fetch();
?>
<!doctype html>
<html lang="ar"">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../assets/css/output.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.css" rel="stylesheet"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=El+Messiri:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <title>متجر براند</title>
</head>
<body>


<div class="h-screen">
    <!-- Navbar -->
    <nav class="bg-viridian-green-200 border-b shadow-lg rounded lg:mb-2">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">

            <div class="flex flex-col md:flex-row items-center"></div>

            <button data-collapse-toggle="navbar-dropdown" type="button"
                    class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200"
                    aria-controls="navbar-dropdown" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
            </button>

            <div class="hidden w-full md:block md:w-auto" id="navbar-dropdown">
                <ul class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg md:flex-row md:space-x-8 md:mt-0 md:border-0">

                    <li>
                        <a href="../logout.php"
                           class="block py-2 pl-3 pr-4 text-white rounded hover:bg-viridian-green-500 md:hover:bg-transparent md:hover:text-viridian-green-500 md:p-0">تسجيل
                            خروج</a>
                    </li>
                    <li>
                        <a href="return_order.php"
                           class="block py-2 pl-3 pr-4 text-white  rounded hover:bg-viridian-green-500 md:hover:bg-transparent md:hover:text-viridian-green-500 md:p-0">طلبات
                            الإرجاع</a>
                    </li>
                    <li>
                        <a href="orders.php"
                           class="block py-2 pl-3 pr-4 text-white  rounded hover:bg-viridian-green-500 md:hover:bg-transparent md:hover:text-viridian-green-500 md:p-0">الطلبات</a>
                    </li>
                    <li>
                        <a href="profile.php"
                           class="block py-2 pl-3 pr-4 text-viridian-green-500 rounded hover:bg-viridian-green-500 md:hover:bg-transparent md:hover:text-viridian-green-500 md:p-0">الملف
                            الشخصي</a>
                    </li>
                </ul>

            </div>

            <div class="flex flex-col items-end">
                <a href="../index.php">
                    <div class="flex flex-row items-center ">
                        <span class="self-center text-2xl text-viridian-green-600 font-semibold whitespace-nowrap">متجر براند</span>
                        <div class="flex">
                            
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->

    <div class="flex flex-col flex-1 w-full">


        <main class="h-full pb-16 overflow-y-auto ">
            <div class="container grid px-6 mx-auto">

                <div class="flex flex-col items-end mr-5">
                    <h2 class="my-6 text-2xl font-semibold text-gray-700">
                        الملف الشخصي
                    </h2>

                </div>

                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">

                    <div class="flex flex-col items-center">

                        <div class="mb-4 border-b border-gray-200">
                            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="profileContent"
                                data-tabs-toggle="#profileContent" role="tablist">

                                <li class="mr-2" role="presentation">
                                    <button class="inline-block hover:text-green-500 text-green-600 p-4 border-b-2 border-transparent rounded-t-lg"
                                            id="edit-profile-tab" data-tabs-target="#edit-profile" type="button"
                                            role="tab"
                                            aria-controls="edit-profile" aria-selected="false">تعديل الملف الشخصي
                                    </button>
                                </li>
                                <li class="mr-2" role="presentation">
                                    <button class="inline-block hover:text-green-500 text-green-600 p-4 border-b-2 border-transparent rounded-t-lg"
                                            id="profile-tab"
                                            data-tabs-target="#profile" type="button" role="tab" aria-controls="profile"
                                            aria-selected="true">الملف الشخصي
                                    </button>
                                </li>
                            </ul>
                        </div>

                        <div id="profileContent" class="w-1/2 py-3">

                            <div class="hidden p-4 rounded-lg" id="profile" role="tabpanel"
                                 aria-labelledby="profile-tab">

                                <dl class=" text-gray-900 text-right divide-y divide-gray-200">
                                    <div class="flex flex-col pb-3">
                                        <dt class="mb-1 text-gray-500 md:text-lg">الاسم</dt>
                                        <dd class="text-lg font-semibold">
                                            <?php echo $user['name']; ?>
                                        </dd>
                                    </div>
                                    <div class="flex flex-col py-3">
                                        <dt class="mb-1 text-gray-500 md:text-lg">البريد الإلكتروني</dt>
                                        <dd class="text-lg font-semibold">
                                            <?php echo $user['email'] ?>
                                        </dd>
                                    </div>
                                    <div class="flex flex-col pt-3">
                                        <dt class="mb-1 text-gray-500 md:text-lg">رقم الهاتف</dt>
                                        <dd class="text-lg font-semibold">
                                            <?php echo $user['phone_number'] ?>
                                        </dd>
                                    </div>
                                    <div class="flex flex-col pt-3">
                                        <dt class="mb-1 text-gray-500 md:text-lg">الحي</dt>
                                        <dd class="text-lg font-semibold">
                                            <?php echo $user['district'] ?>
                                        </dd>
                                    </div>
                                    <div class="flex flex-col pt-3">
                                        <dt class="mb-1 text-gray-500 md:text-lg">المدينة</dt>
                                        <dd class="text-lg font-semibold">
                                            <?php
                                            echo $user['city']
                                            ?>
                                        </dd>
                                    </div>
                                    <div class="flex flex-col pt-3">
                                        <dt class="mb-1 text-gray-500 md:text-lg">الشارع</dt>
                                        <dd class="text-lg font-semibold">
                                            <?php
                                            echo $user['street']
                                            ?>
                                        </dd>
                                    </div>

                                </dl>

                            </div>

                            <div class="hidden p-4 rounded-lg " id="edit-profile" role="tabpanel"
                                 aria-labelledby="edit-profile-tab">

                                <form class="space-y-4 md:space-y-6" method="post" action="update_profile.php">
                                    <div class="flex flex-col items-end">

                                        <label for="name"
                                               class="block mb-2 text-sm font-medium text-gray-900 items-end">الاسم</label>
                                        <input type="text" name="name" id="name"
                                               class="text-right  border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5   "
                                               required value="<?php echo $user['name'] ?>">
                                    </div>

                                    <div class="flex flex-col items-end">

                                        <label for="email"
                                               class="block mb-2 text-sm font-medium text-gray-900 items-end">البريد
                                            الإلكتروني</label>
                                        <input type="email" name="email" id="email" disabled
                                               class="text-right  border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5   "
                                               required value="<?php echo $user['email'] ?>">
                                    </div>

                                    <div class="flex flex-col items-end">
                                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 ">الرقم
                                            السري</label>
                                        <input type="password" name="password" id="password"
                                               value="<?php echo $user['password'] ?>"
                                               class="text-right  border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5   "
                                               required>
                                    </div>

                                    <div class="flex flex-col items-end">
                                        <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 ">رقم
                                            الهاتف</label>
                                        <input type="text" name="phone" id="phone"
                                               value="<?php echo $user['phone_number']; ?>"
                                               class="text-right  border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5   "
                                               required>
                                    </div>

                                    <div class="flex flex-col items-end">
                                        <label for="city"
                                               class="block mb-2 text-sm font-medium text-gray-900 ">المدينة</label>
                                        <input type="text" name="city" id="city" value="<?php echo $user['city']; ?>"
                                               class="text-right  border border-gray-300 text-gray-900 sm:text-sm  rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5   "
                                               required>
                                    </div>

                                    <div class="flex flex-col items-end">
                                        <label for="street"
                                               class="block mb-2 text-sm font-medium text-gray-900 ">الشارع</label>
                                        <input type="text" name="street" id="street"
                                               value="<?php echo $user['street'] ?>"
                                               class="text-right  border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5   "
                                               required>
                                    </div>

                                    <div class="flex flex-col items-end">
                                        <label for="neighborhood" class="block mb-2 text-sm font-medium text-gray-900 ">الحي</label>
                                        <input type="text" name="neighborhood" id="neighborhood"
                                               value="<?php echo $user['district'] ?>"
                                               class="text-right  border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5 "
                                               required>
                                    </div>

                                    <div class="mt-2">
                                        <button type="submit" name="submit"
                                                class="w-full bg-green-600 border border-viridian-green-500 text-white px-8 py-3 font-medium rounded hover:bg-transparent hover:text-viridian-green-500">
                                            تعديل البيانات
                                        </button>
                                    </div>

                                </form>

                            </div>

                        </div>

                    </div>


                </div>


            </div>


        </main>
    </div>
</div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>
</html>


