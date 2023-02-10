<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2023.02.10.00

namespace ProtocolLive\TelegramBotLibrary\TblObjects;
use Closure;

final class TblData{
  public readonly string $UrlApi;
  public readonly string $UrlFiles;

  public function __construct(
    string $Token,
    public readonly string $DirLogs,
    public readonly string|null $TokenWebhook = null,
    public readonly int $Log = TblLog::None,
    bool $TestServer = false,
    public readonly Closure|string|null $LogHandler = null
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