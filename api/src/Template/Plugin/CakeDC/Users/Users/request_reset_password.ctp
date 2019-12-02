<div class="users form">
	<?= $this->Flash->render('auth') ?>
	<?= $this->Form->create('User') ?>
	<fieldset>
		<legend><?= __d('CakeDC/Users', 'Please enter your email to reset your password') ?></legend>
		<?= $this->Form->control('reference') ?>
	</fieldset>
	<?= $this->Form->button(__d('CakeDC/Users', 'Submit'),['id' => 'submit', 'class' => 'button small']); ?>
	<?= $this->Form->end() ?>
</div>