<?php

$fileBasePath = dirname(__FILE__).'/';
include_once('include/actionHeader.php');
$main= new Main();
$categoryurl=new CategoryUrl();
if(!isset($_SESSION['admin_info'])){
	exit();
}
if(isset($_POST['notification']))
{
	$sql="update notification set status=1 where userid='1'";
	$main->runsql($sql);

}

if(isset($_REQUEST['removeurl']))
{
	$categoryurl->id =$_REQUEST['removeurl'];
	$categoryurl->delete($_REQUEST['removeurl']);
}

if(isset($_POST['text']))
{
	include_once("../inc/twitteroauth.php");
	$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
	$array=array_reverse(explode('/',$_POST["text"]));
	$my_update = $connection->get('statuses/show', array('id' => $array[0]));
	if($my_update->id){ ?>
		
		<div class="">
   
    <div class="row">
        <div class="col-md-12">
            <img style='float:left;width:200px;height:200px; margin-right:10px;' src="<?php echo $my_update->entities->media[0]->media_url;?>" />
            <p><?php echo utf8_decode($my_update->text) ;?></p>
        </div>
    </div>
	<?php	
	}
	
}
