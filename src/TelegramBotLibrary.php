<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.11.05.04

namespace ProtocolLive\TelegramBotLibrary;
use ProtocolLive\TelegramBotLibrary\TblObjects\TblCmd;
use ProtocolLive\TelegramBotLibrary\TblObjects\TblCmdEdited;
use ProtocolLive\TelegramBotLibrary\TblObjects\TblCommands;
use ProtocolLive\TelegramBotLibrary\TblObjects\TblData;
use ProtocolLive\TelegramBotLibrary\TblObjects\TblDefaultPerms;
use ProtocolLive\TelegramBotLibrary\TblObjects\TblEntities;
use ProtocolLive\TelegramBotLibrary\TblObjects\TblError;
use ProtocolLive\TelegramBotLibrary\TblObjects\TblException;
use ProtocolLive\TelegramBotLibrary\TblObjects\TblInvoicePrices;
use ProtocolLive\TelegramBotLibrary\TblObjects\TblInvoiceShippingOptions;
use ProtocolLive\TelegramBotLibrary\TblObjects\TblLog;
use ProtocolLive\TelegramBotLibrary\TblObjects\TblMarkup;
use ProtocolLive\TelegramBotLibrary\TblTraits\TblForumTrait;
use ProtocolLive\TelegramBotLibrary\TblTraits\TblPhotoTrait;
use ProtocolLive\TelegramBotLibrary\TblTraits\TblTextTrait;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgCallback;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgChat;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgChatAction;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgChatAutoDel;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgChatMigrateFrom;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgChatMigrateTo;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgChatRequest;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgChatTitle;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgCmdScope;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgDocument;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgDocumentEdited;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgEntityType;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgFile;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgForumClosed;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgForumCreated;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgForumReopened;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgGroupStatus;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgGroupStatusMy;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgInlineQuery;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgInlineQueryFeedback;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgInvoice;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgInvoiceCheckout;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgInvoiceCurrencies;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgInvoiceDone;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgInvoiceShipping;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgLocation;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgLocationEdited;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgMember;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgMemberLeft;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgMemberNew;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgMenuButton;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgMessage;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgMethods;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgParseMode;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgPassport;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgPermAdmin;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgPermMember;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgPhoto;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgPhotoEdited;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgPoll;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgProfilePhoto;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgText;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgTextEdited;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgUser;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgVideo;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgVoice;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgWebappData;

class TelegramBotLibrary extends TblBasics{
  use TblForumTrait;
  use TblPhotoTrait;
  use TblTextTrait;

  /**
   * @throws TblException
   */
  public function __construct(TblData $BotData){
    if(extension_loaded('openssl') === false):
      throw new TblException(TblError::ExtensionOpenssl, 'OpenSSL extension not loaded');
    elseif(extension_loaded('curl') === false):
      throw new TblException(TblError::ExtensionCurl, 'cURL extension not loaded');
    endif;
    $this->BotData = $BotData;
    $_SERVER['HTTP_USER_AGENT'] ??= 'Protocol TelegramBotLibrary';
  }

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

  /**
   * Use this method to get a list of profile pictures for a user.
   * @param int $User Unique identifier of the target user
   * @param int $Offset Sequential number of the first photo to be returned. By default, all photos are returned.
   * @param int $Limit Limits the number of photos to be retrieved. Values between 1-100 are accepted. Defaults to 100.
   * @return TgProfilePhoto
   * @throws TblException
   * @link https://core.telegram.org/bots/api#getuserprofilephotos
   */
  public function AvatarGet(
    int $User,
    int $Offset = null,
    int $Limit = 100
  ):TgProfilePhoto{
    $param['user_id'] = $User;
    if($Offset !== null):
      $param['offset'] = $Offset;
    endif;
    if($Limit > 0 and $Limit < 100):
      $param['limit'] = $Limit;
    endif;
    $return = $this->ServerMethod(TgMethods::UserPhotos, $param);
    return new TgProfilePhoto($return);
  }

  /**
   * Use this method to send answers to callback queries sent from inline keyboards. The answer will be displayed to the user as a notification at the top of the chat screen or as an alert.
   * Alternatively, the user can be redirected to the specified Game URL. For this option to work, you must first create a game for your bot via @BotFather and accept the terms. Otherwise, you may use links like t.me/your_bot?start=XXXX that open your bot with a parameter.
   * @param string $Id Unique identifier for the query to be answered
   * @param string $Text Text of the notification. If not specified, nothing will be shown to the user, 0-200 characters
   * @param bool $Alert If True, an alert will be shown by the client instead of a notification at the top of the chat screen. Defaults to false.
   * @param string $Url URL that will be opened by the user's client. If you have created a Game and accepted the conditions via @BotFather, specify the URL that opens your game — note that this will only work if the query comes from a callback_game button. Otherwise, you may use links like t.me/your_bot?start=XXXX that open your bot with a parameter.
   * @param int $Cache The maximum amount of time in seconds that the result of the callback query may be cached client-side. Telegram apps will support caching starting in version 3.14. Defaults to 0.
   * @return bool On success, True is returned.
   * @throws TblException
   * @link https://core.telegram.org/bots/api#answercallbackquery
   */
  public function CallbackAnswer(
    string $Id,
    string $Text = null,
    bool $Alert = false,
    string $Url = null,
    int $Cache = null
  ):bool{
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
    return $this->ServerMethod(TgMethods::CallbackAnswer, $param);
  }

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

