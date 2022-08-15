<?php

$test = "";

$res = trim(strrchr($test, "/"), "/");

var_dump($res);