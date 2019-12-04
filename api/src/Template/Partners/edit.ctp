<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Partner $partner
 */
?>
<nav class="small-3 medium-2 large-2 columns" id="actions-sidebar">
    <ul class="menu vertical">
        <li class="menu-text"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $partner->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $partner->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Partners'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Companies'), ['controller' => 'Companies', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Company'), ['controller' => 'Companies', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Groups'), ['controller' => 'Groups', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Group'), ['controller' => 'Groups', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Invoices'), ['controller' => 'Invoices', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Invoice'), ['controller' => 'Invoices', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="partners form small-9 medium-10 large-10 columns content">
    <?= $this->Form->create($partner) ?>
    <fieldset>
        <legend><?= __('Edit Partner') ?></legend>
        <?php
            echo $this->Form->control('company_id', ['options' => $companies]);
            echo $this->Form->control('group_id', ['options' => $groups]);
            echo $this->Form->control('name');
            echo $this->Form->control('zip');
            echo $this->Form->control('city');
            echo $this->Form->control('address');
            echo $this->Form->control('phone');
            echo $this->Form->control('email');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'), ['class' => 'button']) ?>
    <?= $this->Form->end() ?>
</div>
