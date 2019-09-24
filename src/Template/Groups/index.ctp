<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="small-3 medium-2 large-2 columns" id="actions-sidebar">
    <ul class="menu vertical">
        <li class="menu-text"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Group'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Partners'), ['controller' => 'Partners', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Partner'), ['controller' => 'Partners', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="groups index small-9 medium-10 large-10 columns content">
    <h3><?= __('Groups') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('percentage') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($groups as $group): ?>
            <tr>
                <td><?= $this->Number->format($group->id) ?></td>
                <td><?= h($group->name) ?></td>
                <td><?= $this->Number->format($group->percentage) ?></td>
                <td class="actions">
                    <?= $this->Html->link('<i class="fi-eye" title="' . __('View') . '"></i>', ['action' => 'view', $group->id], ['escape' => false]) ?>
                    <?= $this->Html->link('<i class="fi-pencil" title="' . __('Edit') . '"></i>', ['action' => 'edit', $group->id], ['escape' => false]) ?>
                    <?= $this->Form->postLink('<i class="fi-x" title="' . __('Delete') . '"></i>', ['action' => 'delete', $group->id],
                    ['escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?', $group->id)]) ?>
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
