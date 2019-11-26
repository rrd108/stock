<?= $this->Html->script('stock.stock', ['block' => true]) ?>
<div class="small-12 columns content">
    <h3><?= __('Products') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('name') ?> ({{searchResultsCount}})</th>
                <th scope="col" rowspan="2"><?= $this->Paginator->sort('code') ?></th>
                <th scope="col" rowspan="2"><?= $this->Paginator->sort('size') ?></th>
                <th scope="col"><?= __('Stock') ?></th>
                <th scope="col" rowspan="2"><?= __('Avarage purchase price') ?></th>
                <th scope="col" rowspan="2"><?= __('Last purchase price') ?></th>
                <th scope="col"><?= __('Value') ?></th>
                <th scope="col"><?= __('Value') ?></th>
            </tr>
            <tr>
                <td>
                    <?= $this->Form->control('name',
                        [
                            'label' => false,
                            'v-model' => 'searchQuery',
                            'placeholder' => __('Search')
                        ]) ?>
                </td>
                <td class="text-right"><?= $this->Number->format($products->sumOf('stock')) ?> <?= __('pcs') ?></td>
                <td class="text-right">
                    <?= $this->Number->currency($products->sumOf(function ($product) {
    return $product->stock * $product->avaragePurchasePrice;
}), null, ['precision' => $this->precision]) ?>
                </td>
                <td class="text-right">
                    <?= $this->Number->currency($products->sumOf(function ($product) {
    return $product->stock * $product->lastPurchasePrice;
}), null, ['precision' => $this->precision]) ?>
                </td>
            </tr>
        </thead>
        <tbody>
            <tr v-for="product in products" :key="product.id" v-show="!product.hidden">
                <td><a :href="'view/' + product.id">{{product.name}}</a></td>
                <td>{{product.code}}</td>
                <td>{{product.size}}</td>
                <td class="text-right">{{product.stock | toInt}}</td>
                <td class="text-right">{{product.avaragePurchasePrice | toCurrency}}</td>
                <td class="text-right">{{product.lastPurchasePrice | toCurrency}}</td>
                <td class="text-right">{{product.stock * product.avaragePurchasePrice | toCurrency}}</td>
                <td class="text-right">{{product.stock * product.lastPurchasePrice | toCurrency}}</td>
            </tr>
        </tbody>
    </table>
</div>
