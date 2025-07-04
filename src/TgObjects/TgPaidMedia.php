<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TgAuxiliary\{
  TgMessageData,
  TgPhotoSize
};
use ProtocolLive\TelegramBotLibrary\TgEnums\TgPaidMediaType;
use ProtocolLive\TelegramBotLibrary\TgInterfaces\{
  TgEventInterface,
  TgForwadableInterface,
  TgMessageInterface
};

/**
 * @link https://core.telegram.org/bots/api#paidmediainfo
 * @version 2025.07.04.00
 */
final readonly class TgPaidMedia
extends TgCaptionable
implements TgEventInterface,
TgForwadableInterface,
TgMessageInterface{
  public TgMessageData $Data;
  /**
   * Caption for the paid media
   */
  public string|null $Caption;
  /**
   * The number of Telegram Stars that must be paid to buy access to the media
   */
  public int $Price;
  /**
   * Information about the paid media
   * @var TgVideo[]|TgPhotoSize[]|TgPaidMediaPreview[]
   */
  public array $Medias;

  public function __construct(
    array $Data
  ){
    parent::__construct($Data);
    $this->Data = new TgMessageData($Data);
    $this->Price = $Data['paid_media']['star_count'];
    foreach($Data['paid_media']['paid_media'] as &$media):
      if($media['type'] === TgPaidMediaType::Photo->value):
        foreach($media['photo'] as &$photo):
          $photo = new TgPhotoSize($photo);
        endforeach;
        $media = $media['photo'];
      elseif($media['type'] === TgPaidMediaType::Video->value):
        $media = new TgVideo($media);
      else:
        $media = new TgPaidMediaPreview($media);
      endif;
    endforeach;
    $this->Medias = $Data['paid_media']['paid_media'];
  }
}