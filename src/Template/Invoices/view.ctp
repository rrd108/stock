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
            <td>
                <?php if (strpos($invoice->number, '|')) : ?>
                    <?php $num = explode('|', $invoice->number); ?>
                    <?= $num[1] . ' ' . $this->Html->link('<i class="fi-page-pdf"></i>', $num[2], ['escape' => false]) ?>
                <?php else : ?>
                    <?= h($invoice->number) ?>
                        <?= $this->Html->link(__('Billingo'), ['controller' => 'Invoices', 'action' => 'billingo', $invoice->id]) ?>
                <?php endif; ?>
            </td>
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
        <?php if (!empty($invoice->items)): ?>
        <table cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    <th scope="col"><?= __('Product') ?></th>
                    <th scope="col"><?= __('Quantity') ?></th>
                    <th scope="col"><?= __('Price') ?></th>
                    <th scope="col"><?= __('Currency') ?></th>
                    <th scope="col"><?= __('Amount') ?></th>
                    <th scope="col"><?= __('VAT') ?></th>
                    <th scope="col"><?= __('VAT') ?></th>
                    <th scope="col"><?= __('Amount') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($invoice->items as $item): ?>
                <tr>
                    <td><?= h($item->product->name) ?></td>
                    <td><?= h($item->quantity) ?></td>
                    <td><?= $this->Number->format($item->price) ?></td>
                    <td><?= h($item->currency) ?></td>
                    <td><?= $this->Number->format($item->price * $item->quantity) ?></td>
                    <td><?= h($item->product->vat) ?> %</td>
                    <td><?= $this->Number->format($item->product->vat * $item->price * $item->quantity / 100) ?></td>
                    <td><?= $this->Number->format($item->price * $item->quantity * (1 + $item->product->vat / 100)) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td><?= __('Total') ?></td>
                    <td><?= collection($invoice->items)->sumOf('quantity') ?></td>
                    <td></td>
                    <td></td>
                    <td><?= $this->Number->format(collection($invoice->items)->sumOf(function ($item) {
                        return $item->price * $item->quantity;
                    })) ?></td>
                    <td></td>
                    <td><?= $this->Number->format(collection($invoice->items)->sumOf(function ($item) {
                        return $item->price * $item->quantity * $item->product->vat / 100;
                    })) ?></td>
                    <td><?= $this->Number->format(collection($invoice->items)->sumOf(function ($item) {
                        return $item->price * $item->quantity * (1 + $item->product->vat / 100);
                    })) ?></td>
                </tr>
            </tfoot>
        </table>
        <?php endif; ?>
    </div>
</div>
