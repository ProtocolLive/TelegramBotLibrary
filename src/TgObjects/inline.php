<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.04.19.01

/**
 * This object represents an incoming inline query. When the user sends an empty query, your bot could return some default or trending results.
 * @link https://core.telegram.org/bots/api#inlinequery
 */
class TgInlineQuery{
  public readonly string $Id;
  public readonly TgUser $User;
  public readonly TgChatType $ChatType;
  public readonly string $Text;
  public readonly string $Offset;

  /**
   * @link https://core.telegram.org/bots/api#inlinequery
   */
  public function __construct(array $Data){
    $this->Id = $Data['id'];
    $this->User = new TgUser($Data['from']);
    $this->ChatType = TgChatType::tryFrom($Data['chat_type']);
    $this->Text = $Data['query'];
    $this->Offset = $Data['offset'];
  }
}

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