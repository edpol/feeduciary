<?php

namespace feeduciary\Http\Controllers;

use Illuminate\Http\Request;
use feeduciary\Advisor;
use feeduciary\Rate;
use Auth;
use Imagick;

class ImportController extends Controller
{
    public function upload(Advisor $advisor, Request $request)
    {
        $rates=$advisor->rate;
		$file = $request->file('fileUpload');

        if ($file==null) {
            $errors = "No file selected";
            return view('advisors.edit',compact('errors','advisor','rates'));
        }

		$ext = strtolower($file->getClientOriginalExtension());
        $list = ["jpg","jpeg","jpe","png"];
		if(!in_array($ext,$list)) {
            $errors = "Allowed formats: " . implode(",",$list);
            echo $errors;
            return view('advisors.edit',compact('errors','advisor','rates'));
//          return redirect()->back()->withErrors("Not a csv file");
		}

        $filename = $file->getPathname(); // tmp file
        if (empty($filename)) {
            $errors = "No file path";
            return view('advisors.edit',compact('errors','advisor','rates'));
//          return redirect()->back()->withErrors("No File Name");
        }

        if (!file_exists($filename)) {
            $errors = "File {$filename} does not exist";
            return view('advisors.edit',compact('errors','advisor','rates'));
//          return redirect()->back()->withErrors("File {$filename} does not exist");
        }

        $thumbImage = public_path() ."/images/advisorImages/" . $advisor->id . "-thumb.jpg";
        $this->resize($filename, $thumbImage, $ext);
		unlink($filename);	// delete temp file
        $success = "Photo Uploaded Successfully";
        return view('advisors.edit',compact('success','advisor','rates'));
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
		$w[1] = DEFAULT_SIZE;
		$h[1] = intval( round($h[0] * $w[1]/$w[0] ,0) );

		$x = $thumb->resizeImage($w[1],$h[1],Imagick::FILTER_LANCZOS,1);
		$x = $thumb->writeImage($thumbImage);
		return;
	}
}
