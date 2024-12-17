
<html class="h-full bg-gray-100" lang="en">
<?php require "partials/head.partial.php"; ?>
<body class="h-full">
<div class="min-h-full">

    <?php require "partials/nav.partial.php"; ?>
    <?php require  "partials/header.partial.php"; ?>

    <main>
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <form method="POST" action="/test">
                <input name="name" />
                <input type="submit" />
            </form>
            <?= $name; ?>
        </div>
    </main>
</div>
</body>
</html>

