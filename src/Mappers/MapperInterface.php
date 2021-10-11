<?php
namespace Src\Mappers;


interface MapperInterface
{
  // public function selectAll();
   public function select(string $select);
   public function join(string $join,string $rightTableName,string $leftOperand,string $rightOperand);
   public function where(string $leftOperand, string $operator, string $rightOperand);
   public function orderBy(string $orderBy,string $sortOrder);
   public function groupBy(string $groupBy,string $having);
   public function table(string $table);
   public function make();
   public function query();
   public function limit(string $start,string $limit);
  // public function updateGmv(Gmv $gmv);
}