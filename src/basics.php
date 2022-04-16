<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.04.16.00

abstract class TblBasics{
  protected TblData $BotData;
  public TblError|TgError|null $Error = null;
  public string|null $ErrorStr = null;

  protected function ServerMethod(
    string $Msg
  ):mixed{
    $temp = $this->BotData->UrlApi . '/' . $Msg;
    if(($this->BotData->Debug & TblDebug::Send) === TblDebug::Send):
      $this->DebugLog(TblLog::Send, $temp);
    endif;
    $curl = curl_init($temp);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_USERAGENT, 'Protocol SimpleTelegramBot');
    curl_setopt($curl, CURLOPT_CAINFO, __DIR__ . '/cacert.pem');
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
    if(($this->BotData->Debug & TblDebug::Response) === TblDebug::Response):
      $this->DebugLog(TblLog::Response, json_encode($temp, JSON_PRETTY_PRINT));
    endif;
    if($temp['ok'] === false):
      $this->ErrorStr = $temp['description'];
      $search = TgErrors::Search($temp['description']);
      if($search === false):
        $this->Error = TblError::Custom;
      else:
        $this->Error = $search;
      endif;
      return null;
    else:
      $this->ErrorStr = $temp['description'] ?? null;
      return $temp['result'];
    endif;
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
    $log .= "\n" . $Msg;
    if($Type === TblLog::Error):
      error_log($log);
    else:
      $file = $this->BotData->DirLogs . '/class.log';
      $log .= "\n";
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