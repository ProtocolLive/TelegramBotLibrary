<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2023.01.15.01

namespace ProtocolLive\TelegramBotLibrary;
use CurlHandle;
use ProtocolLive\TelegramBotLibrary\TblObjects\{
  TblCmd,
  TblData,
  TblError,
  TblException,
  TblLog,
  TblServerMulti
};
use ProtocolLive\TelegramBotLibrary\TgObjects\{
  TgChatAutoDel,
  TgChatMigrateFrom,
  TgChatMigrateTo,
  TgChatTitle,
  TgDocument,
  TgEntityType,
  TgErrors,
  TgForumClosed,
  TgForumCreated,
  TgForumReopened,
  TgInvoice,
  TgInvoiceDone,
  TgLocation,
  TgMemberLeft,
  TgMemberNew,
  TgMethods,
  TgPassport,
  TgPhoto,
  TgPinnedMsg,
  TgPoll,
  TgSticker,
  TgText,
  TgVideo,
  TgVideoChatEnded,
  TgVideoChatInvite,
  TgVideoChatScheduled,
  TgVideoChatStarted,
  TgVoice,
  TgWebappData
};

abstract class TblBasics{
  protected TblData $BotData;

  private function Curl(
    string $Url,
    array $Params = null
  ):CurlHandle{
    $curl = curl_init($Url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_USERAGENT, 'Protocol TelegramBotLibrary');
    curl_setopt($curl, CURLOPT_CAINFO, __DIR__ . '/cacert.pem');
    curl_setopt($curl, CURLOPT_POSTFIELDS, $Params);
    if($this->BotData->Log & TblLog::Curl):
      curl_setopt($curl, CURLOPT_VERBOSE, true);
      curl_setopt($curl, CURLOPT_STDERR, fopen($this->BotData->DirLogs . '/curl.log', 'a'));
    endif;
    return $curl;
  }

  private function CurlResponse(
    CurlHandle $Curl,
  ):array|bool|TblException{
    $response = curl_multi_getcontent($Curl);
    $response = json_decode($response, true);
    if($this->BotData->Log & TblLog::Response):
      $this->Log(
        TblLog::Response,
        json_encode(
          $response,
          JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
        )
      );
    endif;
    if($response['ok'] === false):
      $search = TgErrors::Search($response['description']);
      if($search === false):
        return new TblException(TblError::Custom, $response['description']);
      else:
        return new TblException($search, $response['description']);
      endif;
    else:
      return $response['result'];
    endif;
  }

  public static function DetectMessage(
    array $Data
  ):object|null{
    if(isset($Data['entities'][0])
    and $Data['entities'][0]['type'] === TgEntityType::Command->value
    and $Data['entities'][0]['offset'] === 0):
      return new TblCmd($Data);
    elseif(isset($Data['document'])):
      return new TgDocument($Data);
    elseif(isset($Data['forum_topic_closed'])):
      return new TgForumClosed($Data);
    elseif(isset($Data['forum_topic_created'])):
      return new TgForumCreated($Data);
    elseif(isset($Data['forum_topic_reopened'])):
      return new TgForumReopened($Data);
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
    elseif(isset($Data['video'])):
      return new TgVideo($Data);
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

  protected function Log(
    int $Type,
    string $Msg
  ):void{
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
   * Use the cURL multi resource to send many messages at once. All messages have to use the same method.
   */
  protected function ServerMethodMulti(
    TgMethods $Method,
    TblServerMulti $Params
  ):array{
    $mh = curl_multi_init();
    $return = $Params->GetArray();
    foreach($return as &$params):
      $url = $this->BotData->UrlApi . '/' . $Method->value;
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
    foreach($return as &$params):
      $params = $this->CurlResponse($params);
    endforeach;
    return $return;
  }
}