<div class="column small-12">
    <h3 class="collapseable"><?= __('Import') ?></h3>
    <div class="row">
        <div class="column small-12">
            <?= $this->Form->create(
                'Import',
                [
                    'url' => ['action' => 'import'],
                    'id' => 'importForm',
                    'type' => 'file'
                ]
            ) ?>
            <?php if(!$this->request->getData()) : ?>
                <?= $this->Form->file('File'); ?>
            <?php endif; ?>
        </div>
    </div>

    <?php if ($this->request->getData('File')) : ?>
    <div class="row">
        <div class="column small-12">
            <?= $this->Form->control(
                'name',
                [
                    'label' => __('Product'),
                    'required' => true,
                    'options' => $columns,
                    'empty' => __('--- choose ---')
                ]
            ) ?>
            <?= $this->Form->control(
                    'size',
                [
                    'label' => __('Size'),
                    'options' => $columns,
                    'empty' => __('--- choose ---')
                ]
                ) ?>
            <?= $this->Form->control(
                    'vat',
                [
                    'label' => __('VAT'),
                    'options' => $columns,
                    'empty' => __('--- choose ---')
                ]
                ) ?>
            <?= $this->Form->control(
                    'quantity',
                [
                    'label' => __('Quantity'),
                    'options' => $columns,
                    'empty' => __('--- choose ---')
                ]
                ) ?>
            <?= $this->Form->control(
                    'price',
                [
                    'label' => __('Price'),
                    'required' => true,
                    'options' => $columns,
                    'empty' => __('--- choose ---')
                ]
                ) ?>
        </div>
    </div>
    <?php endif; ?>

    <div class="row">
        <?= $this->Form->submit(__('Submit'), ['class' => 'button']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
