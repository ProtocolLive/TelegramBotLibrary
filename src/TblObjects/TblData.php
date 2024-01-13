<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TblObjects;

/**
 * @version 2024.01.13.00
 */
final readonly class TblData{
  public string $UrlApi;
  public string $UrlFiles;
  public object|string|array|null $LogHandler;

  public function __construct(
    string $Token,
    public string $DirLogs,
    public string|null $TokenWebhook = null,
    public int $Log = TblLog::None,
    bool $TestServer = false,
    callable $LogHandler = null
  ){
    if($TestServer):
      $temp = '/test';
    else:
      $temp = '';
    endif;
    $this->UrlApi = 'https://api.telegram.org/bot' . $Token . $temp;
    $this->UrlFiles = 'https://api.telegram.org/file/bot' . $Token . $temp;
    $this->LogHandler = $LogHandler;
  }
}