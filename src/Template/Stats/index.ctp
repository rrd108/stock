<div class="small-12 columns content">
    <h3><?= __('Stats') ?></h3>
    <dl>
        <dt><?= __('Sells') ?></dt>
            <dd class="out text-right"><?= $this->Number->format($totals['sells'], ['precision' => 2]) ?> HUF</dd>
        <dt><?= __('Purchases') ?></dt>
            <dd class="in text-right"><?= $this->Number->format($totals['purchases'], ['precision' => 2]) ?> HUF</dd>
        <dt><?= __('Partners') ?></dt><dd><?= $partners ?></dd>
        <dt><?= __('Invoices') ?></dt><dd><?= $invoices ?></dd>
        <dt><?= __('Products') ?></dt><dd><?= $products ?></dd>
    </dl>
</div>
