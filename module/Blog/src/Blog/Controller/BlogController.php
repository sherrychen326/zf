<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/Blog for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Blog\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Blog\Model\Poem;         
use Blog\Model\Author;

class BlogController extends AbstractActionController
{
    public function indexAction()
    {
        return new ViewModel(array(
             'poem' => $this->getPoemTable()->fetchAll(),
        		
         ));
    }

    public function fooAction()
    {
        // This shows the :controller and :action parameters in default route
        // are working when you browse to /blog/blog/foo
        return new ViewModel(array(
             'poem' => $this->getPoemTable()->fetchAll(),
        	 'author' => $this->getAuthorTable()->getAuthor(1),
        		
         ));
    }
    
    public function shirenAction(){
    	return new ViewModel(array(
    			'poem' => $this->getPoemTable()->fetchAll(),
    	
    	));
    }
    
    public function poemAction(){
    	return new ViewModel(array(
    			'poem' => $this->getPoemTable()->fetchAll(),
    			 
    	));
    }
   /* public function editAction(){
    	$id = (int) $this->params()->fromRoute('id', 0);
         if (!$id) {
             return $this->redirect()->toRoute('blog', array(
                 'action' => 'add'
             ));
         }

         // Get the Album with the specified id.  An exception is thrown
         // if it cannot be found, in which case go to the index page.
         try {
             $blog = $this->getBlogTable()->getBlog($id);
         }
         catch (\Exception $ex) {
             return $this->redirect()->toRoute('Blog', array(
                 'action' => 'index'
             ));
         }

         $form  = new BlogForm();
         $form->bind($blog);
         $form->get('submit')->setAttribute('value', 'Edit');

         $request = $this->getRequest();
         if ($request->isPost()) {
             $form->setInputFilter($blog->getInputFilter());
             $form->setData($request->getPost());

             if ($form->isValid()) {
                 $this->getBlogTable()->saveBlog($blog);

                 // Redirect to list of albums
                 return $this->redirect()->toRoute('blog');
             }
         }

         return array(
             'id' => $id,
             'form' => $form,
         );
    }
    
    public function addAction()
    {
    	$form = new BlogForm();
    	$form->get('submit')->setValue('Add');
    
    	$request = $this->getRequest();
    	if ($request->isPost()) {
    		$blog = new Blog();
    		$form->setInputFilter($blog->getInputFilter());
    		$form->setData($request->getPost());
    
    		if ($form->isValid()) {
    			$blog->exchangeArray($form->getData());
    			$this->getBlogTable()->saveBlog($blog);
    
    			// Redirect to list of albums
    			return $this->redirect()->toRoute('blog');
    		}
    	}
    	return array('form' => $form);
    }
    
    public function deleteAction()
    {
    	$id = (int) $this->params()->fromRoute('id', 0);
    	if (!$id) {
    		return $this->redirect()->toRoute('blog');
    	}
    
    	$request = $this->getRequest();
    	if ($request->isPost()) {
    		$del = $request->getPost('del', 'No');
    
    		if ($del == 'Yes') {
    			$id = (int) $request->getPost('id');
    			$this->getBlogTable()->deleteBlog($id);
    		}
    
    		// Redirect to list of albums
    		return $this->redirect()->toRoute('blog');
    	}
    
    	return array(
    			'id'    => $id,
    			'blog' => $this->getBlogTable()->getBlog($id)
    	);
    }
    */
    public function getPoemTable()
    {
    	if (!$this->PoemTable) {
    		$sm = $this->getServiceLocator();
    		$this->PoemTable = $sm->get('Blog\Model\PoemTable');
    	}
    	return $this->PoemTable;
    }
    
    public function getAuthorTable()
    {
    	if (!$this->AuthorTable) {
    		$sm = $this->getServiceLocator();
    		$this->AuthorTable = $sm->get('Blog\Model\AuthorTable');
    	}
    	return $this->AuthorTable;
    }
    
    protected $PoemTable;
    protected $AuthorTable;
}