  /**
   * Use this method to get information about custom emoji stickers by their identifiers.
   * @param string[] List of custom emoji identifiers. At most 200 custom emoji identifiers can be specified.
   * @return array Returns an Array of Sticker objects.
   * @throws TblException
   * @link https://core.telegram.org/bots/api#getcustomemojistickers
   */
  public function CustomEmojiGet(
    array $Ids
  ):array{
    $param['custom_emoji_ids'] = json_encode($Ids);
    return $this->ServerMethod(TgMethods::CustomEmojiGet, $param);
  }

  /**
   * Use this method to send general files. Bots can currently send files of any type of up to 50 MB in size, this limit may be changed in the future.
   * @param int $Chat Unique identifier for the target chat
   * @param string $File File to send. Pass a file_id as String to send a file that exists on the Telegram servers (recommended), pass an HTTP URL as a String for Telegram to get a file from the Internet, or upload a new one using multipart/form-data.
   * @param string $Thumb Thumbnail of the file sent; can be ignored if thumbnail generation for the file is supported server-side. The thumbnail should be in JPEG format and less than 200 kB in size. A thumbnail's width and height should not exceed 320. Ignored if the file is not uploaded using multipart/form-data. Thumbnails can't be reused and can be only uploaded as a new file
   * @param string $Caption Document caption (may also be used when resending documents by file_id), 0-1024 characters after entities parsing
   * @param TgParseMode $ParseMode Mode for parsing entities in the document caption. See formatting options for more details.
   * @param TblEntities $Entities A JSON-serialized list of special entities that appear in the caption, which can be specified instead of parse_mode
   * @param bool $DisableDetection Disables automatic server-side content type detection for files uploaded using multipart/form-data
   * @param bool $DisableNotification Sends the message silently. Users will receive a notification with no sound.
   * @param bool $Protect Protects the contents of the sent message from forwarding and saving
   * @param int $RepliedMsg If the message is a reply, ID of the original message
   * @param bool $SendWithoutRepliedMsg Pass True, if the message should be sent even if the specified replied-to message is not found
   * @param TblMarkup $Markup Additional interface options. A object for an inline keyboard, custom reply keyboard, instructions to remove reply keyboard or to force a reply from the user.
   * @return TgDocument On success, the sent Message is returned.
   * @link https://core.telegram.org/bots/api#senddocument
   */
  public function DocumentSend(
    int $Chat,
    string $File,
    string $Thumb = null,
    string $Caption = null,
    TgParseMode $ParseMode = TgParseMode::Html,
    TblEntities $Entities = null,
    bool $DisableDetection = false,
    bool $DisableNotification = false,
    bool $Protect = false,
    int $RepliedMsg = null,
    bool $SendWithoutRepliedMsg = false,
    TblMarkup $Markup = null
  ):TgDocument{
    $param['chat_id'] = $Chat;
    if(is_file($File)):
      $param['document'] = new \CurlFile($File);
    else:
      $param['document'] = $File;
    endif;
    if($Thumb !== null):
      if(is_file($Thumb)):
        $param['thumb'] = new \CurlFile($File);
      else:
        $param['thumb'] = $Thumb;
      endif;
    endif;
    if($Caption !== null):
      $param['caption'] = $Caption;
      $param['parse_mode'] = $ParseMode->value;
    endif;
    if($Entities !== null):
      $param['caption_entities'] = json_encode($Entities);
    endif;
    if($DisableDetection):
      $param['disable_content_type_detection'] = 'true';
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
      $param['reply_markup'] = $Markup->ToJson();
    endif;
    $return = $this->ServerMethod(TgMethods::DocumentSend, $param);
    return new TgDocument($return);
  }

