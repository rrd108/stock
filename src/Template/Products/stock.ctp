<?= $this->Html->script('stock.stock', ['block' => true]) ?>
<div class="small-12 columns content">
    <h3><?= __('Products') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('name') ?> ({{searchResultsCount}} <?= __('products') ?>)</th>
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
                            'autocomplete' => 'off',
                            'v-model' => 'searchQuery',
                            'placeholder' => __('Search')
                        ]) ?>
                </td>
                <td class="text-right">
                    {{products.reduce((sum, product) =>
                        sum + (product.hidden ? 0 : parseInt(product.stock))
                        , 0) | toNum(0)
                    }}
                    <?= __('pcs') ?>
                </td>
                <td class="text-right">{{products.reduce((sum, product) => sum + (product.hidden ? 0 : parseInt(product.stock * product.avaragePurchasePrice)) , 0)  | toCurrency}}</td>
                <td class="text-right">{{products.reduce((sum, product) => sum + (product.hidden ? 0 : parseInt(product.stock * product.lastPurchasePrice)) , 0) | toCurrency}}</td>
            </tr>
        </thead>
        <tbody>
            <tr v-for="product in products" :key="product.id" v-show="!product.hidden">
                <td><a :href="'view/' + product.id">{{product.name}}</a></td>
                <td>{{product.code}}</td>
                <td>{{product.size}}</td>
                <td class="text-right">{{product.stock | toNum(0)}}</td>
                <td class="text-right">{{product.avaragePurchasePrice | toCurrency}}</td>
                <td class="text-right">{{product.lastPurchasePrice | toCurrency}}</td>
                <td class="text-right">{{product.stock * product.avaragePurchasePrice | toCurrency}}</td>
                <td class="text-right">{{product.stock * product.lastPurchasePrice | toCurrency}}</td>
            </tr>
        </tbody>
    </table>
</div>
