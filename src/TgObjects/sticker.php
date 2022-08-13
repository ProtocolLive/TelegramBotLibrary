<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.08.13.02
//API 6.2

enum TgStickerType:string{
  case Regular = 'regular';
  case Mask =  'mask';
  case CustomEmoji = 'custom_emoji';
}

/**
 * This object represents a sticker.
 * @link https://core.telegram.org/bots/api#sticker
 */
final class TgSticker{
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
  public readonly string $Type;
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
  public readonly string|null $Mask;
  /**
   * For custom emoji stickers, unique identifier of the custom emoji
   */
  public readonly string|null $CustomEmojiId;
  /**
   * File size in bytes
   */
  public readonly int|null $FileSize;

  /**
   * @link https://core.telegram.org/bots/api#sticker
   */
  public function __construct(array $Data){
    $this->Id = $Data['file_id'];
    $this->IdUnique = $Data['file_unique_id'];
    $this->Type = TgStickerType::from($Data['type']);
    $this->Width = $Data['width'];
    $this->Height = $Data['height'];
    $this->Animated = $Data['is_animated'] ?? false;
    $this->Video = $Data['is_video'] ?? false;
    if(isset($Data['thumb'])):
      $this->Thumb = new TgPhotoSize($Data['thumb']);
    endif;
    $this->Emoji = $Data['emoji'] ?? null;
    $this->SetName = $Data['set_name'] ?? null;
    if(isset($Data['premium_animation'])):
      $this->PremiumAnimation = new TgFile($Data['premium_animation']);
    else:
      $this->PremiumAnimation = null;
    endif;
    if(isset($Data['mask_position'])):
      $this->Mask = new TgMask($Data['mask_position']);
    else:
      $this->Mask = null;
    endif;
    $this->CustomEmojiId = $Data['custom_emoji_id'] ?? null;
    $this->FileSize = $Data['file_size'] ?? null;
  }
}

/**
 * This object describes the position on faces where a mask should be placed by default.
 * @link https://core.telegram.org/bots/api#maskposition
 */
class TgMask{
  /**
   * The part of the face relative to which the mask should be placed. One of “forehead”, “eyes”, “mouth”, or “chin”.
   */
  public readonly int $Point;
  /**
   * Shift by X-axis measured in widths of the mask scaled to the face size, from left to right. For example, choosing -1.0 will place mask just to the left of the default mask position.
   */
  public readonly float $XShift;
  /**
   * Shift by Y-axis measured in heights of the mask scaled to the face size, from top to bottom. For example, 1.0 will place the mask just below the default mask position.
   */
  public readonly float $YShift;
  /**
   * Mask scaling coefficient. For example, 2.0 means double size.
   */
  public readonly float $Scale;

  public function __construct(array $Data){
    $this->Point = $Data['point'];
    $this->XShift = $Data['x_shift'];
    $this->YShift = $Data['y_shift'];
    $this->Scale = $Data['scale'];
  }
}