  private function DetectReturn(array $Data):object{
    if(isset($Data['channel_post']['entities'][0])
    and $Data['channel_post']['entities'][0]['type'] === TgEntityType::Command->value
    and $Data['channel_post']['entities'][0]['offset'] === 0):
      return new TblCmd($Data['channel_post']);

    elseif(isset($Data['edited_message']['entities'][0])
    and $Data['edited_message']['entities'][0]['type'] === TgEntityType::Command->value
    and $Data['edited_message']['entities'][0]['offset'] === 0):
      return new TblCmdEdited($Data['edited_message']);

    elseif(isset($Data['message']['entities'][0])
    and $Data['message']['entities'][0]['type'] === TgEntityType::Command->value
    and $Data['message']['entities'][0]['offset'] === 0):
      return new TblCmd($Data['message']);

    elseif(isset($Data['callback_query'])):
      return new TgCallback($Data['callback_query']);
    elseif(isset($Data['chat_join_request'])):
      return new TgChatRequest($Data['chat_join_request']);
    elseif(isset($Data['chat_member'])):
      return new TgGroupStatus($Data['chat_member']);
    elseif(isset($Data['chosen_inline_result'])):
      return new TgInlineQueryFeedback($Data['chosen_inline_result']);
    elseif(isset($Data['edited_message']['document'])):
      return new TgDocumentEdited($Data['edited_message']);
    elseif(isset($Data['edited_message']['location'])):
      return new TgLocationEdited($Data['edited_message']);
    elseif(isset($Data['edited_message']['photo'])):
      return new TgPhotoEdited($Data['edited_message']);
    elseif(isset($Data['edited_message']['text'])):
      return new TgTextEdited($Data['edited_message']);
    elseif(isset($Data['invoice'])): //Suspect unnecessary
      return new TgInvoice($Data['invoice']);
    elseif(isset($Data['inline_query'])):
      return new TgInlineQuery($Data['inline_query']);
    elseif(isset($Data['message']['document'])):
      return new TgDocument($Data['message']);
    elseif(isset($Data['message']['forum_topic_closed'])):
      return new TgForumClosed($Data['message']);
    elseif(isset($Data['message']['forum_topic_created'])):
      return new TgForumCreated($Data['message']);
    elseif(isset($Data['message']['forum_topic_reopened'])):
      return new TgForumReopened($Data['message']);
    elseif(isset($Data['message']['invoice'])):
      return new TgInvoice($Data['message']);
    elseif(isset($Data['message']['left_chat_member'])):
      return new TgMemberLeft($Data['message']);
    elseif(isset($Data['message']['location'])):
      return new TgLocation($Data['message']);
    elseif(isset($Data['message']['message_auto_delete_timer_changed'])):
      return new TgChatAutoDel($Data['message']);
    elseif(isset($Data['message']['migrate_from_chat_id'])):
      return new TgChatMigrateFrom($Data['message']);
    elseif(isset($Data['message']['migrate_to_chat_id'])):
      return new TgChatMigrateTo($Data['message']);
    elseif(isset($Data['message']['new_chat_member'])):
      return new TgMemberNew($Data['message']);
    elseif(isset($Data['message']['new_chat_title'])):
      return new TgChatTitle($Data['message']);
    elseif(isset($Data['message']['passport_data'])):
      return new TgPassport($Data['message']);
    elseif(isset($Data['message']['photo'])):
      return new TgPhoto($Data['message']);
    elseif(isset($Data['message']['poll'])):
      return new TgPoll($Data['message']);
    elseif(isset($Data['message']['successful_payment'])):
      return new TgInvoiceDone($Data['message']);
    elseif(isset($Data['message']['text'])):
      return new TgText($Data['message']);

    elseif(isset($Data['message']['video'])):
      return new TgVideo($Data['message']);
    elseif(isset($Data['message']['voice'])):
      return new TgVoice($Data['message']);
    elseif(isset($Data['message']['web_app_data'])):
      return new TgWebappData($Data['message']);
    elseif(isset($Data['my_chat_member'])):
      return new TgGroupStatusMy($Data['my_chat_member']);
    elseif(isset($Data['poll'])):
      return new TgPoll($Data['poll']);
    elseif(isset($Data['pre_checkout_query'])):
      return new TgInvoiceCheckout($Data['pre_checkout_query']);
    elseif(isset($Data['shipping_query'])):
      return new TgInvoiceShipping($Data['shipping_query']);
    endif;
  }

  /**
   * @param string $Id The file Id or IdUnique
   * @return string
   * @throws TblException
   */
  public function FileGet(
    string $Id,
  ):string{
    $info = $this->FileInfo($Id);
    return $this->BotData->UrlFiles . '/' . $info->Path;
  }

  /**
   * Use this method to get basic info about a file and prepare it for downloading. For the moment, bots can download files of up to 20MB in size. It is guaranteed that the link will be valid for at least 1 hour. When the link expires, a new one can be requested by calling getFile again.
   * Note: This function may not preserve the original file name and MIME type. You should save the file's MIME type and name (if available) when the File object is received.
   * @param string $Id File identifier to get info about
   * @return TgFile On success, a File object is returned
   * @throws TblException
   * @link https://core.telegram.org/bots/api#getfile
   */
  public function FileInfo(string $Id):TgFile{
    $param['file_id'] = $Id;
    $return = $this->ServerMethod(TgMethods::FileGet, $param);
    return new TgFile($return);
  }

  /**
   * Use this method to send answers to an inline query. No more than 50 results per query are allowed.
   * @param string $Id Unique identifier for the answered query
   * @param array $Results An array of results for the inline query
   * @param int $Cache The maximum amount of time in seconds that the result of the inline query may be cached on the server. Defaults to 300.
   * @param bool $Personal Pass True, if results may be cached on the server side only for the user that sent the query. By default, results may be returned to any user who sends the same query
   * @param string $NextOffset Pass the offset that a client should send in the next query with the same text to receive more results. Pass an empty string if there are no more results or if you don't support pagination. Offset length can't exceed 64 bytes.
   * @param string $SwitchPm If passed, clients will display a button with specified text that switches the user to a private chat with the bot and sends the bot a start message with the parameter switch_pm_parameter
   * @param string $SwitchPmParam Deep-linking parameter for the /start message sent to the bot when user presses the switch button. 1-64 characters, only A-Z, a-z, 0-9, _ and - are allowed. Example: An inline bot that sends YouTube videos can ask the user to connect the bot to their YouTube account to adapt search results accordingly. To do this, it displays a 'Connect your YouTube account' button above the results, or even before showing any. The user presses the button, switches to a private chat with the bot and, in doing so, passes a start parameter that instructs the bot to return an OAuth link. Once done, the bot can offer a switch_inline button so that the user can easily return to the chat where they wanted to use the bot's inline capabilities.
   * @return bool On success, True is returned
   * @throws TblException
   * @link https://core.telegram.org/bots/api#answerinlinequery
   */
  public function InlineQueryAnswer(
    string $Id,
    array $Results,
    int $Cache = null,
    bool $Personal = false,
    string $NextOffset = null,
    string $SwitchPm = null,
    string $SwitchPmParam = null
  ){
    $param['inline_query_id'] = $Id;
    foreach($Results as $result):
      $param['results'][] = $result->ToArray();
    endforeach;
    $param['results'] = json_encode($param['results'], JSON_UNESCAPED_SLASHES);
    if($Cache !== null):
      $param['cache_time'] = $Cache;
    endif;
    if($Personal):
      $param['is_personal'] = 'true';
    endif;
    if($NextOffset !== null):
      $param['next_offset'] = $NextOffset;
    endif;
    if($SwitchPm !== null):
      $param['switch_pm_text'] = $SwitchPm;
    endif;
    if($SwitchPmParam !== null):
      $param['switch_pm_parameter'] = $SwitchPmParam;
    endif;
    return $this->ServerMethod(TgMethods::InlineQueryAnswer, $param);
  }

