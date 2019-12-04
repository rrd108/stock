<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Invoice $invoice
 */
?>
<nav class="small-3 medium-2 large-2 columns" id="actions-sidebar">
    <ul class="menu vertical">
        <li class="menu-text"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $invoice->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $invoice->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Invoices'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Storages'), ['controller' => 'Storages', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Storage'), ['controller' => 'Storages', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Invoicetypes'), ['controller' => 'Invoicetypes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Invoicetype'), ['controller' => 'Invoicetypes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Partners'), ['controller' => 'Partners', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Partner'), ['controller' => 'Partners', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Items'), ['controller' => 'Items', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Item'), ['controller' => 'Items', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="invoices form small-9 medium-10 large-10 columns content">
    <?= $this->Form->create($invoice) ?>
    <fieldset>
        <legend><?= __('Edit Invoice') ?></legend>
        <?php
            echo $this->Form->control('storage_id', ['options' => $storages]);
            echo $this->Form->control('invoicetype_id', ['options' => $invoicetypes]);
            echo $this->Form->control('partner_id', ['options' => $partners]);
            echo $this->Form->control('date', ['empty' => true]);
            echo $this->Form->control('sale');
            echo $this->Form->control('number');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'), ['class' => 'button']) ?>
    <?= $this->Form->end() ?>
</div>
