<?php
 App::uses('File', 'Utility');
class BlogsController extends AppController
{

    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow(array('view'));
    }
	public function admin_index()
	{
		
	}
	
	public function admin_view()
	{
		
		$this->loadModel('Blog');
		$this->set('blogdata',$this->paginate('Blog'));
		
		
	}
	
	public function view($id = null){
		 $this->layout='front'; 
		$this->Blog->id = $id;
        if (!$this->Blog->exists()) {
            throw new NotFoundException(__('Invalid Blog'));
        }
        $this->set('blog', $this->Blog->read(null, $id));		
	}
	
	
	public function admin_edit($id=null)
	{
		$data1 = $this->Blog->find('first',array('conditions'=>array('Blog.id'=>$id)));
		$this->set('data',$data1);


	   //pr($this->request->data);die;
	 if($this->request->is('post') || $this->request->is('put')) {
		
	               $this->Blog->id = $id;
				   	$one = $this->data['Blog']['image']; 
					$this->request->data['Blog']['image'] = $one['name'];
				  if ($one['name'] != '') {
                $this->request->data['Blog']['image'] = $one['name'];
				@$imageNAME = $data1['Blog']['image'];
				$file =WWW_ROOT . 'blogs/'.$imageNAME;
				//$file->delete();
            } 
			else {
				if($this->data['Blog']['old_image']!=''){
					$this->request->data['Blog']['image'] = @$this->data['Blog']['old_image'];
				} 
				else{
					$this->request->data['Blog']['image'] = @$data1['Blog']['image'];
				}
                
            }	
			

			if ($this->Blog->save($this->request->data)) {
				 $time=time();
				   if ($one['error'] == 0) {
                    $pth = WWW_ROOT . 'blogs/'.$one['name'].$time;
                    move_uploaded_file($one['tmp_name'], $pth);
                    $this->Blog->saveField("image",$one['name'].$time);        
					}
			$this->Session->setFlash(__('Your  Blog  has been updated.'));
            return $this->redirect(array('action' => 'admin_view'));
        }
        $this->Session->setFlash(__('Unable to update your Blog.'));
    } 
	
	 
		
	}
	
	
	
	
	
	
	
	
	public function admin_add()
	{
		//pr($_FILES);die;
		//pr($this->request->data);exit;
		 $one = $this->data['Blog']['image']; 
		 $this->request->data['Blog']['image'] = $one['name'];
	 if ($this->request->is('post')) {
            $this->Blog->create();
            if ($this->Blog->save($this->request->data)) {
				$id    = $this->Blog->getLastInsertId();
				 if ($one['name'] != '') {
					       $date=time();
							$imageName = $one['name'].$date;
                            $path = WWW_ROOT . 'blogs/';
                            move_uploaded_file($one['tmp_name'], $path . $imageName);                            
                            $this->Blog->id = $id;
                            $this->Blog->saveField("image", $imageName);                    
                    }
				  $this->Session->setFlash(__('Your Blog has been added.'));
                return $this->redirect(array('action' => 'view'));
            }
            $this->Session->setFlash(__('Unable to add your Blog.'));
        }
  }
	
	public function admin_delete($id=null)
	{
		$d=$this->Blog->find('first',array('conditions'=>array('Blog.id'=>$id)));
		$path = WWW_ROOT .'blogs/'.$d['Blog']['image'];
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Blog->id = $id;
			if (!$this->Blog->exists()) {
			throw new NotFoundException(__('Invalid Blog'));
		}
		$d=$this->Blog->find('first',array('conditions'=>array('Blog.id'=>$id)));
		$path = WWW_ROOT .'Blogs/'.$d['Blog']['image'];	
		
		if ($this->Blog->delete($id,true)) {
			$this->Session->setFlash(__('Blog deleted'));
			$this->redirect(array('action' => 'view'));
		}
		if($path)
		{
		unlink($path);	
		}
		$this->Session->setFlash(__('Blog was not deleted'));
		$this->redirect(array('action' => 'view'));
		}	
       
	   
	   public function admin_deleteall($id = null){
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        foreach ($this->request['data']['Blog'] as $k) {
            $this->Blog->id = (int) $k;
            if ($this->Blog->exists()) {
                $this->Blog->delete($k,true);
            }
            
        }
        
        $this->Session->setFlash(__('Selected Blogs were removed.'));
      //  $this->redirect($this->data['currentloc']);
	  $this->redirect(array('controller'=>'Blogs', 'action' => 'view'
            ));
    }
	   
	  
	       public function admin_block($id = null)
    {
        $this->Blog->id = $id;
        if ($this->Blog->exists()) {
            $x = $this->Blog->save(array(
                'Blog' => array(
                    'status' => '0'
                )
            ));
            $this->Session->setFlash("Blog Deactivated successfully.");
            $this->redirect(array(
                'action' => 'view'
            ));
        } else {
            $this->Session->setFlash("Unable to deactivate Blog.");
            $this->redirect(array(
                'action' => 'view'
            ));
        }
        
    }
	   
	    public function admin_activate($id = null)
    {
        $this->Blog->id = $id;
        if ($this->Blog->exists()) {
            $x = $this->Blog->save(array(
                'Blog' => array(
                    'status' => '1'
                )
            ));
            $this->Session->setFlash("Blog activated successfully.");
            $this->redirect(array(
                'action' => 'view'
            ));
        } else {
            $this->Session->setFlash("Unable to activate Blog.");
            $this->redirect(array(
                'action' => 'view'
            ));
        }
        
    } 
	   
	   
	   
	   
	   
	   
	   
	   
	   
	   }

?>