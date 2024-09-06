<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TgAuxiliary\TgMessageData;
use ProtocolLive\TelegramBotLibrary\TgEnums\TgBoostSource;
use ProtocolLive\TelegramBotLibrary\TgInterfaces\TgEventInterface;

/**
 * @link https://core.telegram.org/bots/api#chatboostupdated
 * @version 2024.09.06.00
 */
final readonly class TgChatBoost
implements TgEventInterface{
  public TgMessageData $Data;
  /**
   * Unique identifier of the boost
   */
  public string $Id;
  /**
   * Point in time (Unix timestamp) when the chat was boosted
   */
  public string $Date;
  /**
   * 	Point in time (Unix timestamp) when the boost will automatically expire, unless the booster's Telegram Premium subscription is prolonged
   */
  public string $Expiration;
  /**
   * Source of the added boost
   */
  public TgBoostSource $Source;
  /**
   * User that boosted the chat, user for which the gift code was created or User that won the prize in the giveaway if any
   */
  public TgUser|null $User;
  /**
   * Identifier of a message in the chat with the giveaway; the message could have been deleted already. May be 0 if the message isn't sent yet.
   */
  public int|null $Message;
  /**
   * True, if the giveaway was completed, but there was no user to win the prize
   */
  public bool $Unclaimed;
  /**
   * The number of Telegram Stars to be split between giveaway winners; for Telegram Star giveaways only
   */
  public int|null $Stars;
  
  public function __construct(
    array $Data
  ){
    $this->Data = new TgMessageData($Data);
    $this->Id = $Data['boost']['boost_id'] ?? $Data['boost_id'];
    $this->Date = $Data['boost']['add_date'] ?? $Data['add_date'];
    $this->Expiration = $Data['boost']['expiration_date'] ?? $Data['expiration_date'];
    $this->Source = TgBoostSource::from($Data['boost']['source']['source'] ?? $Data['source']['source']);
    $this->User = new TgUser($Data['boost']['source']['user'] ?? $Data['source']['user']);
    $this->Message = $Data['boost']['source']['giveaway_message_id'] ?? null;
    $this->Unclaimed = $Data['boost']['source']['is_unclaimed'] ?? false;
    $this->Stars = $Data['boost']['source']['prize_star_count'] ?? null;
  }
}