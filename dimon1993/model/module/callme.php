<?php
class ModelModuleCallme extends Model {


	public function deleteModule() {
	$this->db->query("DELETE FROM " . DB_PREFIX . "layout_module WHERE  code = 'callme' " );
	}

	public function addModule($layout_id) {
	$this->db->query("INSERT INTO " . DB_PREFIX . "layout_module SET layout_id = '" . (int)$layout_id . "', code = 'callme', position = 'content_top', sort_order = '1' " );
	}


}