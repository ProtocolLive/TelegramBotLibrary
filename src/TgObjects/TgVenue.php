<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TgInterfaces\{
  TgEventInterface,
  TgForwadableInterface
};

/**
 * This object represents a venue.
 * @link https://core.telegram.org/bots/api#venue
 * @version 2024.01.04.00
 */
final readonly class TgVenue
implements TgEventInterface, TgForwadableInterface{
  public TgMessageData $Data;

  /**
   * Venue location. Can't be a live location
   */
  public TgLocation $Location;
  /**
   * Name of the venue
   */
  public string $Name;
  /**
   * Address of the venue
   */
  public string $Address;
  /**
   * Foursquare identifier of the venue
   */
  public string|null $Foursquare;
  /**
   * Foursquare type of the venue. (For example, “arts_entertainment/default”, “arts_entertainment/aquarium” or “food/icecream”.)
   */
  public string|null $FoursquareType;
  /**
   * Google Places identifier of the venue
   */
  public string|null $Google;
  /**
   * Google Places type of the venue. (See supported types)
   */
  public string|null $GoogleType;

  public function __construct(
    array $Data
  ){
    $this->Data = new TgMessageData($Data);
    $this->Location = new TgLocation($Data['venue'], false);
    $this->Name = $Data['venue']['title'];
    $this->Address = $Data['venue']['address'];
    $this->Foursquare = $Data['venue']['foursquare_id'] ?? null;
    $this->FoursquareType = $Data['venue']['foursquare_type'] ?? null;
    $this->Google = $Data['venue']['google_place_id'] ?? null;
    $this->GoogleType = $Data['venue']['google_place_type'] ?? null;
  }
}