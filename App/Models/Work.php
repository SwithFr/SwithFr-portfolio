<?php

namespace App\Models;


use Core\Helpers\Text;

class Work extends AppModel
{

    public $primaryKey = "slug";

    public $validationRules = [
        "title" => [
          ['ruleName' => 'required', 'message' => 'Titre obligatoire']
        ],
        "description" => [
            ['ruleName' => 'required', 'message' => 'Description obligatoire']
        ]
    ];

    public function beforeSave($data)
    {
        if (isset($data->title) && !empty($data->title)) {
            $data->slug = Text::toSlug($data->title);
        }

        return $data;
    }
}