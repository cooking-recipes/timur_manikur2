<?php
class ControllerFeedGoogleSitemap extends Controller {
	public function index() {
		if ($this->config->get('google_sitemap_status')) {
			$output  = '<?xml version="1.0" encoding="UTF-8"?>';
			$output .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

			$this->load->model('catalog/product');

			$products = $this->model_catalog_product->getProductsSM();

			foreach ($products as $product) {
			
				$date = date_format( new DateTime($product['date_modified']), 'Y-m-d');
				if ($date == '-0001-11-30') { $date = date_format( new DateTime($product['date_added']), 'Y-m-d'); };
				
				$output .= '<url>';
				$url= str_replace("&", "&amp;", $this->url->link('product/product', 'product_id=' . $product['product_id']));
				$output .= '<loc>' . $url . '</loc>';
				$output .= '<lastmod>' . $date . '</lastmod>'; 
				$output .= '<changefreq>weekly</changefreq>';
				$output .= '<priority>1.0</priority>';
				$output .= '</url>';
			}

			$this->load->model('catalog/category');

			$output .= $this->getCategories(0);

			$this->load->model('catalog/manufacturer');

			$manufacturers = $this->model_catalog_manufacturer->getManufacturers();

			foreach ($manufacturers as $manufacturer) {
				$output .= '<url>';
				$url= str_replace("&", "&amp;", $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $manufacturer['manufacturer_id']));
				$output .= '<loc>' . $url . '</loc>';
				$output .= '<changefreq>weekly</changefreq>';
				$output .= '<priority>0.7</priority>';
				$output .= '</url>';
			}

			$this->load->model('catalog/information');

			$informations = $this->model_catalog_information->getInformations();

			foreach ($informations as $information) {
				$output .= '<url>';
				$url= str_replace("&", "&amp;", $this->url->link('information/information', 'information_id=' . $information['information_id']));
				$output .= '<loc>' . $url . '</loc>';
				$output .= '<changefreq>weekly</changefreq>';
				$output .= '<priority>0.5</priority>';
				$output .= '</url>';
			}

			$output .= '</urlset>';

			$this->response->addHeader('Content-Type: application/xml');
			$this->response->setOutput($output);
		}
	}

	protected function getCategories($parent_id, $current_path = '') {
		$output = '';

		$results = $this->model_catalog_category->getCategories($parent_id);

		foreach ($results as $result) {
			if (!$current_path) {
				$new_path = $result['category_id'];
			} else {
				$new_path = $current_path . '_' . $result['category_id'];
			}

			$output .= '<url>';
			$url= str_replace("&", "&amp;", $this->url->link('product/category', 'path=' . $new_path));
			$output .= '<loc>' . $url . '</loc>';
			$output .= '<changefreq>weekly</changefreq>';
			$output .= '<priority>0.7</priority>';
			$output .= '</url>';
			
			$output .= $this->getCategories($result['category_id'], $new_path);
		}

		return $output;
	}
}
