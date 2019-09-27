<div class="companies form small-12 columns content">
    <?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('Company') ?></legend>
        <?= $this->Form->control('company',
            [
                'label' => false,
                'required' => true,
                'options' => $companies,
                'empty' => __('--- choose ---')
            ]
        ) ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'), ['class' => 'button']) ?>
    <?= $this->Form->end() ?>
</div>
