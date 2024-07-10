<?php 

namespace App\model;

class Goals
{
    public $conn;
    private $table_name = "goals";
    protected $fillable = ['name', 'target_amount', 'time_horizon', 'risk_tolerance'];

    public function __construct()
    {
        $this->conn = new \Database();
    }
}