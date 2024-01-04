<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * This object represents a forum topic.
 * @link https://core.telegram.org/bots/api#forumtopic
 * @version 2024.01.04.00
 */
final readonly class TgForumTopic{
  /**
   * Unique identifier of the forum topic
   */
  public int $Id;
  /**
   * Name of the topic
   */
  public string $Name;
  /**
   * Color of the topic icon in RGB format
   */
  public string $Color;
  /**
   * Unique identifier of the custom emoji shown as the topic icon
   */
  public string|null $Emoji;

  public function __construct(
    array $Data
  ){
    $this->Id = $Data['message_thread_id'];
    $this->Name = $Data['name'];
    $this->Color = $Data['icon_color'];
    $this->Emoji = $Data['icon_custom_emoji_id'];
  }
}