<div class="partners view small-12 columns content">
    <h3><?= h($partner->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Company') ?></th>
            <td><?= $partner->has('company') ? $this->Html->link($partner->company->name, ['controller' => 'Companies', 'action' => 'view', $partner->company->id]) : '' ?></td>
            <th scope="row"><?= __('Group') ?></th>
            <td><?= $partner->has('group') ? $this->Html->link($partner->group->name, ['controller' => 'Groups', 'action' => 'view', $partner->group->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($partner->name) ?></td>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($partner->email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Zip') ?></th>
            <td><?= h($partner->zip) ?></td>
            <th scope="row"><?= __('City') ?></th>
            <td><?= h($partner->city) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Address') ?></th>
            <td><?= h($partner->address) ?></td>
            <th scope="row"><?= __('Phone') ?></th>
            <td><?= h($partner->phone) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Invoices') ?></h4>
        <?php if (!empty($partner->invoices)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Direction') ?></th>
                <th scope="col"><?= __('Number') ?></th>
                <th scope="col"><?= __('Date') ?></th>
                <th scope="col"><?= __('Invoicetype') ?></th>
                <th scope="col"><?= __('Amount') ?></th>
            </tr>
            <?php foreach ($partner->invoices as $invoice): ?>
            <tr class="<?= $invoice->sale ? 'out' : 'in' ?>">
                <td>
                    <?= $this->Html->link($invoice->sale ? '<i class="fi-arrow-left"></i>' : '<i class="fi-arrow-right"></i>', ['controller' => 'invoices', 'action' => 'view', $invoice->id], ['escape' => false]) ?>
                </td>
                <td>
                    <?php if (strpos($invoice->number, '|')) : ?>
                        <?php $num = explode('|', $invoice->number); ?>
                        <?= $this->Html->link('<i class="fi-page-pdf"></i>', $num[2], ['escape' => false])
                            . ' ' . $num[1] ?>
                    <?php else : ?>
                        <?= str_replace('|', '<br>', h($invoice->number)) ?>
                    <?php endif; ?>
                </td>
                <td><?= h($invoice->date) ?></td>
                <td><?= h($invoice->invoicetype->name) ?></td>
                <td>
                    <?= $this->Number->format(
                        collection($invoice->items)->sumOf(function ($item) {
                            return $item->quantity * $item->price;
                        }),
                        ['precision' => 2]) ?>
                     <?= $invoice->currency ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
