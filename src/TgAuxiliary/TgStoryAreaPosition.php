<?php
//Protocol Corporation Ltda.
//https://github.com/ProtocolLive/TelegramBotLibrary

namespace ProtocolLive\TelegramBotLibrary\TgAuxiliary;
use Exception;

/**
 * Describes the position of a clickable area within a story.
 * @link https://core.telegram.org/bots/api#storyareaposition
 * @version 2025.05.11.00
 */
final class TgStoryAreaPosition{
  /**
   * @param float $X The abscissa of the area's center, as a percentage of the media width
   * @param float $Y The ordinate of the area's center, as a percentage of the media height
   * @param float $Width The width of the area's rectangle, as a percentage of the media width
   * @param float $Height The height of the area's rectangle, as a percentage of the media height
   * @param float $Rotation The clockwise rotation angle of the rectangle, in degrees; 0-360
   * @param float $CornerRadius The radius of the rectangle corner rounding, as a percentage of the media width
   * @throws Exception
   */
  public function __construct(
    public float $X,
    public float $Y,
    public float $Width,
    public float $Height,
    public float $Rotation,
    public float $CornerRadius
  ){
    if($Rotation < 0
    or $Rotation > 360):
      throw new Exception('Rotation must be between 0 and 360');
    endif;
  }

  public function ToArray():array{
    return [
      'x_percentage' => $this->X,
      'y_percentage	' => $this->Y,
      'width_percentage' => $this->Width,
      'height_percentage' => $this->Height,
      'rotation_angle' => $this->Rotation,
      'corner_radius_percentage' => $this->CornerRadius
    ];
  }
}