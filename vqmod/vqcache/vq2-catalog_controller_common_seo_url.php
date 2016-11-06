<?php
class ControllerCommonSeoUrl extends Controller {
	public function index() {
		// Add rewrite to url class
		if ($this->config->get('config_seo_url')) {
			$this->url->addRewrite($this);
		}

		// Decode URL

			if (isset($this->request->get['_route_'])) {
			$lquery = $this->db->query("SELECT * FROM " . DB_PREFIX . "language;");			
			foreach ($lquery->rows as $language) {
				if ((strpos($this->request->get['_route_'],$language['code'].'/')) === 0) {
					$this->session->data['language'] = $language['code']; 
					$this->language = new Language($language['directory']);
					$this->language->load($language['directory']); 
					$this->registry->set('language', $this->language); 
					$this->config->set('config_language_id', $language['language_id']); 					
					$this->request->get['_route_'] = substr( $this->request->get['_route_'], strlen($language['code'].'/'));
					
			        }
			}
			if ($this->request->get['_route_'] == '') 
				{
				unset($this->request->get['_route_']);
				$this->session->data['proute'] = 'common/home';
				}
			
			}
			
		if (isset($this->request->get['_route_'])) {

			$redirect_settings = $this->config->get('redirect_settings');
			if (isset($redirect_settings['redirectmanager'])) {
				$redirects = $this->config->get('redirect');
				if ($redirects) {
				foreach ($redirects as $redirectlink) {
						if ($redirectlink['title'] == $this->request->get['_route_']) {
								$this->request->get['_route_'] = $redirectlink['url'];							
							}
					}
				}
			}
			
			
			$parts = explode('/', $this->request->get['_route_']);

			// remove any empty arrays from trailing
			if (utf8_strlen(end($parts)) == 0) {
				array_pop($parts);
			}

			foreach ($parts as $part) {


 if (false !== strpos($part, ':')) {
          continue;
        }

				$query = $this->db->query("SELECT u.query, u.keyword, u.language_id as lid, l.code, l.directory FROM " . DB_PREFIX . "url_alias u left join " . DB_PREFIX . "language l on u.language_id = l.language_id WHERE u.keyword = '" . $this->db->escape($part) . "'");


			$redirect_settings = $this->config->get('redirect_settings');
			if ((isset($redirect_settings['autoredirect'])) && (!($query->num_rows))) {
			$link = $this->db->escape($part);
			$query = $this->db->query("SELECT u.query, u.keyword, u.language_id as lid, l.code, l.directory FROM " . DB_PREFIX . "url_alias u left join " . DB_PREFIX . "language l on u.language_id = l.language_id WHERE u.keyword sounds like '" . $this->db->escape($part) . "'");
				if ($query->num_rows) {
					$this->db->query("insert into " . DB_PREFIX . "autoredirect values ('".$link."','".$query->row['keyword']."',now());");
				}
			}
			
				if ($query->num_rows) {
					$url = explode('=', $query->row['query']);

					if ($url[0] == 'product_id') {

			if (($this->session->data['language'] <> $query->row['code']) || (!isset($this->session->data['language'])))
				{
				$this->session->data['language'] = $query->row['code']; 
				$this->language = new Language($query->row['directory']);
				$this->language->load($query->row['directory']); 
				$this->registry->set('language', $this->language); 
				$this->config->set('config_language_id', $query->row['lid']);  				
				}
			
						$this->request->get['product_id'] = $url[1];
					}

					if ($url[0] == 'category_id') {

			if (($this->session->data['language'] <> $query->row['code']) || (!isset($this->session->data['language'])))
				{
				$this->session->data['language'] = $query->row['code']; 
				$this->language = new Language($query->row['directory']);
				$this->language->load($query->row['directory']); 
				$this->registry->set('language', $this->language); 
				$this->config->set('config_language_id', $query->row['lid']);					
				}
			
						if (!isset($this->request->get['path'])) {
							$this->request->get['path'] = $url[1];
						} else {
							$this->request->get['path'] .= '_' . $url[1];
						}
					}

					if ($url[0] == 'manufacturer_id') {

			if (($this->session->data['language'] <> $query->row['code']) || (!isset($this->session->data['language'])))
				{
				$this->session->data['language'] = $query->row['code']; 
				$this->language = new Language($query->row['directory']);
				$this->language->load($query->row['directory']); 
				$this->registry->set('language', $this->language); 
				$this->config->set('config_language_id', $query->row['lid']);  
				}
			
						$this->request->get['manufacturer_id'] = $url[1];
					}

					if ($url[0] == 'information_id') {

			if (($this->session->data['language'] <> $query->row['code']) || (!isset($this->session->data['language'])))
				{
				$this->session->data['language'] = $query->row['code']; 
				$this->language = new Language($query->row['directory']);
				$this->language->load($query->row['directory']); 
				$this->registry->set('language', $this->language); 
				$this->config->set('config_language_id', $query->row['lid']); 
				}
			
						$this->request->get['information_id'] = $url[1];
					}
					
					if ($query->row['query'] && $url[0] != 'information_id' && $url[0] != 'manufacturer_id' && $url[0] != 'category_id' && $url[0] != 'product_id') {
						$this->request->get['route'] = $query->row['query'];
					}
					
				} else {
					
			

			if ($this->request->get['_route_'] ==  'wishlist') { $this->request->get['route'] =  'account/wishlist';
			} elseif ($this->request->get['_route_'] ==  'contact') { $this->request->get['route'] =  'information/contact';
			} elseif ($this->request->get['_route_'] ==  'account') { $this->request->get['route'] =  'account/account';
			} elseif ($this->request->get['_route_'] ==  'sitemap') { $this->request->get['route'] =  'information/sitemap';
			} elseif ($this->request->get['_route_'] ==  'manufacturer') { $this->request->get['route'] =  'product/manufacturer';
			} elseif ($this->request->get['_route_'] ==  'affiliates') { $this->request->get['route'] =  'affiliate/account';
			} elseif ($this->request->get['_route_'] ==  'special') { $this->request->get['route'] =  'product/special';
			} elseif ($this->request->get['_route_'] ==  'login') { $this->request->get['route'] =  'account/login';
			} elseif ($this->request->get['_route_'] ==  'logout') { $this->request->get['route'] =  'account/logout';
			} elseif ($this->request->get['_route_'] ==  'register') { $this->request->get['route'] =  'account/register'; }
			else {
				
			if (strpos($this->request->get['_route_'], '/page/') !== false) {
					$this->request->get['page'] = str_replace('/page/','',substr($this->request->get['_route_'], strpos($this->request->get['_route_'], '/page/')));					
				}
				else {
				
			if (strpos($this->request->get['_route_'], 'tags/') !== false) {
					$this->request->get['route'] = 'product/search';
					$this->request->get['tag'] = str_replace('tags/','',$this->request->get['_route_']);
				}
			else {
				$this->request->get['route'] = 'error/not_found';
			}
			
				}
			
			}
			
			 $this->db->query("insert into " . DB_PREFIX . "404s_report values ('".$this->request->get['_route_']."',now());");
			

					break;
				}
			}


      // OCFilter start
      if (isset($this->request->get['route']) && $this->request->get['route'] == 'error/not_found') {
        $_route_ = $this->request->get['_route_'];

        $postfix = trim($this->config->get('config_seo_url_postfix'));

        if ($postfix) {
        	$_route_ = rtrim($_route_, $postfix);
        }

        $_route_ = trim($_route_, '/');

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "ocfilter_page WHERE keyword = '" . $this->db->escape($_route_) . "' LIMIT 1");

				if ($query->num_rows) {
          $this->request->get['route'] = 'product/category'; $this->session->data['path'] = $this->request->get['path'];

          $this->request->get['path'] = $query->row['category_id'];

          $this->request->get['ocfilter_path'] = $query->row['ocfilter_params'];
          $this->request->get['filter_ocfilter'] = $this->load->controller('module/ocfilter/getParamsFromKeywords', $query->row['ocfilter_params']);
        }
      }
      // OCFilter end



			if (!isset($this->request->get['route'])) {
				if (isset($this->request->get['product_id'])) {
					$this->request->get['route'] = 'product/product'; $this->session->data['product_id'] = $this->request->get['product_id'];
				} elseif (isset($this->request->get['path'])) {
					$this->request->get['route'] = 'product/category'; $this->session->data['path'] = $this->request->get['path'];
				} elseif (isset($this->request->get['manufacturer_id'])) {
					$this->request->get['route'] = 'product/manufacturer/info'; $this->session->data['manufacturer_id'] = $this->request->get['manufacturer_id'];
				} elseif (isset($this->request->get['information_id'])) {
					$this->request->get['route'] = 'information/information'; $this->session->data['information_id'] = $this->request->get['information_id'];
				}
			}

			
			if (isset($this->request->get['route'])) { $this->session->data['proute'] = $this->request->get['route']; }
			
			if (isset($this->request->get['route'])) {
				return new Action($this->request->get['route']);
			}
		}
	}

	public function rewrite($link) {
		$url_info = parse_url(str_replace('&amp;', '&', $link));

		
				$squery = $this->db->query("SELECT `value` FROM `" . DB_PREFIX . "setting` WHERE `key` = 'config_language'");
				$mlseo = $this->config->get('mlseo');				
				if (isset($this->session->data['language']) && (isset($mlseo['subfolder']))  && ($this->session->data['language'] <> $squery->row['value'])) {$url = '/'.$this->session->data['language'];}
				else {$url = '';}

		$data = array();

			$extendedseo = $this->config->get('extendedseo');
			

		parse_str($url_info['query'], $data);

		foreach ($data as $key => $value) {
			if (isset($data['route'])) {
				if (($data['route'] == 'product/product' && $key == 'product_id') || (($data['route'] == 'product/manufacturer/info' || $data['route'] == 'product/product') && $key == 'manufacturer_id') || ($data['route'] == 'information/information' && $key == 'information_id')) {
					$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "url_alias WHERE language_id = " . (int)$this->config->get('config_language_id') . " AND `query` = '" . $this->db->escape($key . '=' . (int)$value) . "'");

					if ($query->num_rows && $query->row['keyword']) {
						$url .= '/' . $query->row['keyword'];

						unset($data[$key]);
					}

			} elseif (isset($data['route']) && $data['route'] ==   'common/home') { $url .=  '/';
			} elseif (isset($data['route']) && $data['route'] ==   'account/wishlist' && $key != 'remove') { $url .=  '/wishlist';
			} elseif (isset($data['route']) && $data['route'] ==   'information/contact') { $url .=  '/contact';
			} elseif (isset($data['route']) && $data['route'] ==   'account/account') { $url .=  '/account';
			} elseif (isset($data['route']) && $data['route'] ==   'information/sitemap') { $url .=  '/sitemap';
			} elseif (isset($data['route']) && $data['route'] ==   'product/manufacturer') { $url .=  '/manufacturer';
			} elseif (isset($data['route']) && $data['route'] ==   'affiliate/account') { $url .=  '/affiliates';
			} elseif (isset($data['route']) && $data['route'] ==   'product/special' && $key != 'page' && $key != 'sort' && $key != 'limit' && $key != 'order') { $url .=  '/special';
			} elseif (isset($data['route']) && $data['route'] ==   'account/login') { $url .=  '/login';
			} elseif (isset($data['route']) && $data['route'] ==   'account/logout') { $url .=  '/logout';
			} elseif (isset($data['route']) && $data['route'] ==   'account/register') { $url .=  '/register';
			

			} elseif ($data['route'] == 'product/search' && (isset($extendedseo['seotags'])) && ($key == 'filter_tag' || $key == 'tag')) {
						$url .= '/tags/' . $value;
						unset($data[$key]);
			
				} elseif ($key == 'path') {
					$categories = explode('_', $value);

					foreach ($categories as $category) {
						$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "url_alias WHERE language_id = " . (int)$this->config->get('config_language_id') . " AND `query` = 'category_id=" . (int)$category . "'");

						if ($query->num_rows && $query->row['keyword']) {
							$url .= '/' . $query->row['keyword'];
						} else {
							
				$squery = $this->db->query("SELECT `value` FROM `" . DB_PREFIX . "setting` WHERE `key` = 'config_language'");
				$mlseo = $this->config->get('mlseo');				
				if (isset($this->session->data['language']) && (isset($mlseo['subfolder']))  && ($this->session->data['language'] <> $squery->row['value'])) {$url = '/'.$this->session->data['language'];}
				else {$url = '';}

							break;
						}
					}

					unset($data[$key]);
				} else  {
					$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "url_alias WHERE language_id = " . (int)$this->config->get('config_language_id') . " AND `query` = '" .$data['route'] . "'");

					if ($query->num_rows && $query->row['keyword']) {
						$url .= '/' . $query->row['keyword'];

						unset($data[$key]);
					}
				}
			}
		}


			$seopagination = $this->config->get('seopagination');				
			if ($key == 'page' && $url && (isset($seopagination['pagination']))) {
						$url .= '/page/' . $value;
						unset($data[$key]);
					}
			
		if (($url) && ($url <> '/'.$this->session->data['language'])){
			unset($data['route']);

			$query = '';

			if ($data) {
				foreach ($data as $key => $value) {
					$query .= '&' . rawurlencode((string)$key) . '=' . rawurlencode((string)$value);
				}

				if ($query) {
					$query = '?' . str_replace('&', '&amp;', trim($query, '&'));
				}
			}

			return $url_info['scheme'] . '://' . $url_info['host'] . (isset($url_info['port']) ? ':' . $url_info['port'] : '') . str_replace('/index.php', '', $url_info['path']) . $url . $query;
		} else {
			return $link;
		}
	}
}
