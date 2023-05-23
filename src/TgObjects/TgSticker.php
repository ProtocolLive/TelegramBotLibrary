<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * This object represents a sticker.
 * @link https://core.telegram.org/bots/api#sticker
 * @version 2023.05.23.00
 */
final class TgSticker
extends TgObject{
  public readonly TgMessageData $Data;
  /**
   * Identifier for this file, which can be used to download or reuse the file
   */
  public readonly string $Id;
  /**
   * Unique identifier for this file, which is supposed to be the same over time and for different bots. Can't be used to download or reuse the file.
   */
  public readonly string $IdUnique;
  /**
   * Type of the sticker, currently one of “regular”, “mask”, “custom_emoji”. The type of the sticker is independent from its format, which is determined by the fields is_animated and is_video.
   */
  public readonly TgStickerType $Type;
  /**
   * Sticker width
   */
  public readonly int $Width;
  /**
   * Sticker height
   */
  public readonly int $Height;
  /**
   * If the sticker is animated
   */
  public readonly bool $Animated;
  /**
   * If the sticker is a video sticker
   */
  public readonly bool $Video;
  /**
   * Sticker thumbnail in the .WEBP or .JPG format
   */
  public readonly TgPhotoSize|null $Thumb;
  /**
   * Emoji associated with the sticker
   */
  public readonly string|null $Emoji;
  /**
   * Name of the sticker set to which the sticker belongs
   */
  public readonly string|null $SetName;
  /**
   * For premium regular stickers, premium animation for the sticker
   */
  public readonly TgFile|null $PremiumAnimation;
  /**
   * For mask stickers, the position where the mask should be placed
   */
  public readonly TgMask|null $Mask;
  /**
   * For custom emoji stickers, unique identifier of the custom emoji
   */
  public readonly string|null $CustomEmojiId;
  /**
   * File size in bytes
   */
  public readonly int|null $FileSize;
  /**
   * If the sticker must be repainted to a text color in messages, the color of the Telegram Premium badge in emoji status, white color on chat photos, or another appropriate color in other places
   */
  public readonly bool $Repainting;

  /**
   * @link https://core.telegram.org/bots/api#sticker
   */
  public function __construct(array $Data){
    $this->Data = new TgMessageData($Data);
    $this->Id = $Data['sticker']['file_id'];
    $this->IdUnique = $Data['sticker']['file_unique_id'];
    $this->Type = TgStickerType::from($Data['sticker']['type']);
    $this->Width = $Data['sticker']['width'];
    $this->Height = $Data['sticker']['height'];
    $this->Animated = $Data['sticker']['is_animated'] ?? false;
    $this->Video = $Data['sticker']['is_video'] ?? false;
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