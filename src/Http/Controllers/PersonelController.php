<?php

namespace ayzamodul\department\Http\Controllers;

use App\Http\Controllers\Controller;
use ayzamodul\department\Models\Personel;
use ayzamodul\department\Models\Sehir;
use ayzamodul\department\Models\Sube;
use ayzamodul\department\Models\Unvan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Image;

class PersonelController extends Controller
{
    public function show()
    {
        $active = 'personel';
        $unvan = Unvan::get();
        $unvans = Unvan::all();
        $iller = Sehir::all();
        $subeler = Sube::where('isDelete', 0)->get();
        $personel = Personel::where('isDelete', 0)->get();
        return view('sube::personel.index', compact('personel', 'active', 'unvan', 'iller', 'subeler'));
    }

    public function edit(Request $request)
    {

        $id = $request->id;
        $personel = Personel::find($id);
        if ($personel->count() > 0) {
            $array['ret'] = 1;
            $array['data'] = $personel;

        } else {
            $array['ret'] = 0;
            $array['data'] = null;
        }
        echo json_encode($array);


    }

    public function indexpersonel()
    {
        $active = "personel";
        $iller = Sehir::all();
        $unvanlar = Unvan::all();
        $unvans = Unvan::get();


        return view('sube::personel.create', compact('iller', 'unvanlar', 'active','unvans'));
    }

    public function newPersonal(Request $request)
    {
        $tid = $request->input('tid');
        $ad = $request->input('ad');
        $soyad = $request->input('soyad');
        $email = $request->input('email');
        $telno = $request->input('telno');
        $password = $request->input('password');
        $unvan = $request->input('unvan');
        $foto_ad = $request->input('foto_ad');
        $sube = Sube::find($tid);
        $il = $sube->il->id;


        $personal = new Personel();
        $personal->ad = $ad;
        $personal->sube_id = $tid;
        $personal->soyad = $soyad;
        $personal->email = $email;
        $personal->telno = $telno;
        $personal->password = Hash::make($password);
        $personal->unvan_id = $unvan;
        if ($foto_ad) {
            $personal->foto_ad = $foto_ad;
        }

        $personal->il_id = $il;
        $personal->isAktif = 1;
        $personal->isDelete = 0;
        $personal->save();
        if ($personal) {
            echo 1;
        } else {
            echo 0;
        }
    }


