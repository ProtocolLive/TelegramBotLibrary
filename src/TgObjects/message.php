<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.03.06.00

/**
 * @link https://core.telegram.org/bots/api#formatting-options
 */
enum TgParseMode:string{
  /**
   * @link https://core.telegram.org/bots/api#markdownv2-style
   */
  case Markdown2 = 'MarkdownV2';
  /**
   * @link https://core.telegram.org/bots/api#html-style
   */
  case Html = 'HTML';
  /**
   * @link https://core.telegram.org/bots/api#markdown-style
   */
  case Markdown = 'Markdown';
}

abstract class TgMessage{
  public readonly int $Id;
  public readonly TgUser|TgChat $User;
  public readonly TgChat $Chat;
  public readonly int $Date;
  public readonly bool $Protected;
  public readonly TgChat|null $ChatFrom;
  public readonly int|null $ForwardId;
  public readonly bool|null $ForwardAuto;
  public readonly int|null $ForwardDate;

  //The bot 777000 is used to forward messages from channels to groups
  //The bot 1087968824 is used for admins post as the group and for migrate events
  protected function __construct(array $Data){
    $this->Id = $Data['message_id'];
    if($Data['from']['id'] === 777000): //Telegram
      $this->User = new TgChat($Data['sender_chat']);
      $this->ChatFrom = new TgChat($Data['forward_from_chat']);
      $this->ForwardId = $Data['forward_from_message_id'];
      $this->ForwardAuto = $Data['is_automatic_forward'];
      $this->ForwardDate = $Data['forward_date'];
    elseif($Data['from']['id'] === 1087968824): //GroupAnonymousBot
      $this->User = new TgChat($Data['sender_chat']);
      $this->ChatFrom = null;
      $this->ForwardId = null;
      $this->ForwardAuto = null;
      $this->ForwardDate = null;
    else:
      $this->User = new TgUser($Data['from']);
      $this->ChatFrom = null;
      $this->ForwardId = null;
      $this->ForwardAuto = null;
      $this->ForwardDate = null;
    endif;
    $this->Chat = new TgChat($Data['chat']);
    $this->Date = $Data['date'];
    $this->Protected = $Data['has_protected_content'] ?? false;
  }
}