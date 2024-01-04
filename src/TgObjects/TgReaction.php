<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TgEnums\TgReactionType;

/**
 * @link https://core.telegram.org/bots/api#reactiontype
 * @version 2024.01.04.00
 */
final readonly class TgReaction{
  public TgReactionType $Type;
  public string $Emoji;

  public function __construct(
    array $Data,
    public readonly int|null $Count = null
  ){
    $this->Type = TgReactionType::from($Data['type']);
    $this->Emoji = $Data[$this->Type->value];
  }
}