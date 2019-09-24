<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="small-3 medium-2 large-2 columns" id="actions-sidebar">
    <ul class="menu vertical">
        <li class="menu-text"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Invoicetype'), ['action' => 'edit', $invoicetype->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Invoicetype'), ['action' => 'delete', $invoicetype->id], ['confirm' => __('Are you sure you want to delete # {0}?', $invoicetype->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Invoicetypes'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Invoicetype'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Invoices'), ['controller' => 'Invoices', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Invoice'), ['controller' => 'Invoices', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="invoicetypes view small-9 medium-10 large-10 columns content">
    <h3><?= h($invoicetype->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($invoicetype->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($invoicetype->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Invoices') ?></h4>
        <?php if (!empty($invoicetype->invoices)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Invoicetype Id') ?></th>
                <th scope="col"><?= __('Partner Id') ?></th>
                <th scope="col"><?= __('Invoiced') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($invoicetype->invoices as $invoices): ?>
            <tr>
                <td><?= h($invoices->id) ?></td>
                <td><?= h($invoices->invoicetype_id) ?></td>
                <td><?= h($invoices->partner_id) ?></td>
                <td><?= h($invoices->invoiced) ?></td>
                <td class="actions">
                    <?= $this->Html->link('<i class="fi-eye" title="' . __('View') . '"></i>', ['controller' => 'Invoices', 'action' => 'view', $invoices->id]) ?>
                    <?= $this->Html->link('<i class="fi-pencil" title="' . __('Edit') . '"></i>', ['controller' => 'Invoices', 'action' => 'edit', $invoices->id]) ?>
                    <?= $this->Form->postLink('<i class="fi-x" title="' . __('Delete') . '"></i>', ['controller' => 'Invoices', 'action' => 'delete', $invoices->id], ['confirm' => __('Are you sure you want to delete # {0}?', $invoices->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
