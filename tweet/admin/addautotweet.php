<?php

$fileBasePath = dirname(__FILE__).'/';
include_once('include/header.php');
include_once('include/sidebar.php');
include_once('include/sidebar.php');
include_once("../inc/twitteroauth.php");
/*
*	Redirect Admin To Home Page
*	If Already Logged In
*/
if(!isset($_SESSION['admin_info'])){
	header('Location: logout.php');
}
$user=new user();
$tweet= new twitter();
$group  = new Group();
$groupuser  = new groupuser();
$tweetergroup= new tweetergroup();
$tweetuser= new Tweetuser;
$notification = new Notification();
date_default_timezone_set("Asia/Kolkata");
 if(isset($_POST['addtweet'])){
		$destination='';
		$tweet->tweettype	 = $_POST['tweettype'];
		if( $_POST['tweettype']=='0')
		{
				$tweet->tweet	 = $_POST['description'];
				if(isset($_FILES['tweet_image']) && !empty($_FILES['tweet_image']['name']))
				{
					$filename=$_FILES['tweet_image'];
					$source=$_FILES['tweet_image']['tmp_name'];
					$destination=rand().$_FILES['tweet_image']['name'];
					if(move_uploaded_file($source,$config['DOC_ROOT'].'/tweet_image/'.$destination));
				
					
					}
		}
		else{
			$tweet->tweet	 = $_POST['retweet'];
		}
			$tweet->image=$destination;
			//$tweet->groupname	 = $_POST['group'];
			
			echo $tweet->datetime	 =  $_POST['datetime'];
			echo $tweet->timestamp	 =  strtotime($_POST['datetime']);
			//die;
			$tweet->ownerid	 =  $_SESSION['admin_info']['id'];
			$tweet->status	 = 0;
			$tweet->create();
			 $lastid=   $tweet->lastInsertId();
			$_SESSION['msgsuccess'] = "Tweet has been Scheduled successfully";   
			foreach($_POST['allgroup'] as $key=>$value)
			{
				$tweetergroup->tweetid= $lastid;
				$tweetergroup->groupname= $value;
				$tweetergroup->create();
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
							$notification->notification="New Tweet Has been Scheduled on ".$_POST['datetime']." Please update Statuss	";
						/* mail for group Notification */
						}
						else{
							$tweetuser->status=1;
							$notification->notification="New Tweet Has been Scheduled on ".$_POST['datetime'];
						}
						$tweetuser->create();
						$notification->userid=$user['id'];
						$notification->eventid=$lastid;
					
						$notification->type='Tweet';
						//$notification->notification=date('YYYY-MM-DD H:i:s');
						$notification->create();
						$headers = 'From: Tweet Autotweet' . "\r\n".'reply-to: no-reply'. "\r\n";
						$headers .= "MIME-Version: 1.0\r\n";
						$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

						
						$msg.='<p>'.	$notification->notification.'</p>';
					
						$msg.='<p>Regards <br/> '.website_name.'</p>';
		
					mail($user['email'], 'New Tweet has been Scheduled' , $msg,$headers );		 
						
				}
			
			}
			redirectAdmin('autotweet.php');
			
		
}
 if($_SESSION['admin_info']['type']==1){
		$allgroup = $group->getgroupbyowner();
   }
	else
	{
		$allgroup = $group->getgroupbyowner($_SESSION['admin_info']['id']);
	}
	?>
 <link href="<?php echo $config['ADMIN_URL']; ?>/css/bootstrapdatetimepicker.css" rel="stylesheet">
	            <!-- Right side column. Contains the navbar and content of the page -->
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
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                       Content Management
                        <small>Preview</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="autotweet.php">autotweet.php</a></li>
                        <li class="addautotweet.php">Add Tweet</li>
                    </ol>
                </section>
				
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-9">
                            <!-- general form elements -->
                            <!-- /.box-header -->
                                <!-- form start -->
                                    <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Add tweet</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" name="saveCategory" id="tweetform" method="post" action="" enctype='multipart/form-data'>
									<div class="form-group">
										<label for="exampleInputEmail1">Tweet Type</label>
										<input type="radio" placeholder="" id="tweettype" name="tweettype" class=" required" value='0' onclick='show()' checked>Tweet
										<input type="radio" placeholder="" id="tweettype" name="tweettype" class=" required" value='1' onclick='hide()'>ReTweet
									</div>
									<div class="box-body tweet">


										<div class='form-group' >
											<label for="exampleInputEmail1">Tweet Description</label>
											<textarea id="description" name="description" rows="10" cols="80" maxlength='140'></textarea>                        
										</div>
										<div class='form-group tweetimage' >
											<label for="exampleInputEmail1">Tweet Image</label>
											<input type="file" name="tweet_image"  />                        
										</div>
								

									</div><!-- /.box -->
									<div class="box-body retweet" style="display:none;">


										<div class='form-group'>
											<label for="exampleInputEmail1">ReTweet Url</label>
											<input id="retweetinput" name="retweet"  class='form-control ' maxlength='140'>                  
										</div>
										<div id='retweetdescription' class='form-group retweetdescription' >
											                      
										</div>
								

									</div><!-- /.box -->
									
									

									<div class="container">
										<div class="row">
											<div class='col-sm-6'>
												<label for="exampleInputEmail1">Date/time</label>
												<div class="form-group">
													<div class='input-group date' id='datetimepicker1'>
												
														<input type='text' placeholder="Date/time" id="mydatetime" name="datetime" class="form-control required"/>
														<span class="input-group-addon">
														<span class="glyphicon glyphicon-calendar"></span>
														</span>
													</div>
												</div>
											</div>

										</div>
									</div>
               
									<div class="box-body">
										<div class="form-group">
												<label for="exampleInputEmail1">Select Group</label>
											
											</div>
											 <?php foreach($allgroup as $key=>$value) { ?>
												 <div class="form-group col-md-3">
														<label for="exampleInputEmail1"><?php echo $value['title']; ?></label>
														<input type="checkbox" placeholder="Enter Group Name" id="catName"  name='allgroup[]' value='<?php echo $value['id']; ?>' class="  selectall required" >	
														
												  </div>										
											<?php } ?>
										
                                     </div>   

									<!-- /.box-body -->

									<div class="box-footer">
										<input class="btn btn-primary" type="submit" name="addtweet" value="Add Page">
									</div>
									
								</form>
									</div>
                             </div>
                    </div>  
                </section>
            </aside>
<?php
include_once('include/footer.php');

?> 


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
					if(res){
					$('#retweetdescription').html(res);
					}
				else{
					$('#retweetinput').val('');
					alert("Please enter Valid Tweet Url");
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
        </script>
