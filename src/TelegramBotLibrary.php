<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.04.16.03

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
    elseif(isset($update['message']['text'])):
      return new TgText($update['message']);
    elseif(isset($update['message']['photo'])):
      return new TgPhoto($update['message']);
    elseif(isset($update['message']['document'])):
      return new TgDocument($update['message']);
    elseif(isset($update['callback_query'])):
      return new TgCallback($update['callback_query']);
    endif;
  }

  /**
   * Use this method to get up to date information about the chat (current name of the user for one-on-one conversations, current username of a user, group or channel, etc.).
   * @param int $Chat Unique identifier for the target chat
   * @return TgChat|null Returns a Chat object on success.
   * @link https://core.telegram.org/bots/api#getchat
   */
  public function ChatGet(int $Chat):TgChat|null{
    $temp = $this->ServerMethod('getChat?chat_id=' . $Chat);
    if($temp === null):
      return null;
    else:
      return new TgChat($temp);
    endif;
  }

  /**
   * Use this method to get the number of members in a chat.
   * @param int $Chat Unique identifier for the target
   * @param int|null Returns Int on success.
   * @link https://core.telegram.org/bots/api#getchatmembercount
   */
  public function ChatCount(int $Chat):int|null{
    return $this->ServerMethod('getChatMemberCount?chat_id=' . $Chat);
  }

  /**
   * Use this method to get information about a member of a chat.
   * @param int $Chat Unique identifier for the target chat
   * @param int $User Unique identifier of the target user
   * @return TgMember|null Returns a ChatMember object on success.
   * @link https://core.telegram.org/bots/api#getchatmember
   */
  public function ChatMember(int $Chat, int $User):TgMember|null{
    $param['chat_id'] = $Chat;
    $param['user_id'] = $User;
    $temp = $this->ServerMethod('getChatMember?' . http_build_query($param));
    return new TgMember($temp);
  }

  /**
   * Use this method to get a list of administrators in a chat. On success, returns an Array of ChatMember objects that contains information about all chat administrators except other bots.
   * @param int $Chat Unique identifier for the target chat
   * @return array|null If the chat is a group or a supergroup and no administrators were appointed, only the creator will be returned.
   * @link https://core.telegram.org/bots/api#getchatadministrators
   */
  public function ChatAdmGet(int $Chat):array|null{
    $temp = $this->ServerMethod('getChatAdministrators?chat_id=' . $Chat);
    if($temp === null):
      return null;
    else:
      $return = [];
      foreach($temp as $user):
        $return[] = new TgMember($user);
      endforeach;
      return $return;
    endif;
  }

  /**
   * Use this method to get the current default administrator rights of the bot.
   * @param DefaultPerms $Type Pass Channels to get default administrator rights of the bot in channels. Otherwise, default administrator rights of the bot for groups and supergroups will be returned.
   * @return mixed Returns TgPermAdmin on success.
   * @link https://core.telegram.org/bots/api#getmydefaultadministratorrights
   */
  public function DefaultPermGet(
    DefaultPerms $Type = DefaultPerms::Groups
  ):TgPermAdmin|null{
    if($Type === DefaultPerms::Channels):
      $param = '?for_channels=true';
    else:
      $param = '';
    endif;
    $return = $this->ServerMethod('getMyDefaultAdministratorRights' . $param);
    if($return === null):
      return null;
    else:
      return new TgPermAdmin($return);
    endif;
  }

  /**
   * Use this method to change the default administrator rights requested by the bot when it's added as an administrator to groups or channels. These rights will be suggested to users, but they are are free to modify the list before adding the bot.
   * @param TgPermAdmin $Perms An object describing new default administrator rights. If not specified, the default administrator rights will be cleared.
   * @param DefaultPerms $Type Pass Channels to change the default administrator rights of the bot in channels. Otherwise, the default administrator rights of the bot for groups and supergroups will be changed.
   * @return bool|null Returns True on success.
   * @link https://core.telegram.org/bots/api#setmydefaultadministratorrights
   */
  public function DefaultPermSet(
    TgPermAdmin $Perms,
    DefaultPerms $Type = DefaultPerms::Groups
  ):bool|null{
    foreach(TgPermAdmin::Array as $class => $json):
      $perms[$json] = $Perms->$class ? true : false;
    endforeach;
    $param['rights'] = json_encode($perms);
    if($Type === DefaultPerms::Channels):
      $param['for_channels'] = 'true';
    endif;
    return $this->ServerMethod('setMyDefaultAdministratorRights?' . http_build_query($param));
  }

  /**
   * Use this method to restrict a user in a supergroup. The bot must be an administrator in the supergroup for this to work and must have the appropriate administrator rights. Pass True for all permissions to lift restrictions from a user.
   * @param int $Chat Unique identifier for the target
   * @param int $User Unique identifier of the target user
   * @param TgPermMember $Perms A object for new user permissions
   * @param int $Period Date when restrictions will be lifted for the user, unix time. If user is restricted for more than 366 days or less than 30 seconds from the current time, they are considered to be restricted forever
   * @return bool|null Returns True on success.
   * @link https://core.telegram.org/bots/api#restrictchatmember
   */
  public function ChatMemberPerm(
    int $Chat,
    int $User,
    TgPermMember $Perms,
    int $Period = null
  ):bool|null{
    $param['chat_id'] = $Chat;
    $param['user_id'] = $User;
    foreach(TgPermMember::Array as $class => $json):
      $temp[$json] = $Perms->$class;
    endforeach;
    $param['permissions'] = json_encode($temp);
    $param['until_date'] = $Period;
    return $this->ServerMethod('restrictChatMember?' . http_build_query($param));
  }

  /**
   * Use this method to promote or demote a user in a supergroup or a channel. The bot must be an administrator in the chat for this to work and must have the appropriate administrator rights. Pass False for all boolean parameters to demote a user.
   * @param int $Chat Unique identifier for the target
   * @param int $User Unique identifier of the target user
   * @param TgPermAdmin $Perms
   * @param bool $Anonymous If the administrator's presence in the chat is hidden
   * @return bool|null Returns True on success.
   * @link https://core.telegram.org/bots/api#promotechatmember
   */
  public function ChatAdminPerm(
    int $Chat,
    int $User,
    TgPermAdmin $Perms,
    bool $Anonymous = false
  ):bool|null{
    $param['chat_id'] = $Chat;
    $param['user_id'] = $User;
    foreach(TgPermAdmin::Array as $class => $json):
      $param[$json] = $Perms->$class ? 'true' : 'false';
    endforeach;
    $param['is_anonymous'] = $Anonymous ? 'true' : 'false';
    return $this->ServerMethod('promoteChatMember?' . http_build_query($param));
  }

  /**
   * Use this method to set a custom title for an administrator in a supergroup promoted by the bot.
   * @param int $Chat Unique identifier for the target chat
   * @param int $User Unique identifier of the target user
   * @param string $Title New custom title for the administrator; 0-16 characters, emoji are not allowed
   * @return bool|null Returns True on success.
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
    return $this->ServerMethod('setChatAdministratorCustomTitle?' . http_build_query($param));
  }

  /**
   * Use this method to ban a user in a group, a supergroup or a channel. In the case of supergroups and channels, the user will not be able to return to the chat on their own using invite links, etc., unless unbanned first. The bot must be an administrator in the chat for this to work and must have the appropriate administrator rights.
   * @param int $Chat Unique identifier for the target group or username of the target supergroup or channel
   * @param int $User Unique identifier of the target user
   * @param int $Date Date when the user will be unbanned, unix time. If user is banned for more than 366 days or less than 30 seconds from the current time they are considered to be banned forever. Applied for supergroups and channels only.
   * @param bool $DelMsg Pass True to delete all messages from the chat for the user that is being removed. If False, the user will be able to see messages in the group that were sent before the user was removed. Always True for supergroups and channels.
   * @return bool|null Returns True on success.
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
    return $this->ServerMethod('banChatMember?' . http_build_query($param));
  }

  /**
   * Use this method to unban a previously banned user in a supergroup or channel. The user will not return to the group or channel automatically, but will be able to join via link, etc. The bot must be an administrator for this to work. By default, this method guarantees that after the call the user is not a member of the chat, but will be able to join it. So if the user is a member of the chat they will also be removed from the chat. If you don't want this, use the parameter only_if_banned.
   * @param int $Chat Unique identifier for the target group or username of the target supergroup or channel
   * @param int $User Unique identifier of the target user
   * @param bool $OnlyIfBanned Do nothing if the user is not banned
   * @return bool|null Returns True on success.
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
    return $this->ServerMethod('unbanChatMember?' . http_build_query($param));
  }

  /**
   * Use this method to forward messages of any kind. Service messages can't be forwarded.
   * @param int $To Unique identifier for the target chat or username of the target channel
   * @param int $From Unique identifier for the chat where the original message was sent
   * @param int $Id Message identifier in the chat specified in from_chat_id
   * @param bool $DisableNotification Sends the message silently. Users will receive a notification with no sound.
   * @param bool $Protect Protects the contents of the forwarded message from forwarding and saving
   * @return TgMessage|null On success, the sent Message is returned.
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
   * Use this method to get the current list of the bot's commands for the given scope and user language.
   * @param TgCmdScope $Scope A JSON-serialized object, describing scope of users. Defaults to TgCmdScope::Default.
   * @param string $Language A two-letter ISO 639-1 language code or an empty string
   * @param int $Chat Unique identifier for the target chat. Only for TgCmdScope::Chat, TgCmdScope::GroupsAdmins or TgCmdScope::Member
   * @param int $User Unique identifier of the target user. Only for TgCmdScope::Member
   * @return array|null Returns Array of BotCommand on success. If commands aren't set, an empty list is returned.
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
      or $Scope === TgCmdScope::GroupAdmins
      or $Scope === TgCmdScope::Member):
        $param['scope']['chat_id'] = $Chat;
      endif;
      if($Scope === TgCmdScope::Member):
        $param['scope']['user_id'] = $User;
      endif;
      $param['scope'] = json_encode($param['scope']);
    endif;
    if($Language !== null):
      $param['language_code'] = $Language;
    endif;
    if(count($param) === 0):
      $temp = '';
    else:
      $temp = '?' . http_build_query($param);
    endif;
    return $this->ServerMethod('getMyCommands' . $temp);
  }

  /**
   * Use this method to change the list of the bot's commands.
   * @param array $Commands A JSON-serialized list of bot commands to be set as the list of the bot's commands. At most 100 commands can be specified.
   * @param TgCmdScope $Scope A JSON-serialized object, describing scope of users for which the commands are relevant. Defaults to TgCmdScope::Default
   * @param string $Language A two-letter ISO 639-1 language code. If empty, commands will be applied to all users from the given scope, for whose language there are no dedicated commands
   * @return bool|null Returns True on success.
   * @link https://core.telegram.org/bots/api#setmycommands
   */
  public function CmdSet(
    array $Commands,
    TgCmdScope $Scope = null,
    string $Language = null,
    int $Chat = null,
    int $User = null
  ):bool|null{
    $param['commands'] = TblCommand::ToJson($Commands);
    if($Scope !== null):
      $param['scope']['type'] = $Scope->value;
      if($Scope === TgCmdScope::Chat
      or $Scope === TgCmdScope::GroupAdmins
      or $Scope === TgCmdScope::Member):
        $param['scope']['chat_id'] = $Chat;
      endif;
      if($Scope === TgCmdScope::Member):
        $param['scope']['user_id'] = $User;
      endif;
      $param['scope'] = json_encode($param['scope']);
    endif;
    if($Language !== null):
      $param['language_code'] = $Language;
    endif;
    return $this->ServerMethod('setMyCommands?' . http_build_query($param));
  }

  /**
   * Use this method to delete the list of the bot's commands for the given scope and user language. After deletion, higher level commands will be shown to affected users.
   * @param TgCmdScope $Scope A JSON-serialized object, describing scope of users for which the commands are relevant. Defaults to BotCommandScopeDefault.
   * @param string $Language A two-letter ISO 639-1 language code. If empty, commands will be applied to all users from the given scope, for whose language there are no dedicated commands
   * @return bool|null Returns True on success.
   * @link https://core.telegram.org/bots/api#deletemycommands
   */
  public function CmdDel(
    TgCmdScope $Scope = null,
    string $Language = null,
    int $Chat = null,
    int $User = null
  ):bool|null{
    $param = [];
    if($Scope !== null):
      $param['scope']['type'] = $Scope->value;
      if($Scope === TgCmdScope::Chat
      or $Scope === TgCmdScope::GroupAdmins
      or $Scope === TgCmdScope::Member):
        $param['scope']['chat_id'] = $Chat;
      endif;
      if($Scope === TgCmdScope::Member):
        $param['scope']['user_id'] = $User;
      endif;
      $param['scope'] = json_encode($param['scope']);
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
   * A simple method for testing your bot's authentication token. Requires no parameters.
   * @return TgUser|null Returns basic information about the bot in form of a User object.
   * @link https://core.telegram.org/bots/api#getme
   */
  public function MeGet():TgUser|null{
    $temp = $this->ServerMethod('getMe');
    if($temp === null):
      return null;
    else:
      return new TgUser($temp);
    endif;
  }

  /**
   * Use this method when you need to tell the user that something is happening on the bot's side. The status is set for 5 seconds or less (when a message arrives from your bot, Telegram clients clear its typing status).
   * Example: The ImageBot needs some time to process a request and upload the image. Instead of sending a text message along the lines of “Retrieving image, please wait…”, the bot may use sendChatAction with action = upload_photo. The user will see a “sending photo” status for the bot.
   * @return bool|null Returns True on success.
   * @link https://core.telegram.org/bots/api#sendchataction
   */
  public function SendAction(int $Chat, TgChatAction $Action):bool|null{
    return $this->ServerMethod('sendChatAction?chat_id=' . $Chat . '&action=' . $Action->value);
  }

  /**
   * Use this method to copy messages of any kind. Service messages and invoice messages can't be copied. The method is analogous to the method forwardMessage, but the copied message doesn't have a link to the original message.
   * @param int $From
   * @param int $Id Message identifier in the chat specified in $From
   * @param int $To Unique identifier for the target chat
   * @param string $Caption New caption for media, 0-1024 characters after entities parsing. If not specified, the original caption is kept
   * @param array $Entities A list of special entities that appear in the new caption, which can be specified instead of parse_mode
   * @param TgParseMode $ParseMode Mode for parsing entities in the new caption.
   * @param bool $DisableNotification Sends the message silently. Users will receive a notification with no sound.
   * @param bool $Protect Protects the contents of the sent message from forwarding and saving
   * @param int $RepliedMsg If the message is a reply, ID of the original message
   * @param bool $SendWithoutRepliedMsg Pass True, if the message should be sent even if the specified replied-to message is not found
   * @param TblMarkup $Markup Additional interface options. A object for an inline keyboard, custom reply keyboard, instructions to remove reply keyboard or to force a reply from the user.
   * @return int|null Returns the MessageId of the sent message on success.
   * @link https://core.telegram.org/bots/api#copymessage
   */
  public function Copy(
    int $From,
    int $Id,
    int $To,
    string $Caption = null,
    array $Entities = null,
    TgParseMode $ParseMode = TgParseMode::Html,
    bool $DisableNotification = false,
    bool $Protect = false,
    int $RepliedMsg = null,
    bool $SendWithoutRepliedMsg = false,
    TblMarkup $Markup = null
  ):int|null{
    $param['chat_id'] = $To;
    $param['from_chat_id'] = $From;
    $param['message_id'] = $Id;
    if($Caption !== null):
      $param['caption'] = $Caption;
    endif;
    $param['parse_mode'] = $ParseMode->value;
    if($Entities !== null):
      $param['caption_entities'] = TblEntities::ToJson($Entities);
    endif;
    if($DisableNotification):
      $param['disable_notification'] = true;
    endif;
    if($Protect):
      $param['protect_content'] = true;
    endif;
    if($RepliedMsg !== null):
      $param['reply_to_message_id'] = $RepliedMsg;
    endif;
    if($SendWithoutRepliedMsg):
      $param['allow_sending_without_reply'] = true;
    endif;
    if($Markup !== null):
      $param['reply_markup'] = $Markup->Get();
    endif;
    return $this->ServerMethod('copyMessage?' . http_build_query($param));
  }

  /**
   * Use this method to send text messages.
   * @param int $Chat Unique identifier for the target chat
   * @param string $Text Text of the message to be sent, 1-4096 characters after entities parsing
   * @param TgParseMode $ParseMode Mode for parsing entities in the message text.
   * @param array $Entities A list of special entities that appear in message text, which can be specified instead of parse_mode
   * @param bool $DisablePreview Disables link previews for links in this message
   * @param bool $DisableNotification Sends the message silently. Users will receive a notification with no sound.
   * @param bool $Protect Protects the contents of the sent message from forwarding and saving
   * @param int $RepliedMsg If the message is a reply, ID of the original message
   * @param bool $SendWithoutRepliedMsg Pass True, if the message should be sent even if the specified replied-to message is not found
   * @param array TblMarkup Additional interface options. A object for an inline keyboard, custom reply keyboard, instructions to remove reply keyboard or to force a reply from the user.
   * @return TgMessage|null On success, the sent Message is returned.
   * @link https://core.telegram.org/bots/api#sendmessage
   */
  public function SendText(
    int $Chat,
    string $Text,
    TgParseMode $ParseMode = TgParseMode::Html,
    array $Entities = null,
    bool $DisablePreview = false,
    bool $DisableNotification = false,
    bool $Protect = false,
    int $RepliedMsg = null,
    bool $SendWithoutRepliedMsg = false,
    TblMarkup $Markup = null
  ):TgMessage|null{
    $param['chat_id'] = $Chat;
    $param['text'] = $Text;
    $param['parse_mode'] = $ParseMode->value;
    if($Entities !== null):
      $param['entities'] = TblEntities::ToJson($Entities);
    endif;
    if($DisablePreview):
      $param['disable_web_page_preview'] = true;
    endif;
    if($DisableNotification):
      $param['disable_notification'] = true;
    endif;
    if($Protect):
      $param['protect_content'] = true;
    endif;
    if($RepliedMsg !== null):
      $param['reply_to_message_id'] = $RepliedMsg;
    endif;
    if($SendWithoutRepliedMsg):
      $param['allow_sending_without_reply'] = true;
    endif;
    if($Markup !== null):
      $param['reply_markup'] = $Markup->Get();
    endif;
    $temp = $this->ServerMethod('sendMessage?' . http_build_query($param));
    if($temp !== null):
      return new TgMessage($temp);
    else:
      return null;
    endif;
  }

  /**
   * Use this method to send photos.
   * @param int $Chat Unique identifier for the target chat
   * @param string $Photo Photo to send. Pass a file_id as String to send a photo that exists on the Telegram servers (recommended), pass an HTTP URL as a String for Telegram to get a photo from the Internet, or upload a new photo using multipart/form-data. The photo must be at most 10 MB in size. The photo's width and height must not exceed 10000 in total. Width and height ratio must be at most 20.
   * There are three ways to send files (photos, stickers, audio, media, etc.):
   * 1) If the file is already stored somewhere on the Telegram servers, you don't need to reupload it: each file object has a file_id field, simply pass this file_id as a parameter instead of uploading. There are no limits for files sent this way.
   * 2) Provide Telegram with an HTTP URL for the file to be sent. Telegram will download and send the file. 5 MB max size for photos and 20 MB max for other types of content.
   * 3) Post the file using multipart/form-data in the usual way that files are uploaded via the browser. 10 MB max size for photos, 50 MB for other files.
   * 
   * Sending by file_id
   * - It is not possible to change the file type when resending by file_id. I.e. a video can't be sent as a photo, a photo can't be sent as a document, etc.
   * - It is not possible to resend thumbnails.
   * - Resending a photo by file_id will send all of its sizes.
   * - file_id is unique for each individual bot and can't be transferred from one bot to another.
   * - file_id uniquely identifies a file, but a file can have different valid file_ids even for the same bot.
   * 
   * Sending by URL
   * - When sending by URL the target file must have the correct MIME type (e.g., audio/mpeg for sendAudio, etc.).
   * - Other configurations may work but we can't guarantee that they will.
   * @param string $Caption Photo caption (may also be used when resending photos by file_id), 0-1024 characters after entities parsing
   * @param TgParseMode $ParseMode Mode for parsing entities in the photo caption. See formatting options for more details.
   * @param array $Entities A list of special entities that appear in the caption, which can be specified instead of parse_mode
   * @param bool $DisableNotification Sends the message silently. Users will receive a notification with no sound.
   * @param bool $Protect Protects the contents of the sent message from forwarding and saving
   * @param int $RepliedMsg If the message is a reply, ID of the original message
   * @param bool $SendWithoutRepliedMsg Pass True, if the message should be sent even if the specified replied-to message is not found
   * @param TblMarkup $Markup Additional interface options. A object for an inline keyboard, custom reply keyboard, instructions to remove reply keyboard or to force a reply from the user.
   * @return TgPhoto|null On success, the sent Message is returned.
   * @link https://core.telegram.org/bots/api#sendphoto
   */
  public function SendPhoto(
    int $Chat,
    string $Photo,
    string $Caption = null,
    TgParseMode $ParseMode = TgParseMode::Html,
    array $Entities = null,
    bool $DisableNotification = false,
    bool $Protect = false,
    int $RepliedMsg = null,
    bool $SendWithoutRepliedMsg = false,
    TblMarkup $Markup = null
  ):TgPhoto|null{
    if($Caption !== null
    and strlen($Caption) > TgLimits::Caption):
      $this->Error = TblError::LimitPhotoCaption;
      return null;
    endif;
    $param['chat_id'] = $Chat;
    if($Caption !== null):
      $param['caption'] = $Caption;
      $param['parse_mode'] = $ParseMode->value;
    endif;
    if($Entities !== null):
      $param['caption_entities'] = TblEntities::ToJson($Entities);
    endif;
    if($DisableNotification):
      $param['disable_notification'] = 'true';
    endif;
    if($Protect):
      $param['protect_content'] = 'true';
    endif;
    if($RepliedMsg !== null):
      $param['reply_to_message_id'] = $RepliedMsg;
    endif;
    if($SendWithoutRepliedMsg):
      $param['allow_sending_without_reply'] = 'true';
    endif;
    if($Markup !== null):
      $param['reply_markup'] = $Markup->Get();
    endif;
    if(is_file($Photo)):
      $url = $this->BotData->UrlFiles . '/sendPhoto?' . http_build_query($param);
      $curl = curl_init($url);
      curl_setopt($curl, CURLOPT_CAINFO, __DIR__ . '/cacert.pem');
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($curl, CURLOPT_POST, true);
      curl_setopt($curl, CURLOPT_POSTFIELDS, [
        'photo' => new CurlFile($Photo)
      ]);
      curl_setopt($curl, CURLOPT_INFILESIZE, filesize($Photo));
      $temp = curl_exec($curl);
      if($temp === false):
        $this->DebugLog(
          TblLog::Error,
          'cURL error #' . curl_errno($curl) . ' ' . curl_error($curl)
        );
        $this->Error = TblError::Curl;
        return null;
      endif;
      $temp = json_decode($temp, true);
      if(($this->BotData->Debug & TblDebug::Send) === TblDebug::Send):
        $this->DebugLog(TblLog::Send, $url . http_build_query($param));
        $this->DebugLog(TblLog::Send, json_encode($temp, JSON_PRETTY_PRINT));
      endif;
      if($temp['ok'] === false):
        $this->Error = TblError::Custom;
        $this->ErrorStr = $temp['description'];
        return null;
      else:
        return new TgPhoto($temp);
      endif;
    else:
      $param['photo'] = $Photo;
      $temp = $this->ServerMethod('sendPhoto?' . http_build_query($param));
      if($temp === null):
        return null;
      else:
        return new TgPhoto($temp);
      endif;
    endif;
  }

  /**
   * Use this method to edit text and game messages.
   * @param int $Chat Required if inline_message_id is not specified. Unique identifier for the target chat
   * @param int $Id Required if inline_message_id is not specified. Identifier of the message to edit
   * @param string $Text New text of the message, 1-4096 characters after entities parsing
   * @param string $InlineId Required if chat_id and message_id are not specified. Identifier of the inline message
   * @param TgParseMode $ParseMode Mode for parsing entities in the message text.
   * @param array $Entities A list of special entities that appear in message text, which can be specified instead of parse_mode
   * @param bool $DisablePreview Disables link previews for links in this message
   * @param TblMarkup $Markup A object for an inline keyboard.
   * @return TgMessage|bool|null On success, if the edited message is not an inline message, the edited Message is returned, otherwise True is returned.
   * @link https://core.telegram.org/bots/api#editmessagetext
   */
  public function EditText(
    int $Chat = null,
    int $Id = null,
    string $Text,
    string $InlineId = null,
    TgParseMode $ParseMode = TgParseMode::Html,
    array $Entities = null,
    bool $DisablePreview = false,
    TblMarkup $Markup = null
  ):TgMessage|bool|null{
    if($Chat !== null):
      $param['chat_id'] = $Chat;
    endif;
    if($Id !== null):
      $param['message_id'] = $Id;
    endif;
    $param['text'] = $Text;
    if($InlineId !== null):
      $param['inline_message_id'] = $InlineId;
    endif;
    $param['parse_mode'] = $ParseMode->value;
    if($Entities !== null):
      $param['entities'] = TblEntities::ToJson($Entities);
    endif;
    if($DisablePreview):
      $param['disable_web_page_preview'] = 'true';
    endif;
    if($Markup !== null):
      $param['reply_markup'] = $Markup->Get();
    endif;
    $return = $this->ServerMethod('editMessageText?' . http_build_query($param));
    if($return === null
    or $return === true):
      return $return;
    else:
      return new TgText($return);
    endif;
  }

  /**
   * Use this method to edit only the reply markup of messages.
   * @param int $Chat Required if inline_message_id is not specified. Unique identifier for the target chat.
   * @param int $Id Required if inline_message_id is not specified. Identifier of the message to edit
   * @param string $IdInline Required if chat_id and message_id are not specified. Identifier of the inline message
   * @param TblMarkup $Markup A object for an inline keyboard.
   * @return TgMessage|bool On success, if the edited message is not an inline message, the edited Message is returned, otherwise True is returned.
   * @link https://core.telegram.org/bots/api#editmessagereplymarkup
   */
  public function EditMarkup(
    int $Chat = null,
    int $Id = null,
    string $IdInline = null,
    TblMarkup $Markup = null
  ):TgText|bool{
    $param['chat_id'] = $Chat;
    $param['message_id'] = $Id;
    $param['inline_message_id'] = $IdInline;
    if($Markup !== null):
      $param['reply_markup'] = $Markup->Get();
    endif;
    $return = $this->ServerMethod('editMessageReplyMarkup?' . http_build_query($param));
    if($return === null
    or $return === true):
      return $return;
    else:
      return new TgText($return);
    endif;
  }

  /**
   * Use this method to get basic info about a file and prepare it for downloading. For the moment, bots can download files of up to 20MB in size. It is guaranteed that the link will be valid for at least 1 hour. When the link expires, a new one can be requested by calling getFile again.
   * Note: This function may not preserve the original file name and MIME type. You should save the file's MIME type and name (if available) when the File object is received.
   * @param string $Id File identifier to get info about
   * @return TgFile|null On success, a File object is returned
   * @link https://core.telegram.org/bots/api#getfile
   */
  public function FileInfo(string $Id):TgFile|null{
    $return = $this->ServerMethod('getFile?file_id=' . $Id);
    if($return === null):
      return null;
    endif;
    return new TgFile($return);
  }

  /**
   * @param string $Id The file Id or IdUnique
   * @param string $Dir Destination directory
   * @return bool|null
   */
  public function FileDownload(string $Id, string $Dir):bool|null{
    $info = $this->FileInfo($Id);
    if($info === null):
      return null;
    endif;
    $file = $this->BotData->UrlFiles . '/' . $info->Path;
    $file = file_get_contents($file);
    file_put_contents($Dir . '/' . basename($info->Path), $file);
    return true;
  }

  /**
   * Use this method to send answers to callback queries sent from inline keyboards. The answer will be displayed to the user as a notification at the top of the chat screen or as an alert.
   * Alternatively, the user can be redirected to the specified Game URL. For this option to work, you must first create a game for your bot via @Botfather and accept the terms. Otherwise, you may use links like t.me/your_bot?start=XXXX that open your bot with a parameter.
   * @param string $Id Unique identifier for the query to be answered
   * @param string $Text Text of the notification. If not specified, nothing will be shown to the user, 0-200 characters
   * @param bool $Alert If True, an alert will be shown by the client instead of a notification at the top of the chat screen. Defaults to false.
   * @param string $Url URL that will be opened by the user's client. If you have created a Game and accepted the conditions via @Botfather, specify the URL that opens your game — note that this will only work if the query comes from a callback_game button. Otherwise, you may use links like t.me/your_bot?start=XXXX that open your bot with a parameter.
   * @param int $Cache The maximum amount of time in seconds that the result of the callback query may be cached client-side. Telegram apps will support caching starting in version 3.14. Defaults to 0.
   * @return bool|null On success, True is returned.
   * @link https://core.telegram.org/bots/api#answercallbackquery
   */
  public function CallbackAnswer(
    string $Id,
    string $Text = null,
    bool $Alert = false,
    string $Url = null,
    int $Cache = null
  ):bool|null{
    $param['callback_query_id'] = $Id;
    if($Text !== null):
      $param['text'] = $Text;
    endif;
    if($Alert):
      $param['show_alert'] = 'true';
    endif;
    if($Url !== null):
      $param['url'] = $Url;
    endif;
    if($Cache !== null):
      $param['cache_time'] = $Cache;
    endif;
    return $this->ServerMethod('answerCallbackQuery?' . http_build_query($param));
  }

  /**
   * Use this method to get a list of profile pictures for a user.
   * @param int $User Unique identifier of the target user
   * @param int $Offset Sequential number of the first photo to be returned. By default, all photos are returned.
   * @param int $Limit Limits the number of photos to be retrieved. Values between 1-100 are accepted. Defaults to 100.
   * @return mixed Returns a UserProfilePhotos object.
   * @link https://core.telegram.org/bots/api#getuserprofilephotos
   */
  public function AvatarGet(
    int $User,
    int $Offset = null,
    int $Limit = 100
  ):TgProfilePhoto|null{
    $param['user_id'] = $User;
    if($Offset !== null):
      $param['offset'] = $Offset;
    endif;
    if($Limit > 0 and $Limit < 100):
      $param['limit'] = $Limit;
    endif;
    $return = $this->ServerMethod('getUserProfilePhotos?' . http_build_query($param));
    if($return === null):
      return null;
    else:
      return new TgProfilePhoto($return);
    endif;
  }

  /**
   * Use this method to get the current value of the bot's menu button in a private chat, or the default menu button.
   * @param int $User Unique identifier for the target private chat. If not specified, default bot's menu button will be returned
   * @return TgMenuButton|null Returns TgMenuButton on success.
   * @link https://core.telegram.org/bots/api#getchatmenubutton
   */
  public function MenuButtonGet(int $User = null):TgMenuButton|null{
    if($User === null):
      $param = '';
    else:
      $param = '?chat_id=' . $User;
    endif;
    $return = $this->ServerMethod('getChatMenuButton' . $param);
    return TgMenuButton::tryFrom($return['type'] ?? 0);
  }

  /**
   * Use this method to change the bot's menu button in a private chat, or the default menu button.
   * @param TgMenuButton $Type A type for the new bot's menu button. Defaults to TgMenuButton::Default
   * @param int $User Unique identifier for the target private chat. If not specified, default bot's menu button will be changed
   * @param string $Text Text on the button
   * @param string $Url URL of the Web App that will be launched when the user presses the button. The Web App will be able to send an arbitrary message on behalf of the user using the method answerWebAppQuery. An HTTPS URL of a Web App to be opened with additional data as specified in Initializing Web Apps
   * @return bool|null Returns True on success.
   * @link https://core.telegram.org/bots/api#setchatmenubutton
   */
  public function MenuButtonSet(
    TgMenuButton $Type = null,
    int $User = null,
    string $Text = null,
    string $Url = null
  ):bool|null{
    if($User !== null):
      $param['chat_id'] = $User;
    endif;
    if($Type === TgMenuButton::WebApp):
      $button['text'] = $Text;
      $button['web_app'] = ['url' => $Url];
    endif;
    if($Type !== null):
      $button['type'] = $Type->value;
      $param['menu_button'] = json_encode($button);
    endif;
    if(isset($param)):
      $param = '?' . http_build_query($param);
    else:
      $param = '';
    endif;
    return $this->ServerMethod('setChatMenuButton' . $param);
  }
}