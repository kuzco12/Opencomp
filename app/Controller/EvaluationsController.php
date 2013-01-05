<?php
App::uses('AppController', 'Controller');
/**
 * Evaluations Controller
 *
 * @property Evaluation $Evaluation
 */
class EvaluationsController extends AppController {


/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function attacheditems($id = null) {
		$this->Evaluation->id = $id;
		if (!$this->Evaluation->exists()) {
			throw new NotFoundException(__('Invalid evaluation'));
		}
		$this->Evaluation->contain(array('User', 'Period', 'Classroom', 'Pupil.first_name', 'Pupil.name'));
		$evaluation = $this->Evaluation->findById($id);		
		$this->set('evaluation', $evaluation);
		
		$this->Evaluation->EvaluationsItem->contain(array('Item.title'));
		$items = $this->Evaluation->EvaluationsItem->findAllByEvaluationId($id, array(), array('EvaluationsItem.position' => 'asc'));
		$this->set('items', $items);
		
	}
	
	public function manageresults($id = null) {
		$this->Evaluation->id = $id;
		if (!$this->Evaluation->exists()) {
			throw new NotFoundException(__('Invalid evaluation'));
		}
		$this->Evaluation->contain(array('User', 'Period', 'Classroom', 'Pupil.Result.evaluation_id = '.$id, 'Item'));
		$evaluation = $this->Evaluation->findById($id);
		$result = $this->Evaluation->resultsForAnEvaluation($id);
		$this->set('resultats', $result);
		$this->set('evaluation', $evaluation);
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		//On vérifie qu'un paramètre nommé classroom_id a été fourni et qu'il existe.
		if(isset($this->request->params['named']['classroom_id'])) {
       		$classroom_id = intval($this->request->params['named']['classroom_id']);
       		$this->set('classroom_id', $classroom_id);
       		$this->Evaluation->Classroom->id = $classroom_id;
			if (!$this->Evaluation->Classroom->exists()) {
				throw new NotFoundException(__('The classroom_id provided does not exist !'));
			}
		} else {
			throw new NotFoundException(__('You must provide a classroom_id in order to add a test to this classroom !'));
		}
		
		if ($this->request->is('post')) {
			$this->Evaluation->create();
			if ($this->Evaluation->save($this->request->data)) {
				$this->Session->setFlash(__('La nouvelle évaluation a été correctement ajoutée.'), 'flash_success');
				$this->redirect(array('controller' => 'evaluations','action' => 'attacheditems', $this->Evaluation->id));
			} else {
				$this->Session->setFlash(__('Des erreurs ont été détectées durant la validation du formulaire. Veuillez corriger les erreurs mentionnées.'), 'flash_error');
			}
		}
		
		$users = $this->Evaluation->User->find('list', array(
			'recursive' => 0,
			'conditions' => array('id' => $this->Evaluation->User->findAllUsersInClassroom($classroom_id))
			)
		);
		
		$etab = $this->Evaluation->Classroom->find('first', array(
			'fields'=>'establishment_id',
			'conditions'=>array(
				'Classroom.id'=>$classroom_id
			),
			'recursive'=>-1
		));
		
		$this->Evaluation->Classroom->contain(array('Establishment.current_period_id'));
		$current_period = $this->Evaluation->Classroom->findById($classroom_id, 'Establishment.current_period_id');
		$current_period = $current_period['Establishment']['current_period_id'];
		
		$periods = $this->Evaluation->Period->find('list', array(
			'conditions' => array('establishment_id' => $etab['Classroom']['establishment_id']),
			'recursive' => 0));
		
		$pupils = $this->Evaluation->findPupilsByLevelsInClassroom($classroom_id);
		$this->set(compact('classrooms', 'users', 'periods', 'pupils', 'current_period'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Evaluation->id = $id;
		if (!$this->Evaluation->exists()) {
			throw new NotFoundException(__('Invalid evaluation'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Evaluation->save($this->request->data)) {
				$this->Session->setFlash(__('L\'évaluation a été correctement mise à jour.'), 'flash_success');
				$this->redirect(array('controller' => 'classrooms','action' => 'viewtests', $this->request->data['Evaluation']['classroom_id']));
			} else {
				$this->Session->setFlash(__('Des erreurs ont été détectées durant la validation du formulaire. Veuillez corriger les erreurs mentionnées.'), 'flash_error');
			}
		} else {
			$this->request->data = $this->Evaluation->read(null, $id);
			$classroom_id = $this->request->data['Evaluation']['classroom_id'];
			$this->set('classroom_id', $classroom_id);
		}
	
		$users = $this->Evaluation->User->find('list', array(
			'recursive' => 0,
			'conditions' => array('id' => $this->Evaluation->User->findAllUsersInClassroom($classroom_id))
			)
		);
		
		$etab = $this->Evaluation->Classroom->find('first', array(
			'fields'=>'establishment_id',
			'conditions'=>array(
				'Classroom.id'=>$classroom_id
			),
			'recursive'=>-1
		));
		
		$periods = $this->Evaluation->Period->find('list', array(
			'conditions' => array('establishment_id' => $etab['Classroom']['establishment_id']),
			'recursive' => 0));
		
		$pupils = $this->Evaluation->findPupilsByLevelsInClassroom($classroom_id);
		$this->set(compact('classrooms', 'users', 'periods', 'pupils'));
	}

/**
 * delete method
 *
 * @throws MethodNotAllowedException
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Evaluation->id = $id;
		if (!$this->Evaluation->exists()) {
			throw new NotFoundException(__('Invalid evaluation'));
		}
		$classroom_id = $this->Evaluation->read('Evaluation.classroom_id', $id);
		if ($this->Evaluation->delete()) {
			$this->Session->setFlash(__("L'évaluation a été correctement supprimée"), 'flash_success');
			$this->redirect(array(
			    'controller'    => 'classrooms',
			    'action'        => 'viewtests',
			    $classroom_id['Evaluation']['classroom_id']));
		}
		$this->Session->setFlash(__("L'évaluation n'a pas pu être supprimée en raison d'une erreur interne"), 'flash_error');
		$this->redirect(array(
		    'controller'    => 'classrooms',
		    'action'        => 'viewtests'));
	}
}
