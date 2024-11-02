<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary;
use CurlFile;
use ProtocolLive\TelegramBotLibrary\TblObjects\{
  TblBasics,
  TblData,
  TblEntities,
  TblError,
  TblException,
  TblLog,
  TblMarkup
};
use ProtocolLive\TelegramBotLibrary\TblTraits\{
  TblAnimationTrait,
  TblAudioTrait,
  TblChatTrait,
  TblEditTrait,
  TblForumTrait,
  TblGameTrait,
  TblInvoiceTrait,
  TblMyTrait,
  TblPhotoTrait,
  TblPollTrait,
  TblStarsTrait,
  TblTextTrait,
  TblVideoTrait
};
use ProtocolLive\TelegramBotLibrary\TgEnums\{
  TgError,
  TgMenuButton,
  TgMethods,
  TgParseMode,
  TgReactionType
};
use ProtocolLive\TelegramBotLibrary\TgInterfaces\TgMessageInterface;
use ProtocolLive\TelegramBotLibrary\TgObjects\{
  TgBusinessConnection,
  TgCallback,
  TgChatBoost,
  TgChatBoostRemoved,
  TgChatRequest,
  TgDocument,
  TgFile,
  TgGameStart,
  TgGroupStatus,
  TgGroupStatusMy,
  TgInlineQuery,
  TgInlineQueryFeedback,
  TgInvoice,
  TgInvoiceCheckout,
  TgInvoiceShipping,
  TgLimits,
  TgMessageDeleted,
  TgPaidMediaPurchased,
  TgPoll,
  TgPollAnswer,
  TgProfilePhoto,
  TgReactionUpdate,
  TgSticker
};
use ProtocolLive\TelegramBotLibrary\TgParams\{
  TgAudioGroup,
  TgDocumentGroup,
  TgInlineQueryResults,
  TgPhotoGroup,
  TgReplyParams,
  TgVideoGroup
};

/**
 * @version 2024.11.01.00
 */
