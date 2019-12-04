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

?>
<div class="users login form">
    <?= $this->Form->create($user); ?>
    <fieldset>
        <legend><?= __('Register') ?></legend>
        <div class="row align-center"><?= $this->Html->image('logo.png') ?></div>
        <?php
        echo $this->Form->control('email', ['label' => __d('CakeDC/Users', 'Email')]);
        echo $this->Form->control('password', ['label' => __d('CakeDC/Users', 'Password')]);
        echo $this->Form->control('password_confirm', [
            'type' => 'password',
            'label' => __d('CakeDC/Users', 'Confirm password')
        ]);
        echo $this->Form->control('first_name', ['label' => __d('CakeDC/Users', 'First name')]);
        echo $this->Form->control('last_name', ['label' => __d('CakeDC/Users', 'Last name')]);
        echo $this->Form->control('phone', ['label' => __('Phone')]);
        //echo $this->Form->control('address', ['label' => __('Address')]);
        if (Configure::read('Users.Tos.required')) {
            echo $this->Form->control('tos', ['type' => 'checkbox', 'label' => __d('CakeDC/Users', 'Accept TOS conditions?'), 'required' => true]);
        }
        if (Configure::read('Users.reCaptcha.registration')) {
            echo $this->User->addReCaptcha();
        }
        ?>
    </fieldset>
    <?= $this->Form->button(__d('CakeDC/Users', 'Submit'),['is' => 'submit', 'class' => 'button small']) ?>
    <?= $this->Form->end() ?>
</div>
