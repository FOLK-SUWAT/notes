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
            <form action="{{route('notesprivate.update', $notes->id )}}" method="post" enctype="multipart/form-data">
                <center> <img src="{{url('/images/'.$notes->image)}}" alt="Image" width="350"/> </center>
                {{ method_field('put')}}
                {{ csrf_field()}}
                        <label for="">หัวข้อ:</label><br>
                        <input type="text" id="title" name="title" value="{{ $notes->title }}" style="width: 100%"><br>
                        <label for="">เนื้อหา:</label><br>
                        <textarea  style="width:600px; " id="detail" name="detail" style="width: 100%">{{ $notes->detail }}</textarea><br>

                </form>
                <a href="{{route('notesprivate.index')}}" ><button class="btn btn-lg rightButton">กลับ</button></a>
            </div>

        </div>
        
    </div>
</div>
@endsection
