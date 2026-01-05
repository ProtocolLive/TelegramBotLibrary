<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * This object represents a forum topic.
 * @link https://core.telegram.org/bots/api#forumtopic
 * @version 2026.01.05.00
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
  /**
   * If the name of the topic wasn't specified explicitly by its creator and likely needs to be changed by the bot
   */
  public bool $NameImplicit;

  public function __construct(
    array $Data
  ){
    $this->Id = $Data['message_thread_id'];
    $this->Name = $Data['name'];
    $this->Color = $Data['icon_color'];
    $this->Emoji = $Data['icon_custom_emoji_id'] ?? null;
    $this->NameImplicit = $Data['is_name_implicit'] ?? false;
  }
}