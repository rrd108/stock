<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<nav class="small-3 medium-2 large-2 columns" id="actions-sidebar">
    <ul class="menu vertical">
        <li class="menu-text"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $user->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Social Accounts'), ['controller' => 'SocialAccounts', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Social Account'), ['controller' => 'SocialAccounts', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="users form small-9 medium-10 large-10 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Edit User') ?></legend>
        <?php
            echo $this->Form->control('username');
            echo $this->Form->control('email');
            echo $this->Form->control('password');
            echo $this->Form->control('first_name');
            echo $this->Form->control('last_name');
            echo $this->Form->control('token');
            echo $this->Form->control('token_expires', ['empty' => true]);
            echo $this->Form->control('api_token');
            echo $this->Form->control('activation_date', ['empty' => true]);
            echo $this->Form->control('secret');
            echo $this->Form->control('secret_verified');
            echo $this->Form->control('tos_date', ['empty' => true]);
            echo $this->Form->control('active');
            echo $this->Form->control('is_superuser');
            echo $this->Form->control('role');
            echo $this->Form->control('additional_data');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'), ['class' => 'button']) ?>
    <?= $this->Form->end() ?>
</div>
