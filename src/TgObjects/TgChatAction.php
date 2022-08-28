<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary
//2022.08.18.00

namespace ProtocolLive\TelegramBotLibrary\TgObjects;

/**
 * https://core.telegram.org/bots/api#sendchataction
 */
enum TgChatAction:string{
  case Typing = 'typing';
  case Photo = 'upload_photo';
  case Video = 'upload_video';
  case VideoRecord = 'record_video';
  case Voice = 'upload_voice';
  case VoiceRecord = 'record_voice';
  case Document = 'upload_document';
  case Sticker = 'choose_sticker';
  case Location = 'find_location';
  case VideoNote = 'upload_video_note';
  case VideoNoteRecord = 'record_video_note';
}