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
        <link href="https://fonts.googleapis.com/css2?family=El+Messiri:wght@400;500;600;700&display=swap"
              rel="stylesheet">
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>

        <script src="../assets/js/init-alpine.js"></script>
        <title>سعودي براند</title>
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
                               class="block py-2 pl-3 pr-4 text-white rounded hover:bg-viridian-green-500 md:hover:bg-transparent md:hover:text-viridian-green-500 md:p-0">تسجيل
                                الخروج</a>
                        </li>
                        <li>
                            <a href="../shipping_companies.php"
                               class="block py-2 pl-3 pr-4 text-white rounded hover:bg-viridian-green-500 md:hover:bg-transparent md:hover:text-viridian-green-500 md:p-0">شركات
                                الشحن</a>
                        </li>
                        <li>
                            <a href="new_merchants.php"
                               class="block py-2 pl-3 pr-4 text-viridian-green-500 rounded hover:bg-viridian-green-500 md:hover:bg-transparent md:hover:text-viridian-green-500 md:p-0">التجار
                                الجدد</a>
                        </li>
                        <li>
                            <a href="merchants.php"
                               class="block py-2 pl-3 pr-4 text-white rounded hover:bg-viridian-green-500 md:hover:bg-transparent md:hover:text-viridian-green-500 md:p-0">التجار</a>
                        </li>
                        <li>
                            <a href="../customer/customers.php"
                               class="block py-2 pl-3 pr-4 text-white rounded hover:bg-viridian-green-500 md:hover:bg-transparent md:hover:text-viridian-green-500 md:p-0">العملاء</a>
                        </li>

                    </ul>

                </div>
                <div class="flex flex-col items-end">
                    <a href="../../index.php">
                        <div class="flex flex-row items-center ">
                            <span class="self-center text-2xl text-viridian-green-600 font-semibold whitespace-nowrap">سعودي براند</span>
                            <div class="flex">
                                <img src="../../assets/images/logo.png" alt="logo" class="h-28">
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </nav>

        <!--Sellers Content-->

        <div class="flex flex-col flex-1 w-full">

            <div class="flex flex-col flex-1 w-full">
                <?php
                include "../../connection.php";

                $merchant_id = isset($_GET['merchant_id']) && is_numeric($_GET['merchant_id']) ? intval($_GET['merchant_id']) : 0;

                $stmt = $con->prepare("UPDATE merchant SET status=1 WHERE merchant_id= :id");

                $stmt->bindParam(":id", $merchant_id);

                $stmt->execute();
                //            Query accepted merchant
                $query = $con->query("SELECT * FROM merchant WHERE merchant_id='$merchant_id'");
                $query->execute();
                $accepted_merchant = $query->fetch();
                include "../../mail.php";
                $mail = requirePHPMailer();

                $mail->setFrom('', 'Acceptance for your application for Saudi Brand Application');
                $mail->addAddress($accepted_merchant['email']);

                $mail->isHTML(true);
                $mail->Subject = "Your entry request for Saudi Brand Application";
                $mail->Body = "<p class='text-lg'>عزيزي ,   " . $accepted_merchant['name'] . " </p> 
                <h3>
                    نحن نسعد بإعلامك بأن طلبك للانضمام كبائع في منصتنا الإلكترونية قد تم قبوله. نرحب بك في فريقنا ونتطلع إلى العمل المشترك لتحقيق النجاح وتقديم خدماتك ومنتجاتك لعملائنا.
                </h3>
                <br><br>
                <p>مع أطيب التحيات, </p>
                <b>منصة سعودي براند</b>";
                if ($mail->send()) {
                    echo '<div id="alert-2" dir="rtl" class="flex items-center p-4 m-4 text-white rounded-lg bg-green-500 " role="alert">
                                        <div class="ml-3 text-xl font-medium">
                                                    تم قَبُول البائع !
                                        </div>
                                        <button type="button" class="mr-auto -mx-1.5 -my-1.5 bg-green-500 text-white rounded-lg focus:ring-2 focus:ring-green-500 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#alert-2" aria-label="Close">
                                            <span class="sr-only">اغلاق</span>
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                            </svg>
                                        </button>
                                     </div>';

                } else {
                    echo '<div id="alert-2" dir="rtl" class="flex items-center p-4 m-4 text-white rounded-lg bg-red-500 " role="alert">
                                        <div class="ml-3 text-xl font-medium">
حدثت مشكلة !                                                
                                        </div>
                                        <button type="button" class="mr-auto -mx-1.5 -my-1.5 bg-red-500 text-white rounded-lg focus:ring-2 focus:ring-red-500 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#alert-2" aria-label="Close">
                                            <span class="sr-only">اغلاق</span>
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                            </svg>
                                        </button>
                                     </div>';

                }

                ?>

                <main class="h-full pb-16 overflow-y-auto">
                    <div class="container grid px-6 mx-auto">
                        <div class="flex flex-col items-end mr-5">

                            <h2
                                    class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"
                            >
                                التجار
                            </h2>
                        </div>

                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">


                            <table class="w-full  text-sm text-right  text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="p-4">
                                    </th>
                                    <th scope="col" class="px-6 py-3 ">

                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        السجل التجاري (رقم وثيقة العمل الحر)
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        الشعار
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        رقم الهاتف
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        البريد الإلكتروني
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        اسم التاجر
                                    </th>
                                </tr>
                                </thead>
                                <tbody id="showData">
                                <?php
                                $merchants = $con->query("SELECT * FROM merchant WHERE status=0");
                                foreach ($merchants as $merchant) {
                                    ?>
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <td class="w-4 p-4"></td>
                                        <td class="">
                                            <div class="flex justify-end space-x-4 text-sm">
                                                <a href="delete_merchant.php?merchant_id=<?php echo $merchant['merchant_id'] ?>"
                                                   class="flex items-center justify-between px-3 py-2 text-sm font-medium leading-5 bg-viridian-green-500 border border-viridian-green-500 text-white font-medium
                                                        rounded-md hover:bg-transparent hover:text-viridian-green-500"
                                                   aria-label="Delete"
                                                >
                                                    رفض
                                                </a>


                                                <a href="accept_merchant.php?merchant_id=<?php echo $merchant['merchant_id'] ?>"
                                                   class="flex items-center justify-between px-3 py-2 text-sm font-medium leading-5 bg-viridian-green-500 border border-viridian-green-500 text-white font-medium
                                                         rounded-md hover:bg-transparent hover:text-viridian-green-500"
                                                   aria-label="Accept">
                                                    قبول
                                                </a>

                                            </div>
                                        </td>
                                        <td class="px-6 py-4 font-bold hover:text-green-500">
                                            <a href="<?php echo $merchant['commercial_register_link'] ?>">
                                                <?php
                                                echo $merchant['commercial_register']
                                                ?>

                                            </a>
                                        </td>
                                        <td class="px-6 py-4 font-bold">
                                            <div class="flex flex-col items-end">
                                                <img src="../../assets/uploads/<?php echo $merchant['logo'] ?>"
                                                     alt="product image"
                                                     class=" w-20 rounded">
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 font-bold">
                                            <?php
                                            echo $merchant['phone']
                                            ?>
                                        </td>
                                        <td class="px-6 py-4 font-bold">
                                            <?php
                                            echo $merchant['email']
                                            ?>
                                        </td>
                                        <td class="px-6 py-4 font-bold">
                                            <?php
                                            echo $merchant['name']
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


            <!--End Sellers Content-->
        </div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#merchantSearch').on("keyup", function () {
                var merchantSearch = $(this).val();
                $.ajax({
                    method: 'POST',
                    url: 'merchant-search.php',
                    data: {name: merchantSearch},
                    success: function (response) {
                        $("#showData").html(response);
                    }
                });
            });
        });
    </script>
    </body>
    </html>


<?php
