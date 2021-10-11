<?php

namespace Src\Mappers\Pdo;

use PDO;
use Src\Models\Brand;
use Src\Mappers\BrandMapperInterface;
use Src\Mappers\Pdo\PdoMapper;

/**
 * PDO brand mapper.
 */
class PdoBrandMapper extends PdoMapper implements BrandMapperInterface {


    /**
     * Fetch a brand by id.
     * 
     * Note: PDOStatement::fetch returns FALSE if no record is found.
     * 
     * @param int $id Brand id.
     * @return Brand|null Brand.
     */
    public function fetchBrandById(int $id) {
        $sql = 'SELECT * FROM brands WHERE id = :id LIMIT 1';

        $statement = $this->connection->prepare($sql);
        $statement->execute([
            'id' => $id,
        ]);

        $data = $statement->fetch(PDO::FETCH_ASSOC);

        return ($data === false) ? null : $this->convertDataToBrand($data);
    }

    /**
     * Fetch all Brands.
     * 
     * @return Brand[] Brand list.
     */
    public function fetchAllBrands() {
        $sql = 'SELECT * FROM brands';

        $statement = $this->connection->prepare($sql);
        $statement->execute();

        $data = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $this->convertDataToBrandList($data);
    }

    /**
     * Check if a brand exists.
     * 
     * Note: PDOStatement::fetch returns FALSE if no record is found.
     * 
     * @param Brand $brand Brand.
     * @return bool True if the brand exists, false otherwise.
     */
    public function brandExists(Brand $brand) {
        $sql = 'SELECT COUNT(*) as cnt FROM brands WHERE name = :name';

        $statement = $this->connection->prepare($sql);
        $statement->execute([
            ':name' => $brand->getBrandName(),
        ]);

        $data = $statement->fetch(PDO::FETCH_ASSOC);

        return ($data['cnt'] > 0) ? true : false;
    }

    /**
     * Save a brand.
     * 
     * @param Brand $brand Brand.
     * @return Brand Brand.
     */
    public function saveBrand(Brand $brand) {
        return $this->insertBrand($brand);
    }
    
    /**
     * Insert a brand.
     * 
     * @param Brand $brand Brand.
     * @return Brand Brand.
     */
    private function insertBrand(Brand $brand) {

        $sql = 'INSERT INTO brands (name,description,products,created) VALUES (:name,:description,:created)';

        $statement = $this->connection->prepare($sql);
        $statement->execute([
            ':name' => $brand->getBrandName(),
            ':description'=> $brand->getDescription(),
            ':products'=> $brand->getProductCount(),
            ':created'=>$brand->getCreatedDate()
        ]);

        $brand->setId($this->connection->lastInsertId());

        return $brand;
    }
    
    /**
     * Update a brand.
     * 
     * @param Brand $brand Brand.
     * @return Brand Brand.
     */
    public function updateBrand(Brand $brand) {
        $sql = 'UPDATE brand SET name = :name,description = :description,created= :created,products= :products WHERE id = :id';

        $statement = $this->connection->prepare($sql);
        $statement->execute([
            ':id' => $brand->getId(),
            ':name' => $brand->getBrandName(),
            ':description' => $brand->getDescription(),
            ':created' => $brand->getCreatedDate(),
            ':products' => $brand->getProductCount()
        ]);

        return $brand;
    }

    /**
     * Convert the given data to a brand.
     * 
     * @param array $data Data.
     * @return Brand Brand.
     */
    private function convertDataToBrand(array $data) {
        $brand = new Brand();

        $brand
                ->setId($data['id'])
                ->setBrandName($data['name'])
                ->setDescription($data['description'])
                ->setProductCount($data['products'])
                ->setCreatedDate($data['created']);

        return $brand;
    }

    /**
     * Convert the given data to a list of brands.
     * 
     * @param array $data Data.
     * @return Brand[] Brand list.
     */
    private function convertDataToBrandList(array $data) {
        $brandList = [];

        foreach ($data as $item) {
            $brandList[] = $this->convertDataToBrand($item);
        }

        return $brandList;
    }

}