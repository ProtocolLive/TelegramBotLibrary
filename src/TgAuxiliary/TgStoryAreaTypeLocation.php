<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgAuxiliary;

/**
 * Describes a story area pointing to a location. Currently, a story can have up to 10 location areas.
 * @link https://core.telegram.org/bots/api#storyareatypelocation
 * @version 2025.05.11.00
 */
final class TgStoryAreaTypeLocation
extends TgStoryAreaType{
  /**
   * @param float $Latitude Location latitude in degrees
   * @param float $Longitude Location longitude in degrees
   * @param TgLocationAddress|null $Address Address of the location
   */
  public function __construct(
    public float $Latitude,
    public float $Longitude,
    public TgLocationAddress|null $Address = null
  ){}

  public function ToArray(): array{
    $param['type'] = 'location';
    $param['latitude'] = $this->Latitude;
    $param['longitude'] = $this->Longitude;
    if($this->Address !== null):
      $param['address'] = $this->Address->ToArray();
    endif;
    return $param;
  }
}