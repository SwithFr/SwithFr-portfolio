<?= \Core\Helpers\Html::css('main'); ?>
<?= \Core\Helpers\Html::css('animated'); ?>
<canvas id="canvas" width="500" height="500"></canvas>
<div class="content hidden">
    <h2 class="content__title">RESTRICTED AREA</h2>
    <h3 class="content__subtitle">You shouldn't be here...</h3>
    <?php use Core\Helpers\Form; ?>

    <?= Form::start("connect"); ?>
    <?= Form::input("text", "login", _("Login"), ['class' => 'loginFrom__input'], null, _("login")); ?>
    <?= Form::input("password", "password", _("Password"), ['class' => 'loginFrom__input'], null, _("password")); ?>
    <?= Form::end(_("Se connecter")); ?>
</div>
<?= \Core\Helpers\Html::js('sha1'); ?>
<?= \Core\Helpers\Html::js('secret'); ?>
<?= \Core\Helpers\Html::js('jquery'); ?>
<?= \Core\Helpers\Html::js('main'); ?>