<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgAuxiliary;

/**
 * Describes a clickable area on a story media.
 * @link https://core.telegram.org/bots/api#storyarea
 * @version 2025.05.11.00
 */
final class TgStoryArea{
  public function __construct(
    public TgStoryAreaPosition $Position,
    public TgStoryAreaType $Type
  ){}

  public function ToArray():array{
    return [
      'position' => $this->Position->ToArray(),
      'type' => $this->Type->ToArray()
    ];
  }
}