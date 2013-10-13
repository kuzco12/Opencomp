<?php
App::uses('AppController', 'Controller');
/**
 * Lpcnodes Controller
 *
 * @property Lpcnode $Lpcnode
 * @property PaginatorComponent $Paginator
 */
class LpcnodesController extends AppController {

/**
 * Helpers
 *
 * @var array
 */
	public $helpers = array('Tree');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->set('title_for_layout', __('Livret Personnel de Compétences'));	
        $stuff = $this->Lpcnode->find('all',  
        	array(
            	'fields' => array('title', 'lft', 'rght'), 
            	'order' => 'lft ASC',
            )
        ); 
        $this->set('stuff', $stuff); 
	}

	public function moveup($id = null) {
	    $this->Lpcnode->id = $id;
	    if (!$this->Lpcnode->exists()) {
	       throw new NotFoundException(__('Ce noeud n\'existe pas ;)'));
	    }

	    $this->Lpcnode->moveUp($this->Competence->id, 1);
	    $this->redirect(array('action' => 'index'));
	}
	
	public function movedown($id = null) {
	    $this->Lpcnode->id = $id;
	    if (!$this->Lpcnode->exists()) {
	       throw new NotFoundException(__('Ce noeud n\'existe pas ;)'));
	    }

	    $this->Lpcnode->moveDown($this->Lpcnode->id, 1);
	    $this->redirect(array('action' => 'index'));
	}
	
	public function deleteNode($id = null) {
	    $this->Lpcnode->id = $id;
	    if (!$this->Lpcnode->exists()) {
	       throw new NotFoundException(__('Ce noeud n\'existe pas ;)'));
	    }

		$this->Lpcnode->delete();
	    $this->redirect(array('action' => 'index'));
	}

/**
 * add method
 *
 * @return void
 */
	public function add($id = null) {
		$this->set('title_for_layout', __('Ajouter un noeud au Livret Personnel de Compétences'));
		if ($this->request->is('post')) {
			$this->Lpcnode->create();
			if ($this->Lpcnode->save($this->request->data)) {
				$this->Session->setFlash(__('La nouvelle compétence a été correctement ajoutée'), 'flash_success');
				if(isset($this->request->data['Lpcnode']['parent_id']))
					$this->redirect(array('action' => 'add', $this->request->data['Lpcnode']['parent_id']));
				else
					$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Des erreurs ont été détectées durant la validation du formulaire. Veuillez corriger les erreurs mentionnées.'), 'flash_error');
			}
		}
		
		//On passe le paramètre à la vue
		if(isset($id) && is_numeric($id))
			$this->set('idnode', $id);
		
		//Récupération des ids des catégories existantes	
		$competenceids = $this->Lpcnode->generateTreeList(null, null, null, "");
		/*foreach ($competenceids as $key => $value) {
		    $models = $this->Lpcnode->getPath($key);
		    $path = '';
		    foreach ($models as $model) {
		        $path .= $model['Lpcnode']['title'] . ' > ';
			}
		    $path = substr($path, 0, strlen($path) - 3); // strip of last ' > '
		    $competenceids[$key] = $path;
		}	*/	
		$this->set('cid', $competenceids);
		
	}


}
