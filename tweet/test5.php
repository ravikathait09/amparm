<?php
$fileBasePath = dirname(__FILE__).'/';
include_once('include/header.php');
include_once("inc/twitteroauth.php");

if(!isset($_SESSION['user_info']['id'])){
	header('Location: logout.php');
	exit;
}
if($_SESSION['user_info']['manage_group']!=1){
	header('location:dashboard.php');
}
$main= new Main();
$user=new user();
$tweet= new twitter();
$group  = new Group();
$groupuser  = new groupuser();
$tweetergroup= new tweetergroup();
$tweetuser= new Tweetuser;
$notification = new Notification();
$groupuser  = new groupuser();
$userdetail=$user->findcustomrow(array('id'=>$_SESSION['user_info']['id'] ));
$twiiter  = new twitter();
$tweetergroup=new tweetergroup();
$alltweetresult = $twiiter->countWhere('ownerid','ownerid='.$_SESSION['user_info']['id']);


$sql=$tweet->gettwiiterbyownersql($_SESSION['user_info']['id'],$limit=10);
$alltweet=$main->runsql($sql);
$allgroup = $group->getgroupbyowner($_SESSION['user_info']['id']);
if(isset($_GET['delete'])){
   $twiiter->delete($_GET['id']);
	$sql="delete from tweetuser where tweetid='".$_GET['id']."'";
	$main->runsql($sql);
	
}    
$tweetuser= new Tweetuser;
include('include/head.php');
include('include/sidebar.php');

date_default_timezone_set("Asia/Kolkata");
 if(isset($_POST['addtweet'])){
		$destination='';
		$tweet->tweettype	 = $_POST['tweettype'];
		$tweet->tweet	 = $_POST['description'];
		if( $_POST['tweettype']=='0')
		{
			
			if(isset($_FILES['tweet_image']) && !empty($_FILES['tweet_image']['name']))
			{
				print_R($_FILES['tweet_image']);
				
				$filename=$_FILES['tweet_image'];
				$source=$_FILES['tweet_image']['tmp_name'];
				$destination=rand().$_FILES['tweet_image']['name'];
				if(move_uploaded_file($source,$config['DOC_ROOT'].'/tweet_image/'.$destination)){
					#echo 'ravi';
				}
				else{
					#echo 'kathait';
				}
			
				#die;
			}

		}
		
			$tweet->image=$destination;
			//$tweet->groupname	 = $_POST['group'];
			
			 $tweet->datetime	 =  $_POST['datetime'];
			 $tweet->timestamp	 =  strtotime($_POST['datetime']);
			//die;
			$tweet->ownerid	 =  $_SESSION['user_info']['id'];
			$tweet->status	 = 0;
			$tweet->create();
			 $lastid=   $tweet->lastInsertId();
			$_SESSION['msgsuccess'] = "Tweet has been Scheduled successfully";   
			foreach($_POST['allgroup'] as $key=>$value)
			{
				$tweetergroup->tweetid= $lastid;
				$tweetergroup->groupname= $value;
				$tweetergroup->create();
				$group  = new Group();
				$groupdetail=$group->findCustomRow(array('id'=>$value));
				$getuser=$groupuser->findgroupuser($value) ;
				$msg='';
				foreach($getuser as $key =>$user)
				{
						$tweetuser->tweetid=$lastid;
						$tweetuser->userid=$user['id'];
						$tweetuser->groupid=$value;
						$msg='<p>Hi '.$user['screen_name'].'</p>';
						if(!$user['group_notification'])
						{
							$tweetuser->status=0;
							$notification->notification="New Tweet Has been Scheduled by ".$groupdetail['title']. ' on '.$_POST['datetime']." Please update Statuss  ";
						
							$headers = 'From: AMPARM' . "\r\n".'reply-to: no-reply'. "\r\n";
							$headers .= "MIME-Version: 1.0\r\n";
							$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
							$msg.='<p>Approval required for new tweet in '.$groupdetail['title']. '</p>';
							$msg.='<p>Regards <br/> '.website_name.'</p>';
							#mail($user['email'], 'New Tweet has been Scheduled' , $msg,$headers );		
						}
						else{
							$tweetuser->status=1;
							$notification->notification="New Tweet Has been Scheduled  by ".$groupdetail['title']. ' on '.$_POST['datetime'];
						}
						$tweetuser->create();
						$notification->userid=$user['id'];
						$notification->eventid=$lastid;
						$notification->type='Tweet';
						$notification->create();
						 
						
				}
			
			}
			redirectAdmin('tweet.php');	
}

 ?>
