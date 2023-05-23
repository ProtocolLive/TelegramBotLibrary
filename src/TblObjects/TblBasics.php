<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TblObjects;
use CurlHandle;
use ProtocolLive\TelegramBotLibrary\TgObjects\{
  TgAnimation,
  TgAnimationEdited,
  TgChatAutoDel,
  TgChatMigrateFrom,
  TgChatMigrateTo,
  TgChatPhotoNew,
  TgChatShared,
  TgChatTitle,
  TgContact,
  TgDocument,
  TgDocumentEdited,
  TgEntityType,
  TgErrors,
  TgForumClosed,
  TgForumCreated,
  TgForumReopened,
  TgGroupCreated,
  TgInvoice,
  TgInvoiceDone,
  TgLocation,
  TgMemberLeft,
  TgMemberNew,
  TgMethods,
  TgPassport,
  TgPhoto,
  TgPhotoEdited,
  TgPinnedMsg,
  TgPoll,
  TgSticker,
  TgText,
  TgTextEdited,
  TgUserShared,
  TgVideo,
  TgVideoChatEnded,
  TgVideoChatInvite,
  TgVideoChatScheduled,
  TgVideoChatStarted,
  TgVideoEdited,
  TgVideoNote,
  TgVoice,
  TgWebappData
};

/**
 * @version 2023.05.23.01
 */
abstract class TblBasics{
  protected TblData $BotData;

  private function Curl(
    string $Url,
    array $Params = null
  ):CurlHandle{
    $curl = curl_init($Url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_USERAGENT, 'Protocol TelegramBotLibrary');
    curl_setopt($curl, CURLOPT_CAINFO, dirname(__DIR__) . '/cacert.pem');
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($Params));
    curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    if($this->BotData->Log & TblLog::Curl):
      curl_setopt($curl, CURLOPT_VERBOSE, true);
      curl_setopt($curl, CURLOPT_STDERR, fopen($this->BotData->DirLogs . '/curl.log', 'a'));
    endif;
    return $curl;
  }

  private function CurlResponse(
    CurlHandle $Curl,
  ):array|bool|TblException{
    $error = null;
    $response = curl_multi_getcontent($Curl);
    $json = json_decode($response, true);
    if(json_last_error() > 0):
      $error = 'Json error: ' . json_last_error_msg() . PHP_EOL;
      $error .= 'Response: ' . $response;
    endif;
    if($this->BotData->Log & TblLog::Response):
      $this->Log(
        TblLog::Response,
        json_encode(
          $error === null ? $json : $error,
          JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
        )
      );
    endif;
    if($error !== null):
      return new TblException(TblError::JsonError, $error);
    elseif($json['ok'] === false):
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
    array $Data
  ):object|null{
    if(isset($Data['entities'][0])
    and $Data['entities'][0]['type'] === TgEntityType::Command->value
    and $Data['entities'][0]['offset'] === 0):
      return new TblCmd($Data);
    elseif(isset($Data['animation'])):
      return new TgAnimation($Data);
    elseif(isset($Data['chat_shared'])):
      return new TgChatShared($Data);
    elseif(isset($Data['contact'])):
      return new TgContact($Data);
    elseif(isset($Data['document'])):
      return new TgDocument($Data);
    elseif(isset($Data['forum_topic_closed'])):
      return new TgForumClosed($Data);
    elseif(isset($Data['forum_topic_created'])):
      return new TgForumCreated($Data);
    elseif(isset($Data['forum_topic_reopened'])):
      return new TgForumReopened($Data);
    elseif(isset($Data['group_chat_created'])):
      return new TgGroupCreated($Data);
    elseif(isset($Data['invoice'])):
      return new TgInvoice($Data);
    elseif(isset($Data['left_chat_member'])):
      return new TgMemberLeft($Data);
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
    elseif(isset($Data['passport_data'])):
      return new TgPassport($Data);
    elseif(isset($Data['photo'])):
      return new TgPhoto($Data);
    elseif(isset($Data['pinned_message'])):
      return new TgPinnedMsg($Data);
    elseif(isset($Data['poll'])):
      return new TgPoll($Data);
    elseif(isset($Data['successful_payment'])):
      return new TgInvoiceDone($Data);
    elseif(isset($Data['sticker'])):
      return new TgSticker($Data);
    elseif(isset($Data['text'])):
      return new TgText($Data);
    elseif(isset($Data['user_shared'])):
      return new TgUserShared($Data);
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
    elseif(isset($Data['photo'])):
      return new TgPhotoEdited($Data);
    elseif(isset($Data['text'])):
      return new TgTextEdited($Data);
    elseif(isset($Data['video'])):
      return new TgVideoEdited($Data);
    else:
      return null;
    endif;
  }

  protected function DirCreate(
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

  /**
   * Check if a message can be forwarded or copied. (Beta)
   */
  public static function Forwardable(
    object $Object
  ):bool{
    $false = [
      TgChatAutoDel::class,
      TgMemberNew::class,
      TgMemberLeft::class,
      TgPhotoEdited::class,
    ];
    return in_array(get_class($Object), $false) === false;
  }

  protected function Log(
    int $Type,
    string $Msg
  ):void{
    if($this->BotData->LogHandler !== null):
      call_user_func($this->BotData->LogHandler, func_get_args());
      return;
    endif;
    $log = date('Y-m-d H:i:s') . PHP_EOL;
    $log .= $Msg . PHP_EOL;
    if($Type === TblLog::Send):
      $file = 'send';
    elseif($Type === TblLog::Response):
      $file = 'send';
    elseif($Type === TblLog::Webhook):
      $file = 'webhook';
    elseif($Type === TblLog::Curl):
      $file = 'curl';
    endif;
    $file = $this->BotData->DirLogs . '/' . $file . '.log';
    $this->DirCreate(dirname($file));
    file_put_contents($file, $log, FILE_APPEND);
  }

  /**
   * @throws TblException
   */
  protected function ServerMethod(
    TgMethods $Method,
    array $Params = null
  ):mixed{
    $curl = $this->BotData->UrlApi . '/' . $Method->value;
    if($this->BotData->Log & TblLog::Send):
      $log = 'Url: ' . $curl . PHP_EOL;
      $log .= 'Params: ' . json_encode(
        $Params,
        JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
      );
      $log = str_replace('<', '&lt;', $log);
      $this->Log(TblLog::Send, $log);
    endif;
    $curl = $this->Curl($curl, $Params);
    $return = curl_exec($curl);
    if($return === false):
      $temp = 'cURL error #' . curl_errno($curl) . ' ' . curl_error($curl);
      $this->Log(TblLog::Curl, $temp);
      throw new TblException(TblError::Curl, $temp);
    endif;
    $return = $this->CurlResponse($curl);
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
    $mh = curl_multi_init();
    $url = $this->BotData->UrlApi . '/' . $Method->value;
    foreach($Params as &$params):
      if($this->BotData->Log & TblLog::Send):
        $log = 'Url: ' . $url . PHP_EOL;
        $log .= 'Params: ' . json_encode(
          $params,
          JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
        );
        $this->Log(TblLog::Send, $log);
      endif;
      $params = $this->Curl($url, $params);
      curl_multi_add_handle($mh, $params);
    endforeach;
    do{
      curl_multi_exec($mh, $active);
      curl_multi_select($mh);
    }while($active);
    /** @var CurlHandle[] $return */
    foreach($Params as &$params):
      $params = $this->CurlResponse($params);
    endforeach;
    return $Params;
  }
}