<?php
$images = array(
  array('file'    => 'kinkakuji',
        'caption' => 'The Golden Pavilion in Kyoto'),
  array('file'    => 'maiko',
        'caption' => 'Maiko&#8212;trainee geishas in Kyoto'),
  array('file'    => 'maiko_phone',
        'caption' => 'Every maiko should have one&#8212;a mobile, of course'),
  array('file'    => 'monk',
        'caption' => 'Monk begging for alms in Kyoto'),
  array('file'    => 'fountains',
        'caption' => 'Fountains in central Tokyo'),
  array('file'    => 'ryoanji',
        'caption' => 'Autumn leaves at Ryoanji temple, Kyoto'),
  array('file'    => 'menu',
        'caption' => 'Menu outside restaurant in Pontocho, Kyoto'),
  array('file'    => 'basin',
        'caption' => 'Water basin at Ryoanji temple, Kyoto')
  );
$i = rand(0, count($images)-1);
$selectedImage = "images/{$images[$i]['file']}.jpg";
$caption = $images[$i]['caption'];
if (file_exists($selectedImage) && is_readable($selectedImage)) {
  $imageSize = getimagesize($selectedImage);
}
