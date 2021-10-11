<?php
namespace Src\Mappers;
use Src\Models\Brand;

interface BrandMapperInterface
{
   public function fetchBrandById(int $id);
   public function fetchAllBrands();
   public function brandExists(Brand $brand);
   public function saveBrand(Brand $brand);
   public function updateBrand(Brand $brand);
 
}