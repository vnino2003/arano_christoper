<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Model: User_Model
 * 
 * Automatically generated via CLI.
 */
class User_Model extends Model {
    protected $table = 'user';
    //protected $primary_key = 'id';

    public function __construct()
    {
        parent::__construct();
    }

    public function getAll(){
        return $this->db->table($this->table)->get_all();

    }

    public function createUser($data){
        $this->db->table($this->table)->insert($data);
    }

     public function updateUser($id, $data){
        return $this->db->table($this->table)->where('id', $id)->update($data);
    }
    
    public function deleteUser($id){
         return $this->db->table($this->table)->where('id', $id)->delete();

    }
}