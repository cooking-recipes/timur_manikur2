<!-- 
	Ajax Quick Checkout 
	v6.0.0
	Dreamvention.com 
	d_quickcheckout/cart.tpl 
-->
<div id="payment_view" class="qc-step" data-col="<?php echo $col; ?>" data-row="<?php echo $row; ?>"></div>
<script type="text/html" id="payment_template">
<% if(model.payment){ %>
	<%= model.payment %>
<% } %>
</script>
<script>

$(function() {
	qc.payment = $.extend(true, {}, new qc.Payment(<?php echo $json; ?>));
	qc.paymentView = $.extend(true, {}, new qc.PaymentView({
		el:$("#payment_view"), 
		model: qc.payment, 
		template: _.template($("#payment_template").html())
	}));

});

</script>