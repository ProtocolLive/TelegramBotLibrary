<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgAuxiliary;

/**
 * Describes a story area pointing to a unique gift. Currently, a story can have at most 1 unique gift area.
 * @link https://core.telegram.org/bots/api#storyareatypeuniquegift
 * @version 2025.05.11.00
 */
final class TgStoryAreaTypeUniqueGift
extends TgStoryAreaType{
  public function __construct(
    public string $Name
  ){}

  public function ToArray():array{
    return [
      'type' => 'unique_gift',
      'name' => $this->Name
    ];
  }
}