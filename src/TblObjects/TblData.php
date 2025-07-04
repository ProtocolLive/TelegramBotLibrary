<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TblObjects;
use ProtocolLive\TelegramBotLibrary\TblEnums\TblError;
use SensitiveParameter;

/**
 * @version 2025.07.04.00
 */
final readonly class TblData{
  public string $UrlApi;
  public string $UrlFiles;
  public object|string|array|null $LogHandler;

  /**
   * @throws TblException
   */
  public function __construct(
    #[SensitiveParameter] string $Token,
    public string $DirLogs,
    #[SensitiveParameter] public string|null $TokenWebhook = null,
    public array $Log = [],
    bool $TestServer = false,
    callable|null $LogHandler = null //Not promoted because types
  ){
    if($TestServer):
      $temp = '/test';
    else:
      $temp = '';
    endif;
    $this->UrlApi = 'https://api.telegram.org/bot' . $Token . $temp;
    $this->UrlFiles = 'https://api.telegram.org/file/bot' . $Token . $temp;
    $this->LogHandler = $LogHandler;
    if($TokenWebhook !== null):
      if(preg_match('/^[a-zA-z0-9_-]{1,256}$/', $TokenWebhook) === false):
        throw new TblException(
          TblError::TokenWebhook,
          'Token must be alphanumeric and between 1 and 256 characters long'
        );
      endif;
    endif;
  }
}