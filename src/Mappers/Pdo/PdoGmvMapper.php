<?php

namespace Src\Mapper\Pdo;

use PDO;
use Src\Models\Gmv;
use Src\Mappers\GmvMapperInterface;
use Src\Mappers\Pdo\PdoMapper;

/**
 * PDO gmv mapper.
 */
class PdoGmvMapper  extends PdoMapper implements GmvMapperInterface {

    /**
     * Database connection.
     * 
     * @var PDO
     */
    private $connection;

    /**
     * 
     * @param PDO $connection Database connection.
     */
    public function __construct(PDO $connection) {
        $this->connection = $connection;
    }

    /**
     * Fetch a gmv by id.
     * 
     * Note: PDOStatement::fetch returns FALSE if no record is found.
     * 
     * @param int $id Gmv id.
     * @return Gmv|null Gmv.
     */
    public function fetchGmvById(int $id) {
        $sql = 'SELECT * FROM gmv WHERE id = :id LIMIT 1';

        $statement = $this->connection->prepare($sql);
        $statement->execute([
            'id' => $id,
        ]);

        $data = $statement->fetch(PDO::FETCH_ASSOC);

        return ($data === false) ? null : $this->convertDataToGmv($data);
    }

    /**
     * Fetch all Gmvs.
     * 
     * @return Gmv[] Gmv list.
     */
    public function fetchAllGmv() {
        $sql = 'SELECT * FROM gmv';

        $statement = $this->connection->prepare($sql);
        $statement->execute();

        $data = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $this->convertDataToGmvList($data);
    }

    /**
     * Check if a gmv exists.
     * 
     * Note: PDOStatement::fetch returns FALSE if no record is found.
     * 
     * @param Gmv $gmv Gmv.
     * @return bool True if the gmv exists, false otherwise.
     */
    public function gmvExists(Gmv $gmv) {
        $sql = 'SELECT COUNT(*) as cnt FROM gmv WHERE brand_id = :brand_id';

        $statement = $this->connection->prepare($sql);
        $statement->execute([
            ':name' => $gmv->getBrandId(),
        ]);

        $data = $statement->fetch(PDO::FETCH_ASSOC);

        return ($data['cnt'] > 0) ? true : false;
    }
    
    /**
     * Save a gmv.
     * 
     * @param Gmv $gmv Gmv.
     * @return Gmv Gmv.
     */
    public function saveGmv(Gmv $gmv) {
        return $this->insertGmv($gmv);
    }
    
    /**
     * Insert a gmv.
     * 
     * @param Gmv $gmv Gmv.
     * @return Gmv Gmv.
     */
    private function insertGmv(Gmv $gmv) {

        $sql = 'INSERT INTO gmvs (name,description,products,created) VALUES (:name,:description,:created)';

        $statement = $this->connection->prepare($sql);
        $statement->execute([
            ':brand_id' => $gmv->getBrandId(),
            ':turnover'=> $gmv->getTurnover(),
            ':date'=>$gmv->getTurnoverDate()
        ]);

        $gmv->setId($this->connection->lastInsertId());

        return $gmv;
    }
    
    /**
     * Update a gmv.
     * 
     * @param Gmv $gmv Gmv.
     * @return Gmv Gmv.
     */
    public function updateGmv(Gmv $gmv) {
        $sql = 'UPDATE gmv SET name = :name,description = :description,created= :created,products= :products WHERE id = :id';

        $statement = $this->connection->prepare($sql);
        $statement->execute([
            ':id' => $gmv->getId(),
            ':brand_id' => $gmv->getBrandId(),
            ':turnover'=> $gmv->getTurnover(),
            ':date'=>$gmv->getTurnoverDate()
        ]);

        return $gmv;
    }

    /**
     * Convert the given data to a gmv.
     * 
     * @param array $data Data.
     * @return Gmv Gmv.
     */
    private function convertDataToGmv(array $data) {
        $gmv = new Gmv();

        $gmv
                ->setId($data['id'])
                ->setBrandId($data['brand_id'])
                ->setTurnover($data['turnover'])
                ->setTurnoverDate($data['turnover_date']);

        return $gmv;
    }

    /**
     * Convert the given data to a list of gmvs.
     * 
     * @param array $data Data.
     * @return Gmv[] Gmv list.
     */
    private function convertDataToGmvList(array $data) {
        $gmvList = [];

        foreach ($data as $item) {
            $gmvList[] = $this->convertDataToGmv($item);
        }

        return $gmvList;
    }

}