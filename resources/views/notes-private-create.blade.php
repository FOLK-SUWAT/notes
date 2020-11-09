@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif


                <div class="panel-heading text-center">Note private</div>

                @if($errors->count())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        {{ $error}}<br>
                    @endforeach
                </div>
            @endif

            <form action="/notesprivate" method="post" enctype="multipart/form-data">
           {{  csrf_field() }}
                    <label for="">หัวข้อ:</label><br>
                    <input type="text" style="width:350px;" id="title" name="title"><br>
                    <label for="">ข้อความ:</label><br>
                    <textarea  type="text" style="width:600px;" id="detail" name="detail"></textarea><br>
                    <input type="file" name="image" >
                    <input type="submit" value="บันทึก"><br>
            </form>
                
               
            </div>

        </div>
        
    </div>
</div>
@endsection
