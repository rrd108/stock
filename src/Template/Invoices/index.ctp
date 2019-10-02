<div class="invoices index small-12 columns content">
    <div class="row">
        <div class="column small-6">
            <h3><?= __('Invoices') ?></h3>
        </div>
        <div class="column small-6 text-right">
            <?= $this->Html->link('<i class="fi-plus" title="' . __('New') . '"> ' . __('New Invoice') . '</i>', ['action' => 'add'], ['class' => 'button', 'escape' => false]) ?>
        </div>
    </div>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('sale') ?></th>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('number') ?></th>
                <th scope="col"><?= $this->Paginator->sort('date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('partner_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('storage_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('invoicetype_id') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($invoices as $invoice): ?>
            <tr class="<?= $invoice->sale ? 'out' : 'in' ?>">
                <td>
                    <?= $this->Html->link($invoice->sale ? '<i class="fi-arrow-left"></i>' : '<i class="fi-arrow-right"></i>', ['action' => 'view', $invoice->id], ['escape' => false]) ?>
                </td>
                <td><?= $this->Number->format($invoice->id) ?></td>
                <td><?= str_replace('|', '<br>', h($invoice->number)) ?></td>
                <td><?= h($invoice->date) ?></td>
                <td><?= '<i class="fi-torsos"> ' . $invoice->partner->name . '</i>' ?></td>
                <td><?= '<i class="fi-contrast"> ' .  $invoice->storage->name . '</i>' ?></td>
                <td><?= '<i class="fi-book"> ' . $invoice->invoicetype->name . '</i>' ?></td>
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
