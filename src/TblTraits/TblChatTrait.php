<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.11.05.00

namespace ProtocolLive\TelegramBotLibrary\TblTraits;

use ProtocolLive\TelegramBotLibrary\TgObjects\TgChat;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgChatAction;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgMember;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgMethods;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgPermAdmin;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgPermMember;

trait TblForumTrait{
  /**
   * Use this method when you need to tell the user that something is happening on the bot's side. The status is set for 5 seconds or less (when a message arrives from your bot, Telegram clients clear its typing status).
   * Example: The ImageBot needs some time to process a request and upload the image. Instead of sending a text message along the lines of “Retrieving image, please wait…”, the bot may use sendChatAction with action = upload_photo. The user will see a “sending photo” status for the bot.
   * @return bool Returns True on success.
   * @throws TblException
   * @link https://core.telegram.org/bots/api#sendchataction
   */
  public function ChatActionSend(
    int $Chat,
    TgChatAction $Action
  ):bool{
    $param['chat_id'] = $Chat;
    $param['action'] = $Action->value;
    return $this->ServerMethod(TgMethods::ChatAction, $param);
  }

  /** MUDAR
   * Use this method to get a list of administrators in a chat. On success, returns an Array of ChatMember objects that contains information about all chat administrators except other bots.
   * @param int $Chat Unique identifier for the target chat
   * @return array If the chat is a group or a supergroup and no administrators were appointed, only the creator will be returned.
   * @throws TblException
   * @link https://core.telegram.org/bots/api#getchatadministrators
   */
  public function ChatAdmGet(int $Chat):array|null{
    $param['chat_id'] = $Chat;
    $temp = $this->ServerMethod(TgMethods::ChatAdms, $param);
    $return = [];
    foreach($temp as $user):
      $return[] = new TgMember($user);
    endforeach;
    return $return;
  }

  /**
   * Use this method to promote or demote a user in a supergroup or a channel. The bot must be an administrator in the chat for this to work and must have the appropriate administrator rights. Pass False for all boolean parameters to demote a user.
   * @param int $Chat Unique identifier for the target
   * @param int $User Unique identifier of the target user
   * @param TgPermAdmin $Perms
   * @param bool $Anonymous If the administrator's presence in the chat is hidden
   * @return bool Returns True on success.
   * @throws TblException
   * @link https://core.telegram.org/bots/api#promotechatmember
   */
  public function ChatAdminPerm(
    int $Chat,
    int $User,
    TgPermAdmin $Perms,
    bool $Anonymous = false
  ):bool{
    $param['chat_id'] = $Chat;
    $param['user_id'] = $User;
    foreach(TgPermAdmin::Array as $class => $json):
      $param[$json] = $Perms->$class ? 'true' : 'false';
    endforeach;
    $param['is_anonymous'] = $Anonymous ? 'true' : 'false';
    return $this->ServerMethod(TgMethods::ChatMemberPromote, $param);
  }

  /**
   * Use this method to set a custom title for an administrator in a supergroup promoted by the bot.
   * @param int $Chat Unique identifier for the target chat
   * @param int $User Unique identifier of the target user
   * @param string $Title New custom title for the administrator; 0-16 characters, emoji are not allowed
   * @return bool Returns True on success.
   * @throws TblException
   * @link https://core.telegram.org/bots/api#setchatadministratorcustomtitle
   */
  public function ChatAdminTitleSet(
    int $Chat,
    int $User,
    string $Title
  ):bool{
    $param['chat_id'] = $Chat;
    $param['user_id'] = $User;
    $param['custom_title'] = $Title;
    return $this->ServerMethod(TgMethods::ChatAdmTitle, $param);
  }

  /**
   * Use this method to ban a user in a group, a supergroup or a channel. In the case of supergroups and channels, the user will not be able to return to the chat on their own using invite links, etc., unless unbanned first. The bot must be an administrator in the chat for this to work and must have the appropriate administrator rights.
   * @param int $Chat Unique identifier for the target group or username of the target supergroup or channel
   * @param int $User Unique identifier of the target user
   * @param int $Date Date when the user will be unbanned, unix time. If user is banned for more than 366 days or less than 30 seconds from the current time they are considered to be banned forever. Applied for supergroups and channels only.
   * @param bool $DelMsg Pass True to delete all messages from the chat for the user that is being removed. If False, the user will be able to see messages in the group that were sent before the user was removed. Always True for supergroups and channels.
   * @return bool Returns True on success.
   * @throws TblException
   * @link https://core.telegram.org/bots/api#banchatmember
   */
  public function ChatBan(
    int $Chat,
    int $User,
    int $Date,
    bool $DelMsg = false
  ):bool{
    $param['chat_id'] = $Chat;
    $param['user_id'] = $User;
    $param['until_date'] = $Date;
    $param['revoke_messages'] = $DelMsg;
    return $this->ServerMethod(TgMethods::ChatMemberBan, $param);
  }

