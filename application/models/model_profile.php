<?php
	require_once "application/core/database.php";
	class Model_Profile extends Model
	{
		private $db;

		public function __construct() {
			$this->db = new DataBase();

		}

		function get_data_all(){
			return array();
		}
		function get_data_html(){
			$data = $this->db->select('book','*','`name` LIKE \'%html%\'');
			return $data;
		}
		function get_data_css(){
			$data = $this->db->select('book','*','`name` LIKE \'%css%\' OR `description` LIKE \'%css%\'');
			return $data;
		}
		function get_data_php(){
			$data = $this->db->select('book','*','`name` LIKE \'%php%%\' OR `description` LIKE \'%php%\'');
			return $data;
		}
		function get_data_sql(){
			$data = $this->db->select('book','*','`name` LIKE \'%sql%\' OR `description` LIKE \'%sql%\'');
			return $data;
		}
	}
?>