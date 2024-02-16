<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TgEnums\TgMemberStatus;
use ProtocolLive\TelegramBotLibrary\TgInterfaces\TgEventInterface;

/**
 * The bot's chat member status was updated in a chat. For private chats, this update is received only when the bot is blocked or unblocked by the user.
 * @link https://core.telegram.org/bots/api#chatmemberupdated
 * @version 2024.02.16.00
 */
final readonly class TgGroupStatusMy
implements TgEventInterface{
  public TgMessageData $Data;
  /**
   * Previous information about the chat member
   */
  public TgMemberStatus $StatusOld;
  /**
   * New information about the chat member
   */
  public TgMemberStatus $StatusNew;
  public TgPermAdmin|null $Perms;

  public function __construct(
    array $Data
  ){
    $this->Data = new TgMessageData($Data);
    $this->StatusOld = TgMemberStatus::tryFrom($Data['old_chat_member']['status']);
    $this->StatusNew = TgMemberStatus::tryFrom($Data['new_chat_member']['status']);
    if($this->StatusNew === TgMemberStatus::Adm):
      $this->Perms = new TgPermAdmin($Data['new_chat_member']);
    else:
      $this->Perms = null;
    endif;
  }
}