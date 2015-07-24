<?php
	require_once "application/core/database.php";
	class Model_Reg extends Model
	{
		private $db;

		public function __construct() {
			$this->db = new DataBase();

		}

		function get_data_all(){
			return array();
		}

	}
?>