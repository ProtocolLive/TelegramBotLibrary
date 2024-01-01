<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgObjects;
use ProtocolLive\TelegramBotLibrary\TgEnums\TgChatType;

/**
 * @param TgUser|TgChat|string $User String if user have privacy enabled
 * @param TgChat|null $Chat Null if user are public forwards
 * @param int|null $Message Null if user are public forwards
 * @param array|TgAudio|null $Object Array for photos
 * @param string|null $Signature In case of sender is a channel
 * @link https://core.telegram.org/bots/api#externalreplyinfo
 * @link https://core.telegram.org/bots/api#messageorigin
 * @version 2024.01.01.00
 */
class TgReplyExternal{
  public readonly TgUser|TgChat|string $User;
  public readonly TgChat|null $Chat;
  public readonly int|null $Message;
  public readonly int $Date;
  public array|TgAudio|TgDocument|TgVideo|null $Object;
  public readonly string|null $Signature;

  public function __construct(
    array $Data
  ){
    if($Data['origin']['type'] === 'user'):
      $this->User = new TgUser($Data['origin']['sender_user']);
    elseif($Data['origin']['type'] === 'hidden_user'):
      $this->User = $Data['origin']['sender_user_name'];
    elseif($Data['origin']['type'] === TgChatType::Channel->value):
      $this->User = new TgChat($Data['origin']['chat']);
    endif;
    if(isset($Data['chat'])):
      $this->Chat = new TgChat($Data['chat']);
    else:
      $this->Chat = null;
    endif;
    $this->Message = $Data['message_id'] ?? null;
    $this->Signature = $Data['origin']['author_signature'] ?? null;

    if(isset($Data['photo'])):
      foreach($Data['photo'] as $photo):
        $this->Object[] = new TgPhotoSize($photo);
      endforeach;
    elseif(isset($Data['audio'])):
      $this->Object = new TgAudio($Data['audio']);
    elseif(isset($Data['document'])):
      $this->Object = new TgDocument($Data['document']);
    elseif(isset($Data['video'])):
      $this->Object = new TgVideo($Data['video']);
    else:
      $this->Object = null;
    endif;
    $this->Date = $Data['origin']['date'];
  }
}