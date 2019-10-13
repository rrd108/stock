<?= $this->Html->scriptStart(['block' => true]) ?>
    var products = [];
    <?php foreach ($products as $product) : ?>
        products[<?= $product->id ?>] = ["<?= implode('","', $product->toArray()) ?>"];
    <?php endforeach; ?>
    var partners = [];
    <?php foreach ($partners as $partner) : ?>
        partners[<?= $partner->id ?>] = "<?= $partner->group->percentage ?>";
    <?php endforeach; ?>
<?= $this->Html->scriptEnd() ?>

<?= $this->Html->script('vendor/jquery.hotkeys.min', ['block' => true]) ?>
<?= $this->Html->script('stock.add', ['block' => true]) ?>

<div class="invoices form small-12 columns content">
    <?= $this->Form->create($invoice) ?>
    <fieldset>
        <h3><i class="fi-plus"></i> <?= __('Add Invoice') ?></h3>
        <div class="row">
            <div class="column small-6">
                <?php if ($storages->count() === 1) : ?>
                    <?= $this->Form->control('storage_id', ['options' => $storages]) ?>
                <?php else : ?>
                    <?= $this->Form->control('storage_id', ['options' => $storages, 'empty' => __('--- choose ---')]) ?>
                <?php endif; ?>
            </div>
            <div class="column small-6">
                <?= $this->Form->control('invoicetype_id', ['options' => $invoicetypes, 'empty' => __('--- choose ---')]) ?>
            </div>
        </div>
        <div class="row">
            <div class="column small-6">
                <?= $this->Form->control(
                    'partner_id',
                    ['type' => 'datalistJs', 'options' => $partners->combine('id', 'name')]
                    ) ?>
            </div>
            <div class="column small-6">
                <?= $this->Form->control('date', ['type' => 'text', 'value' => date('Y-m-d')]) ?>
            </div>
        </div>
        <div class="row">
            <div class="column small-6">
                <?= $this->Form->control('number', ['value' => time()]) ?>
            </div>
            <div class="column small-3">
                <?= $this->Form->control('currency') ?>
            </div>
            <div class="column small-3 sale out">
                <?= $this->Form->control('sale', ['label' => '<span>' . __('Sale') . '</span>', 'escape' => false]) ?>
            </div>
        </div>
    </fieldset>

    <fieldset id="items" disabled>
        <table cellpadding="0" cellspacing="0">
            <thead>
                <tr class="out">
                    <th class="text-center" scope="col"><?= __('Product') ?></th>
                    <th class="text-center" scope="col"><?= __('Stock') ?></th>
                    <th class="text-center" scope="col"><?= __('Quantity') ?></th>
                    <th class="text-center" scope="col"><?= __('Purchase price') ?></th>
                    <th class="text-center" scope="col"><?= __('Selling price') ?></th>
                    <th class="text-center" scope="col"><?= __('Price') ?></th>
                    <th class="text-center" scope="col"><?= __('Amount') ?></th>
                    <th class="text-center" scope="col"><?= __('VAT') ?></th>
                    <th class="text-center" scope="col"><?= __('VAT') ?></th>
                    <th class="text-center" scope="col"><?= __('Gross Amount') ?></th>
                    <?php foreach ($groups as $group) : ?>
                        <th class="text-center group" scope="col"><?= $group->name ?></th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <?= $this->Form->control(
                            'items.0.product_id',
                            [
                                'label' => false,
                                'type' => 'datalistJs',
                                'options' => $products->combine('id', 'name')
                            ]
                            ) ?>
                    </td>
                    <td class="text-right">0</td>
                    <td class="text-right"><?= $this->Form->control('items.0.quantity', ['label' => false, 'class' => 'quantity']) ?></td>
                    <td class="text-right">0</td>
                    <td class="text-right">0</td>
                    <?php // read last price from DB if it is different than the default ?>
                    <td><?= $this->Form->control('items.0.price', ['label' => false, 'class' => 'net price text-right']) ?></td>
                    <td class="text-right">0</td>
                    <td class="text-right">0</td>
                    <td class="text-right">0</td>
                    <td class="text-right">0</td>
                    <?php foreach ($groups as $i => $group) : ?>
                        <td class="text-right group">
                            <?= $this->Form->control(
                                'items.0.selling_price.' . $i . '.group_id',
                            ['type' => 'hidden', 'value' => $group->id]
                            ) ?>
                            <?= $this->Form->control(
                                'items.0.selling_price.' . $i . '.price',
                            [
                                'label' => false,
                                'type' => 'text',
                                'class' => 'price',
                                'data-percentage' => $group->percentage
                            ]
                            ) ?>
                        </td>
                    <?php endforeach; ?>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td>
                        <?= $this->Form->button('<i class="fi-plus"> ' . __('New Row') . '</i>', ['class' => 'button', 'id' => 'addNewRow', 'type' => 'button']) ?>
                        <?= $this->Form->button('<i class="fi-check"> ' . __('Save Invoice') . '</i>', ['class' => 'button', 'id' => 'saveInvoice']) ?>
                        <?= $this->Form->end() ?>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="text-right">0</td>
                    <td></td>
                    <td class="text-right">0</td>
                    <td class="text-right">0</td>
                    <?php foreach ($groups as $group) : ?>
                        <td class="group"></td>
                    <?php endforeach; ?>
                </tr>
            </tfoot>
        </table>
    </fieldset>
</div>
