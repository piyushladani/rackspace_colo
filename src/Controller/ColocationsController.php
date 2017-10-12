<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Colocations Controller
 *
 * @property \App\Model\Table\ColocationsTable $Colocations
 *
 * @method \App\Model\Entity\Colocation[] paginate($object = null, array $settings = [])
 */
class ColocationsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Customers', 'Locations', 'Racks']
        ];
        $colocations = $this->paginate($this->Colocations);

        $this->set(compact('colocations'));
        $this->set('_serialize', ['colocations']);
    }

    /**
     * View method
     *
     * @param string|null $id Colocation id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $colocation = $this->Colocations->get($id, [
            'contain' => ['Customers', 'Locations', 'Racks', 'Shelfs']
        ]);

        $this->set('colocation', $colocation);
        $this->set('_serialize', ['colocation']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $colocation = $this->Colocations->newEntity();
        if ($this->request->is('post')) {
            $colocation = $this->Colocations->patchEntity($colocation, $this->request->getData());
            if ($this->Colocations->save($colocation)) {
                $this->Flash->success(__('The colocation has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The colocation could not be saved. Please, try again.'));
        }
        $customers = $this->Colocations->Customers->find('list', ['limit' => 200]);
        $locations = $this->Colocations->Locations->find('list', ['limit' => 200]);
        $racks = $this->Colocations->Racks->find('list', ['limit' => 200]);
        $this->set(compact('colocation', 'customers', 'locations', 'racks'));
        $this->set('_serialize', ['colocation']);
    }
    
    public function getdata()
    {
        $location = (int)$this->request->getQuery('location');
        
        $this->viewBuilder()->className('Json');

        $this->set('_jsonOptions', JSON_FORCE_OBJECT);
        $groups=$this->Colocations->Racks->find('list',['conditions'=>['Racks.location_id'=> $location]]);
        $this->set(compact('groups'));
        $this->set('_serialize', ['groups']);

        $this->render(false);

    }

    /**
     * Edit method
     *
     * @param string|null $id Colocation id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $colocation = $this->Colocations->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $colocation = $this->Colocations->patchEntity($colocation, $this->request->getData());
            if ($this->Colocations->save($colocation)) {
                $this->Flash->success(__('The colocation has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The colocation could not be saved. Please, try again.'));
        }
        $customers = $this->Colocations->Customers->find('list', ['limit' => 200]);
        $locations = $this->Colocations->Locations->find('list', ['limit' => 200]);
        $racks = $this->Colocations->Racks->find('list', ['limit' => 200]);
        $this->set(compact('colocation', 'customers', 'locations', 'racks'));
        $this->set('_serialize', ['colocation']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Colocation id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $colocation = $this->Colocations->get($id);
        if ($this->Colocations->delete($colocation)) {
            $this->Flash->success(__('The colocation has been deleted.'));
        } else {
            $this->Flash->error(__('The colocation could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
