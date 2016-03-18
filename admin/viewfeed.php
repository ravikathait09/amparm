<?php
/**
*	THIS FILE IS FOR ADMIN LOGIN LOGOUT	5/4/2014                                    
**/
$fileBasePath = dirname(__FILE__).'/';                                              
include_once('include/header.php');
include_once('include/sidebar.php');                                   
/*
*	Redirect Admin To Home Page
*	If Already Logged In
*/

if(!isset($_SESSION['admin_info'])){                              
	header('Location: logout.php');
}
$main= new Main();
$blogurl=new blogurl();
  $CategoryUrl  =new CategoryUrl(); 
   $allfeed =ARRAY();
   if(isset($_GET['catid']))
   {
	   $catid=$_GET['catid'];
	   $allurl=$CategoryUrl->findcustom(array('catid'=>$catid));
	   foreach($allurl as $key=>$value)
	   {
		   $str[]=$value['id'];
	   }
   }
   if(isset($_GET['blogid']))
   {
	    $str[]=$_GET['blogid'];
   }
   #print_R($str);
    $sql="select * from urlblog where urlid in(".implode(',',$str).")";
   $blogfeed=$main->runsql($sql);
?>
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
                        User Management
                        <small>Preview</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">User management</li>
                    </ol>
                </section>

                <!-- Main content -->
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
										<table class="table table-bordered" id="userTable" >
                                        <thead><tr>
                                            <th style="width: 10px">#</th>
                                            <th>Url</th>
                                           <th>Title</th>
											<th>FB Share</th>
											<th>FB Like</th>
											<th>FB Comment</th>
											<th>FB Click</th>
                                            <th>Google Count</th>
											<th>Pin interest Count</th>
											<th>LInkdin Count </th>
											<th>Total Count </th>
                                        </tr>
										</thead>
										<tbody>
<?php $i=0;
					foreach($blogfeed as $k=>$userData){
						$i++;
						
					
							?>

						<tr>
							<td><?php echo $i; ?></td>
							<td><?php echo $userData['blogurl'] ?></td>
							<td><?php echo $userData['title']; ?></td>
							<td><?php echo $userData['share_count']; ?></td> 
							<td><?php echo $userData['like_count']; ?></td> 
							<td><?php echo $userData['comment_count']; ?></td>
							<td><?php echo $userData['click_count']; ?></td> 
							<td><?php echo $userData['google_count']; ?></td> 
							<td><?php echo $userData['pininterest_count']; ?></td> 
							<td><?php echo $userData['linkdin_count']; ?></td>
							<!--<td><?php echo $userData['tweetcount']; ?></td> -->
							<td><?php echo $userData['total_count']; ?></td> 
							                                                                                                  
						</tr>                                                                                
						<?php
						
					}
					?>
                                    </tbody>
									</table>
                                    </div><!-- /.box-body -->
                            </div><!-- /.box -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
<?php
include_once('include/footer.php');

?>
