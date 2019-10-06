<div class="invoices view small-12 columns content">
    <h3><?= $invoice->storage->company->name ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Partner') ?></th>
            <td><?= $invoice->has('partner') ? $this->Html->link($invoice->partner->name, ['controller' => 'Partners', 'action' => 'view', $invoice->partner->id]) : '' ?></td>
            <th scope="row"><?= __('Storage') ?></th>
            <td><?= $invoice->has('storage') ? $this->Html->link($invoice->storage->name, ['controller' => 'Storages', 'action' => 'view', $invoice->storage->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Invoicetype') ?></th>
            <td><?= $invoice->has('invoicetype') ? $this->Html->link($invoice->invoicetype->name, ['controller' => 'Invoicetypes', 'action' => 'view', $invoice->invoicetype->id]) : '' ?></td>
            <th scope="row"><?= __('Date') ?></th>
            <td><?= h($invoice->date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Number') ?></th>
            <td>
                <?php if (strpos($invoice->number, '|')) : ?>
                    <?php $num = explode('|', $invoice->number); ?>
                    <?= $num[1] . ' ' . $this->Html->link('<i class="fi-page-pdf"></i>', $num[2], ['escape' => false]) ?>
                <?php else : ?>
                    <?= h($invoice->number) ?>
                        <?php if ($invoice->partner->group->id != 4) : ?>
                            <?= $this->Html->link('<i class="fi-page-export-pdf"> ' . __('Billingo') . '</i>', ['controller' => 'Invoices', 'action' => 'billingo', $invoice->id], ['escape' => false]) ?>
                        <?php endif; ?>
                <?php endif; ?>
            </td>
            <th scope="row"><?= __('Type') ?></th>
            <td><?= $invoice->sale ? __('Sale') : __('Purchase'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Currency') ?></th>
            <td><?= h($invoice->currency) ?></td>
            <th scope="row"></th>
            <td></td>
        </tr>
    </table>
    <div class="related">
        <?php if (!empty($invoice->items)): ?>
        <table cellpadding="0" cellspacing="0">
            <thead>
                <tr class="<?= $invoice->sale ? 'out' : 'in' ?>">
                    <th class="text-center" scope="col"><?= __('Product') ?></th>
                    <th class="text-center" scope="col"><?= __('Quantity') ?></th>
                    <th class="text-center" scope="col"><?= __('Price') ?></th>
                    <th class="text-center" scope="col"><?= __('Amount') ?></th>
                    <th class="text-center" scope="col"><?= __('VAT') ?></th>
                    <th class="text-center" scope="col"><?= __('VAT') ?></th>
                    <th class="text-center" scope="col"><?= __('Gross Amount') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($invoice->items as $item): ?>
                <tr>
                    <td><?= h($item->product->name) ?></td>
                    <td class="text-right"><?= h($item->quantity) ?></td>
                    <td class="text-right"><?= $this->Number->format($item->price) ?></td>
                    <td class="text-right"><?= $this->Number->format($item->price * $item->quantity, ['precision' => 2]) ?></td>
                    <td class="text-right"><?= h($item->product->vat) ?>%</td>
                    <td class="text-right"><?= $this->Number->format($item->product->vat * $item->price * $item->quantity / 100, ['precision' => 2]) ?></td>
                    <td class="text-right"><?= $this->Number->format($item->price * $item->quantity * (1 + $item->product->vat / 100), ['precision' => 2]) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td><?= __('Total') ?></td>
                    <td class="text-right"><?= collection($invoice->items)->sumOf('quantity') ?></td>
                    <td></td>
                    <td class="text-right"><?= $this->Number->format(collection($invoice->items)->sumOf(function ($item) {
                            return $item->price * $item->quantity;
                        }), ['precision' => 2]) ?></td>
                    <td></td>
                    <td class="text-right"><?= $this->Number->format(collection($invoice->items)->sumOf(function ($item) {
                            return $item->price * $item->quantity * $item->product->vat / 100;
                        }), ['precision' => 2]) ?></td>
                    <td class="text-right"><?= $this->Number->format(collection($invoice->items)->sumOf(function ($item) {
                        return $item->price * $item->quantity * (1 + $item->product->vat / 100);
                    }), ['precision' => 2]) ?></td>
                </tr>
            </tfoot>
        </table>
        <?php endif; ?>
    </div>
</div>
