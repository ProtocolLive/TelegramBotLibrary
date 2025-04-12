<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TgAuxiliary\TgBusinessInterval;

/**
 * @link https://core.telegram.org/bots/api#businessopeninghours
 * @version 2025.04.12.00
 */
final readonly class TgBusinessOpen{
  /**
   * Unique name of the time zone for which the opening hours are defined
   */
  public string $TimeZone;
  /**
   * List of time intervals describing business opening hours
   * @var TgBusinessInterval[]
   */
  public array $Hours;

  public function __construct(
    array $Data
  ){
    $this->TimeZone = $Data['time_zone_name'];
    foreach($Data['opening_hours'] as $hour):
      $hours[] = new TgBusinessInterval($hour);
    endforeach;
    $this->Hours = $hours;
  }
}