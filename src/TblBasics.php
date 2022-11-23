<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.11.23.00

namespace ProtocolLive\TelegramBotLibrary;
use CurlHandle;
use ProtocolLive\TelegramBotLibrary\TblObjects\TblCmd;
use ProtocolLive\TelegramBotLibrary\TblObjects\TblData;
use ProtocolLive\TelegramBotLibrary\TblObjects\TblError;
use ProtocolLive\TelegramBotLibrary\TblObjects\TblException;
use ProtocolLive\TelegramBotLibrary\TblObjects\TblLog;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgChatAutoDel;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgChatMigrateFrom;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgChatMigrateTo;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgChatTitle;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgDocument;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgEntityType;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgErrors;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgForumClosed;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgForumCreated;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgForumReopened;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgInvoice;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgInvoiceDone;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgLocation;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgMemberLeft;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgMemberNew;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgMethods;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgPassport;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgPhoto;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgPinnedMsg;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgPoll;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgSticker;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgText;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgVideo;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgVoice;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgWebappData;

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
    \CurlHandle $Curl,
  ):mixed{
    $response = curl_multi_getcontent($Curl);
    $response = json_decode($response, true);
    if($this->BotData->Log & TblLog::Response):
      $this->Log(TblLog::Response, json_encode($response, JSON_PRETTY_PRINT));
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
      $log .= 'Params: ' . json_encode($Params, JSON_PRETTY_PRINT);
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
   * @param array $ParamGroups Array with array os parameters
   */
  protected function ServerMethodMulti(
    TgMethods $Method,
    array $ParamGroups
  ):array{
    $mh = curl_multi_init();
    $calls = [];
    foreach($ParamGroups as $id => $Params):
      $curl = $this->BotData->UrlApi . '/' . $Method->value;
      if($this->BotData->Log & TblLog::Send):
        $log = 'Url: ' . $curl . PHP_EOL;
        $log .= 'Params: ' . json_encode($Params, JSON_PRETTY_PRINT);
        $this->Log(TblLog::Send, $log);
      endif;
      $calls[$id] = $this->Curl($curl, $Params);
      curl_multi_add_handle($mh, $calls[$id]);
    endforeach;
    do{
      curl_multi_exec($mh, $active);
      curl_multi_select($mh);
    }while($active);
    $return = [];
    foreach($ParamGroups as $id => $Params):
      $return[$id] = $this->CurlResponse($calls[$id]);
    endforeach;
    return $return;
  }
}