<?php
namespace Src\Repositories;

class ReportRepository {

    private $db = null;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getBrandReport($request)
    {
        $sql = "SELECT brands.name,date(max(gmv.date)) as week_end_date, round(sum(gmv.turnover - (gmv.turnover * $request[tax])),2) AS turnover FROM brands JOIN gmv ON gmv.brand_id = brands.id GROUP BY WEEK(gmv.date),brands.name order by WEEK(gmv.date)";
    
        $header =[
            "Header"=> "Report - 7 Days Turnover Per Brand",
            "columns"=>[
              [
                "Header"=> "Name",
                "accessor"=> "name"
              ],
              [
                "Header"=> "Week End Date",
                "accessor"=> "week_end_date"
              ],
              [
                "Header"=> "Turnover (EURO)",
                "accessor"=> "turnover"
              ]
            ]
            ];

        try {
            $statement = $this->db->prepare($sql);

            $statement->execute();
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            return ["columns"=>$header,"body"=>$result];
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }


    public function getDailyReport($request)
    {
        $sql = "SELECT date(max(date)) as week_end_date, round(sum(turnover - (turnover * $request[tax]))/7,2) as turnover FROM gmv GROUP BY WEEK(date) order by WEEK(date)";
        $header =[
            "Header"=> "Report - 7 Days Turnover Per Day",
            "columns"=>[

              [
                "Header"=> "Week End Date",
                "accessor"=> "week_end_date"
              ],
              [
                "Header"=> "Turnover (EURO)",
                "accessor"=> "turnover"
              ]
            ]
            ];
        try {
            $statement = $this->db->prepare($sql);
         
            $statement->execute();

 
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            return ["columns"=>$header,"body"=>$result];
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }


 }