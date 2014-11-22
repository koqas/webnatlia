<?php

class SplashController extends AppController
{
	var $ControllerName		=	"Splash";
	var $ModelName			=	"Splash";
	var $helpers			=	array("Text");

	

	public function index()
	{
		$this->layout = 'splash';
	}
	/*
	public function Index()
	{
		
		$this->loadModel('Album');
		$albums = $this->Album->find('all', array(
			'conditions' => array(
				'Album.status' => 1,
			),
			'order' => array(
				'Album.created desc'
			),
			'limit' => 4
		));
		//ini untuk slider paling atas. 
		$this->loadModel('Schedule');
		$schedules = $this->Schedule->find('all', array(
			'conditions' => array(
				'Schedule.status' => 1,
				'ScheduleType.id' => 2, //public
			),
			'limit' => 5,
			'order' => array(
				'Schedule.id desc'
			)
		));
		
		//cari todays schedule nya nih. 
		$todaysDate = date("Y-m-d");
		$todaysSchedule = $this->Schedule->find('all', array(
			'conditions' => array(
				'Schedule.status' => 1, 
				'Schedule.schedule_type_id' => 2,
				'Schedule.start_date' => $todaysDate
			),
			'recursive' => -1
		));
		
		//cari news nya nih gan.. 
		$this->loadModel('News');
		$newses = $this->News->find('all', array(
			'conditions' => array(
				'News.status' => 1
			),
			'limit' => 10,
			'order' => array(
				'News.published_date asc', 
				'News.created desc', 
			)
		));


		$newsin = $this->News->find('all', array(
			'conditions' => array(
				'News.id >' => 6
			),
			'limit' => 10,
		));
		//pr($newsin);
		
		//pr($newses);
		
		$this->set(compact('albums','schedules', 'todaysSchedule', 'newses', 'iklans', 'newsin'));
		
	}
	
	public function Tentangikk() 
	{
		$data = $this->Home->find('first',array(
				'conditions' => array(
					'Home.status' 	=> 1,
					'Home.id'		=> 1,
					),
					'recursive' => 2
				));
		//pr($data);
		$this->set(compact('data'));
	}
	
	public function Tentangkubang()
	{
		$data = $this->Home->find('first',array(
				'conditions' => array(
					'Home.status' 	=> 1,
					'Home.id'		=> 2,
					),
					'recursive' => 2
				));
		//pr($data);
		$this->set(compact('data'));
	}

	public function Pengurusikk()
	{
		$data = $this->Home->find('first',array(
				'conditions' => array(
					'Home.status' 	=> 1,
					'Home.id'		=> 3,
					),
					'recursive' => 2
				));
		//pr($data);
		$this->set(compact('data'));
	}

	public function Lapuangikk()
	{
		$data = $this->Home->find('first',array(
				'conditions' => array(
					'Home.status' 	=> 1,
					'Home.id'		=> 4,
					),
					'recursive' => 2
				));
		//pr($data);
		$this->set(compact('data'));
	}
	
	public function Login()
	{
		$this->loadModel('Setting');
		$settings = $this->Setting->find('first', array(
			'conditions' => array(
				'Setting.status' => 1
				)
			));
		$this->loadModel('User');
		if ($this->request->is('post')) {
			
	        if ($this->Auth->login()) {
	            //$this->redirect(array('action' => 'index'));
	            //header("Location: ".$settings['Setting']['web_url']."Home/Index");
	            $this->redirect($settings['Setting']['web_url']);
	        }
	        $this->Session->setFlash(__('Invalid username or password, please try again'));
	    }
	    $this->set(compact('settings'));
	}
	
	public function Logout()
	{
		
		$this->loadModel('Setting');
		$settings = $this->Setting->find('first', array(
		'conditions' => array(
			'Setting.status' => 1
			)
		));
		
		$this->Auth->logout();
		$this->redirect($settings['Setting']['web_url']);

	}*/
	
}