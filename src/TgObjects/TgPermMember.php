<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TgEnums\TgPermMember as TgPermMemberEnum;

/**
 * Describes actions that a non-administrator user is allowed to take in a chat.
 * @link https://core.telegram.org/bots/api#chatmemberrestricted
 * @version 2025.07.02.00
 */
final class TgPermMember{
  /**
   * Describes actions that a non-administrator user is allowed to take in a chat.
   * @param bool $Message If the user is allowed to send text messages, contacts, locations and venues
   * @param bool $Audio If the user is allowed to send audios
   * @param bool $Documents If the user is allowed to send documents
   * @param bool $Photos If the user is allowed to send photos
   * @param bool $Videos If the user is allowed to send videos
   * @param bool $VideoNote If the user is allowed to send video notes
   * @param bool $VoiceNote If the user is allowed to send voice notes
   * @param bool $Poll If the user is allowed to send polls, implies can_send_messages
   * @param bool $Media If the user is allowed to send animations, games, stickers and use inline bots, implies $Media
   * @param bool $Preview If the user is allowed to add web page previews to their messages, implies $Media
   * @param bool $Info If the user is allowed to change the chat title, photo and other settings. Ignored in public supergroups
   * @param bool $Invite If the user is allowed to invite new users to the chat
   * @param bool $Pin If the user is allowed to pin messages. Ignored in public supergroups
   * @param bool $Topics If the user is allowed to create, rename, close, and reopen forum topics; supergroups only
   */
  public function __construct(
    array|null $Data = null,
    public bool $Message = false,
    public bool $Media = false,
    public bool $Audio = false,
    public bool $Documents = false,
    public bool $Photos = false,
    public bool $Videos = false,
    public bool $VideoNote = false,
    public bool $VoiceNote = false,
    public bool $Poll = false,
    public bool $Preview = false,
    public bool $Info = false,
    public bool $Invite = false,
    public bool $Pin = false,
    public bool $Topics = false
  ){
    if($Data !== null):
      foreach(TgPermMemberEnum::cases() as $perm):
        $this->{$perm->name} = $Data[$perm->value] ?? false;
      endforeach;
    endif;
  }

  public function ToArray():array{
    $return = [];
    foreach(TgPermMemberEnum::cases() as $perm):
      $return[$perm->value] = $this->{$perm->name};
    endforeach;
    return $return;
  }
}