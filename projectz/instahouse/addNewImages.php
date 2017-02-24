<?php

$imgSrcs = $_POST['imgSrcs'];
$cacheLoader = $_POST['cacheName'];
$counter=0;

if(file_exists('cache/'.$cacheLoader.'Cache.txt')){
	
	$current = explode("\n", file_get_contents('cache/'.$cacheLoader.'Cache.txt'));
		
	foreach ($imgSrcs as $src){
		if(!in_array($src,$current)){
			$counter++;
			file_put_contents('cache/'.$cacheLoader.'Cache.txt', rawurldecode($src)."\n",FILE_APPEND);
		}
	}
	
	echo "Added: ".$counter;

}else{
	
	$newFile = fopen('cache/'.$cacheLoader.'Cache.txt', "w") or die("Unable to open file!");
	
	foreach ($imgSrcs as $src){
			$counter++;
			file_put_contents('cache/'.$cacheLoader.'Cache.txt', rawurldecode($src)."\n",FILE_APPEND);
	}
	
	echo "New Cache: ".$cacheLoader.", Added: ".$counter;
	
}



?>