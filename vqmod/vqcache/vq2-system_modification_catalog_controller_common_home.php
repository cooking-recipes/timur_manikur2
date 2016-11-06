<?php
class ControllerCommonHome extends Controller {
	public function index() {
			
			$this->session->data['proute'] = 'common/home';
			$titles = $this->config->get('config_meta_title');
			$meta_descriptions = $this->config->get('config_meta_description');
			$meta_keywords = $this->config->get('config_meta_keyword');
			
		$this->document->setTitle($titles[$this->config->get('config_language_id')]);

				$canonicals = $this->config->get('canonicals');
				if (isset($canonicals['canonicals_home'])) {
					$this->document->addLink($this->config->get('config_url'), 'canonical');
					}
		$this->document->setDescription($meta_descriptions[$this->config->get('config_language_id')]);
		$this->document->setKeywords($meta_keywords[$this->config->get('config_language_id')]);

		$this->document->addLink($this->getCanonical(), 'canonical');

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');

			$data['header_top'] = $this->load->controller('common/header_top');
			
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/home.tpl')) {
			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/common/home.tpl', $data));
		} else {
			$this->response->setOutput($this->load->view('default/template/common/home.tpl', $data));
		}
	}
	
	protected function getCanonical() {
		$url = HTTP_SERVER;
		if( $this->config->get('config_seo_url')
			&& $this->config->get('config_seo_url_type') == 'seo_pro') {
			$url = $this->url->link('common/home');
			$query = $this->db->query("SELECT value FROM " . DB_PREFIX . "setting WHERE store_id = '" . (int)$this->config->get('config_store_id') . "' AND `key` ='config_language'");
				
			$code = $this->session->data['language'];
			
			// Do not show language code for home when default language is always shown
			if( !$this->config->get('ocjazz_seopro_hide_default') 
				&& $code == $query->row['value']) 
			{
				$component = parse_url($url);
				if ($component['scheme'] == 'https') {
					$domain = $this->config->get('config_ssl');
				} else {
					$domain = $this->config->get('config_url');
				}
					
				$url = preg_replace('~('.$domain.')('.$code.'/)(.+)~i', '$1$3',$url);
			}
		}
		return $url;
	}

}