<div id="content" class="page-content clearfix">
<div class="contentwrapper">
   <aside class="right-side">
	<?php
	if(isset($_SESSION['msgsuccess'])){
	?>
		<div class="alert alert-success alert-dismissable">
			<i class="fa fa-check"></i>
			<button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>
			<b>Alert!</b> <?php echo $_SESSION['msgsuccess']; ?>.
		</div>
		<?php
		unset($_SESSION['msgsuccess']);
	}
	?>
	 <div class="heading">
	
		<h3>Manage Schedule</h3>
		<div class="resBtnSearch">
			<a href="#"><span class="s16 icomoon-icon-search-3"></span></a>
		</div>
		<div class="search">
			<!-- .search -->
			<!--<form id="searchform" class="form-horizontal" action="search.html">
				<input type="text" class="top-search from-control" placeholder="Search here ..." />
				<input type="submit" class="search-btn" value="" />
			</form>-->
		</div>
		<!--  /search -->
		<ul class="breadcrumb">
			<li>You are here:</li>
			<li>
				<a href="#" class="tip" title="back to dashboard">
					<i class="s16 icomoon-icon-screen-2"></i>
				</a>
				<span class="divider">
						<i class="s16 icomoon-icon-arrow-right-3"></i>
				</span>
			</li>
			<li class="active">Tweet Management</li>
		</ul>
	</div>

