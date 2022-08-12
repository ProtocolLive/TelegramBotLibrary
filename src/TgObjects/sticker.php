<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.08.12.00
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
  public readonly string $Id;
  public readonly string $IdUnique;
  public readonly string $Type;
  public readonly int $Width;
  public readonly int $Height;
  public readonly bool $Animated;
  public readonly bool $Video;
  public readonly TgPhotoSize|null $Thumb;
  public readonly string|null $Emoji;
  public readonly string|null $SetName;
  public readonly TgFile|null $PremiumAnimation;
  //public readonly string|null $Mask;
  public readonly string|null $CustomEmojiId;
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
    //if(isset($Data['premium_animation'])):
      //$this->PremiumAnimation = $Data['premium_animation'] ?? null;
    //endif;
    //$this->Mask = $Data['mask_position'] ?? null;
    $this->CustomEmojiId = $Data['custom_emoji_id'] ?? null;
    $this->FileSize = $Data['file_size'] ?? null;
  }
}