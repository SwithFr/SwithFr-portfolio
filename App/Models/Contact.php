<?php

namespace App\Models;


class Contact extends AppModel
{

    public $validationRules = [
        "name" => [
            ['ruleName' => 'required', 'message' => 'Nom obligatoire']
        ],
        "email" => [
            ['ruleName' => 'required', 'message' => 'Email obligatoire'],
            ['ruleName' => 'isMail', 'message' => 'Format du mail invalide']
        ],
        "msg" => [
            ['ruleName' => 'required', 'message' => 'Message obligatoire']
        ]
    ];

}