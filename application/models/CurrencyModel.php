<?php
class CurrencyModel extends CI_Model 
{
	function getCurrencies(){
 		$response = array();
		$this->db->select('currency, value, base, time');
		$q = $this->db->get('currencies');
		$response = $q->result_array();
	 	return $response;
	}
        
        public function deleteAll() {
            $this->db->empty_table('currencies');
        }
	
}