<section class="content">  
 <div class="row">
    <div class="col-md-7 col-lg-7 col-sm-12" >
		
		<?php
		if(!empty($alltweet)){ ?>
		<div class="panel panel-default">
				<div class="panel-heading">
				  <h4 class="panel-title"><i class="icomoon-icon-twitter"></i> From AMPARM</h4>
			    </div>
					<div class="panel-body">
	
			<div class="post-container" id="amplify">
		<?php
		foreach($alltweet as $k=>$value){
			
			
			$i=0;
			
														
				$totalcount=0;
				$estimatecoun=0;
					$result=$tweetergroup->findgroupdetail($value['id']);				
					$name='';
					foreach($result as $key=>$value2){
					$name.=$value2['title'].',';
					}	$i++;
					$strname=substr($name,0,-1);
					$total=$tweetuser->countWhere('userid','tweetid='.$value['id']);
					$count=$tweetuser->countWhere('userid','status=1 and tweetid='.$value['id']);
					$sql="select sum(u.follower) as reach from users u,tweetuser g where g.tweetid='".$value['id']."' and u.id=g.userid";
					$totalcount=$main->runsql($sql);
					
					$sql="select sum(u.follower) as reach from users u,tweetuser g where g.tweetid='".$value['id']."' and u.id=g.userid and g.status=1";
					$estimatecount=$main->runsql($sql);
					?>
				
				<?php
			
					if($value['tweettype']==0) {
				?> <div class="row">
						 <div class="col-md-2">
						
							<img  src="<?php echo  $_SESSION['user_info']['profile_image_url'] ?>"  alt="<?php echo  $_SESSION['user_info']['screen_name'] ?>"class="twitter-widget-avatar">
						
						 </div>
						 <div class="col-md-10">
						   <div class="tweet-text">
							<?php echo $value['tweet'] ?><a href="#">...</a>
						   </div>
						   <div class="tweetPost-thumb">
								<?php if(!empty($value['image'])) { ?>							   
									<img src="<?php echo $config['SITE_URL'].'/tweet_image/'.$value['image'] ?>" class="" width="100%">							   
								<?php } ?>
							</div>
						   <div class="tweet-action">
							<div class="action-button">
							  
							    <a href="<?php echo $config['SITE_URL']."userlist.php?TYPE=TWEET&id=".$value['id'];?>"><span class="eco-users"></span></a>
							  <!--<a href="#"><span class="glyphicon glyphicon-heart"></span></a>
								   <a href="#"><span class="glyphicon glyphicon-retweet"></span></a>-->
							 </div>
							 <div class="reach">
							   <strong>Reach : <?php echo $totalcount[0]['reach'] ; ?></strong>
							    
							 </div>
							 <div class="amplified">
							   <?php if($value['status']){ ?><strong>Schedule On : </strong><?php } else{ ?>
							   <strong>Amplified On : </strong>
							   <?php } ?><?php echo date('d M Y h.i A', strtotime($value['datetime'])) ?>
							 </div>
						   </div><!---./tweet-action --->
						 </div>  
					   </div>
				<?php } else{ 
					$array=array_reverse(explode('/',$value["tweet"]));
					$my_update =getretweetdetail($array[0]); 
				?>
							<div class="row">
							 <div class="col-md-2">
								<img  src="<?php echo  $_SESSION['user_info']['profile_image_url'] ?>"  alt="<?php echo  $_SESSION['user_info']['screen_name'] ?>" class="twitter-widget-avatar">
							 </div>
							 <div class="col-md-10">
							   <div class="tweet-text">
								<?php echo utf8_decode($my_update->text) ;?><a href="#">...</a>
							   </div>
							   <div class="tweetPost-thumb">
								<?php if(!empty($my_update->entities->media[0]->media_url)){ ?>
									<img src="<?php echo $my_update->entities->media[0]->media_url;?>" class="" width="100%">
								<?php } ?>
							   </div>
							   <div class="tweet-action">
								<div class="action-button">
								 <!-- <a href="#"><span class="glyphicon glyphicon-repeat"></span></a>-->
								  <a href="<?php echo $config['SITE_URL']."userlist.php?TYPE=TWEET&id=".$value['id'];?>"><span class="eco-users"></span></a>
								  
								 </div>
								 <div class="reach">
								   <strong>Reach : <?php echo $totalcount[0]['reach'] ; ?></strong>
								 </div>
								 <div class="reach">
								 <div class="amplified">
								   <?php if($value['status']){ ?><strong>Schedule On : </strong><?php } else{ ?>
										<strong>Amplified On : </strong>
								   <?php } ?><?php echo date('d M Y h.i A', strtotime($value['datetime'])) ?>
							 </div>
								 </div>
							   </div><!---./tweet-action --->
							 </div>  
						   </div>
					
				<?php } ?>
				<div>
						  <hr>
						</div>

			<?php 				}  ?>
				</div>
				
			</div>
		</div>
			<p class="demo demo4_top"></p>
		<?php } ?>
	</div>
 <div class="col-md-5">  
	
		  <form method="post"  id="formtweet" class="form-horizontal group-border stripped" role="form" enctype="multipart/form-data">
			<div class="share">
			<div class="panel panel-default">
				<div class="panel-heading">
				  <h4 class="panel-title"><i class="fa fa-file"></i> From AMPARM</h4>
			    </div>
			
                      <div class="panel-body">
                        <div class="tweet-box">
						    <img src="https://pbs.twimg.com/profile_images/671351232036921345/02GosYVW_bigger.jpg">
                            <textarea   name="description" cols="40" rows="10" id="retweetinput" class="form-control message required" style="height: 62px; overflow: hidden;" placeholder="Amplify Your Message Here..."></textarea> 
							<div id='retweetdescription' class='form-group retweetdescription'></div>
							<div class="media-button">
								<input class="tweet" type="file" accept="image/gif,image/jpeg,image/jpg,image/png,video/mp4,video/x-m4v"></button>
							</div>
						</div>
						<div class="clearfix"></div>
						<?php if(count($allgroup)) { ?>
						<div class="form-group  p10">
							<label class="col-lg-2 col-md-3 control-label">Select Group</label>
						
						
							<div class="col-lg-10 col-md-9">										
							 <?php $i=0; foreach($allgroup as $key=>$value) { $i++; ?>
								<div class="checkbox-custom checkbox-inline">
										
										<input type="checkbox" placeholder="Enter Group Name" id="catName"  name='allgroup[]' value='<?php echo $value['id']; ?>' class="selectall required " >
										<label for="exampleInputEmail1"><?php echo $value['title']; ?></label>										
										
								  </div>										
							<?php if($i%3==0)  echo '<br/>';} ?>
							</div>
						</div>
							<?php } ?>
                      
					
				  
						<div class="panel-footer">
								
								<div class="row">
									<div class="col-md-7">
										<div class="form-group">
											<div class="btn-group">
											  <div class='input-group date' id='datetimepicker1'>
												<input type='text' placeholder="Date/time" id="mydatetime" name="datetime" class="form-control required"/>
												<span class="input-group-addon">
												<input type="hidden" id="tweettype" name="tweettype" value='0'>
												<span class="glyphicon glyphicon-calendar"></span>
												</span>
											</div>
											
											</div>
										</div>
									</div>
									<div class="col-md-5">
										<div class="form-group">
											                                
											<input type="submit" name="addtweet" value="Post" class="btn btn-primary">                               
										</div>
									</div>
								</div>
						</div>
                    </div>
			</div>
		</form>
	</div>
		
		
	</div>
	
 </div>										
 <div class="row">
	   <!-- /.row -->
	</div>
