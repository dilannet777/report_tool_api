<?php

namespace Src\Mappers\Pdo;

use PDO;
use Src\Mappers\MapperInterface;
use Src\System\DatabaseConnector;

/**
 * PDO mapper.
 */
class PdoMapper implements MapperInterface {

    
     /**
     * Database connection.
     * 
     * @var PDO
     */
    private $connection;

    private $select;
    private $groupBy;
    private $orderBy;
    private $where;
    private $join;
    private $table;
    private $limit;
    private $conditions;


    /**
     * 
     * @param PDO $connection Database connection.
     */
    public function __construct() {

        $this->select = "";
        $this->groupBy =[];
        $this->orderBy =[];
        $this->where =[];
        $this->join =[];
        $this->table = "";
        $this->limit="";
        $this->conditions="";
        $this->connection =(new DatabaseConnector())->getConnection();
        
    }

     /**
     * Fetch table fields
     * 
     * 
     * @param string $select .
     */
    
    public function select(string $select){

        $this->select = "select ".trim($select);
        return $this;
     
    }

     /**
     * Fetch table fields
     * 
     * 
     * @param string $select .
     */
    public function table(string $table){

        $this->table = " from ".trim($table);
        return $this;
    }

     /**
     * Fetch order by clause
     * 
     * 
     * @param string $orderBy .
     * @param string $sortOrder .
     */
    
    public function orderBy(string $orderBy,string $sortOrder=''){

        $this->orderBy[]= " order by ".$orderBy." ".$sortOrder;
        return $this;
    }

     /**
     * Fetch group by clause
     * 
     * 
     * @param string $groupBy
     * @param string $having
     */
    
    public function groupBy(string $groupBy,string $having=''){

        $this->groupBy[]= " group by ".$groupBy." ".$having;
        return $this;
    }

     /**
     * Fetch limit clause
     * 
     * 
     * @param string $start
     * @param string $limit
     */
    public function limit($start,$limit){

        $this->limit= " limit ".$start.", ".$limit;
        return $this;
        
     }

     /**
     * Fetch where clause
     * 
     * 
     * @param string $leftOperand
     * @param string $operator
     * @param string $rightOperand
     */
    
    public function where(string $leftOperand, string $operator, string $rightOperand){

        $this->where[]= " where ".$leftOperand.$operator.":".$operator;
        $this->conditions[]=[$operator=>$rightOperand];
        return $this;
    }

    /**
     * Fetch join clause
     * 
     * 
     * @param string $leftTableName
     * @param string $join join type
     * @param string $rightTableName
     * @param string $leftOperand
     * @param string $rightOperand
     */
 
    public function join(string $join,string $rightTableName,string $leftOperand,string $rightOperand){

        $this->join[]= " ".$join." ".$rightTableName." on ".$leftOperand."=".$rightOperand;
        return $this;
    }



    /**
     * Fetch sql query
     * 
     * 
     * return string sql query
     */
    public function make(){

        return  $this->select
                ." ".$this->table
                .implode(" ",$this->join)
                .implode(" ",$this->where)
                .implode(" ",$this->groupBy)
                .implode(" ",$this->orderBy)
                ." ".$this->limit;

    }


     /**
     * Execute sql query
     * 
     * 
     * return string sql query
     */
    public function query(){
        
        try {
           
            $statement = $this->connection->prepare($this->make());
        
            $statement->execute(!empty($this->conditions)?$this->conditions:null);
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        } catch (\PDOException $e) {
            return (['error'=>$e->getMessage()]);
        }

    }
   
}