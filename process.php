<?php
session_start();
include_once("include/config.php");
include_once("inc/twitteroauth.php");
include_once($config['DOC_ROOT'].'classes/user.class.php');
include_once($config['DOC_ROOT'].'classes/group.class.php');
$user  = new User();
$groupuser=new groupuser();
if(isset($_SESSION['user_info']))
{
	header('location:thanks');
	exit;
}
if (isset($_REQUEST['oauth_token']) && $_SESSION['token']  !== $_REQUEST['oauth_token']) {

	// if token is old, distroy any session and redirect user to index.php
	session_destroy();
	header('Location: ./index');
	
}elseif(isset($_REQUEST['oauth_token']) && $_SESSION['token'] == $_REQUEST['oauth_token']) {

	// everything looks good, request access token
	//successful response returns oauth_token, oauth_token_secret, user_id, and screen_name
	$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $_SESSION['token'] , $_SESSION['token_secret']);
	$access_token = $connection->getAccessToken($_REQUEST['oauth_verifier']);
	
	if($connection->http_code=='200')
	{
		//redirect user to twitter
		 $userresult=$user->findCustomRow(array('tweet_user_id'=>$access_token['user_id']));
		// echo '<pre>';
		# print_R( $userresult);
		if(empty($userresult))
		{
			$_SESSION['status'] = 'verified';
			$_SESSION['request_vars'] = $access_token;
			$user->outh_token=$access_token['oauth_token'];
			$user->oauth_token_secret=$access_token['oauth_token_secret'];
			$user->tweet_user_id=$access_token['user_id'];
			$user->screen_name=$access_token['screen_name'];
			$user->twitter_varified=1;
			$user->create();
			$mylastid=$user->lastInsertId();
			
			$userresult=$user->findCustomRow(array('tweet_user_id'=>$access_token['user_id']));
			
		}
	
			$my_update = $connection->get('users/show.json?screen_name='.$access_token['screen_name'], array('user_id' => $userresult["tweet_user_id"],'screen_name'=>$userresult['screen_name']));
		
		
			$user  = new User();
			$user->id=$userresult['id'];
			$user->screen_name=$access_token['screen_name'];
			$user->tweetcount=$my_update->statuses_count;
			$user->firstname=$my_update->name;
			$user->friendcount=$my_update->friends_count;
			$user->follower=$my_update->followers_count;
			$user->favourite=$my_update->favourites_count;
			$user->descripition=$my_update->description;
			$user->profile_image_url=$my_update->profile_image_url;
			$user->save();
			$userresult=$user->findCustomRow(array('tweet_user_id'=>$access_token['user_id']));
			$_SESSION['user_info'] = $userresult;
		unset($_SESSION['token']);
		unset($_SESSION['status']);
		unset($_SESSION['token_secret']);
		unset($_SESSION['request_vars']);
	//	echo '</pre>';
	#	die;
		header('Location:thanks');
		
		
		
	}else{
		die("error, try again later!");
	}
		
}else{

	if(isset($_GET["denied"]))
	{
		header('Location: ./index.php');
		die();
	}

	//fresh authentication
	$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
	$request_token = $connection->getRequestToken(OAUTH_CALLBACK);
	
	//received token info from twitter
	$_SESSION['token'] 			= $request_token['oauth_token'];
	$_SESSION['token_secret'] 	= $request_token['oauth_token_secret'];
	
	// any value other than 200 is failure, so continue only if http code is 200
	if($connection->http_code=='200')
	{
		//redirect user to twitter
		$twitter_url = $connection->getAuthorizeURL($request_token['oauth_token']);
		header('Location: ' . $twitter_url); 
	}else{
		die("error connecting to twitter! try again later!");
	}
}
?>

