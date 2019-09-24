<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="small-3 medium-2 large-2 columns" id="actions-sidebar">
    <ul class="menu vertical">
        <li class="menu-text"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Cake D C Users Phinxlog'), ['action' => 'edit', $cakeDCUsersPhinxlog->version]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Cake D C Users Phinxlog'), ['action' => 'delete', $cakeDCUsersPhinxlog->version], ['confirm' => __('Are you sure you want to delete # {0}?', $cakeDCUsersPhinxlog->version)]) ?> </li>
        <li><?= $this->Html->link(__('List Cake D C Users Phinxlog'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Cake D C Users Phinxlog'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="cakeDCUsersPhinxlog view small-9 medium-10 large-10 columns content">
    <h3><?= h($cakeDCUsersPhinxlog->version) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Migration Name') ?></th>
            <td><?= h($cakeDCUsersPhinxlog->migration_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Version') ?></th>
            <td><?= $this->Number->format($cakeDCUsersPhinxlog->version) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Start Time') ?></th>
            <td><?= h($cakeDCUsersPhinxlog->start_time) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('End Time') ?></th>
            <td><?= h($cakeDCUsersPhinxlog->end_time) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Breakpoint') ?></th>
            <td><?= $cakeDCUsersPhinxlog->breakpoint ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
