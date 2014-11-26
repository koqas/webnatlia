<?php
class TemplateController extends AppController
{
	public $components	=	array("Paginator");
	
	public function beforeFilter()
	{
		parent::beforeFilter();
		$this->layout	=	"ajax";
	}
	public function Sidebar($sidebar_id=1)
	{
		$this->loadModel("CmsMenu");
		$this->CmsMenu->BindDefault();
		$menu			=	$this->CmsMenu->find("all",array(
								'order' 		=> 	array('CmsMenu.sort asc'),
								"conditions"	=>	array(
									"CmsMenu.status"	=>	"1"
								)
							));
		$this->set(compact("menu","sidebar_id"));
	}
}
?>