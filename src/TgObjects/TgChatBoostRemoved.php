<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TgEnums\TgBoostSource;
use ProtocolLive\TelegramBotLibrary\TgInterfaces\TgEventInterface;

/**
 * @link https://core.telegram.org/bots/api#chatboostupdated
 * @version 2024.01.04.00
 */
final readonly class TgChatBoostRemoved
implements TgEventInterface{
  /**
   * Chat which was boosted
   */
  public TgChat $Chat;
  /**
   * Unique identifier of the boost
   */
  public string $Id;
  /**
   * Point in time (Unix timestamp) when the chat was boosted
   */
  public string $Date;
  /**
   * Source of the added boost
   */
  public TgBoostSource $Source;
  /**
   * User that boosted the chat, user for which the gift code was created or User that won the prize in the giveaway if any
   */
  public TgUser|null $User;
  
  public function __construct(
    array $Data
  ){
    $this->Chat = new TgChat($Data['chat']);
    $this->Id = $Data['boost_id'];
    $this->Date = $Data['remove_date'];
    $this->Source = TgBoostSource::from($Data['source']['source']);
    if(isset($Data['source']['user'])):
      $this->User = new TgUser($Data['source']['user']);
    endif;
  }
}