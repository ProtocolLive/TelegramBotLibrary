<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TblObjects;
use ProtocolLive\TelegramBotLibrary\TgEnums\TgEntityType;

/**
 * @version 2024.01.01.00
 */
class TblEntities{
  private array $Entities = [];

  /**
   * @param TgEntityType $Type,
   * @param int $Offset,
   * @param int $Length,
   * @param string|null $Url For use with TgEntityType::Link
   * @param int|null $User For use with TgEntityType::MentionText
   * @param string|null $Language For use with TgEntityType::Pre
   * @link https://core.telegram.org/bots/api#messageentity
   */
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
      $temp['user'] = ['id' => $User];
    elseif($Type === TgEntityType::Pre):
      $temp['language'] = $Language;
    endif;
    $this->Entities[] = $temp;
  }

  public function ToArray():array{
    return $this->Entities;
  }
}