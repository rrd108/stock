<div class="column small-12">
    <h3 class="collapseable">CSV <?= __('Import') ?></h3>
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
            <?php if (!$this->request->getData()) : ?>
                <?= $this->Form->file('File'); ?>
            <?php endif; ?>
        </div>
    </div>

    <?php if ($this->request->getData('File')) : ?>
    <div class="row">
        <div class="column small-12">
            <?= $this->Form->control(
                'storage',
                [
                    'label' => __('Storage'),
                    'required' => true,
                    'options' => $storages,
                    'empty' => __('--- choose ---')
                ]
            ) ?>
            <?= $this->Form->control(
                'partner',
                [
                    'label' => __('Partner'),
                    'required' => true,
                    'options' => $partners,
                    'empty' => __('--- choose ---')
                ]
            ) ?>
            <?= $this->Form->control(
                'date',
                [
                    'label' => __('Date'),
                    'required' => true,
                    'value' => date('Y-m-d'),
                ]
            ) ?>
            <?= $this->Form->control(
                'currency',
                [
                    'label' => __('Currency'),
                    'required' => true,
                    'value' => 'HUF',
                ]
            ) ?>
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
                'code',
                [
                    'label' => __('Code'),
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
                    'required' => true,
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
                    'options' => $columns,
                    'empty' => __('--- choose ---')
                ]
                ) ?>
            <?= $this->Form->control(
                'importZero',
                [
                    'label' => __('Import zero quantity products'),
                    'type' => 'checkbox',
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
