<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TblObjects;
use Closure;

/**
 * @version 2024.01.04.00
 */
final readonly class TblData{
  public string $UrlApi;
  public string $UrlFiles;

  public function __construct(
    string $Token,
    public string $DirLogs,
    public string|null $TokenWebhook = null,
    public int $Log = TblLog::None,
    bool $TestServer = false,
    public Closure|string|null $LogHandler = null
  ){
    if($TestServer):
      $temp = '/test';
    else:
      $temp = '';
    endif;
    $this->UrlApi = 'https://api.telegram.org/bot' . $Token . $temp;
    $this->UrlFiles = 'https://api.telegram.org/file/bot' . $Token . $temp;
  }
}