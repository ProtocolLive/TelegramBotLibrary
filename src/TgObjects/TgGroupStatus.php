<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TgEnums\TgMemberStatus;
use ProtocolLive\TelegramBotLibrary\TgInterfaces\TgEventInterface;

/**
 * A chat member's status was updated in a chat. The bot must be an administrator in the chat and must explicitly specify “chat_member” in the list of allowed_updates to receive these updates.
 * @link https://core.telegram.org/bots/api#update
 * @link https://core.telegram.org/bots/api#chatmemberupdated
 * @version 2024.01.04.00
 */
final readonly class TgGroupStatus
implements TgEventInterface{
  /**
   * Performer of the action, which resulted in the change
   */
  public TgUser $User;
  /**
   * Chat the user belongs to
   */
  public TgChat $Group;
  /**
   * Date the change was done in Unix time
   */
  public int $Date;
  public TgUser $Member;
  public TgMemberStatus $StatusOld;
  public TgPermMember|TgPermAdmin $PermsOld;
  public TgMemberStatus $StatusNew;
  public TgPermMember|TgPermAdmin $PermsNew;
  public bool $ViaFolderLink;

  public function __construct(
    array $Data
  ){
    $this->User = new TgUser($Data['from']);
    $this->Group = new TgChat($Data['chat']);
    $this->Date = $Data['date'];
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
  }
}