<?php


namespace App\Classes;


class ChartDataItem{
public $year;
public $harvest;

  /**
   * ChartDataItem constructor.
   * @param $year
   * @param $production
   */
  public function __construct($year, $production)
  {
    $this->year = $year;
    $this->harvest = $production;
  }

  /**
   * @return mixed
   */
  public function getYear()
  {
    return $this->year;
  }

  /**
   * @param mixed $year
   */
  public function setYear($year): void
  {
    $this->year = $year;
  }

  /**
   * @return mixed
   */
  public function getHarvest()
  {
    return $this->harvest;
  }

  /**
   * @param mixed $harvest
   */
  public function setHarvest($harvest): void
  {
    $this->harvest = $harvest;
  }





}