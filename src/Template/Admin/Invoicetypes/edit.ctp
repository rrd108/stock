<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Invoicetype $invoicetype
 */
?>
<nav class="small-3 medium-2 large-2 columns" id="actions-sidebar">
    <ul class="menu vertical">
        <li class="menu-text"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $invoicetype->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $invoicetype->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Invoicetypes'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Invoices'), ['controller' => 'Invoices', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Invoice'), ['controller' => 'Invoices', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="invoicetypes form small-9 medium-10 large-10 columns content">
    <?= $this->Form->create($invoicetype) ?>
    <fieldset>
        <legend><?= __('Edit Invoicetype') ?></legend>
        <?php
            echo $this->Form->control('name');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'), ['class' => 'button']) ?>
    <?= $this->Form->end() ?>
</div>
