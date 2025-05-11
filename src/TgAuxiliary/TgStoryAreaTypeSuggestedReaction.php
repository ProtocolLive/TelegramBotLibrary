<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgAuxiliary;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgReaction;

/**
 * Describes a story area pointing to a suggested reaction. Currently, a story can have up to 5 suggested reaction areas.
 * @link https://core.telegram.org/bots/api#storyareatypesuggestedreaction
 * @version 2025.05.11.00
 */
final class TgStoryAreaTypeSuggestedReaction
extends TgStoryAreaType{
  public function __construct(
    public TgReaction $Type,
    public bool $Dark = false,
    public bool $Flipped = false
  ){}

  public function ToArray():array{
    $param['type'] = 'suggested_reaction';
    $param['reaction_type'] = $this->Type->ToArray();
    if($this->Dark):
      $param['dark'] = true;
    endif;
    if($this->Flipped):
      $param['flipped'] = true;
    endif;
    return $param;
  }
}