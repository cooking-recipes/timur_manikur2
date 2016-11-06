<footer>
  <div class="container">
	<div class="row">
	  <?php   if ($informations) { ?>
	  <div style="text-align: center;" class="col-sm-5">
		<h5><?php echo $text_information;  ?></h5>
		<ul class="list-unstyled">
		  <?php foreach ($informations as $information) { ?>
		  <li><a href="<?php echo $information['href']; ?>"><?php echo $information['title']; ?></a></li>
		  <?php } ?>
		</ul>



	  </div>
	  <?php } ?>

	    <div  class="col-sm-2">

	          	 <script type="text/javascript" src="//vk.com/js/api/openapi.js?136"></script>

<div id="forvk">
<!-- VK Widget -->
<div id="vk_groups"></div>
</div>
<script type="text/javascript">
VK.Widgets.Group("vk_groups", {mode: 3, width: "220"}, 113131591);
</script>



	  </div>





	
	  <div style="text-align: center;" class="col-sm-5">
		<h5><?php echo $text_extra; ?></h5>
		<ul class="list-unstyled">
		  <li><a href="<?php echo $manufacturer; ?>"><?php echo $text_manufacturer; ?></a></li>
		  <li><a href="<?php echo $special; ?>"><?php echo $text_special; ?></a></li>
		</ul>

		      <!-- BEGIN JIVOSITE CODE {literal} -->
<script type='text/javascript'>
(function(){ var widget_id = 'hVwB1RfKxT';var d=document;var w=window;function l(){
var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = '//code.jivosite.com/script/widget/'+widget_id; var ss = document.getElementsByTagName('script')[0]; ss.parentNode.insertBefore(s, ss);}if(d.readyState=='complete'){l();}else{if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})();</script>
<!-- {/literal} END JIVOSITE CODE -->
	  </div>
	<!--     <div  class="col-sm-2"> -->


		 <script type="text/javascript">
  (function(d, w, s) {
 var widgetHash = '9AUYy0RWAV', gcw = d.createElement(s); gcw.type = 'text/javascript'; gcw.async = true;
 gcw.src = '//widgets.binotel.com/getcall/widgets/'+ widgetHash +'.js';
 var sn = d.getElementsByTagName(s)[0]; sn.parentNode.insertBefore(gcw, sn);
  })(document, window, 'script');
</script>




	          	 <script type="text/javascript" src="//vk.com/js/api/openapi.js?136"></script>

<div id="forvk">
<!-- VK Widget -->
<div id="vk_groups"></div>
</div>
<script type="text/javascript">
VK.Widgets.Group("vk_groups", {mode: 3, width: "220"}, 113131591);
</script>



	  <!-- </div> -->
	 <!--  <div class="col-sm-4"> -->

			<?php echo $footer_top; ?>
			
		<!--<h5><?php echo $text_contact; ?></h5>
		<ul class="list-unstyled">
		  <li><?php echo $address; ?></li>
		  <li class="phone"><?php echo $telephone; ?></li>
		  <li class="phone"><?php echo $fax; ?></li>
		  
		</ul>
		<div class="socials">
			<a href="//www.facebook.com/"><i class="fa fa-facebook"></i></a>
			<a href="//www.facebook.com/"><i class="fa fa-twitter"></i></a>
			<a href="//www.facebook.com/"><i class="fa fa-rss"></i></a>
		</div>-->
	  <!-- </div> -->
	</div>
	
  </div> 
	</div>
</footer>

                
	<script>
    
    //$("#input-telephone").inputmask("7(999)999-99-99");

    $(document).ready(function () {

        $('#button-oneclick').on('click', function () {

            
console.log('ook-');



$('#myModal3').modal('show');

         if (event.preventDefault) {
event.preventDefault();
} else {
event.returnValue = false;
}
event.stopImmediatePropagation();
event.preventDefault();
return false;
//      stop





            $('.alert, .text-danger').remove();

            var tel_number = $("#input-telephone").val();
            var product_id = $('input[name="product_id"]').val();
            var quantity = $("#input-quantity").val();
              console.log(tel_number);
              console.log(product_id);
            var pattern = /^\+[1-9]{1}[0-9]{3,14}$/;
            var pattern = new RegExp('^[0-9]+$');
               
            if (pattern.test(tel_number)) {
                $.ajax({
                    url: 'index.php?route=product/buyoneclick/oneclickadd',
                    type: 'post',
                    data: 'product_id=' + product_id + '&tel_number=' + tel_number+'&quantity='+quantity,
                    dataType: 'json',
                    complete: function () {
                        $('#cart > button').button('reset');
                    },
                    success: function (json) {
                        if (json['redirect']) {
                            location = json['redirect'];
                        }

                        if (json['success']) {
                           $('.form-one-click-call').html('<label class="control-label" for="input-telephone">' + json['text_order_success'] + ' ' + json['code'] + '</label>');
                        }
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        //console.log(xhr.status);
                        //console.log(thrownError);
                        $('#content').parent().before('<div class="alert alert-danger"><i class="fa fa-minus-circle"></i>'+ xhr.responseText +' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
					}
                });
            }
            else {
                $('#content').parent().before('<div class="alert alert-danger"><i class="fa fa-minus-circle"></i> Телефонный номер неверен. Он должен состаять из цифр.<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
            }
        });

    });


// первое модальное
function b_o_click(a,im) {

// clear cquntiti

$.fancybox.close();
console.log("fan close");

$('#input-quantity3').val(1);  
$('#myModal3').modal('show');    

$('#prodim').attr('src',im); 

$('#input-id3').val(a); 
console.log('ook-a im');

}


//    для отправки товара oneclick
 $( "#form-callback3" ).submit(function( event ) {


  console.log('fb2');


 $('.alert, .text-danger').remove();

            var tel_number = $("#input-telephone3").val();
            var  quantity=$("#input-quantity3").val();
            var product_id=$("#input-id3").val();
                console.log(tel_number);
                console.log(quantity);
                console.log(product_id);
                $.ajax({
                 url: 'index.php?route=product/buyoneclick/oneclickadd',
                    type: 'post',
        data: 'product_id=' + product_id + '&tel_number=' + tel_number+'&quantity='+ quantity,
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

                          $('#myModal3').modal('hide');
                          $('#myModal2').modal('show');
                          $('#myModal2_text').text('');
                          $("#input-quantity3").val(1);
                           $('#myModal2_text').text('Номер вашего заказа: '+json['code']);

                     <!--  setTimeout(function(){ $('#myModal2').modal('hide');}, 3000); -->

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
  return false;

 


 
});









</script>

            
<script src="catalog/view/theme/theme509/js/livesearch.js" type="text/javascript"></script>

</div>

</body></html>