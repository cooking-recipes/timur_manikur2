qc.PaymentView = qc.View.extend({
	initialize: function(e){
		this.template = e.template;
		qc.event.bind("update", this.update, this);
		qc.event.bind("paymentConfirm", this.paymentConfirm, this);
		this.model.on("change", this.render, this);
		this.render();
	},

	template: '',

	paymentConfirm: function() {
		$('.alert').remove();
		console.log(this.model.get('trigger'));
		$(this.model.get('trigger'), this.$el).trigger("click");
		
	},

	update: function(data){
		if(data.payment){
			this.model.set('payment', data.payment);
		}

		if(data.account && data.account !== this.model.get('account')){
			this.changeAccount(data.account);
		}
	},

	render: function(){
		$(this.el).html(this.template({'model': this.model.toJSON()}));

	},


});
