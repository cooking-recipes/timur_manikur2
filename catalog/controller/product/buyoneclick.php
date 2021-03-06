<?php

class ControllerProductBuyoneclick extends Controller
{

    public function index($data)
    {
        // If Display stock is enable and out of stock is disbale - do not show fastorder button
        if ($this->config->get('config_stock_display')
            and !$this->config->get('config_stock_checkout')
            and $this->model_catalog_product->getProduct($data['product_id'])['quantity'] < 1
        ) {
            return false;
        }

        // Load language
        $this->load->language('product/buyoneclick');

        // Language data
        $data['text_buyoneclick_phone'] = $this->language->get('text_buyoneclick_phone');
        $data['text_buyoneclick_success_message'] = $this->language->get('text_buyoneclick_success_message');
        
        $data['text_buy_one_click'] = $this->language->get('text_buy_one_click');
        $data['text_check_telephone_number'] = $this->language->get('text_check_telephone_number');
        $data['text_buy_one_click_want'] = $this->language->get('text_buy_one_click_want');
        $data['text_wrong_number'] = $this->language->get('text_wrong_number');


        if (!isset($data['price'])) {
            $data['price'] = $data['txt_none_price'];
        }

        if ($this->config->get('config_template')) {
            $template = $this->config->get('config_template');
        } else {
            $template = 'default';
        }

        $this->document->addStyle('catalog/view/theme/' . $template . '/stylesheet/buyoneclick.css');

        if (VERSION >= '2.2.0.0') {
            return $this->load->view('product/buyoneclick.tpl', $data);
        } else {
            return $this->load->view($this->config->get('config_template') . '/template/product/buyoneclick.tpl', $data);
        }
    }


