   



    <div style="padding-right: 4em;
padding-left: 0.5em;"  class=" buyinoneclick container">

<div style=" text-align: center;
width: 80%;" class="wrapclass456">
        
<br><br>
      <div  onclick=" $.colorbox.close();" id="resetfields" class="close"></div>
    	<br><br>
      <div>
      <h2 style="text-align: center;" class="buyinoneclick-title page_name">Онлайн заказ</h2>
      <p style="text-align:center;">Заполните форму и наши менеджереры свяжуться с Вами в самое ближайшее время.</p>
      <strong style="text-align:center;">Внимание! Правильно заполняйте поля с контактными данными.</strong>
</div>

		







<!--       8888888888888888888888888888888888 -->
          <br><br>
            <div style="text-align:right;" class="in">
         
          
              
              <div style="float: right;margin-right: 2em;" class="order_form">
                <form method="post" action="" id="qForm">
                  <table>



                    <tr>
                      <th>Имя<span class="c_red">*</span>:</th>
                      <td><input  id="pqsName"  type="text" name="buyinoneclick_name" required></td>
                    </tr>
                    <tr>
                      <th>E-mail<span class="c_red">*</span>:</th>
                      <td><input name="buyinoneclick_mail" id="pqsEmail"  type="email" required></td>
                    </tr>
                    <tr>
                      <th>Телефон<span class="c_red">*</span>:</th>
                      <td><input id="pqsTel" name="buyinoneclick_contact"  type="tel" required></td>
                    </tr>
                    <tr>
                      <th>Комментарий:</th>
                      <td><textarea id="pqsText" name="buyinoneclick_coment" id="" cols="30" rows="10"></textarea></td>
                    </tr>
                    <tr>
                      <th></th>
                      <td>
<input type="hidden" name="pqsSubmit" value="pqsSubmit" id="pqsSubmit"/>
                      <p class="warning" id="pqsError" style="display: none"></p>
                      <br>
      <p style="width: 30%; float:right;" class="cont"><a  class="button   buyinoneclick-send-call-back" id="pqsSubmitBtn"><span>Заказать</span></a></p>
                    </tr>
                  </table>
                </form>






              </div>
              
            </div>
  

          <!-- 888888888888888888888888888888888 -->





































    </div>  





    </div>  







































<script>
function ChangeQty(){
	price = $(".price_gs").html();
	qty = $(".quantity_gs").val();
	total = parseFloat(price)*parseFloat(qty);
	$(".total_gs").html(Math.floor(total*100)/100);
		//$(".total_gs").html(total);
}
</script>