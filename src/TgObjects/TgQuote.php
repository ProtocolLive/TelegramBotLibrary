<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * This object contains information about the quoted part of a message that is replied to by the given message.
 * @link https://core.telegram.org/bots/api#textquote
 * @version 2023.12.29.00
 */
class TgQuote{
  /**
   * Text of the quoted part of a message that is replied to by the given message
   */
  public readonly string $Text;
  /**
   * Optional. Special entities that appear in the quote. Currently, only bold, italic, underline, strikethrough, spoiler, and custom_emoji entities are kept in quotes.
   */
  public array $Entities = [];
  /**
   * Approximate quote position in the original message in UTF-16 code units as specified by the sender
   */
  public readonly int $Position;
  /**
   * True, if the quote was chosen manually by the message sender. Otherwise, the quote was added automatically by the server.
   */
  public readonly bool $Manual;

  public function __construct(
    array $Data
  ){
    $this->Text = $Data['text'];
    if(isset($Data['entities'])):
      foreach($Data['entities'] as $entity):
        $this->Entities[] = new TgEntity($entity);
      endforeach;
    endif;
    $this->Position = $Data['position'];
    $this->Manual = $Data['is_manual'];
  }
}