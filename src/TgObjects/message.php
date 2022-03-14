<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.03.14.00

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

/**
 * https://core.telegram.org/bots/api#sendchataction
 */
enum TgChatAction:string{
  case Typing = 'typing';
  case Photo = 'upload_photo';
  case Video = 'upload_video';
  case VideoRecord = 'record_video';
  case Voice = 'upload_voice';
  case VoiceRecord = 'record_voice';
  case Document = 'upload_document';
  case Sticker = 'choose_sticker';
  case Location = 'find_location';
  case VideoNote = 'upload_video_note';
  case VideoNoteRecord = 'record_video_note';
}

class TgMessage{
  public readonly int $MessageId;
  public readonly TgUser|TgChat $User;
  public readonly TgChat $Chat;
  public readonly int $Date;
  public readonly bool $Protected;
  public readonly TgUser|TgChat|null $ForwardFrom;
  public readonly int|null $ForwardId;
  public readonly bool|null $ForwardAuto;
  public readonly int|null $ForwardDate;

  //The bot 777000 is used to forward messages from channels to groups
  //The bot 1087968824 is used for admins post as the group and for migrate events
  protected function __construct(array $Data){
    $this->MessageId = $Data['message_id'];
    if($Data['from']['id'] === 777000): //Telegram
      $this->User = new TgChat($Data['sender_chat']);
      $this->ForwardFrom = new TgChat($Data['forward_from_chat']);
      $this->ForwardId = $Data['forward_from_message_id'];
      $this->ForwardAuto = $Data['is_automatic_forward'];
    elseif($Data['from']['id'] === 1087968824): //GroupAnonymousBot
      $this->User = new TgChat($Data['sender_chat']);
      $this->ForwardFrom = null;
      $this->ForwardId = null;
      $this->ForwardAuto = null;
    else:
      $this->User = new TgUser($Data['from']);
      if(isset($Data['forward_from'])):
        $this->ForwardFrom = new TgUser($Data['forward_from']);
      else:
        $this->ForwardFrom = null;
      endif;
      $this->ForwardId = null;
      $this->ForwardAuto = null;
    endif;
    $this->Chat = new TgChat($Data['chat']);
    $this->Date = $Data['date'];
    $this->ForwardDate = $Data['forward_date'] ?? null;
    $this->Protected = $Data['has_protected_content'] ?? false;
  }
}