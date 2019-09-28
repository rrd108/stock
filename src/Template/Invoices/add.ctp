<fieldset class="invoices form small-12 columns content">
    <?= $this->Form->create($invoice) ?>
    <fieldset>
        <legend><?= __('Add Invoice') ?></legend>
        <div class="row">
            <div class="column small-6">
                <?= $this->Form->control('storage_id', ['options' => $storages]) ?>
            </div>
            <div class="column small-6">
                <?= $this->Form->control('invoicetype_id', ['options' => $invoicetypes]) ?>
            </div>
        </div>
        <div class="row">
            <div class="column small-6">
                <?= $this->Form->control(
            <div class="column small-6">
                <?= $this->Form->control('date', ['type' => 'text']) ?>
            </div>
        </div>
        <div class="row">
            <div class="column small-6">
                <?= $this->Form->control('number') ?>
            </div>
            <div class="column small-3">
                <?= $this->Form->control('sale') ?>
            </div>
            <div class="column small-3">
                <?= $this->Form->button(__('Submit'), ['class' => 'button']) ?>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </fieldset>
</fieldset>