    public function oneclickadd(){

        // Load language
        $this->load->language('product/buyoneclick');


        $option_totals = array();
        $order_data = array();
        $order_data['totals'] = $option_totals;
        $order_data['payment_firstname'] = "-";
        $order_data['payment_lastname'] = "-";
        $order_data['payment_company'] = "-";
        $order_data['payment_address_1'] = "-";
        $order_data['payment_address_2'] ="-";
        $order_data['payment_city'] = "-";
        $order_data['payment_postcode'] = "-";
        $order_data['payment_zone'] = "-";
        $order_data['payment_zone_id'] = 0;
        $order_data['payment_country'] = "-";
        $order_data['payment_country_id'] = 0;
        $order_data['payment_address_format'] = "-";
        $order_data['payment_custom_field'] = "-";
        $order_data['customer_id'] = 0;
        $order_data['customer_group_id'] = 0;
        $order_data['firstname'] = "Один";
        $order_data['lastname'] = "Клик";
        $order_data['email'] = "lorem@lo.com";
        $order_data['telephone'] = $this->request->post['tel_number'];
        $order_data['fax'] = "";
        $order_data['custom_field'] = "";
        $order_data['shipping_firstname'] = '';
        $order_data['shipping_lastname'] = '';
        $order_data['shipping_company'] = '';
        $order_data['shipping_address_1'] = '';
        $order_data['shipping_address_2'] = '';
        $order_data['shipping_city'] = '';
        $order_data['shipping_postcode'] = '';
        $order_data['shipping_zone'] = '';
        $order_data['shipping_zone_id'] = '';
        $order_data['shipping_country'] = '';
        $order_data['shipping_country_id'] = '';
        $order_data['shipping_address_format'] = '';
        $order_data['shipping_custom_field'] = array();
        $order_data['shipping_method'] = '';
        $order_data['shipping_code'] = '';

        $order_data['products'] = array();

        $order_data['marketing_id'] = 0;
        $order_data['affiliate_id'] = 0;
        $order_data['commission'] = 0;
        $order_data['marketing_id'] = 0;
        $order_data['tracking'] = '';
        $order_data['affiliate_id'] = 0;
        $order_data['commission'] = 0;
        $order_data['language_id'] = $this->config->get('config_language_id');
        $order_data['currency_id'] = $this->currency->getId();
        $order_data['currency_code'] = $this->currency->getCode();
        $order_data['currency_value'] = $this->currency->getValue($this->currency->getCode());
        $order_data['ip'] = $this->request->server['REMOTE_ADDR'];
        if (!empty($this->request->server['HTTP_X_FORWARDED_FOR'])) {
            $order_data['forwarded_ip'] = $this->request->server['HTTP_X_FORWARDED_FOR'];
        } elseif (!empty($this->request->server['HTTP_CLIENT_IP'])) {
            $order_data['forwarded_ip'] = $this->request->server['HTTP_CLIENT_IP'];
        } else {
            $order_data['forwarded_ip'] = '';
        }
        if (isset($this->request->server['HTTP_USER_AGENT'])) {
            $order_data['user_agent'] = $this->request->server['HTTP_USER_AGENT'];
        } else {
            $order_data['user_agent'] = '';
        }

        if (isset($this->request->server['HTTP_ACCEPT_LANGUAGE'])) {
            $order_data['accept_language'] = $this->request->server['HTTP_ACCEPT_LANGUAGE'];
        } else {
            $order_data['accept_language'] = '';
        }
        $order_data['store_id'] = 0;
        $order_data['store_name'] = $this->config->get('config_name');;
        $order_data['store_url'] = HTTP_SERVER;
        $order_data['invoice_prefix'] = $this->config->get('config_invoice_prefix');
        $order_data['payment_method'] = '';
        $order_data['payment_code'] = 0;
        $order_data['comment'] = '';
       
       

        $order_data['products'] = array();
        $order_data['order_status_id'] = 1;
        $order_data['_id'] = 1;
        $order_data['product_id'] = $this->request->post['product_id'];
        $this->load->model('catalog/product');
        //$temp_data = array();
        $temp_data = $this->model_catalog_product->getProduct( $order_data['product_id']);
          $quantity = $this->request->post['quantity'];
         $order_data['total'] = $quantity*$temp_data['price'];
        $option_data = array();
         
        $order_data['products'][] = array(
            'product_id' => $temp_data['product_id'],
            'name'       => $temp_data['name'],
            'model'      => $temp_data['model'],
            'download'   => 0,
            /*'quantity'   => $temp_data['quantity'],*/
            'quantity'   => $quantity,
            'subtract'   => 0,
            'option'	 => $option_data,
            'price'      => $temp_data['price'],
            'total'      => '',
            'tax'        => 0,
            'reward'     => $temp_data['reward']
        );

        $this->load->model('checkout/order');
        $orderid = $this->model_checkout_order->addOrder($order_data);
        try {
            $this->model_checkout_order->addOrderHistory($orderid, 1, '');
        }
        catch (Exception $ex) {
            // do nothing

        }

        $data = array();
        $data['text_order_success'] = $this->language->get('text_order_success');
        $data['success'] = true;
        $data['code'] = $orderid;


        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($data));


    }

       public function oneclickaddcallback(){

        // Load language
        $this->load->language('product/buyoneclick');


        $option_totals = array();
        $order_data = array();
        $order_data['totals'] = $option_totals;
        $order_data['payment_firstname'] = "-";
        $order_data['payment_lastname'] = "-";
        $order_data['payment_company'] = "-";
        $order_data['payment_address_1'] = "-";
        $order_data['payment_address_2'] ="-";
        $order_data['payment_city'] = "-";
        $order_data['payment_postcode'] = "-";
        $order_data['payment_zone'] = "-";
        $order_data['payment_zone_id'] = 0;
        $order_data['payment_country'] = "-";
        $order_data['payment_country_id'] = 0;
        $order_data['payment_address_format'] = "-";
        $order_data['payment_custom_field'] = "-";
        $order_data['customer_id'] = 0;
        $order_data['customer_group_id'] = 0;
        $order_data['firstname'] = "Перезвонить";
        $order_data['lastname'] = "!!!";
        $order_data['email'] = "lorem@lo.com";
        $order_data['telephone'] = $this->request->post['tel_number'];
        $order_data['fax'] = "";
        $order_data['custom_field'] = "";
        $order_data['shipping_firstname'] = '';
        $order_data['shipping_lastname'] = '';
        $order_data['shipping_company'] = '';
        $order_data['shipping_address_1'] = '';
        $order_data['shipping_address_2'] = '';
        $order_data['shipping_city'] = '';
        $order_data['shipping_postcode'] = '';
        $order_data['shipping_zone'] = '';
        $order_data['shipping_zone_id'] = '';
        $order_data['shipping_country'] = '';
        $order_data['shipping_country_id'] = '';
        $order_data['shipping_address_format'] = '';
        $order_data['shipping_custom_field'] = array();
        $order_data['shipping_method'] = '';
        $order_data['shipping_code'] = '';

        $order_data['products'] = array();

        $order_data['marketing_id'] = 0;
        $order_data['affiliate_id'] = 0;
        $order_data['commission'] = 0;
        $order_data['marketing_id'] = 0;
        $order_data['tracking'] = '';
        $order_data['affiliate_id'] = 0;
        $order_data['commission'] = 0;
        $order_data['language_id'] = $this->config->get('config_language_id');
        $order_data['currency_id'] = $this->currency->getId();
        $order_data['currency_code'] = $this->currency->getCode();
        $order_data['currency_value'] = $this->currency->getValue($this->currency->getCode());
        $order_data['ip'] = $this->request->server['REMOTE_ADDR'];
        if (!empty($this->request->server['HTTP_X_FORWARDED_FOR'])) {
            $order_data['forwarded_ip'] = $this->request->server['HTTP_X_FORWARDED_FOR'];
        } elseif (!empty($this->request->server['HTTP_CLIENT_IP'])) {
            $order_data['forwarded_ip'] = $this->request->server['HTTP_CLIENT_IP'];
        } else {
            $order_data['forwarded_ip'] = '';
        }
        if (isset($this->request->server['HTTP_USER_AGENT'])) {
            $order_data['user_agent'] = $this->request->server['HTTP_USER_AGENT'];
        } else {
            $order_data['user_agent'] = '';
        }

        if (isset($this->request->server['HTTP_ACCEPT_LANGUAGE'])) {
            $order_data['accept_language'] = $this->request->server['HTTP_ACCEPT_LANGUAGE'];
        } else {
            $order_data['accept_language'] = '';
        }
        $order_data['store_id'] = 0;
        $order_data['store_name'] = $this->config->get('config_name');;
        $order_data['store_url'] = HTTP_SERVER;
        $order_data['invoice_prefix'] = $this->config->get('config_invoice_prefix');
        $order_data['payment_method'] = '';
        $order_data['payment_code'] = 0;
        $order_data['comment'] = '';
       
       

        $order_data['products'] = array();
        $order_data['order_status_id'] = 1;
        $order_data['_id'] = 1;
        $order_data['product_id'] = 0;
        $this->load->model('catalog/product');
        //$temp_data = array();
        $temp_data = $this->model_catalog_product->getProduct( $order_data['product_id']);
          $quantity = 0;
         $order_data['total'] = 0;
        $option_data = array();
         
        $order_data['products'][] = array(
            'product_id' => $temp_data['product_id'],
            'name'       => $temp_data['name'],
            'model'      => $temp_data['model'],
            'download'   => 0,
            /*'quantity'   => $temp_data['quantity'],*/
            'quantity'   => $quantity,
            'subtract'   => 0,
            'option'     => $option_data,
            'price'      => $temp_data['price'],
            'total'      => '',
            'tax'        => 0,
            'reward'     => $temp_data['reward']
        );

        $this->load->model('checkout/order');
        $orderid = $this->model_checkout_order->addOrder($order_data);
        try {
            $this->model_checkout_order->addOrderHistory($orderid, 1, '');
        }
        catch (Exception $ex) {
            // do nothing

        }

        $data = array();
        $data['text_order_success'] = $this->language->get('text_order_success');
        $data['success'] = true;
        $data['code'] = $orderid;


        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($data));

    }

  public function getFormBAck() {






        $this->load->model('catalog/product');

        $this->language->load('module/buyinoneclick');

    return $this->load->view($this->config->get('config_template').'/theme509/module/buyinoneclick_formBAck.tpl');

        die();
      /*      $this->template = $this->config->get('config_template') . '/theme509/module/buyinoneclick_formBAck.tpl';
        } else {
            $this->template = 'theme509/template/module/buyinoneclick_formBAck.tpl';
        }*/
/*  $this->response->setOutput($this->render());*/



        die();

        $this->data['heading_title'] = $this->language->get('heading_title');

        $this->data['text_wait'] = $this->language->get('text_wait');

        $this->data['entry_contact'] = $this->language->get('entry_contact');
        $this->data['entry_name'] = $this->language->get('entry_name');

        $this->data['button_send'] = $this->language->get('button_send');

        if ($this->config->get('buyinoneclick_phone_mask_status')) {
            $this->data['phone_mask'] = $this->config->get('buyinoneclick_phone_mask');
        } else {
            $this->data['phone_mask'] = '';
        }

        $this->data['phone_text'] = $this->config->get('buyinoneclick_phone_text');

        $this->data['stock_status'] = 1;
        $this->data['customer_firstname'] = '';
        $product_info = $this->model_catalog_product->getProduct($this->request->get['product_id']);
        $this->data['product_img'] = $product_info['image'];
        $this->data['product_name'] = $product_info['name'];
        $this->data['product_price'] = (float) $this->currency->format((float)$product_info['special'] ? $product_info['special'] : $product_info['price'], $product_info['tax_class_id'], $this->config->get('config_tax'));
        $this->data['this_tax'] = $this->currency->getSymbolRight();
        $this->data['entry_price'] = $this->language->get('entry_price');
        $this->data['entry_qty'] = $this->language->get('entry_qty');
        $this->data['entry_total'] = $this->language->get('entry_total');
        
    /*  if (!$this->config->get('config_stock_checkout') || $this->config->get('config_stock_warning')) {

            if (!$product_info['quantity'] || ($product_info['quantity'] < 0)) {
                $this->data['error_warning'] = $this->language->get('error_stock');

                if (!$this->config->get('config_stock_checkout')) {
                    $this->data['stock_status'] = 0;
                }
            }
        }*/

        if ($this->customer->isLogged()) {
            
            $this->load->model('account/customer');

            $customer = $this->model_account_customer->getCustomer($this->customer->getId());
            
            $this->data['customer_firstname'] = $customer['firstname'];
        }

        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/buyinoneclick_formBAck.tpl')) {
            $this->template = $this->config->get('config_template') . '/theme509/module/buyinoneclick_formBAck.tpl';
        } else {
            $this->template = 'theme509/template/module/buyinoneclick_formBAck.tpl';
        }

/*        $this->response->setOutput($this->render());*/
    }


}