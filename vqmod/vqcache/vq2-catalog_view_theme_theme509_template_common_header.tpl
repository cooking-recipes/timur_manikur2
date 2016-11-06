<!DOCTYPE html>
<!--[if IE]><![endif]-->
<!--[if IE 8 ]><html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>" class="ie8"><![endif]-->
<!--[if IE 9 ]><html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>" class="ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>">
<!--<![endif]-->
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $title; ?></title>
<base href="<?php echo $base; ?>" />
<?php if ($canonical_link) {echo '<link href="'.$canonical_link.'" rel="canonical" />';} ?>
	<?php
	if(!$description) $description = $title;
	?>
<?php if ($description) { ?>
<meta name="description" content="<?php echo $description; ?>" />
<?php } ?>
<?php if ($keywords) { ?>
<meta name="keywords" content= "<?php echo $keywords; ?>" />
<?php } ?>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<?php if ($icon) { ?>
<link href="<?php echo $icon; ?>" rel="icon" />
<?php } ?>
<?php foreach ($links as $link) { ?>
<link href="<?php echo $link['href']; ?>" rel="<?php echo $link['rel']; ?>" />
<?php } ?>
<script src="catalog/view/javascript/jquery/jquery-2.1.1.min.js" type="text/javascript"></script>
<link href="catalog/view/javascript/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen" />
<script src="catalog/view/javascript/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="catalog/view/theme/theme509/js/jquery.colorbox.js" type="text/javascript"></script>
<link href="catalog/view/javascript/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="//fonts.googleapis.com/css?family=Open+Sans:400,400i,300,700,600" rel="stylesheet" type="text/css" />
<link href='//fonts.googleapis.com/css?family=Lora:400,700' rel='stylesheet' type='text/css'>

<link rel="stylesheet"  href="catalog/view/theme/theme509/js/fancybox/jquery.fancybox.css" media="screen" />
<link href="catalog/view/theme/theme509/stylesheet/livesearch.css" rel="stylesheet">
<link href="catalog/view/theme/theme509/stylesheet/photoswipe.css" rel="stylesheet">
<link href="catalog/view/theme/theme509/js/jquery.bxslider/jquery.bxslider.css" rel="stylesheet">
<link href="catalog/view/theme/theme509/stylesheet/stylesheet.css" rel="stylesheet">
<link href="catalog/view/theme/theme509/stylesheet/superfish.css" rel="stylesheet">
<link href="catalog/view/theme/theme509/stylesheet/responsive.css" rel="stylesheet">
<?php foreach ($styles as $style) { ?>
<link href="<?php echo $style['href']; ?>" type="text/css" rel="<?php echo $style['rel']; ?>" media="<?php echo $style['media']; ?>" />
<?php } ?>
<!--<script src="catalog/view/javascript/common.js" type="text/javascript"></script>-->
<script src="catalog/view/theme/theme509/js/common.js" type="text/javascript"></script>

<!--caustom script-->
<script src="catalog/view/theme/theme509/js/tm-stick-up.js" type="text/javascript"></script>
<script src="catalog/view/theme/theme509/js/jquery.unveil.js" type="text/javascript"></script>
<script src="catalog/view/theme/theme509/js/jquery.bxslider/jquery.bxslider.js" type="text/javascript"></script>
<script src="catalog/view/theme/theme509/js/fancybox/jquery.fancybox.pack.js"></script>
<script src="catalog/view/theme/theme509/js/elavatezoom/jquery.elevatezoom.js" type="text/javascript"></script>
<script src="catalog/view/theme/theme509/js/superfish.js" type="text/javascript"></script>
<!--video script-->
<script src="catalog/view/theme/theme509/js/jquery.vide.min.js" type="text/javascript"></script>
<script src="catalog/view/theme/theme509/js/jquery.touchSwipe.min.js" type="text/javascript"></script>
<!--Green Sock-->
<script src="catalog/view/theme/theme509/js/greensock/jquery.gsap.min.js" type="text/javascript"></script>
<script src="catalog/view/theme/theme509/js/greensock/TimelineMax.min.js" type="text/javascript"></script>
<script src="catalog/view/theme/theme509/js/greensock/TweenMax.min.js" type="text/javascript"></script>
<script src="catalog/view/theme/theme509/js/greensock/jquery.scrollmagic.min.js" type="text/javascript"></script>


<!--photo swipe-->
<script src="catalog/view/theme/theme509/js/photo-swipe/klass.min.js" type="text/javascript"></script>
<script src="catalog/view/theme/theme509/js/photo-swipe/code.photoswipe.jquery-3.0.5.js" type="text/javascript"></script>
<script src="catalog/view/theme/theme509/js/photo-swipe/code.photoswipe-3.0.5.min.js" type="text/javascript"></script>



