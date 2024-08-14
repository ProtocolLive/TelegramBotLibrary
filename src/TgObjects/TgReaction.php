<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TgEnums\TgReactionType;

/**
 * @link https://core.telegram.org/bots/api#reactiontype
 * @version 2024.08.14.00
 */
final readonly class TgReaction{
  public TgReactionType $Type;
  public string|null $Emoji;

  public function __construct(
    array $Data,
    public int|null $Count = null
  ){
    $this->Type = TgReactionType::from($Data['type']);
    if($this->Type === TgReactionType::Normal):
      $this->Emoji = $Data['emoji'];
    elseif($this->Type === TgReactionType::Custom):
      $this->Emoji = $Data['custom_emoji_id'];
    else:
      $this->Emoji = null;
    endif;
  }
}