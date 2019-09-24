<div class="small-12 columns content">
    <h3><?= __('Products') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('company_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('size') ?></th>
                <th scope="col"><?= __('Quantity') ?></th>
                <th scope="col"><?= $this->Paginator->sort('cost') ?></th>
                <th scope="col"><?= __('Income') ?></th>
                <th scope="col"><?= $this->Paginator->sort('currency') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
            <tr>
                <td><?= $product->has('company') ? $this->Html->link($product->company->name, ['controller' => 'Companies', 'action' => 'view', $product->company->id]) : '' ?></td>
                <td><?= h($product->name) ?></td>
                <td><?= h($product->size) ?></td>
                <td></td>
                <td><?= $this->Number->format($product->cost) ?></td>
                <td></td>
                <td><?= h($product->currency) ?></td>
                <td class="actions">
                    <?= $this->Html->link('<i class="fi-eye" title="' . __('View') . '"></i>', ['action' => 'view', $product->id], ['escape' => false]) ?>
                    <?= $this->Html->link('<i class="fi-pencil" title="' . __('Edit') . '"></i>', ['action' => 'edit', $product->id], ['escape' => false]) ?>
                    <?= $this->Form->postLink('<i class="fi-x" title="' . __('Delete') . '"></i>', ['action' => 'delete', $product->id],
                    ['escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?', $product->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
