<?php

// Settings

$show_correct_answers = 0;


// Function for outputting data for convenient application debugging
function debug($data) {
    echo '<pre>' . print_r($data, 1) . '<pre>';
}

// A function to get a form object from a POST request
function load($data) {
    foreach($_POST as $k => $v) {
        if(array_key_exists($k, $data)) {
            $data[$k]['value'] = trim($v);
        }
    }
    return $data;
}

// This function validates the data of the form object according to the validation conditions specified in this object
function validate($data) {
    $errors = '';

    foreach ($data as $k => $v) {
        if($data[$k]['required'] && empty($data[$k]['value'])) {
            $errors .= "<li>{$data[$k]['field_name']} - обязательное поле!<li>";
        }
    }

    return $errors;
}

// Function for getting the user's IP-address
function getIp() {
  $keys = [
    'HTTP_CLIENT_IP',
    'HTTP_X_FORWARDED_FOR',
    'REMOTE_ADDR'
  ];
  foreach ($keys as $key) {
    if (!empty($_SERVER[$key])) {
      $ip = trim(end(explode(',', $_SERVER[$key])));
      if (filter_var($ip, FILTER_VALIDATE_IP)) {
        return $ip;
      }
    }
  }
}

// Function for displaying the text of the answer option in the template in accordance with the "show_correct_answers" setting
function printAnswerName($answer) {
  global $show_correct_answers;

  if($show_correct_answers && $answer['correct']) {
    return "<b>".$answer['text']."</b>";
  }
  else {
    return $answer['text'];
  }
}

// Getting a jumbled list of questions and answer options from a database
function getQuestions($link) {
  $sql_request = "SELECT * FROM `questions`";
  $result = mysqli_query($link, $sql_request);

  $questions = [];

  foreach ($result as $q) {
    $answers = [
      [
        'text' => $q['correct_answer'],
        'correct' => 1
      ],
      [
        'text' => $q['incorrect_answer_1'],
        'correct' => 0
      ],
      [
        'text' => $q['incorrect_answer_2'],
        'correct' => 0
      ],
      [
        'text' => $q['incorrect_answer_3'],
        'correct' => 0
      ]
    ];

    shuffle($answers);

    $question_model = [
      'id' => $q['id'],
      'question' => $q['question'],
      'answers' => $answers,
    ];
    
    array_push($questions, $question_model);
  }

  shuffle($questions);

  return $questions;
}

// Function for saving the test result to the database
function saveResult($link, $percent_result){
  $user_ip = getIp();
  
  $sql_request = "INSERT INTO `results` (`percent`, `user_ip`) VALUES ('$percent_result', '$user_ip')";
  return mysqli_query($link, $sql_request);
}
  