final class TelegramBotLibrary
extends TblBasics{
  use TblAnimationTrait;
  use TblAudioTrait;
  use TblChatTrait;
  use TblEditTrait;
  use TblForumTrait;
  use TblGameTrait;
  use TblInvoiceTrait;
  use TblMyTrait;
  use TblPollTrait;
  use TblPhotoTrait;
  use TblStarsTrait;
  use TblTextTrait;
  use TblVideoTrait;

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
   * Use this method to get information about the connection of the bot with a business account. Returns a BusinessConnection object on success.
   * @param string $Id Unique identifier for the business account
   * @throws TblException
   * @link https://core.telegram.org/bots/api#getbusinessconnection
   */
  public function BusinessGet(
    string $Id
  ):TgBusinessConnection{
    return new TgBusinessConnection(
      $this->ServerMethod(TgMethods::BusinessGet, ['business_connection_id' => $Id])
    );
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
      if(mb_strlen($Text) > TgLimits::CallbackAnswer):
        throw new TblException(TblError::LimitCallbackAnswer);
      endif;
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
   * @param string $Effect Unique identifier of the message effect to be added to the message; for private chats only
   * @param bool $AllowPaid Allow up to 1000 messages per second, ignoring broadcasting limits for a fee of 0.1 Telegram Stars per message. The relevant Stars will be withdrawn from the bot's balance
   * @return TgDocument On success, the sent Message is returned.
   * @link https://core.telegram.org/bots/api#senddocument
   */
  public function DocumentSend(
    int $Chat,
    string $File,
    int $Thread = null,
    string $Thumb = null,
    string $Caption = null,
    TgParseMode $ParseMode = TgParseMode::Html,
    TblEntities $Entities = null,
    bool $DisableDetection = false,
    bool $DisableNotification = false,
    bool $Protect = false,
    int $RepliedMsg = null,
    bool $SendWithoutRepliedMsg = false,
    bool $AllowPaid = false,
    TblMarkup $Markup = null,
    string $Effect = null
  ):TgDocument{
    $param['chat_id'] = $Chat;
    if(is_file($File)):
      $param['document'] = new CurlFile($File);
    else:
      $param['document'] = $File;
    endif;
    if($Thread !== null):
      $param['message_thread_id'] = $Thread;
    endif;
    if($Thumb !== null):
      if(is_file($Thumb)):
        $param['thumbnail'] = new CurlFile($File);
      else:
        $param['thumbnail'] = $Thumb;
      endif;
    endif;
    if($Caption !== null):
      if(mb_strlen(strip_tags($Caption)) > TgLimits::Caption):
        throw new TblException(
          TgError::LimitCaption,
          'Caption bigger than ' . TgLimits::Caption . ' characters'
        );
      endif;
      $param['caption'] = $Caption;
      if($ParseMode !== null):
        $param['parse_mode'] = $ParseMode->value;
      endif;
    endif;
    if($Entities !== null):
      $param['caption_entities'] = $Entities->ToArray();
    endif;
    if($DisableDetection):
      $param['disable_content_type_detection'] = true;
    endif;
    if($DisableNotification):
      $param['disable_notification'] = true;
    endif;
    if($Protect):
      $param['protect_content'] = true;
    endif;
    if($AllowPaid):
      $param['allow_paid_broadcast'] = true;
    endif;
    if($RepliedMsg !== null):
      $param['reply_to_message_id'] = $RepliedMsg;
    endif;
    if($SendWithoutRepliedMsg):
      $param['allow_sending_without_reply'] = true;
    endif;
    if($Markup !== null):
      $param['reply_markup'] = $Markup->ToArray();
    endif;
    if($Effect !== null):
      $param['message_effect_id'] = $Effect;
    endif;
    $return = $this->ServerMethod(TgMethods::DocumentSend, $param);
    return new TgDocument($return);
  }

  private function DetectReturn(
    array $Data
  ):object{
    if(isset($Data['message'])):
      return parent::DetectMessage($Data['message']);
    elseif(isset($Data['edited_message'])):
      return parent::DetectMessageEdited($Data['edited_message']);
    elseif(isset($Data['channel_post'])):
      return parent::DetectMessage($Data['channel_post']);
    elseif(isset($Data['edited_channel_post'])):
      return parent::DetectMessageEdited($Data['edited_channel_post']);
    elseif(isset($Data['business_message'])):
      return parent::DetectMessage($Data['business_message']);
    elseif(isset($Data['edited_business_message'])):
      return parent::DetectMessageEdited($Data['business_message']);
    elseif(isset($Data['business_connection'])):
      return new TgBusinessConnection($Data['business_connection']);
    elseif(isset($Data['deleted_business_messages'])):
      return new TgMessageDeleted($Data['deleted_business_messages']);
    elseif(isset($Data['callback_query']['game_short_name'])):
      return new TgGameStart($Data['callback_query']);
    elseif(isset($Data['callback_query'])):
      return new TgCallback($Data['callback_query']);
    elseif(isset($Data['chat_boost'])):
      return new TgChatBoost($Data['chat_boost']);
    elseif(isset($Data['chat_join_request'])):
      return new TgChatRequest($Data['chat_join_request']);
    elseif(isset($Data['chat_member'])):
      return new TgGroupStatus($Data['chat_member']);
    elseif(isset($Data['chosen_inline_result'])):
      return new TgInlineQueryFeedback($Data['chosen_inline_result']);
    elseif(isset($Data['invoice'])): //Suspect unnecessary
      return new TgInvoice($Data['invoice']);
    elseif(isset($Data['inline_query'])):
      return new TgInlineQuery($Data['inline_query']);
    elseif(isset($Data['message_reaction'])):
      return new TgReactionUpdate($Data['message_reaction']);
    elseif(isset($Data['message_reaction_count'])):
      return new TgReactionUpdate($Data['message_reaction_count']);
    elseif(isset($Data['my_chat_member'])):
      return new TgGroupStatusMy($Data['my_chat_member']);
    elseif(isset($Data['poll'])):
      return new TgPoll($Data['poll']);
    elseif(isset($Data['poll_answer'])):
      return new TgPollAnswer($Data['poll_answer']);
    elseif(isset($Data['pre_checkout_query'])):
      return new TgInvoiceCheckout($Data['pre_checkout_query']);
    elseif(isset($Data['purchased_paid_media'])):
      return new TgPaidMediaPurchased($Data['purchased_paid_media']);
    elseif(isset($Data['removed_chat_boost'])):
      return new TgChatBoostRemoved($Data['removed_chat_boost']);
    elseif(isset($Data['shipping_query'])):
      return new TgInvoiceShipping($Data['shipping_query']);
    endif;
  }

  /**
   * Return the URL to download a file from Telegram
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
  public function FileInfo(
    string $Id
  ):TgFile{
    $param['file_id'] = $Id;
    $return = $this->ServerMethod(TgMethods::FileGet, $param);
    return new TgFile($return);
  }

  /**
   * Use this method to send a group of photos, videos, documents or audios as an album. Documents and audio files can be only grouped in an album with messages of the same type.
   * @param TgAudioGroup[]|TgDocumentGroup[]|TgPhotoGroup[]|TgVideoGroup[] $Objects
   * @param int $Thread Unique identifier for the target message thread (topic) of the forum; for forum supergroups only
   * @param string $BusinessId Unique identifier of the business connection on behalf of which the message will be sent
   * @param bool $DisableNotification Sends messages silently. Users will receive a notification with no sound.
   * @param bool $Protect Protects the contents of the sent messages from forwarding and saving
   * @param TgReplyParams $Reply Description of the message to reply to
   * @param string $Effect Unique identifier of the message effect to be added to the message; for private chats only
   * @param bool $AllowPaid Allow up to 1000 messages per second, ignoring broadcasting limits for a fee of 0.1 Telegram Stars per message. The relevant Stars will be withdrawn from the bot's balance
   * @return array An array of Messages that were sent is returned.
   * @link https://core.telegram.org/bots/api#sendmediagroup
   */
  public function GroupSend(
    int|string $Chat = null,
    array $Objects,
    int $Thread = null,
    string $BusinessId = null,
    bool $DisableNotification = false,
    bool $Protect = false,
    bool $AllowPaid = false,
    string $Effect = null,
    TgReplyParams $Reply = null,
  ):void{
    foreach($Objects as &$object):
      $object = $object->ToArray();
    endforeach;
    $param['chat_id'] = $Chat;
    $param['media'] = $Objects;
    if($Thread !== null):
      $param['thread_id'] = $Thread;
    endif;
    if($BusinessId !== null):
      $param['business_id'] = $BusinessId;
    endif;
    if($Effect !== null):
      $param['message_effect_id'] = $Effect;
    endif;
    if($DisableNotification):
      $param['disable_notification'] = true;
    endif;
    if($Protect):
      $param['protect_content'] = true;
    endif;
    if($AllowPaid):
      $param['allow_paid_broadcast'] = true;
    endif;
    $param['reply_parameters'] = $Reply->ToArray();
    $this->ServerMethod(TgMethods::GroupSend, $param);
  }

  /**
   * Use this method to send answers to an inline query. No more than 50 results per query are allowed.
   * @param string $Id Unique identifier for the answered query
   * @param TgInlineQueryResults $Results An array of results for the inline query
   * @param int $Cache The maximum amount of time in seconds that the result of the inline query may be cached on the server. Defaults to 300.
   * @param bool $Personal Pass True, if results may be cached on the server side only for the user that sent the query. By default, results may be returned to any user who sends the same query
   * @param string $NextOffset Pass the offset that a client should send in the next query with the same text to receive more results. Pass an empty string if there are no more results or if you don't support pagination. Offset length can't exceed 64 bytes.
   * @param string $ButtonText Label text on the button
   * @param string $ButtonWebapp An HTTPS URL of a Web App to be opened with additional data as specified in Initializing Web Apps
   * @param string $StartParam Deep-linking parameter for the /start message sent to the bot when a user presses the button. 1-64 characters, only A-Z, a-z, 0-9, _ and - are allowed.
   * Example: An inline bot that sends YouTube videos can ask the user to connect the bot to their YouTube account to adapt search results accordingly. To do this, it displays a 'Connect your YouTube account' button above the results, or even before showing any. The user presses the button, switches to a private chat with the bot and, in doing so, passes a start parameter that instructs the bot to return an OAuth link. Once done, the bot can offer a switch_inline button so that the user can easily return to the chat where they wanted to use the bot's inline capabilities.
   * @return bool On success, True is returned
   * @throws TblException
   * @link https://core.telegram.org/bots/api#answerinlinequery
   * @link https://core.telegram.org/bots/api#inlinequeryresultsbutton
   * @link https://core.telegram.org/bots/api#webappinfo
   */
  public function InlineQueryAnswer(
    string $Id,
    TgInlineQueryResults $Results,
    int $Cache = null,
    bool $Personal = false,
    string $NextOffset = null,
    string $ButtonText = null,
    string $ButtonWebapp = null,
    string $StartParam = null
  ){
    $param['inline_query_id'] = $Id;
    $param['results'] = $Results->ToArray();
    if($Cache !== null):
      $param['cache_time'] = $Cache;
    endif;
    if($Personal):
      $param['is_personal'] = 'true';
    endif;
    if($NextOffset !== null):
      $param['next_offset'] = $NextOffset;
    endif;
    if($ButtonText !== null):
      $param['button']['text'] = $ButtonText;
    endif;
    if($ButtonWebapp !== null):
      $param['button']['web_app']['url'] = $ButtonWebapp;
    endif;
    if($StartParam !== null):
      $param['button']['start_parameter'] = $StartParam;
    endif;
    return $this->ServerMethod(TgMethods::InlineQueryAnswer, $param);
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
   * Use this method to copy messages of any kind. Service messages, paid media messages, giveaway messages, giveaway winners messages, and invoice messages can't be copied. A quiz poll can be copied only if the value of the field correct_option_id is known to the bot. The method is analogous to the method forwardMessage, but the copied message doesn't have a link to the original message.
   * @param int $From Unique identifier for the chat where the original message was sent (or channel username in the format @channelusername)
   * @param int $Id Message identifier in the chat specified in from_chat_id
   * @param int $To Unique identifier for the target chat or username of the target channel (in the format @channelusername)
   * @param int $Thread Unique identifier for the target message thread (topic) of the forum; for forum supergroups only
   * @param string $Caption New caption for media, 0-1024 characters after entities parsing. If not specified, the original caption is kept
   * @param TblEntities $Entities A list of special entities that appear in the new caption, which can be specified instead of parse_mode
   * @param TgParseMode $ParseMode Mode for parsing entities in the new caption.
   * @param bool $DisableNotification Sends the message silently. Users will receive a notification with no sound.
   * @param bool $Protect Protects the contents of the sent message from forwarding and saving
   * @param int $RepliedMsg If the message is a reply, ID of the original message
   * @param bool $SendWithoutRepliedMsg Pass True, if the message should be sent even if the specified replied-to message is not found
   * @param TblMarkup $Markup Additional interface options. A object for an inline keyboard, custom reply keyboard, instructions to remove reply keyboard or to force a reply from the user.
   * @param bool $CaptionAbove If the caption must be shown above the message media
   * @param bool $AllowPaid Allow up to 1000 messages per second, ignoring broadcasting limits for a fee of 0.1 Telegram Stars per message. The relevant Stars will be withdrawn from the bot's balance
   * @return int Returns the MessageId of the sent message on success.
   * @throws TblException
   * @link https://core.telegram.org/bots/api#copymessage
   */
  public function MessageCopy(
    int $From,
    int $Id,
    int $To,
    int $Thread = null,
    string $Caption = null,
    bool $CaptionAbove = false,
    TblEntities $Entities = null,
    TgParseMode $ParseMode = null,
    bool $DisableNotification = false,
    bool $Protect = false,
    int $RepliedMsg = null,
    bool $SendWithoutRepliedMsg = false,
    bool $AllowPaid = false,
    TblMarkup $Markup = null
  ):int{
    $param['chat_id'] = $To;
    $param['from_chat_id'] = $From;
    $param['message_id'] = $Id;
    if($Thread !== null):
      $param['message_thread_id'] = $Thread;
    endif;
    if($Caption !== null):
      if(mb_strlen(strip_tags($Caption)) > TgLimits::Caption):
        throw new TblException(
          TgError::LimitCaption,
          'Caption bigger than ' . TgLimits::Caption . ' characters'
        );
      endif;
      $param['caption'] = $Caption;
      if($ParseMode !== null):
        $param['parse_mode'] = $ParseMode->value;
      endif;
    endif;
    if($Entities !== null):
      $param['caption_entities'] = $Entities->ToArray();
    endif;
    if($DisableNotification):
      $param['disable_notification'] = true;
    endif;
    if($Protect):
      $param['protect_content'] = true;
    endif;
    if($AllowPaid):
      $param['allow_paid_broadcast'] = true;
    endif;
    if($RepliedMsg !== null):
      $param['reply_to_message_id'] = $RepliedMsg;
    endif;
    if($SendWithoutRepliedMsg):
      $param['allow_sending_without_reply'] = true;
    endif;
    if($Markup !== null):
      $param['reply_markup'] = $Markup->ToArray();
    endif;
    if($CaptionAbove):
      $param['show_caption_above_media'] = true;
    endif;
    $return = $this->ServerMethod(TgMethods::MessageCopy, $param);
    return $return['message_id'];
  }

  /**
   * Use this method to delete a message, including service messages, with the following limitations:
   * - A message can only be deleted if it was sent less than 48 hours ago.
   * - Service messages about a supergroup, channel, or forum topic creation can't be deleted.
   * - A dice message in a private chat can only be deleted if it was sent more than 24 hours ago.
   * - Bots can delete outgoing messages in private chats, groups, and supergroups.
   * - Bots can delete incoming messages in private chats.
   * - Bots granted can_post_messages permissions can delete outgoing messages in channels.
   * - If the bot is an administrator of a group, it can delete any message there.
   * - If the bot has can_delete_messages permission in a supergroup or a channel, it can delete any message there.
   * @param int $Chat Unique identifier for the target chat
   * @param int $Id Identifier of the message to delete
   * @return bool Returns True on success.
   * @link https://core.telegram.org/bots/api#deletemessage
   * @throws TblException
   */
  public function MessageDelete(
    int $Chat,
    int $Id
  ):bool{
    $param['chat_id'] = $Chat;
    $param['message_id'] = $Id;
    return parent::ServerMethod(TgMethods::MessageDelete, $param);
  }

  /**
   * Use this method to forward messages of any kind. Service messages can't be forwarded.
   * @param int $To Unique identifier for the target chat or username of the target channel
   * @param int $From Unique identifier for the chat where the original message was sent
   * @param int $Id Message identifier in the chat specified in from_chat_id
   * @param int $Thread Unique identifier for the target message thread (topic) of the forum; for forum supergroups only
   * @param bool $DisableNotification Sends the message silently. Users will receive a notification with no sound.
   * @param bool $Protect Protects the contents of the forwarded message from forwarding and saving
   * @return object On success, the sent Message is returned.
   * @throws TblException
   * @link https://core.telegram.org/bots/api#forwardmessage
   */
  public function MessageForward(
    int $From,
    int $Id,
    int $To,
    int $Thread = null,
    bool $DisableNotification = false,
    bool $Protect = false
  ):TgMessageInterface{
    $param['chat_id'] = $To;
    $param['from_chat_id'] = $From;
    $param['message_id'] = $Id;
    if($Thread !== null):
      $param['message_thread_id'] = $Thread;
    endif;
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
   * Use this method to add a message to the list of pinned messages in a chat. If the chat is not a private chat, the bot must be an administrator in the chat for this to work and must have the 'can_pin_messages' administrator right in a supergroup or 'can_edit_messages' administrator right in a channel.
   * @param int|string $Chat Unique identifier for the target chat or username of the target channel (in the format @channelusername)
   * @param int $Id Identifier of a message to pin
   * @param bool $DisableNotification Pass True if it is not necessary to send a notification to all chat members about the new pinned message. Notifications are always disabled in channels and private chats.
   * @param string $BusinessId Unique identifier of the business connection on behalf of which the message will be pinned
   * @return true Returns True on success.
   * @throws TblException
   * @link https://core.telegram.org/bots/api#pinchatmessage
   */
  public function MessagePin(
    int|string $Chat,
    int $Id,
    string $BusinessId = null,
    bool $DisableNotification = false
  ):true{
    $param['chat_id'] = $Chat;
    $param['message_id'] = $Id;
    if($DisableNotification):
      $param['disable_notification'] = true;
    endif;
    if($BusinessId !== null):
      $param['business_connection_id'] = $BusinessId;
    endif;
    return $this->ServerMethod(TgMethods::MessagePin, $param);
  }

  /**
   * Use this method to change the chosen reactions on a message. Service messages can't be reacted to. Automatically forwarded messages from a channel to its discussion group have the same available reactions as messages in the channel. In albums, bots must react to the first message.
   * @return true on success.
   * @link https://core.telegram.org/bots/api#setmessagereaction
   * @throws TblException
   */
  public function MessageReaction(
    int|string $Chat,
    int $Message,
    string|null $Emoji,
    bool $Big = true
  ):true{
    $default = ['👍','👎','❤','🔥','🥰','👏','😁','🤔','🤯','😱','🤬','😢','🎉','🤩','🤮','💩','🙏','👌','🕊',
      '🤡','🥱','🥴','😍','🐳','❤‍🔥','🌚','🌭','💯','🤣','⚡','🍌','🏆','💔','🤨','😐','🍓','🍾','💋','🖕','😈',
      '😴','😭','🤓','👻','👨‍💻','👀','🎃','🙈','😇','😨','🤝','✍','🤗','🫡','🎅','🎄','☃','💅','🤪','🗿','🆒',
      '💘','🙉','🦄','😘','💊','🙊','😎','👾','🤷‍♂','🤷','🤷‍♀','😡'];
    $param['chat_id'] = $Chat;
    $param['message_id'] = $Message;
    if($Emoji === null):
      $param['reaction'] = [];
    elseif(in_array($Emoji, $default)):
      $param['reaction'][] = [
        'type' => TgReactionType::Normal->value,
        'emoji' => $Emoji
      ];
    else:
      $param['reaction'][] = [
        'type' => TgReactionType::Custom->value,
        'custom_emoji_id' => $Emoji
      ];
    endif;
    $param['is_big'] = $Big;
    return $this->ServerMethod(TgMethods::MessageReaction, $param);
  }

  /**
   * Use this method to copy messages of any kind. Service messages, paid media messages, giveaway messages, giveaway winners messages, and invoice messages can't be copied. A quiz poll can be copied only if the value of the field correct_option_id is known to the bot. The method is analogous to the method forwardMessage, but the copied message doesn't have a link to the original message.
   * @param int|string $From Unique identifier for the chat where the original messages were sent (or channel username in the format @channelusername)
   * @param int[] $Ids Identifiers of 1-100 messages in the chat from_chat_id to copy. The identifiers must be specified in a strictly increasing order.
   * @param int|string $To Unique identifier for the target chat or username of the target channel (in the format @channelusername)
   * @param int $Thread Unique identifier for the target message thread (topic) of the forum; for forum supergroups only
   * @param bool $DisableNotification Sends the messages silently. Users will receive a notification with no sound.
   * @param bool $Protect Protects the contents of the sent messages from forwarding and saving
   * @param bool $RemoveCaption Pass True to copy the messages without their captions
   * @return array On success, an array of MessageId of the sent messages is returned.
   * @link https://core.telegram.org/bots/api#copymessages
   * @throws TblException
   */
  public function MessagesCopy(
    int|string $From,
    array $Ids,
    int|string $To,
    int $Thread = null,
    bool $DisableNotification = false,
    bool $Protect = false,
    bool $RemoveCaption = false
  ):array{
    if(count($Ids) > TgLimits::MessagesCopy):
      throw new TblException(TblError::MessagesCopy, 'Cant copy more than ' . TgLimits::MessagesCopy . ' messages');
    endif;
    $param['from_chat_id'] = $From;
    $param['message_ids'] = $Ids;
    $param['chat_id'] = $To;
    if($Thread !== null):
      $param['message_thread_id'] = $Thread;
    endif;
    if($DisableNotification):
      $param['disable_notification'] = true;
    endif;
    if($Protect):
      $param['protect_content'] = true;
    endif;
    if($RemoveCaption):
      $param['remove_caption'] = true;
    endif;
    return $this->ServerMethod(TgMethods::MessagesCopy, $param);
  }

  /**
   * Use this method to delete multiple messages simultaneously. If some of the specified messages can't be found, they are skipped.
   * @param int|string $Chat Unique identifier for the target chat or username of the target channel (in the format @channelusername)
   * @param int[] $Messages Identifiers of 1-100 messages to delete. See deleteMessage for limitations on which messages can be deleted
   * @return true on success
   * @throws TblException
   * @link https://core.telegram.org/bots/api#deletemessages
   */
  public function MessagesDelete(
    int|string $Chat,
    array $Messages
  ):true{
    if(count($Messages) > TgLimits::MessagesDelete):
      throw new TblException(TblError::MessagesDelete, 'Cant delete more than ' . TgLimits::MessagesDelete . ' messages');
    endif;
    $param['chat_id'] = $Chat;
    $param['message_ids'] = $Messages;
    return $this->ServerMethod(TgMethods::MessagesDelete, $param);
  }

  /**
   * Use this method to forward multiple messages of any kind. If some of the specified messages can't be found or forwarded, they are skipped. Service messages and messages with protected content can't be forwarded. Album grouping is kept for forwarded messages.
   * @param int|string $From Unique identifier for the chat where the original messages were sent (or channel username in the format @channelusername)
   * @param int[] $Ids Identifiers of 1-100 messages in the chat from_chat_id to forward. The identifiers must be specified in a strictly increasing order.
   * @param int|string $To Unique identifier for the target chat or username of the target channel (in the format @channelusername)
   * @param int $Thread Unique identifier for the target message thread (topic) of the forum; for forum supergroups only
   * @param bool $DisableNotification Sends the messages silently. Users will receive a notification with no sound.
   * @param bool $Protect Protects the contents of the forwarded messages from forwarding and saving
   * @return array On success, an array of MessageId of the sent messages is returned.
   * @throws TblException
   */
  public function MessagesForward(
    int|string $From,
    array $Ids,
    int|string $To,
    int $Thread = null,
    bool $DisableNotification = false,
    bool $Protect = false
  ):array{
    if(count($Ids) > TgLimits::MessagesForward):
      throw new TblException(TblError::MessagesForward, 'Cant forward more than ' . TgLimits::MessagesForward . ' messages');
    endif;
    $param['chat_id'] = $To;
    $param['from_chat_id'] = $From;
    $param['message_ids'] = $Ids;
    if($Thread !== null):
      $param['message_thread_id'] = $Thread;
    endif;
    if($DisableNotification):
      $param['disable_notification'] = true;
    endif;
    if($Protect):
      $param['protect_content'] = true;
    endif;
    return $this->ServerMethod(TgMethods::MessagesForward, $param);
  }

  /**
   * Use this method to remove a message from the list of pinned messages in a chat. If the chat is not a private chat, the bot must be an administrator in the chat for this to work and must have the 'can_pin_messages' administrator right in a supergroup or 'can_edit_messages' administrator right in a channel.
   * @param int|string $Chat Unique identifier for the target chat or username of the target channel (in the format @channelusername)
   * @param int $Id Identifier of a message to unpin. If not specified, the most recent pinned message (by sending date) will be unpinned.
   * @param string $BusinessId Unique identifier of the business connection on behalf of which the message will be unpinned
   * @return true Returns True on success.
   * @link https://core.telegram.org/bots/api#unpinchatmessage
   * @throws TblException
   */
  public function MessageUnpin(
    int|string $Chat,
    int $Id = null,
    string $BusinessId = null
  ):true{
    $param['chat_id'] = $Chat;
    if($Id !== null):
      $param['message_id'] = $Id;
    endif;
    if($BusinessId !== null):
      $param['business_connection_id'] = $BusinessId;
    endif;
    return $this->ServerMethod(TgMethods::MessageUnpin, $param);
  }

  /**
   * Use this method to clear the list of pinned messages in a chat. If the chat is not a private chat, the bot must be an administrator in the chat for this to work and must have the 'can_pin_messages' administrator right in a supergroup or 'can_edit_messages' administrator right in a channel.
   * @param int|string $Chat Unique identifier for the target chat or username of the target channel (in the format @channelusername)
   * @return bool Returns True on success.
   * @throws TblException
   * @link https://core.telegram.org/bots/api#unpinallchatmessages
   */
  public function MessageUnpinAll(
    int|string $Chat
  ):bool{
    $param['chat_id'] = $Chat;
    return $this->ServerMethod(TgMethods::MessageUnpinAll, $param);
  }

  /**
   * Use this method to send static .WEBP, animated .TGS, or video .WEBM stickers.
   * @param int $Chat Unique identifier for the target chat
   * @param string $Sticker Sticker to send. Pass a file_id as String to send a file that exists on the Telegram servers (recommended), pass an HTTP URL as a String for Telegram to get a .WEBP file from the Internet, or upload a new one using multipart/form-data.
   * @param int $Thread Unique identifier for the target message thread (topic) of the forum; for forum supergroups only
   * @param string $Emoji Emoji associated with the sticker; only for just uploaded stickers
   * @param bool $DisableNotification Sends the message silently. Users will receive a notification with no sound.
   * @param bool $Protect Protects the contents of the sent message from forwarding and saving
   * @param int $RepliedMsg If the message is a reply, ID of the original message
   * @param bool $SendWithoutRepliedMsg If the message should be sent even if the specified replied-to message is not found
   * @param TblMarkup $Markup Additional interface options. A JSON-serialized object for an inline keyboard, custom reply keyboard, instructions to remove reply keyboard or to force a reply from the user.
   * @param string $Effect Unique identifier of the message effect to be added to the message; for private chats only
   * @param bool $AllowPaid Allow up to 1000 messages per second, ignoring broadcasting limits for a fee of 0.1 Telegram Stars per message. The relevant Stars will be withdrawn from the bot's balance
   * @return TgSticker The sent Message.
   * @throws TblException
   * @link https://core.telegram.org/bots/api#sendsticker
   */
  public function StickerSend(
    int $Chat,
    string $Sticker,
    int $Thread = null,
    string $Emoji = null,
    bool $DisableNotification = false,
    bool $Protect = false,
    int $RepliedMsg = null,
    bool $SendWithoutRepliedMsg = false,
    bool $AllowPaid = false,
    TblMarkup $Markup = null,
    string $Effect = null
  ):TgSticker{
    $param['chat_id'] = $Chat;
    $param['sticker'] = $Sticker;
    if($Thread !== null):
      $param['message_thread_id'] = $Thread;
    endif;
    if($DisableNotification):
      $param['disable_notification'] = true;
    endif;
    if($Emoji !== null):
      $param['emoji'] = $Emoji;
    endif;
    if($Protect):
      $param['protect_content'] = true;
    endif;
    if($AllowPaid):
      $param['allow_paid_broadcast'] = true;
    endif;
    if($RepliedMsg !== null):
      $param['reply_to_message_id'] = $RepliedMsg;
      if($SendWithoutRepliedMsg):
        $param['allow_sending_without_reply'] = 'true';
      endif;
    endif;
    if($Markup !== null):
      $param['reply_markup'] = $Markup->ToArray();
    endif;
    if($Effect !== null):
      $param['message_effect_id'] = $Effect;
    endif;
    $return = parent::ServerMethod(TgMethods::StickerSend, $param);
    return new TgSticker($return);
  }

  /**
   * @throws TblException
   */
  public function WebhookGet():object{
    if($this->BotData->TokenWebhook !== null
    and ($_SERVER['HTTP_X_TELEGRAM_BOT_API_SECRET_TOKEN'] ?? null) !== $this->BotData->TokenWebhook):
      throw new TblException(TblError::TokenWebhook, 'Wrong webhook token');
    endif;
    $update = file_get_contents('php://input');
    if($update === ''):
      throw new TblException(TblError::NoEvent, 'No event found');
    endif;
    $update = json_decode($update, true);
    if($this->BotData->Log & TblLog::Webhook):
      $this->Log(
        TblLog::Webhook,
        json_encode(
          $update,
          JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
        )
      );
    endif;
    $return = $this->DetectReturn($update);
    if($this->BotData->Log & TblLog::WebhookObject):
      ob_start();
      var_dump($return);
      $temp = ob_get_contents();
      ob_end_clean();
      $this->Log(TblLog::WebhookObject, $temp);
    endif;
    return $return;
  }
}