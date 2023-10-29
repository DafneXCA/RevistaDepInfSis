<?php

namespace App\Http\Controllers;
use App\Models\Revista;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Collection;

class revistaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $revistas=Revista::all();
        
        foreach ($revistas as $revista) {
         //   print(asset($revista->url_from_page));
            $revista->url_from_page=asset($revista->url_from_page);
            $revista->url=asset($revista->url);
        }
        return response()->json($revistas, 200);
   
    }

               // print(str_replace('storage','public',$revista->url_from_page));
            //print(Storage::get(str_replace('storage','public',$revista->url_from_page)));
            //Storage::get($revista->url_from_page);
            // $img=base64_encode(file_get_contents(public_path($revista->url_from_page)));
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $new_revista=new Revista();
        
        $new_revista->name=$request->name;
        
        $journal=$request->file('journal');      
        $new_revista->url=Storage::url($journal->storeAs('public/journals',str_replace(' ','_',"pdf".$request->name.'.'.$journal->extension())));
        
        $from_page=$request->file('from_page');
        $new_revista->url_from_page=Storage::url($from_page->storeAs('public/from_pages',str_replace(' ','_',"img".$request->name.'.'.$from_page->extension())));
       
        $new_revista->save();
        return response()->json($new_revista, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $revista_id=Revista::find($id);
        return response()->json($revista_id, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $revista=Revista::find($request->id);
        $revista->name=$request->name;
      
        $revista->save();

        return response()->json($revista, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $revista=Revista::find($id);
        $revista->delete();

        return response()->json('eliminado', 200);
    }

    public function download($id)
    {
        $revista=Revista::find($id);
        $name=$revista->name;
        $revista=public_path($revista->url);
      
        return response()->download($revista,$name);
    }
}
