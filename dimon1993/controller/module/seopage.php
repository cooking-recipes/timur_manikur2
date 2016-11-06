<?php

class ControllerModuleSEOPAGE extends Controller {

    private $error = array();

    public function index() {
        $this->load->language('module/seopage');

        $this->document->setTitle($this->language->get('heading_title'));
        
        $this->load->model('setting/setting');
        
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
        	$this->model_setting_setting->editSetting('seopage', $this->request->post);
        	$this->session->data['success'] = $this->language->get('text_success');
        	$this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
        }
        
        
        $text_strings = array(
            'heading_title',
            'text_edit',
        	'text_no',
        	'text_yes',
        	'entry_google',
        	'help_google',
			'entry_yandex',
        	'help_yandex',
        	'button_save',
        	'button_cancel',
			'text_nofollow',
			'text_follow',			
			'entry_follow',
        	'help_follow',
			'entry_description',
        	'help_description',
			'entry_page',
        	'help_page',			
			'header_1',
        	'header_2',
			'entry_pageh1',
        	'help_pageh1',
			'entry_h1',
        	'help_h1',	
			'entry_span',
        	'help_span',	
			'entry_pattern',
			'entry_metapattern',
        	'help_pattern',			
        	'text_pattern',	
        	'text_metapattern',		
			'entry_style',
        	'help_style',		
			'entry_301',
        	'help_301',		
			'entry_redirects',
        	'help_redirects',
			'entry_canonicals',
        	'help_canonicals',
         );

        foreach ($text_strings as $text) {
            $data[$text] = $this->language->get($text);
        }

		$robots = file_get_contents ('../robots.txt');
		$result = strpos ($robots, 'page=');
		if ($result) {
			$this->error['warning'] = $this->language->get('error_robots');
		}
		
		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

        $data['token'] = $this->session->data['token'];

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text'      => $this->language->get('text_home'),
            'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
        );

        $data['breadcrumbs'][] = array(
            'text'      => $this->language->get('text_module'),
            'href'      => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'),
        );

        $data['breadcrumbs'][] = array(
            'text'      => $this->language->get('heading_title'),
            'href'      => $this->url->link('module/seopage', 'token=' . $this->session->data['token'], 'SSL'),
        );

		$data['action'] = $this->url->link('module/seopage', 'token=' . $this->session->data['token'], 'SSL');
		$data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
        
    	if (isset($this->request->post['seopage_google'])) {
			$data['seopage_google'] = $this->request->post['seopage_google'];
		} else if($this->config->get('seopage_google') !== null) {
			$data['seopage_google'] = $this->config->get('seopage_google');
		}
        else {
        	$data['seopage_google'] = 1;
        }
        
		if (isset($this->request->post['seopage_follow'])) {
			$data['seopage_follow'] = $this->request->post['seopage_follow'];
		} else if($this->config->get('seopage_follow') !== null) {
			$data['seopage_follow'] = $this->config->get('seopage_follow');
		}
        else {
        	$data['seopage_follow'] = 0;
        }
		
		if (isset($this->request->post['seopage_yandex'])) {
			$data['seopage_yandex'] = $this->request->post['seopage_yandex'];
		} else if($this->config->get('seopage_yandex') !== null) {
			$data['seopage_yandex'] = $this->config->get('seopage_yandex');
		}
        else {
        	$data['seopage_yandex'] = 0;
        }
		
		if (isset($this->request->post['seopage_description'])) {
			$data['seopage_description'] = $this->request->post['seopage_description'];
		} else if($this->config->get('seopage_description') !== null) {
			$data['seopage_description'] = $this->config->get('seopage_description');
		}
        else {
        	$data['seopage_description'] = 0;
        }

		if (isset($this->request->post['seopage_page'])) {
			$data['seopage_page'] = $this->request->post['seopage_page'];
		} else if($this->config->get('seopage_page') !== null) {
			$data['seopage_page'] = $this->config->get('seopage_page');
		}
        else {
        	$data['seopage_page'] = 1;
        }
		
		if (isset($this->request->post['seopage_pageh1'])) {
			$data['seopage_pageh1'] = $this->request->post['seopage_pageh1'];
		} else if($this->config->get('seopage_pageh1') !== null) {
			$data['seopage_pageh1'] = $this->config->get('seopage_pageh1');
		}
        else {
        	$data['seopage_pageh1'] = 0;
        }
		
		if (isset($this->request->post['seopage_h1'])) {
			$data['seopage_h1'] = $this->request->post['seopage_h1'];
		} else if($this->config->get('seopage_h1') !== null) {
			$data['seopage_h1'] = $this->config->get('seopage_h1');
		}
        else {
        	$data['seopage_h1'] = 0;
        }

		if (isset($this->request->post['seopage_span'])) {
			$data['seopage_span'] = $this->request->post['seopage_span'];
		} else if($this->config->get('seopage_span') !== null) {
			$data['seopage_span'] = $this->config->get('seopage_span');
		}
        else {
        	$data['seopage_span'] = 0;
        }	
		if (isset($this->request->post['seopage_301'])) {
			$data['seopage_301'] = $this->request->post['seopage_301'];
		} else if($this->config->get('seopage_301') !== null) {
			$data['seopage_301'] = $this->config->get('seopage_301');
		}
        else {
        	$data['seopage_301'] = 0;
        }		
		
		if (isset($this->request->post['seopage_pattern'])) {
			$data['seopage_pattern'] = $this->request->post['seopage_pattern'];
		} else if($this->config->get('seopage_pattern') !== null) {
			$data['seopage_pattern'] = $this->config->get('seopage_pattern');
		}
        else {
        	$data['seopage_pattern'] = '[h1] ([page] [n])';
        }			
		
		if (isset($this->request->post['seopage_metapattern'])) {
			$data['seopage_metapattern'] = $this->request->post['seopage_metapattern'];
		} else if($this->config->get('seopage_metapattern') !== null) {
			$data['seopage_metapattern'] = $this->config->get('seopage_metapattern');
		}
        else {
        	$data['seopage_metapattern'] = '[desc] ([page] [n])';
        }		
		
		if (isset($this->request->post['seopage_style'])) {
			$data['seopage_style'] = $this->request->post['seopage_style'];
		} else if($this->config->get('seopage_style') !== null) {
			$data['seopage_style'] = $this->config->get('seopage_style');
		}
        else {
        	$data['seopage_style'] = 'font-weight:500;color:#444;font-size:33px;';
        }
		
		if (isset($this->request->post['seopage_redirects'])) {
			$data['seopage_redirects'] = $this->request->post['seopage_redirects'];
		} else if($this->config->get('seopage_redirects') !== null) {
			$data['seopage_redirects'] = $this->config->get('seopage_redirects');
		}
        else {
        	$data['seopage_redirects'] = 'ref';
        }
		
		if (isset($this->request->post['seopage_canonicals'])) {
			$data['seopage_canonicals'] = $this->request->post['seopage_canonicals'];
		} else if($this->config->get('seopage_canonicals') !== null) {
			$data['seopage_canonicals'] = $this->config->get('seopage_canonicals');
		}
        else {
        	$data['seopage_canonicals'] = 'sort,order,limit';
        }	
		
		
        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('module/seopage.tpl', $data));
    }
    

    protected function validate() {
    	if (!$this->user->hasPermission('modify', 'module/seopage')) {
    		$this->error['warning'] = $this->language->get('error_permission');
    	}
    
    	return !$this->error;
    }

    public function uninstall() {
    	$this->load->model('extension/event');
    	$this->model_extension_event->deleteEvent('seopage');
    	 
    }
    
}