<?php echo $header; ?>
<div class="container">
	<?php include($_SERVER['DOCUMENT_ROOT'].'/seo/breadcrumbs.php'); ?>
  <div class="row"><?php echo $column_left; ?>
	<?php if ($column_left && $column_right) { ?>
	<?php $class = 'col-sm-6'; ?>
	<?php } elseif ($column_left || $column_right) { ?>
	<?php $class = 'col-sm-9'; ?>
	<?php } else { ?>
	<?php $class = 'col-sm-12'; ?>
	<?php } ?>
	<div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
	  <h2><?php echo $heading_title; ?></h2>
	  <?php if ($products) { ?>
	  <div class="product-filter clearfix">
			<div class="row">
				<div class="col-md-2">
					<label class="control-label" for="input-sort"><?php echo $text_sort; ?></label>
				</div>
				<div class="col-md-3">
					<select id="input-sort" class="form-control col-sm-3" onchange="location = this.value;">
						<?php foreach ($sorts as $sorts) { ?>
						<?php if ($sorts['value'] == $sort . '-' . $order) { ?>
						<option value="<?php echo $sorts['href']; ?>" selected="selected"><?php echo $sorts['text']; ?></option>
						<?php } else { ?>
						<option value="<?php echo $sorts['href']; ?>"><?php echo $sorts['text']; ?></option>
						<?php } ?>
						<?php } ?>
					</select>
				</div>
				<div class="col-md-2">
					<label class="control-label" for="input-limit"><?php echo $text_limit; ?></label>
				</div>
				<div class="col-md-2">
					<select id="input-limit" class="form-control" onchange="location = this.value;">
						<?php foreach ($limits as $limits) { ?>
						<?php if ($limits['value'] == $limit) { ?>
						<option value="<?php echo $limits['href']; ?>" selected="selected"><?php echo $limits['text']; ?></option>
						<?php } else { ?>
						<option value="<?php echo $limits['href']; ?>"><?php echo $limits['text']; ?></option>
						<?php } ?>
						<?php } ?>
					</select>
				</div>
				<div class="col-md-3 text-right">
					<div class="button-view">
						<button type="button" id="list-view" class="btn btn-default" data-toggle="tooltip" title="<?php echo $button_list; ?>"><i class="fa fa-th-list"></i></button>
						<button type="button" id="grid-view" class="btn btn-default" data-toggle="tooltip" title="<?php echo $button_grid; ?>"><i class="fa fa-th"></i></button>
					</div>
				</div>
			</div>
		</div>
		<div class="nav-cat clearfix">
			<div class="pull-left"><?php echo $pagination; ?></div>
			<div class="pull-left nam-page"><?php echo $results; ?></div>
			<div class="pull-right">
				<a href="<?php echo $compare; ?>" id="compare-total">
					<?php echo $text_compare; ?>
					<i class="fa fa-chevron-right"></i>
				</a>
			</div>
		</div>
	  <br />
	  <div class="row">      
		<?php foreach ($products as $product) { ?>
		<div class="product-layout product-list col-xs-12">
		  <div class="product-thumb">
			<div class="image"><a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img-responsive" /></a></div>
			<div class="caption">
			  <h4><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></h4>
			  <p><?php echo $product['description']; ?></p>
			  <?php if ($product['rating']) { ?>
			  <div class="rating">
				<?php for ($i = 1; $i <= 5; $i++) { ?>
				<?php if ($product['rating'] < $i) { ?>
				<span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
				<?php } else { ?>
				<span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span>
				<?php } ?>
				<?php } ?>
			  </div>
			  <?php } ?>
			  <?php if ($product['price']) { ?>
			  <div  class="price" style="float: left; margin-right: 1em; margin-top: 0.4em;">
				<?php if (!$product['special']) { ?>
				<?php echo $product['price']; ?>
				<?php } else { ?>
				<span class="price-new"><?php echo $product['special']; ?></span> <span class="price-old"><?php echo $product['price']; ?></span>
				<?php } ?>
				<?php if ($product['tax']) { ?>
				<span class="price-tax"><?php echo $text_tax; ?> <?php echo $product['tax']; ?></span>
				<?php } ?>
			  </div >
			  <?php } ?>
			</div>



<button style="padding-right: 11px;"  type="button" onclick="b_o_click(<?=$product['product_id'];?>,'<?=$product['thumb'];?>');"  data-loading-text="<?php echo $text_loading; ?>"
                    class="btn  btn-add">Один клик</button>




				<div class="cart-button">
					<button class="btn btn-add" type="button" onclick="cart.add('<?php echo $product['product_id']; ?>');"><i class="fa fa-shopping-cart hidden-lg"></i> <span class="hidden-xs hidden-sm hidden-md"><?php echo $button_cart;  ?></span></button>
					<button class="btn btn-icon" type="button" data-toggle="tooltip" title="<?php echo $button_wishlist; ?>" onclick="wishlist.add('<?php echo $product['product_id']; ?>');"><i class="fa fa-heart"></i></button>
					<button class="btn btn-icon" type="button" data-toggle="tooltip" title="<?php echo $button_compare; ?>" onclick="compare.add('<?php echo $product['product_id']; ?>');"><i class="fa fa-exchange"></i></button>
				</div>
			  <div class="clear"></div>
		  </div>
		</div>
		<?php } ?>
	  </div>
	  <div class="row">
		<div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
		<div class="col-sm-6 text-right"><?php echo $results; ?></div>
	  </div>
	  <?php } else { ?>
	  <p><?php echo $text_empty; ?></p>
	  <div class="buttons">
		<div class="pull-right"><a href="<?php echo $continue; ?>" class="btn btn-primary"><?php echo $button_continue; ?></a></div>
	  </div>
	  <?php } ?>
	  <?php echo $content_bottom; ?></div>
	<?php echo $column_right; ?></div>
</div>


<!-- Modal3 for single product -->
<!-- Modal -->
<div id="myModal3" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 style="text-align: center;" class="modal-title">Мы будем рады вам перезвонить</h4>
      </div>
      <div class="modal-body">
       <div class="row">
  <div class="col-sm-5">
  	<img id="prodim" alt="model">
  </div>


  <form id="form-callback3">
  <div class="col-sm-7"><br><br><br>
  	       <div class="form-group">
  <label for="usr">Укажите количество</label>
  <input  type="number" min="1"  value="1" step="1" class="form-control" id="input-quantity3">
  <label for="usr">Ваш номер телефона:</label>
  <input  type="text" placeholder="123456789" value="123456789" required oninvalid="this.setCustomValidity('Вводите только цифры')" oninput="setCustomValidity('')"
    pattern="[0-9]{3,}" class="form-control" id="input-telephone3">
  <input style="display: none;"  type="text"   class="form-control" id="input-id3">
</div>

  <button type="submit"  class="btn btn-default pull-righ" style="float: right;">Заказать звонок</button>

  </div>
  </form>
</div>    

      </div>
    </div>

  </div>
</div>

<!-- 3nd modal -->



 <style type="text/css">
 	.btn-icon {
 		 padding: 12px 24px;
 	}
 	.cart-button{
 
 		margin-top: 3px;
 	}
 </style>
<?php echo $footer; ?> 