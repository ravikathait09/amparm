<?php
$fileBasePath = dirname(__FILE__).'/';
include_once( $_SERVER['DOCUMENT_ROOT'].'tweet/admin/include/actionHeader.php');
require_once($_SERVER['DOCUMENT_ROOT'].'tweet/admin/bitly.php');
$category = new Category();
$categoryurl=new CategoryUrl();
$allcat=$category->all();
$blogurl=new blogurl();
$array=array();
function bitlyurl($url,$format='txt') {
	#echo $url;
	$user_login = 'o_27nepp5qic';
	$user_api_key = 'R_c78c538f512c41eab6ff09415fbdfc86';  
	$connectURL = 'http://api.bit.ly/v3/shorten?login='.$user_login.'&apiKey='.$user_api_key.'&uri='.urlencode($url).'&format='.$format;
	return curl_get_result($connectURL);
}



/* returns a result form url */
function curl_get_result($url) {
	$ch = curl_init();
	$timeout = 5;
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
	$results = curl_exec($ch);
	curl_close($ch);
	#var_dump($results);
	#if($results['status_code']==200)
	return trim($results);
	#else return '';
}
function bitlyurltest($url)
{
	#echo $url;
	$client_id = '9392d340517614ddf9f56ab8bb0b0bd20d6cc8dc';
	$client_secret = '390ca7d6d97c20328177fc3d693e3804b84defb7';
	$user_access_token = '9bf392bb53c3c4906e8a9095587f9ccb7559e925';
	$user_login = 'o_27nepp5qic';
	$user_api_key = 'R_c78c538f512c41eab6ff09415fbdfc86';
	$params = array();
	$params['access_token'] = $user_access_token;
	$params['longUrl'] = $url;
	$params['domain'] = '';
	$results = bitly_get('shorten', $params);
	#print_R($results);
	if($results['status_code']==200)
	return $results['data']['url'];
	else return '';
	
}



