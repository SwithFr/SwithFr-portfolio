<div class="content contact">
    <h1 class="content__title"><?= $metas->title; ?></h1>
    <span class="content__subtitle"><?= $metas->subtitle; ?></span>
    <?= \Core\Helpers\Form::start("me-contacter", "POST", ['class' => 'contact__form']); ?>
        <input class="contact__form__input" onkeyup="this.setAttribute('value', this.value);" type="text" name="name" id="name" value="<?= isset($posted->name) ? $posted->name : ''; ?>">
        <label class="contact__form__label contact__form__label--placeholder" for="name">Prénom Nom *  <?= isset($errors['name']) ? "<span class='has-error'>" . $errors['name'] . "</span>" : ''; ?></label>

        <input class="contact__form__input" onkeyup="this.setAttribute('value', this.value);" type="email" name="email" id="email" value="<?= isset($posted->email) ? $posted->email : ''; ?>">
        <label class="contact__form__label contact__form__label--placeholder" for="email">Votre email <span class="contact__form__label__ex">(example@fai.fr)</span> * <?= isset($errors['email']) ? "<span class='has-error'>" . $errors['email'] . "</span>" : ''; ?></label>

        <input class="contact__form__input" onkeyup="this.setAttribute('value', this.value);" type="text" name="subject" id="subject" value="<?= isset($posted->subject) ? $posted->subject : ''; ?>">
        <label class="contact__form__label contact__form__label--placeholder" for="subject">Sujet</label>

        <label class="contact__form__label" for="msg">Message * <?= isset($errors['msg']) ? "<span class='has-error'>" . $errors['msg'] . "</span>" : ''; ?></label>
        <textarea id="msg" class="contact__form__textarea" name="msg" rows="8" cols="40"><?= isset($posted->msg) ? $posted->msg : ''; ?></textarea>

        <input class="contact__form__submit" type="submit" value="Envoyer">
    </form>
</div>
<?= \Core\Helpers\Html::js('jquery'); ?>
<?= \Core\Helpers\Html::js('main');?>