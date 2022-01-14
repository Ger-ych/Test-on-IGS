<?php
    require_once __DIR__ . '/incs/functions.php';
    require_once 'incs/database.php';

    $questions = getQuestions($link);

    // debug($questions);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- META -->
    <?php require "snippets/head/default_metatags.php" ?>

    <!-- CSS -->
    <?php require "snippets/head/default_css_connections.php" ?>
    <link rel="stylesheet" href="/static/css/test/main.css">

    <!-- JS -->
    <?php require "snippets/head/default_js_connection.php" ?>

    <title>Электронный тест по интерактивным графическим системам</title>
</head>
<body class="d-flex h-100 text-center text-white bg-dark">    
    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
        <?php require "snippets/header.php" ?>

        <main class="p-5 bg-light main-test my-5 animate__animated animate__fadeIn">
            <form action="/result.php" method="POST" id="test-form">
            </form>

            <?php
                foreach ($questions as $q) {
                    echo "
                    <div class='question' id='question".$q['id']."'>
                        <h3>".$q['question']."</h3>

                        <div class='my-4 d-flex justify-content-center flex-column'>
                            <div>
                                <input type='radio' form='test-form' id='question".$q['id']."_Choice0' name='".$q['id']."' value='".$q['answers'][0]['text']."'>
                                <label for='question".$q['id']."_Choice0'>".printAnswerName($q['answers'][0])."</label>
                            </div>

                            <div>
                                <input type='radio' form='test-form' id='question".$q['id']."_Choice1' name='".$q['id']."' value='".$q['answers'][1]['text']."'>
                                <label for='question".$q['id']."_Choice1'>".printAnswerName($q['answers'][1])."</label>
                            </div>

                            <div>
                                <input type='radio' form='test-form' id='question".$q['id']."_Choice2' name='".$q['id']."' value='".$q['answers'][2]['text']."'>
                                <label for='question".$q['id']."_Choice2'>".printAnswerName($q['answers'][2])."</label>
                            </div>

                            <div>
                                <input type='radio' form='test-form' id='question".$q['id']."_Choice3' name='".$q['id']."' value='".$q['answers'][3]['text']."'>
                                <label for='question".$q['id']."_Choice3'>".printAnswerName($q['answers'][3])."</label>
                            </div>
                        </div>
                    </div>
                    ";
                }
            ?>

            <p class="lead mt-5">
            <a href="/" class="btn btn-lg btn-outline-dark fw-bold">« Назад</a>
            <button form="test-form" class="btn btn-lg btn-dark fw-bold">Завершить »</button>
            </p>
        </main>

      <?php require "snippets/footer.php" ?>
    </div>
    
    <!-- JS -->
    <?php require "snippets/body/default_js_connection.php" ?>
</body>
</html>