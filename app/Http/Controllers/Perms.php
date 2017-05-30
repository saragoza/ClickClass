<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Yajra\Datatables\Datatables;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

use App\Doc;

use App\Perm;

class Perms extends Controller
{
    /**
     * Display a listing of the users and their perms over the selected doc.
     *
     * @return \Illuminate\Http\Response
     */
    public function showPerms($id){
        return view('layouts.assignperms_table');
    }

    /**
     * Data for the perms datatable.
     *
     * @return Datatables
     */
    public function getUsers($id){

        $query = "select us.id, us.name, false as hasPerms from users us where not exists (select id_user from perms where id_user=us.id and id_doc=".$id.") and id != ".Auth::id()." UNION select us.id, us.name, true as hasPerms from users us join perms pe on us.id = pe.id_user where pe.id_doc = ".$id;

        $users = DB::select($query);

        return Datatables::of($users)->make(true);
    }

    /**
     * Remove the specified perm from database.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function deletePerms(Request $request)
    {
        DB::table('perms')->where('id_doc', '=', $request->id_doc)->where('id_user', '=', $request->id_user)->delete();

        return view('layouts.assignperms_table');
    }

    /**
     * Store the specified perm in database.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function newPerms(Request $request)
    {
        $perm = new Perm();
        $perm->id_user = $request->id_user;
        $perm->id_doc = $request->id_doc;
        $perm->save();

        return view('layouts.assignperms_table');
    }

    /**
     * Get the filename of the selected doc.
     *
     * @param  Request  $request
     * @return $filename
     */
    public function getFilename(Request $request)
    {
        $doc = Doc::find($request->id);
        $filename = $doc->filename;

        return $filename;
    }
}
