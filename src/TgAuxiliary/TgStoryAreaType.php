<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgAuxiliary;

/**
 * Describes the type of a clickable area on a story.
 * @link https://core.telegram.org/bots/api#storyareatype
 * @version 2025.05.11.00
 */
abstract class TgStoryAreaType{
  abstract public function ToArray();
}