<script src="catalog/view/theme/theme509/js/parallax/cherry-fixed-parallax.js" type="text/javascript"></script>
<script src="catalog/view/theme/theme509/js/parallax/device.min.js" type="text/javascript"></script>

<script src="catalog/view/theme/theme509/js/script.js" type="text/javascript"></script>


<!--caustom script-->
<?php foreach ($scripts as $script) { ?>
<script src="<?php echo $script; ?>" type="text/javascript"></script>
<?php } ?>
<?php echo $google_analytics; ?>

			<link rel="stylesheet" href="catalog/view/javascript/jquery.cluetip.css" type="text/css" />
			<script src="catalog/view/javascript/jquery.cluetip.js" type="text/javascript"></script>
			
			<script type="text/javascript">
				$(document).ready(function() {
				$('a.title').cluetip({splitTitle: '|'});
				  $('ol.rounded a:eq(0)').cluetip({splitTitle: '|', dropShadow: false, cluetipClass: 'rounded', showtitle: false});
				  $('ol.rounded a:eq(1)').cluetip({cluetipClass: 'rounded', dropShadow: false, showtitle: false, positionBy: 'mouse'});
				  $('ol.rounded a:eq(2)').cluetip({cluetipClass: 'rounded', dropShadow: false, showtitle: false, positionBy: 'bottomTop', topOffset: 70});
				  $('ol.rounded a:eq(3)').cluetip({cluetipClass: 'rounded', dropShadow: false, sticky: true, ajaxCache: false, arrows: true});
				  $('ol.rounded a:eq(4)').cluetip({cluetipClass: 'rounded', dropShadow: false});  
				});
			</script>
			
</head>
<body class="<?php echo $class; ?>">
<!-- swipe menu -->
<div class="swipe">
	<div class="swipe-menu">
		<ul>
			
			<li><a href="<?php echo $account; ?>" title="<?php echo $text_account; ?>"><i class="fa fa-user"></i> <span><?php echo $text_account; ?></span></a></li>
			<?php if ($logged) { ?>
			<li><a href="<?php echo $order; ?>"><?php echo $text_order; ?></a></li>
			<li><a href="<?php echo $transaction; ?>"><?php echo $text_transaction; ?></a></li>
			<li><a href="<?php echo $download; ?>"><?php echo $text_download; ?></a></li>
			<li><a href="<?php echo $logout; ?>"><?php echo $text_logout; ?></a></li>
			<?php } else { ?>
			<li><a href="<?php echo $register; ?>"><i class="fa fa-user"></i> <?php echo $text_register; ?></a></li>
			<li><a href="<?php echo $login; ?>"><i class="fa fa-lock"></i><?php echo $text_login; ?></a></li>
			<?php } ?>
			<li><a href="<?php echo $wishlist; ?>" id="wishlist-total2" title="<?php echo $text_wishlist; ?>"><i class="fa fa-heart"></i> <span><?php echo $text_wishlist; ?></span></a></li>

			<li><a href="<?php echo $shopping_cart; ?>" title="<?php echo $text_shopping_cart; ?>"><i class="fa fa-shopping-cart"></i> <span><?php echo $text_shopping_cart; ?></span></a></li>
			<li><a href="<?php echo $checkout; ?>" title="<?php echo $text_checkout; ?>"><i class="fa fa-share"></i> <span><?php echo $text_checkout; ?></span></a></li>
		</ul>
		<?php if ($maintenance == 0){ ?>
		<ul class="foot">
			<?php if ($informations) { ?>
			<?php foreach ($informations as $information) { ?>
			<li><a href="<?php echo $information['href']; ?>"><?php echo $information['title']; ?></a></li>
			<?php } ?>
			<?php } ?>
		</ul>
		<?php } ?>
		<ul class="foot foot-1">
			<li><a href="<?php echo $contact; ?>"><?php echo $text_contact; ?></a></li>
			<li><a href="<?php echo $return; ?>"><?php echo $text_return; ?></a></li>
		</ul>
		
		<ul class="foot foot-2">
			<li><a href="<?php echo $manufacturer; ?>"><?php echo $text_manufacturer; ?></a></li>
		<!-- 	<li><a href="<?php echo $voucher; ?>"><?php echo $text_voucher; ?></a></li> -->
			<li><a href="<?php echo $affiliate; ?>"><?php echo $text_affiliate; ?></a></li>
			<li><a href="<?php echo $special; ?>"><?php echo $text_special; ?></a></li>
		</ul>
		<ul class="foot foot-3">
			<li><a href="<?php echo $order; ?>"><?php echo $text_order; ?></a></li>
			<li><a href="<?php echo $newsletter; ?>"><?php echo $text_newsletter; ?></a></li>
		</ul>
	</div>
