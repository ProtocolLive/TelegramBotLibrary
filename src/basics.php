<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.07.17.00
//API 6.2

abstract class TblBasics{
  protected TblData $BotData;
  public TblError|TgError|null $Error = null;
  public string|null $ErrorStr = null;

  private function Curl(string $Url, array $Params = null):CurlHandle|false{
    $curl = curl_init($Url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_USERAGENT, 'Protocol TelegramBotLibrary');
    curl_setopt($curl, CURLOPT_CAINFO, __DIR__ . '/cacert.pem');
    curl_setopt($curl, CURLOPT_POSTFIELDS, $Params);
    if($this->BotData->Debug & TblDebug::Curl):
      curl_setopt($curl, CURLOPT_VERBOSE, true);
      curl_setopt($curl, CURLOPT_STDERR, fopen($this->BotData->DirLogs . '/curl.log', 'a'));
    endif;
    return $curl;
  }

  private function CurlResponse(
    CurlHandle $Curl,
  ):mixed{
    $response = curl_multi_getcontent($Curl);
    if($response === false):
      $this->DebugLog(
        TblLog::Error,
        'cURL error #' . curl_errno($Curl) . ' ' . curl_error($Curl)
      );
      $this->Error = TblError::Curl;
      return null;
    endif;
    $response = json_decode($response, true);
    if($this->BotData->Debug & TblDebug::Response):
      $this->DebugLog(TblLog::Response, json_encode($response, JSON_PRETTY_PRINT));
    endif;
    if($response['ok'] === false):
      $this->ErrorStr = $response['description'];
      $search = TgErrors::Search($response['description']);
      if($search === false):
        $this->Error = TblError::Custom;
      else:
        $this->Error = $search;
      endif;
      return null;
    else:
      $this->ErrorStr = $response['description'] ?? null;
      return $response['result'];
    endif;
  }

  protected function ServerMethod(
    TgMethods $Method,
    array $Params = null
  ):mixed{
    $curl = $this->BotData->UrlApi . '/' . $Method->value;
    if($this->BotData->Debug & TblDebug::Send):
      $log = 'Url: ' . $curl . PHP_EOL;
      $log .= 'Params: ' . json_encode($Params, JSON_PRETTY_PRINT);
      $log = str_replace('<', '&lt;', $log);
      $this->DebugLog(TblLog::Send, $log);
    endif;
    $curl = $this->Curl($curl, $Params);
    return $this->CurlResponse($curl, curl_exec($curl));
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
      if($this->BotData->Debug & TblDebug::Send):
        $log = 'Url: ' . $curl . PHP_EOL;
        $log .= 'Params: ' . json_encode($Params, JSON_PRETTY_PRINT);
        $this->DebugLog(TblLog::Send, $log);
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
      $temp = $this->CurlResponse($calls[$id]);
      if($this->Error === null):
        $return[$id] = $temp;
      else:
        $return[$id] = ['Error' => $this->Error, $this->ErrorStr];
      endif;
    endforeach;
    return $return;
  }

  protected function DebugLog(TblLog $Type, string $Msg):void{
    $log = date('Y-m-d H:i:s') . ' - ';
    if($Type === TblLog::Webhook):
      $log .= 'Webhook';
    elseif($Type === TblLog::Send):
      $log .= 'Send';
    elseif($Type === TblLog::Response):
      $log .= 'Send response';
    endif;
    $log .= PHP_EOL . $Msg . PHP_EOL;
    if($Type === TblLog::Error):
      error_log($log);
    else:
      $file = $this->BotData->DirLogs . '/class.log';
      $log .= PHP_EOL;
      if(is_file($file) === false):
        $this->DirCreate(dirname($file));
      endif;
      file_put_contents($file, $log, FILE_APPEND);
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
}