<?php 
class ControllerModuleCallme extends Controller {
	private $error = array(); 
	    
  	public function index() {
		
		if ($this->request->server['HTTPS']) {
			$server = $this->config->get('config_ssl');
		} else {
			$server = $this->config->get('config_url');
		}
		$data['server'] = $server;	

		$data['callme_setting'] = $this->config->get('callme_setting');
		
		$callme_module_cfg = $this->config->get('callme_setting');

		if ($callme_module_cfg['button_status'] ) {
			$data['button_status'] = true;
		}		
		
		if (!file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/stylesheet/callme.css')) {
			if (!file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/stylesheet/callme.tcss')) {
				file_put_contents(DIR_TEMPLATE . $this->config->get('config_template') . '/stylesheet/callme.css', $this->load->view('default/stylesheet/callme.tcss', $data));
			} else {
				file_put_contents(DIR_TEMPLATE . $this->config->get('config_template') . '/stylesheet/callme.css', $this->load->view($this->config->get('config_template') . '/stylesheet/callme.tcss', $data));
			}
		}

			$this->document->addStyle('catalog/view/theme/' . $this->config->get('config_template') . '/stylesheet/callme.css');			
			

		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/callme.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/module/callme.tpl', $data);
		} else {
			return $this->load->view('default/template/module/callme.tpl', $data);
		}

	}
	
	//open form	for callme
	public function open() {
		
		if ($this->request->server['HTTPS']) {
			$server = $this->config->get('config_ssl');
		} else {
			$server = $this->config->get('config_url');
		}
		$data['base'] = $server;	
		
		$this->language->load('module/callme');
		$this->document->setTitle($this->language->get('heading_title')); 
		
		$callme_module_cfg = $this->config->get('callme_setting');	
		$data['callme_setting'] = $this->config->get('callme_setting');
		$data['open'] = true;
		
		
		$product_id = (isset($this->request->get['prod_id']) && $this->request->get['prod_id']) ? $this->request->get['prod_id'] : '';
		$data['product_id'] = $product_id ;
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			
			//product
			if (isset($this->request->post['product_id'])) {

				$product_id = $this->request->post['product_id'];
				
				$this->load->model('catalog/product');
				$product_info = $this->model_catalog_product->getProduct($product_id);
				
				$product_name = $product_info['name'];
				$product_price = $this->currency->format($this->tax->calculate($product_info['price'], $product_info['tax_class_id'], $this->config->get('config_tax')));
				$product_link = $this->url->link('product/product', 'product_id=' . $product_id);

				$email_subject = 	$this->language->get('email_subject_by');
				
			} else {
				$product_id = false;
				$email_subject = 	$this->language->get('email_subject');
			}
			
		
			$mail = new Mail();
			$mail->protocol = $this->config->get('config_mail_protocol');
			$mail->parameter = $this->config->get('config_mail_parameter');
			$mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
			$mail->smtp_username = $this->config->get('config_mail_smtp_username');
			$mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
			$mail->smtp_port = $this->config->get('config_mail_smtp_port');
			$mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');

			$mail->setTo($this->config->get('config_email'));
	  		$mail->setFrom($this->config->get('config_email'));
	  		$mail->setSender($callme_module_cfg['sender']);
	  		$mail->setSubject(html_entity_decode(sprintf($email_subject, $this->request->post['name'], ENT_QUOTES, 'UTF-8')));
	  		
			$text =  $this->language->get('text_name') . $this->request->post['name'] . "\n" ;
			$text .= $this->language->get('text_tel') . $this->request->post['tel'] . "\n" ;
			$text .= (($callme_module_cfg['showfieldtime']) ? $this->language->get('text_time') . $this->request->post['time1']. " -- " .$this->request->post['time2'] . "\n" :  '');
			
			if ($product_id) {
				$text .= "\n" ;
				$text .= $this->language->get('text_product_name') . $product_name . "\n" ;
				$text .= $this->language->get('text_product_price') . $product_price . "\n" ;
				$text .= $this->language->get('text_product_link') . $product_link . "\n" ;
				$text .= "\n" ;
			} 
			
			$text .= $this->language->get('text_enquiry') . $this->request->post['enquiry'] . "\n" ;
			$text .= (($callme_module_cfg['link_page']) ? $this->language->get('text_link_page') . $this->request->post['link_page'] . "\n"  :  '') ;
			
			$mail->setText(html_entity_decode($text, ENT_QUOTES, 'UTF-8'));
      		$mail->send();
	  				
			$data['success'] = $this->language->get('success');
    	
		}
		
    	$data['heading_title'] = (isset($this->request->get['prod_id']) && $this->request->get['prod_id']) ? $this->language->get('heading_title_by') : $this->language->get('heading_title');

		$data['entry_enquiry'] = $this->language->get('entry_enquiry');
    	$data['entry_name'] = $this->language->get('entry_name');
    	$data['entry_tel'] = $this->language->get('entry_tel');
		$data['entry_time'] = $this->language->get('entry_time');
		$data['yes'] = $this->language->get('yes');
		$data['no'] = $this->language->get('no');
		$data['qs'] = $this->language->get('qs');


		if (isset($this->error['name'])) {
    		$data['error_name'] = $this->error['name'];
		} else {
			$data['error_name'] = '';
		}
		
		if (isset($this->error['tel'])) {
			$data['error_tel'] = $this->error['tel'];
		} else {
			$data['error_tel'] = '';
		}		
		
		if (isset($this->error['enquiry'])) {
			$data['error_enquiry'] = $this->error['enquiry'];
		} else {
			$data['error_enquiry'] = '';
		}		

		if (isset($this->error['capcha'])) {
			$data['error_capcha'] = $this->error['capcha'];
		} else {
			$data['error_capcha'] = '';
		}		
	

    	$data['button_send'] = $this->language->get('button_send');
    
		$data['action'] = $this->url->link('module/callme/open&prod_id='.$product_id);


    	
		if (isset($this->request->post['name'])) {
			$data['name'] = $this->request->post['name'];
		} else {
			$data['name'] = $this->customer->getFirstName();
		}

		if (isset($this->request->post['email'])) {
			$data['email'] = $this->request->post['email'];
		} else {
			$data['email'] = $this->customer->getEmail();
		}
		
		if (isset($this->request->post['tel'])) {
			$data['tel'] = $this->request->post['tel'];
		} else {
			$data['tel'] = '';
		}
		
		if (isset($this->request->post['time1'])) {
			$data['time1'] = $this->request->post['time1'];
		} else {
			$data['time1'] = $this->language->get('time1');
		}		
		if (isset($this->request->post['time2'])) {
			$data['time2'] = $this->request->post['time2'];
		} else {
			$data['time2'] = $this->language->get('time2');
		}
		
		if (isset($this->request->post['link_page'])) {
			$data['link_page'] = $this->request->post['link_page'];
		}
		
		if (isset($this->request->post['gdehomos'])) {
			$data['gdehomos'] = $this->request->post['gdehomos'];
		} else {
			$data['gdehomos'] = '';
		}
		
		if (isset($this->request->post['enquiry'])) {
			$data['enquiry'] = $this->request->post['enquiry'];
		} else {
			$data['enquiry'] = '';
		}


		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/callme.tpl')) {
			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/module/callme.tpl', $data));
		} else {
			$this->response->setOutput($this->load->view('default/template/module/callme.tpl', $data));
		}
		

	}
	
	
  	private function validate() {
	
		$callme_module_cfg = $this->config->get('callme_setting');
	
    	if ((utf8_strlen($this->request->post['name']) < 2) || (utf8_strlen($this->request->post['name']) > 32)) {
      		$this->error['name'] = $this->language->get('error_name');
    	}
		
		 if ((utf8_strlen($this->request->post['tel']) < 3) || (utf8_strlen($this->request->post['tel']) > 32)) {
      		$this->error['tel'] = $this->language->get('error_tel');
    	}
		
		if ($callme_module_cfg['capcha']) {
			if (isset($this->request->post['irobot_no']) || !isset($this->request->post['irobot_yes'])) {
				$this->error['capcha'] = $this->language->get('error_capcha');
			}
		}
		
		if (utf8_strlen($this->request->post['gdehomos']) > 0)  {
      		$this->error['gdehomos'] = 'SPAM';
    	}

		
		if (!$this->error) {
	  		return true;
		} else {
	  		return false;
		}  	  
  	}

	
}

