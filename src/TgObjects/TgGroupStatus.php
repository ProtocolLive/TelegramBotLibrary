<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.08.18.00

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * A chat member's status was updated in a chat. The bot must be an administrator in the chat and must explicitly specify “chat_member” in the list of allowed_updates to receive these updates.
 * @link https://core.telegram.org/bots/api#update
 */
class TgGroupStatus{
  public readonly TgUser $User;
  public readonly TgChat $Group;
  public readonly int $Date;
  public readonly TgUser $Member;
  public readonly TgMemberStatus $StatusOld;
  public readonly TgPermMember|TgPermAdmin $PermsOld;
  public readonly TgMemberStatus $StatusNew;
  public readonly TgPermMember|TgPermAdmin $PermsNew;

  /**
   * The bot's chat member status was updated in a chat. For private chats, this update is received only when the bot is blocked or unblocked by the user.
   * @link https://core.telegram.org/bots/api#chatmemberupdated
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
  }
}