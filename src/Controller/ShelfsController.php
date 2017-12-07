<?php
    namespace App\Controller;

    use App\Controller\AppController;
    use Cake\ORM\TableRegistry;

    /**
    * Shelfs Controller
    *
    * @property \App\Model\Table\ShelfsTable $Shelfs
    *
    * @method \App\Model\Entity\Shelf[] paginate($object = null, array $settings = [])
    */
    class ShelfsController extends AppController
    {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Locations', 'Racks']
        ];
        $shelfs = $this->paginate($this->Shelfs);

        $this->set(compact('shelfs'));
        $this->set('_serialize', ['shelfs']);
    }

    /**
     * View method
     *
     * @param string|null $id Shelf id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $shelf = $this->Shelfs->get($id, [
            'contain' => ['Locations', 'Racks', 'Colocations']
        ]);

        $customer=$this->loadModel('Customers');
        $user=$this->loadModel('Users');
        $loc=$this->loadModel('Locations');
        $rack=$this->loadModel('Racks');
        $this->set(compact('rack','customer','loc','shelf','user'));
        $this->set('_serialize', ['shelf']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $shelf = $this->Shelfs->newEntity();
        if ($this->request->is('post')) {
            $shelf = $this->Shelfs->patchEntity($shelf, $this->request->getData());
            if ($result=$this->Shelfs->save($shelf)) {
                $this->Flash->success(__('The shelf has been saved.'));

                return $this->redirect(['action' => 'view',$result->id]);
            }
            $this->Flash->error(__('The shelf could not be saved. Please, try again.'));
        }
        $locations = $this->Shelfs->Locations->find('list', ['limit' => 200]);
        $racks=null;
        $this->set(compact('shelf', 'locations', 'racks'));
        $this->set('_serialize', ['shelf']);
    }

    //this function is called by scriptshelf.js
    public function getrack()
    {
        $location = (int)$this->request->getQuery('location');
        
        $this->viewBuilder()->className('Json');
        $this->set('_jsonOptions', JSON_FORCE_OBJECT);
        $this->loadModel('Racks');
        $rackss = TableRegistry::get('Racks');
        $groups = $rackss->find();
        $groups ->select(['Racks.name','Racks.id'])
        ->distinct(['Racks.name'])->where(['Racks.location_id' => $location ]);;
        $groups=$groups->toArray();
        $this->set(compact('groups'));
        $this->set('_serialize', ['groups']);
        $this->render(false);
    }

    /**
     * Edit method
     *
     * @param string|null $id Shelf id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $shelf = $this->Shelfs->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $shelf = $this->Shelfs->patchEntity($shelf, $this->request->getData());
            if ($this->Shelfs->save($shelf)) {
                $this->Flash->success(__('The shelf has been saved.'));

                return $this->redirect( ['controller' => 'Racks','action' => 'view', $shelf->rack_id]); 
            }
            $this->Flash->error(__('The shelf could not be saved. Please, try again.'));
        }
        $locations = $this->Shelfs->Locations->find('list', ['limit' => 200]);
        $racks = $this->Shelfs->Racks->find('list', ['limit' => 200]);
        $this->set(compact('shelf', 'locations', 'racks'));
        $this->set('_serialize', ['shelf']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Shelf id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $shelf = $this->Shelfs->get($id);
        if ($this->Shelfs->delete($shelf)) {
            $this->Flash->success(__('The shelf has been deleted.'));
        } else {
            $this->Flash->error(__('The shelf could not be deleted. Please, try again.'));
        }

        return $this->redirect(['controller' => 'Racks','action' => 'view', $shelf->rack_id]);
    }

    public function isAuthorized($user)
    {
        //users with visitor role
        if (in_array($this->request->getParam('action'), ['index','view'])) {
            if (isset($user['role']) && $user['role'] === 'visitor') {
            return true;
        }
        }

        //users with author role
        if (in_array($this->request->getParam('action'), ['index','view'])) {
           if (isset($user['role']) && $user['role'] === 'author') {
            return true;
        }
        }

        return parent::isAuthorized($user);
    }
    }
