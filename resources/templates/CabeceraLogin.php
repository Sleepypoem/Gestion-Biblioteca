<?php
/* ***************************************************************** Dependencias ***************************************************************** */
include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";
/* ************************************************************************************************************************************************ */

?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="https://iconarchive.com/download/i75808/martz90/circle/books.ico">
        <!--Bootstrap 5 CSS only -->
        <link href="<?php echo $config["urls"]["baseUrl"] . "/public_html/css/bootstrap.css"; ?>"
            rel="stylesheet">
        <!-- Para las tablas -->
        <link rel="stylesheet" type="text/css"
            href="https://cdn.datatables.net/v/bs5/dt-1.12.1/b-2.2.3/cr-1.5.6/date-1.1.2/fc-4.1.0/fh-3.2.4/kt-2.7.0/r-2.3.0/rg-1.2.0/rr-1.2.8/sc-2.0.7/sb-1.3.4/sp-2.0.2/sl-1.4.0/sr-1.1.1/datatables.min.css" />

        <!-- Bootstrap icons -->
        <link rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">

        <title>Gestion de Biblioteca</title>
        <link rel="stylesheet"
            href="<?php echo $config["urls"]["baseUrl"] . "/public_html/css/customStyleSheet.css"; ?>">

    </head>