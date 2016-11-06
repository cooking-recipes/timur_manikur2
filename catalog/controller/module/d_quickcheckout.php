<?php
/*
 *  location: catalog/controller
 */

/*
default session Array
(
    [language] => en
    [currency] => USD
    [cart] => Array
        (
            [YToxOntzOjEwOiJwcm9kdWN0X2lkIjtpOjQwO30=] => 1
        )

    [captcha] => 773395
    [account] => guest
    [guest] => Array
        (
            [customer_group_id] => 1
            [firstname] => dsdasd
            [lastname] => asdasdas
            [email] => addd@dsdad.sd
            [telephone] => 131212
            [fax] => 
            [custom_field] => Array
                (
                    [2] => 2
                )

            [shipping_address] => 1
        )

    [payment_address] => Array
        (
            [firstname] => dsdasd
            [lastname] => asdasdas
            [company] => 
            [address_1] => dadsdas
            [address_2] => 
            [postcode] => sadadas
            [city] => asddas
            [country_id] => 222
            [zone_id] => 3514
            [country] => United Kingdom
            [iso_code_2] => GB
            [iso_code_3] => GBR
            [address_format] => 
            [custom_field] => Array
                (
                    [1] => empty
                )

            [zone] => Aberdeenshire
            [zone_code] => ABNS
        )

    [shipping_address] => Array
        (
            [firstname] => dsdasd
            [lastname] => asdasdas
            [company] => 
            [address_1] => dadsdas
            [address_2] => 
            [postcode] => sadadas
            [city] => asddas
            [country_id] => 222
            [zone_id] => 3514
            [country] => United Kingdom
            [iso_code_2] => GB
            [iso_code_3] => GBR
            [address_format] => 
            [zone] => Aberdeenshire
            [zone_code] => ABNS
            [custom_field] => Array
                (
                    [1] => empty
                )

        )

    [comment] => 
    [order_id] => 4
    [user_id] => 1
    [token] => 911910cb41cd6a5ec07657d6c012b16d
    [shipping_methods] => Array
        (
            [flat] => Array
                (
                    [title] => Flat Rate
                    [quote] => Array
                        (
                            [flat] => Array
                                (
                                    [code] => flat.flat
                                    [title] => Flat Shipping Rate
                                    [cost] => 5.00
                                    [tax_class_id] => 9
                                    [text] => $8.00
                                )

                        )

                    [sort_order] => 1
                    [error] => 
                )

        )

    [shipping_method] => Array
        (
            [code] => flat.flat
            [title] => Flat Shipping Rate
            [cost] => 5.00
            [tax_class_id] => 9
            [text] => $8.00
        )

    [payment_methods] => Array
        (
            [cod] => Array
                (
                    [code] => cod
                    [title] => Cash On Delivery
                    [terms] => 
                    [sort_order] => 5
                )

        )

    [payment_method] => Array
        (
            [code] => cod
            [title] => Cash On Delivery
            [terms] => 
            [sort_order] => 5
        )

)

custom fields
Array ( 
    [0] => Array ( 
        [custom_field_id] => 1 
        [custom_field_value] => Array ( ) 
        [name] => This is my first field 
        [type] => text 
        [value] => empty 
        [location] => address 
        [required] => 
        [sort_order] => 1 
    ) 

    [1] => Array ( 
        [custom_field_id] => 2 
        [custom_field_value] => Array ( 
            [0] => Array ( 
                [custom_field_value_id] => 2 
                [name] => test 
            ) 
            [1] => Array ( 
                [custom_field_value_id] => 3 
                [name] => go home 
            ) 
        ) 
        [name] => another option 
        [type] => radio 
        [value] => 
        [location] => account 
        [required] => 
        [sort_order] => 1 
    )
)
*/

class ControllerModuleDQuickcheckout extends Controller {
    private $id = 'd_quickcheckout';
    private $route = 'module/d_quickcheckout';
    private $sub_versions = array('lite', 'light', 'free');
    private $mbooth = '';
    private $config_file = '';
    private $prefix = '';
    private $error = array(); 
    private $debug = false;
    //private $scripts = array();
    private $setting = array();
    private $current_setting_id = '';

