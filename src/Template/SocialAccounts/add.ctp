<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SocialAccount $socialAccount
 */
?>
<nav class="small-3 medium-2 large-2 columns" id="actions-sidebar">
    <ul class="menu vertical">
        <li class="menu-text"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Social Accounts'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="socialAccounts form small-9 medium-10 large-10 columns content">
    <?= $this->Form->create($socialAccount) ?>
    <fieldset>
        <legend><?= __('Add Social Account') ?></legend>
        <?php
            echo $this->Form->control('user_id', ['options' => $users]);
            echo $this->Form->control('provider');
            echo $this->Form->control('username');
            echo $this->Form->control('reference');
            echo $this->Form->control('avatar');
            echo $this->Form->control('description');
            echo $this->Form->control('link');
            echo $this->Form->control('token');
            echo $this->Form->control('token_secret');
            echo $this->Form->control('token_expires', ['empty' => true]);
            echo $this->Form->control('active');
            echo $this->Form->control('data');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'), ['class' => 'button']) ?>
    <?= $this->Form->end() ?>
</div>
