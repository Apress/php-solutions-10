<?php
$images = array('kinkakuji', 'maiko', 'maiko_phone', 'monk', 'fountains', 'ryoanji', 'menu', 'basin');
$i = rand(0, count($images)-1);
$selectedImage = "images/{$images[$i]}.jpg";
