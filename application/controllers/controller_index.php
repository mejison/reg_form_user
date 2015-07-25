<?php
	
	class Controller_Index extends Controller
	{

		function action_show() {
			$this->model = new Model_Index();
			$data = $this->model->get_data_all();
			$this->view->generate('index_view.php', 'template_view.php',$data);
		}

	}
?>