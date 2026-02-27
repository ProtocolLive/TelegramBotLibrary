<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgAuxiliary;
use ProtocolLive\TelegramBotLibrary\TgObjects\TgAudio;

/**
 * This object represents the audios displayed on a user's profile.
 * @link https://core.telegram.org/bots/api#userprofileaudios
 * @version 2026.02.27.00
 */
final readonly class TgUserProfileAudios{
  /**
   * Total number of profile audios for the target user
   */
  public int $Count;
  /**
   * Requested profile audios
   */
  public array $Audios;

  public function __construct(
    array $Data
  ){
    $this->Count = $Data['total_count'];
    foreach($Data['audios'] as &$audio):
      $audio = new TgAudio($audio);
    endforeach;
    $this->Audios = $Data['audios'];
  }
}