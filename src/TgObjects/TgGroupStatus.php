<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2023.04.24.00

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * A chat member's status was updated in a chat. The bot must be an administrator in the chat and must explicitly specify “chat_member” in the list of allowed_updates to receive these updates.
 * @link https://core.telegram.org/bots/api#update
 * @link https://core.telegram.org/bots/api#chatmemberupdated
 */
final class TgGroupStatus{
  /**
   * Performer of the action, which resulted in the change
   */
  public readonly TgUser $User;
  /**
   * Chat the user belongs to
   */
  public readonly TgChat $Group;
  /**
   * Date the change was done in Unix time
   */
  public readonly int $Date;
  public readonly TgUser $Member;
  public readonly TgMemberStatus $StatusOld;
  public readonly TgPermMember|TgPermAdmin $PermsOld;
  public readonly TgMemberStatus $StatusNew;
  public readonly TgPermMember|TgPermAdmin $PermsNew;
  public readonly bool $ViaFolderLink;

  /**
   * The bot's chat member status was updated in a chat. For private chats, this update is received only when the bot is blocked or unblocked by the user.
   */
  public function __construct(array $Data){
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