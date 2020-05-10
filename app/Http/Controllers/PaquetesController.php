<?php

namespace App\Http\Controllers;

use App\Charts\MyChart;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Stichoza\GoogleTranslate\GoogleTranslate;

class PaquetesController extends Controller
{
    public function charts(){
        $chart = new MyChart();
        return view('paquetes.chart', ['chart' => $chart->my_chart()]);
    }

    public function image(){
        $img = Image::make('/public/img.png');
        $img->resize(200,200, function($constraint){
            $constraint->aspectRatio();
        });

        $img->save('imagen');
    }

    public function qr_generate(){
        return QrCode::format()->generate('Codigo cu ere', '../public/qrcodes/qrcode.svg');
    }

    public function translate(){
        $tr = new GoogleTranslate('en');
        $tr->setSource('es');
        echo $tr->translate("hola");
    }
}
