<?php
class ControllerModuleCallme extends Controller {
	private $error = array(); 
	
	public function index() {   
		$this->load->language('module/callme');

		$this->document->setTitle(strip_tags($this->language->get('heading_title')));
		$this->load->model('setting/setting');
		$callme_module_cfg = $this->config->get('callme_setting');
				
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			
			//////////////////	
			 $height = '400'; 
			if ($this->request->post['callme_setting']['showfieldtime'] ) $height = '470'; 
			if ($this->request->post['callme_setting']['capcha'] ) $height = '470'; 
			if ($this->request->post['callme_setting']['showfieldtime'] and $this->request->post['callme_setting']['capcha'] )  $height = '530'; 
			
			$this->request->post['callme_setting']['height'] =  $height;
			//////////////////
					
			$this->model_setting_setting->editSetting('callme', $this->request->post);		
					 
			$this->session->data['success'] = $this->language->get('text_success');
			
			@unlink(DIR_CATALOG . 'view/theme/' . $this->config->get('config_template') . '/stylesheet/callme.css');
			
			$this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		
		}
		
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['entry_status'] = $this->language->get('entry_status');
		
		$data['heading_title2'] = $this->language->get('heading_title2');
		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_yes'] = $this->language->get('text_yes');
		$data['text_no'] = $this->language->get('text_no');
		$data['text_sender'] = $this->language->get('text_sender');
		$data['text_showfieldtime'] = $this->language->get('text_showfieldtime');
		$data['text_link_page'] = $this->language->get('text_link_page');
		$data['text_button_page'] = $this->language->get('text_button_page');
		$data['text_button_color'] = $this->language->get('text_button_color');
				
		$lngs = array ('text_white', 'text_green', 'text_black', 'text_pink', 'text_blue',  'text_yelow', 'text_capcha');
		foreach ($lngs as $lng) {
		$data[$lng] = $this->language->get($lng);
		}
				
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		
		
		
 		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

  		$data['breadcrumbs'] = array();

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_module'),
			'href'      => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title2'),
			'href'      => $this->url->link('module/callme', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
		$data['action'] = $this->url->link('module/callme', 'token=' . $this->session->data['token'], 'SSL');
		$data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

		if (isset($this->request->post['callme_status'])) {
			$data['callme_status'] = $this->request->post['callme_status'];
		} else {
			$data['callme_status'] = $this->config->get('callme_status');
		}
		
		
		$callme_module_cfg_data = array ('showfieldtime', 'link_page', 'button_status', 'button_color', 'capcha', 'sender');
		foreach ($callme_module_cfg_data as $datas) {
			if (isset($this->request->post['callme_setting'][$datas])) {
				$data[$datas] = $this->request->post['callme_setting'][$datas];
			} else {
				$data[$datas] = $callme_module_cfg[$datas];
			}
		}


		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('module/callme.tpl', $data));
		
	}
	
	public  function install() {
		$this->load->model('design/layout');
		$layouts = $this->model_design_layout->getLayouts();
		
		$this->load->model('module/callme');
		
		foreach ($layouts as $layout) {
		$this->model_module_callme->addModule($layout['layout_id']);
		}
	}
	
	public  function uninstall() {
		$this->load->model('design/layout');
		$layouts = $this->model_design_layout->getLayouts();
		
		$this->load->model('module/callme');
		$this->model_module_callme->deleteModule();

	}
	
	
	private function validate() {
		if (!$this->user->hasPermission('modify', 'module/callme')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!$this->error) {
			return true;
		} else {
			return false;
		}	
	}
}
