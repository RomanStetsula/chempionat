<?php namespace Unisharp\Laravelfilemanager\controllers;

use Unisharp\Laravelfilemanager\controllers\Controller;
use Intervention\Image\Facades\Image;

/**
 * Class CropController
 * @package Unisharp\Laravelfilemanager\controllers
 */
class CropController extends LfmController
{
    /**
     * Show crop page
     *
     * @return mixed
     */
    public function getCrop()
    {
        $working_dir = request('working_dir');
        $img = parent::getFileUrl(request('img'));

        return view('laravel-filemanager::crop')
            ->with(compact('working_dir', 'img'));
    }


    /**
     * Crop the image (called via ajax)
     */
    public function getCropimage()
    {
        $image      = request('img');
        $dataX      = request('dataX');
        $dataY      = request('dataY');
        $dataHeight = request('dataHeight');
        $dataWidth  = request('dataWidth');
        $image_path = public_path().$image;

        $path = explode($_SERVER['SERVER_NAME'].'/', $image); //get folder were img placed 
       

//         crop image
        Image::make($image)
          ->crop($dataWidth, $dataHeight, $dataX, $dataY)
          ->save($path[1]);

        // make new thumbnail
         $full_thumb_path = parent::getThumbPath(parent::getName($image_path));
         $thumb_path = explode('public\\', $full_thumb_path);
         
        Image::make($image)
          ->fit(200, 200)
          ->save($thumb_path[1]);

    }
}