function myfeed($url){
		$ch = curl_init( $url);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		$data = curl_exec($ch);
		curl_close($ch);
		return $data;
 
}
function parseRSS($xml)
{
    echo "<strong>".$xml->channel->title."</strong>";
    $cnt = count($xml->channel->item);
    for($i=0; $i<$cnt; $i++)
    {
	$url 	= $xml->channel->item[$i]->link;
	$title 	= $xml->channel->item[$i]->title;
	$desc = $xml->channel->item[$i]->description;
 
	echo '<a href="'.$url.'">'.$title.'</a>'.$desc.'';
    }
}
function parseAtom($xml)
{
    echo "<strong>".$xml->author->name."</strong>";
    $cnt = count($xml->entry);
    for($i=0; $i<$cnt; $i++)
    {
		$urlAtt = $xml->entry[$i]->link->attributes();
		$url	= $urlAtt['href'];
		$title=$xml->entry[$i]->title;
 
	
    }
}
foreach($allcat as $key=>$value)
{
	$caturl=$categoryurl->findcustom(array('catid'=>$value['id']));
	foreach($caturl as $key1=>$row)
	{
		
		echo  $xml=$row['url'];	
		if(empty($xml)) continue;
		#$xml='http://www.socialmediatoday.com/rss';	
		
		$content = myfeed($xml);
		if($content){
		$x = new SimpleXmlElement($content,LIBXML_NOCDATA);
		
		if(isset($x->entry))
		{
			// parseAtom($x );
			
			 $cnt = count($x->entry);
			 $source=$x->title;
				for($i=0; $i<$cnt; $i++)
				{
					$total=0;
					
					$blogurl=new blogurl();
					$urlAtt = $x->entry[$i]->link->attributes();
					$link	= $urlAtt['href'];
					$title=$x->entry[$i]->title;
					
					
					/*$link=(string)$entry->link;
					$title=(string)$entry->title;*/
								
					$blourldetail=$blogurl->findcustomRow(array('blogurl'=>$link));
					$querystring="SELECT like_count, total_count, share_count, click_count, comment_count FROM link_stat WHERE url = '".$link."'";
					$query=str_replace(' ','%20',$querystring);
					$query=str_replace('\'','%22',$query);
					 $fburl="https://graph.facebook.com/fql?q=".$query;
					$fb_result=json_decode(file_get_contents($fburl));
					#print_R($fb_result);
					if( empty($blourldetail['shorturl'])){
					$blogurl->shorturl=bitlyurl($link);
					}
					$blogurl->source=$source;
					$blogurl->publishdate=date("Y-m-d  h:i:s", strtotime($x->entry[$i]->published));
					$blogurl->urlid=$row['id'];
					$blogurl->title=$title;
					$blogurl->blogurl=$link;
					$blogurl->share_count=$fb_result->data[0]->share_count;
					$blogurl->like_count=$fb_result->data[0]->like_count;
					$blogurl->comment_count=$fb_result->data[0]->comment_count;
					$blogurl->click_count=$fb_result->data[0]->click_count;
					$total+=$blogurl->total_fb_count=$fb_result->data[0]->total_count;
					$total+=$blogurl->google_count=1;
					$total+=$blogurl->	pininterest_count=2;
					$total+=$blogurl->linkdin_count=3;
					$total+=$blogurl->tweetcount=3;
					
					#print_R($blogurl);
					if($total>2)
					{
						$blogurl->total_count=$total;
						if(empty($blourldetail))
						{
							$blogurl->create();
						}
						else
						{
							$blogurl->id=$blourldetail['id'];
							$blogurl->save();
						}
					}
					echo '</pre>';
				}
		}
		if(isset($x->channel))
		{
			$source=$x->channel->title;
				$cnt = count($x->channel->item);
				for($i=0; $i<$cnt; $i++)
				{
					$total=0;
					
					$blogurl=new blogurl();
					$link = $x->channel->item[$i]->link;
					
					$title=$x->channel->item[$i]->title;
 
					/*$link=(string)$entry->link;
					$title=(string)$entry->title;*/
								
					$blourldetail=$blogurl->findcustomRow(array('blogurl'=>$link));
					
					 $querystring="SELECT like_count, total_count, share_count, click_count, comment_count FROM link_stat WHERE url = '".$link."'";
					$query=str_replace(' ','%20',$querystring);
					$query=str_replace('\'','%22',$query);
					 $fburl="https://graph.facebook.com/fql?q=".$query;
					$fb_result=json_decode(file_get_contents($fburl));
					
					#print_R($fb_result);
					if( empty($blourldetail['shorturl'])){
					$blogurl->shorturl=bitlyurl($link);
					}
						$blogurl->source=$source;
						$blogurl->publishdate=date("Y-m-d  h:i:s", strtotime($x->channel->item[$i]->pubDate));
					$blogurl->urlid=$row['id'];
					$blogurl->title=$title;
					$blogurl->blogurl=$link;
					$blogurl->share_count=$fb_result->data[0]->share_count;
					$blogurl->like_count=$fb_result->data[0]->like_count;
					$blogurl->comment_count=$fb_result->data[0]->comment_count;
					$blogurl->click_count=$fb_result->data[0]->click_count;
					$total+=$blogurl->total_fb_count=$fb_result->data[0]->total_count;
					$total+=$blogurl->google_count=1;
					$total+=$blogurl->	pininterest_count=2;
					$total+=$blogurl->linkdin_count=3;
					$total+=$blogurl->tweetcount=3;
					
					#print_R($blogurl);
					if($total>2)
					{
						$blogurl->total_count=$total;
						if(empty($blourldetail))
						{
							$blogurl->create();
						}
						else
						{
							$blogurl->id=$blourldetail['id'];
							$blogurl->save();
						}
					}
					echo '</pre>';
				}
		}
		}		
		else
		{
				 $xml=$row['url'];
				
				
				$content = file_get_contents($xml);
				$x = new SimpleXmlElement($content);
					
					
					$source=$x->channel->title;
				foreach($x->channel->item as $entry) {
					$total=0;
				
					$blogurl=new blogurl();
					$link=(string)$entry->link;
					$title=(string)$entry->title;
								
					$blourldetail=$blogurl->findcustomRow(array('blogurl'=>$link));
					
					 $querystring="SELECT like_count, total_count, share_count, click_count, comment_count FROM link_stat WHERE url = '".$link."'";
					$query=str_replace(' ','%20',$querystring);
					$query=str_replace('\'','%22',$query);
					 $fburl="https://graph.facebook.com/fql?q=".$query;
					$fb_result=json_decode(file_get_contents($fburl));
					
					#print_R($fb_result);
					$blogurl->urlid=$row['id'];
					if( empty($blourldetail['shorturl'])){
					$blogurl->shorturl=bitlyurl($link);
					}
					$blogurl->publishdate=date("Y-m-d  h:i:s", strtotime($entry->pubDate));
					$blogurl->source=$source;
					$blogurl->title=$title;
					$blogurl->blogurl=$link;
					$blogurl->share_count=$fb_result->data[0]->share_count;
					$blogurl->like_count=$fb_result->data[0]->like_count;
					$blogurl->comment_count=$fb_result->data[0]->comment_count;
					$blogurl->click_count=$fb_result->data[0]->click_count;
					$total+=$blogurl->total_fb_count=$fb_result->data[0]->total_count;
					$total+=$blogurl->google_count=1;
					$total+=$blogurl->	pininterest_count=2;
					$total+=$blogurl->linkdin_count=3;
					$total+=$blogurl->tweetcount=3;
					
					#print_R($blogurl);
					if($total>2)
					{
						$blogurl->total_count=$total;
						if(empty($blourldetail))
						{
							$blogurl->create();
						}
						else
						{
							$blogurl->id=$blourldetail['id'];
							$blogurl->save();
						}
					}
					echo '</pre>';
					
					
							
				}
		}
	}
}

