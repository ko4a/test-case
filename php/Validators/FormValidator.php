<?php

declare(strict_types = 1);

namespace App\Validators;

class FormValidator implements ValidatorInterface
{

    public function validate(): bool
    {
        $exists = array_key_exists('file', $_FILES) && array_key_exists('delimiter', $_POST);
        $isPost = $_SERVER['REQUEST_METHOD'] === 'POST';
        $notEmpty = !empty($_FILES) && !empty($_POST);

        return $exists && $isPost && $notEmpty;
    }
}