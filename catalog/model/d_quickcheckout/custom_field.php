<?php
/*
 *	location: admin/model
 */

class ModelDQuickcheckoutCustomField extends Model {

	public function getCustomFieldsByLocation($location){
		$this->load->model('account/custom_field');
		$results = $this->model_account_custom_field->getCustomFields();	
		foreach($results as $key => $result){
			if($result['location'] != $location){
				unset($results[$key]);
			}
		}
		return $results;
	}
	public function getCustomFieldsConfigData($location){

		$results = $this->getCustomFieldsByLocation($location);

		$custom_fields = array();
		foreach($results as $key => $custom_field){

			$custom_fields['custom_field.'.$location.'.'.$custom_field['custom_field_id']] = array(
				'id' => 'custom_field.'.$location.'.'.$custom_field['custom_field_id'],
				'title' => $custom_field['name'],
				'tooltip' => '',
				'error' => '',
				'type' => $custom_field['type'],
				'options' => '',
				'refresh' => '0',
				'custom' => 1,
				'location' => $custom_field['location'],
				'sort_order' => $custom_field['sort_order'],
				'class' => '',
				// 'display' => 1,
				// 'require' => $custom_field['required'],

			);

			if(!empty($custom_field['custom_field_value'])){

				foreach($custom_field['custom_field_value'] as $option){

					$custom_fields['custom_field.'.$location.'.'.$custom_field['custom_field_id']]['options'][] = array(
						'name' =>  $option['name'],
						'value' =>  $option['custom_field_value_id'],
					);
				}
			}
		}

		return $custom_fields;
	}

	public function getCustomFieldsSessionData($step, $location){
		$results = $this->getCustomFieldsByLocation($location);

		$custom_fields = array();

		foreach($results as $key => $custom_field){

			$custom_fields['custom_field.'.$location.'.'.$custom_field['custom_field_id']] = (isset($this->session->data[$step]['custom_field'][$location][$custom_field['custom_field_id']])) ? $this->session->data[$step]['custom_field'][$location][$custom_field['custom_field_id']] : '';
		}

		return $custom_fields;
	}

	public function setCustomFieldsDefaultSessionData($step, $location){
		$results = $this->getCustomFieldsByLocation($location);

		$custom_fields = array();

		foreach($results as $key => $custom_field){

			$custom_fields[$location][$custom_field['custom_field_id']] = (isset($custom_field['value'])) ? $custom_field['value']:'';
		}

		return $custom_fields;
	}

	public function setCustomFieldValue($data){
		$custom_fields = array();

		if(is_array($data)){
			foreach($data as $location => $custom_field){
		
				if(is_array($custom_field)){
					foreach($custom_field as $key => $value){
						$custom_fields['custom_field.'.$location.'.'.$key] = $value;
					}
				}
			}

			return $custom_fields;
		}
	}

}