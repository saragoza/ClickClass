<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Yajra\Datatables\Datatables;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\DB;

use Illuminate\Routing\Redirector;

use App\Doc;

use App\User;

use App\Type;

class Docs extends Controller
{
    /**
     * Display a listing of the user docs.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('layouts.viewfiles_table');
    }

    /**
     * Data for the user docs datatable.
     *
     * @return Datatables
     */
    public function getMyDocs()
    {
        $docs = DB::table('docs')
                 ->leftJoin('perms', 'docs.id', '=', 'perms.id_doc')
                 ->select('docs.*')
                 ->where('docs.owner', '=', Auth::id())
                 ->orWhere('perms.id_user', '=', Auth::id())
                 ->orderBy('docs.id', 'asc')
                 ->distinct()
                 ->get();
        return Datatables::of($docs)->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createFile()
    {
        $types = Type::all();
        return view ('layouts.sharefile_form')->with(['types' => $types]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeFile(Request $request)
    {
        $this->validate($request, [
            'description' => 'bail|required|string|min:10|max:100',
            'file_type' => 'required',
            'sharedfile' => 'required',
            'searchtags' => 'bail|nullable|string|max:250',
            'additinfo' => 'bail|nullable|string|max:500',
        ]);

        $doc = new Doc();
        $doc->description = $request->description;
        $doc->type = $request->file_type;
        $doc->filename = time().'_'.$request->file('sharedfile')->getClientOriginalName();
        $doc->addit_info = $request->additinfo;
        $doc->tags = $request->searchtags;
        $doc->owner = Auth::id();

        $file = $request->file('sharedfile');
        Storage::disk('sharedFiles')->put($doc->filename, file_get_contents($file->getRealPath()));

        if ($doc->save()){
            $request->session()->flash('message.level', 'ok');
            $request->session()->flash('message.content', 'Archivo compartido con éxito');
        }
        else {
            $request->session()->flash('message.level', 'error');
            $request->session()->flash('message.content', 'Error al compartir el archivo');
        }
        return redirect('/docs/create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showFile($id)
    {
        $doc = Doc::find($id);
        if ($doc->owner != null) {
            $user = User::find($doc->owner);
        }
        else{
            $user = null;
        }

        return view('layouts.showfile_details')->with(['doc' => $doc, 'user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editFile($id)
    {
        $doc = Doc::find($id);
        $types = Type::all();
        return view ('layouts.sharefile_form')->with(['types' => $types, 'doc' => $doc]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateFile(Request $request, $id)
    {
        $this->validate($request, [
            'description' => 'bail|required|string|min:10|max:100',
            'file_type' => 'required',
            'searchtags' => 'bail|nullable|string|max:250',
            'additinfo' => 'bail|nullable|string|max:500',
        ]);

        $doc = Doc::find($id);
        $doc->description = $request->description;
        $doc->type = $request->file_type;
        $doc->addit_info = $request->additinfo;
        $doc->tags = $request->searchtags;

        if($request->file('sharedfile') != null){
            Storage::disk('sharedFiles')->delete($doc->filename);
            $doc->filename = time().'_'.$request->file('sharedfile')->getClientOriginalName();
            $file = $request->file('sharedfile');
            Storage::disk('sharedFiles')->put($doc->filename, file_get_contents($file->getRealPath()));
        }

        if ($doc->save()){
            $request->session()->flash('message.level', 'ok');
            $request->session()->flash('message.content', 'Archivo editado con éxito');
        }
        else {
            $request->session()->flash('message.level', 'error');
            $request->session()->flash('message.content', 'Error al editar el archivo');
        }
        return redirect('/docs/edit/'.$id);
    }

    /**
     * Remove the specified resource from database and storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteFile(Request $request)
    {
        $doc = Doc::find($request->id);
        $filename = $doc->filename;

        if ($doc->delete()){
            Storage::disk('sharedFiles')->delete($filename);
        }
        return view('layouts.viewfiles_table');
    }

    /**
    * Display a listing of all docs.
    *
    * @return \Illuminate\Http\Response
    */
    public function searchFiles()
    {
        return view('layouts.searchresult_table');
    }

    /**
     * Data for all docs datatable.
     *
     * @return Datatables
     */
    public function getDocs()
    {
        $docs = Doc::all();
        return Datatables::of($docs)->make(true);
    }

    /**
     * Download the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function downloadFile($id)
    {
        $doc = Doc::find($id);
        $path = storage_path('sharedFiles/'.$doc->filename);

        return response()->download($path);

    }

}



