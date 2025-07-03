<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TgAuxiliary\TgEntity;

/**
 * This object contains information about the quoted part of a message that is replied to by the given message.
 * @link https://core.telegram.org/bots/api#textquote
 * @version 2025.07.03.01
 */
final readonly class TgQuote{
  /**
   * Text of the quoted part of a message that is replied to by the given message
   */
  public string $Text;
  /**
   * Optional. Special entities that appear in the quote. Currently, only bold, italic, underline, strikethrough, spoiler, and custom_emoji entities are kept in quotes.
   */
  public array $Entities;
  /**
   * Approximate quote position in the original message in UTF-16 code units as specified by the sender
   */
  public int $Position;
  /**
   * True, if the quote was chosen manually by the message sender. Otherwise, the quote was added automatically by the server.
   */
  public bool $Manual;

  public function __construct(
    array $Data
  ){
    $this->Text = $Data['text'];
    $this->Position = $Data['position'];
    $this->Manual = $Data['is_manual'] ?? false;

    foreach($Data['entities'] ?? [] as &$entity):
      $entity = new TgEntity($entity);
    endforeach;
    $this->Entities = $Data['entities'] ?? [];
  }
}