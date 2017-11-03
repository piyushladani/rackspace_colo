<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Racks Controller
 *
 * @property \App\Model\Table\RacksTable $Racks
 *
 * @method \App\Model\Entity\Rack[] paginate($object = null, array $settings = [])
 */
class RacksController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Locations']
        ];
        $racks = $this->paginate($this->Racks);

        $this->set(compact('racks'));
        $this->set('_serialize', ['racks']);
    }

    /**
     * View method
     *
     * @param string|null $id Rack id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $rack = $this->Racks->get($id, [
            'contain' => ['Locations', 'Colocations', 'Shelfs']
        ]);
        $customer=$this->loadModel('Customers');
        $user=$this->loadModel('Users');

        $loc=$this->loadModel('Locations');
        
        $shelf=$this->loadModel('Shelfs');
        $this->set(compact('rack','customer','loc','shelf','user'));
        $this->set('_serialize', ['rack']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $rack = $this->Racks->newEntity();
        if ($this->request->is('post')) {
            $rack = $this->Racks->patchEntity($rack, $this->request->getData());
            if ($this->Racks->save($rack)) {
                $this->Flash->success(__('The rack has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The rack could not be saved. Please, try again.'));
        }
        $locations = $this->Racks->Locations->find('list', ['limit' => 200]);
        $this->set(compact('rack', 'locations'));
        $this->set('_serialize', ['rack']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Rack id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $rack = $this->Racks->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $rack = $this->Racks->patchEntity($rack, $this->request->getData());
            if ($this->Racks->save($rack)) {
                $this->Flash->success(__('The rack has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The rack could not be saved. Please, try again.'));
        }
        $locations = $this->Racks->Locations->find('list', ['limit' => 200]);
        $this->set(compact('rack', 'locations'));
        $this->set('_serialize', ['rack']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Rack id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $rack = $this->Racks->get($id);
        if ($this->Racks->delete($rack)) {
            $this->Flash->success(__('The rack has been deleted.'));
        } else {
            $this->Flash->error(__('The rack could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function isAuthorized($user)
{
    // All registered users can add articles
    if (in_array($this->request->getParam('action'), ['index','view'])) {
        return true;
    }
    
    return parent::isAuthorized($user);
}
}
