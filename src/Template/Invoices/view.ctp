<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="small-3 medium-2 large-2 columns" id="actions-sidebar">
    <ul class="menu vertical">
        <li class="menu-text"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Invoice'), ['action' => 'edit', $invoice->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Invoice'), ['action' => 'delete', $invoice->id], ['confirm' => __('Are you sure you want to delete # {0}?', $invoice->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Invoices'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Invoice'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Storages'), ['controller' => 'Storages', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Storage'), ['controller' => 'Storages', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Invoicetypes'), ['controller' => 'Invoicetypes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Invoicetype'), ['controller' => 'Invoicetypes', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Partners'), ['controller' => 'Partners', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Partner'), ['controller' => 'Partners', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Items'), ['controller' => 'Items', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Item'), ['controller' => 'Items', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="invoices view small-9 medium-10 large-10 columns content">
    <h3><?= h($invoice->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Storage') ?></th>
            <td><?= $invoice->has('storage') ? $this->Html->link($invoice->storage->name, ['controller' => 'Storages', 'action' => 'view', $invoice->storage->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Invoicetype') ?></th>
            <td><?= $invoice->has('invoicetype') ? $this->Html->link($invoice->invoicetype->name, ['controller' => 'Invoicetypes', 'action' => 'view', $invoice->invoicetype->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Partner') ?></th>
            <td><?= $invoice->has('partner') ? $this->Html->link($invoice->partner->name, ['controller' => 'Partners', 'action' => 'view', $invoice->partner->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Number') ?></th>
            <td><?= h($invoice->number) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($invoice->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Date') ?></th>
            <td><?= h($invoice->date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sale') ?></th>
            <td><?= $invoice->sale ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Items') ?></h4>
        <?php if (!empty($invoice->items)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Invoice Id') ?></th>
                <th scope="col"><?= __('Product Id') ?></th>
                <th scope="col"><?= __('Quantity') ?></th>
                <th scope="col"><?= __('Price') ?></th>
                <th scope="col"><?= __('Currency') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($invoice->items as $items): ?>
            <tr>
                <td><?= h($items->id) ?></td>
                <td><?= h($items->invoice_id) ?></td>
                <td><?= h($items->product_id) ?></td>
                <td><?= h($items->quantity) ?></td>
                <td><?= h($items->price) ?></td>
                <td><?= h($items->currency) ?></td>
                <td class="actions">
                    <?= $this->Html->link('<i class="fi-eye" title="' . __('View') . '"></i>', ['controller' => 'Items', 'action' => 'view', $items->id]) ?>
                    <?= $this->Html->link('<i class="fi-pencil" title="' . __('Edit') . '"></i>', ['controller' => 'Items', 'action' => 'edit', $items->id]) ?>
                    <?= $this->Form->postLink('<i class="fi-x" title="' . __('Delete') . '"></i>', ['controller' => 'Items', 'action' => 'delete', $items->id], ['confirm' => __('Are you sure you want to delete # {0}?', $items->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
