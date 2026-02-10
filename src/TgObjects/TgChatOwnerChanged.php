<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TgInterfaces\{
  TgEventInterface,
  TgServiceInterface
};

/**
 * Describes a service message about an ownership change in the chat.
 * @link https://core.telegram.org/bots/api#chatownerchanged
 * @version 2026.02.10.00
 */
final readonly class TgChatOwnerChanged
implements TgEventInterface,
TgServiceInterface{
  /**
   * The new owner of the chat
   */
  public TgUser|null $NewOwner;

  public function __construct(
    array $Data
  ){
    if(isset($Data['new_owner'])):
      $this->NewOwner = new TgUser($Data['new_owner']);
    else:
      $this->NewOwner = null;
    endif;
  }
}