<?php
    namespace App\Controller;
    use App\Controller\AppController;
    use Cake\Event\Event;
    /**
    * Customers Controller
    *
    * @property \App\Model\Table\CustomersTable $Customers
    *
    * @method \App\Model\Entity\Customer[] paginate($object = null, array $settings = [])
    */
    class CustomersController extends AppController
    {
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $customers = $this->paginate($this->Customers);

        $colo=$this->loadModel('Colocations');
        $this->set(compact('customer','colo'));

        $this->set(compact('customers'));
        $this->set('_serialize', ['customers']);
    }
    /**
     * View method
     *
    * @param string|null $id Customer id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $customer = $this->Customers->get($id, [
            'contain' => ['Colocations']
        ]);
        $loc=$this->loadModel('Locations');
        $rack=$this->loadModel('Racks');
        $shelf=$this->loadModel('Shelfs');
        $this->set(compact('customer','loc','rack','shelf'));
        $this->set('_serialize', ['customer']);
    }
    public function search()
    {
        if ($this->request->is('post'))
        {

          if(!empty($this->request->data) && isset($this->request->data) )
          {
             $search_key=$this->request->data["search_customer"];
             $results=$this->Customers->find('all')->where( array("OR" =>array("Customers.name LIKE" => '%'.$search_key.'%', "Customers.number LIKE" => $search_key)));

         }
     }

     $this->set('customers', $this->paginate($results));
     $colo=$this->loadModel('Colocations');
     $this->set(compact('colo'));

     $this->render('/Customers/index');
    }
    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $customer = $this->Customers->newEntity();
        if ($this->request->is('post')) {
            $customer = $this->Customers->patchEntity($customer, $this->request->getData());
            if ($result=$this->Customers->save($customer)) {
                $this->Flash->success(__('The customer has been saved.'));
                return $this->redirect(['action' => 'view',$result->id]);
            }
            $this->Flash->error(__('The customer could not be saved. Please, try again.'));
        }
        $this->set(compact('customer'));
        $this->set('_serialize', ['customer']);
    }
    /**
     * Edit method
     *
     * @param string|null $id Customer id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $customer = $this->Customers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $customer = $this->Customers->patchEntity($customer, $this->request->getData());
            if ($this->Customers->save($customer)) {
                $this->Flash->success(__('The customer has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The customer could not be saved. Please, try again.'));
        }
        $this->set(compact('customer'));
        $this->set('_serialize', ['customer']);
    }
    /**
     * Delete method
     *
     * @param string|null $id Customer id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $customer = $this->Customers->get($id);
        if ($this->Customers->delete($customer)) {
            $this->Flash->success(__('The customer has been deleted.'));
        } else {
            $this->Flash->error(__('The customer could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    public function getall()
    {
        if ($this->request->is('get')) {

            $name = $this->request->query['term'];
            $results = $this->Customers->find('all', [
                'conditions' => [ 'OR' => [
                    'name LIKE' => $name . '%',
                    'number LIKE' => $name . '%',

                ]]
            ]);
            $resultsArr = [];
            foreach ($results as $result) {
             $resultsArr[] =['label' => $result['name'], 'value' => $result['id']];
         }
        #echo json_encode($resultsArr);
         $this->response->body(json_encode($resultsArr));
     }
     $this->autoRender = false;
    }

    public function isAuthorized($user)
    {
        
        //users with visitor role
        if (in_array($this->request->getParam('action'), ['index','view','getall'])) {
            if (isset($user['role']) && $user['role'] === 'visitor') {
            return true;
        }
        }

        //users with author role
        if (in_array($this->request->getParam('action'), ['add','search', 'index','view','edit','getall'])) {
           if (isset($user['role']) && $user['role'] === 'author') {
            return true;
        }
        }

    return parent::isAuthorized($user);
    }

    }