  /**
   * Once the user has confirmed their payment and shipping details, the Bot API sends the final confirmation in the form of an Update with the field pre_checkout_query. Use this method to respond to such pre-checkout queries. Note: The Bot API must receive an answer within 10 seconds after the pre-checkout query was sent.
   * @param string $Id Unique identifier for the query to be answered
   * @param bool $Confirm Specify True if everything is alright (goods are available, etc.) and the bot is ready to proceed with the order. Use False if there are any problems.
   * @param string $ErrorMsg Required if $Confirm is False. Error message in human readable form that explains the reason for failure to proceed with the checkout (e.g. "Sorry, somebody just bought the last of our amazing black T-shirts while you were busy filling out your payment details. Please choose a different color or garment!"). Telegram will display this message to the user.
   * @return bool On success, True is returned.
   * @throws TblException
   * @link https://core.telegram.org/bots/api#answerprecheckoutquery
   */
  public function InvoiceCheckoutSend(
    string $Id,
    bool $Confirm,
    string $ErrorMsg = null
  ):bool{
    $param['pre_checkout_query_id'] = $Id;
    $param['ok'] = $Confirm;
    if($Confirm === false):
      $param['error_message'] = $ErrorMsg;
    endif;
    return $this->ServerMethod(TgMethods::InvoiceCheckoutSend, $param);
  }

  /**
   * Use this method to create a link for an invoice.
   * @param string $Title Product name, 1-32 characters
   * @param string $Description Product description, 1-255 characters
   * @param string $Payload Bot-defined invoice payload, 1-128 bytes. This will not be displayed to the user, use for your internal processes.
   * @param string $Token Payments provider token, obtained via BotFather
   * @param TgInvoiceCurrencies $Currency Three-letter ISO 4217 currency code
   * @param TblInvoicePrices $Prices Price breakdown, a list of components (e.g. product price, tax, discount, delivery cost, delivery tax, bonus, etc.)
   * @param int $TipMax The maximum accepted amount for tips in the smallest units of the currency (integer, not float/double). For example, for a maximum tip of US$ 1.45 pass max_tip_amount = 145. See the exp parameter in currencies.json, it shows the number of digits past the decimal point for each currency (2 for the majority of currencies). Defaults to 0
   * @param array $TipSuggested A array of suggested amounts of tips in the smallest units of the currency (integer, not float/double). At most 4 suggested tip amounts can be specified. The suggested tip amounts must be positive, passed in a strictly increased order and must not exceed max_tip_amount.
   * @param string $ProviderData A JSON-serialized data about the invoice, which will be shared with the payment provider. A detailed description of required fields should be provided by the payment provider.
   * @param string $Photo URL of the product photo for the invoice. Can be a photo of the goods or a marketing image for a service. People like it better when they see what they are paying for.
   * @param int $PhotoSize Photo size
   * @param int $PhotoWidth Photo width
   * @param int $PhotoHeight Photo height
   * @param bool $NeedName Pass True, if you require the user's full name to complete the order
   * @param bool $NeedPhone Pass True, if you require the user's phone number to complete the order
   * @param bool $NeedEmail Pass True, if you require the user's email address to complete the order
   * @param bool $NeedAddress Pass True, if you require the user's shipping address to complete the order
   * @param bool $ProviderPhone Pass True, if user's phone number should be sent to provider
   * @param bool $ProviderEmail Pass True, if user's email address should be sent to provider
   * @param bool $PriceWithShipping Pass True, if the final price depends on the shipping method
   * @return string Returns the created invoice link as String on success.
   * @throws TblException
   * @link https://core.telegram.org/bots/api#createinvoicelink
   */
  public function InvoiceLink(
    string $Title,
    string $Description,
    string $Payload,
    string $Token,
    TgInvoiceCurrencies $Currency,
    TblInvoicePrices $Prices,
    int $TipMax = null,
    array $TipSuggested = null,
    string $ProviderData = null,
    string $Photo = null,
    int $PhotoSize = null,
    int $PhotoWidth = null,
    int $PhotoHeight = null,
    bool $NeedName = false,
    bool $NeedPhone = false,
    bool $NeedEmail = false,
    bool $NeedAddress = false,
    bool $ProviderPhone = false,
    bool $ProviderEmail = false,
    bool $PriceWithShipping = false
  ):string{
    if($Prices->Count() === 0):
      throw new TblException(TblError::InvoicePriceEmpty);
    endif;
    $param['title'] = $Title;
    $param['description'] = $Description;
    $param['payload'] = $Payload;
    $param['provider_token'] = $Token;
    $param['currency'] = $Currency->value;
    $param['prices'] = json_encode($Prices);
    if($TipMax !== null):
      $param['max_tip_amount'] = $TipMax;
    endif;
    if($TipSuggested !== null):
      $param['suggested_tip_amounts'] = $TipSuggested;
    endif;
    if($ProviderData !== null):
      $param['provider_data'] = $ProviderData;
    endif;
    if($Photo !== null):
      $param['photo_url'] = $Photo;
    endif;
    if($PhotoSize !== null):
      $param['photo_size'] = $PhotoSize;
    endif;
    if($PhotoWidth !== null):
      $param['photo_width'] = $PhotoWidth;
    endif;
    if($PhotoHeight !== null):
      $param['photo_height'] = $PhotoHeight;
    endif;
    if($NeedName):
      $param['need_name'] = 'true';
    endif;
    if($NeedPhone):
      $param['need_phone_number'] = 'true';
    endif;
    if($NeedEmail):
      $param['need_email'] = 'true';
    endif;
    if($NeedAddress):
      $param['need_shipping_address'] = 'true';
    endif;
    if($ProviderPhone):
      $param['send_phone_number_to_provider'] = 'true';
    endif;
    if($ProviderEmail):
      $param['send_email_to_provider'] = 'true';
    endif;
    if($PriceWithShipping):
      $param['is_flexible'] = 'true';
    endif;
    return $this->ServerMethod(TgMethods::InvoiceLink, $param);
  }

