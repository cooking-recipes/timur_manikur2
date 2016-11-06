<?php
class ControllerModuleOCFilter extends Controller {
	private $error = array();

	public function index() {
		$data = $this->load->language('module/ocfilter');

		$this->document->setTitle($this->language->get('heading_title_module'));
    $this->document->addStyle('view/stylesheet/ocfilter/ocfilter.css');
    $this->document->addScript('view/javascript/ocfilter/ocfilter.js');

		$this->load->model('setting/setting');
    $this->load->model('catalog/ocfilter');

    $data['heading_title'] = $this->language->get('heading_title_module');

		# OCFilter main settings
		#		 		key                    default

    $main_settings = array(
      'show_price' 					=> 0,
      'show_selected' 			=> 0,
      'show_diagram' 				=> 0,
      'show_button' 				=> 0,
      'show_counter' 				=> 0,
			'price_type' 					=> 'links-slide',
			'price_links_count'   => 4,
      'manual_price'   			=> 0,
      'consider_discount' 	=> 0,
      'consider_special' 		=> 0,
      'show_options_limit' 	=> '',
      'show_values_limit'		=> '',
			'hide_empty_values' 	=> 0,
      'manufacturer' 				=> 0,
      'manufacturer_type' 	=> 'checkbox',
      'stock_status' 				=> 0,
      'stock_status_type' 	=> 'radio',
			'stock_status_method' => 'quantity',
			'stock_out_value'     => 0,
      'pco_show_type' 			=> 'list',
      'pco_show_limit' 			=> 6,
      'use_animation'       => 0
    );

		if ($this->request->server['REQUEST_METHOD'] == 'POST' && $this->validate()) {
			$ocfilter_settings = array();

      $ocfilter_settings['ocfilter_status'] = isset($this->request->post['ocfilter_status']);

      $ocfilter_settings['ocfilter_module'] = array();

      $ocfilter_settings['ocfilter_module'][] = array_merge($main_settings, array_shift($this->request->post['ocfilter_module']));

			$this->model_setting_setting->editSetting('ocfilter', $ocfilter_settings);

			$this->session->data['success'] = $this->language->get('text_success');

      if (!isset($this->request->get['apply'])) {
			  $this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
      } else {
        $this->response->redirect($this->url->link('module/ocfilter', 'token=' . $this->session->data['token'], 'SSL'));
      }
		}

 		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

    if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
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
     	'text'      => $this->language->get('heading_title_module'),
		  'href'      => $this->url->link('module/ocfilter', 'token=' . $this->session->data['token'], 'SSL'),
    	'separator' => ' :: '
 		);

		$data['save'] = $this->url->link('module/ocfilter', 'token=' . $this->session->data['token'], 'SSL');
    $data['apply'] = $this->url->link('module/ocfilter', 'token=' . $this->session->data['token'] . '&apply', 'SSL');
    $data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

    $data['token'] = $this->session->data['token'];

    $this->load->model('setting/store');

		$data['stores'] = $this->model_setting_store->getStores();

		if (isset($this->request->post['ocfilter_status'])) {
			$data['ocfilter_status'] = $this->request->post['ocfilter_status'];
		} else {
			$data['ocfilter_status'] = $this->config->get('ocfilter_status');
		}

    $data['types'] = array(
      'checkbox',
      'radio',
      'select'
    );

    $data['price_types'] = array(
      'links' => $this->language->get('text_links'),
      'slide' => $this->language->get('text_slide'),
      'links-slide' => $this->language->get('text_links_slide')
    );

    if (isset($this->request->post['ocfilter_module'])) {
			$module = $this->request->post['ocfilter_module'];
		} elseif ($this->config->has('ocfilter_module')) {
			$module = $this->config->get('ocfilter_module');
		} else {
			$module = array();
		}

		if ($module) {
			$data = array_merge($data, array_merge($main_settings, array_shift($module)));
		} else {
			$data = array_merge($data, $main_settings);
		}

    $data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('module/ocfilter.tpl', $data));
	}

  public function copyAttributes() {
    $json = array();

    $this->load->language('module/ocfilter');

    if ($this->request->server['REQUEST_METHOD'] == 'POST' && isset($this->request->post['option_store']) && isset($this->request->post['type'])) {
      $this->load->model('catalog/ocfilter');

      $this->model_catalog_ocfilter->copyAttributesToOCFilter($this->request->post);

      $json['message'] = $this->language->get('text_ready');
    } else {
      $json['message'] = $this->language->get('error_fields');
    }

    $this->response->setOutput(json_encode($json));
  }

	private function validate() {
		if (!$this->user->hasPermission('modify', 'module/ocfilter')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}
}
?>