 <div id="sidebarbg" class="hidden-lg hidden-md hidden-sm hidden-xs"></div>
	<div id="sidebar" class="page-sidebar hidden-lg hidden-md hidden-sm hidden-xs">
		<!--<div class="shortcuts">
			<ul>
				<li><a href="support.html" title="Support section" class="tip"><i class="s24 icomoon-icon-support"></i></a>
				</li>
				<li><a href="#" title="Database backup" class="tip"><i class="s24 icomoon-icon-database"></i></a>
				</li>
				<li><a href="charts.html" title="Sales statistics" class="tip"><i class="s24 icomoon-icon-pie-2"></i></a>
				</li>
				<li><a href="#" title="Write post" class="tip"><i class="s24 icomoon-icon-pencil"></i></a>
				</li>
			</ul>
		</div>-->
	<!-- End search -->
	<!-- Start .sidebar-inner -->
		<div class="sidebar-inner">
			<!-- Start .sidebar-scrollarea -->
			<div class="sidebar-scrollarea">
				<div class="sidenav">
					<div class="sidebar-widget mb0">
						<h6 class="title mb0">Navigation</h6>
					</div>
					<!-- End .sidenav-widget -->
					<div class="mainnav">
						<ul>
							<li><a href="dashboard"><i class="s16 icomoon-icon-screen-2"></i><span class="txt">Dashboard</span> </a>
							</li>
							<li><a href="joinedgroup"><i class="s16 icomoon-icon-screen-2"></i><span class="txt">Joined Group</span> </a>
							</li>
							<?php if($_SESSION['user_info']['manage_group']!=1){ ?>
							<li><a  href="#" data-toggle="modal" data-target="#modal-style5"><i class="s16 icomoon-icon-screen-2"></i><span class="txt">Manage Group</span> </a>
							<?php } else { ?>
							<li><a href="managegroup"><i class="s16 icomoon-icon-screen-2"></i><span class="txt">Manage Group</span> </a>
							</li>
							<li><a href="tweet"><i class="s16 icomoon-icon-screen-2"></i><span class="txt">Amplify</span> </a>
							</li>
							<?php } ?>
						
							
							
						</ul>
					</div>
				</div>
				<!-- End sidenav -->
				
				
				
			</div>
			<!-- End .sidebar-scrollarea -->
		</div>			
	<!-- End .sidebar-inner -->
	</div>
	 <div id="right-sidebarbg" class="hidden-lg hidden-md hidden-sm hidden-xs"></div>
            <!-- Start #right-sidebar -->
            <aside id="right-sidebar" class="right-sidebar hidden-lg hidden-md hidden-sm hidden-xs">
                <!-- Start .sidebar-inner -->
                <div class="sidebar-inner">
                    <!-- Start .sidebar-scrollarea -->
                   
                    <!-- End .sidebar-scrollarea -->
                </div>
                <!-- End .sidebar-inner -->
            </aside>
			<div class="modal fade modal-style5" id="modal-style5" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">
								<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
							</button>
							<h4 class="modal-title" id="mySmallModalLabel">Manage Group</h4>
						</div>
						<div class="modal-body">
							<?php if($_SESSION['user_info']['manage_group']==0){ ?>
							<p id="ptagbody">to manage group first you have to approve user from admin. after that you can create /manage group</p>
							<?PHP } else if($_SESSION['user_info']['manage_group']==2){ ?>
							<p>You Request has been pending to admin. Admin will approve it. </p>
							<?php } else if($_SESSION['user_info']['manage_group']==3){ ?>
							<p>Your Group Request has been Cancelled </p>
							<?php } ?>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							<?php if(!$_SESSION['user_info']['manage_group']){ ?>
							<button onclick="managegroup('this')" type="button" class="btn btn-primary">Send Group Request </button>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
