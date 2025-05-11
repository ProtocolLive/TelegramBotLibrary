<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgAuxiliary;

/**
 * Describes a story area containing weather information. Currently, a story can have up to 3 weather areas.
 * @link https://core.telegram.org/bots/api#storyareatypeweather
 * @version 2025.05.11.00
 */
final class TgStoryAreaTypeWeather
extends TgStoryAreaType{
  public function __construct(
    public float $Temperature,
    public string $Emoji,
    public int $BackgroundColor
  ){}

  public function ToArray():array{
    return [
      'type' => 'weather',
      'temperature' => $this->Temperature,
      'emoji' => $this->Emoji,
      'background_color' => $this->BackgroundColor
    ];
  }
}