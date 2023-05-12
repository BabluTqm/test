<?= $this->element('/owner_dashboard/header'); ?>
<?= $this->element('/owner_dashboard/sidebar'); ?>
<?= $this->element('/owner_dashboard/navbar'); ?>
<?= $this->Flash->render() ?>
<?= $this->fetch('content') ?>
<?= $this->element('/owner_dashboard/footer'); ?>