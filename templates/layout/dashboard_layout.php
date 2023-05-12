<?php echo $this->Html->meta('csrfToken', $this->request->getAttribute('csrfToken')); ?>
<?= $this->element('/dashboard/header'); ?>
<?= $this->element('/dashboard/sidebar'); ?>
<?= $this->element('/dashboard/navbar'); ?>
<?= $this->Flash->render() ?>
<?= $this->fetch('content') ?>
<?= $this->element('/dashboard/footer'); ?>