    public function __construct($registry) {
        parent::__construct($registry);

        $this->load->model('module/d_quickcheckout');
        $this->load->model('d_quickcheckout/address');
        $this->load->model('d_quickcheckout/method');
        $this->load->model('d_quickcheckout/order');
        $this->load->model('d_quickcheckout/custom_field');
        $this->load->model('account/address');

        $this->mbooth = $this->model_module_d_quickcheckout->getMboothFile($this->id, $this->sub_versions);

        $this->config_file = $this->model_module_d_quickcheckout->getConfigFile($this->id, $this->sub_versions);

        $this->current_setting_id = $this->model_module_d_quickcheckout->getCurrentSettingId($this->id, $this->config->get('config_store_id'));
    }

    public function index() {
        if(!$this->config->get('d_quickcheckout_status')){
            return false;
        }
        $this->debug = $this->config->get('d_quickcheckout_status');
        $this->initialize();

        $this->model_module_d_quickcheckout->logWrite('Load Styles and Scripts.', $this->debug);
        if($this->setting['design']['bootstrap']){
            $this->document->addStyle('catalog/view/theme/default/stylesheet/d_quickcheckout/bootstrap.css');
        }
        $this->document->addStyle('catalog/view/theme/default/stylesheet/d_quickcheckout/d_quickcheckout.css');
        $this->document->addStyle('catalog/view/theme/default/stylesheet/d_quickcheckout/theme/'.$this->setting['design']['theme'].'.css');
        $this->document->addScript('catalog/view/javascript/d_quickcheckout/library/jquery-validate/jquery.validate.min.js');
        $this->document->addScript('catalog/view/javascript/d_quickcheckout/library/jquery-maskedinput/jquery.maskedinput.min.js');
        $this->document->addScript('catalog/view/javascript/d_quickcheckout/library/underscore/underscore-min.js');
        $this->document->addScript('catalog/view/javascript/d_quickcheckout/library/backbone/backbone-min.js');
        $this->document->addScript('catalog/view/javascript/d_quickcheckout/library/backbone-nested/backbone-nested.js');
        $this->document->addScript('catalog/view/javascript/d_quickcheckout/library/backbone/backbone.validation.min.js');
        $this->document->addScript('catalog/view/javascript/d_quickcheckout/main.js');
        $this->document->addScript('catalog/view/javascript/d_quickcheckout/engine/model.js');
        $this->document->addScript('catalog/view/javascript/d_quickcheckout/engine/view.js');

        $data['json_config'] = json_encode($this->setting);
        $data['config'] = $this->setting;
        
        $this->model_module_d_quickcheckout->logWrite('Load Login', $this->debug);
        $data['login'] = $this->load->controller('d_quickcheckout/login', $this->setting);
        $this->model_module_d_quickcheckout->logWrite('Load Field', $this->debug);
        $data['field'] = $this->load->controller('d_quickcheckout/field');
        $this->model_module_d_quickcheckout->logWrite('Load payment_address', $this->debug);
        $data['payment_address'] = $this->load->controller('d_quickcheckout/payment_address', $this->setting);
        $this->model_module_d_quickcheckout->logWrite('Load shipping_address', $this->debug);
        $data['shipping_address'] = $this->load->controller('d_quickcheckout/shipping_address', $this->setting);
        $this->model_module_d_quickcheckout->logWrite('Load shipping_method', $this->debug);
        $data['shipping_method'] = $this->load->controller('d_quickcheckout/shipping_method', $this->setting);
        $this->model_module_d_quickcheckout->logWrite('Load payment_method', $this->debug);
        $data['payment_method'] = $this->load->controller('d_quickcheckout/payment_method', $this->setting);
        $this->model_module_d_quickcheckout->logWrite('Load cart', $this->debug);
        $data['cart'] = $this->load->controller('d_quickcheckout/cart', $this->setting);
        $this->model_module_d_quickcheckout->logWrite('Load payment', $this->debug);
        $data['payment'] = $this->load->controller('d_quickcheckout/payment', $this->setting);
        $this->model_module_d_quickcheckout->logWrite('Load confirm', $this->debug);
        $data['confirm'] = $this->load->controller('d_quickcheckout/confirm', $this->setting);

        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/d_quickcheckout.tpl')) {
            return $this->load->view($this->config->get('config_template') . '/template/module/d_quickcheckout.tpl', $data);
        } else {
            return $this->load->view('default/template/module/d_quickcheckout.tpl', $data);
        }
    }

     
    public function initialize(){

        $data = $this->model_module_d_quickcheckout->getConfigSetting($this->id, $this->id.'_setting', $this->config->get('config_store_id'), $this->config_file);
     
        $this->model_module_d_quickcheckout->logWrite('ControllerModuleDQuickcheckout Start...', $this->debug);

        $this->model_module_d_quickcheckout->logWrite('Initialize:: current_setting_id = '.$this->current_setting_id, $this->debug);

        $this->model_module_d_quickcheckout->logWrite('Initialize:: getConfigData('.$this->id.', '. $this->id.'_setting' .', '.$this->config->get('config_store_id').', '.$this->config_file .') = ' . serialize($data), $this->debug);


        //prepare config data
        $data['step']['payment_address']['fields']['country_id']['options'] = $this->model_d_quickcheckout_address->getCountries();
        $data['step']['payment_address']['fields']['zone_id']['options'] = $this->model_d_quickcheckout_address->getZonesByCountryId($this->model_d_quickcheckout_address->getPaymentAddressCountryId());
        $data['step']['payment_address']['fields']['customer_group_id']['options'] = $this->model_d_quickcheckout_address->getCustomerGroups();
        $data['step']['shipping_address']['fields']['country_id']['options'] = $this->model_d_quickcheckout_address->getCountries();
        $data['step']['shipping_address']['fields']['zone_id']['options'] = $this->model_d_quickcheckout_address->getZonesByCountryId($this->model_d_quickcheckout_address->getShippingAddressCountryId());

        foreach($data['account'] as $account => $account_data){
            $data['account'][$account] =  $this->model_module_d_quickcheckout->array_merge_r_d($account_data, $data['step']);
        }

        $this->model_module_d_quickcheckout->logWrite('Initialize:: prepare setting for accounts', $this->debug);

        $field_count = array(
            'guest' => array('payment_address' => 0, 'shipping_address' => 0, 'confirm' => 0),
            'register' => array('payment_address' => 0, 'shipping_address' => 0, 'confirm' => 0),
            'logged' => array('payment_address' => 0, 'shipping_address' => 0, 'confirm' => 0)
        );
        foreach($data['account'] as $account => $account_data){
            foreach($data['account'][$account]['payment_address']['fields'] as $field){
                if(isset($field['display']) && $field['display']){
                    $field_count[$account]['payment_address'] += 1;
                }   
            }
            foreach($data['account'][$account]['shipping_address']['fields'] as $field){
                if(isset($field['display']) && $field['display']){
                    $field_count[$account]['shipping_address'] += 1;
                }   
            }
            foreach($data['account'][$account]['confirm']['fields'] as $field){
                if(isset($field['display']) && $field['display']){
                    $field_count[$account]['confirm'] += 1;
                }   
            }
        }

        $this->model_module_d_quickcheckout->logWrite('Initialize:: count fields for statistics', $this->debug);
 
        $this->load->language('module/d_quickcheckout');
        $this->load->language('checkout/checkout');
        $data = $this->model_module_d_quickcheckout->languageFilter($data);
        $this->model_module_d_quickcheckout->logWrite('Initialize:: prepare languages', $this->debug);
        // check for different versions.
        foreach($data['account'] as $account => $account_data){
            $data['account'][$account]['payment_address']['fields']['newsletter']['title'] = sprintf($account_data['payment_address']['fields']['newsletter']['title'], $this->config->get('config_name'));
        }
        $data['trigger'] = $this->model_module_d_quickcheckout->getConfigData($this->id, $this->id.'_trigger', $this->config->get('config_store_id'), $this->config_file);
        $data['general']['debug'] = $this->model_module_d_quickcheckout->getConfigData($this->id, $this->id.'_debug', $this->config->get('config_store_id'), $this->config_file);


        $this->model_module_d_quickcheckout->logWrite('Initialize:: prepare setting and session->data[d_quickcheckout]', $this->debug);

        //prepare session data
        if($this->customer->isLogged()){
            $this->session->data['account'] = 'logged';
        }else{
            $this->session->data['account'] = (!empty($this->session->data['account']) && $this->session->data['account'] !== 'logged') ? $this->session->data['account'] : $data['step']['login']['default_option'];
        }

        $account = $this->session->data['account'];

        unset($data['step']);

        $this->session->data['d_quickcheckout'] = $data;
        $this->setting = $data; 

        $this->model_module_d_quickcheckout->logWrite('Initialize:: set $this->session->data[account] = ' . $this->session->data['account'], $this->debug);

        if($this->setting['general']['clear_session']){
            $this->session->data['guest'] = array(
                'customer_group_id' => $this->config->get('config_customer_group_id'),
                'firstname' => $data['account'][$account]['payment_address']['fields']['firstname']['value'],
                'lastname' => $data['account'][$account]['payment_address']['fields']['lastname']['value'],
                'email' => $data['account'][$account]['payment_address']['fields']['email']['value'],
                'password' => $data['account'][$account]['payment_address']['fields']['password']['value'],
                'telephone' => $data['account'][$account]['payment_address']['fields']['telephone']['value'],
                'fax' => $data['account'][$account]['payment_address']['fields']['fax']['value'],
                'custom_field' =>  '',
                'shipping_address' => $data['account'][$account]['payment_address']['fields']['shipping_address']['value']
            );
            $this->session->data['payment_address'] = array(
                'firstname' => $data['account'][$account]['payment_address']['fields']['firstname']['value'],
                'lastname' => $data['account'][$account]['payment_address']['fields']['lastname']['value'],
                'email' => $data['account'][$account]['payment_address']['fields']['email']['value'],
                'fax' => $data['account'][$account]['payment_address']['fields']['fax']['value'],
                'password' => $data['account'][$account]['payment_address']['fields']['password']['value'],
                'customer_group_id' => $this->config->get('config_customer_group_id'),
                'company' => $data['account'][$account]['payment_address']['fields']['company']['value'],
                'address_1' => $data['account'][$account]['payment_address']['fields']['address_1']['value'],
                'address_2' => $data['account'][$account]['payment_address']['fields']['address_2']['value'],
                'postcode' => $data['account'][$account]['payment_address']['fields']['postcode']['value'],
                'city' => $data['account'][$account]['payment_address']['fields']['city']['value'],
                'country_id' => $data['account'][$account]['shipping_address']['fields']['country_id']['value'],
                'zone_id' => $data['account'][$account]['shipping_address']['fields']['zone_id']['value'],
                'country' => '',
                'iso_code_2' => '',
                'iso_code_3' => '',
                'address_format' => '',
                'custom_field' => '',
                'zone' => '',
                'zone_code' => '',
                'agree' => $data['account'][$account]['payment_address']['fields']['agree']['value'],
                'shipping_address' => $data['account'][$account]['payment_address']['fields']['shipping_address']['value'],
                'newsletter' => $data['account'][$account]['payment_address']['fields']['newsletter']['value'],
                'address_id' => $this->customer->getAddressId(),
            );
            $this->session->data['shipping_address'] = array(
                'firstname' => $data['account'][$account]['shipping_address']['fields']['firstname']['value'],
                'lastname' => $data['account'][$account]['shipping_address']['fields']['lastname']['value'],
                'company' => $data['account'][$account]['shipping_address']['fields']['company']['value'],
                'address_1' => $data['account'][$account]['shipping_address']['fields']['address_1']['value'],
                'address_2' => $data['account'][$account]['shipping_address']['fields']['address_2']['value'],
                'postcode' => $data['account'][$account]['shipping_address']['fields']['postcode']['value'],
                'city' => $data['account'][$account]['shipping_address']['fields']['city']['value'],
                'country_id' => $data['account'][$account]['shipping_address']['fields']['country_id']['value'],
                'zone_id' => $data['account'][$account]['shipping_address']['fields']['zone_id']['value'],
                'country' => '',
                'iso_code_2' => '',
                'iso_code_3' => '',
                'address_format' => '',
                'custom_field' => '',
                'zone' => '',
                'zone_code' => '',
                'address_id' => $this->customer->getAddressId(),
            );
            $this->session->data['confirm'] = array(

                'comment' => '',
                'agree' =>  0,

            );

        }else{
        
            $this->session->data['guest'] = array(
                'customer_group_id' => (!empty($this->session->data['payment_address']['customer_group_id'])) ? $this->session->data['payment_address']['customer_group_id'] : $this->config->get('config_customer_group_id'),
                'firstname' => (!empty($this->session->data['payment_address']['firstname'])) ? $this->session->data['payment_address']['firstname'] : '',
                'lastname' => (!empty($this->session->data['payment_address']['lastname'])) ? $this->session->data['payment_address']['lastname'] : '',
                'email' => (!empty($this->session->data['payment_address']['email'])) ? $this->session->data['payment_address']['email'] : '',
                'password' => (!empty($this->session->data['payment_address']['password'])) ? $this->session->data['payment_address']['password'] : '',
                'telephone' => (!empty($this->session->data['payment_address']['telephone'])) ? $this->session->data['payment_address']['telephone'] : '',
                'fax' => (!empty($this->session->data['payment_address']['fax'])) ? $this->session->data['payment_address']['fax'] : '',
                'custom_field' => (!empty($this->session->data['payment_address']['custom_field']['account'])) ? array('account' => $this->session->data['payment_address']['custom_field']['account']) : $this->model_d_quickcheckout_custom_field->setCustomFieldsDefaultSessionData('payment_address', 'account'),

                'shipping_address' => (isset($this->session->data['payment_address']['shipping_address'])) ? $this->session->data['payment_address']['shipping_address'] : $data['account'][$account]['payment_address']['fields']['shipping_address']['value']
                );
            
            $this->session->data['payment_address'] = array(
                'firstname' =>  (!empty($this->session->data['payment_address']['firstname'])) ? $this->session->data['payment_address']['firstname'] : $data['account'][$account]['payment_address']['fields']['firstname']['value'],
                'lastname' =>  (!empty($this->session->data['payment_address']['lastname'])) ? $this->session->data['payment_address']['lastname'] : $data['account'][$account]['payment_address']['fields']['lastname']['value'],
                'email' => (!empty($this->session->data['payment_address']['email'])) ? $this->session->data['payment_address']['email'] : $data['account'][$account]['payment_address']['fields']['email']['value'],
                'telephone' => (!empty($this->session->data['payment_address']['telephone'])) ? $this->session->data['payment_address']['telephone'] : $data['account'][$account]['payment_address']['fields']['telephone']['value'],
                'fax' => (!empty($this->session->data['payment_address']['fax'])) ? $this->session->data['payment_address']['fax'] : $data['account'][$account]['payment_address']['fields']['fax']['value'],
                'password' => (!empty($this->session->data['payment_address']['password'])) ? $this->session->data['payment_address']['password'] : '',
                'customer_group_id' => (!empty($this->session->data['payment_address']['customer_group_id'])) ? $this->session->data['payment_address']['customer_group_id'] : $this->config->get('config_customer_group_id'),
                
                'company' =>  (!empty($this->session->data['payment_address']['company'])) ? $this->session->data['payment_address']['company'] : $data['account'][$account]['payment_address']['fields']['company']['value'],
                'address_1' =>  (!empty($this->session->data['payment_address']['address_1'])) ? $this->session->data['payment_address']['address_1'] : $data['account'][$account]['payment_address']['fields']['address_1']['value'],
                'address_2' =>  (!empty($this->session->data['payment_address']['address_2'])) ? $this->session->data['payment_address']['address_2'] : $data['account'][$account]['payment_address']['fields']['address_2']['value'],
                'postcode' =>  (!empty($this->session->data['payment_address']['postcode'])) ? $this->session->data['payment_address']['postcode'] : $data['account'][$account]['payment_address']['fields']['postcode']['value'],
                'city' =>  (!empty($this->session->data['payment_address']['city'])) ? $this->session->data['payment_address']['city'] : $data['account'][$account]['payment_address']['fields']['city']['value'],
                'country_id' =>  (!empty($this->session->data['payment_address']['country_id'])) ? $this->session->data['payment_address']['country_id'] : $data['account'][$account]['payment_address']['fields']['country_id']['value'],
                'zone_id' =>  (!empty($this->session->data['payment_address']['zone_id'])) ? $this->session->data['payment_address']['zone_id'] : $data['account'][$account]['payment_address']['fields']['zone_id']['value'],
                'country' =>  (!empty($this->session->data['payment_address']['country'])) ? $this->session->data['payment_address']['country'] : '',
                'iso_code_2' =>  (!empty($this->session->data['payment_address']['iso_code_2'])) ? $this->session->data['payment_address']['iso_code_2'] : '',
                'iso_code_3' =>  (!empty($this->session->data['payment_address']['iso_code_3'])) ? $this->session->data['payment_address']['iso_code_3'] : '',
                'address_format' =>  (!empty($this->session->data['payment_address']['address_format'])) ? $this->session->data['payment_address']['address_format'] : '',
                'custom_field' => ((!empty($this->session->data['payment_address']['custom_field']['account'])) ? array('account' => $this->session->data['payment_address']['custom_field']['account']) : $this->model_d_quickcheckout_custom_field->setCustomFieldsDefaultSessionData('payment_address', 'account')) + ((!empty($this->session->data['payment_address']['custom_field']['address'])) ? array('address' => $this->session->data['payment_address']['custom_field']['address']) :  $this->model_d_quickcheckout_custom_field->setCustomFieldsDefaultSessionData('payment_address', 'address')),

                'zone' =>  (!empty($this->session->data['payment_address']['zone'])) ? $this->session->data['payment_address']['zone'] : '',
                'zone_code' =>  (!empty($this->session->data['payment_address']['zone_code'])) ? $this->session->data['payment_address']['zone_code'] : '',
                'agree' =>  (isset($this->session->data['payment_address']['agree'])) ? $this->session->data['payment_address']['agree'] :  $data['account'][$account]['payment_address']['fields']['agree']['value'],
                'shipping_address' =>  (isset($this->session->data['payment_address']['shipping_address'])) ? $this->session->data['payment_address']['shipping_address'] : $data['account'][$account]['payment_address']['fields']['shipping_address']['value'],
                'newsletter' => (isset($this->session->data['payment_address']['newsletter'])) ? $this->session->data['payment_address']['newsletter'] : $data['account'][$account]['payment_address']['fields']['newsletter']['value'],
                'address_id' => (!empty($this->session->data['payment_address']['address_id'])) ? $this->session->data['payment_address']['address_id'] : $this->customer->getAddressId(),

            );
             $this->model_module_d_quickcheckout->logWrite('Initialize:: set session payment address', $this->debug);
            
            $this->session->data['shipping_address'] = array(
                'firstname' =>  (!empty($this->session->data['shipping_address']['firstname'])) ? $this->session->data['shipping_address']['firstname'] : $data['account'][$account]['shipping_address']['fields']['firstname']['value'],
                'lastname' =>  (!empty($this->session->data['shipping_address']['lastname'])) ? $this->session->data['shipping_address']['lastname'] : $data['account'][$account]['shipping_address']['fields']['lastname']['value'],
                'company' =>  (!empty($this->session->data['shipping_address']['company'])) ? $this->session->data['shipping_address']['company'] : $data['account'][$account]['shipping_address']['fields']['company']['value'],
                'address_1' =>  (!empty($this->session->data['shipping_address']['address_1'])) ? $this->session->data['shipping_address']['address_1'] : $data['account'][$account]['shipping_address']['fields']['address_1']['value'],
                'address_2' =>  (!empty($this->session->data['shipping_address']['address_2'])) ? $this->session->data['shipping_address']['address_2'] : $data['account'][$account]['shipping_address']['fields']['address_2']['value'],
                'postcode' =>  (!empty($this->session->data['shipping_address']['postcode'])) ? $this->session->data['shipping_address']['postcode'] : $data['account'][$account]['shipping_address']['fields']['postcode']['value'],
                'city' =>  (!empty($this->session->data['shipping_address']['city'])) ? $this->session->data['shipping_address']['city'] : $data['account'][$account]['shipping_address']['fields']['city']['value'],
                'country_id' =>  (!empty($this->session->data['shipping_address']['country_id'])) ? $this->session->data['shipping_address']['country_id'] : $data['account'][$account]['shipping_address']['fields']['country_id']['value'],
                'zone_id' =>  (!empty($this->session->data['shipping_address']['zone_id'])) ? $this->session->data['shipping_address']['zone_id'] : $data['account'][$account]['shipping_address']['fields']['zone_id']['value'],
                'country' =>  (!empty($this->session->data['shipping_address']['country'])) ? $this->session->data['shipping_address']['country'] : '',
                'iso_code_2' =>  (!empty($this->session->data['shipping_address']['iso_code_2'])) ? $this->session->data['shipping_address']['iso_code_2'] : '',
                'iso_code_3' =>  (!empty($this->session->data['shipping_address']['iso_code_3'])) ? $this->session->data['shipping_address']['iso_code_3'] : '',
                'address_format' =>  (!empty($this->session->data['shipping_address']['address_format'])) ? $this->session->data['shipping_address']['address_format'] : '',
                'custom_field' => ((!empty($this->session->data['shipping_address']['custom_field']['address'])) ? array('address' => $this->session->data['shipping_address']['custom_field']['address']) : $this->model_d_quickcheckout_custom_field->setCustomFieldsDefaultSessionData('shipping_address', 'address')),

                'zone' =>  (!empty($this->session->data['shipping_address']['zone'])) ? $this->session->data['shipping_address']['zone'] : '',
                'zone_code' =>  (!empty($this->session->data['shipping_address']['zone_code'])) ? $this->session->data['shipping_address']['zone_code'] : '',
                'address_id' => (!empty($this->session->data['shipping_address']['address_id'])) ? $this->session->data['shipping_address']['address_id'] : $this->customer->getAddressId(),
            );

        }

        $this->session->data['payment_address'] = $this->session->data['payment_address'] + $this->model_d_quickcheckout_custom_field->getCustomFieldsSessionData('guest', 'account');
        $this->session->data['payment_address'] = $this->session->data['payment_address'] + $this->model_d_quickcheckout_custom_field->getCustomFieldsSessionData('payment_address', 'address');
        $this->session->data['shipping_address'] = $this->session->data['shipping_address'] + $this->model_d_quickcheckout_custom_field->getCustomFieldsSessionData('shipping_address', 'address');
        
        if($this->customer->isLogged() && $this->session->data['payment_address']['address_id'] && $this->session->data['payment_address']['address_id'] != 'new'){
            $this->session->data['payment_address'] = $this->model_d_quickcheckout_address->getAddress($this->session->data['payment_address']['address_id']);
        }
        

        if($this->customer->isLogged() && $this->session->data['shipping_address']['address_id'] && $this->session->data['shipping_address']['address_id'] != 'new'){
            $this->session->data['shipping_address'] = $this->model_d_quickcheckout_address->getAddress($this->session->data['shipping_address']['address_id']);
        }

        $this->model_module_d_quickcheckout->logWrite('Initialize:: set session shipping address', $this->debug);
        
        $this->model_d_quickcheckout_address->updateTaxAddress();

        $this->load->controller('d_quickcheckout/shipping_method/prepare');

        $this->model_module_d_quickcheckout->logWrite('Initialize:: set session shipping methods', $this->debug);

        $this->session->data['comment'] = (!empty($this->session->data['comment'])) ? $this->session->data['comment'] : $data['account'][$account]['confirm']['fields']['comment']['value'];
        
        $this->session->data['confirm'] = array(

            'comment' => $this->session->data['comment'],
            'agree' => (isset($this->session->data['confirm']['agree'])) ? $this->session->data['confirm']['agree'] : $data['account'][$account]['confirm']['fields']['agree']['value'],
        );

        $this->session->data['totals'] = $this->model_d_quickcheckout_order->getTotals($total_data, $total, $taxes);
        
        $this->load->controller('d_quickcheckout/payment_method/prepare');

        $this->model_module_d_quickcheckout->logWrite('Initialize:: set session payment methods', $this->debug);

        $this->session->data['order_id'] = $this->createOrder();

        $this->model_module_d_quickcheckout->logWrite('Initialize:: create new Order_id and prepare $this->session->data', $this->debug);

        //statistic
        $this->session->data['statistic'] = array('account' => $this->session->data['account'], 'field' => $field_count);
        $this->session->data['statistic_id'] = $this->model_module_d_quickcheckout->setStatistic($this->current_setting_id, $this->session->data['order_id'], $this->session->data['statistic'], $this->customer->getId());
    }

    public function createOrder(){
        $order_data = array();
        
        $this->model_d_quickcheckout_order->getTotals($total_data, $total, $taxes);
        
        $this->load->language('checkout/checkout');

        if(isset($this->session->data['payment_address']['zone_id'])){
            $order_data['payment_zone_id'] = $this->session->data['payment_address']['zone_id'];
        }else{
            $order_data['payment_zone_id'] = $this->config->get('config_zone_id');
        }
        if(isset($this->session->data['payment_address']['country_id'])){
           $order_data['payment_country_id'] = $this->session->data['payment_address']['country_id']; 
        }else{
           $order_data['payment_country_id'] = $this->config->get('config_country_id');
        }
        
        $order_data['invoice_prefix'] = $this->config->get('config_invoice_prefix');
        $order_data['store_id'] = $this->config->get('config_store_id');
        $order_data['store_name'] = $this->config->get('config_name');

        if ($order_data['store_id']) {
            $order_data['store_url'] = $this->config->get('config_url');
        } else {
            $order_data['store_url'] = HTTP_SERVER;
        }

        $order_data['total'] = $total;

        if (isset($this->request->cookie['tracking'])) {
            $order_data['tracking'] = $this->request->cookie['tracking'];

            $subtotal = $this->cart->getSubTotal();

            // Affiliate
            $this->load->model('affiliate/affiliate');

            $affiliate_info = $this->model_affiliate_affiliate->getAffiliateByCode($this->request->cookie['tracking']);

            if ($affiliate_info) {
                $order_data['affiliate_id'] = $affiliate_info['affiliate_id'];
                $order_data['commission'] = ($subtotal / 100) * $affiliate_info['commission'];
            } else {
                $order_data['affiliate_id'] = 0;
                $order_data['commission'] = 0;
            }

            // Marketing
            $this->load->model('checkout/marketing');

            $marketing_info = $this->model_checkout_marketing->getMarketingByCode($this->request->cookie['tracking']);

            if ($marketing_info) {
                $order_data['marketing_id'] = $marketing_info['marketing_id'];
            } else {
                $order_data['marketing_id'] = 0;
            }
        } else {
            $order_data['affiliate_id'] = 0;
            $order_data['commission'] = 0;
            $order_data['marketing_id'] = 0;
            $order_data['tracking'] = '';
        }

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

        return $this->model_d_quickcheckout_order->addOrder($order_data);
    }
}