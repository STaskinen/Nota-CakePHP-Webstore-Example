<h1>Login</h1>
<?= $this->Form->create(); ?>
<?= $this->Form->input('email'); ?>
<?= $this->Form->input('password'); ?>
<?= $this->Form->button('Login', ['class' => 'pure-button']) ?>
<?= $this->Form->end(); ?>
<br>
<?= $this->Html->link(__('Back to the store'), ['controller' => 'Products', 'action' => 'webstore']) ?>