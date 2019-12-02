<?php
/**
 * Copyright 2010 - 2017, Cake Development Corporation (https://www.cakedc.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2010 - 2017, Cake Development Corporation (https://www.cakedc.com)
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
use Cake\Core\Configure;

$this->assign('title', __('Login'));
?>
<div class="users login form">
    <div class="row align-center">
        <?= $this->Html->image('logo.png') ?>
    </div>
    <div class="row align-center">
        <h1>StockR</h1>
    </div>
    <?= $this->Flash->render('auth') ?>
    <?= $this->Form->create() ?>
    <fieldset>
        <div class="callout warning">
            <legend>
                <?= __d('CakeDC/Users', 'Please enter your email and password') ?>
            </legend>
        </div>
        <?= $this->Form->control('email', ['label' => __d('CakeDC/Users', 'Email'), 'required' => true]) ?>
        <?= $this->Form->control('password', ['label' => __d('CakeDC/Users', 'Password'), 'required' => true]) ?>
        <?php
        if (Configure::read('Users.reCaptcha.login')) {
            echo $this->User->addReCaptcha();
        }
        if (Configure::read('Users.RememberMe.active')) {
            echo $this->Form->control(Configure::read('Users.Key.Data.rememberMe'), [
                'type' => 'checkbox',
                'label' => __d('CakeDC/Users', 'Remember me'),
                'checked' => Configure::read('Users.RememberMe.checked')
            ]);
        }
        ?>
    </fieldset>
    <?= implode(' ', $this->User->socialLoginList()); ?>
    <div class="row align-center">
        <?= $this->Form->button(__d('CakeDC/Users', 'Login'), ['class' => 'button']) ?>
    </div>
    <?= $this->Form->end() ?>
    <div class="row align-center">
        <?php
        $registrationActive = Configure::read('Users.Registration.active');
        if ($registrationActive) {
            echo $this->Html->link(
                __d('CakeDC/Users', 'Register'),
                ['action' => 'register'],
                ['class' => 'column align-self-middle']
            );
        }
        if (Configure::read('Users.Email.required')) {
            if ($registrationActive) {
                //echo ' | ';
            }
            echo $this->Html->link(
                __d('CakeDC/Users', 'Reset Password'),
                ['action' => 'requestResetPassword'],
                ['class' => 'column align-self-middle']
            );
        }
        ?>
    </div>
</div>