</div>
<div id="page">
<div class="shadow"></div>
<div class="toprow-1">
	<a class="swipe-control" href="#"><i class="fa fa-align-justify"></i></a>
</div>
<div class="container">
	<nav  id="top" class="clearfix">
		<?php echo $currency; ?>
		<?php echo $language; ?>
		<div id="top-links" class="nav pull-left">
		<ul class="list-inline">
			<!--<li><a href="<?php echo $contact; ?>"><i class="fa fa-phone"></i></a> <span class="hidden-xs hidden-sm hidden-md"><?php echo $telephone; ?></span></li>-->
			<li class="first"><a href="<?php echo $home; ?>"><i class="fa fa-home"></i><span class="hidden-xs hidden-sm hidden-md"><?php echo $text_home; ?></span></a></li>
			<li class="first"><a href="/informaciya-o-doctavke"><i class="fa fa-truck"></i><span class="hidden-xs hidden-sm hidden-md">Доставка и оплата</span></a></li>
			<li class="dropdown"><a href="<?php echo $account; ?>" title="<?php echo $text_account; ?>" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <span class="hidden-xs hidden-sm hidden-md"><?php echo $text_account; ?></span> <span class="caret"></span></a>
			<ul class="dropdown-menu dropdown-menu-left">
				<?php if ($logged) { ?>
				<li><a href="<?php echo $account; ?>"><?php echo $text_account; ?></a></li>
				<li><a href="<?php echo $order; ?>"><?php echo $text_order; ?></a></li>
				<li><a href="<?php echo $logout; ?>"><?php echo $text_logout; ?></a></li>
				<?php } else { ?>
				<li><a href="<?php echo $register; ?>"><?php echo $text_register; ?></a></li>
				<li><a href="<?php echo $login; ?>"><?php echo $text_login; ?></a></li>
				<?php } ?>
			</ul>
			</li>
			<!-- <li><a href="<?php echo $wishlist; ?>" id="wishlist-total" title="<?php echo $text_wishlist; ?>"><i class="fa fa-heart"></i> <span class="hidden-xs hidden-sm hidden-md"><?php echo $text_wishlist; ?></span></a></li> -->
			<!--li><a href="<?php echo $shopping_cart; ?>" title="<?php echo $text_shopping_cart; ?>"><i class="fa fa-shopping-cart"></i> <span class="hidden-xs hidden-sm hidden-md"><?php echo $text_shopping_cart; ?></span></a></li>
			<li><a href="<?php echo $checkout; ?>" title="<?php echo $text_checkout; ?>"><i class="fa fa-share"></i> <span class="hidden-xs hidden-sm hidden-md"><?php echo $text_checkout; ?></span></a></li-->
			<li><a href="/news/" title="Новости"><i class="fa fa-share"></i> <span class="hidden-xs hidden-sm hidden-md">Новости</span></a></li>

			<li><a href="<?=$contact;?>" title="Контакты"><i class="fa fa-book fa-fw"></i> <span class="hidden-xs hidden-sm hidden-md">Контакты</span></a></li>

			
		</ul>
		</div>
	</nav>
</div>
<header>
	<div class="container">
		<div id="logo">
			<?php if ($logo) { ?>
			<a href="<?php echo $home; ?>"><img src="<?php echo $logo; ?>" title="<?php echo $name; ?>" alt="<?php echo $name; ?>" class="img-responsive" /></a>
			<?php } else { ?>
			<h1><a href="<?php echo $home; ?>"><?php echo $name; ?></a></h1>
			<?php } ?>
		</div>
		 <!-- <div class="tel"><?=$config_comment?></div>  -->
		 <div class="tel"> Наши контакты:
		 <br><img width="20px" height="20px" src="/image/catalog/tel/kiyev.png" alt="kievstar"><?=$telephone[0]?>
		 <br><img width="20px" height="20px" src="/image/catalog/tel/mtc.jpg" alt="kievstar"><?=$telephone[1]?>
		 <br>
<a onMouseover="init(this);shaking_image()" onMouseout="stop_shaking(this)" data-toggle="modal" data-target="#myModal"  style="cursor: pointer; position: relative; "> <i  class="fa fa-mobile"  style="color:#e65e63; font-size: 1.4em;" aria-hidden="true"></i></a>
&nbsp;Перезваниваем
</div>

<script type="text/javascript">
var range=2
var stop_it=0
var a=1

function init(given){
stop_it=0
shak_img=given
shak_img.style.left=0
shak_img.style.top=0
}

