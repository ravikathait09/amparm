<?php
$usertime=explode(',',$_SESSION['user_info']['weekday']);

$usertimesettingobj= new usertimesetting();
$usertimearray=$usertimesettingobj->findcustom(array('userid'=>$_SESSION['user_info']['id']));
?>

<div id="content" >
<div id="scheduletime">
	<div class="js-profile-header">
		<div class="js-page-header page-header">
			<div class="page-header--title">
				<h2 class="page-header--heading">
					Your Schedule :
				</h2>		
			</div>
		</div>
	</div>
	<div id="scheduletime2">

			<div class="clearfix">
					<div id="timezone-selection">
					<span id="timezone-loading" style="display: none;"></span>

					<label for="timezone-autocomplete">Schedule Timezone</label>
					<select id="defaulttimezone" name="defaulttimezone">
						<option value="">Select Default Timezone</option>
						<?php foreach(tz_list() as $t) {  ?>
						<option <?php if($t['zone']==$_SESSION['user_info']['default_timezone']) echo 'selected'; ?>    value="<?php echo $t['zone'] ?>">
						<?php print $t['diff_from_GMT'] . ' - ' . $t['zone'] ?>
						</option>
						<?php } ?>
					</select>
					
				</div>
			
				<div class="schedule-instructions">
					<p>
						So, Recommended Feed Will be Posted according to your category will be Posted at These time which you selected.
					</p>
					<p>
						Perhaps keen for 24 hour time?
						<a href="/app/account/time" class="js-navigate">You can change it here.</a>
					</p>
				</div>
			</div>

			<div id="advanced-scheduling">
				
					<form action="" method="post" id="scheduledposttime">
						<ul class="nav nav-tabs">

						<li class="active" id="schedule-c3">
							<div id="schedule-days-table">
								<div id="schedule-days" class="ui-buttonset">
									<input type="checkbox" id="day1" value="1" name="schedule-days[]" class="day" <?php if(in_array(1,$usertime)) echo 'checked'; ?>>
									<label for="day1" class="" ><span class="ui-button-text">Monday</span></label>
									
									<input type="checkbox" id="day2" value="2" name="schedule-days[]" class="day" <?php if(in_array(2,$usertime)) echo 'checked'; ?>>
									<label for="day2" class="" ><span class="ui-button-text">Tuesday</span></label>
									
									<input type="checkbox" id="day3" value="3" name="schedule-days[]" class="day" <?php if(in_array(3,$usertime)) echo 'checked'; ?>>
									<label for="day3" class="" ><span class="ui-button-text">Wednesday</span></label>
									
									<input type="checkbox" id="day4" value="4" name="schedule-days[]" <?php if(in_array(4,$usertime)) echo 'checked'; ?>  class="day">
									<label for="day4" class=""><span class="ui-button-text">Thursday</span></label>
									<input type="checkbox" id="day5" value="5" name="schedule-days[]" <?php if(in_array(5,$usertime)) echo 'checked'; ?> class="day">
									<label for="day5" class=""><span class="ui-button-text">Friday</span></label>
									
									<input type="checkbox" id="day6" value="6" name="schedule-days[]" <?php if(in_array(6,$usertime)) echo 'checked'; ?> class="day">
									<label for="day6" class="" ><span class="ui-button-text">Saturday</span></label>
									
									<input type="checkbox" id="day7" value="7" name="schedule-days[]" <?php if(in_array(7,$usertime)) echo 'checked'; ?> class="day">
									<label for="day7" class="" ><span class="ui-button-text">Sunday</span></label>
								</div>
							</div>

						</li>
						</ul>

						<ol id="schedule-times">
							<?php
							if(!empty($usertimearray)){
							foreach($usertimearray as $key=>$value){ ?>
							
								<li>
								<i class="ss-icon">?</i>
								<select style="width: 60px" class="hour" name="hourday[]">
								<?php for($i=1;$i<=12;$i++)
									
								{?>
								<option value="<?php echo $i ; ?>" <?php if($value['hour']==$i) { echo 'selected';} ?>><?php echo $i ; ?> </option>
								<?php } ?>
								</select>
								<select style="width: 60px" class="min" name="minute[]">
								<?php for($i=0;$i<60;$i++)
								{ ?>
								<option value="<?php echo $i ; ?>" <?php if($value['minute']==$i) { echo 'selected';} ?>><?php echo $i ; ?></option>
								<?php } ?>
								</select>
								<select style="width: 60px" class="mn" name="ampm[]">
								<option value="am" <?php if($value['mornight']=='am') { echo 'selected';} ?>>AM</option>
								<option value="pm" <?php if($value['mornight']=='pm') { echo 'selected';} ?>>PM</option>
								</select>
								<a href="javascript:;" class="btn-primary button" onclick="removetime(this)" original-title="Remove posting time">X</a>
								</li>
							
							<?php
							}
							}else{
								$h=0;
								for($j=0;$j<4;$j++)
								{ $h=$h+2; 
							
									?>
									<li>
										<i class="ss-icon">?</i>
										<select style="width: 60px" class="hour" name="hourday[]">
										<?php for($i=1;$i<=12;$i++)
										{?>
										<option value="<?php echo $i ; ?>" <?php if($h==$i) { echo 'selected';} ?>><?php echo $i ; ?></option>
										<?php } ?>
										</select>
										<select style="width: 60px" class="min" name="minute[]">
										<?php for($i=0;$i<60;$i++)
										{ ?>
										<option value="<?php echo $i ; ?>"><?php echo $i ; ?></option>
										<?php } ?>
										</select>
										<select style="width: 60px" class="mn" name="ampm[]">
										<option value="am">AM</option>
										<option value="pm">PM</option>
										</select>
										<a href="javascript:;"  class="btn-primary button" onclick="removetime(this)" original-title="Remove posting time">X</a>
									</li>
								<?php
								}
							}
							?>

							
						</ol>
						<a class="btn-primary button" onclick="myclone(this)" id="add-time">Add Posting Time</a>
					
					</form>
					
							
				</ul>
			</div>
		</div>
