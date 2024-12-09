<html class="h-full bg-gray-100" lang="en">
<?php require "partials/head.partial.php";
/**
 * @var $title
 * @var $name
 */

?>
<body class="h-full">
<div class="min-h-full">

    <?php require "partials/nav.partial.php"; ?>
    <?php require "partials/header.partial.php"; ?>

    <main>
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <form action="/redirected" method="GET">
                <input type="submit" value="Test"/>
            </form>
            <?php
            if (session_status() === PHP_SESSION_ACTIVE) {
                if (isset($_SESSION['test'])) {
                    echo $_SESSION['test'];
                }
            }
            ?>
        </div>
    </main>
</div>
</body>
</html>

