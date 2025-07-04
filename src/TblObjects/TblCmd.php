<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TblObjects;
use ProtocolLive\TelegramBotLibrary\TgAuxiliary\{
  TgEntity,
  TgMessageData
};
use ProtocolLive\TelegramBotLibrary\TgInterfaces\{
  TgCaptionableInterface,
  TgEventInterface,
  TgForwadableInterface,
  TgMessageInterface
};

/**
 * @version 2025.07.03.00
 */
readonly class TblCmd
implements TgEventInterface,
TgForwadableInterface,
TgMessageInterface{
  public TgMessageData $Data;
  public string $Command;
  public string|null $Parameters;
  public string|null $Target;
  /**
   * Filled with media in case of command in caption
   */
  public TgCaptionableInterface|null $Media;

  public function __construct(
    array $Data
  ){
    $this->Data = new TgMessageData($Data);
    $Text = $Data['caption'] ?? $Data['text'];
    if(isset($Data['caption_entities'])):
      $Entity = new TgEntity($Data['caption_entities'][0]);
    else:
      $Entity = new TgEntity($Data['entities'][0]);
    endif;
    $cmd = substr(
      $Text,
      $Entity->Offset + 1,
      $Entity->Length - 1
    );
    $temp = substr(
      $Text,
      $Entity->Length + 1
    );
    //Cant use empty() because the parameter can be the number 0
    if($temp === ''):
      $this->Parameters = null;
    else:
      $this->Parameters = $temp;
    endif;
    $pos = strpos($cmd, '@');
    if($pos === false):
      $this->Target = null;
    else:
      $this->Target = substr($cmd, $pos + 1);
      $cmd = substr($cmd, 0, $pos);
    endif;
    $this->Command = $cmd;
    $temp = TblBasics::DetectMessage($Data, true);
    if($temp instanceof TgCaptionableInterface):
      $this->Media = $temp;
    else:
      $this->Media = null;
    endif;
  }
}