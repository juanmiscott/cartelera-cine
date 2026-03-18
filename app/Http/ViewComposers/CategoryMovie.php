<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Models\MySQL\FilmCategory as DBFilmCategory;

class CategoryMovie
{
  static $composed;

  public function __construct(private DBFilmCategory $filmCategories){}

  public function compose(View $view)
  {
    if(static::$composed)
    {
      return $view->with('filmCategories', static::$composed);
    }

    static::$composed = $this->filmCategories->orderBy('name', 'asc')->get();

    $view->with('filmCategories', static::$composed);
  }
}

