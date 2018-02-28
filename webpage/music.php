<?php 
		$files = array();

		if(isset($_REQUEST['playlist'])){
			$songs = file("songs/".$_REQUEST['playlist']);
			foreach($songs as $song){
				array_push($files, 'songs/'.trim($song));
			}
		}else{
			$files = glob("songs/*.mp3");
		}
		$playlist = glob("songs/*.txt");

		function getFormatedSize($size_in_bytes)
    {
        if ($size_in_bytes >= 1073741824)
        {
            $size_in_bytes = number_format($size_in_bytes / 1073741824, 2) . ' GB';
        }
        elseif ($size_in_bytes >= 1048576)
        {
            $size_in_bytes = number_format($size_in_bytes / 1048576, 2) . ' MB';
        }
        elseif ($size_in_bytes >= 1024)
        {
            $size_in_bytes = number_format($size_in_bytes / 1024, 2) . ' KB';
        }
        elseif ($size_in_bytes >= 1)
        {
            $size_in_bytes = $size_in_bytes . ' b';
        }
        else
        {
            $size_in_bytes = '0 b';
        }

        return $size_in_bytes;
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
		</div>


		<div id="listarea">
			<ul id="musiclist">

				<?php foreach($files as $file){ ?>
					<li class="mp3item">
						<a href="<?=$file?>"><?=basename($file);?></a>
						(<?=getFormatedSize(filesize($file));?>)
					</li>
				<?php } ?>

				<?php foreach($playlist as $file){ ?>
					<li class="playlistitem">
						<a href="<?=$file?>"><?=basename($file);?></a>
					</li>
				<?php } ?>
			</ul>
		</div>
	</body>
</html>
