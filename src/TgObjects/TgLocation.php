<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TgInterfaces\TgForwadableInterface;

/**
 * @link https://core.telegram.org/bots/api#location
 * @version 2023.05.24.00
 */
final class TgLocation
extends TgObject
implements TgForwadableInterface{
  public readonly TgMessageData|null $Data;
  /**
   * Latitude as defined by sender
   */
  public readonly float $Latitude;
  /**
   * Longitude as defined by sender
   */
  public readonly float $Longitude;
  /**
   * The radius of uncertainty for the location, measured in meters; 0-1500
   */
  public readonly float|null $Accuracy;
  /**
   * Time relative to the message sending date, during which the location can be updated; in seconds. For active live locations only.
   */
  public readonly int|null $LiveTime;
  /**
   * The direction in which user is moving, in degrees; 1-360. For active live locations only.
   */
  public readonly int|null $Heading;
  /**
   * The maximum distance for proximity alerts about approaching another chat member, in meters. For sent live locations only.
   */
  public readonly int|null $AlertRadius;

  public function __construct(
    array $Data,
    bool $WithData = true
  ){
    if($WithData):
      $this->Data = new TgMessageData($Data);
    else:
      $this->Data = null;
    endif;
    $this->Latitude = $Data['location']['latitude'];
    $this->Longitude = $Data['location']['longitude'];
    $this->Accuracy = $Data['location']['horizontal_accuracy'] ?? null;
    $this->LiveTime = $Data['location']['live_period'] ?? null;
    $this->Heading = $Data['location']['heading'] ?? null;
    $this->AlertRadius = $Data['location']['proximity_alert_radius'] ?? null;
  }
}