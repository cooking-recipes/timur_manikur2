<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-ocfilter" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <button type="submit" form="form-ocfilter" data-toggle="tooltip" title="<?php echo $button_apply; ?>" class="btn btn-success" onclick="$('#form-ocfilter').attr('action','<?php echo $apply; ?>');"><i class="fa fa-save"></i></button>
				<a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a>
			</div>
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
    <?php if ($success) { ?>
    <div class="alert alert-success"><i class="fa fa-exclamation-circle"></i> <?php echo $success; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-body">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#tab-general" data-toggle="tab"><?php echo $tab_general; ?></a></li>
          <li><a href="#tab-option" data-toggle="tab"><?php echo $tab_option; ?></a></li>
          <li><a href="#tab-price-filtering" data-toggle="tab"><?php echo $tab_price_filtering; ?></a></li>
          <li><a href="#tab-other" data-toggle="tab"><?php echo $tab_other; ?></a></li>
          <li><a href="#tab-copy" data-toggle="tab">Копирование фильтров</a></li>
        </ul>

        <form action="<?php echo $save; ?>" method="post" enctype="multipart/form-data" id="form-ocfilter" class="form-horizontal">
        	<div class="tab-content">
		        <div id="tab-general" class="tab-pane active">
		          <table class="form ocfilter-settings">
								<tr class="notice"><td></td><td><?php echo $notice_status; ?></td></tr>
		            <tr>
									<td><?php echo $entry_status; ?></td>
									<td><label<?php echo ($ocfilter_status ? ' class="checked"' : ''); ?>><input type="checkbox" name="ocfilter_status" value="1" <?php echo ($ocfilter_status ? 'checked="checked" ' : ''); ?>/></label></td>
		      			</tr>
		          </table>
		        </div>
		        <div id="tab-option" class="tab-pane">
              <input type="hidden" name="ocfilter_module[0][show_button]" value="0" / >
		          <table class="form ocfilter-settings">
		            <tr class="notice"><td></td><td><?php echo $notice_show_selected; ?></td></tr>
		            <tr>
									<td><?php echo $entry_show_selected; ?></td>
									<td><label<?php echo ($show_selected ? ' class="checked"' : ''); ?>><input type="checkbox" name="ocfilter_module[0][show_selected]" value="1" <?php echo ($show_selected ? 'checked="checked" ' : ''); ?>/></label></td>
		      			</tr>
		            <tr class="notice"><td></td><td><?php echo $notice_show_price; ?></td></tr>
		            <tr>
									<td><?php echo $entry_show_price; ?></td>
									<td><label<?php echo ($show_price ? ' class="checked"' : ''); ?>><input type="checkbox" name="ocfilter_module[0][show_price]" value="1" <?php echo ($show_price ? 'checked="checked" ' : ''); ?>/></label></td>
		      			</tr>
		            <tr class="notice"><td></td><td><?php echo $notice_show_counter; ?></td></tr>
		            <tr>
									<td><?php echo $entry_show_counter; ?></td>
									<td><label<?php echo ($show_counter ? ' class="checked"' : ''); ?>><input type="checkbox" name="ocfilter_module[0][show_counter]" value="1" <?php echo ($show_counter ? 'checked="checked" ' : ''); ?>/></label></td>
		      			</tr>
		            <tr class="notice"><td></td><td><?php echo $notice_manufacturer; ?></td></tr>
		            <tr>
		              <td><?php echo $entry_manufacturer; ?></td>
		              <td>
		                <label<?php echo ($manufacturer ? ' class="checked"' : ''); ?>><input type="checkbox" class="with-subfield" name="ocfilter_module[0][manufacturer]" value="1" <?php echo ($manufacturer ? 'checked="checked" ' : ''); ?>data-subfield="manufacturer" /></label>
		                <div class="subfield sf-manufacturer<?php echo ($manufacturer ? ' visible' : ''); ?>">
		                  <label>
			                  <span><?php echo $entry_type; ?></span>
			                  <select name="ocfilter_module[0][manufacturer_type]">
			                    <?php foreach ($types as $item) { ?>
			                    <option value="<?php echo $item; ?>" <?php echo ($manufacturer_type == $item ? 'selected="selected" ' : ''); ?>><?php echo ucfirst($item); ?></option>
			                    <?php } ?>
			                  </select>
											</label>
		                </div>
		              </td>
		            </tr>
		            <tr class="notice"><td></td><td><?php echo $notice_stock_status; ?></td></tr>
		            <tr>
		              <td><?php echo $entry_stock_status; ?></td>
		              <td>
		                <label<?php echo ($stock_status ? ' class="checked"' : ''); ?>><input type="checkbox" class="with-subfield" name="ocfilter_module[0][stock_status]" value="1" <?php echo ($stock_status ? 'checked="checked" ' : ''); ?>data-subfield="stock-status" /></label>
										<div class="subfield sf-stock-status<?php echo ($stock_status ? ' visible' : ''); ?>">
											<label>
			                  <span><?php echo $entry_stock_status_method; ?></span>
				                <select name="ocfilter_module[0][stock_status_method]" class="with-subfield" data-subfield="stock-status-method">
				                  <?php if ($stock_status_method == 'quantity') { ?>
				                  <option value="quantity" selected="selected"><?php echo $text_stock_by_quantity; ?></option>
				                  <option value="stock_status_id"><?php echo $text_stock_by_status_id; ?></option>
				                  <?php } else { ?>
				                  <option value="quantity"><?php echo $text_stock_by_quantity; ?></option>
				                  <option value="stock_status_id" selected="selected"><?php echo $text_stock_by_status_id; ?></option>
				                  <?php } ?>
				                </select>
											</label>
											<div class="subfield stock-status-method sf-stock-status-id<?php echo ($stock_status_method == 'stock_status_id' ? ' visible' : ''); ?>">
												<label>
													<span><?php echo $entry_type; ?></span>
		                      <select name="ocfilter_module[0][stock_status_type]">
				                    <?php foreach ($types as $item) { ?>
				                    <option value="<?php echo $item; ?>" <?php echo ($stock_status_type == $item ? 'selected="selected" ' : ''); ?>><?php echo ucfirst($item); ?></option>
				                    <?php } ?>
				                  </select>
												</label>
											</div>
											<div class="subfield stock-status-method sf-quantity<?php echo ($stock_status_method == 'quantity' ? ' visible' : ''); ?>">
												<label>
													<span><?php echo $entry_stock_out_value; ?></span>
													<input type="checkbox" name="ocfilter_module[0][stock_out_value]" value="1"<?php echo ($stock_out_value ? ' checked="checked" ' : ''); ?> />
												</label>
											</div>
										</div>
		              </td>
		            </tr>
		          </table>
		        </div>
		        <div id="tab-price-filtering" class="tab-pane">
		          <table class="form ocfilter-settings">
		            <tr class="notice"><td></td><td><?php echo $notice_price_type; ?></td></tr>
		            <tr>
		              <td><?php echo $entry_price_type; ?></td>
		              <td>
		                <select name="ocfilter_module[0][price_type]" class="with-subfield" data-subfield="price-type">
		                  <?php foreach ($price_types as $key => $item) { ?>
		                  <option value="<?php echo $key; ?>" <?php echo ($price_type == $key ? 'selected="selected" ' : ''); ?>><?php echo $item; ?></option>
		                  <?php } ?>
		                </select>
		                <div class="subfield sf-links price-type<?php echo ($price_type == 'links' ? ' visible' : ''); ?>">
		                  <label>
												<span><?php echo $entry_price_links_count; ?></span>
		                    <input type="text" name="ocfilter_module[0][price_links_count]" value="<?php echo $price_links_count; ?>" size="2" />
											</label>
										</div>
		              </td>
		            </tr>
		            <tr class="notice"><td></td><td><?php echo $notice_show_diagram; ?></td></tr>
		            <tr>
									<td><?php echo $entry_show_diagram; ?></td>
									<td><label<?php echo ($show_diagram ? ' class="checked"' : ''); ?>><input type="checkbox" name="ocfilter_module[0][show_diagram]" value="1" <?php echo ($show_diagram ? 'checked="checked" ' : ''); ?>/></label></td>
		      			</tr>
		            <tr class="notice"><td></td><td><?php echo $notice_manual_price; ?></td></tr>
		            <tr>
									<td><?php echo $entry_manual_price; ?></td>
									<td><label<?php echo ($manual_price ? ' class="checked"' : ''); ?>><input type="checkbox" name="ocfilter_module[0][manual_price]" value="1" <?php echo ($manual_price ? 'checked="checked" ' : ''); ?>/></label></td>
		      			</tr>
		            <tr class="notice"><td></td><td><?php echo $notice_consider_discount; ?></td></tr>
		            <tr>
									<td><?php echo $entry_consider_discount; ?></td>
									<td><label<?php echo ($consider_discount ? ' class="checked"' : ''); ?>><input type="checkbox" name="ocfilter_module[0][consider_discount]" value="1" <?php echo ($consider_discount ? 'checked="checked" ' : ''); ?>/></label></td>
		      			</tr>
		            <tr class="notice"><td></td><td><?php echo $notice_consider_special; ?></td></tr>
		            <tr>
									<td><?php echo $entry_consider_special; ?></td>
									<td><label<?php echo ($consider_special ? ' class="checked"' : ''); ?>><input type="checkbox" name="ocfilter_module[0][consider_special]" value="1" <?php echo ($consider_special ? 'checked="checked" ' : ''); ?>/></label></td>
		      			</tr>
		          </table>
		        </div>
		        <div id="tab-other" class="tab-pane">
		          <table class="form ocfilter-settings">
		            <tr class="notice"><td></td><td><?php echo $notice_pco_show_type; ?></td></tr>
								<tr>
		              <td><?php echo $entry_pco_show_type; ?></td>
		              <td>
		                <select name="ocfilter_module[0][pco_show_type]">
		                  <?php if ($pco_show_type == 'inline') { ?>
		                  <option value="inline" selected="selected"><?php echo $text_inline; ?></option>
		                  <option value="list"><?php echo $text_list; ?></option>
		                  <?php } else { ?>
		                  <option value="inline"><?php echo $text_inline; ?></option>
		                  <option value="list" selected="selected"><?php echo $text_list; ?></option>
		                  <?php } ?>
		                </select>
		              </td>
		            </tr>
		            <tr class="notice"><td></td><td><?php echo $notice_pco_show_limit; ?></td></tr>
		            <tr>
									<td><?php echo $entry_pco_show_limit; ?></td>
									<td><input type="text" name="ocfilter_module[0][pco_show_limit]" value="<?php echo $pco_show_limit; ?>" size="4" /></td>
		      			</tr>
		            <tr class="notice"><td></td><td><?php echo $notice_show_options_limit; ?></td></tr>
		            <tr>
									<td><?php echo $entry_show_first_limit; ?></td>
									<td><input type="text" name="ocfilter_module[0][show_options_limit]" value="<?php echo $show_options_limit; ?>" size="4" />&nbsp;<?php echo $text_options; ?></td>
		      			</tr>
		            <tr class="notice"><td></td><td><?php echo $notice_show_values_limit; ?></td></tr>
		            <tr>
									<td><?php echo $entry_show_first_limit; ?></td>
									<td><input type="text" name="ocfilter_module[0][show_values_limit]" value="<?php echo $show_values_limit; ?>" size="4" />&nbsp;<?php echo $text_values; ?></td>
								</tr>
		            <tr class="notice"><td></td><td><?php echo $notice_hide_empty_values; ?></td></tr>
		            <tr>
									<td><?php echo $entry_hide_empty_values; ?></td>
									<td><label<?php echo ($hide_empty_values ? ' class="checked"' : ''); ?>><input type="checkbox" name="ocfilter_module[0][hide_empty_values]" value="1" <?php echo ($hide_empty_values ? 'checked="checked" ' : ''); ?>/></label></td>
		      			</tr>
		            <tr class="notice"><td></td><td><?php echo $notice_use_animation; ?></td></tr>
		            <tr>
									<td><?php echo $entry_use_animation; ?></td>
									<td><label<?php echo ($use_animation ? ' class="checked"' : ''); ?>><input type="checkbox" name="ocfilter_module[0][use_animation]" value="1" <?php echo ($use_animation ? 'checked="checked" ' : ''); ?>/></label></td>
		      			</tr>
		          </table>
		        </div>
		        <div id="tab-copy" class="tab-pane">
		          <table class="form ocfilter-settings">
		            <tr>
		              <td><?php echo $entry_store; ?></td>
		              <td>
		                <div class="scrollbox">
		                  <?php $class = 'even'; ?>
		                  <div class="<?php echo $class; ?>"><input type="checkbox" name="option_store[]" value="0" /> <?php echo $text_default; ?></div>
		                  <?php foreach ($stores as $store) { ?>
		                  <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
		                  <div class="<?php echo $class; ?>"><input type="checkbox" name="option_store[]" value="<?php echo $store['store_id']; ?>" /> <?php echo $store['name']; ?></div>
		                  <?php } ?>
		                </div>
		              </td>
		            </tr>
		            <tr>
		              <td><?php echo $entry_type; ?></td>
		              <td>
		                <select name="type">
		                  <?php foreach ($types as $item) { ?>
		                  <option value="<?php echo $item; ?>"><?php echo ucfirst($item); ?></option>
		                  <?php } ?>
		                </select>
		              </td>
		            </tr>
		            <tr>
		              <td>Очистить существующие опции фильтра:</td>
		              <td>
                    <input type="checkbox" name="truncate" value="1" />
		              </td>
		            </tr>
		            <tr>
		              <td>Копировать атрибуты:</td>
		              <td>
                    <input type="checkbox" name="attribute" value="1" />
		              </td>
		            </tr>
		            <tr>
		              <td>Копировать опции товаров:</td>
		              <td>
                    <input type="checkbox" name="option" value="1" />
		              </td>
		            </tr>
		            <tr>
		              <td>Копировать стандартные фильтры:</td>
		              <td>
                    <input type="checkbox" name="filter" value="1" />
		              </td>
		            </tr>
		            <tr><td colspan="2" align="right"><a id="copy-attributes" class="btn btn-primary"><span><?php echo $button_copy; ?></span></a></td></tr>
		          </table>
		        </div>
          </div>
        </form>
			</div>
    </div>
  </div>
</div>
<script type="text/javascript"><!--
	ocfilter.php.button_copy = '<?php echo $button_copy; ?>';
  ocfilter.php.button_remove = '<?php echo $button_remove; ?>';
	ocfilter.php.text_executed = '<?php echo $text_executed; ?>';
  ocfilter.php.text_ready = '<?php echo $text_ready; ?>';
  ocfilter.php.text_options = '<?php echo $text_options; ?>';
  ocfilter.php.text_values = '<?php echo $text_values; ?>';
  ocfilter.php.text_select = '<?php echo $text_select; ?>';
	ocfilter.php.text_selected = '<?php echo $text_selected; ?>';
  ocfilter.php.entry_show_diagram = '<?php echo $entry_show_diagram; ?>';
  ocfilter.php.entry_show_first_limit = '<?php echo $entry_show_first_limit; ?>';
  ocfilter.php.entry_show_price = '<?php echo mb_substr($entry_show_price, 0, -1, 'UTF-8'); ?>';
  ocfilter.php.entry_stock_status = '<?php echo mb_substr($entry_stock_status, 0, -1, 'UTF-8'); ?>';
  ocfilter.php.entry_manufacturer = '<?php echo mb_substr($entry_manufacturer, 0, -1, 'UTF-8'); ?>';
//--></script>
<?php echo $footer; ?>