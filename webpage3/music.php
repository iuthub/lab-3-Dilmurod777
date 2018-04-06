<?php 
		include('functions.php');

		$files = array();

		if(isset($_REQUEST['playlist'])){
			if(file_exists("songs/".$_REQUEST['playlist'])){
				$songs = file("songs/".$_REQUEST['playlist']);
				foreach($songs as $song){
					if(trim($song)[0]!='#'){
						$files[trim($song)] = filesize("songs/".trim($song));
					}
				}
			}else{
				print("<h1>"."Such File Does Not Exist"."</h1>");
			}
		}else{
			$songs = glob("songs/*.mp3");
			foreach($songs as $song){
				$files[trim($song)] = filesize(trim($song));
			}
		}
		$playlist = glob("songs/*.m3u");

		if(isset($_REQUEST['shuffle']) && $_REQUEST['shuffle']=="on" && isset($_REQUEST['bysize']) && $_REQUEST['bysize']=="on"){
			print("<h1>"."You cannot Shuffle and Sort by Size at the same time"."</h1>");
		}else if(isset($_REQUEST['shuffle']) && $_REQUEST['shuffle']=="on"){
			$files = shuffle_files($files);
		}else if(isset($_REQUEST['bysize']) && $_REQUEST['bysize']=="on"){
			arsort($files);
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

		<a href="music.php">List All Songs</a>

		<div id="header">	
			<h1>190M Music Playlist Viewer</h1>
			<h2>Search Through Your Playlists and Music</h2>
		</div>

		<div id="listarea">
			<ul id="musiclist">

				<?php foreach($files as $song=>$size){ ?>
					<li class="mp3item">
						<a href="<?=$file?>"><?=basename($song);?></a>
						(<?=getFormatedSize($size);?>)
					</li>
				<?php } ?>

				<?php foreach($playlist as $file){ ?>
					<li class="playlistitem">
						<a href="music.php?playlist=<?=basename($file)?>"><?=basename($file);?></a>
					</li>
				<?php } ?>
			</ul>
		</div>
	</body>
</html>