    public function update(Request $request)
    {

        if ($request->password == null && $request->foto_ad == null) {
            if ($request->isAktif=="true") {
                DB::table('personel')->where('id', $request->id)->update([
                    'ad' => $request->ad,
                    'soyad' => $request->soyad,
                    'email' => $request->email,
                    'telno' => $request->telno,
                    'unvan_id' => $request->unvan,
                    'il_id' => $request->il_id,
                    'sube_id' => $request->sube_id,
                    'isAktif' => 1,

                ]);

            } elseif($request->isAktif=="false") {
                DB::table('personel')->where('id', $request->id)->update([
                    'ad' => $request->ad,
                    'soyad' => $request->soyad,
                    'email' => $request->email,
                    'telno' => $request->telno,
                    'unvan_id' => $request->unvan,
                    'il_id' => $request->il_id,
                    'sube_id' => $request->sube_id,
                    'isAktif' => 0,
                ]);
            }else{
                DB::table('personel')->where('id', $request->id)->update([
                    'ad' => $request->ad,
                    'soyad' => $request->soyad,
                    'email' => $request->email,
                    'telno' => $request->telno,
                    'unvan_id' => $request->unvan,
                    'il_id' => $request->il_id,
                    'sube_id' => $request->sube_id,

                ]);
            }


        } else if ($request->password != null && $request->foto_ad != null) {
            if ($request->isAktif=="true") {
                DB::table('personel')->where('id', $request->id)->update([
                    'ad' => $request->ad,
                    'soyad' => $request->soyad,
                    'email' => $request->email,
                    'telno' => $request->telno,
                    'unvan_id' => $request->unvan,
                    'foto_ad' => $request->foto_ad,
                    'il_id' => $request->il_id,
                    'sube_id' => $request->sube_id,
                    'password' => Hash::make($request->password),
                    'isAktif' => 1,
                ]);
            } elseif($request->isAktif=="false") {
                DB::table('personel')->where('id', $request->id)->update([
                    'ad' => $request->ad,
                    'soyad' => $request->soyad,
                    'email' => $request->email,
                    'telno' => $request->telno,
                    'unvan_id' => $request->unvan,
                    'foto_ad' => $request->foto_ad,
                    'il_id' => $request->il_id,
                    'sube_id' => $request->sube_id,
                    'password' => Hash::make($request->password),
                    'isAktif' => 0,
                ]);
            }else{
                DB::table('personel')->where('id', $request->id)->update([
                    'ad' => $request->ad,
                    'soyad' => $request->soyad,
                    'email' => $request->email,
                    'telno' => $request->telno,
                    'unvan_id' => $request->unvan,
                    'foto_ad' => $request->foto_ad,
                    'il_id' => $request->il_id,
                    'sube_id' => $request->sube_id,
                    'password' => Hash::make($request->password),

                ]);
            }
        } else if ($request->password == null && $request->foto_ad != null) {
            if ($request->isAktif=="true") {
                DB::table('personel')->where('id', $request->id)->update([
                    'ad' => $request->ad,
                    'soyad' => $request->soyad,
                    'email' => $request->email,
                    'telno' => $request->telno,
                    'unvan_id' => $request->unvan,
                    'il_id' => $request->il_id,
                    'sube_id' => $request->sube_id,
                    'foto_ad' => $request->foto_ad,
                    'isAktif' => 1,
                ]);
            } elseif($request->isAktif=="false") {
                DB::table('personel')->where('id', $request->id)->update([
                    'ad' => $request->ad,
                    'soyad' => $request->soyad,
                    'email' => $request->email,
                    'telno' => $request->telno,
                    'unvan_id' => $request->unvan,
                    'il_id' => $request->il_id,
                    'sube_id' => $request->sube_id,
                    'foto_ad' => $request->foto_ad,
                    'isAktif' => 0,
                ]);
            }else{
                DB::table('personel')->where('id', $request->id)->update([
                    'ad' => $request->ad,
                    'soyad' => $request->soyad,
                    'email' => $request->email,
                    'telno' => $request->telno,
                    'unvan_id' => $request->unvan,
                    'il_id' => $request->il_id,
                    'sube_id' => $request->sube_id,
                    'foto_ad' => $request->foto_ad,

                ]);
            }
        } else {
            if ($request->isAktif=="true") {
                DB::table('personel')->where('id', $request->id)->update([
                    'ad' => $request->ad,
                    'soyad' => $request->soyad,
                    'email' => $request->email,
                    'telno' => $request->telno,
                    'unvan_id' => $request->unvan,
                    'il_id' => $request->il_id,
                    'sube_id' => $request->sube_id,
                    'password' => Hash::make($request->password),
                    'isAktif' => 1,
                ]);
            } elseif($request->isAktif=="false") {
                DB::table('personel')->where('id', $request->id)->update([
                    'ad' => $request->ad,
                    'soyad' => $request->soyad,
                    'email' => $request->email,
                    'telno' => $request->telno,
                    'unvan_id' => $request->unvan,
                    'il_id' => $request->il_id,
                    'sube_id' => $request->sube_id,
                    'password' => Hash::make($request->password),
                    'isAktif' => 0,
                ]);
            }else{
                DB::table('personel')->where('id', $request->id)->update([
                    'ad' => $request->ad,
                    'soyad' => $request->soyad,
                    'email' => $request->email,
                    'telno' => $request->telno,
                    'unvan_id' => $request->unvan,
                    'il_id' => $request->il_id,
                    'sube_id' => $request->sube_id,
                    'password' => Hash::make($request->password),

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
        $personel = Personel::find($tid);
        $personel->isAktif = 0;
        $personel->isDelete = 1;
        $personel->save();

        if ($personel) {
            echo 1;
        } else {
            echo 0;
        }
    }

    public function create(Request $request)
    {
        $data = $request->all();

        $array = [];

        if (isset($request->il_id)) {
            for ($i = 0; $i < count($data['il_id']); $i++) {
                if (isset($data['onoffswitch'][$i]) && $data['onoffswitch'][$i] == "false") {
                    $data['onoffswitch'][$i] = 0;
                } else {
                    $data['onoffswitch'][$i] = 1;
                }
                if (isset($request->foto_ad[$i])) {


                    $push = [
                        "il_id" => $data['il_id'][$i],
                        "sube_id" => $data['sube_id'][$i],
                        "ad" => $data['ad'][$i],
                        "soyad" => $data['soyad'][$i],
                        "email" => $data['email'][$i],
                        "telno" => $data['telno'][$i],
                        "unvan_id" => $data['unvan_id'][$i],
                        "password" => Hash::make($data['password'][$i]),
                        "foto_ad" => $request->foto_ad[$i],
                        "isAktif" => $data['onoffswitch'][$i],
                    ];
                } else {

                    $push = [
                        "il_id" => $data['il_id'][$i],
                        "sube_id" => $data['sube_id'][$i],
                        "ad" => $data['ad'][$i],
                        "soyad" => $data['soyad'][$i],
                        "email" => $data['email'][$i],
                        "telno" => $data['telno'][$i],
                        "unvan_id" => $data['unvan_id'][$i],
                        "password" => Hash::make($data['password'][$i]),
                        "isAktif" => $data['onoffswitch'][$i],

                    ];
                }

                array_push($array, $push);
            }

            foreach ($array as $arrays) {
                if ($request->foto_ad) {
                    $pr = new Personel();
                    $pr->il_id = $arrays['il_id'];
                    $pr->sube_id = $arrays['sube_id'];
                    $pr->ad = $arrays['ad'];
                    $pr->soyad = $arrays['soyad'];
                    $pr->email = $arrays['email'];
                    $pr->telno = $arrays['telno'];
                    $pr->password = $arrays['password'];
                    $pr->unvan_id = $arrays['unvan_id'];

                    $pr->isDelete = 0;
                    if (isset($arrays['isAktif'])) {
                        $pr->isAktif = $arrays['isAktif'];
                    } else {
                        $pr->isAktif = 0;
                    }
                    if (isset($arrays['foto_ad'])) {
                        $pr->foto_ad = $arrays['foto_ad'];
                    } else {
                        $pr->foto_ad = null;
                    }


                    $pr->save();
                } else {
                    $pr = new Personel();
                    $pr->il_id = $arrays['il_id'];
                    $pr->sube_id = $arrays['sube_id'];
                    $pr->ad = $arrays['ad'];
                    $pr->soyad = $arrays['soyad'];
                    $pr->email = $arrays['email'];
                    $pr->telno = $arrays['telno'];
                    $pr->password = $arrays['password'];
                    $pr->unvan_id = $arrays['unvan_id'];
                    if (isset($arrays['isAktif'])) {
                        $pr->isAktif = $arrays['isAktif'];
                    } else {
                        $pr->isAktif = 0;
                    }
                    $pr->isDelete = 0;


                    $pr->save();
                }

            }
            return redirect()->back();
        } else {
            return back()->with('errors', 'Lütfen Önce Kayıt Oluşturunuz');
        }
    }
}
