<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TblObjects;
use CurlHandle;
use ProtocolLive\TelegramBotLibrary\TblEnums\TblError;
use ProtocolLive\TelegramBotLibrary\TblInterfaces\TblLogInterface;
use ProtocolLive\TelegramBotLibrary\TgEnums\{
  TgEntityType,
  TgMethods
};
use ProtocolLive\TelegramBotLibrary\TgObjects\{
  TgAnimation,
  TgAnimationEdited,
  TgAudio,
  TgBusinessConnection,
  TgCallback,
  TgChatBoost,
  TgChatBoostAdded,
  TgChatBoostRemoved,
  TgChatMigrateFrom,
  TgChatMigrateTo,
  TgChatRequest,
  TgChatShared,
  TgContact,
  TgDice,
  TgDocument,
  TgDocumentEdited,
  TgErrors,
  TgForumClosed,
  TgForumCreated,
  TgForumReopened,
  TgGame,
  TgGameEdited,
  TgGameStart,
  TgGiveaway,
  TgGiveawayWinners,
  TgGroupCreated,
  TgGroupStatus,
  TgGroupStatusMy,
  TgInlineQuery,
  TgInlineQueryFeedback,
  TgInvoice,
  TgInvoiceCheckout,
  TgInvoiceShipping,
  TgLocation,
  TgLocationEdited,
  TgLogin,
  TgMessageDeleted,
  TgPaidMedia,
  TgPaidMediaPurchased,
  TgPassport,
  TgPhoto,
  TgPhotoEdited,
  TgPoll,
  TgPollAnswer,
  TgPollEdited,
  TgReactionUpdate,
  TgRefundedPayment,
  TgSticker,
  TgStickerEdited,
  TgStory,
  TgText,
  TgTextEdited,
  TgUsersShared,
  TgVenue,
  TgVideo,
  TgVideoChatInvite,
  TgVideoEdited,
  TgVideoNote,
  TgVideoNoteEdited,
  TgVoice,
  TgVoiceEdited,
  TgWebappData
};
use ProtocolLive\TelegramBotLibrary\TgService\{
  TgBackground,
  TgChatAutoDel,
  TgChatPhotoNew,
  TgChatTitle,
  TgForumEdited,
  TgForumGeneralHidden,
  TgGiftInfo,
  TgGiftUniqueInfo,
  TgGiveawayCompleted,
  TgGiveawayCreated,
  TgInvoiceDone,
  TgMemberLeft,
  TgMemberNew,
  TgPaidMessagePriceChanged,
  TgPhotoDel,
  TgPinnedMsg,
  TgVideoChatEnded,
  TgVideoChatScheduled,
  TgVideoChatStarted
};

/**
 * @version 2025.06.30.00
 */
abstract class TblBasics{
  protected TblData $BotData;

