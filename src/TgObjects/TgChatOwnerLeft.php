<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TgInterfaces\{
  TgEventInterface,
  TgServiceInterface
};

/**
 * Describes a service message about the chat owner leaving the chat.
 * @link https://core.telegram.org/bots/api#chatownerleft
 * @version 2026.02.10.00
 */
final readonly class TgChatOwnerLeft
implements TgEventInterface,
TgServiceInterface{
  /**
   * The user which will be the new owner of the chat if the previous owner does not return to the chat
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