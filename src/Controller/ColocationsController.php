<?php
    namespace App\Controller;

    use App\Controller\AppController;
    use Cake\ORM\TableRegistry;
    use Cake\Event\Event;


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
            'contain' => ['Customers', 'Locations', 'Racks', 'Shelfs','Users']
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
            'contain' => ['Customers', 'Locations', 'Racks', 'Shelfs','Users']
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
        $cust=null;
        $colocation = $this->Colocations->newEntity();
        if ($this->request->is('post')) {
            $colocation = $this->Colocations->patchEntity($colocation, $this->request->getData());
            $this->loadModel('Shelfs');
            $this->Shelfs->updateAll(
                array('Shelfs.free' => 'no'), 
                array('Shelfs.id' => $colocation->shelf_id

            )
            );
            $colocation->user_id = $this->Auth->user('id');



            if ($this->Colocations->save($colocation)) {
                $this->Flash->success(__('The colocation has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The colocation could not be saved. Please, try again.'));
        }

        


        $customers = $this->Colocations->Customers->find('list', ['limit' => 200]);
        $locations = $this->Colocations->Locations->find('list', ['limit' => 200]);
        $racks=null;
        $shelfs=null;
        $users = $this->request->session()->read('Auth.User.name');
        $this->set(compact('colocation', 'customers', 'locations', 'racks','shelfs','users'));
        $this->set('_serialize', ['colocation']);
    }

    public function getrack()
    {
        $location = (int)$this->request->getQuery('location');
        
        $this->viewBuilder()->className('Json');
        $this->set('_jsonOptions', JSON_FORCE_OBJECT);
        $this->loadModel('Racks');
        $rackss = TableRegistry::get('Racks');
        $groups = $rackss->find();
        $groups->matching('Shelfs', function ($q) use ($location) {
            return $q->where(['Shelfs.location_id' => $location, 'Shelfs.free' => 'yes' ]);
        });
        $groups ->select(['Racks.name','Racks.id'])
        ->distinct(['Racks.name']);
        
        $groups=$groups->toArray();


        $this->set(compact('groups'));
        $this->set('_serialize', ['groups']);
        $this->render(false);
    }

    public function getshelf()
    {
        $rack_id = (int)$this->request->getQuery('location');
        
        
        $this->viewBuilder()->className('Json');
        $this->set('_jsonOptions', JSON_FORCE_OBJECT);
        $this->loadModel('Shelfs');
        $groups=$this->Shelfs->find('list',['conditions'=>array('Shelfs.rack_id'=> $rack_id,'Shelfs.free'=> 'yes')]);
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
            $this->loadModel('Shelfs');
            $this->Shelfs->updateAll(
                array('Shelfs.free' => 'no'), 
                array('Shelfs.id' => $colocation->shelf_id

            )
            );
            if ($this->Colocations->save($colocation)) {
                $this->Flash->success(__('The colocation has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The colocation could not be saved. Please, try again.'));
        }
        $customers = $this->Colocations->Customers->find('list', ['limit' => 200]);
        $locations = $this->Colocations->Locations->find('list', ['limit' => 200]);
        $racks = $this->Colocations->Racks->find('list', ['limit' => 200]);
        $shelfs = $this->Colocations->Shelfs->find('list', ['limit' => 200]);
        $users = $this->request->session()->read('Auth.User.name');
        $this->set(compact('colocation', 'customers', 'locations', 'racks', 'shelfs','users'));
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
            $this->loadModel('Shelfs');
            $this->Shelfs->updateAll(
                array('Shelfs.free' => 'yes'), 
                array('Shelfs.id' => $colocation->shelf_id

            )
            );
            $this->Flash->success(__('The colocation has been deleted.'));
        } else {
            $this->Flash->error(__('The colocation could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function isAuthorized($user)
    {
    // All registered users can add articles
        if (in_array($this->request->getParam('action'), ['add','edit', 'delete','index','view','logout','getrack','getshelf','shelf'])) {
            return true;
        }

    // The owner of an article can edit and delete it
        if (in_array($this->request->getParam('action'), ['delete'])) {
            $articleId = (int)$this->request->getParam('pass.0');

            if ($this->Colocations->isOwnedBy($articleId, $user['id'])) {
                return true;
            }
        }

        return parent::isAuthorized($user);
    }



    }
