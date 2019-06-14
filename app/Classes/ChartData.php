<?php


namespace App\Classes;


class ChartData
{
  public $crop;
  public $location;
  public $chartDataItems;

  /**
   * ChartData constructor.
   * @param $crop
   * @param $location
   * @param $chartDataItems
   */
  public function __construct($crop, $location, array $chartDataItems)
  {
    $this->crop = $crop;
    $this->location = $location;
    $this->chartDataItems = $chartDataItems;
  }

  /**
   * @return mixed
   */
  public function getCrop()
  {
    return $this->crop;
  }

  /**
   * @param mixed $crop
   */
  public function setCrop($crop): void
  {
    $this->crop = $crop;
  }

  /**
   * @return mixed
   */
  public function getLocation()
  {
    return $this->location;
  }

  /**
   * @param mixed $location
   */
  public function setLocation($location): void
  {
    $this->location = $location;
  }

  /**
   * @return array
   */
  public function getChartDataItems(): array
  {
    return $this->chartDataItems;
  }

  /**
   * @param array $chartDataItems
   */
  public function setChartDataItems(array $chartDataItems): void
  {
    $this->chartDataItems = $chartDataItems;
  }



}