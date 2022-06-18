<?php

interface IGestor
{
    function comunicarseConBD($sql): array;
}