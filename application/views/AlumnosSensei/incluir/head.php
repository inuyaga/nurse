    <!doctype html>
    <html lang="es">
    <head>
    	<meta charset="utf-8" />
    	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    	<link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    	<title>Nurse class</title>

    	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />


        <!-- Bootstrap core CSS     -->
        <link href="<?= base_url('Bootstrap/') ?>/css/bootstrap.min.css" rel="stylesheet" />

        <!-- Animation library for notifications   -->
        <link href="<?= base_url('Bootstrap/') ?>assets/css/animate.min.css" rel="stylesheet"/>

        <!--  Paper Dashboard core CSS    -->
        <link href="<?= base_url('Bootstrap/') ?>assets/css/paper-dashboard.css" rel="stylesheet"/>


        <!--  CSS for Demo Purpose, don't include it in your project     -->
        <link href="<?= base_url('Bootstrap/') ?>assets/css/demo.css" rel="stylesheet" />


        <!--  Fonts and icons     -->
        <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
        <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
        <link href="<?= base_url('Bootstrap/') ?>assets/css/themify-icons.css" rel="stylesheet">

        <!--   Core JS Files   -->
        <!-- <script src="<?= base_url('Bootstrap/') ?>assets/js/jquery-1.10.2.js" type="text/javascript"></script> -->
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="<?= base_url('publico/js/jquery.validate.js') ?>"></script>
      <script src="<?= base_url('Bootstrap/') ?>assets/js/bootstrap.min.js" type="text/javascript"></script>

      <!--  Checkbox, Radio & Switch Plugins -->
      <script src="<?= base_url('Bootstrap/') ?>assets/js/bootstrap-checkbox-radio.js"></script>

      <!--  Charts Plugin -->
      <script src="<?= base_url('Bootstrap/') ?>assets/js/chartist.min.js"></script>

        <!--  Notifications Plugin    -->
        <script src="<?= base_url('Bootstrap/') ?>assets/js/bootstrap-notify.js"></script>

        <!--  Google Maps Plugin    -->
        <script type="<?= base_url('Bootstrap/') ?>text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>

        <!-- Paper Dashboard Core javascript and methods for Demo purpose -->
      <script src="<?= base_url('Bootstrap/') ?>assets/js/paper-dashboard.js"></script>

      <!-- Paper Dashboard DEMO methods, don't include it in your project! -->
      <script src="<?= base_url('Bootstrap/') ?>assets/js/demo.js"></script>



          <script src="<?= base_url('publico/js/alertifyjs/alertify.js') ?>" type="text/javascript"></script>
          <link rel="stylesheet" type="text/css" href="<?= base_url('publico/js/alertifyjs/css/alertify.css') ?>">
          <link rel="stylesheet" type="text/css" href="<?= base_url('publico/js/alertifyjs/css/themes/default.css') ?>">

          <style>
          input[type=text] {
              width: 100%;
              padding: 12px 20px;
              margin: 8px 0;
              box-sizing: border-box;
              border: 3px solid #ccc;
              -webkit-transition: 0.5s;
              transition: 0.5s;
              outline: none;
          }

          input[type=text]:focus {
              border: 3px solid #555;
          }


          input[type=number] {
              width: 100%;
              padding: 12px 20px;
              margin: 8px 0;
              box-sizing: border-box;
              border: 3px solid #ccc;
              -webkit-transition: 0.5s;
              transition: 0.5s;
              outline: none;
          }

          input[type=number]:focus {
              border: 3px solid #555;
          }


          .textoArea {
              width: 100%;
              padding: 12px 20px;
              margin: 8px 0;
              box-sizing: border-box;
              border: 3px solid #ccc;
              -webkit-transition: 0.5s;
              transition: 0.5s;
              outline: none;
          }

          .textoArea:focus {
              border: 3px solid #555;
          }
          </style>

    </head>






    <body>
  <div class="wrapper">
