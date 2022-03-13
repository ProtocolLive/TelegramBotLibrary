<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.03.13.01

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
    if(isset($update['message']['document'])):
      return new TgDocument($update['message']);
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
   * Use this method to restrict a user in a supergroup. The bot must be an administrator in the supergroup for this to work and must have the appropriate administrator rights. Pass True for all permissions to lift restrictions from a user.
   * @param int $Chat Unique identifier for the target
   * @param int $User Unique identifier of the target user
   * @param TgMemberPerm $Perms A object for new user permissions
   * @param int $Period Date when restrictions will be lifted for the user, unix time. If user is restricted for more than 366 days or less than 30 seconds from the current time, they are considered to be restricted forever
   * @return bool|null Returns True on success.
   * @link https://core.telegram.org/bots/api#restrictchatmember
   */
  public function ChatMemberPerm(
    int $Chat,
    int $User,
    TgMemberPerm $Perms,
    int $Period = null
  ):bool|null{
    $param['chat_id'] = $Chat;
    $param['user_id'] = $User;
    foreach(TgMemberPerm::Array as $class => $json):
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
   * @param TgAdminPerm $Perms
   * @param bool $Anonymous If the administrator's presence in the chat is hidden
   * @return bool|null Returns True on success.
   * @link https://core.telegram.org/bots/api#promotechatmember
   */
  public function ChatAdminPerm(
    int $Chat,
    int $User,
    TgAdminPerm $Perms,
    bool $Anonymous = false
  ):bool|null{
    $param['chat_id'] = $Chat;
    $param['user_id'] = $User;
    foreach(TgAdminPerm::Array as $class => $json):
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
    return $this->ServerMethod('getMyCommands' . $temp);
  }

  /**
   * Use this method to change the list of the bot's commands. See https://core.telegram.org/bots#commands for more details about bot commands.
   * @param array $Commands A JSON-serialized list of bot commands to be set as the list of the bot's commands. At most 100 commands can be specified.
   * @param TgCmdScope $Scope A JSON-serialized object, describing scope of users for which the commands are relevant. Defaults to TgCmdScope::Default
   * @param string $Language A two-letter ISO 639-1 language code. If empty, commands will be applied to all users from the given scope, for whose language there are no dedicated commands
   * @return bool|null Returns True on success.
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
   * Use this method to delete the list of the bot's commands for the given scope and user language. After deletion, higher level commands will be shown to affected users.
   * @param TgCmdScope $Scope A JSON-serialized object, describing scope of users for which the commands are relevant. Defaults to BotCommandScopeDefault.
   * @param string $Language A two-letter ISO 639-1 language code. If empty, commands will be applied to all users from the given scope, for whose language there are no dedicated commands
   * @return bool|null Returns True on success.
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
   * @return TgMessage|null On success, the sent Message is returned.
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
  ):TgMessage|null{
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
        return new TgMessage($temp);
      endif;
    else:
      $param['photo'] = $Photo;
      $temp = $this->ServerMethod('sendPhoto?' . http_build_query($param));
      if($temp === null):
        return null;
      else:
        return new TgMessage($temp);
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
   * @link https://core.telegram.org/bots/api#editmessagetext
   * @return TgMessage|bool|null On success, if the edited message is not an inline message, the edited Message is returned, otherwise True is returned.
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
    $temp = $this->ServerMethod('editMessageText?' . http_build_query($param));
    if(get_class($temp) === 'TgMessage'):
      return new TgMessage($temp);
    else:
      return $temp;
    endif;
  }
}