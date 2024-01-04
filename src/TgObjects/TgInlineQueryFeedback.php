<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * @link https://core.telegram.org/bots/api#choseninlineresult
 * @version 2024.01.04.00
 */
final readonly class TgInlineQueryFeedback{
  public TgUser $User;
  public string $Text;
  public string $Choose;

  public function __construct(
    array $Data
  ){
    $this->User = new TgUser($Data['from']);
    $this->Text = $Data['query'];
    $this->Choose = $Data['result_id'];
  }
}