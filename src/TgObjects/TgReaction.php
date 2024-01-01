<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TgEnums\TgReactionType;

/**
 * @link https://core.telegram.org/bots/api#reactiontype
 * @version 2024.01.01.00
 */
class TgReaction{
  public readonly TgReactionType $Type;
  public readonly string $Emoji;

  public function __construct(
    array $Data
  ){
    $this->Type = TgReactionType::from($Data['type']);
    $this->Emoji = $Data[$this->Type->value];
  }
}