  private function Curl(
    string $Url,
    array|null $Params = null,
    bool $AsJson = true
  ):CurlHandle{
    $curl = curl_init($Url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_USERAGENT, 'Protocol TelegramBotLibrary');
    curl_setopt($curl, CURLOPT_CAINFO, dirname(__DIR__) . '/cacert.pem');
    if($AsJson):
      curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
      curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($Params));
    else:
      curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type: multipart/form-data']);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $Params);
    endif;
    if(in_array(TblLog::Curl, $this->BotData->Log)):
      curl_setopt($curl, CURLOPT_VERBOSE, true);
      curl_setopt($curl, CURLOPT_STDERR, fopen($this->BotData->DirLogs . '/curl.log', 'a'));
    endif;
    return $curl;
  }

  //Return string for method InvoiceLink
  private function CurlResponse(
    CurlHandle $Curl,
    string|null $Log = null,
  ):array|bool|string|TblException{
    if($Log !== null):
      $this->Log($this->BotData, TblLog::Send, $Log);
    endif;
    $response = curl_multi_getcontent($Curl);
    $json = json_decode($response, true);
    if(json_last_error() > 0):
      $this->Log(
        $this->BotData,
        TblLog::Response,
        'Json error: ' . json_last_error_msg() . PHP_EOL . 'Response: ' . $response
      );
      return new TblException(TblError::JsonError, json_last_error_msg());
    endif;
    if($json['result'] === true):
      $this->Log($this->BotData, TblLog::Response, $json);
    else:
      try{
        $this->Log(
          $this->BotData,
          TblLog::Response,
          $json,
          self::DetectUpdate(['message' => $json['result']])
        );
      }catch(TblException){
        $this->Log($this->BotData, TblLog::Response, $json);
      }
    endif;
    if($json['ok'] === false):
      $search = TgErrors::Search($json['description']);
      if($search === false):
        return new TblException(TblError::Custom, $json['description']);
      else:
        return new TblException($search, $json['description']);
      endif;
    else:
      return $json['result'];
    endif;
  }

  public static function DetectMessage(
    array $Data,
    bool $IgnoreCmd = false
  ):object|null{
    $entity = $Data['caption_entities'][0] ?? $Data['entities'][0] ?? null;
    if($IgnoreCmd === false
    and $entity !== null
    and $entity['type'] === TgEntityType::Command->value
    and $entity['offset'] === 0):
      return new TblCmd($Data);
    elseif(isset($Data['animation'])):
      return new TgAnimation($Data);
    elseif(isset($Data['audio'])):
      return new TgAudio($Data);
    elseif(isset($Data['boost_added'])):
      return new TgChatBoostAdded($Data['boost_added']);
    elseif(isset($Data['chat_background_set'])):
      return new TgBackground($Data['chat_background_set']);
    elseif(isset($Data['chat_shared'])):
      return new TgChatShared($Data);
    elseif(isset($Data['connected_website'])):
      return new TgLogin($Data);
    elseif(isset($Data['contact'])):
      return new TgContact($Data);
    elseif(isset($Data['delete_chat_photo'])):
      return new TgPhotoDel($Data);
    elseif(isset($Data['dice'])):
      return new TgDice($Data);
    elseif(isset($Data['document'])):
      return new TgDocument($Data);
    elseif(isset($Data['forum_topic_closed'])):
      return new TgForumClosed($Data);
    elseif(isset($Data['forum_topic_created'])):
      return new TgForumCreated($Data);
    elseif(isset($Data['forum_topic_edited'])):
      return new TgForumEdited($Data);
    elseif(isset($Data['forum_topic_reopened'])):
      return new TgForumReopened($Data);
    elseif(isset($Data['game'])):
      return new TgGame($Data);
    elseif(isset($Data['general_forum_topic_hidden'])):
      return new TgForumGeneralHidden($Data);
    elseif(isset($Data['giveaway'])):
      return new TgGiveaway($Data);
    elseif(isset($Data['giveaway_created'])):
      return new TgGiveawayCreated($Data);
    elseif(isset($Data['giveaway_completed'])):
      return new TgGiveawayCompleted($Data);
    elseif(isset($Data['giveaway_winners'])):
      return new TgGiveawayWinners($Data);
    elseif(isset($Data['group_chat_created'])):
      return new TgGroupCreated($Data);
    elseif(isset($Data['invoice'])):
      return new TgInvoice($Data);
    elseif(isset($Data['left_chat_member'])):
      return new TgMemberLeft($Data);
    elseif(isset($Data['venue'])): //out of order because for priority above location
      return new TgVenue($Data);
    elseif(isset($Data['location'])):
      return new TgLocation($Data);
    elseif(isset($Data['message_auto_delete_timer_changed'])):
      return new TgChatAutoDel($Data);
    elseif(isset($Data['migrate_from_chat_id'])):
      return new TgChatMigrateFrom($Data);
    elseif(isset($Data['migrate_to_chat_id'])):
      return new TgChatMigrateTo($Data);
    elseif(isset($Data['new_chat_member'])):
      return new TgMemberNew($Data);
    elseif(isset($Data['new_chat_photo'])):
      return new TgChatPhotoNew($Data);
    elseif(isset($Data['new_chat_title'])):
      return new TgChatTitle($Data);
    elseif(isset($Data['paid_media'])):
      return new TgPaidMedia($Data);
    elseif(isset($Data['paid_message_price_changed'])):
      return new TgPaidMessagePriceChanged($Data);
    elseif(isset($Data['passport_data'])):
      return new TgPassport($Data);
    elseif(isset($Data['photo'])):
      return new TgPhoto($Data);
    elseif(isset($Data['pinned_message'])):
      return new TgPinnedMsg($Data);
    elseif(isset($Data['poll'])):
      return new TgPoll($Data);
    elseif(isset($Data['refunded_payment'])):
      return new TgRefundedPayment($Data);
    elseif(isset($Data['successful_payment'])):
      return new TgInvoiceDone($Data);
    elseif(isset($Data['sticker'])):
      return new TgSticker($Data);
    elseif(isset($Data['story'])):
      return new TgStory($Data);
    elseif(isset($Data['text'])):
      return new TgText($Data);
    elseif(isset($Data['users_shared'])):
      return new TgUsersShared($Data);
    elseif(isset($Data['video'])):
      return new TgVideo($Data);
    elseif(isset($Data['video_note'])):
      return new TgVideoNote($Data);
    elseif(isset($Data['video_chat_ended'])):
      return new TgVideoChatEnded($Data);
    elseif(isset($Data['video_chat_participants_invited'])):
      return new TgVideoChatInvite($Data);
    elseif(isset($Data['video_chat_scheduled'])):
      return new TgVideoChatScheduled($Data);
    elseif(isset($Data['video_chat_started'])):
      return new TgVideoChatStarted($Data);
    elseif(isset($Data['voice'])):
      return new TgVoice($Data);
    elseif(isset($Data['web_app_data'])):
      return new TgWebappData($Data);
    else:
      return null;
    endif;
  }

  public static function DetectMessageEdited(
    array $Data
  ):object|null{
    if(isset($Data['entities'][0])
    and $Data['entities'][0]['type'] === TgEntityType::Command->value
    and $Data['entities'][0]['offset'] === 0):
      return new TblCmdEdited($Data);
    elseif(isset($Data['animation'])):
      return new TgAnimationEdited($Data);
    elseif(isset($Data['document'])):
      return new TgDocumentEdited($Data);
    elseif(isset($Data['game'])):
      return new TgGameEdited($Data);
    elseif(isset($Data['location'])):
      return new TgLocationEdited($Data);
    elseif(isset($Data['new_chat_members']))://?
      return new TgMemberNew($Data);
    elseif(isset($Data['photo'])):
      return new TgPhotoEdited($Data);
    elseif(isset($Data['poll'])):
      return new TgPollEdited($Data);
    elseif(isset($Data['sticker'])):
      return new TgStickerEdited($Data);
    elseif(isset($Data['text'])):
      return new TgTextEdited($Data);
    elseif(isset($Data['video'])):
      return new TgVideoEdited($Data);
    elseif(isset($Data['video_note'])):
      return new TgVideoNoteEdited($Data);
    elseif(isset($Data['voice'])):
      return new TgVoiceEdited($Data);
    else:
      return null;
    endif;
  }

  /**
   * @throws TblException
   */
  public static function DetectUpdate(
    array $Data
  ):object{
    if(isset($Data['message'])):
      return self::DetectMessage($Data['message']);
    elseif(isset($Data['edited_message'])):
      return self::DetectMessageEdited($Data['edited_message']);
    elseif(isset($Data['channel_post'])):
      return self::DetectMessage($Data['channel_post']);
    elseif(isset($Data['edited_channel_post'])):
      return self::DetectMessageEdited($Data['edited_channel_post']);
    elseif(isset($Data['business_message'])):
      return self::DetectMessage($Data['business_message']);
    elseif(isset($Data['edited_business_message'])):
      return self::DetectMessageEdited($Data['business_message']);
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
    elseif(isset($Data['gift'])):
      return new TgGiftInfo($Data['gift']);
    elseif(isset($Data['unique_gift'])):
      return new TgGiftUniqueInfo($Data['unique_gift']);
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
    elseif(isset($Data['paid_message_price_changed'])):
      return new TgPaidMessagePriceChanged($Data['paid_message_price_changed']);
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
    else:
      throw new TblException(TblError::UnknownUpdate, 'Unknown update');
    endif;
  }

  protected static function DirCreate(
    string $Dir,
    int $Perm = 0755,
    bool $Recursive = true
  ):bool{
    if(is_dir($Dir)):
      return false;
    else:
      return mkdir($Dir, $Perm, $Recursive);
    endif;
  }

  public static function Log(
    TblData $BotData,
    TblLogInterface $Type,
    string|array $Msg,
    object|null $Msg2 = null,
    bool $SkipLogHandler = false
  ):void{
    //Prevent infinite loop
    $funcs = array_column(debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS), 'function');
    unset($funcs[0]);
    if(array_search(__FUNCTION__, $funcs) !== false):
      return;
    endif;
    //Must be logged?
    if(in_array($Type, $BotData->Log) === false):
      return;
    endif;
    //Log handler
    if($BotData->LogHandler !== null
    and $SkipLogHandler === false):
      call_user_func_array($BotData->LogHandler, func_get_args());
      return;
    endif;
    if(is_string($Msg) === false):
      $Msg = json_encode(
        $Msg,
        JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
      );
    endif;
    $log = date('Y-m-d H:i:s') . PHP_EOL;
    $log .= $Msg . PHP_EOL;
    if($Type === TblLog::Send
    or $Type === TblLog::Response):
      $file = TblLog::Send->name;
    elseif($Type === TblLog::Webhook
    or $Type === TblLog::WebhookObject):
      $file = TblLog::Webhook->name;
    else:
      $file = $Type->name;
    endif;
    $file = $BotData->DirLogs . '/' . $file . '.log';
    self::DirCreate(dirname($file));
    file_put_contents($file, $log, FILE_APPEND);
  }

  /**
   * @param bool $AsJson Send the data as application/json or multipart/form-data. Use the second one to send files
   * @throws TblException
   */
  protected function ServerMethod(
    TgMethods $Method,
    array|null $Params = null,
    bool $AsJson = true
  ):mixed{
    $curl = $this->BotData->UrlApi . '/' . $Method->value;
    if(in_array(TblLog::Send, $this->BotData->Log)):
      $log = 'Url: ' . $curl . PHP_EOL;
      $log .= 'Params: ' . json_encode(
        $Params,
        JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
      );
      $log = str_replace('<', '&lt;', $log);
    endif;
    $curl = $this->Curl($curl, $Params, $AsJson);
    $return = curl_exec($curl);
    if($return === false):
      $temp = 'cURL error #' . curl_errno($curl) . ' ' . curl_error($curl);
      $this->Log($this->BotData, TblLog::Curl, $temp);
      throw new TblException(TblError::Curl, $temp);
    endif;
    $return = $this->CurlResponse($curl, $log ?? null);
    if(is_object($return)):
      throw $return;
    else:
      return $return;
    endif;
  }

  /**
   * Use the cURL multi resource to send many messages at once. This method are now public. See the parameters in each method or in official documentation
   */
  public function ServerMethodMulti(
    TgMethods $Method,
    array $Params
  ):array{
    $MultiLog = [];
    $mh = curl_multi_init();
    $url = $this->BotData->UrlApi . '/' . $Method->value;
    foreach($Params as $id => &$params):
      if(in_array(TblLog::Send, $this->BotData->Log)):
        $log = 'Url: ' . $url . PHP_EOL;
        $log .= 'Params: ' . json_encode(
          $params,
          JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
        );
        $MultiLog[$id] = $log;
      endif;
      $params = $this->Curl($url, $params);
      curl_multi_add_handle($mh, $params);
    endforeach;
    do{
      curl_multi_exec($mh, $active);
      curl_multi_select($mh);
    }while($active > 0);
    foreach($Params as $id => &$params):
      $params = $this->CurlResponse($params, $MultiLog[$id]);
    endforeach;
    return $Params;
  }
}