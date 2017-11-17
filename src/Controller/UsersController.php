<?php
    namespace App\Controller;

    use App\Controller\AppController;
    use Cake\Event\Event;
    use Cake\Utility\Security;
    use Cake\Utility\Text;
    use Cake\Routing\Router;
    use Cake\Mailer\MailerAwareTrait;
    use Cake\Mailer\Email;

    /**
    * Users Controller
    *
    * @property \App\Model\Table\UsersTable $Users
    *
    * @method \App\Model\Entity\User[] paginate($object = null, array $settings = [])
    */
    class UsersController extends AppController
    {

    use MailerAwareTrait;
    //login
    public function login(){
        if($this->request->is('post')){
            $user=$this->Auth->identify();
            if($user){
                $this->Auth->setUser($user);
                $session = $this->request->session();
                $session->write('imgrandd', rand(1,13));
                return $this->redirect(['controller'=>'locations']);
            }
            //Bad login
            $this->Flash->error('Incorrect Login');
        }
    }
    //Logout
    public function logout(){
        $this->Flash->success('You are logged out');
        return $this->redirect($this->Auth->logout());
    }

    public function forgotPassword() 
    {
     if ($this->request->is('post')) 
     {
         if (!empty($this->request->data))
         {
             $email = $this->request->data['email'];
             $user = $this->Users->findByEmail($email)->first();

             if (!empty($user))
             {
                $password = sha1(Text::uuid());
                $password_token = Security::hash($password, 'sha256', true);
                $hashval = sha1($user->username . rand(0, 100));

                $user->password_reset_token = $password_token;
                $user->hashval = $hashval;
                $reset_token_link = Router::url(['controller' => 'Users', 'action' => 'resetPassword'], TRUE) . '/' . $password_token . '#' . $hashval;

                $emaildata = [$user->email, $reset_token_link, $user->name];
                $this->getMailer('SendEmail')->send('sendEmail', [$emaildata]);
                $this->Users->save($user);
                $this->Flash->success('Please click on password reset link, sent in your email address to reset password.');
            }
            else
            {
                $this->Flash->error('Sorry! Email address is not available here.');
            }
        }
    }
    }
    
    public function resetPassword($token = null) {
    if (!empty($token)) {
        $user = $this->Users->findByPasswordResetToken($token)->first();
        if ($user) {

            if (!empty($this->request->data)) {
                $user = $this->Users->patchEntity($user, [
                    'password' => $this->request->data['new_password'],
                    'new_password' => $this->request->data['new_password'],
                    'confirm_password' => $this->request->data['confirm_password']
                ], ['validate' => 'password']
            );
                $hashval_new = sha1($user->username . rand(0, 100));
                $user->password_reset_token = $hashval_new;
                if ($this->Users->save($user)) {
                    $this->Flash->success('Your password has been changed successfully');

                    $this->redirect(['action' => 'login']);
                } else {
                    $this->Flash->error('Error changing password. Please try again!');
                }
            }
        } else {
            $this->Flash->error('Sorry your password token has been expired.');
        }
    } else {
        $this->Flash->error('Error loading password reset.');
    }
    $this->set(compact('user'));
    $this->set('_serialize', ['user']);
    }
    public function register(){
    $user=$this->Users->newEntity();


    if($this->request->is('post')){
        $user=$this->Users->patchEntity($user,$this->request->data);
        if($this->Users->save($user)){
            $this->Flash->success('You are registered and can login');
                //
            return $this->redirect(['action'=>'login']);
        }
        else{
         $this->Flash->error('You are not registered');
     }

    }
    $this->set(compact('user'));
    $this->set('_serialize',['user']);
    }


    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
        $this->set('_serialize', ['users']);
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);

        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function beforeFilter(Event $event){
        $this->Auth->allow(['forgotPassword', 'register','resetPassword','logout']);
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
