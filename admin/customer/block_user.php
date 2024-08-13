<?php
session_start();
if (!(isset($_SESSION['email']))) {
    header('Location:../../login.php');
}
?>
<!doctype html>
<html lang="ar" x-data="data()">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../assets/css/output.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.css" rel="stylesheet"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=El+Messiri:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="../assets/js/init-alpine.js"></script>
    <title>متجر براند</title>
</head>
<body>


<div class=" bg-gray-50 h-screen">
    <!-- Desktop sidebar -->
    <nav class="bg-viridian-green-200 border-b shadow-lg rounded lg:mb-2">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">

            <div class="flex flex-col md:flex-row items-center">

            </div>
            <button data-collapse-toggle="navbar-dropdown" type="button"
                    class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200"
                    aria-controls="navbar-dropdown" aria-expanded="false">
                <span class="sr-only">Open main menu</span>

            </button>
            <div class="hidden w-full md:block md:w-auto" id="navbar-dropdown">
                <ul class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg md:flex-row md:space-x-8 md:mt-0 md:border-0">
                    <li>
                        <a href="../../logout.php"
                           class="block py-2 pl-3 pr-4 text-white rounded hover:bg-viridian-green-500 md:hover:bg-transparent md:hover:text-viridian-green-500 md:p-0">تسجيل الخروج</a>
                    </li>
                    <li>
                        <a href="../shipping_companies.php"
                           class="block py-2 pl-3 pr-4 text-white rounded hover:bg-viridian-green-500 md:hover:bg-transparent md:hover:text-viridian-green-500 md:p-0">شركات
                            الشحن</a>
                    </li>
                    <li>
                        <a href="../merchants/new_merchants.php"
                           class="block py-2 pl-3 pr-4 text-white rounded hover:bg-viridian-green-500 md:hover:bg-transparent md:hover:text-viridian-green-500 md:p-0">التجار
                            الجدد</a>
                    </li>
                    <li>
                        <a href="../merchants/merchants.php"
                           class="block py-2 pl-3 pr-4 text-white rounded hover:bg-viridian-green-500 md:hover:bg-transparent md:hover:text-viridian-green-500 md:p-0">التجار</a>
                    </li>
                    <li>
                        <a href="customers.php"
                           class="block py-2 pl-3 pr-4 text-viridian-green-500 rounded hover:bg-viridian-green-500 md:hover:bg-transparent md:hover:text-viridian-green-500 md:p-0">العملاء</a>
                    </li>

                </ul>

            </div>
            <div class="flex flex-col items-end">
                <a href="../../index.php">
                    <div class="flex flex-row items-center ">
                        <span class="self-center text-2xl text-viridian-green-600 font-semibold whitespace-nowrap">متجر براند</span>
                        <div class="flex">
                            <img src="../../assets/images/logo.png" alt="logo" class="h-28">
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </nav>


    <div class="flex flex-col flex-1 w-full">
        <?php
        include "../../connection.php";

        $customer_id = isset($_GET['user_id']) && is_numeric($_GET['user_id']) ? intval($_GET['user_id']) : 0;

        $stmt = $con->prepare("UPDATE user SET block=1 WHERE user_id= :id");

        $stmt->bindParam(":id", $customer_id);

        $stmt->execute();
        echo '<div id="alert-2" dir="rtl" class="flex items-center p-4 m-4 text-white rounded-lg bg-red-500 " role="alert">
                                        <div class="ml-3 text-xl font-medium">
تم حظر المستخدم !                                                
                                        </div>
                                        <button type="button" class="mr-auto -mx-1.5 -my-1.5 bg-red-500 text-white rounded-lg focus:ring-2 focus:ring-red-500 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#alert-2" aria-label="Close">
                                            <span class="sr-only">اغلاق</span>
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                            </svg>
                                        </button>
                                     </div>';
        ?>


        <main class="h-full pb-16 overflow-y-auto">
            <div class="container grid px-6 mx-auto">
                <div class="flex flex-col items-end mr-5">

                    <h2
                            class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"
                    >
                        العملاء
                    </h2>
                </div>

                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <div class="flex flex-col items-end pr-5 pt-3  bg-white">


                        <label for="customerSearch" class="sr-only">Search</label>
                        <div class="relative mb-3 text-right">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 " aria-hidden="true"
                                     xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                          stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                </svg>
                            </div>
                            <input type="text" id="customerSearch"
                                   class="block p-2 pl-10 text-sm text-right text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="... ابحث هنا">
                        </div>


                    </div>

                    <table class="w-full text-sm text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="p-4">
                            </th>
                            <th scope="col" class="px-6 py-3 ">

                            </th>
                            <th scope="col" class="px-6 py-3">
                                الشارع
                            </th>
                            <th scope="col" class="px-6 py-3">
                                الحي
                            </th>
                            <th scope="col" class="px-6 py-3">
                                المدينة
                            </th>
                            <th scope="col" class="px-6 py-3">
                                البريد الإلكتروني
                            </th>
                            <th scope="col" class="px-6 py-3">
                                اسم العميل
                            </th>
                        </tr>
                        </thead>
                        <tbody id="showData">
                        <?php
                        $customers = $con->query("SELECT * FROM user WHERE block=0");
                        foreach ($customers as $customer) {
                            ?>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="w-4 p-4"></td>
                                <th class="px-6 pr-8 mr-5 py-4 font-bold text-green-500  hover:text-red-800 dark:text-white">

                                    <a href="block_user.php?user_id=<?php echo $customer['user_id'] ?>"
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
                                <td class="px-6 py-4 font-bold">
                                    <?php
                                    echo $customer['street']
                                    ?>
                                </td>
                                <td class="px-6 py-4 font-bold">
                                    <?php
                                    echo $customer['district']
                                    ?>
                                </td>
                                <td class="px-6 py-4 font-bold">
                                    <?php
                                    echo $customer['city']
                                    ?>
                                </td>
                                <td class="px-6 py-4 font-bold">
                                    <?php
                                    echo $customer['email']
                                    ?>
                                </td>
                                <td class="px-6 py-4 font-bold">
                                    <?php
                                    echo $customer['name'];
                                    ?>
                                </td>
                            </tr>
                        <?php } ?>


                        </tbody>
                    </table>
                </div>

            </div>
        </main>
    </div>
</div>
</body>


<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>
<script>
    $(document).ready(function(){
        $('#customerSearch').on("keyup", function(){
            let customerSearch = $(this).val();
            $.ajax({
                method:'POST',
                url:'search-customer.php',
                data:{name:customerSearch},
                success:function(response)
                {
                    $("#showData").html(response);
                }
            });
        });
    });
</script>
</html>


