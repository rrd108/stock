<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="small-3 medium-2 large-2 columns" id="actions-sidebar">
    <ul class="menu vertical">
        <li class="menu-text"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Invoice'), ['action' => 'add']) ?></li>
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
<div class="invoices index small-9 medium-10 large-10 columns content">
    <h3><?= __('Invoices') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('storage_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('invoicetype_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('partner_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('sale') ?></th>
                <th scope="col"><?= $this->Paginator->sort('number') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($invoices as $invoice): ?>
            <tr>
                <td><?= $this->Number->format($invoice->id) ?></td>
                <td><?= $invoice->has('storage') ? $this->Html->link($invoice->storage->name, ['controller' => 'Storages', 'action' => 'view', $invoice->storage->id]) : '' ?></td>
                <td><?= $invoice->has('invoicetype') ? $this->Html->link($invoice->invoicetype->name, ['controller' => 'Invoicetypes', 'action' => 'view', $invoice->invoicetype->id]) : '' ?></td>
                <td><?= $invoice->has('partner') ? $this->Html->link($invoice->partner->name, ['controller' => 'Partners', 'action' => 'view', $invoice->partner->id]) : '' ?></td>
                <td><?= h($invoice->date) ?></td>
                <td><?= h($invoice->sale) ?></td>
                <td><?= h($invoice->number) ?></td>
                <td class="actions">
                    <?= $this->Html->link('<i class="fi-eye" title="' . __('View') . '"></i>', ['action' => 'view', $invoice->id], ['escape' => false]) ?>
                    <?= $this->Html->link('<i class="fi-pencil" title="' . __('Edit') . '"></i>', ['action' => 'edit', $invoice->id], ['escape' => false]) ?>
                    <?= $this->Form->postLink('<i class="fi-x" title="' . __('Delete') . '"></i>', ['action' => 'delete', $invoice->id],
                    ['escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?', $invoice->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination text-center">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p class="text-center"><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
