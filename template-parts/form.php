<?php
/**
 * Template part for displaying form
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ylia
 */
?>
<form method="post" class="callback-form">
    <input type="hidden" name="ylia_callback_nonce" value="<?= wp_create_nonce("ylia_callback_nonce") ?>">
    <div class="row">
        <div class="col-md-6 col-sm-12 col-xs-12">
            <input type="text" id="client_name" class="form-control" name="name" placeholder="<?= __('Your Name', 'ylia') ?>">
        </div>
        <div class="col-md-6 col-sm-12 col-xs-12">
            <input type="tel" id="client_phone" class="form-control" type="text" name="phone" required="required" placeholder="<?= __('Your phone', 'ylia') ?>">
        </div>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <textarea id="client_message" class="form-control"  name="message" placeholder="<?= __('Your message', 'ylia') ?>"></textarea>
        </div>
    </div>
    <div class="status"></div>
    <button type="submit" class="button"><?= __('Call Me', 'ylia') ?></button>
</form>
