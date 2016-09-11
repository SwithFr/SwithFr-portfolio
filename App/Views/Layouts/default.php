<?php use Core\Helpers\Html;
use App\Config\App; ?>
<!DOCTYPE html>
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
    <?= Html::css('animated'); ?>
    <?php if($this->Request->url === '/works'): ?>
        <?= Html::css('sweetalert'); ?>
    <?php endif; ?>

</head>
<body>
<?php if($this->Auth->isLogged() && $this->Auth->role() === "admin"): ?>
    <div class="adminPanel">
        <?= Html::link('logout', 'logout', null, ['class' => 'adminPanel__link']); ?>
        <?php if($this->Request->url === "/works"): ?>
            |
            <?= Html::link('#', '+', null, ['class' => 'adminPanel__link adminPanel__link--big', 'id' => 'addWork']); ?>
        <?php endif; ?>

    </div>
<?php endif; ?>

<div class="ct">
    <div class="header header--left">
        <a class="header__homeLink" href="<?= Html::url('home'); ?>">
            <svg width="120" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                 viewBox="0 0 249.9 295.8" enable-background="new 0 0 249.9 295.8" xml:space="preserve">
                    <path fill="#C94F45" d="M175.3,156.7C127.5,136.6,2,122.6,0.1,0c0,0-7.4,123.6,152.7,170.3L175.3,156.7z"/>
                <path fill="#C94F45" d="M75.1,163.9c47.7,20.1,173.3,35.2,174.8,131.8c0,0,7.8-98.8-152.3-145.5L75.1,163.9z"/>
                </svg>
            <p class="header__title">Jeremy <span class="colored">Smith</span><span class="header__subtitle">Développeur <span>w</span>eb</span></p>
        </a>

        <ul class="nav">
            <li class="nav__item nav__item--bordered">
                <?= Html::link("a-propos", "À propos", null, ['title' => 'Apprenez en plus sur moi']); ?>
            </li>
            <li class="nav__item nav__item--bordered">
                <?= Html::link("realisations", "Réalisations", null, ['title' => 'Découvrez mes projets']); ?>
            </li>
            <li class="nav__item">
                <?= Html::link("me-contacter", "Contact", null, ['title' => 'Contactez moi']); ?>
            </li>
        </ul>
        <ul class="nav">
            <li class="nav__item nav__item--scl"><a title="Visitez ma page twitter" href="https://twitter.com/SwithFr"><?= \Core\Helpers\Html::img('t.svg', 'Logo twitter'); ?></a></li>
            <li class="nav__item nav__item--scl"><a title="Visitez ma page GitHub" href="https://github.com/SwithFr"><?= \Core\Helpers\Html::img('github.svg', 'Logo GitHub'); ?></a></li>
            <li class="nav__item nav__item--scl"><a title="Visitez ma page Linkedin" href="https://fr.linkedin.com/pub/jérémy-smith/45/973/445"><?= \Core\Helpers\Html::img('linkedin.svg', 'Logo Linkedin'); ?></a></li>
        </ul>
    </div>
</div>
<div class="wrap">
    <?= $this->Session->flash(); ?>
    <?= $content_for_layout; ?>
    <?= $this->Element('vcard'); ?>
</div>
<?php if($this->Request->url === '/works'): ?>
    <?= Html::js('min/jquery'); ?>
    <?= Html::js('min/sweetalert.min'); ?>
    <?= Html::js('min/main'); ?>
<?php endif; ?>
</body>
</html>
