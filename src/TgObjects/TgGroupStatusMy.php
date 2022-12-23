<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.12.23.00

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * The bot's chat member status was updated in a chat. For private chats, this update is received only when the bot is blocked or unblocked by the user.
 * @link https://core.telegram.org/bots/api#chatmemberupdated
 */
class TgGroupStatusMy{
  /**
   * Performer of the action, which resulted in the change
   */
  public readonly TgUser $User;
  /**
   * Chat the user belongs to. Can be null in case of bot are blocked
   */
  public readonly TgChat|null $Group;
  /**
   * Date the change was done in Unix time
   */
  public readonly int $Date;
  /**
   * Previous information about the chat member
   */
  public readonly TgMemberStatus $StatusOld;
  /**
   * New information about the chat member
   */
  public readonly TgMemberStatus $StatusNew;
  public readonly TgPermAdmin|null $Perms;

  /**
   * The bot's chat member status was updated in a chat. For private chats, this update is received only when the bot is blocked or unblocked by the user.
   * @link https://core.telegram.org/bots/api#chatmemberupdated
   */
  public function __construct(array $Data){
    $this->User = new TgUser($Data['from']);
    if($Data['chat']['type'] === TgChatType::Private->value):
      $this->Group = null;
    else:
      $this->Group = new TgChat($Data['chat']);
    endif;
    $this->Date = $Data['date'];
    $this->StatusOld = TgMemberStatus::tryFrom($Data['old_chat_member']['status']);
    $this->StatusNew = TgMemberStatus::tryFrom($Data['new_chat_member']['status']);
    if($this->StatusNew === TgMemberStatus::Adm):
      $this->Perms = new TgPermAdmin($Data['new_chat_member']);
    else:
      $this->Perms = null;
    endif;
  }
}