function shaking_image(){
	/*console.log('sh');*/
	
if ((!document.all&&!document.getElementById)||stop_it==1)
return
/*shak_img.style.background-color='green';*/
if (a==1){shak_img.style.top=parseInt(shak_img.style.top)+range+'px';}
else if (a==2){shak_img.style.left=parseInt(shak_img.style.left)+range+'px';}
else if (a==3){shak_img.style.top=parseInt(shak_img.style.top)-range+'px';}
else{shak_img.style.left=parseInt(shak_img.style.left)-range+'px';}
if (a<4) a++
else a=1
setTimeout("shaking_image()",40)
}

function stop_shaking(given){
stop_it=1
given.style.left=0
given.style.top=0
}
</script>



<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
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
  	<img  src="/image/catalog/tel/model.jpg" alt="model">
  </div>
  <form id="form-callback">
  <div class="col-sm-7">
  	       <div class="form-group">
  <label for="usr">Ваш номер телефона:</label>
  <input  type="text" placeholder="123456789" value="123456789" required oninvalid="this.setCustomValidity('Вводите только цифры')" oninput="setCustomValidity('')"
    pattern="[0-9]{3,}" class="form-control" id="input-telephone2">
</div>

  <button type="submit"  class="btn btn-default pull-righ" style="float: right;">Заказать звонок</button>

  </div>
  </form>
</div>    

      </div>
    </div>

  </div>
</div>
<!-- Modal -->
<div id="myModal2" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 style="text-align: center;" class="modal-title">Ваш заказ поставлен на обработку, наш менеджер в ближайшее время вам перезвонит.</h4>
      </div>
      <div class="modal-body">
       <div class="row">
  <div class="col-sm-5">
  	<img  src="/image/catalog/tel/model2.jpg" alt="model2">
  </div>
  <div class="col-sm-7">
       <h3 style="text-align: center;" id="myModal2_text"></h3>

  </div>

</div>    

      </div>
    </div>

  </div>
</div>




<script type="text/javascript">
        // callback

 $( "#form-callback" ).submit(function( event ) {






 $('.alert, .text-danger').remove();
  $('#myModal2_text').text('Желаем вам хорошего дня.');

            var tel_number = $("#input-telephone2").val();
         
            var product_id=-1;
            var pattern = /^\+[1-9]{1}[0-9]{3,14}$/;
 
                $.ajax({
                    url: 'index.php?route=product/buyoneclick/oneclickaddcallback',
                    type: 'post',
                    data: 'product_id=' + product_id + '&tel_number=' + tel_number,
                    dataType: 'json',
                    complete: function () {
                        $('#cart > button').button('reset');
                    },
                    success: function (json) {
                        if (json['redirect']) {
                            location = json['redirect'];
                        }

                        if (json['success']) {

                        	 console.log('sdsds');

                          $('#myModal').modal('hide');
                          $('#myModal2').modal('show');


                      setTimeout(function(){ $('#myModal2').modal('hide');}, 3000);

                         /*  $('.form-one-click-call').html('<label class="control-label" for="input-telephone">' + json['text_order_success'] + ' ' + json['code'] + '</label>');*/
                        }
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        //console.log(xhr.status);
                        //console.log(thrownError);
                        $('#content').parent().before('<div class="alert alert-danger"><i class="fa fa-minus-circle"></i>'+ xhr.responseText +' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
                    }
                });
            
  
if (event.preventDefault) {
event.preventDefault();
} else {
event.returnValue = false;
}
event.stopImmediatePropagation();
event.preventDefault();


 
});
 
     
</script>
		<!-- <div class="tel"><?=$telephone[0]?></div> -->

		<div hidden class="checkout_button">
			<a href="<?php echo $checkout; ?>" title="<?php echo $text_checkout; ?>">
				<?php echo $text_checkout; ?>
			</a>
		</div>
		<?php echo $cart; ?>
		<?php echo $search; ?>
	</div>
</header>

<?php if ($categories) { ?>
<div class="container">
	<div id="menu-gadget">
		<div id="menu-icon"><?php echo $text_category; ?></div>
		<?php if ($categories) {  echo $categories; } ?>
	</div>
</div>
<?php } ?>
<?php if ($categories) { ?>
<script type="text/javascript">
	jQuery(document).ready(function(){
		if ($('body').width() > 990) { 
			$('.nav__primary').tmStickUp({correctionSelector: $('#menu_stick')});
		};
	});
</script>
<div id="tm_menu" class="nav__primary">
	<div class="menu-shadow">
		<div class="container">
			<?php if ($categories) {  echo $categories; } ?>
			<div class="clear"></div>
		</div>
	</div>
</div>

<?php } ?>
<p id="back-top"> <a href="#top"><span></span></a> </p>