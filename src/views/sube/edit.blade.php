@extends('yonetim.layouts.master')
@section('title','Şube Düzenle')
@section('content')

    <h2>{{$sube->ad}}</h2>
    <div id="sube" style="" class="row">
        <form method="POST" action="{{route('sube.update',['id'=>$sube->id])}}">
            {{ csrf_field() }}
            <section>
                <div class="panel panel-footer" >
                    <table class="table table-bordered" >
                        <thead>
                        <tr>
                            <th>Sube bilgileri</th>

                        </tr>
                        </thead>

                        <tbody>


                        <tr>
                            <td ><input value="{{$sube->ad}}" type="text" name="ad" class="form-control" ></td>

                        </tr>
                        <tr>
                            <td><input value="{{$sube->adres}}" type="text" name="adres" class="form-control" ></td>

                        </tr>
                        <tr>
                            <td><input value="{{$sube->email}}" type="text" name="email" class="form-control"></td>

                        </tr>
                        <tr>

                            <td><input value="{{$sube->telno1}}" type="text" name="telno1" class="form-control" ></td>

                        </tr>
                        <tr>

                            <td><input value="{{$sube->telno2}}" type="text" name="telno2" class="form-control" ></td>

                        </tr>


                        </tbody>

                    </table>
                </div>
            </section>
            <td><input  type="submit" name="" value="Kaydet" class="btn btn-success"></td>

        </form>
    </div>

@endsection
