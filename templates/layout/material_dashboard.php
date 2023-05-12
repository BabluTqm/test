<?= $this->element('/material_dashboard/header'); ?>
<?= $this->element('/material_dashboard/sidebar'); ?>
<?= $this->element('/material_dashboard/navbar'); ?>
<?= $this->Flash->render() ?>
<?= $this->fetch('content') ?>
<?= $this->element('/material_dashboard/footer'); ?>