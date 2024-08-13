<?php
ob_start();
session_start();
if (!(isset($_SESSION['email']))) {
    header('Location:../login.php');
}
$merchant_id = $_SESSION['merchant_id'];
include "../connection.php";
$product_id = isset($_GET['product_id']) && is_numeric($_GET['product_id']) ? intval($_GET['product_id']) : 0;
$comments = $con->query("SELECT * FROM comment LEFT JOIN brands.user u on comment.user_id = u.user_id WHERE product_id='$product_id'");
$comment_count = $comments->rowCount();

?>
<!doctype html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../assets/css/output.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.css" rel="stylesheet"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=El+Messiri:wght@400;500;600;700&display=swap"
          rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <title>سعودي براند</title>
</head>
<body>


<div class="bg-gray-50 h-screen">
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
                        <a href="return_order.php"
                           class="block py-2 pl-3 pr-4 text-white rounded hover:bg-viridian-green-500 md:hover:bg-transparent md:hover:text-viridian-green-500 md:p-0">طلبات
                            الإرجاع</a>
                    </li>
                    <li>
                        <a href="orders.php"
                           class="block py-2 pl-3 pr-4 text-white rounded hover:bg-viridian-green-500 md:hover:bg-transparent md:hover:text-viridian-green-500 md:p-0">الطلبات</a>
                    </li>
                    <li>
                        <a href="products.php"
                           class="block py-2 pl-3 pr-4 text-viridian-green-500 rounded hover:bg-viridian-green-500 md:hover:bg-transparent md:hover:text-viridian-green-500 md:p-0">المنتجات</a>
                    </li>
                </ul>

            </div>

            <div class="flex flex-col items-end">
                <a href="../index.php">
                    <div class="flex flex-row items-center ">
                        <span class="self-center text-2xl text-viridian-green-600 font-semibold whitespace-nowrap">سعودي براند</span>
                        <div class="flex">
                            <img src="../assets/images/logo.png" alt="logo" class="h-28">
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->

    <div class="flex flex-col flex-1 w-full">


        <main class="h-full pb-16 overflow-y-auto bg-gray-50">
            <div class="px-8 py-8 lg:py-16">
                <div class="flex flex-col text-right">

                    <div class="flex flex-col justify-between items-end text-right mb-6">
                        <h2 class="text-lg lg:text-2xl font-bold text-gray-900 dark:text-white">التعليقات
                            (<?php echo $comment_count ?>)</h2>
                    </div>
                    <?php
                    $comment_id = '';
                    foreach ($comments as $comment):
                        $comment_id = $comment['comment_id'];

                        ?>

                        <article class="p-6 mb-6 text-base bg-white rounded-lg ">
                            <footer class="flex flex-col justify-between items-end text-right mb-2">
                                <div class="flex items-center">
                                    <p class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white">
                                        <?php echo $comment['name'] ?>
                                    </p>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">
                                        <time pubdate datetime="2022-02-08" title="February 8th, 2022"><?php
                                            echo $comment['date']
                                            ?>
                                        </time>
                                    </p>
                                </div>
                            </footer>
                            <div class="flex flex-col items-end text-right">

                                <p class="text-gray-500 dark:text-gray-400"><?php echo $comment['comment'] ?></p>
                            </div>
                            <div class="flex flex-col items-end text-right mt-4 space-x-4">
                                <button type="button" data-modal-target="defaultModal"
                                        data-modal-toggle="defaultModal"
                                        class="flex items-center text-sm text-gray-500 hover:underline dark:text-gray-400 font-medium">
                                    <svg class="mr-1.5 w-3.5 h-3.5" aria-hidden="true"
                                         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 18">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                              stroke-width="2"
                                              d="M5 5h5M5 8h2m6-3h2m-5 3h6m2-7H2a1 1 0 0 0-1 1v9a1 1 0 0 0 1 1h3v5l5-5h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1Z"/>
                                    </svg>
                                    <input type="hidden" name="comment_id" value="<?php echo $comment['comment_id'] ?>">
                                    رد علي تعليق
                                </button>
                            </div>

                        </article>
                        <?php if (empty($comment['reply'])): ?>

                    <?php else: ?>
                        <article class="p-6 mb-3 mr-8 lg:mr-12 text-base bg-white rounded-lg ">
                        <footer class="flex flex-col justify-between items-end mb-2 text-right">
                            <div class="flex items-center">

                                <p class="text-sm text-gray-600 dark:text-gray-400">
                                    <time pubdate datetime="2022-02-12"
                                          title="February 12th, 2022"><?php echo $comment['date'] ?></time>
                                </p>
                            </div>

                        </footer>


                        <p class="text-gray-500 dark:text-gray-400"><?php echo $comment['reply'] ?></p>
                    <?php endif; ?>
                        </article>
                    <?php endforeach; ?>


                </div>
            </div>
        </main>
    </div>
    <!-- Main modal -->
    <div id="defaultModal" tabindex="-1" aria-hidden="true"
         class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex text-right items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                    <div class="flex flex-col items-end">

                        <button type="button"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                data-modal-hide="defaultModal">

                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                 viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <h3 class="text-xl text-right font-semibold text-gray-900 dark:text-white">
                        رد علي التعليق
                    </h3>

                </div>
                <!-- Modal body -->
                <div class="p-6 space-y-6">
                    <?php
                    if (isset($_POST['submit'])) {
                        $reply = $_POST['review'];
                        $sql = "UPDATE comment SET reply='$reply' WHERE comment_id='$comment_id'";
                        $result = $con->exec($sql);
                        header("Location: comments_product.php?product_id=$product_id");
                    }
                    ?>
                    <form method="post">
                        <div class="py-2 px-4 mb-4 bg-white rounded-lg rounded-t-lg border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                            <label for="review" class="sr-only">Your comment</label>
                            <textarea id="review" rows="4" name="review"
                                      class="px-0 w-full text-sm text-gray-900 border-0 focus:ring-0 focus:outline-none text-right"
                                      placeholder="الرد علي التعليق" required></textarea>
                        </div>

                        <div class="flex flex-col text-right items-start">
                            <button type="submit" name="submit"
                                    class="bg-green-500 border border-viridian-green-500 text-white px-8 py-2 font-medium rounded uppercase flex items-center gap-2 hover:bg-transparent hover:text-viridian-green-500 transition">
                                رد علي التعليق
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>


<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>
</html>

