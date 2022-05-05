<?php
namespace Core;
use Core\Database;

class Model extends Database
{
    private $table = null;
    private $sql_query = null;
    private $select = null;
    private $where = null;
    private $orderBy = null;
    private $select_variable = null;
    private $where_variable = null;
    private $order_by = null;
    private $limit = '';

    public function __construct()
    {
        parent::__construct();
    }

    private function setQueryElement(){
        $this->select_variable = ($this->select)?$this->select:"*";
        $this->where_variable = ($this->where)?$this->where:'';
        $this->order_by = ($this->orderBy)?$this->orderBy:'';
    }

    private function setSelectSqlQuery(){
        $this->sql_query = 'Select '.$this->select_variable.' FROM '.$this->table.$this->where_variable.$this->order_by.$this->limit;
    }

    public function table($tablename){
        $this->table = $tablename;
    }

    public function where($column,$equal=null){
        if(is_array($column)){
            foreach($column as $key => $value){
                if($this->where!=null){
                    $this->where = $this->where. " AND ".$key." = ".$value;
                }else{
                    $this->where = ' where '.$key." = ".$value;
                }
            }
        }else{
            $this->where = ' where '.$column.' = '.$equal;
        }
    }

    public function select($selected_column){
        $this->select = $selected_column;
    }

    public function orderBy($column, $sort_type){
        $this->orderBy = ' order by '.$column.' '.$sort_type;
    }

    public function limit(int $limit, $offset=false){
        if($offset){
            $this->limit = ' limit '.$limit.", ".$offset;
        }else{
            $this->limit = ' limit '.$limit;
        }
    }

    public function get(){
        $this->setQueryElement();
        $this->setSelectSqlQuery();
        $return_data = $this->db->query($this->sql_query);
        return $return_data->fetchAll(\PDO::FETCH_OBJ);
    }

    public function first(){
        $this->setQueryElement();
        $this->limit(1);
        $this->setSelectSqlQuery();
        $return_data = $this->db->query($this->sql_query);
        return $return_data->fetch(\PDO::FETCH_OBJ);
    }

    public function insert(Array $data){
        $columns = array_keys($data);
        $insert_list = null;
        foreach($columns as $key ){
            if($insert_list==null){
                $insert_list = $key.' = :'.$key;
            }else{
                $insert_list .= $key.' = :'.$key.',';
            }
        }

        $query = $this->db->prepare("INSERT INTO $this->table SET ".$insert_list);
        $insert = $query->execute($data);

        if ( $insert ){
            return $this->db->lastInsertId();
        }
        return  $query->errorInfo();
    }

    public function update($data){
        $columns = array_keys($data);
        $insert_list = null;
        foreach($columns as $key ){
            if($insert_list==null){
                $insert_list = $key.' = :'.$key;
            }else{
                $insert_list .= $key.' = :'.$key.',';
            }
        }

        $query = $this->db->prepare("UPDATE $this->table SET ".$insert_list." WHERE ".$this->where);
        $insert = $query->execute($data);

        if ( $insert ){
            return $this->db->lastInsertId();
        }
        return  $query->errorInfo();
    }

    public function delete(){

    }

    function __destruct()
    {
        //
    }
}