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
                        <a href="{{route('notesprivate.create')}}" ><button class="btn btn-sm rightButton">เพิ่ม โน๊ต</button></a>
                        </div>
                </div>


               


               
            </div>
            <div class="row">
            @foreach($notes as $notes)
            <div class="col-sm-4">
                    <div class="card panel panel-default" style="width: 18.3rem;">
                        
                        @if ($notes->image !="")
                    <center> <img src="{{url('/images/'.$notes->image)}}" alt="Image" width="150" height="100"/> </center>
                    
                            
                        @else
                        <div style="height: 100px" ></div>
                        @endif
                    

                        <div class="card-body" style="width: 170px">
                            <h5 class="card-title" style="width: 170px; word-wrap: break-word;">{{ $notes->title}}</h5>
                            <p class="card-text" style="
                            max-width:170px;  
                            word-wrap: break-word; 
                            white-space:nowrap; 
                            width:250px; 
                            overflow:hidden;
                            border:1px solid #008BCE;
                            text-overflow:ellipsis;" >{{ $notes->detail}}</p>
                            <p class="card-text"><small class="text-muted"> by. {{ Auth::user()->name }}</small></p>
                        </div>

                        <div class="panel " style="width: 18.3rem;height: 10px;">
                            <div class="col-sm-4">
                                <a href="{{route('notesprivate.edit2', $notes->id )}}" class=" btn btn-sm btn-success rightButton">ดู</a> 
                            </div>
                            <div class="col-sm-4">
                                <a href="{{route('notesprivate.edit', $notes->id)}}" class=" btn btn-sm btn-primary rightButton">แก้ไข</a> 
                            </div>

                            <div class="col-sm-4">
                                
                                    <form action="{{route('notesprivate.destroy', $notes->id )}}" method="post" class="rightButton">
                                        {{ method_field('delete')}}
                                        {{ csrf_field()}}
                                                <input type="submit" class="btn btn-sm btn-danger rightButton" value="ลบ"><br>
                                    </form>
                            </div>
                        </div>

                    </div>
                    </div>
                    @endforeach
            </div>
            
        </div>

        
    </div>
    
</div>

<div class="col-12 text-right">
    <a href="javascript:void(0)" class="btn btn-success lg-3" id="create-new-post" onclick="addPost()">เพิ่ม โน๊ต</a>
  </div>

<div class="modal fade" id="post-modal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title"></h4>
          </div>
          <div class="modal-body">
            <form action="/notesprivate" method="post" enctype="multipart/form-data">
                {{  csrf_field() }}
                         <label for="">หัวข้อ:</label><br>
                         <input type="text" style="width:350px;" id="title" name="title"><br>
                         <label for="">ข้อความ:</label><br>
                         <textarea class="form-control" id="detail" name="detail"  rows="4" cols="50"> </textarea> <br>
                         <input type="file" name="image" >
                         <input type="submit" value="บันทึก"><br>
                 </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" onclick="createPost()">Save</button>
          </div>
      </div>
    </div>
  </div>






  <script>
    $('#laravel_crud').DataTable();
  
    function addPost() {
      $('#post-modal').modal('show');
    }
  

  
    function createPost() {
      var title = $('#title').val();
      var detail = $('#detail').val();
      let _url     = 'notesprivate.create';
      let _token   = $('meta[name="csrf-token"]').attr('content');
  
        $.ajax({
          url: _url,
          type: "POST",
          contentType: 'multipart/form-data',
          data: {
            title: title,
            detail: detail,
            _token: _token
          },
          success: function(response) {
              
          },
        
        });
    }
  
  
  </script>
@endsection
