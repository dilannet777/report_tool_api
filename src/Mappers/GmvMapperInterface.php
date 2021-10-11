<?php
namespace Src\Mappers;
use Src\Models\Gmv;

interface GmvMapperInterface
{
   public function fetchGmvById(int $id);
   public function fetchAllGmv();
   public function gmvExists(Gmv $gmv);
   public function saveGmv(Gmv $gmv);
   public function updateGmv(Gmv $gmv);
}