</section><!-- /.content -->
 </aside><!-- /.right-side -->
</div>
</div>
<?php

include_once('include/footer.php');

?>
<script src="js/bootpage.js"></script>
<script type="text/javascript">
			$(function () {
				var nowDate = new Date();
				var today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), 0, 0, 0, 0);
				$('#datetimepicker1').datetimepicker({
					format: 'YYYY-MM-DD HH:mm',
					minDate: new Date() 
				});
			});
			$('#tweetform').validate();
			$('#retweetinput').blur(function(){
				myid=$('#retweetinput').val();
				$.ajax({
				type:'post',
				url:'ajax.php',
				data:  {text:myid},
				success:function(res){
					
					if(res.length>2){
						
						$('#retweetdescription').html(res);
						$('#tweettype').val(1);
						$('.tweet').hide();
					}
				else{
					$('#tweettype').val(0);
						$('.tweet').show();
						$('#retweetdescription').html('');
				}
				}
				});
			}); 
			function show()
			{
				$('.tweet').show();
				$('.retweet').hide();
				$('#description').addClass('required');
					$('#retweetinput').removeClass('required');
			}
			function hide()
			{
				$('.tweet').hide();
				$('.retweet').show();
				$('#description').removeClass('required');
					$('#retweetinput').addClass('required');
			}
			$('#formtweet').validate();
jQuery(document).ready(function(){
jQuery('.demo4_top').bootpag({
        total: '<?php echo ceil($alltweetresult/10); ?>',
        page: 1,
        maxVisible: 3,
        leaps: true,
        firstLastUse: true,
        first: '←',
        last: '→',
        wrapClass: 'pagination',
        activeClass: 'active',
        disabledClass: 'disabled',
        nextClass: 'next',
        prevClass: 'prev',
        lastClass: 'last',
        firstClass: 'first'
    }).on("page", function(event, num){
		$.ajax({
		type:'post',
		
		url:'ajax.php?paginate=alltweet&page='+num,
		success:function(res){	
			$("#amplify").html(res); 
		
		}
		
        
    }); 
});
});
        </script>

