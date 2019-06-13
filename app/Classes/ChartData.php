<?php


namespace App\Classes;


class ChartData
{
  public $crop;
  public $location;
  public $season;
  public $seasonData;

  /**
   * ChartData constructor.
   * @param $crop
   * @param $location
   * @param $season
   * @param $seasonData
   */
  public function __construct($crop, $location, $season, array $seasonData)
  {
    $this->crop = $crop;
    $this->location = $location;
    $this->season = $season;
    $this->seasonData = $seasonData;
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
   * @return mixed
   */
  public function getSeason()
  {
    return $this->season;
  }

  /**
   * @param mixed $season
   */
  public function setSeason($season): void
  {
    $this->season = $season;
  }

  /**
   * @return array
   */
  public function getSeasonData(): array
  {
    return $this->seasonData;
  }

  /**
   * @param array $seasonData
   */
  public function setSeasonData(array $seasonData): void
  {
    $this->seasonData = $seasonData;
  }




}