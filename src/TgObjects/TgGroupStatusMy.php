<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TgEnums\{
  TgChatType,
  TgMemberStatus
};
use ProtocolLive\TelegramBotLibrary\TgInterfaces\TgEventInterface;

/**
 * The bot's chat member status was updated in a chat. For private chats, this update is received only when the bot is blocked or unblocked by the user.
 * @link https://core.telegram.org/bots/api#chatmemberupdated
 * @version 2024.01.01.00
 */
class TgGroupStatusMy
implements TgEventInterface{
  /**
   * Performer of the action, which resulted in the change
   */
  public readonly TgUser $User;
  /**
   * Chat the user belongs to
   */
  public readonly TgChat|TgUser $Group;
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
  public function __construct(
    array $Data
  ){
    $this->User = new TgUser($Data['from']);
    if($Data['chat']['type'] === TgChatType::Private->value):
      $this->Group = new TgUser($Data['chat']);
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