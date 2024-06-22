<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Sparepart;
use App\Models\Objectaccess;
use App\Models\Objecttorole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SparepartController extends Controller
{
    function sparepartList(Request $request){
       
        $company        =Company::where('name','=',Auth::user()->company_name)->get();
        $sparepart       =Sparepart::with('company','user')->orderBy('id', 'desc')->get();
        
        $login          =Auth::user()->id; 
        $access         =Objectaccess::with('user','manageobject')
        ->where('user_id','=', $login)
        ->orderBy('user_id', 'asc')->get();

        $userrole       =Auth::user()->rollmanage_id;
        $roleaccess     =Objecttorole::with('user','manageobject')
        ->where('rollmanage_id','=', $userrole)->get();

        return view("pages.sparepartPages.sparepart-list",compact("company",'access' ,'roleaccess','sparepart'));
        
    }
    
    
    function sparepartView(Request $request){
       
        $company        =Company::where('name','=',Auth::user()->company_name)->get();
        $sparepart       =Sparepart::with('company','user')->orderBy('id', 'desc')->get();
        
        $login          =Auth::user()->id; 
        $access         =Objectaccess::with('user','manageobject')
        ->where('user_id','=', $login)
        ->orderBy('user_id', 'asc')->get();

        $userrole       =Auth::user()->rollmanage_id;
        $roleaccess     =Objecttorole::with('user','manageobject')
        ->where('rollmanage_id','=', $userrole)->get();

        return view("pages.sparepartPages.sparepart-create",compact("company",'access' ,'roleaccess','sparepart'));
        
    }


    public function sparepartStore(Request $request)
    {
       
        $request->validate([
            'part_no'           => 'required',
            'name'              => 'required',
            'description'       => 'required|max:255',
        ]);

        $data                   = [];
        $data['part_no']        = $request->part_no;
        $data['name']           = $request->name;
        $data['description']    = $request->description;

        $data['user_id']        = Auth::user()->id;
       

        $sparepart = Sparepart::insert($data);

        if($sparepart)
        {
            return redirect()->route('spareparts-view')->with('message','Sparepart added Successfully');

        }else
        {
            return redirect()->back();
        }
    }


    public function sparepartEdit($id)
    {
       
        $sparepart      =Sparepart::with('company')->where('id',$id)->first(); 
        $login          =Auth::user()->id; 
        $access         = Objectaccess::with('user','manageobject')
        ->where('user_id','=', $login)
        ->orderBy('user_id', 'asc')->get();

        $userrole       =Auth::user()->rollmanage_id;
        $roleaccess     =Objecttorole::with('user','manageobject')
        ->where('rollmanage_id','=', $userrole)->get();

        return view("pages.sparepartPages.sparepart-edit",compact('access','roleaccess','sparepart' ));
        
    }


    public function sparepartUpate(Request $request)
    {
        $request->validate([
            'part_no'       => 'required|string|max:255',
            'name'          => 'required|string|max:255',
            'description'   => 'required|string|max:255',
        ]);

        $data = [];
        $data['part_no']        = $request->part_no;
        $data['name']           = $request->name;
        $data['description']    = $request->description;

        $update = Sparepart::where('id', $request->id)->limit(1)->update($data);



        // $data = $request->only(['part_no', 'name', 'description']);

        // $update = sparepart::where('id', $request->id)->update($data);

        if ($update) {
            return redirect()->route('spareparts-view')->with('message', 'Sparepart Updated Successfully');
        } else {
            return redirect()->back()->with('error', 'Failed to update sparepart');
        }
    }


    public function sparepartDelete($id){
        $result = Sparepart::find($id)->delete();
        if($result){
            return redirect()->route('spareparts-view')->with('message','Data deleted successfully');
        }else{
            return redirect()->back();
        }
    }


    public function sparepartReport(Request $request, $id){
        $sparepart = Sparepart::findOrFail($id);
        return view('pages.sparepartPages.sparepart-report', compact('sparepart'));
    }

}
