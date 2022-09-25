<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.09.25.00

namespace ProtocolLive\TelegramBotLibrary;
use \CurlHandle;
use ProtocolLive\TelegramBotLibrary\TblObjects\{TblData, TblError, TblLog, TblException};
use ProtocolLive\TelegramBotLibrary\TgObjects\{TgMethods, TgErrors};

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
}