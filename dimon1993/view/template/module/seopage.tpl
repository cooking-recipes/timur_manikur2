<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-seopage" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
    <h1><?php echo $heading_title; ?></h1>
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
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-seopage" class="form-horizontal">

		<ul class="nav nav-tabs">
		  <li class="active"><a data-toggle="tab" href="#home"><?php echo $header_1;?></a></li>
		  <li><a data-toggle="tab" href="#menu1">Meta</a></li>
		  <li><a data-toggle="tab" href="#menu2">Redirect</a></li>
		  <li><a data-toggle="tab" href="#menu3">H1/Content</a></li>
		</ul>


	<div class="tab-content">
		<div id="home" class="tab-pane fade in active">		
          <div class="form">
            <label class="col-sm-3 control-label"><span data-toggle="tooltip" title="<?php echo $help_google; ?>"><?php echo $entry_google; ?></span></label>
            <div class="col-sm-9">
              <label class="radio-inline">
                <?php if ($seopage_google) { ?>
                <input type="radio" name="seopage_google" value="1" checked="checked" />
                <?php echo $text_yes; ?>
                <?php } else { ?>
                <input type="radio" name="seopage_google" value="1" />
                <?php echo $text_yes; ?>
                <?php } ?>
              </label>
              <label class="radio-inline">
                <?php if (!$seopage_google) { ?>
                <input type="radio" name="seopage_google" value="0" checked="checked" />
                <?php echo $text_no; ?>
                <?php } else { ?>
                <input type="radio" name="seopage_google" value="0" />
                <?php echo $text_no; ?>
                <?php } ?>
              </label>
            </div>
          </div>	
		
		  <div class="form">
            <label class="col-sm-3 control-label"><span data-toggle="tooltip" title="<?php echo $help_yandex; ?>"><?php echo $entry_yandex; ?></span></label>
            <div class="col-sm-9">
              <label class="radio-inline">
                <?php if ($seopage_yandex) { ?>
                <input type="radio" name="seopage_yandex" class="yes" value="1" checked="checked" />
                <?php echo $text_yes; ?>
                <?php } else { ?>
                <input type="radio" name="seopage_yandex" class="yes" value="1" />
                <?php echo $text_yes; ?>
                <?php } ?>
              </label>
              <label class="radio-inline">
                <?php if (!$seopage_yandex) { ?>
                <input type="radio" name="seopage_yandex" class="no" value="0" checked="checked" />
                <?php echo $text_no; ?>
                <?php } else { ?>
                <input type="radio" name="seopage_yandex" class="no" value="0" />
                <?php echo $text_no; ?>
                <?php } ?>
              </label>
            </div>			
		  </div>
		
		  <div class="form follow" id="follow">
            <div class="col-sm-9 col-sm-offset-3">
              <label class="radio-inline">
                <?php if ($seopage_follow) { ?>
                <input type="radio" name="seopage_follow" value="1" checked="checked" />
                <?php echo $text_follow; ?>
                <?php } else { ?>
                <input type="radio" name="seopage_follow" value="1" />
                <?php echo $text_follow; ?>
                <?php } ?>
              </label>
              <label class="radio-inline">
                <?php if (!$seopage_follow) { ?>
                <input type="radio" name="seopage_follow" value="0" checked="checked" />
                <?php echo $text_nofollow; ?>
                <?php } else { ?>
                <input type="radio" name="seopage_follow" value="0" />
                <?php echo $text_nofollow; ?>
                <?php } ?>
              </label>
            </div>			
		  </div>

		  <div class="form">
            <label class="col-sm-3 control-label" for="seopage_canonicals"><span data-toggle="tooltip" title="<?php echo $help_canonicals; ?>"><?php echo $entry_canonicals; ?></span></label>
            <div class="col-sm-9">
              <input type="text" name="seopage_canonicals" value="<?php echo $seopage_canonicals; ?>" id="seopage_canonicals" class="form-control" />
            </div>
          </div>
		  
		</div>	
		
		<div id="menu1" class="tab-pane fade">
		
		  <div class="form">
            <label class="col-sm-3 control-label"><span data-toggle="tooltip" title="<?php echo $help_description; ?>"><?php echo $entry_description; ?></span></label>
            <div class="col-sm-9">
              <label class="radio-inline">
                <?php if ($seopage_description) { ?>
                <input type="radio" name="seopage_description" value="1" checked="checked" />
                <?php echo $text_yes; ?>
                <?php } else { ?>
                <input type="radio" name="seopage_description" value="1" />
                <?php echo $text_yes; ?>
                <?php } ?>
              </label>
              <label class="radio-inline">
                <?php if (!$seopage_description) { ?>
                <input type="radio" name="seopage_description" value="0" checked="checked" />
                <?php echo $text_no; ?>
                <?php } else { ?>
                <input type="radio" name="seopage_description" value="0" />
                <?php echo $text_no; ?>
                <?php } ?>
              </label>
            </div>
          </div>
		
		  <div class="form">
            <label class="col-sm-3 control-label" for="seopage_metapattern"><span data-toggle="tooltip"><?php echo $entry_metapattern; ?></span></label>
            <div class="col-sm-9">
              <input type="text" name="seopage_metapattern" value="<?php echo $seopage_metapattern; ?>" id="seopage_metapattern" class="form-control" />
              <p><?php echo $text_metapattern; ?></p>
            </div>
          </div>	
		
		  <div class="form">
            <label class="col-sm-3 control-label"><span data-toggle="tooltip" title="<?php echo $help_page; ?>"><?php echo $entry_page; ?></span></label>
            <div class="col-sm-9">
              <label class="radio-inline">
                <?php if ($seopage_page) { ?>
                <input type="radio" name="seopage_page" value="1" checked="checked" />
                <?php echo $text_yes; ?>
                <?php } else { ?>
                <input type="radio" name="seopage_page" value="1" />
                <?php echo $text_yes; ?>
                <?php } ?>
              </label>
              <label class="radio-inline">
                <?php if (!$seopage_page) { ?>
                <input type="radio" name="seopage_page" value="0" checked="checked" />
                <?php echo $text_no; ?>
                <?php } else { ?>
                <input type="radio" name="seopage_page" value="0" />
                <?php echo $text_no; ?>
                <?php } ?>
              </label>
            </div>
          </div>
		  
        </div>


		<div id="menu2" class="tab-pane fade">		
		
		  <div class="form">
            <label class="col-sm-3 control-label"><span data-toggle="tooltip" title="<?php echo $help_301; ?>"><?php echo $entry_301; ?></span></label>
            <div class="col-sm-9">
              <label class="radio-inline">
                <?php if ($seopage_301) { ?>
                <input type="radio" name="seopage_301" value="1" checked="checked" />
                <?php echo $text_yes; ?>
                <?php } else { ?>
                <input type="radio" name="seopage_301" value="1" />
                <?php echo $text_yes; ?>
                <?php } ?>
              </label>
              <label class="radio-inline">
                <?php if (!$seopage_301) { ?>
                <input type="radio" name="seopage_301" value="0" checked="checked" />
                <?php echo $text_no; ?>
                <?php } else { ?>
                <input type="radio" name="seopage_301" value="0" />
                <?php echo $text_no; ?>
                <?php } ?>
              </label>
            </div>
          </div>
		  
		  <div class="form">
            <label class="col-sm-3 control-label" for="seopage_redirects"><span data-toggle="tooltip" title="<?php echo $help_redirects; ?>"><?php echo $entry_redirects; ?></span></label>
            <div class="col-sm-9">
              <input type="text" name="seopage_redirects" value="<?php echo $seopage_redirects; ?>" id="seopage_redirects" class="form-control" />
            </div>
          </div>	
		  
        </div>
		
		
		<div id="menu3" class="tab-pane fade">
		
		  <div class="form">
            <label class="col-sm-3 control-label"><span data-toggle="tooltip" title="<?php echo $help_h1; ?>"><?php echo $entry_h1; ?></span></label>
            <div class="col-sm-9">
              <label class="radio-inline">
                <?php if ($seopage_h1) { ?>
                <input type="radio" name="seopage_h1" value="1" class="yes1" checked="checked" />
                <?php echo $text_yes; ?>
                <?php } else { ?>
                <input type="radio" name="seopage_h1" class="yes1" value="1" />
                <?php echo $text_yes; ?>
                <?php } ?>
              </label>
              <label class="radio-inline">
                <?php if (!$seopage_h1) { ?>
                <input type="radio" name="seopage_h1" value="0" class="no1" checked="checked" />
                <?php echo $text_no; ?>
                <?php } else { ?>
                <input type="radio" name="seopage_h1" class="no1" value="0" />
                <?php echo $text_no; ?>
                <?php } ?>
              </label>
            </div>
          </div>
				
		  <div class="form h11">
            <label class="col-sm-3 control-label"><span data-toggle="tooltip" title="<?php echo $help_span; ?>"><?php echo $entry_span; ?></span></label>
            <div class="col-sm-9">
              <label class="radio-inline">
                <?php if ($seopage_span) { ?>
                <input type="radio" name="seopage_span" value="1" checked="checked" />
                <?php echo $text_yes; ?>
                <?php } else { ?>
                <input type="radio" name="seopage_span" value="1" />
                <?php echo $text_yes; ?>
                <?php } ?>
              </label>
              <label class="radio-inline">
                <?php if (!$seopage_span) { ?>
                <input type="radio" name="seopage_span" value="0" checked="checked" />
                <?php echo $text_no; ?>
                <?php } else { ?>
                <input type="radio" name="seopage_span" value="0" />
                <?php echo $text_no; ?>
                <?php } ?>
              </label>
            </div>
          </div>
		
		  <div class="form h11">
            <label class="col-sm-3 control-label" for="seopage_pattern"><span data-toggle="tooltip" title="<?php echo $help_pattern; ?>"><?php echo $entry_pattern; ?></span></label>
            <div class="col-sm-9">
              <input type="text" name="seopage_pattern" value="<?php echo $seopage_pattern; ?>" id="seopage_pattern" class="form-control" />
              <p><?php echo $text_pattern; ?></p>
            </div>
          </div>		
		  <div class="form h11">
            <label class="col-sm-3 control-label" for="seopage_style"><span data-toggle="tooltip" title="<?php echo $help_style; ?>"><?php echo $entry_style; ?></span></label>
            <div class="col-sm-9">
              <textarea type="text" name="seopage_style" id="seopage_style" class="form-control" rows="6"><?php echo $seopage_style; ?></textarea>
            </div>
          </div>
		  
        </div>
		
    </div>
		
        </form>
<script>
$(document).ready(function () {                            
    $(".yes").change(function () {
        if ($(".yes").prop("checked", true) ) {
            $('#follow').show();
        }
	});
	$(".no").change(function () {
        if ($(".no").prop("checked", true) ) {
            $('#follow').hide();
        }
	});
	if ($(".no").is(":checked")) {
            $('#follow').hide();
        }
});
</script>
<script>
$(document).ready(function () {                            
    $(".yes1").change(function () {
        if ($(".yes1").prop("checked", true) ) {
            $('.h11').hide();
        }
	});
	$(".no1").change(function () {
        if ($(".no1").prop("checked", true) ) {
            $('.h11').show();
        }
	});
	if ($(".yes1").is(":checked")) {
            $('.h11').hide();
        }
});
</script>

<style>
.form{ padding: 30px 0;}
</style>
      </div>
    </div>
  </div>
</div>
  <?php echo $footer; ?>