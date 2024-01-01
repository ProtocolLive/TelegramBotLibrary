<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgEnums;

/**
 * @link https://core.telegram.org/bots/api#sendchataction
 * @version 2024.01.01.00
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