</div></div>
<script>

function myclone(obj)
{

	var html=$('#maindiv').html();
	jQuery('#schedule-times').append(html);
	
}
function removetime(obj)
{
	jQuery(obj).parent().remove();
	settingformsubmit();
}


function settingformsubmit()
{
	count_checked = $("[name='schedule-days[]']:checked").length;
	
	 if(count_checked)
	 {
	var formData = $('#scheduledposttime').serialize();
    $.ajax({
		type:'post',
		url:'ajax.php',
		data:  formData,		
		success:function(res){	
			$('#status-area').show();
			$('#status-area').flash_message({
			text: 'Your Time Setting has been Successfully Submited',
			how: 'append'
			});
		}
	});
	 }
	 else
	 {
		  alert("Please Select arleast one check box");
		 
	 }
}

</script>
<div id="maindiv" data-index="0" style="display:none">
	<li>
			<i class="ss-icon">?</i>
			<select style="width: 60px" class="hour" name="hourday[]">
				<?php for($i=1;$i<=12;$i++)
					{?>
					<option value="<?php echo $i ; ?>"><?php echo $i ; ?></option>
				<?php } ?>
			</select>
			<select style="width: 60px" class="min" name="minute[]">
				<?php for($i=0;$i<60;$i++)
					{ ?>
					<option value="<?php echo $i ; ?>"><?php echo $i ; ?></option>
				<?php } ?>
			</select>
			<select style="width: 60px" class="mn" name="ampm[]">
			<option value="am">AM</option>
			<option value="pm">PM</option>
			</select>
			<a href="javascript:;"  class="btn-primary button" onclick="removetime(this)" original-title="Remove posting time">X</a>
	</li>
</div>
