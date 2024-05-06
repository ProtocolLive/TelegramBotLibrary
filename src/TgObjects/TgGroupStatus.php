<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TgAuxiliary\TgMessageData;
use ProtocolLive\TelegramBotLibrary\TgEnums\TgMemberStatus;
use ProtocolLive\TelegramBotLibrary\TgInterfaces\TgEventInterface;

/**
 * A chat member's status was updated in a chat. The bot must be an administrator in the chat and must explicitly specify “chat_member” in the list of allowed_updates to receive these updates.
 * @link https://core.telegram.org/bots/api#update
 * @link https://core.telegram.org/bots/api#chatmemberupdated
 * @version 2024.05.06.00
 */
final readonly class TgGroupStatus
implements TgEventInterface{
  public TgMessageData $Data;
  /**
   * Previous information about the chat member
   */
  public TgUser $Member;
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
  /**
   * If the user joined the chat via a chat folder invite link
   */
  public bool $ViaFolderLink;
  /**
   * If the user joined the chat after sending a direct join request and being approved by an administrator
   */
  public bool $ViaJoinLink;

  public function __construct(
    array $Data
  ){
    $this->Data = new TgMessageData($Data);
    $this->Member = new TgUser($Data['new_chat_member']['user']);
    $this->StatusOld = TgMemberStatus::tryFrom($Data['old_chat_member']['status']);
    $this->StatusNew = TgMemberStatus::tryFrom($Data['new_chat_member']['status']);
    if($this->StatusOld === TgMemberStatus::Adm):
      $this->PermsOld = new TgPermAdmin($Data['old_chat_member']);
    else:
      $this->PermsOld = new TgPermMember($Data['old_chat_member']);
    endif;
    if($this->StatusNew === TgMemberStatus::Adm):
      $this->PermsNew = new TgPermAdmin($Data['new_chat_member']);
    else:
      $this->PermsNew = new TgPermMember($Data['new_chat_member']);
    endif;
    $this->ViaFolderLink = $Data['via_chat_folder_invite_link'] ?? false;
    $this->ViaJoinLink = $Data['via_join_request'] ?? false;
  }
}