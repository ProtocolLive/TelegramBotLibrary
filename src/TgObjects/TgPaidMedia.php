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
 * @version 2024.07.07.00
 */
final readonly class TgPaidMedia
implements TgEventInterface,
TgForwadableInterface,
TgMessageInterface{
  public TgMessageData $Data;
  public int $Price;
  /**
   * @var TgVideo|TgPhotoSize[]|TgPaidMediaPreview[]
   */
  public array $Medias;

  public function __construct(
    array $Data
  ){
    $this->Data = new TgMessageData($Data);
    $this->Price = $Data['paid_media']['star_count'];
    $temp = [];
    foreach($Data['paid_media']['paid_media'] as $media):
      if($media['type'] === TgPaidMediaType::Photo->value):
        $temp2 = [];
        foreach($media['photo'] as $photo):
          $temp2[] = new TgPhotoSize($photo);
        endforeach;
        $temp[] = $temp2;
      elseif($media['type'] === TgPaidMediaType::Video->value):
        $temp[] = new TgVideo($media);
      else:
        $temp[] = new TgPaidMediaPreview($media);
      endif;
    endforeach;
    $this->Medias = $temp;
  }
}