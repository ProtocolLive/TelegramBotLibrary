<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TgAuxiliary\TgMessageData;
use ProtocolLive\TelegramBotLibrary\TgInterfaces\TgEventInterface;

/**
 * @link https://core.telegram.org/bots/api#chatjoinrequest
 * @version 2026.06.13.00
 */
final readonly class TgChatRequest
implements TgEventInterface{
  public TgMessageData $Data;
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
  /**
   * Identifier of the join request query. If present, then the bot must call sendChatJoinRequestWebApp or directly call answerChatJoinRequestQuery within 10 seconds.
   */
  public string|null $QueryId;

  public function __construct(
    array $Data
  ){
    $this->Data = new TgMessageData($Data);
    $this->Date = $Data['date'];
    $this->Bio = $Data['bio'] ?? null;
    $this->QueryId = $Data['query_id'] ?? null;
    if(isset($Data['invite_link'])):
      $this->Link = new TgChatInviteLink($Data['invite_link']);
    else:
      $this->Link = null;
    endif;
  }
}