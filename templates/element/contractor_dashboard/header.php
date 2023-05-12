<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>CLMS | Dashboard</title>

    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- Morris -->
    <link href="/css/plugins/morris/morris-0.4.3.min.css" rel="stylesheet">

    <link href="/css/animate.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <?php echo $this->Html->meta('csrfToken', $this->request->getAttribute('csrfToken')); ?>
</head>

<body>