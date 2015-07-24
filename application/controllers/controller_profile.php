<?php
	
	class Controller_Profile extends Controller
	{
		function action_show() {
			$this->model = new Model_Profile();
			$data = $this->model->get_data_all();
			$this->view->generate('profile_view.php', 'template_view.php',$data);
		}

	}
?>