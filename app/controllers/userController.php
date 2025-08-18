<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Controller: User
 * 
 * Automatically generated via CLI.
 */
class userController extends Controller {
    public function __construct()
    {
        parent::__construct();
        $this->call->model('User_Model');
        $this->call->library('form_validation');

        // $this->call->helper('message');
    }

    public function read(){
         $data['getAll'] = $this->User_Model->getAll();
        $this->call->view('admin/admin_Panel', $data);
    }


    public function registerForm(){
        $this->call->view('users/register');
    }

  public function createUser()
{

    $this->form_validation
        ->name('first_name')
            ->required()
            ->max_length(200)
        ->name('last_name')
            ->required()
            ->max_length(200)
        ->name('username')
            ->required()
            ->max_length(20)
        ->name('password')
            ->required()
            ->min_length(8)
            ->max_length(100)
        ->name('email')
            ->required()
            ->valid_email();

   if ($this->form_validation->run() == FALSE) {
    $errors = $this->form_validation->get_errors();
    setErrors($errors);
    redirect('/register');

} else {
    $this->User_Model->createUser([
        'first_name' => $_POST['first_name'],
        'last_name'  => $_POST['last_name'],
        'username'   => $_POST['username'],
        'email'      => $_POST['email'],
        'password'   => password_hash($_POST['password'], PASSWORD_DEFAULT)
    ]);

    setMessage('success', 'User registered successfully!');
    redirect('/register');
}

}



    public function updateUser($id){
        $this->User_Model->updateUser($id, [
            'first_name' => $_POST['first_name'],
            'last_name' => $_POST['last_name'],
            'username' => $_POST['username'],
            'email' => $_POST['email'],
        ]);
         setMessage('success', 'User updated successfully!');
         redirect('/admin');

    }

    public function deleteUser($id){
    
        $this->User_Model->deleteUser($id);
        setMessage('danger', 'User delete successfully!');
        redirect('/admin');      
            
        

    }

}