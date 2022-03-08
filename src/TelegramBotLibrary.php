<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.03.07.00

require(__DIR__ . '/requires.php');

class TelegramBotLibrary extends TblBasics{
  private function Archive(array $New){
    $file = $this->BotData->DirLogs . '/archive.json';
    if(is_file($file)):
      $archive = file_get_contents($file);
    else:
      $archive = '[]';
    endif;
    $archive = json_decode($archive, true);
    $archive[] = $New;
    $archive = json_encode($archive);
    file_put_contents($file, $archive);
  }

  public function __construct(TblData $BotData){
    if(extension_loaded('openssl') === false):
      trigger_error($this->Errors[TblError::NoSsl], E_USER_ERROR);
    elseif(extension_loaded('curl') === false):
      trigger_error($this->Errors[TblError::NoCurl], E_USER_ERROR);
    endif;
    $this->BotData = $BotData;
    $_SERVER['HTTP_USER_AGENT'] ??= 'Protocol TelegramBotLibrary';
  }

  public function WebhookGet():object|null{
    $update = file_get_contents('php://input');
    if($update === ''):
      $this->Error = TblError::NoEvent;
      return null;
    endif;
    $update = json_decode($update, true);
    $this->Archive($update);
    if(($this->BotData->Debug & TblDebug::Webhook) === TblDebug::Webhook):
      $this->DebugLog(TblLog::Webhook, json_encode($update, JSON_PRETTY_PRINT));
    endif;
    if(isset($update['message']['entities'][0])
    and $update['message']['entities'][0]['type'] === TgEntityType::Command->value
    and $update['message']['entities'][0]['offset'] === 0):
      return new TblCmd($update['message']);
    endif;
    if(isset($update['message']['text'])):
      return new TgText($update['message']);
    endif;
    if(isset($update['message']['photo'])):
      return new TgPhoto($update['message']);
    endif;
  }

  /**
   * Use this method to get up to date information about the chat (current name of the user for one-on-one conversations, current username of a user, group or channel, etc.). Returns a Chat object on success.
   * @param int $Chat Unique identifier for the target chat
   * @link https://core.telegram.org/bots/api#getchat
   */
  public function ChatGet(int $Chat):TgChat|null{
    $temp = $this->ServerMethod('getChat?chat_id=' . $Chat, false);
    if($temp !== null):
      return new TgChat($temp);
    endif;
  }

  /**
   * Use this method to get the number of members in a chat. Returns Int on success.
   * @link https://core.telegram.org/bots/api#getchatmembercount
   */
  public function ChatCount(int $Chat):int|null{
    return $this->ServerMethod('getChatMemberCount?chat_id=' . $Chat, false);
  }

  /**
   * Use this method to set a custom title for an administrator in a supergroup promoted by the bot. Returns True on success.
   * @param int $Chat Unique identifier for the target chat
   * @param int $User Unique identifier of the target user
   * @param string $Title New custom title for the administrator; 0-16 characters, emoji are not allowed
   * @link https://core.telegram.org/bots/api#setchatadministratorcustomtitle
   */
  public function ChatAdmTitleSet(
    int $Chat,
    int $User,
    string $Title
  ):bool|null{
    $param['chat_id'] = $Chat;
    $param['user_id'] = $User;
    $param['custom_title'] = $Title;
    return $this->ServerMethod('setChatAdministratorCustomTitle?' . http_build_query($param), false);
  }

  /**
   * Use this method to ban a user in a group, a supergroup or a channel. In the case of supergroups and channels, the user will not be able to return to the chat on their own using invite links, etc., unless unbanned first. The bot must be an administrator in the chat for this to work and must have the appropriate administrator rights. Returns True on success.
   * @param int $Chat Unique identifier for the target group or username of the target supergroup or channel
   * @param int $User Unique identifier of the target user
   * @param int $Date Date when the user will be unbanned, unix time. If user is banned for more than 366 days or less than 30 seconds from the current time they are considered to be banned forever. Applied for supergroups and channels only.
   * @param bool $DelMsg Pass True to delete all messages from the chat for the user that is being removed. If False, the user will be able to see messages in the group that were sent before the user was removed. Always True for supergroups and channels.
   * @link https://core.telegram.org/bots/api#banchatmember
   */
  public function ChatBan(
    int $Chat,
    int $User,
    int $Date,
    bool $DelMsg = false
  ):bool|null{
    $param['chat_id'] = $Chat;
    $param['user_id'] = $User;
    $param['until_date'] = $Date;
    $param['revoke_messages'] = $DelMsg;
    return $this->ServerMethod('banChatMember?' . http_build_query($param), false);
  }

  /**
   * Use this method to unban a previously banned user in a supergroup or channel. The user will not return to the group or channel automatically, but will be able to join via link, etc. The bot must be an administrator for this to work. By default, this method guarantees that after the call the user is not a member of the chat, but will be able to join it. So if the user is a member of the chat they will also be removed from the chat. If you don't want this, use the parameter only_if_banned. Returns True on success.
   * @param int $Chat Unique identifier for the target group or username of the target supergroup or channel
   * @param int $User Unique identifier of the target user
   * @param bool $OnlyIfBanned Do nothing if the user is not banned
   * @link https://core.telegram.org/bots/api#unbanchatmember
   */
  public function ChatUnban(
    int $Chat,
    int $User,
    bool $OnlyIfBanned = true
  ):bool|null{
    $param['chat_id'] = $Chat;
    $param['user_id'] = $User;
    $param['only_if_banned'] = $OnlyIfBanned;
    $temp = $this->ServerMethod('unbanChatMember?' . http_build_query($param), false);
    return $temp;
  }

