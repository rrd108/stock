<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->fetch('title') ?></title>
    <?= $this->Html->css('foundation.min.css', ['fullBase' => true]) ?>
    <?= $this->Html->css('foundation-icons.css', ['fullBase' => true]) ?>

    <?= $this->Html->css("https://fonts.googleapis.com/css?family=Quicksand") ?>
    <?= $this->Html->css('stock.min.css', ['fullBase' => true]) ?>
</head>
<body>

<?= $this->Flash->render() ?>
<main class="container clearfix row">
    <?= $this->fetch('content') ?>
</main>
<footer>
</footer>
</body>
</html>