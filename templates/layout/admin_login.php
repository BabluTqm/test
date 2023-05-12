<?= $this->element('/login/header'); ?>
<?= $this->Flash->render() ?>
<?= $this->fetch('content') ?>
<?= $this->element('/login/footer'); ?>