  /**
   * Use this method to forward messages of any kind. Service messages can't be forwarded. On success, the sent Message is returned.
   * @param int $To Unique identifier for the target chat or username of the target channel
   * @param int $From Unique identifier for the chat where the original message was sent
   * @param int $Id Message identifier in the chat specified in from_chat_id
   * @param bool $DisableNotification Sends the message silently. Users will receive a notification with no sound.
   * @param bool $Protect Protects the contents of the forwarded message from forwarding and saving
   * @link https://core.telegram.org/bots/api#forwardmessage
   */
  public function Forward(
    int $To,
    int $From,
    int $Id,
    bool $DisableNotification = false,
    bool $Protect = false
  ):TgMessage|null{
    $param['chat_id'] = $To;
    $param['from_chat_id'] = $From;
    $param['message_id'] = $Id;
    if($DisableNotification):
      $param['disable_notification'] = true;
    endif;
    if($Protect):
      $param['protect_content'] = true;
    endif;
    $temp = $this->ServerMethod('forwardMessage?' . http_build_query($param));
    if($temp === null):
      return null;
    else:
      return new TgMessage($temp);
    endif;
  }

  /**
   * Use this method to get the current list of the bot's commands for the given scope and user language. Returns Array of BotCommand on success. If commands aren't set, an empty list is returned.
   * @param TgCmdScope $Scope A JSON-serialized object, describing scope of users. Defaults to TgCmdScope::Default.
   * @param string $Language A two-letter ISO 639-1 language code or an empty string
   * @param int $Chat Unique identifier for the target chat. Only for TgCmdScope::Chat, TgCmdScope::GroupsAdmins or TgCmdScope::Member
   * @param int $User Unique identifier of the target user. Only for TgCmdScope::Member
   * @link https://core.telegram.org/bots/api#getmycommands
   */
  public function CmdGet(
    TgCmdScope $Scope = null,
    string $Language = null,
    int $Chat = null,
    int $User = null
  ):array|null{
    $param = [];
    if($Scope !== null):
      $param['scope']['type'] = $Scope->value;
      if($Scope === TgCmdScope::Chat
      or $Scope === TgCmdScope::GroupsAdmins
      or $Scope === TgCmdScope::Member):
        $param['scope']['chat_id'] = $Chat;
      endif;
      if($Scope === TgCmdScope::Member):
        $param['scope']['user_id'] = $User;
      endif;
    endif;
    if($Language !== null):
      $param['language_code'] = $Language;
    endif;
    if(count($param) === 0):
      $temp = '';
    else:
      $temp = '?' . http_build_query($param);
    endif;
    return $this->ServerMethod('getMyCommands' . $temp, false);
  }

  /**
   * Use this method to change the list of the bot's commands. See https://core.telegram.org/bots#commands for more details about bot commands. Returns True on success.
   * @param array $Commands A JSON-serialized list of bot commands to be set as the list of the bot's commands. At most 100 commands can be specified.
   * @param TgCmdScope $Scope A JSON-serialized object, describing scope of users for which the commands are relevant. Defaults to TgCmdScope::Default
   * @param string $Language A two-letter ISO 639-1 language code. If empty, commands will be applied to all users from the given scope, for whose language there are no dedicated commands
   * @link https://core.telegram.org/bots/api#setmycommands
   */
  public function CmdSet(
    array $Commands,
    TgCmdScope $Scope = null,
    string $Language = null
  ):bool|null{
    $param['commands'] = json_encode($Commands);
    if($Scope !== null):
      $param['scope'] = $Scope->value;
    endif;
    if($Language !== null):
      $param['language_code'] = $Language;
    endif;
    return $this->ServerMethod('setMyCommands?' . http_build_query($param));
  }

  /**
   * Use this method to delete the list of the bot's commands for the given scope and user language. After deletion, higher level commands will be shown to affected users. Returns True on success.
   * @param TgCmdScope $Scope A JSON-serialized object, describing scope of users for which the commands are relevant. Defaults to BotCommandScopeDefault.
   * @param string $Language A two-letter ISO 639-1 language code. If empty, commands will be applied to all users from the given scope, for whose language there are no dedicated commands
   * @link https://core.telegram.org/bots/api#deletemycommands
   */
  public function CmdDel(
    TgCmdScope $Scope = null,
    string $Language = null
  ):bool|null{
    $param = [];
    if($Scope !== null):
      $param['scope'] = $Scope->value;
    endif;
    if($Language !== null):
      $param['language_code'] = $Language;
    endif;
    if(count($param) === 0):
      $temp = '';
    else:
      $temp = '?' . http_build_query($param);
    endif;
    return $this->ServerMethod('deleteMyCommands' . $temp);
  }

  /**
   * A simple method for testing your bot's authentication token. Requires no parameters. Returns basic information about the bot in form of a User object.
   * @link https://core.telegram.org/bots/api#getme
   */
  public function MeGet():TgUser|null{
    $temp = $this->ServerMethod('getMe', false);
    if($temp === null):
      return null;
    else:
      return new TgUser($temp);
    endif;
  }
}