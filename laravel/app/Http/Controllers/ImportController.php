<?php

namespace feeduciary\Http\Controllers;

use Illuminate\Http\Request;
use feeduciary\Advisor;
use Auth;
use Imagick;

class ImportController extends Controller
{
    public function upload(Advisor $advisor, Request $request)
    {
		$file = $request->file('fileUpload');

        if ($file==null) {
            $errors = "No file";
            return view('import.results',compact('errors'));
        }

		$ext = strtolower($file->getClientOriginalExtension());
        $list = ["bmp","gif","jpg","jpeg","jpe","png","tif","tiff"];
		if(!in_array($ext,$list)) {
            $errors = "Not an image file";
            echo $errors;
            return view('import.results',compact('errors'));
//          return redirect()->back()->withErrors("Not a csv file");
		}

        $filename = $file->getPathname(); // tmp file
        if (empty($filename)) {
            $errors = "No file name";
            return view('import.results',compact('errors'));
//          return redirect()->back()->withErrors("No File Name");
        }

        if (!file_exists($filename)) {
            $errors = "File {$filename} does not exist";
            return view('import.results',compact('errors'));
//          return redirect()->back()->withErrors("File {$filename} does not exist");
        }

        $thumbImage = public_path() ."/images/advisorImages/" . $advisor->id . "-thumb." . $ext;
        $this->resize($filename, $thumbImage, $ext);
		unlink($filename);	// delete temp file
        return view('import.results',compact('success'));
    }

    public function resize($image,$thumbImage,$ext)
    {
		$thumb = new Imagick($image);
		$thumb->setImageUnits(imagick::RESOLUTION_PIXELSPERINCH);
		$thumb->setImageResolution(72,72);

		$imageprops = $thumb->getImageGeometry();
		$w = array();
		$h = array();
		$w[0] = $imageprops['width'];
		$h[0] = $imageprops['height'];
		$w[1] = 120;
		$h[1] = intval( round($h[0] * $w[1]/$w[0] ,0) );

		$x = $thumb->resizeImage($w[1],$h[1],Imagick::FILTER_LANCZOS,1);
		$x = $thumb->writeImage($thumbImage);
		return;
	}
}
