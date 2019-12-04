<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CakeDCUsersPhinxlog $cakeDCUsersPhinxlog
 */
?>
<nav class="small-3 medium-2 large-2 columns" id="actions-sidebar">
    <ul class="menu vertical">
        <li class="menu-text"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $cakeDCUsersPhinxlog->version],
                ['confirm' => __('Are you sure you want to delete # {0}?', $cakeDCUsersPhinxlog->version)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Cake D C Users Phinxlog'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="cakeDCUsersPhinxlog form small-9 medium-10 large-10 columns content">
    <?= $this->Form->create($cakeDCUsersPhinxlog) ?>
    <fieldset>
        <legend><?= __('Edit Cake D C Users Phinxlog') ?></legend>
        <?php
            echo $this->Form->control('migration_name');
            echo $this->Form->control('start_time');
            echo $this->Form->control('end_time');
            echo $this->Form->control('breakpoint');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'), ['class' => 'button']) ?>
    <?= $this->Form->end() ?>
</div>
