<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TgAuxiliary\TgMessageData;
use ProtocolLive\TelegramBotLibrary\TgEnums\TgBoostSource;
use ProtocolLive\TelegramBotLibrary\TgInterfaces\TgEventInterface;

/**
 * @link https://core.telegram.org/bots/api#chatboostupdated
 * @version 2024.04.11.00
 */
final readonly class TgChatBoostRemoved
implements TgEventInterface{
  public TgMessageData $Data;
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
    $this->Data = new TgMessageData($Data);
    $this->Source = TgBoostSource::from($Data['source']['source']);
    if(isset($Data['source']['user'])):
      $this->User = new TgUser($Data['source']['user']);
    endif;
  }
}