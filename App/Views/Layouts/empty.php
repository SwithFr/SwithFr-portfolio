<?php use App\Config\App; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, minimum-scale=1.0">
    <meta name="author" content="Jeremy Smith"/>
    <meta name="robots" content="noindex">
    <title>
        Connect |
        <?= App::getInstance()->getAppSettings('name'); ?>
    </title>
</head>
<body>
    <?= $this->Session->flash(); ?>
    <?= $content_for_layout; ?>
</body>
</html>
