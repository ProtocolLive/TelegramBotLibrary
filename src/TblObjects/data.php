<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.04.22.01

class TblData{
  public readonly string $UrlApi;
  public readonly string $UrlFiles;
  public readonly int $Debug;
  public readonly string $DirLogs;

  public function __construct(
    string $Token,
    string $DirLogs,
    int $Debug = TblDebug::None,
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
    $this->Debug = $Debug;
  }
}