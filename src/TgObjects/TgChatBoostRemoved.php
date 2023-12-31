<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * @link https://core.telegram.org/bots/api#chatboostupdated
 * @version 2023.12.30.00
 */
class TgChatBoostRemoved{
  /**
   * Chat which was boosted
   */
  public readonly TgChat $Chat;
  /**
   * Unique identifier of the boost
   */
  public readonly string $Id;
  /**
   * Point in time (Unix timestamp) when the chat was boosted
   */
  public readonly string $Date;
  /**
   * Source of the added boost
   */
  public readonly TgBoostSource $Source;
  /**
   * User that boosted the chat, user for which the gift code was created or User that won the prize in the giveaway if any
   */
  public readonly TgUser|null $User;
  
  public function __construct(
    array $Data
  ){
    $this->Chat = new TgChat($Data['chat']);
    $this->Id = $Data['boost_id'];
    $this->Date = $Data['remove_date'];
    $this->Source = TgBoostSource::from($Data['source']['source']);
    $this->User = new TgUser($Data['source']['user']);
  }
}