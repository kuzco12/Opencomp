<?php
App::uses('AppController', 'Controller');

/**
  * AcademiesController.php
  *
  * PHP version 5
  *
  * @category Controller
  * @package  Opencomp
  * @author   Jean Traullé <jtraulle@gmail.com>
  * @license  http://www.opensource.org/licenses/agpl-v3 The Affero GNU General Public License
  * @link     http://www.opencomp.fr
  */

/**
 * Contrôleur de gestion des académies
 *
 * @category Controller
 * @package  Opencomp
 * @author   Jean Traullé <jtraulle@gmail.com>
 * @license  http://www.opensource.org/licenses/agpl-v3 The Affero GNU General Public License
 * @link     http://www.opencomp.fr
 */
class AcademiesController extends AppController {

/**
 * index method
 *
 * @return void
 */
    public function admin_index() {
	    $this->set('title_for_layout', __('Liste des académies'));
		$this->Academy->recursive = 0;
		$this->set('academies', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
	    $this->set('title_for_layout', __('Visualiser une académie'));
		$this->Academy->id = $id;
		if (!$this->Academy->exists()) {
			throw new NotFoundException(__('L\'académie demandée n\'existe pas !'), 'flash_error');
		}
		$this->set('academy', $this->Academy->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function admin_add() {
	    $this->set('title_for_layout', __('Ajouter une académie'));
		if ($this->request->is('post')) {
			$this->Academy->create();
			if ($this->Academy->save($this->request->data)) {
				$this->Session->setFlash(__('La nouvelle académie a été correctement ajoutée'), 'flash_success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Des erreurs ont été détectées durant la validation du formulaire. Veuillez corriger les erreurs mentionnées.'), 'flash_error');
			}
		}
		$users = $this->Academy->User->find('list');
		$this->set(compact('users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
	    $this->set('title_for_layout', __('Modifier une académie'));
		$this->Academy->id = $id;
		if (!$this->Academy->exists()) {
			throw new NotFoundException(__('L\'académie demandée n\'existe pas !'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Academy->save($this->request->data)) {
				$this->Session->setFlash(__('L\'académie a été correctement mise à jour'), 'flash_success');
				$this->redirect(array('action' => 'view', $this->data['Academy']['id']));
			} else {
				$this->Session->setFlash(__('Des erreurs ont été détectées durant la validation du formulaire. Veuillez corriger les erreurs mentionnées.'), 'flash_error');
			}
		} else {
			$this->request->data = $this->Academy->read(null, $id);
		}
		$users = $this->Academy->User->find('list');
		$this->set(compact('users'));
	}

/**
 * delete method
 *
 * @throws MethodNotAllowedException
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Academy->id = $id;
		if (!$this->Academy->exists()) {
			throw new NotFoundException(__('L\'académie demandée n\'existe pas !'));
		}
		if ($this->Academy->delete()) {
			$this->Session->setFlash(__('L\'académie a été correctement supprimée'), 'flash_success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('L\'académie n\'a pas pu être supprimée'), 'flash_error');
		$this->redirect(array('action' => 'index'));
	}
}
