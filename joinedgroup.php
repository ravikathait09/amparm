<?php

$fileBasePath = dirname(__FILE__).'/';
include_once('include/header.php');
include_once("inc/twitteroauth.php");

$user=new User();
if(!isset($_SESSION['user_info']['id'])){
	header('Location: logout.php');
	exit;
}

$userdetail=$user->findcustomrow(array('id'=>$_SESSION['user_info']['id'] ));
$groupuser  = new groupuser();

$group  = new Group();
$screenname 		=$userdetail['screen_name'];
$allgroup=$groupuser->findgroupbyuser($_SESSION['user_info']['id']);
	
include('include/head.php');
include('include/sidebar.php');
 ?>
             <!--Body content-->
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
	   <section class="content-header">
                    <h3>
                        Joined Group
                       
                    </h3>
                    <ol class="breadcrumb">
                        <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
                       
						
                    </ol>
      </section>
    <section class="content">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-12">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                    <div class="box-body">
										
			<?php $i=0; foreach($allgroup as $k=>$value){  $i++;?>
						<div id="group-<?php echo $value['id'] ?>">
						<div class="col-md-8">
							<div class="profile-info bt">
							<img  src="<?php echo 'img/'.$value['icon'] ?>"  alt=""class="twitter-widget-avatar" width="50px"><br/>
								<h5 class="text-muted"><?php echo $value['title'] ?> </h5>
								<p><?php echo $value['descripition'] ?></p>
								<br/>
								<P> <b>Total Point:</b> <?php echo $value['point'] ?>
							</div>
						</div>  
						<div class="col-md-4 bt p10">
						    <div class="col-md-6">
							  <h4>Auto Tweet</h4>
							  <div class="btn-group btn-toggle"> 
								<button class="btn btn-xs btn-default <?php if($value['group_notification']) {echo 'active btn-primary'; }?>"  onclick='autotweet("<?php echo $value['id'] ?>","1")' name="autotweet_<?php echo $value['id'] ?>">ON</button>
								<button  onclick='autotweet("<?php echo $value['id'] ?>","0")' class="btn btn-xs  <?php if(!$value['group_notification']) {echo 'active btn-primary'; }?>">OFF</button>
							  </div>
							</div>
							<div class="col-md-6">
							  <dt class="mt20">
							  <button type="button" onclick='removegroup("<?php echo $value['id'] ?>")'  class="btn btn-danger">Leave Group</button>
							  </dt>
							</div>
							<!--<dl class="mt20">
								<!--<dt class="text-muted"><input type="radio"  value='1'  onclick='autotweet("<?php echo $value['id'] ?>","1")' name="autotweet_<?php echo $value['id'] ?>" <?php if($value['group_notification']) {echo 'checked'; }?>>Auto Tweet</dt>
								<dt class="text-muted"><input type="radio" value='0'  onclick='autotweet("<?php echo $value['id'] ?>","0")' <?php if(!$value['group_notification']) {echo 'checked'; }?> name="autotweet_<?php echo $value['id'] ?>"> Confirm Before Tweet</dt>
								<dt class="text-muted"><button type="button" onclick='removegroup("<?php echo $value['id'] ?>")'  class=btn btn-info">Leave Group</button></dt>
													  
							</dl>-->
						</div>
						</div>
						<?php
						}
					?>
                                    </div><!-- /.box-body -->
                            </div><!-- /.box -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
				</aside>
				</div>
				</div>
<?php include('include/footer.php'); 	?>
<script>
$('.btn-toggle').click(function() {
    $(this).find('.btn').toggleClass('active');  
    
    if ($(this).find('.btn-primary').size()>0) {
    	$(this).find('.btn').toggleClass('btn-primary');
    }
    if ($(this).find('.btn-danger').size()>0) {
    	$(this).find('.btn').toggleClass('btn-danger');
    }
    if ($(this).find('.btn-success').size()>0) {
    	$(this).find('.btn').toggleClass('btn-success');
    }
    if ($(this).find('.btn-info').size()>0) {
    	$(this).find('.btn').toggleClass('btn-info');
    }
    
    $(this).find('.btn').toggleClass('btn-default');
       
});

$('form').submit(function(){
	alert($(this["options"]).val());
    return false;
});
</script>
<script>
function autotweet(id,status)
{
	$.ajax({
		type:'post',
		url:'ajax.php',
		data:  {groupid:id,curstatus:status},
		success:function(res){	
			alert('Status has been changed');
			/*$('#description').val(res);*/
		}
	});
	
}
function removegroup(id)
{
		$.ajax({
		type:'post',
		url:'ajax.php',
		data:  {group:id,userid:'<?php echo $_SESSION['user_info']['id'] ?>'},
		success:function(res){	

			$('#group-'+id).remove();
		}
	});
}
</script>