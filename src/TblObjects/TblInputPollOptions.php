<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TblObjects;
use ProtocolLive\TelegramBotLibrary\TblObjects\{
  TblEntities,
  TblException
};
use ProtocolLive\TelegramBotLibrary\TgEnums\{
  TgError,
  TgParseMode
};
use ProtocolLive\TelegramBotLibrary\TgObjects\TgLimits;

/**
 * This object contains information about one answer option in a poll to be sent.
 * @version 2024.07.04.00
 * @link https://core.telegram.org/bots/api#inputpolloption
 */
final class TblInputPollOptions{
  private array $Options = [];

  /**
   * @throws TblException
   */
  public function __construct(
    string $Text,
    TgParseMode $ParseMode = null,
    TblEntities $Entities = null
  ){
    $this->Add($Text, $ParseMode, $Entities);
  }

  /**
   * @throws TblException
   */
  public function Add(
    string $Text,
    TgParseMode $ParseMode = null,
    TblEntities $Entities = null
  ):void{
    if(count($this->Options) === TgLimits::PollOptionsMax):
      throw new TblException(
        TgError::LimitPollOptionsMax,
        'Poll exceeds ' . TgLimits::PollOptionsMax . ' options'
      );
    endif;
    if(mb_strlen($Text) > TgLimits::PollOptionText):
      throw new TblException(
        TgError::LimitPollOptionText,
        'Text length exceeds ' . TgLimits::PollOptionText . ' characters'
      );
    endif;
    $temp = ['text' => $Text];
    if($ParseMode !== null):
      $temp['text_parse_mode'] = $ParseMode;
    endif;
    if($Entities !== null):
      $temp['text_entities'] = $Entities->ToArray();
    endif;
    $this->Options[] = $temp;
  }

  /**
   * @throws TblException
   */
  public function CheckMin():void{
    if(count($this->Options) < TgLimits::PollOptionsMin):
      throw new TblException(
        TgError::LimitPollOptionsMin,
        'Poll must have ' . TgLimits::PollOptionsMin . ' options at least'
      );
    endif;
  }

  public function ToArray():array{
    return $this->Options;
  }
}