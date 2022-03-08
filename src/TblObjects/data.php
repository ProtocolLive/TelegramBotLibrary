<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.03.05.00

class TblData{
  public readonly string $UrlApi;
  public readonly string $UrlFiles;
  public readonly int $Debug;
  public readonly string $DirLogs;

  public function __construct(
    string $Token,
    string $DirLogs,
    int $Debug = TblDebug::None
  ){
    $this->UrlApi = 'https://api.telegram.org/bot' . $Token;
    $this->UrlFiles = 'https://api.telegram.org/file/bot' . $Token;
    $this->DirLogs = $DirLogs;
    $this->Debug = $Debug;
  }
}