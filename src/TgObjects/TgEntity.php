<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TgEnums\TgEntityType;

/**
 * @link https://core.telegram.org/bots/api#messageentity
 * @version 2024.01.01.00
 */
class TgEntity{
  public readonly TgEntityType $Type;
  /**
   * Offset in UTF-16 code units to the start of the entity
   */
  public readonly int $Offset;
  /**
   * Length of the entity in UTF-16 code units
   */
  public readonly int $Length;
  /**
   * For “text_link” only, URL that will be opened after user taps on the text
   */
  public readonly string|null $Url;
  /**
   * For “text_mention” only, the mentioned user
   */
  public readonly TgUser|int|null $User;
  /**
   * For “pre” only, the programming language of the entity text
   */
  public readonly string|null $Language;
  /**
   * For “custom_emoji” only, unique identifier of the custom emoji. Use TelegramBotLibrary::CustomEmojiGet to get full information about the sticker
   */
  public readonly string|null $CustomEmoji;
  
  /**
   * @param TgEntityType $Type Type of the entity
   * @param int $Offset Offset in UTF-16 code units to the start of the entity
   * @param int $Length Length of the entity in UTF-16 code units
   * @param string $Url For “text_link” only, url that will be opened after user taps on the text
   * @param int $User For “text_mention” only, the mentioned user
   * @param string $Language For “pre” only, the programming language of the entity text
   * @link https://core.telegram.org/bots/api#messageentity
   */
  public function __construct(
    array $Data = null,
    TgEntityType $Type = null,
    int $Offset = null,
    int $Length = null,
    string $Url = null,
    int $User = null,
    string $Language = null
  ){
    if($Data === null):
      $this->Type = $Type;
      $this->Offset = $Offset;
      $this->Length = $Length;
      $this->Url = $Url;
      $this->User = $User;
      $this->Language = $Language;
    else:
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
    endif;
  }
}