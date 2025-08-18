<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Controller: User
 * 
 * Automatically generated via CLI.
 */
class crud_Controller extends Controller {
    public function __construct()
    {
        parent::__construct();
        $this->call->model('crud_Model');
        $this->call->library('form_validation');

        // $this->call->helper('message');
    }

    public function read(){
         $data['getAll'] = $this->crud_Model->getAll();
        $this->call->view('index', $data);
    }


  public function createUser()
    {
        $this->form_validation
            ->name('student_id')
                ->required()
                ->max_length(50)
            ->name('first_name')
                ->required()
                ->max_length(200)
            ->name('last_name')
                ->required()
                ->max_length(200)
            ->name('course')
                ->required()
                ->max_length(100);

        if ($this->form_validation->run() == FALSE) {
            $errors = $this->form_validation->get_errors();
            setErrors($errors);
            redirect('/');
        } else {
            $this->crud_Model->createUser([
                'student_id' => $_POST['student_id'],
                'first_name' => $_POST['first_name'],
                'last_name'  => $_POST['last_name'],
                'course'     => $_POST['course']
            ]);

            setMessage('success', 'Student registered successfully!');
            redirect('/');
        }
    }



     public function updateUser($id){
        $this->crud_Model->updateUser($id, [
            'student_id' => $_POST['student_id'], // allow updating student_id too
            'first_name' => $_POST['first_name'],
            'last_name'  => $_POST['last_name'],
            'course'     => $_POST['course'],
        ]);
        setMessage('success', 'Student updated successfully!');
        redirect('/');
    }


     public function deleteUser($id){
        $this->crud_Model->deleteUser($id);
        setMessage('danger', 'Student deleted successfully!');
        redirect('/');
    }
}

