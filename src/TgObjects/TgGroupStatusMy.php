<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TgAuxiliary\TgMessageData;
use ProtocolLive\TelegramBotLibrary\TgEnums\TgMemberStatus;
use ProtocolLive\TelegramBotLibrary\TgInterfaces\TgEventInterface;

/**
 * The bot's chat member status was updated in a chat. For private chats, this update is received only when the bot is blocked or unblocked by the user.
 * @link https://core.telegram.org/bots/api#chatmemberupdated
 * @version 2025.07.02.00
 */
final readonly class TgGroupStatusMy
implements TgEventInterface{
  public TgMessageData $Data;
  /**
   * Previous information about the chat member
   */
  public TgMemberStatus $StatusOld;
  /**
   * Previous information about the chat member
   */
  public TgPermMember|TgPermAdmin $PermsOld;
  /**
   * New information about the chat member
   */
  public TgMemberStatus $StatusNew;
  /**
   * New information about the chat member
   */
  public TgPermMember|TgPermAdmin $PermsNew;


  public function __construct(
    array $Data
  ){
    $this->Data = new TgMessageData($Data);
    $this->StatusOld = TgMemberStatus::tryFrom($Data['old_chat_member']['status']);
    $this->StatusNew = TgMemberStatus::tryFrom($Data['new_chat_member']['status']);
    if($this->StatusOld === TgMemberStatus::Adm):
      $this->PermsOld = new TgPermAdmin($Data['new_chat_member']);
    else:
      $this->PermsOld = new TgPermMember($Data['new_chat_member']);
    endif;
    if($this->StatusNew === TgMemberStatus::Adm):
      $this->PermsNew = new TgPermAdmin($Data['new_chat_member']);
    else:
      $this->PermsNew = new TgPermMember($Data['new_chat_member']);
    endif;
  }
}