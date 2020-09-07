@extends('yonetim.layouts.master')
@section('title','Personel Düzenle')
@section('content')



    <div id="personel" style="" class="container">
        <form method="POST" action="{{route('personel.update',['id'=>$personel->id])}}">
            {{ csrf_field() }}
            <section>
                <div class="panel panel-footer" >
                    <table class="table table-bordered" >
                        <thead>
                        <tr>
                            <th>Personel bilgileri</th>

                        </tr>
                        </thead>

                        <tbody>


                        <tr>
                            <td ><input value="{{$personel->ad}}" type="text" name="ad" class="form-control" ></td>

                        </tr>
                        <tr>
                            <td><input value="{{$personel->soyad}}" type="text" name="soyad" class="form-control" ></td>

                        </tr>
                        <tr>
                            <td><input value="{{$personel->email}}" type="text" name="email" class="form-control"></td>

                        </tr>
                        <tr>

                            <td><input value="{{$personel->telno}}" type="text" name="telno" class="form-control" ></td>

                        </tr>
                        <tr>

                            <td><input placeholder="şifre" type="text" name="password" class="form-control" ></td>

                        </tr>

                        </tbody>

                    </table>
                </div>
            </section>
            <td><input  type="submit" name="" value="Kaydet" class="btn btn-success"></td>

        </form>
    </div>
@endsection
