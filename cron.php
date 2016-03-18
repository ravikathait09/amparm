<?php 
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);
#phpinfo ();

date_default_timezone_set("Asia/Kolkata");
$config['DOC_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/tweet/';
include_once($config['DOC_ROOT'].'include/config.php');
include_once($config['DOC_ROOT'].'classes/tweet.class.php');
include_once($config['DOC_ROOT'].'classes/user.class.php');
include_once($config['DOC_ROOT'].'classes/group.class.php');
include_once($config['DOC_ROOT'].'inc/twitteroauth.php');
$tweet=new twitter();
$tweetuser=new Tweetuser();
date_default_timezone_set("Asia/Kolkata");
$date=date("Y-m-d H:i:s");
$currenttime=strtotime($date);
$settings = new Setting();
$allSettings = $settings->findcustomRow(array('id'=>1));
$main= new Main();
$tweet=new twitter();
$tweetuser=new Tweetuser();
$alltweet=$tweet->findCustomlessthen($currenttime);

foreach($alltweet as $key =>$value){
	
	$userresult=$tweetuser->gettweetuser($value['id']);
	foreach($userresult as $mykey=>$row)
	{
		
			$twitterid 			= $row['tweet_user_id'];
			$oauth_token 		= $row['outh_token'];
			$oauth_token_secret = $row['oauth_token_secret'];
			$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $oauth_token, $oauth_token_secret);
			//Post text to twitter
			if($row["status"]){
				if($value['tweettype'])
				{
					$array=array_reverse(explode('/',$value["tweet"]));
					 $id= $array[0];
					$my_update = $connection->post('statuses/retweet', array('id' => $id));
				}else{
					if($value["image"]){
						$image	=$config['DOC_ROOT'].'tweet_image/'.$value["image"];
						$tweet_img = $image	;
						$handle = fopen($tweet_img,'rb');
						$image = fread($handle,filesize($tweet_img));
						fclose($handle);
						$my_update = $connection->post('statuses/update_with_media', array('status' => $value["tweet"],'media[]'  => "{$image};Content-Type=multipart/form-data;filename={$tweet_img}"),true);
					}else{
						$my_update = $connection->post('statuses/update', array('status' => $value["tweet"]));
						
					}
				}
			
				
				$tweetuser=new Tweetuser();
				$tweetuser->tweetreplyid=$my_update->id_str;
				$tweetuser->id=$row['tweetuserid'];
				$tweetuser->sent=1;
				$tweetuser->save();
				if($row['groupid'])
				{
					$totalpoint=0;
					$Group  = new Group();
					
					
						$groupdetail=$Group->findcustomRow(array('id'=>$row['groupid']));
						$groupuser=new groupuser();
						$totalpoint+=$groupdetail['autotweetpoint'];
						if($allSettings['unit']<$row['follower'])
						{
							$totalpoint+=(int) $groupdetail['followerpoint']/($row['follower']%$allSettings['unit']);
						}
						 $sql="update groupuser set point=point+'".$totalpoint."' where userid= '".$row['id']."' and groupid='".$row['groupid']."'";
						$main->runsql($sql);
					
				}
		
			}
			
		
			
	}
	$mytweet=new twitter();
	$mytweet->id=$value['id'];
	$mytweet->status=1;
	$mytweet->save();
	
}

$alltweet=$tweet->findCustomindividuallessthen($currenttime);
$tweetuser=new Tweetuser();
foreach($alltweet as $key =>$value){

	$userresult=$tweetuser->gettweetlaterapproveuser($value['id']);

	
	foreach($userresult as $mykey=>$row)
	{
		
		if(!$row['sent']){
			$twitterid 			= $row['tweet_user_id'];
			$oauth_token 		= $row['outh_token'];
			$oauth_token_secret = $row['oauth_token_secret'];
			$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $oauth_token, $oauth_token_secret);
			
			if($row["status"]){
				if($value['tweettype'])
				{
					$array=array_reverse(explode('/',$value["tweet"]));
					 $id= $array[0];
					$my_update = $connection->post('statuses/retweet', array('id' => $id));
				}else{
					if($value["image"]){
						$image	=$config['DOC_ROOT'].'tweet_image/'.$value["image"];
						$tweet_img = $image	;
						$handle = fopen($tweet_img,'rb');
						$image = fread($handle,filesize($tweet_img));
						fclose($handle);
						$my_update = $connection->post('statuses/update_with_media', array('status' => $value["tweet"],'media[]'  => "{$image};Content-Type=multipart/form-data;filename={$tweet_img}"),true);
					}else{
						$my_update = $connection->post('statuses/update', array('status' => $value["tweet"]));
					}
				}
				$tweetuser=new Tweetuser();
				$tweetuser->tweetreplyid=$my_update->id_str;
				$tweetuser->id=$row['tweetuserid'];
				$tweetuser->sent=1;
				$tweetuser->save();
				if($row['groupid'])
				{
					$totalpoint=0;
					$Group  = new Group();
					
					
						$groupdetail=$Group->findcustomRow(array('id'=>$row['groupid']));
						$groupuser=new groupuser();
						$totalpoint+=$groupdetail['afterschedulepoint'];
						if($alltweet['unit']<$row['follower'])
						{
							$totalpoint+=(int)$groupdetail['followerpoint']/($row['follower']%$alltweet['unit']);
						}
						echo $sql="update groupuser set point=point+'".$totalpoint."' where userid= '".$row['id']."' and groupid='".$row['groupid']."'";
						$main->runsql($sql);
					
				}
					
				
				
		
			}
			
			
			
	}
	}
	$mytweet=new twitter();
	$mytweet->id=$value['id'];
	$mytweet->status=1;
	$mytweet->save();
	
}
