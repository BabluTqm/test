<?= $this->element('/contractor_dashboard/header'); ?>
<?= $this->element('/contractor_dashboard/sidebar'); ?>
<?= $this->element('/contractor_dashboard/navbar'); ?>
<?= $this->Flash->render() ?>
<?= $this->fetch('content') ?>
<?= $this->element('/contractor_dashboard/footer'); ?>