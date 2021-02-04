<?php

class Currency extends CI_Controller {
    
    public $API_KEY = '6a09a089a4ea4c7e932603804bf63eba';
    
    public function __construct(){
                parent::__construct();
                $this->load->model('UsersModel');
                $this->load->model("CurrencyModel");
        }
        
        public function index()
	{
            $this->load->helper('url');
            $this->load->view('UsersViews/CurrencyView');
	}
        
         public function getAllCurrencies() {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL,"https://openexchangerates.org/api/latest.json?app_id=".$this->API_KEY);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $server_output = curl_exec ($ch);
            curl_close ($ch);
            // $result= json_decode(json_encode($server_output), TRUE);
            $data = json_decode($server_output, TRUE);
            return $data;
            
         }
         
         public function showCurrenciesData() {
            $data = $this->getAllCurrencies();
            //echo "<pre>".print_r($data['rates'],true)."</pre>";
            $data['view'] = "/CurrencyView";
            $this->load->view('elements/template',$data);
         }
         
         public function drawChart() {
            $labels = "";
            $values = "";
            $data = $this->getAllCurrencies();
            foreach ($data["rates"] as $key => $value) {
                if($value < 100){
                    $labels .= "'".$key."',";
                    $values .= $value.",";
                }
            }
            //$data["labels"] = array_keys($data["rates"]);
            //$data["values"] = array_values($data["rates"]);
            $data["labels"] = substr($labels, 0, -1);
            $data["values"] = substr($values, 0, -1);
            $data['view'] = "/ChartsView";
            $this->load->view('elements/template',$data);
             
         }
         
         public function exportCurrenciesData() {
            $this->load->model("CurrencyModel");
            $data = $this->getAllCurrencies();
            
            $exportData = $this->CurrencyModel->deleteAll();
            foreach ($data['rates'] as $curency => $value) {
                $insData = array(
                    "currency" => $curency,
                    "value"    => $value,
                    "base"     => $data['base'],
                    "time"     => date('d/m/Y H:i:s', $data['timestamp']),
                );
                $this->db->insert('currencies', $insData); 
            }
            $csv_file = "Currency; Value; Base; Date \n"; 
            $exportData = $this->CurrencyModel->getCurrencies();
            foreach ($exportData as $key => $currencies) {
                $csv_file .= $currencies['currency'].";".str_replace(".",",",$currencies['value']).";".$currencies['base'].";".$currencies['time']."\n";
            }
            $file = fopen('php://output','w');

            header('Content-Type: text/csv; charset=utf-8');
            header('Content-Disposition: attachment; filename=Currencies'.date('d/m/Y H:i:s').'.csv');

            $csv_handler = fopen('php://output', 'w');            
            fwrite ($csv_handler,$csv_file); //Write headers and data
            fclose ($csv_handler);  //Close CSV file connections
            fclose($file); 
         }
}