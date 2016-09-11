<?php use Core\Helpers\Html;
use App\Config\App; ?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, minimum-scale=1.0">
    <meta name="author" content="Jeremy Smith"/>
    <meta name="description" content="<?= $metas->description; ?>"/>
    <meta name="keywords" content="<?= $metas->keywords; ?>"/>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,600,700,800" rel="stylesheet">
    <link rel="icon" type="image/png" href="favicon.png" />
    <title>
        <?php if(isset($metas->title) && !empty($metas->title)): ?>
           <?= $metas->title; ?> |
       <?php endif; ?>
        <?= App::getInstance()->getAppSettings('name'); ?>
    </title>
    <?= Html::css('main'); ?>
</head>
<body>

<?= $this->Session->flash(); ?>

<div class="container">
    <?= $content_for_layout; ?>
</div>

</body>
</html>