  /**
   * Use this method to unban a previously banned user in a supergroup or channel. The user will not return to the group or channel automatically, but will be able to join via link, etc. The bot must be an administrator for this to work. By default, this method guarantees that after the call the user is not a member of the chat, but will be able to join it. So if the user is a member of the chat they will also be removed from the chat. If you don't want this, use the parameter only_if_banned.
   * @param int $Chat Unique identifier for the target group or username of the target supergroup or channel
   * @param int $User Unique identifier of the target user
   * @param bool $OnlyIfBanned Do nothing if the user is not banned
   * @return bool Returns True on success.
   * @throws TblException
   * @link https://core.telegram.org/bots/api#unbanchatmember
   */
  public function ChatBanUndo(
    int $Chat,
    int $User,
    bool $OnlyIfBanned = true
  ):bool{
    $param['chat_id'] = $Chat;
    $param['user_id'] = $User;
    $param['only_if_banned'] = $OnlyIfBanned;
    return $this->ServerMethod(TgMethods::ChatMemberBanUndo, $param);
  }

  /**
   * Use this method to get the number of members in a chat.
   * @param int $Chat Unique identifier for the target
   * @param int Returns Int on success.
   * @throws TblException
   * @link https://core.telegram.org/bots/api#getchatmembercount
   */
  public function ChatCount(int $Chat):int{
    $param['chat_id'] = $Chat;
    return $this->ServerMethod(TgMethods::ChatMemberCount, $param);
  }

  /**
   * Use this method to get up to date information about the chat (current name of the user for one-on-one conversations, current username of a user, group or channel, etc.).
   * @param int $Chat Unique identifier for the target chat
   * @return TgChat Returns a Chat object on success.
   * @throws TblException
   * @link https://core.telegram.org/bots/api#getchat
   */
  public function ChatGet(int $Chat):TgChat|null{
    $param['chat_id'] = $Chat;
    $temp = $this->ServerMethod(TgMethods::Chat, $param);
    return new TgChat($temp);
  }

  /**
   * Use this method to get information about a member of a chat.
   * @param int $Chat Unique identifier for the target chat
   * @param int $User Unique identifier of the target user
   * @return TgMember Returns a ChatMember object on success.
   * @throws TblException
   * @link https://core.telegram.org/bots/api#getchatmember
   */
  public function ChatMember(
    int $Chat,
    int $User
  ):TgMember{
    $param['chat_id'] = $Chat;
    $param['user_id'] = $User;
    $temp = $this->ServerMethod(TgMethods::ChatMember, $param);
    return new TgMember($temp);
  }

  /**
   * Use this method to restrict a user in a supergroup. The bot must be an administrator in the supergroup for this to work and must have the appropriate administrator rights. Pass True for all permissions to lift restrictions from a user.
   * @param int $Chat Unique identifier for the target
   * @param int $User Unique identifier of the target user
   * @param TgPermMember $Perms A object for new user permissions
   * @param int $Period Date when restrictions will be lifted for the user, unix time. If user is restricted for more than 366 days or less than 30 seconds from the current time, they are considered to be restricted forever
   * @return bool|null Returns True on success.
   * @throws TblException
   * @link https://core.telegram.org/bots/api#restrictchatmember
   */
  public function ChatMemberPerm(
    int $Chat,
    int $User,
    TgPermMember $Perms,
    int $Period = null
  ):bool{
    $param['chat_id'] = $Chat;
    $param['user_id'] = $User;
    foreach(TgPermMember::Array as $class => $json):
      $param['permissions'][$json] = $Perms->$class;
    endforeach;
    $param['permissions'] = json_encode($param['permissions']);
    $param['until_date'] = $Period;
    return $this->ServerMethod(TgMethods::ChatMemberPerm, $param);
  }
}