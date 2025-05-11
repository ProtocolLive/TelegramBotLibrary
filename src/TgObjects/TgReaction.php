<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TgEnums\TgReactionType;

/**
 * This object describes the type of a reaction.
 * @link https://core.telegram.org/bots/api#reactiontype
 * @version 2025.05.11.00
 */
final class TgReaction{
  public function __construct(
    array|null $Data = null,
    public TgReactionType|null $Type = null,
    public string|null $Emoji = null,
    public int|null $Count = null
  ){
    if($Data === null):
      return;
    endif;
    $this->Type = TgReactionType::from($Data['type']);
    if($this->Type === TgReactionType::Normal):
      $this->Emoji = $Data['emoji'];
    elseif($this->Type === TgReactionType::Custom):
      $this->Emoji = $Data['custom_emoji_id'];
    else:
      $this->Emoji = null;
    endif;
  }

  public function ToArray():array{
    return [
      'type' => $this->Type->value,
      'emoji' => $this->Emoji
    ];
  }
}