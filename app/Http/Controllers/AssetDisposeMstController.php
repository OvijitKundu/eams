<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Company;
use App\Models\Workshop;
use App\Models\Assetitem;
use App\Models\Objectaccess;
use App\Models\Objecttorole;
use Illuminate\Http\Request;
use App\Models\AssetDisposeDtl;
use App\Models\AssetDisposeMst;
use App\Models\Member;
use Illuminate\Support\Facades\Auth;

class AssetDisposeMstController extends Controller
{
    function assetDisposeView(Request $request){
        $login = Auth::user()->id; 
        $access = Objectaccess::with('user','manageobject')
            ->where('user_id', '=', $login)
            ->orderBy('user_id', 'asc')->get();

        $userrole = Auth::user()->rollmanage_id;
        $roleaccess = Objecttorole::with('user','manageobject')
            ->where('rollmanage_id', '=', $userrole)->get();

        // Fetch asset items that are not disposed
        $disposedAssetIds = AssetDisposeDtl::pluck('assetitem_id')->toArray();
        $assetitems = Assetitem::whereNotIn('id', $disposedAssetIds)
            ->orderBy('id', 'desc')->get();

        // Data collect from other tables
        $workShopName = Workshop::orderBy('id', 'desc')->get();
        // $companyName = Company::orderBy('id', 'desc')->get();
        $member = Member::orderBy('id', 'desc')->get();
        $users = User::orderBy('id', 'desc')->get();
        // $assetitems = Assetitem::orderBy('id', 'desc')->get();
        // $companyId = Auth::user()->company_id;


        return view("pages.assetDisposePages.asset-dispose-create", compact(
            'access', 'roleaccess',  'users', 'workShopName', 'assetitems', 'member'
        ));
    }


