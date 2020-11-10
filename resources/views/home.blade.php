@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                @if (session('status'))
                            <div class="alert alert-success text-center">
                                {{ Auth::user()->name }} {{ session('status') }}
                            </div>
                        @endif

                    

                <div class="panel-heading text-center">หน้าหลัก</div>
                <div class="panel col-md-6 panel-body">
                  
                </div>
                <div class="panel col-md-6 panel-body">
                    <a href="{{ action('NotesController@index') }}"><button class="btn btn-success">Notes Meeting</button></a>
                </div>
            </div>

        </div>
        
    </div>
</div>
@endsection

