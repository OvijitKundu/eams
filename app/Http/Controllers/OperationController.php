<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Supplier;
use App\Models\Operation;
use App\Models\Objectaccess;
use App\Models\Objecttorole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PHPUnit\Framework\Constraint\Operator;

class OperationController extends Controller
{


    function operationList(Request $request)
    {
        $operation       = Operation::with('user')->orderBy('id', 'desc')->get();


        $login          = Auth::user()->id;
        $access         = Objectaccess::with('user', 'manageobject')
            ->where('user_id', '=', $login)
            ->orderBy('user_id', 'asc')->get();

        $userrole       = Auth::user()->rollmanage_id;
        $roleaccess     = Objecttorole::with('user', 'manageobject')
            ->where('rollmanage_id', '=', $userrole)->get();

        return view("pages.operationPages.operation-list", compact('access', 'roleaccess', 'operation'));
    }


    function operationView(Request $request)
    {
        $operation  = Operation::with('user')->orderBy('id', 'desc')->get();

        $login          = Auth::user()->id;
        $access         = Objectaccess::with('user', 'manageobject')
            ->where('user_id', '=', $login)
            ->orderBy('user_id', 'asc')->get();

        $userrole       = Auth::user()->rollmanage_id;
        $roleaccess     = Objecttorole::with('user', 'manageobject')
            ->where('rollmanage_id', '=', $userrole)->get();

        return view("pages.operationPages.operation-create", compact('access', 'roleaccess', 'operation'));
    }


    public function operationStore(Request $request)
    {

        $request->validate([
            'operation_name' => 'required',
            'description'    => 'required|max:255',
        ]);

        $data                   = [];
        $data['operation_name']  = $request->operation_name;
        $data['description']        = $request->description;
        $data['user_id']        = Auth::user()->id;

        $operation = Operation::insert($data);

        if ($operation) {
            return redirect()->route('operation-view')->with('message', 'Operation added Successfully');
        } else {
            return redirect()->back();
        }
    }

    public function operationEdit($id)
    {

        $operation  = Operation::with('user')->where('id', $id)->first();

        $login          = Auth::user()->id;
        $access         = Objectaccess::with('user', 'manageobject')
            ->where('user_id', '=', $login)
            ->orderBy('user_id', 'asc')->get();

        $userrole = Auth::user()->rollmanage_id;
        $roleaccess = Objecttorole::with('user', 'manageobject')
            ->where('rollmanage_id', '=', $userrole)->get();

        return view("pages.operationPages.operation-edit", compact('access', 'roleaccess', 'operation'));
    }


    public function operationUpdate(Request $request){
        $request->validate([
            'operation_name' => 'required',
            'description'    => 'required|max:255',
        ]);

        $data                   = [];
        $data['operation_name']  = $request->operation_name;
        $data['description']        = $request->description;
        $data['user_id']        = Auth::user()->id;

        $operation = Operation::where('id', $request->id)->update($data);

        if ($operation) {
            return redirect()->route('operation-view')->with('message', 'Operation updated Successfully');
        } else {
            return redirect()->back();
        }
    }


    public function operationDelete($id)
    {
        $result = Operation::find($id)->delete();
        if ($result) {
            return redirect()->route('operation-view')->with('message', 'Data deleted successfully');
        } else {
            return redirect()->back();
        }
    }
}
