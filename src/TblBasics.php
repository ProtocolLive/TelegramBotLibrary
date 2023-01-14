<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2023.01.14.01

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
    return match($Data){
      isset($Data['entities'][0])
      and $Data['entities'][0]['type'] === TgEntityType::Command->value
      and $Data['entities'][0]['offset'] === 0
        => new TblCmd($Data),
      isset($Data['document']) => new TgDocument($Data),
      isset($Data['forum_topic_closed']) => new TgForumClosed($Data),
      isset($Data['forum_topic_created']) => new TgForumCreated($Data),
      isset($Data['forum_topic_reopened']) => new TgForumReopened($Data),
      isset($Data['invoice']) => new TgInvoice($Data),
      isset($Data['left_chat_member']) => new TgMemberLeft($Data),
      isset($Data['location']) => new TgLocation($Data),
      isset($Data['message_auto_delete_timer_changed']) => new TgChatAutoDel($Data),
      isset($Data['migrate_from_chat_id']) => new TgChatMigrateFrom($Data),
      isset($Data['migrate_to_chat_id']) => new TgChatMigrateTo($Data),
      isset($Data['new_chat_member']) => new TgMemberNew($Data),
      isset($Data['new_chat_title']) => new TgChatTitle($Data),
      isset($Data['passport_data']) => new TgPassport($Data),
      isset($Data['photo']) => new TgPhoto($Data),
      isset($Data['pinned_message']) => new TgPinnedMsg($Data),
      isset($Data['poll']) => new TgPoll($Data),
      isset($Data['sticker']) => new TgSticker($Data),
      isset($Data['successful_payment']) => new TgInvoiceDone($Data),
      isset($Data['text']) => new TgText($Data),
      isset($Data['video']) => new TgVideo($Data),
      isset($Data['video_chat_ended']) => new TgVideoChatEnded($Data),
      isset($Data['video_chat_participants_invited']) => new TgVideoChatInvite($Data),
      isset($Data['video_chat_scheduled']) => new TgVideoChatScheduled($Data),
      isset($Data['video_chat_started']) => new TgVideoChatStarted($Data),
      isset($Data['voice']) => new TgVoice($Data),
      isset($Data['web_app_data']) => new TgWebappData($Data),
      default => null
    };
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
    foreach($return as &$params):
      $params = $this->CurlResponse($params);
    endforeach;
    return $return;
  }
}