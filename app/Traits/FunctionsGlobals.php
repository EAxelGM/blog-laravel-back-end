<?php
namespace App\Traits;


use Illuminate\Support\Str;

trait FunctionsGlobals{
  public function TextToSlug($text){
    $slug = Str::slug($text);
    return $slug;
  }
}