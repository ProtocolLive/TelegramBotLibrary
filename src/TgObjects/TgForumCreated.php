<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TgAuxiliary\TgMessageData;
use ProtocolLive\TelegramBotLibrary\TgInterfaces\TgEventInterface;

/**
 * @link https://core.telegram.org/bots/api#forumtopiccreated
 * @version 2024.04.11.00
 */
final readonly class TgForumCreated
implements TgEventInterface{
  public TgMessageData $Data;
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
    $this->Data = new TgMessageData($Data);
    $this->Name = $Data['forum_topic_created']['name'];
    $this->Color = $Data['forum_topic_created']['icon_color'];
    $this->Emoji = $Data['forum_topic_created']['icon_custom_emoji_id'] ?? null;
  }
}