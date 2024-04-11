<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TgAuxiliary\TgMessageData;
use ProtocolLive\TelegramBotLibrary\TgInterfaces\{
  TgEventInterface,
  TgForwadableInterface
};

/**
 * @link https://core.telegram.org/bots/api#location
 * @version 2024.04.11.00
 */
readonly class TgLocation
implements TgEventInterface, TgForwadableInterface{
  public TgMessageData|null $Data;
  /**
   * Latitude as defined by sender
   */
  public float $Latitude;
  /**
   * Longitude as defined by sender
   */
  public float $Longitude;
  /**
   * The radius of uncertainty for the location, measured in meters; 0-1500
   */
  public float|null $Accuracy;
  /**
   * Time relative to the message sending date, during which the location can be updated; in seconds. For active live locations only.
   */
  public int|null $LiveTime;
  /**
   * The direction in which user is moving, in degrees; 1-360. For active live locations only.
   */
  public int|null $Heading;
  /**
   * The maximum distance for proximity alerts about approaching another chat member, in meters. For sent live locations only.
   */
  public int|null $AlertRadius;

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