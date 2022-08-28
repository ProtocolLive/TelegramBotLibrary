<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.08.28.00

namespace ProtocolLive\TelegramBotLibrary\TblObjects;

class TblData{
  public readonly string $UrlApi;
  public readonly string $UrlFiles;
  public readonly int $Log;
  public readonly string $DirLogs;
  public readonly string|null $TokenWebhook;

  public function __construct(
    string $Token,
    string $DirLogs,
    string $TokenWebhook = null,
    int $Log = TblLog::None,
    bool $TestServer = false
  ){
    if($TestServer):
      $temp = '/test';
    else:
      $temp = '';
    endif;
    $this->UrlApi = 'https://api.telegram.org/bot' . $Token . $temp;
    $this->UrlFiles = 'https://api.telegram.org/file/bot' . $Token . $temp;
    $this->DirLogs = $DirLogs;
    $this->Log = $Log;
    $this->TokenWebhook = $TokenWebhook;
  }
}