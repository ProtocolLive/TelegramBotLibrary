<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.12.08.00

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * @link https://core.telegram.org/bots/api#forumtopiccreated
 */
final class TgForumCreated{
  public readonly TgMessage $Message;
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
    $this->Message = new TgMessage($Data);
    $this->Name = $Data['forum_topic_created']['name'];
    $this->Color = $Data['forum_topic_created']['icon_color'];
    $this->Emoji = $Data['forum_topic_created']['icon_custom_emoji_id'] ?? null;
  }
}