<?php
namespace App\Models;
use \CodeIgniter\Model;

class RegisterModel extends Model
{
    public function createUser($data)
    {
        $builder = $this->db->table('user_login');
        $res = $builder->insert($data);
        if($this->db->affectedRows()==1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function verifyUniid($id)
    {
        $builder = $this->db->table('user_login');
        $builder->select('activation_date,uniid,status');
        $builder->where('uniid', $id);
        $result = $builder->get();
        if($builder->countAll()==1)
        {
            return $result->getRow();
        }
        else
        {
            return false;
        }
    }

    public function updateStatus($uniid)
    {
        $builder = $this->db->table('user_login');
        $builder->where('uniid', $uniid);
        $builder->update(['status'=>'active']);
        if($this->db->affectedRows()==1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}