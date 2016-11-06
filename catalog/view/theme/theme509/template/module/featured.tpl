<script>
	$(document).ready(function() {
		$(".quickview").fancybox({
			maxWidth	: 800,
			maxHeight	: 600,
			fitToView	: false,
			width		: '70%',
			height		: '70%',
			autoSize	: false,
			closeClick	: false,
			openEffect	: 'elastic',
			closeEffect	: 'elastic',
			
		});
	});
</script>
<div class="box featured"> 
	<div class="box-heading"><h3><?php echo $heading_title; ?></h3></div>
	<div class="box-content">
		<div class="row">
		<?php $f=0; foreach ($products as $product) { $f++; ?>
		<div class="product-layout col-lg-3 col-md-3 col-sm-3 col-xs-12">
			<div class="product-thumb transition">
				<a class="quickview" rel="group" href="#quickview_<?php echo $f?>">
					<?php echo $text_quick; ?>
				</a>
				<div style="display:none">
					<div id="quickview_<?php echo $f?>">
						<div>
							<div class="left col-sm-4">
									<div class="quickview_image image"><a href="<?php echo $product['href']; ?>"><img alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img-responsive" src="<?php echo $product['thumb']; ?>" /></a></div>
								</div>
								<div class="right col-sm-8">
									<h2><?php echo $product['name']; ?></h2>
									<div class="inf">
										<?php if ($product['author']) {?>
											<p class="quickview_manufacture manufacture manufacture"><?php echo $text_manufacturer; ?> <a href="<?php echo $product['manufacturers'];?>"><?php echo $product['author']; ?></a></p>
										<?php }?>
										<?php if ($product['model']) {?>
											<p class="product_model model"><?php echo $text_model; ?><?php echo $product['model']; ?></p>
										<?php }?>
										<p class="product_stock prod-stock-2"><?php echo $text_availability; ?></p>
											
											<?php
											if ($product['text_availability'] > 0) { ?>
											<p class="product_stock prod-stock"><?php echo $text_instock; ?></p>
											<?php } else { ?>
												<p class="product_stock prod-stock"><?php echo $text_outstock; ?></p>
											<?php
											}	
											?>
										<?php if ($product['price']) { ?>
										<div class="price">
										<?php if (!$product['special']) { ?>
										<?php echo $product['price']; ?>
										<?php } else { ?>
										<span class="price-new"><?php echo $product['special']; ?></span> <span class="price-old"><?php echo $product['price']; ?></span>
										<?php } ?>
										<?php if ($product['tax']) { ?>
										<span class="price-tax"><?php echo $text_tax; ?> <?php echo $product['tax']; ?></span>
										<?php } ?>
										</div>
										<?php } ?>
									</div>
									<div class="cart-button">
										<button class="btn btn-add" type="button" onclick="cart.add('<?php echo $product['product_id']; ?>');"><i class="fa fa-shopping-cart"></i></button>
										<button class="btn btn-icon" type="button" data-toggle="tooltip" title="<?php echo $button_wishlist; ?>" onclick="wishlist.add('<?php echo $product['product_id']; ?>');"><i class="fa fa-heart"></i></button>
										<button class="btn btn-icon" type="button" data-toggle="tooltip" title="<?php echo $button_compare; ?>" onclick="compare.add('<?php echo $product['product_id']; ?>');"><i class="fa fa-exchange"></i></button>



               <button style="float: right;" type="button" onclick="b_o_click(<?=$product['product_id'];?>,'<?=$product['thumb'];?>');"  data-loading-text="<?php echo $text_loading; ?>"
                    class="btn  btn-add">Один клик</button><br>



									</div>

         



									<div class="clear"></div>
									<div class="rating">
										<?php for ($i = 1; $i <= 5; $i++) { ?>
										<?php if ($product['rating'] < $i) { ?>
										<span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
										<?php } else { ?>
										<span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span>
										<?php } ?>
										<?php } ?>
									</div>
										
								</div>
								<div class="col-sm-12">
									<div class="quickview_description description">
										<?php echo $product['description1'];?>
									</div>
								</div>
						</div>
					</div>
				</div>
			<?php if ($product['special']) { ?>
				<div class="sale"><?php echo $text_sale; ?></div>
			<?php } ?>
			<div class="image"><a href="<?php echo $product['href']; ?>"><img alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img-responsive lazy" data-src="<?php echo $product['thumb']; ?>" src="image/catalog/preload.gif"  /></a></div>
			<div class="caption">
				<div class="name"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></div>
				<!--<div class="description"><?php echo $product['description']; ?></div>-->
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
				<div class="price">
				<?php if (!$product['special']) { ?>
				<?php echo $product['price']; ?>
				<?php } else { ?>
				<span class="price-new"><?php echo $product['special']; ?></span> <span class="price-old"><?php echo $product['price']; ?></span>
				<?php } ?>
				<?php if ($product['tax']) { ?>
				<span class="price-tax"><?php echo $text_tax; ?> <?php echo $product['tax']; ?></span>
				<?php } ?>
				</div>
				<?php } ?>
			</div>
			<div class="cart-button">
				<button  class="btn btn-add" type="button" onclick="cart.add('<?php echo $product['product_id']; ?>');"><i class="fa fa-shopping-cart hidden-lg"></i> <span class="hidden-xs hidden-sm hidden-md"><?php echo $button_cart; ?></span></button>


            <button style="float: right;" type="button" onclick="b_o_click(<?=$product['product_id'];?>,'<?=$product['thumb'];?>');"  data-loading-text="<?php echo $text_loading; ?>"
                    class="btn  btn-add">Один клик</button><br>

				<!--<button type="button" data-toggle="tooltip" title="<?php echo $button_wishlist; ?>" onclick="wishlist.add('<?php echo $product['product_id']; ?>');"><i class="fa fa-heart"></i></button>
				<button type="button" data-toggle="tooltip" title="<?php echo $button_compare; ?>" onclick="compare.add('<?php echo $product['product_id']; ?>');"><i class="fa fa-exchange"></i></button>-->
			</div>
			</div>
		</div>
		<?php } ?>
		</div>
	</div>
</div>


  <div class="container">
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