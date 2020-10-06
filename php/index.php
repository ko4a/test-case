<?php

declare(strict_types = 1);

use App\Handlers\FormHandler;
use App\Validators\FormValidator;

require_once __DIR__ . '/../vendor/autoload.php';

if ($_SERVER['REQUEST_URI'] === '/form') {
    $validator = new FormValidator();

    if (!$validator->validate()) {
        http_response_code(400);
        echo 'Bad request';
        die;
    }

    $handler = new FormHandler($_FILES['file'], $_POST['delimiter']);
    echo $handler->handle();
    die;
}


echo file_get_contents(__DIR__ . '/../resources/html/form.html');