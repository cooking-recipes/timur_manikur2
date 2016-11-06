
<div style='display:block'>
		
		<div class='contact-content'>
		<?php if (($block_name_phone[$lang_id]['block_name_phone'] != '') || ($mob !='') || ($mob2 !='') || ($mob3 !='') || ($config_skype !='')) { ?>
			
			<div class="contact-right">
			 
					<?php if ($block_name_phone[$lang_id]['block_name_phone'] != ''){?>
						<div class="contact-title">	
							<?php echo $block_name_phone[$lang_id]['block_name_phone']; ?>						
						</div>
					<?php }?>
				<div class="content-right">
					<?php if ($mob !='') {?>
						<div class="mob">
						<i style="width:17px; font-size:24px; padding-left:2px; color:#<?php echo $background_phone1 ;?>"  class="fa fa-mobile"></i>	
							<?php echo $mob; ?>
						</div>
					<?php } ?>
					
					<?php if ($mob2 !='') {?>
						<div class="mob">
						<i style="width:17px; font-size:24px; padding-left:2px; color:#<?php echo $background_phone1 ;?>" class="fa fa-mobile"></i>	
							<?php echo $mob2; ?>
						</div>
					<?php } ?>
					<?php if ($mob3 !='') {?>
						<div class="mob">
						<i style="width:20px; font-size:16px; color:#<?php echo $background_phone3 ;?>" class="fa fa-print"></i>

							<?php echo $mob3; ?>
						</div>
					<?php } ?>
					<?php if ($config_skype !='') {?>
					<div class="skype">
					<i style="width:20px; font-size:16px; color:#<?php echo $color_skype;?>" class="fa fa-skype"></i>
					<?php echo $config_skype; ?>
					<?php if($delete_status_skype_from_site =='1'){?>
					<?php $timenow = date("H:i");?>
					
					<?php if(($timenow > $time_start_skype) && ($timenow < $time_end_skype)) { ?>
						<a class="status_skype" href="skype:?chat"><img src="catalog/view/theme/default/image/classic_transparent_online.png"></a>
					<?php } else { ?>
						<a class="status_skype" href="skype:?chat"><img src="catalog/view/theme/default/image/classic_transparent_offline.png"></a>
					<?php } ?>
					<?php } ?>
					</div>
					<?php } ?>
					<?php if ($config_email_1 !='') {?>
					<div class="email">
					<i style="width:20px; font-size:16px; color:#<?php echo $color_email;?>" class="fa fa-envelope-o"></i>
						<?php echo $config_email_1; ?>
					</div>
					<?php } ?>
					<?php if ($config_title_schedule[$lang_id]['config_title_schedule'] != ''){?>
					<div class="title-schedule">
					
							<i style="width:20px; font-size:16px; color:#<?php echo $color_clock;?>" class="fa fa-clock-o"></i>
							<span><?php echo $config_title_schedule[$lang_id]['config_title_schedule']; ?></span>
						
					</div>
					<?php }?>
					<?php if ($config_daily[$lang_id]['config_daily'] != ''){?>
					<div>
						
							<span><?php echo $config_daily[$lang_id]['config_daily']; ?></span>
						
					</div>
					<?php }?>
					<?php if ($config_weekend[$lang_id]['config_weekend'] != ''){?>
					<div>
						
							<span><?php echo $config_weekend[$lang_id]['config_weekend']; ?></span>
						
					</div>
					<?php }?>
					<div class="social">
					<?php foreach($social_icons_contact as $social_icon) { ?>
						<a href="http://<?php echo $social_icon['name']; ?>" target="_blank"><span class="social_icon"><img src="<?php echo $social_icon['thumb']; ?>"/></span></a>
					<?php } ?>
					</div>
					
					</div>
			</div>
			<?php } ?>
			<?php if ($img_left_callback != '') {?>
			<div class="image_left"><img class="img-phone-contact" src="<?php echo $img_left_callback; ?>"/></div>
			<?php } ?>
	<?php if (($block_name_phone[$lang_id]['block_name_phone'] != '') || ($mob !='') || ($mob2 !='') || ($mob3 !='') || ($config_skype !='')) {  ?>		
<div class="content-left-50">
<?php } else { ?>
<div class="content-left-100">
<?php } ?>
                <div class="contact-title"><?php echo $config_title_callback_sendthis[$lang_id]['config_title_callback_sendthis']; ?></div>
                <div class='contact-loading' style='display:block'></div>
                <div class='contact-message' style='display:block'></div>
        <form id="data" style='display:block'>
		  <div style="margin:10px 5px;">
		    <div  class="contact-data">
		      <div>
					<div>			
						<label for='contact-name'><span style="color:red;">*</span> <?php echo $namew; ?></label>
						<div id="error_name" class="error_callback"></div>
					</div>
					<div>
						<input type="text" id="contact-name" class="contact-input" placeholder="<?php echo $namew; ?>" name="name" tabindex="1001" />
					</div>
		      </div>
		      <div>
					<div>			
                        <label for='contact-phone'><span style="color:red;">*</span> <?php echo $phonew; ?></label>
						<div id="error_phone" class="error_callback"></div>
					</div>

					<div>
                        <input type="text" id="contact-phone" placeholder="7(123) 456-78-90" class="contact-input" name="phone" tabindex="1002" />
					</div>
		      </div>
			  <div>
					<div>			
						<?php echo $email_buyer; ?>
					</div>
					<div>
                         <input type="text" id="contact-email" class="contact-input" placeholder="<?php echo $email_buyer; ?>" name="email_buyer" tabindex="1003" />
					</div>
		      </div>
			  <!--ADD DATE TIME-->
			  <?php if($config_on_off_date_time == 1) { ?>
			  <div class="date_time_callback">
					<div> <?php echo $when_you_call_back;?></div>
					<!--<input type="text" name="date_callback" value="" class="date_callback" placeholder="Friday 27/02/2015" size="18" />-->
					<input type="text" name="time_callback_on" value="" class="time_callback start" placeholder="2015-05-25 15:30" size="14" />
					<input type="text" name="time_callback_off" value="" class="time_callback end" placeholder="2015-05-25 18:30" size="14" />
			  </div>
			  <?php } else { ?>
			  <style>
				.contact-textarea {height:100px !important}
			  </style>
			  <?php } ?>
			   <!--END DATE TIME-->
			   <?php if(!empty($call_topic)) {?>
			   <?php echo $text_topic_callback?>
			   <div class="topic_callback">
						<select name="topic_callback_send">
							<option></option>
							<?php foreach($call_topic as $res_call_topic) { ?>
								<option value="<?php echo $res_call_topic['name']?>"><?php echo $res_call_topic['name']?></option>
							<?php } ?>
						</select>	
			   </div>
			   <?php } ?>
			  <div>
					<div>			
                         <?php echo $comment_buyer; ?>
						<div id="error_phone" class="error"></div>
					</div>
					<div> 
						<textarea name="comment_buyer" id="contact-phone" class="contact-textarea"  cols="40" rows="5" placeholder="<?php echo $text_you_comment;?>" tabindex="1004"></textarea>
					</div>
		      </div>
					<input type="hidden" id="callback_url" value="" name="url_site"  />
		    </div>
		  </div>

    </form>
