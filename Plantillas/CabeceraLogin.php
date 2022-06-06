<?php
$url = "http://" . $_SERVER["HTTP_HOST"] . "/public/Gestion Biblioteca/";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://iconarchive.com/download/i75808/martz90/circle/books.ico">
    <!--Bootstrap 5 CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <title>Gestion de Biblioteca | <?php echo obtenerNombrePagina() ?></title>
    <link rel="stylesheet" href="<?php echo $url . "css/customStyleSheet.css"; ?>">


</head>
<br>