    public function assetDisposeStore(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'panel_members'             => 'required|string|max:255',
            'approver'              => 'required|string|max:255',
            // 'status'              => 'required|string|max:255',
            'workshop_id'                 => 'required|exists:workshops,id',
            // 'company_id'               => 'required|exists:companies,id',
            // 'user_id'           => 'required|exists:users,id',
            'remarks.*'        => 'required|string',
            'assetitem_id.*'              => 'required|exists:assetitems,id',
        ]);

        //  user_id with the authenticated user's ID
        $validatedData['user_id']       = Auth::id();
        // $validatedData['company_id']    = $request->company_id;
        $validatedData['company_id'] = Auth::user()->company->id;
        $validatedData['status']        = 'Pending';
        $validatedData['updated_by'] = Auth::user()->name;


        // Create a new Asset_dispose_mst
        $assetDispose_mst = AssetDisposeMst::create($validatedData);

        if ($assetDispose_mst) {
            // Extract detail data from request
            $detailData = [];
            foreach ($request->input('assetitem_id') as $key => $value) {
                $detailData[] = [
                    'asset_dispose_mst_id'   => $assetDispose_mst->id,
                    'assetitem_id'      => $request->input('assetitem_id')[$key],
                    'remarks'      => $request->input('remarks')[$key],                   
                    'user_id'               => Auth::id(),
                    // 'company_id' => Auth::user()->company_id,
                    'updated_by'            => Auth::user()->name,
                ];
            }

            // Create detail records
            AssetDisposeDtl::insert($detailData);

            return redirect()->route('assetDispose-view')->with('message', 'Asset Dispose Successfully');
            } else {
                return redirect()->back()->with('error', 'Failed to Asset Dispose');
            }
    }
    

    function assetDisposeList(Request $request){

        $login          =Auth::user()->id; 
        $access         =Objectaccess::with('user','manageobject')
        ->where('user_id','=', $login)
        ->orderBy('user_id', 'asc')->get();

        $userrole       =Auth::user()->rollmanage_id;
        $roleaccess     =Objecttorole::with('user','manageobject')
        ->where('rollmanage_id','=', $userrole)->get();
        
        $assetDisposeDetailsList = AssetDisposeDtl::with('assetDisposeMst')
        ->whereHas('assetDisposeMst', function ($query) {
            $query->where('status', 'Pending');
        })->get();
              

        return view("pages.assetDisposePages.asset-dispose-list",compact(
            'access' ,
            'roleaccess', 
        'assetDisposeDetailsList'
        ));
        
    }

    
    public function assetDisposeApprovedList(Request $request)
    {
        $login = Auth::user()->id;
        $access = Objectaccess::with('user', 'manageobject')
            ->where('user_id', '=', $login)
            ->orderBy('user_id', 'asc')
            ->get();

        $userrole = Auth::user()->rollmanage_id;
        $roleaccess = Objecttorole::with('user', 'manageobject')
            ->where('rollmanage_id', '=', $userrole)
            ->get();

        $approvedAssetDisposeDetailsList = AssetDisposeDtl::with('assetDisposeMst')
            ->whereHas('assetDisposeMst', function ($query) {
                $query->where('status', 'Approved');
            })->get();

        return view("pages.assetDisposePages.asset-dispose-approved-list", compact('access', 'roleaccess', 'approvedAssetDisposeDetailsList'));
    }


    // public function assetDisposeEdit($id)
    // {
    //     // Retrieve the specific Asset Disposal Master record with related company, workshop, and user
    //     $assetDisposeDtl = AssetDisposeDtl::with('user')
    //         ->where('id', $id)
    //         ->first();

    //     // Get the logged-in user's ID
    //     $login = Auth::user()->id;

    //     // Retrieve the logged-in user's object access records
    //     $access = Objectaccess::with('user', 'manageobject')
    //         ->where('user_id', '=', $login)
    //         ->orderBy('user_id', 'asc')
    //         ->get();

    //     // Get the logged-in user's role ID
    //     $userrole = Auth::user()->rollmanage_id;

    //     // Retrieve the role's object access records
    //     $roleaccess = Objecttorole::with('user', 'manageobject')
    //         ->where('rollmanage_id', '=', $userrole)
    //         ->get();

    //     return view("pages.assetDisposePages.asset-dispose-edit", compact('access', 'roleaccess', 'assetDisposeDtl'));
    // }


    public function assetDisposeEdit($id)
    {
        // Retrieve the specific Asset Disposal Master record with related company, workshop, and user
        $assetDisposeMst = AssetDisposeMst::with('company', 'workshop', 'user', 'details')
            ->where('id', $id)
            ->first();

        // Get the logged-in user's ID
        $login = Auth::user()->id;

        // Retrieve the logged-in user's object access records
        $access = Objectaccess::with('user', 'manageobject')
            ->where('user_id', '=', $login)
            ->orderBy('user_id', 'asc')
            ->get();

        // Get the logged-in user's role ID
        $userrole = Auth::user()->rollmanage_id;

        // Retrieve the role's object access records
        $roleaccess = Objecttorole::with('user', 'manageobject')
            ->where('rollmanage_id', '=', $userrole)
            ->get();

        return view("pages.assetDisposePages.asset-dispose-edit", compact('access', 'roleaccess', 'assetDisposeMst'));
    }


    public function assetDisposeUpdate(Request $request)
    {
        // Validate the request data
        $request->validate([
            'id' => 'required|exists:asset_dispose_msts,id',
            'approval_status' => 'required|string|max:255',
        ]);

        // Prepare the data to be updated
        $data = [
            'status' => $request->approval_status,
            'updated_by' => Auth::user()->id,
        ];

        // Update the AssetDisposeMst instance
        $update = AssetDisposeMst::where('id', $request->id)->update($data);

        // Check if the update was successful and redirect accordingly
        if($update){
            return redirect()->route('assetDispose-list')->with('message', 'Asset dispose updated successfully');
        } else {
            return redirect()->back()->withErrors(['message' => 'Failed to update asset dispose']);
        }
    }


    public function assetDisposeDelete($id){
        $result = AssetDisposeDtl::find($id)->delete();
        if($result){
            return redirect()->route('assetDispose-list')->with('message','Data deleted successfully');
        }else{
            return redirect()->back();
        }
    }


    public function assetDisposeReport(Request $request, $id){
        $assetDispose = AssetDisposeDtl::findOrFail($id);
        return view('pages.assetDisposePages.asset-dispose-report', compact('assetDispose'));
    }

   
}
