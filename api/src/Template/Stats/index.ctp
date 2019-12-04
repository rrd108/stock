<div class="small-12 columns content">
    <h3><?= __('Stats') ?></h3>
    <dl>
        <dt><?= __('Sells') ?></dt>
            <dd class="out text-right"><?= $this->Number->currency($totals['sells'], null, ['precision' => $this->precision]) ?></dd>
        <dt><?= __('Purchases') ?></dt>
            <dd class="in text-right"><?= $this->Number->currency($totals['purchases'], null, ['precision' => $this->precision]) ?></dd>
        <dt><?= __('Stock') ?></dt>
            <dd class="text-right"><?= $this->Number->format($totals['stock']) ?> <?= __('pcs') ?></dd>
        <dt><?= __('Partners') ?></dt><dd><?= $partners ?></dd>
        <dt><?= __('Invoices') ?></dt><dd><?= $invoices ?></dd>
        <dt><?= __('Products') ?></dt><dd><?= $products ?></dd>
    </dl>
</div>
