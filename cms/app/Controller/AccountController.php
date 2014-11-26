<?php
class AccountController extends AppController
{
	public function beforeFilter()
	{
		parent::beforeFilter();
		$this->layout	=	"login";
	}

	public function Login()
	{
		$this->loadModel("Admin");
		if($this->request->is('post'))
		{
			
			$this->Admin->set($this->request->data);
			$this->Admin->ValidateAdmin();
			
			if($this->Admin->validates())
			{
				if($this->Auth->login())
				{
					return $this->redirect($this->settings['cms_url']);
				}
				else
				{
					$this->Admin->validationErrors["username"]	=	"Invalid Username or Password";
				}
			}
		}
	}
	
	public function Test()
	{
		
	}
	public function Logout()
	{
		$this->Auth->logout();
		return $this->redirect($this->settings['cms_url']);
	}
}
?>