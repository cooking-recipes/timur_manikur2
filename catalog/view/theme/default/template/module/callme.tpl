
<?php if ($callme_setting['button_status'] && !isset($open)) { ?>
<!-- Callme-->
<div id="callme_button">
<a class="callme"></a>
</div>

<!-- END Callme-->

<?php } ?>

<?php if (!isset($open)) { ?>

<div id="callme_modal" class="modal fade " tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
       <div class="callme_load"></div>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
$(document).ready(function() {
	$('.callme').on('click', function() {
		var product_id = ($(this).data("product_id") > 0) ? $(this).data("product_id") : '';
		$('.callme_load').html('<iframe src="./index.php?route=module/callme/open&prod_id='+ product_id +'" width="340" height="'+<?php echo $callme_setting['height']; ?>+'" frameborder="0">Загрузка</iframe>');
			$('#callme_modal').modal('show');
	});
});
</script>
<?php } ?>



<?php if (isset($open)) { ?>

 <!DOCTYPE html>
<html dir="ltr" lang="ru">
<head>
<meta charset="UTF-8" />
<base href="<?php echo $base; ?>" />
 <link href="catalog/view/javascript/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen" />
 
<style type="text/css">
 body  {text-align: center; overflow:hidden;}
 #wrap{}
.form-horizontal .form-group  {margin:0 0 5px 0 !important;}
input {text-align:center;}
.ihomos {text-align:left;}
.bg-success {font-weight:bold !important; color:#287A27  !important; padding: 10px 0;}
.text-danger {font-weight:bold;}
.gdehomos{display:none;}

/*
label {color:#47A946  !important;}
button {background:#47A946  !important; color:#fff !important;}
button:hover {background:#3C963B   !important; color:#fff !important;}
*/

</style>

</head>

<body id="callme">
<div id="wrap"> 

	<h3><?php echo $heading_title; ?></h3>
	  
	  
	<form class="form-horizontal" role="form" action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" >

		<div class="form-group <?php echo ($error_name) ? 'has-error' :''; ?>" >
			<label for="name" class="col-sm-2 control-label"><?php echo $entry_name; ?></label>
			<div class="col-sm-10">
				<input type="text" class="form-control" id="name" name="name"  value="<?php echo $name; ?>" placeholder="<?php echo ($error_name) ? $error_name : $entry_name; ?>">
			</div>
		</div>
		 
		<div class="form-group <?php echo ($error_tel) ? 'has-error ' :''; ?>" >
			<label for="tel" class="col-sm-2 control-label"><?php echo $entry_tel; ?></label>
			<div class="col-sm-10">
				<input type="tel" class="form-control" id="tel" name="tel"  value="<?php echo $tel; ?>" placeholder="<?php echo ($error_tel) ? $error_tel : $entry_tel; ?>">
			</div>
		</div>
		  
		<?php if ($callme_setting['showfieldtime']) { ?>
		<div class="form-group" >
			<label for="time" class="col-sm-2 control-label"><?php echo $entry_time; ?></label>
			<div>
				<div class="col-xs-6">
				<input type="time" name="time1" class="form-control" value="<?php echo $time1; ?>"  />
				</div>

				<div class="col-xs-6">
				<input type="time" name="time2" class="form-control" value="<?php echo $time2; ?>"   />
				</div>
			</div>
		</div>
		<?php } ?>
		 
		<div class="form-group" >
			<label for="enquiry" class="col-sm-2 control-label"><?php echo $entry_enquiry; ?></label>
			<div class="col-sm-10">
				<textarea class="form-control" rows="3" id="enquiry" name="enquiry"  value="<?php echo $enquiry; ?>" > </textarea>
			</div>
		</div>
		  
		<input type="hidden" name="link_page" value="<?php echo ($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : ''; ?>" />
		<BR>
		<input type="text" class="gdehomos" name="gdehomos" value="<?php echo $gdehomos; ?>" />
		
		<?php if ($product_id) { ?>
		<input type="hidden" name="product_id" value="<?php echo $product_id; ?>" />
		<?php } ?>
		

		<?php if (isset($success)) { ?>
		<p class="bg-success"><?php echo $success; ?></p>
		<?php } else { ?>
			 
		<?php if ($callme_setting['capcha']) { ?>
		<div class="form-group <?php echo ($error_capcha) ? 'has-error ' :''; ?> ">

			<div class="col-xs-8 ihomos">
				<?php echo $qs; ?>
				<?php if ($error_capcha) { ?>
				<span class="text-danger"><?php echo $error_capcha; ?></span>
				<?php } ?>
			</div>
			<div class="col-xs-4">
				<?php echo $no; ?>:<input type="checkbox" name="irobot_no" value="0" checked="checked" /> <BR>
				<?php echo $yes; ?>:<input type="checkbox" name="irobot_yes" value="1"  />
			</div>
		</div>
		<BR>
		<?php } ?>	
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<button type="submit" class="btn btn-default"><?php echo $button_send; ?></button>
			</div>
		</div>
		<?php } ?>

	</form>
</div>
</body>
</html>


<?php } ?>