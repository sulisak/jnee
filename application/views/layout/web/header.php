<!DOCTYPE html>
<html>

<head>
    <!-- add new  -->
    <!-- PWA Manifest & Theme Color -->
    <link rel="manifest" href="<?php echo $base_url; ?>/manifest.webmanifest">
    <meta name="theme-color" content="#007bff">
    <!--  -->
    <!-- Latest compiled and minified CSS & JS -->
    <link rel="stylesheet" href="<?php echo $base_url; ?>/bootstrap/css/bootstrap.min.css" crossorigin="anonymous">
    <script src="<?php echo $base_url; ?>/js/jquery.min.js"></script>
    <script src="<?php echo $base_url; ?>/bootstrap/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <script src="<?php echo $base_url; ?>/js/angular.min.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="<?php echo $base_url; ?>/css/morris.css">
    <script src="<?php echo $base_url; ?>/js/raphael-min.js"></script>
    <script src="<?php echo $base_url; ?>/js/morris.min.js"></script>

    <link rel="stylesheet" href="<?php echo $base_url; ?>/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="<?php echo $base_url; ?>/css/toastr.css">
    <link rel="stylesheet" href="<?php echo $base_url; ?>/css/css.css">
    <script src="<?php echo $base_url; ?>/js/toastr.js"></script>


    <meta name='viewport' content='user-scalable=1' />

    <link href="<?php echo $base_url;?>/pic/iconn.png" rel="shortcut icon" type="image/x-icon" />




    <title>POS SYSTEM</title>
    <!-- add new  -->
    <!-- Register Service Worker for PWA -->
    <script>
    if ('serviceWorker' in navigator) {
        window.addEventListener('load', () => {
            navigator.serviceWorker.register('<?php echo $base_url; ?>/sw.js')
                .then(reg => console.log('ServiceWorker registration successful'))
                .catch(err => console.log('ServiceWorker registration failed: ', err));
        });
    }
    </script>
    <!-- add new  -->

</head>