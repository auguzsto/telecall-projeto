<?php

    if(isset($r['id'])) {
        return require __DIR__ ."/edit.php";
    }



    if(isset($r['all'])) {
        return require __DIR__ ."/list.php";
    }

    if(isset($r['name'])) {
        return require __DIR__ ."/search.php";
    }

?>