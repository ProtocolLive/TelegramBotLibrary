<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.08.19.00

namespace ProtocolLive\TelegramBotLibrary\TblObjects;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgEntityType;

class TblEntities implements \JsonSerializable{
  private array $Entities = [];

  public function Add(
    TgEntityType $Type,
    int $Offset,
    int $Length,
    string|null $Url = null,
    int|null $User = null,
    string|null $Language = null
  ):void{
    $temp['type'] = $Type->value;
    $temp['offset'] = $Offset;
    $temp['length'] = $Length;
    if($Type === TgEntityType::Link):
      $temp['url'] = $Url;
    elseif($Type === TgEntityType::MentionText):
      $temp['user'] = $User;
    elseif($Type === TgEntityType::Pre):
      $temp['language'] = $Language;
    endif;
    $this->Entities[] = $temp;
  }

  function jsonSerialize():mixed{
    return $this->Entities;
  }
}