<?php
$fileBasePath = dirname(__FILE__).'/';
	   }
 ?>
		<aside class="right-side">
		if(isset($_SESSION['msgsuccess'])){
	 <div class="heading">
    <section class="content">
       <div class="row">
						
						<tr>
							<td><?php echo $i; ?></td>
							<td><?php echo $groupdata['title']; ?></td>
							<!--<td><?php echo $groupdata['descripition']; ?></td>-->
							
							<td><?php echo $groupdata['firstname'];  ?></td>
							<td>
								<a class="" href="<?php echo $config['SITE_URL']."managegroup.php?groupid=".$groupdata['id'];?>"><i class="fa fa-edit"></i></a>
								&nbsp;&nbsp;
								<a title="view Group Member"  class="" href="<?php echo $config['SITE_URL']."userlist.php?TYPE=GROUP&id=".$groupdata['id'];?>"><i class="eco-users" aria-hidden="true"></i></a>
								
							</td>                                                                        
						</tr>                                                                                
						<?php
						}
					?>
                                    </tbody>
									</table>
                                    </div><!-- /.box-body -->
                            </div><!-- /.box -->
                    </div>   
                </section><!-- /.content -->
				</aside>
<?php include('include/footer.php'); 	?>