<?php 
class HomesController extends AppController
{
	var $layout='front'; 
	public function beforeFilter(){
		            parent::beforeFilter();
                     $this->Auth->allow('index');    
	} 
	 public function index() {
		$this->loadModel('Slider');
		$this->loadModel('Service');
		$this->loadModel('Blog');
		$this->loadModel('Sitesetting');
		$Slider = $this->Slider->find('all',array('conditions'=>array('Slider.status'=>1)));
		$this->set('slider',$Slider);
		$service = $this->Service->find('all',array('conditions'=>array('Service.status'=>1)));
		$this->set('service',$service);
			
		$Blog = $this->Blog->find('all',array('conditions'=>array('Blog.status'=>1)));
		$this->set('blog',$Blog);
		$site = $this->Sitesetting->find('first');
		$page_title =  $site['Sitesetting']['meta_title'];
		$page_description  =  $site['Sitesetting']['meta_description'];
		$page_keyword =  $site['Sitesetting']['meta_keyword'];
		$this->set(compact('page_title', 'page_description', 'page_keyword'));
	}

}
?>