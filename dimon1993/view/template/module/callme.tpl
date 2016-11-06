<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
	<div class="container-fluid">
	  <div class="pull-right">
		<button type="submit" form="form-html" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
		<a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
	  <h1><?php echo $heading_title2; ?></h1>
	  <ul class="breadcrumb">
		<?php foreach ($breadcrumbs as $breadcrumb) { ?>
		<li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
		<?php } ?>
	  </ul>
	</div>
  </div>
  <div class="container-fluid">
	<?php if ($error_warning) { ?>
	<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
	  <button type="button" class="close" data-dismiss="alert">&times;</button>
	</div>
	<?php } ?>
	<div class="panel panel-default">
	  <div class="panel-heading">
		<h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
	  </div>
	  <div class="panel-body">
	   <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-html" class="form-horizontal">
		
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
				<label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
				<div class="col-sm-10">
				  <select name="callme_status" id="input-status" class="form-control">
					<?php if ($callme_status) { ?>
					<option value="1" selected="selected"><?php echo $text_enabled; ?></option>
					<option value="0"><?php echo $text_disabled; ?></option>
					<?php } else { ?>
					<option value="1"><?php echo $text_enabled; ?></option>
					<option value="0" selected="selected"><?php echo $text_disabled; ?></option>
					<?php } ?>
				  </select>
				</div>
				</div>
			</div>
			
			<div class="col-md-6">
				<table class="table table-bordered table-hover">
				<tr>
					<td><?php echo $text_sender; ?></td>
					<td>
					  <input type="text" class="form-control" name="callme_setting[sender]" value="<?php echo ($sender) ? $sender : 'Callme' ; ?>"  />
					</td>
				</tr>
				
				<tr>
					<td><?php echo $text_showfieldtime; ?></td>
					<td><?php if ($showfieldtime) { ?>
					  <input type="radio" name="callme_setting[showfieldtime]" value="1" checked="checked" />
					  <?php echo $text_yes; ?>
					  <input type="radio" name="callme_setting[showfieldtime]" value="0" />
					  <?php echo $text_no; ?>
					  <?php } else { ?>
					  <input type="radio" name="callme_setting[showfieldtime]" value="1" />
					  <?php echo $text_yes; ?>
					  <input type="radio" name="callme_setting[showfieldtime]" value="0" checked="checked" />
					  <?php echo $text_no; ?>
					  <?php } ?>
					  </td>
				</tr>
				  
				<tr>
					<td><?php echo $text_link_page; ?></td>
					<td><?php if ($link_page) { ?>
					  <input type="radio" name="callme_setting[link_page]" value="1" checked="checked" />
					  <?php echo $text_yes; ?>
					  <input type="radio" name="callme_setting[link_page]" value="0" />
					  <?php echo $text_no; ?>
					  <?php } else { ?>
					  <input type="radio" name="callme_setting[link_page]" value="1" />
					  <?php echo $text_yes; ?>
					  <input type="radio" name="callme_setting[link_page]" value="0" checked="checked" />
					  <?php echo $text_no; ?>
					  <?php } ?>
					</td>
				</tr>
				  
				  <tr>
					<td><?php echo $text_capcha; ?></td>
					<td><?php if ($capcha) { ?>
					  <input type="radio" name="callme_setting[capcha]" value="1" checked="checked" />
					  <?php echo $text_yes; ?>
					  <input type="radio" name="callme_setting[capcha]" value="0" />
					  <?php echo $text_no; ?>
					  <?php } else { ?>
					  <input type="radio" name="callme_setting[capcha]" value="1" />
					  <?php echo $text_yes; ?>
					  <input type="radio" name="callme_setting[capcha]" value="0" checked="checked" />
					  <?php echo $text_no; ?>
					  <?php } ?>
					</td>
				  </tr>
				  
				   <tr>
					<td><?php echo $text_button_page; ?></td>
								  
					  <td><?php if ($button_status) { ?>
					  <input type="radio" name="callme_setting[button_status]" value="1" checked="checked" />
					  <?php echo $text_yes; ?>
					  <input type="radio" name="callme_setting[button_status]" value="0" />
					  <?php echo $text_no; ?>
					  <?php } else { ?>
					  <input type="radio" name="callme_setting[button_status]" value="1" />
					  <?php echo $text_yes; ?>
					  <input type="radio" name="callme_setting[button_status]" value="0" checked="checked" />
					  <?php echo $text_no; ?>
					  <?php } ?>
					</td>
					</tr>

					<tr>
					 <td>
					 <?php echo $text_button_color; ?>
					 </td>
					 <td>
					 <?php if ($button_color) { ?>
					 <select class="form-control" name="callme_setting[button_color]">
						<option value="white"<?php if ($button_color=='white') echo ('selected="selected"');?>><?php echo $text_white; ?></option>
						<option value="green"<?php if ($button_color=='green') echo ('selected="selected"');?>><?php echo $text_green; ?></option>
						<option value="black"<?php if ($button_color=='black') echo ('selected="selected"');?>><?php echo $text_black; ?></option>
						<option value="pink" <?php if ($button_color=='pink') echo ('selected="selected"');?>><?php echo $text_pink; ?></option>
						<option value="blue" <?php if ($button_color=='blue') echo ('selected="selected"');?>><?php echo $text_blue; ?></option>
						<option value="yelow" <?php if ($button_color=='yelow') echo ('selected="selected"');?>><?php echo $text_yelow; ?></option>
					 </select>
					 <?php } else { ?>
					 <select name="callme_setting[button_color]">
						<option value="white" selected="selected"><?php echo $text_white; ?></option>
						<option value="green"><?php echo $text_green; ?></option>
						<option value="black"><?php echo $text_black; ?></option>
						<option value="pink"><?php echo $text_pink; ?></option>
						<option value="blue"><?php echo $text_blue; ?></option>
					 </select>			 
					  <?php } ?></td>
				  
				  </tr>
				</table>
			</div>
		</div>

	  </form>
	  </div>
	</div>
  </div>
  <div class="container-fluid">
  <div class="panel-default panel-body text-center">Callme ver 2.1 &copy; <a href="http://My2You.ru">My2You </a></div>
  </div>
</div>

<?php echo $footer; ?>