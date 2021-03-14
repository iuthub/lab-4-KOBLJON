<?php

if (isset($_REQUEST['playlist'])) {
    $req = "songs/".$_REQUEST['playlist'];
    $files = file($req);

    foreach($files as $key => $value){
        $files[$key] = "songs/".$value;
    }

}else{
    $files = array_merge(glob("songs/*.mp3"), glob("songs/*.txt"));
}

if (isset($_REQUEST['shuffle'])) {
    if($_REQUEST['shuffle'] == "on"){
        shuffle($files);
    }
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
    "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Music Viewer</title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <link href="viewer.css" type="text/css" rel="stylesheet" />
</head>
<body>
<div id="header">

    <h1>190M Music Playlist Viewer</h1>
    <h2>Search Through Your Playlists and Music</h2>
    <div>
        <ul class="nav">
            <li><a href="/webpage/music.php">Home</a></li>
            <li><a href="music.php?shuffle=on">Shuffle</a></li>
        </ul>
    </div>
</div>
<div id="listarea">
    <ul id="musiclist">
        <?php
        foreach ($files as $file){

            $pathinfo = pathinfo(trim($file));

            $fSize = fileSize(trim($file))."b";

            //  var_dump($fSize);
            if($fSize > 1023){
                $fSize = round($fSize / 1024 / 1024, 1);
                $fSize = $fSize."mb";
            }



            if($pathinfo["extension"] == "mp3"){
                echo'
              <li class="mp3item">
                <a href="'.$file.'">'.$pathinfo["basename"].'</a> ('.$fSize.')
              </li>';
            }elseif ($pathinfo["extension"] == "txt"){
                echo'
              <li class="playlistitem">
                <a href="music.php?playlist='.$pathinfo["basename"].'">'.$pathinfo["basename"].' </a>
              </li>';
            }
        }
        ?>
    </ul>
</div>
</body>
</html>