<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('foundation.min.css') ?>
    <?= $this->Html->css('foundation-icons.css') ?>

    <?= $this->Html->css("https://fonts.googleapis.com/css?family=Quicksand") ?>
    <?= $this->Html->css('stock.min.css') ?>

    <?= $this->Html->css('print', ['media' => 'print']) ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>

    <?= $this->Html->script('vendor/vue.js') ?>
    <?= $this->Html->script('vendor/httpVueLoader.js') ?>
</head>
<body>

<?= $this->element('header') ?>

<?= $this->Flash->render() ?>
<main class="container clearfix row">
    <?= $this->fetch('content') ?>
</main>
<footer>
</footer>
<?= $this->Html->script('vendor/jquery.js') ?>
<?= $this->Html->script('vendor/what-input.js') ?>
<?= $this->Html->script('vendor/foundation.js') ?>
<?= $this->Html->script('stock.min') ?>
<?= $this->fetch('script') ?>
</body>
</html>