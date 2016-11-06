<?php
class ControllerProductCategory extends Controller {
	public function index() {
		$this->load->language('product/category');

		$this->load->model('catalog/category');

		$this->load->model('catalog/product');

		$this->load->model('tool/image');


	// OCFilter start
    $this->load->model('catalog/manufacturer');
    $this->load->model('catalog/ocfilter');

    $this->model_catalog_ocfilter->setSetting();

    $link = $ocfilter_path = '';

    if ($this->config->get('config_secure')) {
      $host = $this->config->get('config_ssl');
    } else {
      $host = $this->config->get('config_url');
    }

    if (isset($this->request->get['path'])) {
      $seo_type = $this->config->get('config_seo_url_type');

      $path = urldecode(str_replace(strstr($this->request->server['REQUEST_URI'], '?'), '', $this->request->server['REQUEST_URI']));

      $category_url = $this->url->link('product/category', 'path=' . $this->request->get['path']);

      $category_path = trim(str_replace($host, '', $category_url), '/');

      $ocfilter_path = str_replace($category_path, '', $path);

      $ocfilter_path = trim($ocfilter_path, '/');

      $link = $host . $category_path;

      if ($ocfilter_path) {
        $link .= '/' . $ocfilter_path;
      }

      if (!isset($this->request->get['ocfilter_path']) && $seo_type == 'seo_pro') {
        $link .= '/';

        if ('/' != substr($path, -1)) {
        	$this->response->redirect($link);
        }
      }

      if (!isset($this->request->get['filter_ocfilter'])) {
        $this->request->get['filter_ocfilter'] = $this->load->controller('module/ocfilter/getParamsFromKeywords', $ocfilter_path);
      }

      if (isset($this->request->get['ocfilter_path']) && isset($this->request->get['path'])) {
  			$parts = explode('_', (string)$this->request->get['path']);

  			$category_id = (int)array_pop($parts);

        $ocfilter_page_info = $this->model_catalog_ocfilter->getPage($category_id, trim($this->request->get['ocfilter_path'], '/'));

        if ($ocfilter_page_info && $ocfilter_page_info['keyword']) {
          $link = $host . $ocfilter_page_info['keyword'];

          if ($seo_type == 'seo_pro') {
            $link .= '/';
          }
        }
      }
    }

    if (isset($this->request->get['filter_ocfilter'])) {
      $filter_ocfilter = $this->request->get['filter_ocfilter'];
    } else {
      $filter_ocfilter = null;
    }
		// OCFilter end










		if (isset($this->request->get['filter'])) {
			$filter = $this->request->get['filter'];
		} else {
			$filter = '';
		}

		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'p.sort_order';
		}

		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'ASC';
		}

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		if (isset($this->request->get['limit'])) {
			$limit = $this->request->get['limit'];
		} else {
			$limit = $this->config->get('config_product_limit');
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);

		if (isset($this->request->get['path'])) {
			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			$path = '';

			$parts = explode('_', (string)$this->request->get['path']);

			$category_id = (int)array_pop($parts);

			foreach ($parts as $path_id) {
				if (!$path) {
					$path = (int)$path_id;
				} else {
					$path .= '_' . (int)$path_id;
				}

				$category_info = $this->model_catalog_category->getCategory($path_id);

				if ($category_info) {
					$data['breadcrumbs'][] = array(
						'text' => $category_info['name'],
						'href' => $this->url->link('product/category', 'path=' . $path . $url)
					);
				}
			}
		} else {
			$category_id = 0;
		}

		$category_info = $this->model_catalog_category->getCategory($category_id);

		if ($category_info) {
			$this->document->setTitle($category_info['meta_title']?$category_info['meta_title']:$category_info['name']);
			$this->document->setDescription($category_info['meta_description']);
			$this->document->setKeywords($category_info['meta_keyword']);
			$this->document->addLink($this->url->link('product/category', 'path=' . $this->request->get['path']), 'canonical');

			$data['heading_title'] = $category_info['name'];

			$data['text_refine'] = $this->language->get('text_refine');
			$data['text_empty'] = $this->language->get('text_empty');
			$data['text_quantity'] = $this->language->get('text_quantity');
			$data['text_manufacturer'] = $this->language->get('text_manufacturer');
			$data['text_model'] = $this->language->get('text_model');
			$data['text_price'] = $this->language->get('text_price');
			$data['text_tax'] = $this->language->get('text_tax');
			$data['text_points'] = $this->language->get('text_points');
			$data['text_compare'] = sprintf($this->language->get('text_compare'), (isset($this->session->data['compare']) ? count($this->session->data['compare']) : 0));
			$data['text_sort'] = $this->language->get('text_sort');
			$data['text_limit'] = $this->language->get('text_limit');

			$data['button_cart'] = $this->language->get('button_cart');
			$data['button_wishlist'] = $this->language->get('button_wishlist');
			$data['button_compare'] = $this->language->get('button_compare');
			$data['button_continue'] = $this->language->get('button_continue');
			$data['button_list'] = $this->language->get('button_list');
			$data['button_grid'] = $this->language->get('button_grid');

			// Set the last category breadcrumb
			$data['breadcrumbs'][] = array(
				'text' => $category_info['name'],
				'href' => $this->url->link('product/category', 'path=' . $this->request->get['path'])
			);

			if ($category_info['image']) {
				$data['thumb'] = $this->model_tool_image->resize($category_info['image'], $this->config->get('config_image_category_width'), $this->config->get('config_image_category_height'));
			} else {
				$data['thumb'] = '';
			}

			$data['description'] = html_entity_decode($category_info['description'], ENT_QUOTES, 'UTF-8');
			$data['compare'] = $this->url->link('product/compare');

			$url = '';

			if (isset($this->request->get['filter'])) {
				$url .= '&filter=' . $this->request->get['filter'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			$data['categories'] = array();

			$results = $this->model_catalog_category->getCategories($category_id);

			foreach ($results as $result) {
				$filter_data = array(
					'filter_category_id'  => $result['category_id'],
					'filter_sub_category' => true
				);

  $image = $this->model_tool_image->resize($result['image'], $this->config->get('config_image_category_width'), $this->config->get('config_image_category_height'));   
				$data['categories'][] = array(
					'name'  => $result['name'] . ($this->config->get('config_product_count') ? ' (' . $this->model_catalog_product->getTotalProducts($filter_data) . ')' : ''),
					'href'  => $this->url->link('product/category', 'path=' . $this->request->get['path'] . '_' . $result['category_id'] . $url)
,'thumb' => $image
				);
			}


			$data['products'] = array();

			$filter_data = array(
				'filter_category_id' => $category_id,
					'filter_ocfilter' => $filter_ocfilter,
				'filter_filter'      => $filter,
				'sort'               => $sort,
				'order'              => $order,
				'start'              => ($page - 1) * $limit,
				'limit'              => $limit
			);

			$product_total = $this->model_catalog_product->getTotalProducts($filter_data);

			$results = $this->model_catalog_product->getProducts($filter_data);

			foreach ($results as $result) {
				if ($result['image']) {
					$image = $this->model_tool_image->resize($result['image'], $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
				} else {
					$image = $this->model_tool_image->resize('placeholder.png', $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
				}

				if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
					$price = $this->currency->format($this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax')));
				} else {
					$price = false;
				}

				if ((float)$result['special']) {
					$special = $this->currency->format($this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax')));
				} else {
					$special = false;
				}

				if ($this->config->get('config_tax')) {
					$tax = $this->currency->format((float)$result['special'] ? $result['special'] : $result['price']);
				} else {
					$tax = false;
				}

				if ($this->config->get('config_review_status')) {
					$rating = (int)$result['rating'];
				} else {
					$rating = false;
				}

				$data['products'][] = array(
					'product_id'  => $result['product_id'],
					'thumb'       => $image,
					'name'        => $result['name'],
					'description' => utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get('config_product_description_length')) . '..',
					'price'       => $price,
					'special'     => $special,
					'tax'         => $tax,
					'rating'      => $result['rating'],
					'href'        => $this->url->link('product/product', 'path=' . $this->request->get['path'] . '&product_id=' . $result['product_id'] . $url)
				);
			}

			$url = '';

			if (isset($this->request->get['filter'])) {
				$url .= '&filter=' . $this->request->get['filter'];
			}

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			$data['sorts'] = array();

			$data['sorts'][] = array(
				'text'  => $this->language->get('text_default'),
				'value' => 'p.sort_order-ASC',
				'href'  => $this->url->link('product/category', 'path=' . $this->request->get['path'] . '&sort=p.sort_order&order=ASC' . $url)
			);

			$data['sorts'][] = array(
				'text'  => $this->language->get('text_name_asc'),
				'value' => 'pd.name-ASC',
				'href'  => $this->url->link('product/category', 'path=' . $this->request->get['path'] . '&sort=pd.name&order=ASC' . $url)
			);

			$data['sorts'][] = array(
				'text'  => $this->language->get('text_name_desc'),
				'value' => 'pd.name-DESC',
				'href'  => $this->url->link('product/category', 'path=' . $this->request->get['path'] . '&sort=pd.name&order=DESC' . $url)
			);

			$data['sorts'][] = array(
				'text'  => $this->language->get('text_price_asc'),
				'value' => 'p.price-ASC',
				'href'  => $this->url->link('product/category', 'path=' . $this->request->get['path'] . '&sort=p.price&order=ASC' . $url)
			);

			$data['sorts'][] = array(
				'text'  => $this->language->get('text_price_desc'),
				'value' => 'p.price-DESC',
				'href'  => $this->url->link('product/category', 'path=' . $this->request->get['path'] . '&sort=p.price&order=DESC' . $url)
			);

			if ($this->config->get('config_review_status')) {
				$data['sorts'][] = array(
					'text'  => $this->language->get('text_rating_desc'),
					'value' => 'rating-DESC',
					'href'  => $this->url->link('product/category', 'path=' . $this->request->get['path'] . '&sort=rating&order=DESC' . $url)
				);

				$data['sorts'][] = array(
					'text'  => $this->language->get('text_rating_asc'),
					'value' => 'rating-ASC',
					'href'  => $this->url->link('product/category', 'path=' . $this->request->get['path'] . '&sort=rating&order=ASC' . $url)
				);
			}

			$data['sorts'][] = array(
				'text'  => $this->language->get('text_model_asc'),
				'value' => 'p.model-ASC',
				'href'  => $this->url->link('product/category', 'path=' . $this->request->get['path'] . '&sort=p.model&order=ASC' . $url)
			);

			$data['sorts'][] = array(
				'text'  => $this->language->get('text_model_desc'),
				'value' => 'p.model-DESC',
				'href'  => $this->url->link('product/category', 'path=' . $this->request->get['path'] . '&sort=p.model&order=DESC' . $url)
			);
                
			$url = '';

			if (isset($this->request->get['filter'])) {
				$url .= '&filter=' . $this->request->get['filter'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			$data['limits'] = array();

			$limits = array_unique(array($this->config->get('config_product_limit'), 25, 50, 75, 100));

			sort($limits);

			foreach($limits as $value) {
				$data['limits'][] = array(
					'text'  => $value,
					'value' => $value,
					'href'  => $this->url->link('product/category', 'path=' . $this->request->get['path'] . $url . '&limit=' . $value)
				);
			}

			$url = '';

			if (isset($this->request->get['filter'])) {
				$url .= '&filter=' . $this->request->get['filter'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			$pagination = new Pagination();
			$pagination->total = $product_total;
			$pagination->page = $page;
			$pagination->limit = $limit;
			$pagination->url = $this->url->link('product/category', 'path=' . $this->request->get['path'] . $url . '&page={page}');

			$data['pagination'] = $pagination->render();
			
				foreach ($pagination->prevnext() as $pagelink) {
					$this->document->addLink($pagelink['href'], $pagelink['rel']);
				}
				

			$data['results'] = sprintf($this->language->get('text_pagination'), ($product_total) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($product_total - $limit)) ? $product_total : ((($page - 1) * $limit) + $limit), $product_total, ceil($product_total / $limit));
			$data['name'] = "asd";
			$data['sort'] = $sort;
			$data['order'] = $order;


			$data['limit'] = $limit;


// OCFilter start
      $filter_name = '';

      if (!empty($filter_ocfilter)) {
        $params        = $this->model_catalog_ocfilter->decodeParamsFromString($filter_ocfilter);
        $options_count = 0;

        foreach ($params as $option_id => $values) {
          if ($filter_name) {
            $filter_name .= ', ';
          }

          // Add price
          if ($option_id == 'p') {
            $price_range = explode('-', array_shift($values));

            if (isset($price_range[0]) && isset($price_range[1])) {
              $filter_name .= 'от ' . $price_range[0] . ' до ' . $price_range[1] . $this->currency->getSymbolLeft($this->session->data['currency']) . $this->currency->getSymbolRight($this->session->data['currency']);
            }

            $options_count++;

            continue;
          }

          // Add stock status
          if ($option_id == 's') {
            $stock_status = array_shift($values);

            if ($stock_status == 'in') {
              $filter_name .= 'в наличии';
            } elseif ($stock_status == 'out') {
              $filter_name .= 'нет в наличии';
            }

            $options_count++;

            continue;
          }

          // Add manufacturers
          if ($option_id == 'm') {
            $values_name  = '';
            $values_count = 0;

            foreach ($values as $value_id) {
              $values_count++;
              $value_info = $this->model_catalog_manufacturer->getManufacturer($value_id);

              if ($value_info) {
                if ($values_name) {
                  $values_name .= ', ';
                }

                $values_name .= $value_info['name'];
              }
            }

            if ($values_count > 1) {
              $this->document->setNoindex(true);
            }

            $filter_name .= $values_name;
            $options_count++;

            continue;
          }

          // Add other filters
          $option_info = $this->model_catalog_ocfilter->getOption($option_id);

          if ($option_info) {
            $filter_name .= ' ' . $option_info['name'];
            $values_name  = '';
            $values_count = 0;

            if (isset($option_info['grouping']) && $option_info['grouping'] > 0) {
            	$grouping = $option_info['grouping'];

              $temp_values = array();

              foreach (array_chunk($values, $grouping) as $value_groups) {
                if (isset($value_groups[0])) {
                  $temp_values[] = $value_groups[0];
                }

                if (isset($value_groups[count($value_groups) - 1])) {
                  $temp_values[] = $value_groups[count($value_groups) - 1];
                }
              }

              $values = $temp_values;
            } else {
            	$grouping = 0;
            }

            foreach ($values as $key => $value_id) {
              $values_count++;
              $value_info = $this->model_catalog_ocfilter->getOptionValue($value_id);

              if ($value_info) {
                if ($values_name) {
                  if ($grouping == 0 || ($grouping > 0 && ($key % 2) == 0)) {
                    $values_name .= ', ';
                  }

                  if ($grouping > 0 && ($key % 2) != 0) {
                    $values_name .= ' - ';
                  }
                }

                $values_name .= $value_info['name'] . $option_info['postfix'];
              } else {
                $values_name .= $value_id . $option_info['postfix'];
              }
            }

            if ($values_count > 1) {
              $this->document->setNoindex(true);
            }

            $filter_name .= ' - ' . $values_name;

            $options_count++;
          }
        }

        if ($options_count > 1) {
          $this->document->setNoindex(true);
        }

        if ($filter_name) {
          $filter_name = strip_tags(html_entity_decode($filter_name, ENT_QUOTES, 'UTF-8'));

          $title = $category_info['meta_title'] ? $category_info['meta_title'] : $category_info['name'];

          $this->document->setTitle($title . ' ' . $filter_name);
          $this->document->setDescription($category_info['meta_description'] . ' ' . $filter_name);
          $this->document->setKeywords($category_info['meta_keyword'] . ' ' . $filter_name);

          $data['heading_title'] = $data['heading_title'] . ': ' . $filter_name;

          if (isset($this->request->get['ocfilter_path'])) {
            $ocfilter_page_info = $this->model_catalog_ocfilter->getPage($category_id, trim($this->request->get['ocfilter_path'], '/'));
          } else if ($ocfilter_path) {
            $ocfilter_page_info = $this->model_catalog_ocfilter->getPage($category_id, $ocfilter_path);
          } else {
            $params_href = $this->load->controller('module/ocfilter/getParamsHref', $filter_ocfilter);

            $ocfilter_page_info = $this->model_catalog_ocfilter->getPage($category_id, trim($params_href, '/'));
          }

          if ($ocfilter_page_info) {
            if (!isset($this->request->get['ocfilter_path'])) {
              $url = $host . $ocfilter_page_info['keyword'];

              if ($seo_type == 'seo_pro') {
                $url .= '/';
              }

            	$this->response->redirect($url);
            }

            $this->document->setNoindex(false);

            $this->document->setTitle($ocfilter_page_info['meta_title']);
            $this->document->setDescription($ocfilter_page_info['meta_description']);
            $this->document->setKeywords($ocfilter_page_info['meta_keyword']);

            $data['heading_title'] = $ocfilter_page_info['title'];

            $data['description'] = html_entity_decode($ocfilter_page_info['description'], ENT_QUOTES, 'UTF-8');
          }
        }
      }
    	// OCFilter end








			

			$data['continue'] = $this->url->link('common/home');


				$canonicals = $this->config->get('canonicals');
				if (isset($canonicals['canonicals_categories'])) {
					$this->document->removeLink('canonical');
					$pathx = explode('_', $this->request->get['path']);
					$pathx = end($pathx);
					$this->document->addLink($this->url->link('product/category', 'path=' . $pathx ), 'canonical');
					}
			
			$data['column_left'] = $this->load->controller('common/column_left');
			$data['column_right'] = $this->load->controller('common/column_right');
			$data['content_top'] = $this->load->controller('common/content_top');
			$data['content_bottom'] = $this->load->controller('common/content_bottom');
			$data['footer'] = $this->load->controller('common/footer');
			$data['header'] = $this->load->controller('common/header');

			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/product/category.tpl')) {
				$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/product/category.tpl', $data));
			} else {
				$this->response->setOutput($this->load->view('default/template/product/category.tpl', $data));
			}
		} else {
			$url = '';

			if (isset($this->request->get['path'])) {
				$url .= '&path=' . $this->request->get['path'];
			}

			if (isset($this->request->get['filter'])) {
				$url .= '&filter=' . $this->request->get['filter'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('text_error'),
				'href' => $this->url->link('product/category', $url)
			);

			$this->document->setTitle($this->language->get('text_error'));

			$data['heading_title'] = $this->language->get('text_error');

			$data['text_error'] = $this->language->get('text_error');

			$data['button_continue'] = $this->language->get('button_continue');

			$data['continue'] = $this->url->link('common/home');

			$this->response->addHeader($this->request->server['SERVER_PROTOCOL'] . ' 404 Not Found');


				$canonicals = $this->config->get('canonicals');
				if (isset($canonicals['canonicals_categories'])) {
					$this->document->removeLink('canonical');
					$pathx = explode('_', $this->request->get['path']);
					$pathx = end($pathx);
					$this->document->addLink($this->url->link('product/category', 'path=' . $pathx ), 'canonical');
					}
			
			$data['column_left'] = $this->load->controller('common/column_left');
			$data['column_right'] = $this->load->controller('common/column_right');
			$data['content_top'] = $this->load->controller('common/content_top');
			$data['content_bottom'] = $this->load->controller('common/content_bottom');
			$data['footer'] = $this->load->controller('common/footer');
			$data['header'] = $this->load->controller('common/header');

			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/error/not_found.tpl')) {
				$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/error/not_found.tpl', $data));
			} else {
				$this->response->setOutput($this->load->view('default/template/error/not_found.tpl', $data));
			}
		}
	}
}