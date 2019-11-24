<div class="small-12 columns content">
    <h3><?= __('Products') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col" rowspan="2"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col" rowspan="2"><?= $this->Paginator->sort('code') ?></th>
                <th scope="col" rowspan="2"><?= $this->Paginator->sort('size') ?></th>
                <th scope="col"><?= __('Stock') ?></th>
                <th scope="col" rowspan="2"><?= __('Avarage purchase price') ?></th>
                <th scope="col" rowspan="2"><?= __('Last purchase price') ?></th>
                <th scope="col"><?= __('Value') ?></th>
                <th scope="col"><?= __('Value') ?></th>
            </tr>
            <tr>
                <td class="text-right"><?= $this->Number->format($products->sumOf('stock')) ?></td>
                <td class="text-right">
                    <?= $this->Number->format($products->sumOf(function ($product) {
                        return $product->stock * $product->avaragePurchasePrice;
                    })) ?>
                </td>
                <td class="text-right">
                    <?= $this->Number->format($products->sumOf(function ($product) {
                        return $product->stock * $product->lastPurchasePrice;
                    })) ?>
                </td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
            <tr>
                <td><?= $this->Html->link($product->name, ['action' => 'view', $product->id], ['escape' => false]) ?></td>
                <td><?= h($product->code) ?></td>
                <td><?= h($product->size) ?></td>
                <td class="text-right"><?= $this->Number->format($product->stock) ?></td>
                <td class="text-right"><?= $this->Number->format($product->avaragePurchasePrice) ?></td>
                <td class="text-right"><?= $this->Number->format($product->lastPurchasePrice) ?></td>
                <td class="text-right"><?= $this->Number->format($product->stock * $product->avaragePurchasePrice) ?></td>
                <td class="text-right"><?= $this->Number->format($product->stock * $product->lastPurchasePrice) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
