<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TgInterfaces\TgEditedInterface;

/**
 * @link https://core.telegram.org/bots/api#animation
 * @version 2024.02.08.00
 */
final readonly class TgAnimationEdited
extends TgAnimation
implements TgEditedInterface{
  /**
   * Date the message was last edited in Unix time
   */
  public int $DateEdited;

  public function __construct(
    array $Data
  ){
    parent::__construct($Data);
    $this->DateEdited = $Data['edit_date'];
  }
}