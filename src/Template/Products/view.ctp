<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="small-3 medium-2 large-2 columns" id="actions-sidebar">
    <ul class="menu vertical">
        <li class="menu-text"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Product'), ['action' => 'edit', $product->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Product'), ['action' => 'delete', $product->id], ['confirm' => __('Are you sure you want to delete # {0}?', $product->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Products'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Product'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Companies'), ['controller' => 'Companies', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Company'), ['controller' => 'Companies', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Items'), ['controller' => 'Items', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Item'), ['controller' => 'Items', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="products view small-9 medium-10 large-10 columns content">
    <h3><?= h($product->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Company') ?></th>
            <td><?= $product->has('company') ? $this->Html->link($product->company->name, ['controller' => 'Companies', 'action' => 'view', $product->company->id]) : '' ?></td>
            <th scope="row"><?= __('Vat') ?></th>
            <td><?= $this->Number->format($product->vat) ?> %</td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($product->name) ?></td>
            <th scope="row"><?= __('Size') ?></th>
            <td><?= h($product->size) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Profit') ?></th>
            <td class="text-right">
                <?= $this->Number->format(
                    Collection($product->items)->sumOf(function ($item) {
                        return $item->invoice->sale ? $item->price * $item->quantity : -1 * $item->price * $item->quantity;
                    }), ['precision' => 2]) ?>
            </td>
            <th scope="row"><?= __('Stock value') ?></th>
            <td class="text-right">
                <?= $this->Number->format(
                    Collection($product->items)->sumOf(function ($item) use ($product) {
                        return $item->invoice->sale ? -1 * $item->quantity * $product->lastPurchasePrice : $item->quantity * $product->lastPurchasePrice;
                    }), ['precision' => 2]) ?>
            </td>
        </tr>
        <tr>
            <th scope="row"><?= __('Stock') ?></th>
            <td class="text-right">
                <?= Collection($product->items)->sumOf(function ($item) {
                        return $item->invoice->sale ? -1 * $item->quantity : $item->quantity;
                    }) ?>
            </td>
            <th scope="row"><?= __('Stock value') ?></th>
            <td class="text-right">
                <?= $this->Number->format(
                    Collection($product->items)->sumOf(function ($item) use ($product) {
                        return $item->invoice->sale ? -1 * $item->quantity * $product->avaragePurchasePrice : $item->quantity * $product->avaragePurchasePrice;
                    }), ['precision' => 2]) ?>
            </td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Invoices') ?></h4>
        <?php if (!empty($product->items)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Direction') ?></th>
                <th scope="col"><?= __('Invoice') ?></th>
                <th scope="col"><?= __('Date') ?></th>
                <th scope="col"><?= __('Partner') ?></th>
                <th scope="col"><?= __('Storage') ?></th>
                <th scope="col"><?= __('Quantity') ?></th>
                <th scope="col"><?= __('Price') ?></th>
                <th scope="col"><?= __('Amount') ?></th>
            </tr>
            <?php foreach ($product->items as $item): ?>
            <tr class="<?= $item->invoice->sale ? 'out' : 'in' ?>">
                <td>
                    <?= $this->Html->link($item->invoice->sale ? '<i class="fi-arrow-left"></i>' : '<i class="fi-arrow-right"></i>', ['controller' => 'invoices', 'action' => 'view', $item->invoice->id], ['escape' => false]) ?>
                </td>
                <td>
                    <?php if (strpos($item->invoice->number, '|')) : ?>
                        <?php $num = explode('|', $item->invoice->number); ?>
                        <?= $this->Html->link('<i class="fi-page-pdf"></i>', $num[2], ['escape' => false])
                            . ' ' . $num[1] ?>
                    <?php else : ?>
                        <?= str_replace('|', '<br>', h($item->invoice->number)) ?>
                    <?php endif; ?>
                </td>
                <td><?= h($item->invoice->date) ?></td>
                <td><?= h($item->invoice->partner->name) ?></td>
                <td><?= h($item->invoice->storage->name) ?></td>
                <td class="text-right"><?= $item->invoice->sale ? h(-1 * $item->quantity) : h($item->quantity) ?></td>
                <td><?= $this->Number->format($item->price, ['precision' => 2]) ?> <?= h($item->invoice->currency) ?></td>
                <td><?= $this->Number->format($item->price * ($item->invoice->sale ? $item->quantity : -1 * $item->quantity), ['precision' => 2]) ?> <?= h($item->invoice->currency) ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
