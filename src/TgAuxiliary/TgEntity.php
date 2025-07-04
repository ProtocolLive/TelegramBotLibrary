<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgAuxiliary;
use ProtocolLive\TelegramBotLibrary\TgEnums\TgEntityType;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgUser;

/**
 * @link https://core.telegram.org/bots/api#messageentity
 * @version 2025.07.03.00
 */
final readonly class TgEntity{
  public TgEntityType $Type;
  /**
   * Offset in UTF-16 code units to the start of the entity
   */
  public int $Offset;
  /**
   * Length of the entity in UTF-16 code units
   */
  public int $Length;
  /**
   * For “text_link” only, URL that will be opened after user taps on the text
   */
  public string|null $Url;
  /**
   * For “text_mention” only, the mentioned user
   */
  public TgUser|int|null $User;
  /**
   * For “pre” only, the programming language of the entity text
   */
  public string|null $Language;
  /**
   * For “custom_emoji” only, unique identifier of the custom emoji. Use TelegramBotLibrary::CustomEmojiGet to get full information about the sticker
   */
  public string|null $CustomEmoji;

  public function __construct(
    array $Data
  ){
    $this->Type = TgEntityType::from($Data['type']);
    $this->Offset = $Data['offset'];
    $this->Length = $Data['length'];
    $this->Url = $Data['url'] ?? null;
    if(isset($Data['user'])):
      $this->User = new TgUser($Data['user']);
    else:
      $this->User = null;
    endif;
    $this->Language = $Data['language'] ?? null;
    $this->CustomEmoji = $Data['custom_emoji_id'] ?? null;
  }
}