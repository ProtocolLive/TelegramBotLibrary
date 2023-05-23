<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * @link https://core.telegram.org/bots/api#forumtopiccreated
 * @version 2023.05.23.00
 */
final class TgForumCreated
extends TgObject{
  public readonly TgMessageData $Data;
  /**
   * Name of the topic
   */
  public readonly string $Name;
  /**
   * Color of the topic icon in RGB format
   */
  public readonly string $Color;
  /**
   * Unique identifier of the custom emoji shown as the topic icon
   */
  public readonly string|null $Emoji;

  public function __construct(array $Data){
    $this->Data = new TgMessageData($Data);
    $this->Name = $Data['forum_topic_created']['name'];
    $this->Color = $Data['forum_topic_created']['icon_color'];
    $this->Emoji = $Data['forum_topic_created']['icon_custom_emoji_id'] ?? null;
  }
}