<?php
	include_once('lib/simple_html_dom.php');
	include_once('lib/curl_querry.php');
	//ini_set('allow_url_fopen','1');
///паринг главной страницы

	$html = curl_get('https://www.youtube.com/live');
	$dom = str_get_html($html);
//echo $dom;
	//function get_live_href($dom, $num_str){
		
		$names = $dom->find('.yt-lockup-dismissable');
		//echo $dom;
		foreach($names as $name) {   ///выходит ровно 29 последних видео из канала
			$title = $name->find('a', 1);
			$a = $name->find('a', 0);
			$span = $name->find('span',0);  ///тривалость
			$image_ico = $name->find('img',0);
			$h3 = $name->find('h3', 0);
			
			//echo $name;
			if( !($h3->find('span', 0))){
				$span = $name->find('span', -1);
				//echo $span->plaintext  .'выводит время в мин или слово прямой ефир<-- SPAN <br>';
				if(($image_ico->getAttribute('data-thumb'))){
					echo '<img src="'.$image_ico->getAttribute('data-thumb').'"><br>';
				}
				else{
					echo '<img src="'.$image_ico->getAttribute('src').'"><br>';
				}
				echo $title->innertext .'<br>';
				echo 'https://www.youtube.com'. $a->href . '<br>';
				echo '<a href="'.'https://www.youtube.com'. $a->href.'">'.$name->find('span',-1).' </a> <br><br>';
			}
			//echo '<br>';
		} 	 
	//}

	//get_live_href(str_get_html(curl_get(' ')), 37-1);

?>