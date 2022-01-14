<!DOCTYPE html>
<html lang="en">
<head>
    <!-- META -->
    <?php require "snippets/head/default_metatags.php" ?>

    <!-- CSS -->
    <?php require "snippets/head/default_css_connections.php" ?>

    <!-- JS -->
    <?php require "snippets/head/default_js_connection.php" ?>

    <title>Электронный тест по интерактивным графическим системам</title>
</head>
<body class="d-flex h-100 text-center text-white bg-dark">    
    <div class="cover-container overflow-hidden d-flex w-100 h-100 p-3 mx-auto flex-column">
        <?php require "snippets/header.php" ?>

        <main class="px-3">
            <div class="animate__animated animate__backInDown">
            <h1>Интерактивные графические системы.</h1>
            <p class="lead">Проверьте свои знания на данную тему и пройдите тест, нажав на кнопку ниже. После успешного прохождения Вы сможете увидеть результат (он будет виден только администраторам).</p>
            </div>
            
            <p class="lead animate__animated animate__backInUp">
                <a href="/test.php" class="btn btn-lg btn-secondary fw-bold border-white bg-white">Начать тестирование</a>
            </p>
        </main>

      <?php require "snippets/footer.php" ?>
    </div>
    
    <!-- JS -->
    <?php require "snippets/body/default_js_connection.php" ?>
</body>
</html>