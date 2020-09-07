<?php

namespace ayzamodul\department\Http\Controllers;

use App\Http\Controllers\Controller;
use ayzamodul\department\Models\Sehir;
use ayzamodul\department\Models\Sube;
use ayzamodul\department\Models\Unvan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;

class SubeController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:sube-goruntule', ['only' => ['home', 'show', 'tumSubeler', 'subeList']]);
        $this->middleware('permission:sube-ekleDuzenle', ['only' => ['create', 'edit', 'update']]);


        $this->middleware('permission:sube-sil', ['only' => ['delete']]);
    }

    public function home()
    {
        $active = "sube";
        $iller = Sehir::all();
        $unvanlar = Unvan::all();


        return view('sube::islem', compact(['iller', 'unvanlar', 'active']));
    }

    public function indexsube()
    {
        $active = "sube";
        $iller = Sehir::all();
        $unvanlar = Unvan::all();


        return view('sube::sube.create', compact(['iller', 'unvanlar', 'active']));
    }

    public function tumSubeler()
    {
        $active = "subeList";
        $il = Sehir::orderBy('id')->get();
        // $sa= $il[0]->sube()->groupBy('il_id')->get('il_id');

//return $il[2]->sube()->get();


        return view("sube::sube.index", compact('il', 'active'));


    }

    public function show($id)
    {
        $active = "subeList";
        $il_id = $id;

        $sube = Sehir::find($il_id)->sube->where('isDelete', 0);
        $unvan = Unvan::all();
        $iller = Sehir::all();
        $personel = [];
        foreach ($sube as $subes) {
            $personeller = Sube::find($subes->id)->personel->where('isDelete', 0);
            $sa = Sube::find($subes->id)->personel->where('isDelete',0)->pluck('unvan_id');
            foreach ($personeller as $pers) {
                array_push($personel, $pers);
            }
            $unvanlar = Unvan::whereIn('id', $sa)->get();

        }


        //   return $unvanlar;
        return view('sube::sube.show', compact(['sube', 'personel', 'unvanlar', 'active','unvan','iller']));
    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $sube = Sube::find($id);


        if ($sube->count() > 0) {
            $array['ret'] = 1;
            $array['data'] = $sube;

        } else {
            $array['ret'] = 0;
            $array['data'] = null;
        }
        echo json_encode($array);

    }

    public function update(Request $request)
    {


        if ($request->foto_ad) {
            if ($request->isAktif == "true") {
                DB::table('subeler')->where('id', $request->id)->update([
                    'ad' => $request->ad,
                    'adres' => $request->adres,
                    'email' => $request->email,
                    'telno1' => $request->telno1,
                    'telno2' => $request->telno2,
                    'link' => $request->link,
                    'foto_ad' => $request->foto_ad,
                    'isAktif' => 1,

                ]);
            } else {
                DB::table('subeler')->where('id', $request->id)->update([
                    'ad' => $request->ad,
                    'adres' => $request->adres,
                    'email' => $request->email,
                    'telno1' => $request->telno1,
                    'telno2' => $request->telno2,
                    'link' => $request->link,
                    'foto_ad' => $request->foto_ad,
                    'isAktif' => 0,

                ]);
            }

        } else {
            if ($request->isAktif == "true") {
                DB::table('subeler')->where('id', $request->id)->update([
                    'ad' => $request->ad,
                    'adres' => $request->adres,
                    'email' => $request->email,
                    'telno1' => $request->telno1,
                    'telno2' => $request->telno2,
                    'link' => $request->link,
                    'isAktif' => 1,

                ]);

            }else{
                DB::table('subeler')->where('id', $request->id)->update([
                    'ad' => $request->ad,
                    'adres' => $request->adres,
                    'email' => $request->email,
                    'telno1' => $request->telno1,
                    'telno2' => $request->telno2,
                    'link' => $request->link,
                    'isAktif' => 0,

                ]);
            }
        }


        $array['ret'] = 1;
        $array['message'] = "Tebrikler! Güncellemeler başarılı bir şekilde uygulandı.";


        echo json_encode($array);
    }

    public function delete(Request $request)
    {
        $tid = $request->input('tid');
        $sube = Sube::find($tid);
        $sube->isAktif = 0;
        $sube->isDelete = 1;
        $sube->save();

        if ($sube) {
            echo 1;
        } else {
            echo 0;
        }
    }

    public function create(Request $request)
    {
        $data = $request->all();

        $array = [];
        if (isset($request->ils_id)) {
            for ($i = 0; $i < count($data['ils_id']); $i++) {
                if (isset($data['onoffswitch'][$i]) && $data['onoffswitch'][$i] == "false") {
                    $data['onoffswitch'][$i] = 0;
                } else {
                    $data['onoffswitch'][$i] = 1;
                }
                if (isset($request->foto_ads[$i])) {


                    $push = [
                        "il_id" => $data['ils_id'][$i],
                        "ad" => $data['ads'][$i],
                        "adres" => $data['adress'][$i],
                        "email" => $data['emails'][$i],
                        "telno1" => $data['telno1s'][$i],
                        "telno2" => $data['telno2s'][$i],
                        "link" => $data['links'][$i],
                        "harita" => $data['haritas'][$i],
                        "foto_ad" => $data['foto_ads'][$i],
                        "isAktif" => $data['onoffswitch'][$i],

                    ];

                } else {
                    $push = [
                        "il_id" => $data['ils_id'][$i],
                        "ad" => $data['ads'][$i],
                        "adres" => $data['adress'][$i],
                        "email" => $data['emails'][$i],
                        "telno1" => $data['telno1s'][$i],
                        "telno2" => $data['telno2s'][$i],
                        "link" => $data['links'][$i],
                        "harita" => $data['haritas'][$i],
                        "isAktif" => $data['onoffswitch'][$i],

                    ];
                }

                array_push($array, $push);
            }

            //    dd($array);
            foreach ($array as $arrays) {
                if ($request->foto_ads) {
                    $sb = new Sube();
                    $sb->il_id = $arrays['il_id'];
                    $sb->ad = $arrays['ad'];
                    $sb->adres = $arrays['adres'];
                    $sb->email = $arrays['email'];
                    $sb->telno1 = $arrays['telno1'];
                    $sb->telno2 = $arrays['telno2'];
                    $sb->link = $arrays['link'];
                    $sb->harita = $arrays['harita'];
                    if (isset($arrays['isAktif'])) {
                        $sb->isAktif = $arrays['isAktif'];
                    } else {
                        $sb->isAktif = 0;
                    }

                    if (isset($arrays['foto_ad'])) {
                        $sb->foto_ad = $arrays['foto_ad'];
                    } else {
                        $sb->foto_ad = null;
                    }
                    $sb->save();


                } else {
                    $sb = new Sube();
                    $sb->il_id = $arrays['il_id'];
                    $sb->ad = $arrays['ad'];
                    $sb->adres = $arrays['adres'];
                    $sb->email = $arrays['email'];
                    $sb->telno1 = $arrays['telno1'];
                    $sb->telno2 = $arrays['telno2'];
                    $sb->link = $arrays['link'];
                    $sb->harita = $arrays['harita'];
                    if (isset($arrays['isAktif'])) {
                        $sb->isAktif = $arrays['isAktif'];
                    } else {
                        $sb->isAktif = 0;
                    }


                    $sb->save();
                }
            }
            return redirect()->back();
        } else {
            return back()->with('errors', 'Lütfen Önce Kayıt Oluşturunuz');
        }
    }

    public function subeList($il_id)
    {


        $iller = DB::table('subeler')->where('il_id', $il_id)->get();
        return response()->json($iller);

    }
}
