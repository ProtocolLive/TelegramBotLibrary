<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TgAuxiliary\TgMessageData;
use ProtocolLive\TelegramBotLibrary\TgInterfaces\TgEventInterface;

/**
 * @link https://core.telegram.org/bots/api#forumtopicclosed
 * @version 2025.07.03.00
 */
final readonly class TgVideoChatInvite
implements TgEventInterface{
  public TgMessageData $Data;
  public array $Users;

  public function __construct(
    array $Data
  ){
    $this->Data = new TgMessageData($Data);
    foreach($Data['video_chat_participants_invited']['users'] ?? [] as &$user):
      $user = new TgUser($user);
    endforeach;
    $this->Users = $Data['video_chat_participants_invited']['users'] ?? [];
  }
}