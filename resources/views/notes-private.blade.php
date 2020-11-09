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


                <div class="panel-heading text-center">Note private 

                    <div class="pull-right">
                        <a href="{{route('notesprivate.create')}}" ><button class="btn btn-sm rightButton">โน๊ต</button></a>
                        </div>
                </div>


               


               
            </div>
            <div class="row">
            @foreach($notes as $notes)
            <div class="col-sm-4">
            <div class="card panel panel-default" style="width: 18.3rem;">
                
                @if ($notes->imge !="")
                <img src="{{url('/images/'.$notes->imge)}}" alt="Image" width="180"/>
                @endif
              

                <div class="card-body" style="width: 170px">
                  <h5 class="card-title" style="width: 170px; word-wrap: break-word;">{{ $notes->title}}</h5>
                  <p class="card-text" style="max-width:170px;  word-wrap: break-word;" >{{ $notes->detail}}</p>
                  <p class="card-text"><small class="text-muted"> by. {{ Auth::user()->name }}</small></p>
                  <a href="{{route('notesprivate.edit', $notes->id)}}" class=" btn btn-sm btn-info rightButton">แก้ไข</a> 
                 
                    <form action="{{route('notesprivate.destroy', $notes->id )}}" method="post" class="rightButton">
                        {{ method_field('delete')}}
                        {{ csrf_field()}}
                                <input type="submit" class="btn btn-xs btn-primary rightButton" value="ลบ"><br>
                    </form>
                </div>
              </div>
            </div>
              @endforeach
            </div>
        </div>

        
    </div>
    
</div>

@endsection
