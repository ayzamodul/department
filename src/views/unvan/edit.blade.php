

@extends('yonetim.layouts.master')
@section('title','unvan Düzenle')
@section('content')

    <div id="sube" style="" class="container">
        <form method="POST" action="{{route('unvan.update',['id'=>$unvan->id])}}">
            {{ csrf_field() }}
            <section>
                <div class="panel panel-footer" >
                    <table class="table table-bordered" >
                        <thead>
                        <tr>
                            <th>Unvan bilgileri</th>

                        </tr>
                        </thead>

                        <tbody>


                        <tr>
                            <td ><input value="{{$unvan->unvan}}" type="text" name="unvan" class="form-control" ></td>

                        </tr>



                        </tbody>
                        <td><input  type="submit" name="" value="Kaydet" class="btn btn-success pull-right"></td>

                    </table>
                </div>
            </section>

        </form>
    </div>

@endsection
