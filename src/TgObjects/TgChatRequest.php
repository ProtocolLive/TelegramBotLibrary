<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.09.24.00

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * @link https://core.telegram.org/bots/api#chatjoinrequest
 */
class TgChatRequest{
  /**
   * Chat to which the request was sent
   */
  public readonly TgChat $Chat;
  /**
   * User that sent the join request
   */
  public readonly TgUser $User;
  /**
   * Date the request was sent in Unix time
   */
  public readonly int $Date;
  /**
   * Bio of the user.
   */
  public readonly string|null $Bio;
  /**
   * Chat invite link that was used by the user to send the join request
   */
  public readonly TgChatInviteLink|null $Link;

  public function __construct(array $Data){
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