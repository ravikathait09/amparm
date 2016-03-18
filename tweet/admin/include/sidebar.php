<aside class="left-side sidebar-offcanvas">
	<section class="sidebar">
		<!-- Sidebar user panel -->
		<div class="user-panel">
			<div class="pull-left image">
				<img src="img/avatar3.png" class="img-circle" alt="User Image" />
			</div>
			<div class="pull-left info">
				<p>Hello, <?php echo $_SESSION['admin_info']['firstname'] ;?></p>
				<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
			</div>
		</div>
		
		<ul class="sidebar-menu">
			
			<!--<li>
				<a href="settings.php">
					<i class="fa fa-th"></i> <span>General Settings</span> <small class="badge pull-right bg-green">new</small>
				</a>
			</li>-->
			<?php if($_SESSION['admin_info']['type']==1) { ?>
			<li class="treeview">
				<a href="#">
					<i class="fa fa-dashboard"></i> <span>User Management</span> <i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu menu-open" style="display: block;">
					<li><a href="userManagement.php"><i class="fa fa-circle-o"></i>  Manage User</a></li>
					<li class=""><a href="userManagement.php?grouppermission"><i class="fa fa-circle-o"></i>Group Permission  </a></li>
				</ul>
			</li>
			<?PHP } ?>
		
			
			<li class="">
				<a href="autotweet.php">
					<i class="fa fa-th"></i> <span> Auto Tweet Management</span>
				</a>
           		
			</li>
				<li class="treeview">
				<a href="managegroup.php">
					<i class="fa fa-bar-chart-o"></i>
						<span>Manage Group</span>
			
				</a>
				
			</li>
			<li class="treeview">
				<a href="category.php">
					<i class="fa fa-bar-chart-o"></i>
						<span>Manage Category</span>
			
				</a>
				
			</li>
			<li class="treeview">
				<a href="contact.php">
					<i class="fa fa-bar-chart-o"></i>
						<span>Manage Contact</span>
			
				</a>
				
			</li>
			
                </ul>
			
	</section>
</aside>
