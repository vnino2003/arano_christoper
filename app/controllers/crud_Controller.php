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
         $data['getAll'] = $this->crud_Model->all();
        $this->call->view('index', $data);
    }


  public function createUser()
    {
        $this->form_validation
            ->name('product_name')
                ->required()
                ->max_length(50)
            ->name('quantity')
                ->required()
                ->max_length(200)
            ->name('Price')
                ->required()
                ->max_length(200);
           

        if ($this->form_validation->run() == FALSE) {
            $errors = $this->form_validation->get_errors();
            setErrors($errors);
            redirect('/');
        } else {
            $this->crud_Model->insert([
                'product_name' => $_POST['product_name'],
                'quantity' => $_POST['quantity'],
                'Price'  => $_POST['Price'],
                'created_at' => date('y-m-d H:i:s'),
                'updated_at' => date('y-m-d H:i:s')
            ]);

            setMessage('success', 'Product registered successfully!');
            redirect('/');
        }
    }



     public function updateUser($id){
        $this->crud_Model->update($id, [
            'product_name' => $_POST['product_name'],
             'quantity' => $_POST['quantity'],
            'Price'  => $_POST['Price'],
        ]);
        setMessage('success', 'Product updated successfully!');
        redirect('/');
    }


     public function deleteUser($id){
        $this->crud_Model->delete($id);
        setMessage('danger', 'Product deleted successfully!');
        redirect('/');
    }
}