  /**
   * Use this method to send invoices. On success, the sent Message is returned.
   * @param int $Chat Unique identifier for the target chat
   * @param string $Title Product name, 1-32 characters
   * @param string $Description Product description, 1-255 characters
   * @param string $Payload Bot-defined invoice payload, 1-128 bytes. This will not be displayed to the user, use for your internal processes.
   * @param string $Token Payments provider token, obtained via BotFather
   * @param TgInvoiceCurrencies $Currency Three-letter ISO 4217 currency code
   * @param TblInvoicePrices $Prices Price breakdown, a list of components (e.g. product price, tax, discount, delivery cost, delivery tax, bonus, etc.)
   * @param int $TipMax The maximum accepted amount for tips in the smallest units of the currency (integer, not float/double). For example, for a maximum tip of US$ 1.45 pass max_tip_amount = 145. See the exp parameter in currencies.json, it shows the number of digits past the decimal point for each currency (2 for the majority of currencies). Defaults to 0
   * @param array $TipSuggested A array of suggested amounts of tips in the smallest units of the currency (integer, not float/double). At most 4 suggested tip amounts can be specified. The suggested tip amounts must be positive, passed in a strictly increased order and must not exceed max_tip_amount.
   * @param string $StartParam Unique deep-linking parameter. If left empty, forwarded copies of the sent message will have a Pay button, allowing multiple users to pay directly from the forwarded message, using the same invoice. If non-empty, forwarded copies of the sent message will have a URL button with a deep link to the bot (instead of a Pay button), with the value used as the start parameter
   * @param string $ProviderData A JSON-serialized data about the invoice, which will be shared with the payment provider. A detailed description of required fields should be provided by the payment provider.
   * @param string $Photo URL of the product photo for the invoice. Can be a photo of the goods or a marketing image for a service. People like it better when they see what they are paying for.
   * @param int $PhotoSize Photo size
   * @param int $PhotoWidth Photo width
   * @param int $PhotoHeight Photo height
   * @param bool $NeedName Pass True, if you require the user's full name to complete the order
   * @param bool $NeedPhone Pass True, if you require the user's phone number to complete the order
   * @param bool $NeedEmail Pass True, if you require the user's email address to complete the order
   * @param bool $NeedAddress Pass True, if you require the user's shipping address to complete the order
   * @param bool $ProviderPhone Pass True, if user's phone number should be sent to provider
   * @param bool $ProviderEmail Pass True, if user's email address should be sent to provider
   * @param bool $PriceWithShipping Pass True, if the final price depends on the shipping method
   * @param bool $DisableNotification Sends the message silently. Users will receive a notification with no sound.
   * @param bool $Protect Protects the contents of the sent message from forwarding and saving
   * @param int $RepliedMsg If the message is a reply, ID of the original message
   * @param bool $SendWithoutRepliedMsg Pass True, if the message should be sent even if the specified replied-to message is not found
   * @param TblMarkup $Markup A object for an inline keyboard. If empty, one 'Pay total price' button will be shown. If not empty, the first button must be a Pay button.
   * @return TgMessage
   * @throws TblException
   * @link https://core.telegram.org/bots/api#sendinvoice
   */
  public function InvoiceSend(
    int $Chat,
    string $Title,
    string $Description,
    string $Payload,
    string $Token,
    TgInvoiceCurrencies $Currency,
    TblInvoicePrices $Prices,
    int $TipMax = null,
    array $TipSuggested = null,
    string $StartParam = null,
    string $ProviderData = null,
    string $Photo = null,
    int $PhotoSize = null,
    int $PhotoWidth = null,
    int $PhotoHeight = null,
    bool $NeedName = false,
    bool $NeedPhone = false,
    bool $NeedEmail = false,
    bool $NeedAddress = false,
    bool $ProviderPhone = false,
    bool $ProviderEmail = false,
    bool $PriceWithShipping = false,
    bool $DisableNotification = false,
    bool $Protect = false,
    int $RepliedMsg = null,
    bool $SendWithoutRepliedMsg = false,
    TblMarkup $Markup = null
  ):TgMessage{
    $param['chat_id'] = $Chat;
    $param['title'] = $Title;
    $param['description'] = $Description;
    $param['payload'] = $Payload;
    $param['provider_token'] = $Token;
    $param['currency'] = $Currency->value;
    $param['prices'] = $Prices->ToJson();
    if($TipMax !== null):
      $param['max_tip_amount'] = $TipMax;
    endif;
    if($TipSuggested !== null):
      $param['suggested_tip_amounts'] = $TipSuggested;
    endif;
    if($StartParam !== null):
      $param['start_parameter'] = $StartParam;
    endif;
    if($ProviderData !== null):
      $param['provider_data'] = $ProviderData;
    endif;
    if($Photo !== null):
      $param['photo_url'] = $Photo;
    endif;
    if($PhotoSize !== null):
      $param['photo_size'] = $PhotoSize;
    endif;
    if($PhotoWidth !== null):
      $param['photo_width'] = $PhotoWidth;
    endif;
    if($PhotoHeight !== null):
      $param['photo_height'] = $PhotoHeight;
    endif;
    if($NeedName):
      $param['need_name'] = 'true';
    endif;
    if($NeedPhone):
      $param['need_phone_number'] = 'true';
    endif;
    if($NeedEmail):
      $param['need_email'] = 'true';
    endif;
    if($NeedAddress):
      $param['need_shipping_address'] = 'true';
    endif;
    if($ProviderPhone):
      $param['send_phone_number_to_provider'] = 'true';
    endif;
    if($ProviderEmail):
      $param['send_email_to_provider'] = 'true';
    endif;
    if($PriceWithShipping):
      $param['is_flexible'] = 'true';
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
      $param['reply_markup'] = $Markup->ToJson();
    endif;
    $return = $this->ServerMethod(TgMethods::InvoiceSend, $param);
    return new TgMessage($return);
  }

