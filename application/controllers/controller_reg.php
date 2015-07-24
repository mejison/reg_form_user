<?php
	
	class Controller_Reg extends Controller
	{

		function action_show() {
			$this->model = new Model_Reg();
			$data = $this->model->get_data_all();
			$this->view->generate('reg_view.php', 'template_view.php',$data);
		}

	}
?>