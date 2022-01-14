<?php
    require_once __DIR__ . '/incs/functions.php';
    require_once 'incs/database.php';

    $questions = getQuestions($link);
    
    if($_SERVER['REQUEST_METHOD'] == "POST") {
        $quantity_correct_answers = 0;
        $quantity_all_answers = count($questions);

        foreach ($questions as $q) {
            if(key_exists($q['id'], $_POST)) {
                $answer_text = $_POST[$q['id']];
                $answers = $q['answers'];

                foreach ($answers as $a) {
                    if($a['text'] == $answer_text and $a['correct']) {
                        $quantity_correct_answers++;
                    } 
                }
            }
        }

        $correct_percent = $quantity_correct_answers / $quantity_all_answers * 100;

        // echo $quantity_correct_answers;
        // echo $quantity_all_answers;
        // echo $correct_percent;

        saveResult($link, $correct_percent);
    }
    else {
        echo "<h1>Метод не поддерживается! <a href='/'>На главную</a></h1>";
        exit(header('HTTP/1.0 405 Method Not Allowed'));
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- META -->
    <?php require "snippets/head/default_metatags.php" ?>

    <!-- CSS -->
    <?php require "snippets/head/default_css_connections.php" ?>
    <link rel="stylesheet" href="/static/css/result/main.css">

    <!-- JS -->
    <?php require "snippets/head/default_js_connection.php" ?>

    <title>Результат теста по интерактивным графическим системам</title>
</head>
<body class="d-flex h-100 text-center text-white bg-dark">    
    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
        <?php require "snippets/header.php" ?>

        <main class="p-5 bg-light main-test my-5 animate__animated animate__pulse">
            <h1>Результат прохождения теста.</h1>
            <h3 class="lead">Вы набрали <b><?php echo $quantity_correct_answers ?></b> баллов из <b><?php echo $quantity_all_answers ?></b></h3>

            <div class="progress mt-3" style="height: 20px;">
                <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
            </div>

            <p class="lead mt-4">
            <a href="/" class="btn btn-md btn-dark fw-bold">На главную »</a>
            </p>
        </main>

      <?php require "snippets/footer.php" ?>
    </div>
    
    <!-- JS -->
    <?php require "snippets/body/default_js_connection.php" ?>

    <script type="text/javascript">
        let progress_element = document.querySelector('.progress-bar');

        setTimeout(() => { 
            progress_element.style.width = "<?php echo $correct_percent ?>%";
            progress_element.setAttribute('aria-valuenow', '<?php echo $correct_percent ?>')
            progress_element.textContent = '<?php echo $correct_percent ?>%';
        }, 750);
    </script>
</body>
</html>