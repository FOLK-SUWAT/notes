<?php

namespace App\Http\Controllers;

use App\notes;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;
class NotesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = auth()->user()->id;
        
        $notes = DB::table('notes')->where('idname',$id)
        ->get();
        
        return view('notes-private',compact('notes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('notes-private-create');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = auth()->user()->id;
        $this->validate($request,[
            'title' =>['required','min:2'],
            'detail' =>['required','min:5'],
            
          
            ]);
            
            $image = $request->file('image');

          

           if($image !=""){
            $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $input['imagename']);

            $note = \App\notes::create(
            ['title' => $request->input('title'),
            'detail' => $request->input('detail'),
            'imge' => $input['imagename'],
           'idname' => $id,
            ]
        );

    }else{
        $note = \App\notes::create(
            ['title' => $request->input('title'),
            'detail' => $request->input('detail'),
            'imge' => "",
           'idname' => $id,
            ]
        );
    }
            
            session()->flash('status',''.$note->title.'เพิ่มโน๊ตแล้ว');
            return redirect()->route('notesprivate.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\notes  $notes
     * @return \Illuminate\Http\Response
     */
    public function show(notes $notes)
    {
     
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\notes  $notes
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $notes = \App\notes::find($id);
        return view('notes-private-edit',['notes'=>$notes]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\notes  $notes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'title' =>['required','min:2'],
            'detail' =>['required','min:5'],
          
            ]);
              $image = $request->file('image');
            $notes = \App\notes::find($id);
            $id = auth()->user()->id;



            $notes ->update(
                ['title' => $request->input('title'),
                'detail' => $request->input('detail'),
               'idname' =>$id,
                ]
            );


            if($image !=""){
                $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/images');
                $image->move($destinationPath, $input['imagename']);
    
             
            $notes ->update(
                ['title' => $request->input('title'),
                'detail' => $request->input('detail'),
                'imge' => $input['imagename'],
               'idname' =>$id,
                ]
            );

          

         

    
        }else{
            $notes ->update(
                ['title' => $request->input('title'),
                'detail' => $request->input('detail'),
               'idname' =>$id,
                ]
            );

        }





            session()->flash('status',''.$notes->title.'แก้ไขโน๊ตแล้ว');
            return redirect()->route('notesprivate.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\notes  $notes
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $notes = \App\notes::find($id);



        $notes ->delete();

        session()->flash('status','ลบโน๊ตแล้ว');
        return redirect()->route('notesprivate.index');
    }
}
