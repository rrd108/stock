<?= $this->Html->script('stock.invoices', ['block' => true]) ?>

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
                <th scope="col"><?= $this->Paginator->sort('number') ?></th>
                <th scope="col"><?= $this->Paginator->sort('date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('partner_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('storage_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('invoicetype_id') ?></th>
                <th scope="col"><?= __('Amount') ?></th>
            </tr>
            <tr>
                <td></td>
                <td><filter-input search="invoices.number" /></td>
                <td><filter-input search="invoices.date" /></td>
                <td><filter-input search="invoices.partnerName" /></td>
                <td><filter-input search="invoices.storageName" /></td>
                <td><filter-input search="invoices.invoiceType" /></td>
                <td></td>
            </tr>
        </thead>
        <tbody is="filtered-tbody" :invoices="invoices" @row-filter="filterRow($event)"></tbody>
    </table>
</div>