</div>
<div class="contact-success">
    <div class="success_callback" style="display:none;margin-top:10px;"></div>
</div>
<div class="button-send" style="clear:both;">
          <label>&nbsp;</label>
          <button type='button' class='contact-send contact-button' tabindex='1006' style="background:#<?php echo $background_button_callback;?>" onmouseover="this.style.background = '#<?php echo $background_button_callback_hover;?>'"; onmouseout="this.style.background = '#<?php echo $background_button_callback;?>'"><i style="width:30px; font-size:24px; "  class="fa fa-phone-square"></i><?php echo $button_send; ?></button>
	</div>
        </div>
        <div class='contact-bottom'></div>
<script type="text/javascript">
	$('.start').datetimepicker({
		format:'Y-m-d H:i',
		lang: 'ru',
	});
	$('.end').datetimepicker({
		format:'Y-m-d H:i',
		lang: 'ru',
	});
</script>		
<script type="text/javascript"><!--
$('.contact-send').bind('click',function() {
		var success = 'false';
		$('#callback_url').val(window.location.href);
		$.ajax({
			url: 'index.php?route=module/callback',
			type: 'post',
			data: $('#data').serialize() + '&action=send',
			dataType: 'json',
			beforeSend: function() {
				$('#subm').bind('click', false);
			},
			complete: function() {
				$('#subm').unbind('click', false);
				if (success == 'true'){
//					setTimeout = ($.colorbox.remove(),1500);
				}
			},
			success: function(json) {
				$('#error_name').empty();
				$('#error_phone').empty();
				$('.success_callback').hide();

				if (json['warning']) {
					if (json['warning']['name']) {
						$('#error_name').html(json['warning']['name']);
						
					}
					if (json['warning']['phone']) {
						$('#error_phone').html(json['warning']['phone']);
						
					}
				}
				if (json['success']){ 
					$('.success_callback').html(json['success']);
					$('.success_callback').show('slow');
					success = 'true';
					setTimeout(function () { $.colorbox.close()},2000);

				} 
			}

		});

});

$('.contact-cancel').bind('click',function() {
	$.colorbox.close()
});
//--></script> 
<script type="text/javascript">
$(document).ready(function() {
    $("#contact-phone").mask("9(999) 999-99-99");
});
</script>
</div>