  /**
   * If you sent an invoice requesting a shipping address and the parameter is_flexible was specified, the Bot API will send an Update with a shipping_query field to the bot. Use this method to reply to shipping queries.
   * @param string $Id Unique identifier for the query to be answered
   * @param bool $Confirm Specify True if delivery to the specified address is possible and False if there are any problems (for example, if delivery to the specified address is not possible)
   * @param TblInvoiceShippingOptions $Options Required if ok is True. A JSON-serialized array of available shipping options.
   * @param string $Error Required if ok is False. Error message in human readable form that explains why it is impossible to complete the order (e.g. "Sorry, delivery to your desired address is unavailable'). Telegram will display this message to the user.
   * @return bool On success, True is returned.
   * @throws TblException
   * @link https://core.telegram.org/bots/api#answershippingquery
   */
  public function InvoiceShippingSend(
    string $Id,
    bool $Confirm,
    TblInvoiceShippingOptions $Options = null,
    string $Error = null
  ):bool{
    $param['shipping_query_id'] = $Id;
    $param['ok'] = $Confirm;
    if($Confirm):
      $param['shipping_options'] = $Options->ToJson();
    else:
      $param['error_message'] = $Error;
    endif;
    return $this->ServerMethod(TgMethods::InvoiceShippingSend, $param);
  }

  /**
   * Use this method to edit only the reply markup of messages.
   * @param int $Chat Required if inline_message_id is not specified. Unique identifier for the target chat.
   * @param int $Id Required if inline_message_id is not specified. Identifier of the message to edit
   * @param string $IdInline Required if chat_id and message_id are not specified. Identifier of the inline message
   * @param TblMarkup $Markup A object for an inline keyboard.
   * @return TgMessage|bool On success, if the edited message is not an inline message, the edited Message is returned, otherwise True is returned.
   * @throws TblException
   * @link https://core.telegram.org/bots/api#editmessagereplymarkup
   */
  public function MarkupEdit(
    int $Chat = null,
    int $Id = null,
    string $IdInline = null,
    TblMarkup $Markup = null
  ):TgText|bool{
    if($Chat !== null):
      $param['chat_id'] = $Chat;
    endif;
    if($Id !== null):
      $param['message_id'] = $Id;
    endif;
    if($IdInline !== null):
      $param['inline_message_id'] = $IdInline;
    endif;
    if($Markup !== null):
      $param['reply_markup'] = $Markup->ToJson();
    endif;
    $return = $this->ServerMethod(TgMethods::MarkupEdit, $param);
    if($return === true):
      return $return;
    else:
      return new TgText($return);
    endif;
  }

  /**
   * Use this method to get the current value of the bot's menu button in a private chat, or the default menu button.
   * @param int $User Unique identifier for the target private chat. If not specified, default bot's menu button will be returned
   * @return TgMenuButton Returns TgMenuButton on success.
   * @throws TblException
   * @link https://core.telegram.org/bots/api#getchatmenubutton
   */
  public function MenuButtonGet(
    int $User = null
  ):TgMenuButton{
    $param = [];
    if($User !== null):
      $param['chat_id='] = $User;
    endif;
    $return = $this->ServerMethod(TgMethods::ChatMenuButtonGet, $param);
    return TgMenuButton::from($return['type']);
  }

