<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgParams;
use ProtocolLive\TelegramBotLibrary\TblObjects\TblEntities;
use ProtocolLive\TelegramBotLibrary\TgEnums\TgParseMode;
use ProtocolLive\TelegramBotLibrary\TgInterfaces\TgInlineQueryContentInterface;
use ProtocolLive\TelegramBotLibrary\TgParams\TgLinkPreview;

/**
 * Represents the content of a text message to be sent as the result of an inline query.
 * @link https://core.telegram.org/bots/api#inputtextmessagecontent
 * @version 2024.01.02.02
 */
class TgInlineQueryContentText
implements TgInlineQueryContentInterface{
  /**
   * @param string $Text Text of the message to be sent, 1-4096 characters
   * @param TgParseMode|null $ParseMode Mode for parsing entities in the message text. See formatting options for more details.
   * @param TblEntities $Entities List of special entities that appear in message text, which can be specified instead of parse_mode
   * @param TgLinkPreview $LinkPreview 
   */
  public function __construct(
    public string $Text,
    public TgParseMode|null $ParseMode = null,
    public TblEntities|null $Entities = null,
    public TgLinkPreview|null $LinkPreview = null
  ){}

  public function ToArray():array{
    $param['message_text'] = $this->Text;
    if($this->ParseMode !== null):
      $param['parse_mode'] = $this->ParseMode->value;
    endif;
    if($this->Entities !== null):
      $param['entities'] = $this->Entities->ToArray();
    endif;
    if($this->LinkPreview !== null):
      $param['link_preview_options'] = $this->LinkPreview->ToArray();
    endif;
    return $param;
  }
}