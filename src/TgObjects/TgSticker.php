<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TgAuxiliary\{
  TgMessageData,
  TgPhotoSize
};
use ProtocolLive\TelegramBotLibrary\TgEnums\TgStickerType;
use ProtocolLive\TelegramBotLibrary\TgInterfaces\{
  TgEventInterface,
  TgForwadableInterface
};

/**
 * This object represents a sticker.
 * @link https://core.telegram.org/bots/api#sticker
 * @version 2024.04.11.00
 */
readonly class TgSticker
implements TgEventInterface, TgForwadableInterface{
  public TgMessageData $Data;
  /**
   * Identifier for this file, which can be used to download or reuse the file
   */
  public string $Id;
  /**
   * Unique identifier for this file, which is supposed to be the same over time and for different bots. Can't be used to download or reuse the file.
   */
  public string $IdUnique;
  /**
   * Type of the sticker, currently one of “regular”, “mask”, “custom_emoji”. The type of the sticker is independent from its format, which is determined by the fields is_animated and is_video.
   */
  public TgStickerType $Type;
  /**
   * Sticker width
   */
  public int $Width;
  /**
   * Sticker height
   */
  public int $Height;
  /**
   * Emoji associated with the sticker
   */
  public string|null $Emoji;
  /**
   * Name of the sticker set to which the sticker belongs
   */
  public string|null $SetName;
  /**
   * For premium regular stickers, premium animation for the sticker
   */
  public TgFile|null $PremiumAnimation;
  /**
   * For mask stickers, the position where the mask should be placed
   */
  public TgMask|null $Mask;
  /**
   * For custom emoji stickers, unique identifier of the custom emoji
   */
  public string|null $CustomEmojiId;
  /**
   * File size in bytes
   */
  public int|null $FileSize;
  /**
   * If the sticker must be repainted to a text color in messages, the color of the Telegram Premium badge in emoji status, white color on chat photos, or another appropriate color in other places
   */
  public bool $Repainting;
  /**
   * Sticker thumbnail in the .WEBP or .JPG format
   */
  public TgPhotoSize|null $Thumb;

  /**
   * @link https://core.telegram.org/bots/api#sticker
   */
  public function __construct(
    array $Data
  ){
    $this->Data = new TgMessageData($Data);
    $this->Id = $Data['sticker']['file_id'];
    $this->IdUnique = $Data['sticker']['file_unique_id'];
    $this->Type = TgStickerType::from($Data['sticker']['type']);
    $this->Width = $Data['sticker']['width'];
    $this->Height = $Data['sticker']['height'];
    if(isset($Data['sticker']['thumbnail'])):
      $this->Thumb = new TgPhotoSize($Data['sticker']['thumbnail']);
    endif;
    $this->Emoji = $Data['sticker']['emoji'] ?? null;
    $this->SetName = $Data['sticker']['set_name'] ?? null;
    if(isset($Data['sticker']['premium_animation'])):
      $this->PremiumAnimation = new TgFile($Data['sticker']['premium_animation']);
    else:
      $this->PremiumAnimation = null;
    endif;
    if(isset($Data['sticker']['mask_position'])):
      $this->Mask = new TgMask($Data['sticker']['mask_position']);
    else:
      $this->Mask = null;
    endif;
    $this->CustomEmojiId = $Data['sticker']['custom_emoji_id'] ?? null;
    $this->FileSize = $Data['sticker']['file_size'] ?? null;
    $this->Repainting = $Data['sticker']['needs_repainting'] ?? false;
  }
}