  /**
   * Use this method to change the bot's menu button in a private chat, or the default menu button.
   * @param TgMenuButton $Type A type for the new bot's menu button. Defaults to TgMenuButton::Default
   * @param int $User Unique identifier for the target private chat. If not specified, default bot's menu button will be changed
   * @param string $Text Text on the button
   * @param string $Url URL of the Web App that will be launched when the user presses the button. The Web App will be able to send an arbitrary message on behalf of the user using the method answerWebAppQuery. An HTTPS URL of a Web App to be opened with additional data as specified in Initializing Web Apps
   * @return bool Returns True on success.
   * @throws TblException
   * @link https://core.telegram.org/bots/api#setchatmenubutton
   */
  public function MenuButtonSet(
    TgMenuButton $Type = null,
    int $User = null,
    string $Text = null,
    string $Url = null
  ):bool{
    $param = [];
    if($User !== null):
      $param['chat_id'] = $User;
    endif;
    if($Type === TgMenuButton::WebApp):
      $param['menu_button']['text'] = $Text;
      $param['menu_button']['web_app'] = ['url' => $Url];
    endif;
    if($Type !== null):
      $param['menu_button']['type'] = $Type->value;
      $param['menu_button'] = json_encode($param['menu_button']);
    endif;
    return $this->ServerMethod(TgMethods::ChatMenuButtonSet, $param);
  }

  /**
   * Use this method to copy messages of any kind. Service messages and invoice messages can't be copied. The method is analogous to the method forwardMessage, but the copied message doesn't have a link to the original message.
   * @param int $From
   * @param int $Id Message identifier in the chat specified in $From
   * @param int $To Unique identifier for the target chat
   * @param string $Caption New caption for media, 0-1024 characters after entities parsing. If not specified, the original caption is kept
   * @param TblEntities $Entities A list of special entities that appear in the new caption, which can be specified instead of parse_mode
   * @param TgParseMode $ParseMode Mode for parsing entities in the new caption.
   * @param bool $DisableNotification Sends the message silently. Users will receive a notification with no sound.
   * @param bool $Protect Protects the contents of the sent message from forwarding and saving
   * @param int $RepliedMsg If the message is a reply, ID of the original message
   * @param bool $SendWithoutRepliedMsg Pass True, if the message should be sent even if the specified replied-to message is not found
   * @param TblMarkup $Markup Additional interface options. A object for an inline keyboard, custom reply keyboard, instructions to remove reply keyboard or to force a reply from the user.
   * @return int Returns the MessageId of the sent message on success.
   * @throws TblException
   * @link https://core.telegram.org/bots/api#copymessage
   */
  public function MessageCopy(
    int $From,
    int $Id,
    int $To,
    string $Caption = null,
    TblEntities $Entities = null,
    TgParseMode $ParseMode = TgParseMode::Html,
    bool $DisableNotification = false,
    bool $Protect = false,
    int $RepliedMsg = null,
    bool $SendWithoutRepliedMsg = false,
    TblMarkup $Markup = null
  ):int{
    $param['chat_id'] = $To;
    $param['from_chat_id'] = $From;
    $param['message_id'] = $Id;
    if($Caption !== null):
      $param['caption'] = $Caption;
    endif;
    $param['parse_mode'] = $ParseMode->value;
    if($Entities !== null):
      $param['caption_entities'] = json_encode($Entities);
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
      $param['reply_markup'] = $Markup->ToJson();
    endif;
    $return = $this->ServerMethod(TgMethods::MessageCopy, $param);
    return $return['message_id'];
  }

  /**
   * Use this method to forward messages of any kind. Service messages can't be forwarded.
   * @param int $To Unique identifier for the target chat or username of the target channel
   * @param int $From Unique identifier for the chat where the original message was sent
   * @param int $Id Message identifier in the chat specified in from_chat_id
   * @param bool $DisableNotification Sends the message silently. Users will receive a notification with no sound.
   * @param bool $Protect Protects the contents of the forwarded message from forwarding and saving
   * @return object On success, the sent Message is returned.
   * @throws TblException
   * @link https://core.telegram.org/bots/api#forwardmessage
   */
  public function MessageForward(
    int $To,
    int $From,
    int $Id,
    bool $DisableNotification = false,
    bool $Protect = false
  ):object{
    $param['chat_id'] = $To;
    $param['from_chat_id'] = $From;
    $param['message_id'] = $Id;
    if($DisableNotification):
      $param['disable_notification'] = true;
    endif;
    if($Protect):
      $param['protect_content'] = true;
    endif;
    $return = $this->ServerMethod(TgMethods::MessageForward, $param);
    return $this->DetectReturn(['message' => $return]);
  }

  /**
   * Use this method to delete the list of the bot's commands for the given scope and user language. After deletion, higher level commands will be shown to affected users.
   * @param TgCmdScope $Scope A JSON-serialized object, describing scope of users for which the commands are relevant. Defaults to BotCommandScopeDefault.
   * @param string $Language A two-letter ISO 639-1 language code. If empty, commands will be applied to all users from the given scope, for whose language there are no dedicated commands
   * @return bool Returns True on success.
   * @throws TblException
   * @link https://core.telegram.org/bots/api#deletemycommands
   */
  public function MyCmdClear(
    TgCmdScope $Scope = null,
    string $Language = null,
    int $Chat = null,
    int $User = null
  ):bool{
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
    return $this->ServerMethod(TgMethods::CommandsDel, $param);
  }

