<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TgInterfaces\TgEventInterface;

/**
 * @link https://core.telegram.org/bots/api#chatjoinrequest
 * @version 2024.01.04.00
 */
final readonly class TgChatRequest
implements TgEventInterface{
  /**
   * Chat to which the request was sent
   */
  public TgChat $Chat;
  /**
   * User that sent the join request
   */
  public TgUser $User;
  /**
   * Date the request was sent in Unix time
   */
  public int $Date;
  /**
   * Bio of the user.
   */
  public string|null $Bio;
  /**
   * Chat invite link that was used by the user to send the join request
   */
  public TgChatInviteLink|null $Link;

  public function __construct(
    array $Data
  ){
    $this->Chat = new TgChat($Data['chat']);
    $this->User = new TgUser($Data['from']);
    $this->Date = $Data['date'];
    $this->Bio = $Data['bio'] ?? null;
    if(isset($Data['invite_link'])):
      $this->Link = new TgChatInviteLink($Data['invite_link']);
    else:
      $this->Link = null;
    endif;
  }
}