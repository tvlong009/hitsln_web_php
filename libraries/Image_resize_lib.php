<?php
namespace app\libraries;
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of image_lib
 *
 * @author Nguyen Thai Binh
 */
class Image_resize_lib {

  var $image;
  var $image_type;

  function load($filename) {
    if (is_file($filename)) {
      $image_info = getimagesize($filename);
      $this->image_type = $image_info[2];
      if ($this->image_type == IMAGETYPE_JPEG) {
        $this->image = imagecreatefromjpeg($filename);
      } elseif ($this->image_type == IMAGETYPE_GIF) {
        $this->image = imagecreatefromgif($filename);
      } elseif ($this->image_type == IMAGETYPE_PNG) {
        $this->image = imagecreatefrompng($filename);
      }
    }
  }

  function save($filename, $compression = 75, $permissions = null) {
    if (!is_dir(dirname($filename))) {
      $oldmask = umask(0);
      mkdir(dirname($filename), 0777, TRUE);
      umask($oldmask);
    }
    if ($this->image_type == IMAGETYPE_JPEG) {
      imagejpeg($this->image, $filename, $compression);
    } elseif ($this->image_type == IMAGETYPE_GIF) {
      imagegif($this->image, $filename);
    } elseif ($this->image_type == IMAGETYPE_PNG) {
      imagepng($this->image, $filename);
    }
    if ($permissions != null) {
      chmod($filename, $permissions);
    }
  }

  function output() {
    if ($this->image_type == IMAGETYPE_JPEG) {
      imagejpeg($this->image);
    } elseif ($this->image_type == IMAGETYPE_GIF) {
      imagegif($this->image);
    } elseif ($this->image_type == IMAGETYPE_PNG) {
      imagepng($this->image);
    }
  }

  function getWidth() {
    return imagesx($this->image);
  }

  function getHeight() {
    return imagesy($this->image);
  }

  function resizeToHeight($height) {
    $ratio = $height / $this->getHeight();
    $width = $this->getWidth() * $ratio;
    $this->resize($width, $height);
  }

  function resizeToWidth($width) {
    $ratio = $width / $this->getWidth();
    $height = $this->getheight() * $ratio;
    $this->resize($width, $height);
  }

  function scale($scale) {
    $width = $this->getWidth() * $scale / 100;
    $height = $this->getheight() * $scale / 100;
    $this->resize($width, $height);
  }

  function resize($width = '', $height = '', $zoom_in = FALSE) {
    if (empty($width) && empty($height))
      return;
    else {
      if (empty($width))
        $width = ($zoom_in ? $height : min($height, $this->getHeight())) * $this->getWidth() / $this->getHeight();
      if (empty($height))
        $height = ($zoom_in ? $width : min($width, $this->getWidth())) * $this->getHeight() / $this->getWidth();
    }
    $new_image = imagecreatetruecolor($width, $height);
    if ($this->image_type == IMAGETYPE_GIF || $this->image_type == IMAGETYPE_PNG) {
      $current_transparent = imagecolortransparent($this->image);
      if ($current_transparent != -1) {
        $transparent_color = imagecolorsforindex($this->image, $current_transparent);
        $current_transparent = imagecolorallocate($new_image, $transparent_color['red'], $transparent_color['green'], $transparent_color['blue']);
        imagefill($new_image, 0, 0, $current_transparent);
        imagecolortransparent($new_image, $current_transparent);
      } elseif ($this->image_type == IMAGETYPE_PNG) {
        imagealphablending($new_image, false);
        $color = imagecolorallocatealpha($new_image, 0, 0, 0, 127);
        imagefill($new_image, 0, 0, $color);
        imagesavealpha($new_image, true);
      }
    }
    imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
    $this->image = $new_image;
  }

}
