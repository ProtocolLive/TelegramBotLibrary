<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2023.02.26.00

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * @link https://core.telegram.org/bots/api#chatpermissions
 */
final class TgPermMember{
  const Array = [
    'Message' => 'can_send_messages',
    'Media' => 'can_send_media_messages',
    'Audio' => 'can_send_audios',
    'Documents' => 'can_send_documents',
    'Photos' => 'can_send_photos',
    'Videos' => 'can_send_videos',
    'VideoNote' => 'can_send_video_notes',
    'VoiceNote' => 'can_send_voice_notes',
    'Poll' => 'can_send_polls',
    'Media2' => 'can_send_other_messages',
    'Preview' => 'can_add_web_page_previews',
    'Info' => 'can_change_info',
    'Invite' => 'can_invite_users',
    'Pin' => 'can_pin_messages',
    'Topics' => 'can_manage_topics'
  ];

  /**
   * Describes actions that a non-administrator user is allowed to take in a chat.
   * @param bool $Message If the user is allowed to send text messages, contacts, locations and venues
   * @param bool $Media If the user is allowed to send audios, documents, photos, videos, video notes and voice notes, implies can_send_messages
   * @param bool $Audio Ff the user is allowed to send audios
   * @param bool $Documents If the user is allowed to send documents
   * @param bool $Photos If the user is allowed to send photos
   * @param bool $Videos If the user is allowed to send videos
   * @param bool $VideoNote If the user is allowed to send video notes
   * @param bool $VoiceNote If the user is allowed to send voice notes
   * @param bool $Poll If the user is allowed to send polls, implies can_send_messages
   * @param bool $Media2 If the user is allowed to send animations, games, stickers and use inline bots, implies $Media
   * @param bool $Preview If the user is allowed to add web page previews to their messages, implies $Media
   * @param bool $Info If the user is allowed to change the chat title, photo and other settings. Ignored in public supergroups
   * @param bool $Invite If the user is allowed to invite new users to the chat
   * @param bool $Pin If the user is allowed to pin messages. Ignored in public supergroups
   * @param bool $Topics If the user is allowed to create, rename, close, and reopen forum topics; supergroups only
   * @link https://core.telegram.org/bots/api#chatpermissions
   */
  public function __construct(
    array $Data = null,
    public bool $Message = false,
    public bool $Media = false,
    public bool $Audio = false,
    public bool $Documents = false,
    public bool $Photos = false,
    public bool $Videos = false,
    public bool $VideoNote = false,
    public bool $VoiceNote = false,
    public bool $Poll = false,
    public bool $Media2 = false,
    public bool $Preview = false,
    public bool $Info = false,
    public bool $Invite = false,
    public bool $Pin = false,
    public bool $Topics = false
  ){
    if($Data !== null):
      foreach(self::Array as $perm => $vector):
        $this->$perm = $Data[$vector] ?? false;
      endforeach;
    endif;
  }

  public function ToArray():array{
    $return = [];
    foreach(self::Array as $perm => $vector):
      $return[$vector] = $this->$perm;
    endforeach;
    return $return;
  }
}