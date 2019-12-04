<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="small-3 medium-2 large-2 columns" id="actions-sidebar">
    <ul class="menu vertical">
        <li class="menu-text"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Social Account'), ['action' => 'edit', $socialAccount->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Social Account'), ['action' => 'delete', $socialAccount->id], ['confirm' => __('Are you sure you want to delete # {0}?', $socialAccount->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Social Accounts'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Social Account'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="socialAccounts view small-9 medium-10 large-10 columns content">
    <h3><?= h($socialAccount->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= h($socialAccount->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $socialAccount->has('user') ? $this->Html->link($socialAccount->user->id, ['controller' => 'Users', 'action' => 'view', $socialAccount->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Provider') ?></th>
            <td><?= h($socialAccount->provider) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Username') ?></th>
            <td><?= h($socialAccount->username) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Reference') ?></th>
            <td><?= h($socialAccount->reference) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Avatar') ?></th>
            <td><?= h($socialAccount->avatar) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Link') ?></th>
            <td><?= h($socialAccount->link) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Token') ?></th>
            <td><?= h($socialAccount->token) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Token Secret') ?></th>
            <td><?= h($socialAccount->token_secret) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Token Expires') ?></th>
            <td><?= h($socialAccount->token_expires) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($socialAccount->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($socialAccount->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Active') ?></th>
            <td><?= $socialAccount->active ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($socialAccount->description)); ?>
    </div>
    <div class="row">
        <h4><?= __('Data') ?></h4>
        <?= $this->Text->autoParagraph(h($socialAccount->data)); ?>
    </div>
</div>
