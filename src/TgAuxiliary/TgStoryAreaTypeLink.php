<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgAuxiliary;

/**
 * Describes a story area pointing to an HTTP or tg:// link. Currently, a story can have up to 3 link areas.
 * @link https://core.telegram.org/bots/api#storyareatypelink
 * @version 2025.05.11.00
 */
final class TgStoryAreaTypeLink
extends TgStoryAreaType{
  /**
   * @param string $Url HTTP or tg:// URL to be opened when the area is clicked
   */
  public function __construct(
    public string $Url
  ){}

  public function ToArray():array{
    return [
      'type' => 'link',
      'url' => $this->Url
    ];
  }
}