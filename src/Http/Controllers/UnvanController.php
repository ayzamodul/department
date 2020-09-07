<?php

namespace ayzamodul\department\Http\Controllers;
use App\Http\Controllers\Controller;

use App\Models\blog_comments;
use App\Models\contact;
use ayzamodul\department\Models\Unvan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Yajra\DataTables\Facades\DataTables;

class UnvanController extends Controller
{
    public function dataTable()
    {
        $type = Input::get('type');

        switch ($type) {


            case 'cons_demo_st':


                $comments = Unvan::where('isAktif', 1);

                return DataTables::eloquent($comments)->toJson();
                break;



        }

    }
    public function load(Request $request)
    {
        $type = $request->input('type');
        switch ($type) {
            case 'unvan' :
                $id = $request->input('data_id');
                $sira = $request->input('sira') + 1;
                $qb_control = Unvan::where('id', $id)->count();
                if ($qb_control > 0) {
                    $question_upd = Unvan::find($id);
                    $question_upd->sira = $sira;
                    $question_upd->save();
                }
                break;
        }
    }
    public function create(Request $request ,$id=null)
    {
        $sira = Unvan::orderByDesc('sira')->pluck('sira')->first();

        $unvan=new Unvan();

        $unvan->unvan=$request->unvan;
        $unvan->isAktif=1;
        $unvan->sira = $sira+1;
        $unvan->save();

        return redirect()->back();
    }
    public function Update(Request $request)
    {

         DB::table('unvan')->where('id',$request->id)
         ->update([
             'unvan'=>$request->unvan
         ]);
        return redirect()->route('unvan.show');//url('/yonetim/sube/unvan/show');
    }
    public function delete(Request $request)
    {
     
        $tid = $request->input('tid');



        $unvan = Unvan::find($tid);
        $unvan->isAktif = 0;
        $unvan->save();

        if ($unvan) {
            echo 1;
        } else {
            echo 0;
        }
    }
    public function show()
    {
        $active ="unvan";
        $unvan=Unvan::all()->where('isAktif',1);
        return view("sube::unvan.show",compact('unvan','active'));
    }
    public function edit($id){

        $active ="unvan";
        $unvan=Unvan::all()->where('isAktif',1);
        $unvan_id=$id;
        $unvanUpdate=Unvan::find($unvan_id);
        return view('sube::unvan.show',compact('unvanUpdate','active','unvan'));
    }
}
