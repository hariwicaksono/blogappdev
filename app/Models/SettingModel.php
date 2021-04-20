<?php namespace App\Models;

use CodeIgniter\Model;

class SettingModel extends Model
{
    protected $table = 'settings';
    protected $primaryKey = 'id'; 

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['brand', 'company', 'website', 'phone', 'email', 'updated_at'];
    protected $useTimestamps = false;
    protected $updatedField  = 'updated_at';

    protected $skipValidation     = true;

    public function getSetting($id = false)
    {
        if($id === false){
            return $this->findAll();
        } else {
            return $this->getWhere(['id' => $id])->getRowArray();
        }  
    }
     
    public function insertSetting($data)
    {
        return $this->db->table($this->table)->insert($data);
    }
 
    public function updateSetting($data, $id)
    {
        return $this->db->table($this->table)->update($data, ['id' => $id]);
    }
 
    public function deleteSetting($id)
    {
        return $this->db->table($this->table)->delete(['id' => $id]);
    }

}