  /**
   * Use this method to get the current list of the bot's commands for the given scope and user language.
   * @param TgCmdScope $Scope A JSON-serialized object, describing scope of users. Defaults to TgCmdScope::Default.
   * @param string $Language A two-letter ISO 639-1 language code or an empty string
   * @param int $Chat Unique identifier for the target chat. Only for TgCmdScope::Chat, TgCmdScope::GroupsAdmins or TgCmdScope::Member
   * @param int $User Unique identifier of the target user. Only for TgCmdScope::Member
   * @throws TblException
   * @link https://core.telegram.org/bots/api#getmycommands
   */
  public function MyCmdGet(
    TgCmdScope $Scope = null,
    string $Language = null,
    int $Chat = null,
    int $User = null
  ):TblCommands{
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
    $return = $this->ServerMethod(TgMethods::CommandsGet, $param);
    if($return === []):
      return new TblCommands;
    else:
      return new TblCommands($return);
    endif;
  }

  /**
   * Use this method to change the list of the bot's commands.
   * @param TblCommands $Commands A JSON-serialized list of bot commands to be set as the list of the bot's commands. At most 100 commands can be specified.
   * @param TgCmdScope $Scope A JSON-serialized object, describing scope of users for which the commands are relevant. Defaults to TgCmdScope::Default
   * @param string $Language A two-letter ISO 639-1 language code. If empty, commands will be applied to all users from the given scope, for whose language there are no dedicated commands
   * @return bool Returns True on success.
   * @throws TblException
   * @link https://core.telegram.org/bots/api#setmycommands
   */
  public function MyCmdSet(
    TblCommands $Commands,
    TgCmdScope $Scope = null,
    string $Language = null,
    int $Chat = null,
    int $User = null
  ):bool{
    $param['commands'] = $Commands->ToJson();
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
    return $this->ServerMethod(TgMethods::CommandsSet, $param);
  }

  /**
   * A simple method for testing your bot's authentication token. Requires no parameters.
   * @return TgUser Returns basic information about the bot in form of a User object.
   * @throws TblException
   * @link https://core.telegram.org/bots/api#getme
   */
  public function MyGet():TgUser{
    $return = $this->ServerMethod(TgMethods::MyGet);
    return new TgUser($return);
  }

  /**
   * Use this method to get the current default administrator rights of the bot.
   * @param TblDefaultPerms $Type Pass Channels to get default administrator rights of the bot in channels. Otherwise, default administrator rights of the bot for groups and supergroups will be returned.
   * @return mixed Returns TgPermAdmin on success.
   * @throws TblException
   * @link https://core.telegram.org/bots/api#getmydefaultadministratorrights
   */
  public function MyPermDefaultGet(
    TblDefaultPerms $Type = TblDefaultPerms::Groups
  ):TgPermAdmin{
    $param = [];
    if($Type === TblDefaultPerms::Channels):
      $param['for_channels'] = 'true';
    endif;
    $return = $this->ServerMethod(TgMethods::MyDefaultPermAdmGet, $param);
    return new TgPermAdmin($return);
  }

  /**
   * Use this method to change the default administrator rights requested by the bot when it's added as an administrator to groups or channels. These rights will be suggested to users, but they are are free to modify the list before adding the bot.
   * @param TgPermAdmin $Perms An object describing new default administrator rights. If not specified, the default administrator rights will be cleared.
   * @param TblDefaultPerms $Type Pass Channels to change the default administrator rights of the bot in channels. Otherwise, the default administrator rights of the bot for groups and supergroups will be changed.
   * @return bool Returns True on success.
   * @throws TblException
   * @link https://core.telegram.org/bots/api#setmydefaultadministratorrights
   */
  public function MyPermDefaultSet(
    TgPermAdmin $Perms,
    TblDefaultPerms $Type = TblDefaultPerms::Groups
  ):bool{
    foreach(TgPermAdmin::Array as $class => $json):
      $param['rights'][$json] = $Perms->$class;
    endforeach;
    $param['rights'] = json_encode($param['rights']);
    if($Type === TblDefaultPerms::Channels):
      $param['for_channels'] = 'true';
    endif;
    return $this->ServerMethod(TgMethods::MyDefaultPermAdmSet, $param);
  }

  /**
   * @throws TblException
   */
  public function WebhookGet():object{
    if($this->BotData->TokenWebhook !== null
    and filter_input(INPUT_SERVER, 'HTTP_X_TELEGRAM_BOT_API_SECRET_TOKEN') !== $this->BotData->TokenWebhook):
      throw new TblException(TblError::TokenWebhook, 'Wrong webhook token');
    endif;
    $update = file_get_contents('php://input');
    if($update === ''):
      $this->Log(TblLog::Webhook, 'No event found');
      throw new TblException(TblError::NoEvent, 'No event found');
    endif;
    $update = json_decode($update, true);
    $this->Archive($update);
    if($this->BotData->Log & TblLog::Webhook):
      $this->Log(TblLog::Webhook, json_encode($update, JSON_PRETTY_PRINT));
    endif;
    return $this->DetectReturn($update);
  }
}