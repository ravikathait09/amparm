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
include_once($config['DOC_ROOT'].'inc/twitteroauth.php');
$user =new user();
$tweet=new twitter();
$tweetuser=new Tweetuser();
$main= new Main();
$interestedcat=new interestedcat();
$usertimesettingobj= new usertimesetting();
$recommendtweetobj= new userrecommandtweet();
$CategoryUrl  =new CategoryUrl();
date_default_timezone_set("Asia/Kolkata");
$date=date("Y-m-d H:i:s");
$currenttime=strtotime($date);
$alluser=$user->all();
 $daynum = date("N", strtotime(date('l')));
foreach($alluser as $key=>$value)
{
	$daynum = date("N", strtotime(date('l')));
	$hour = date('H');
	if($hour>12)
	
	if(in_array($daynum,explode(',',$value['weekday'])))
	{
		//$sql="select * usertimesetting where hour >='".$hour."' ";
		//$timeresult=$main->runsql($sql);
		
		$usertimearray=$usertimesettingobj->findcustom(array('userid'=>$value['id']));
		$interestedcategory=$interestedcat->findCustom(array('userid'=>$value['id']));
		$recommenedtweet=$recommendtweetobj->findCustom(array('userid'=>$value['id']));
		
		foreach($interestedcategory as $key =>$value)
		{
			$usercatarray[]=$value['catid'];
			$allurl=$CategoryUrl->findcustom(array('catid'=>$value['catid']));
			foreach($allurl as $key=>$value)
			{
			   $str[]=$value['id'];
			}
		}
		foreach($recommenedtweet as $key =>$value)
		{
			$nostr[]=$value['id'];
		}
		$blogfeed=array();
		$sql="select * from urlblog where ";
		if(!empty($str))
		{
			$sql.="urlid in(".implode(',',$str).") and  ";
		}
		if(!empty($nostr))
		{
			$sql.="id not in(".implode(',',$nostr).") and ";
		}
		$getttoal=$main->runsql($sql. ' 1');
		$totalfeed=count($getttoal);
		$sql.=" 1 order by rand() desc limit 1";
		$blogfeed=$main->runsql($sql);
	}
}