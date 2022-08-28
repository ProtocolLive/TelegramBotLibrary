<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.08.18.00

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * @link https://core.telegram.org/bots/api#choseninlineresult
 */
class TgInlineQueryFeedback{
  public readonly TgUser $User;
  public readonly string $Text;
  public readonly string $Choose;

  public function __construct(array $Data){
    $this->User = new TgUser($Data['from']);
    $this->Text = $Data['query'];
    $this->Choose = $Data['result_id'];
  }
}