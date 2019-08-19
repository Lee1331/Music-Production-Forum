<?php
namespace App\Traits;
use Image;
trait AddImage
{
    public function addImage($image, $request){
        $imageRequest = $request->file($image);
        $imageName = time() . '.' . $imageRequest->getClientOriginalExtension();
        $location = public_path('images/'.$imageName);
        Image::make($imageRequest)->save($location);
        return $imageName;
    }
}
?>
