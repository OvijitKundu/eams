<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Uom;
use App\Models\Brand;
use App\Models\Order;
use App\Models\Member;
use App\Models\Company;
use App\models\Currency;
use App\Models\Supplier;
use App\Models\Workshop;
use App\Models\Assetitem;
use App\Models\Operation;
use App\Models\Sparepart;
use App\Models\Workorder;
use App\Models\Womaterial;
use App\Models\Wooperation;

use App\Models\Categorytype;
use App\Models\Objectaccess;
use App\Models\Objecttorole;
use Illuminate\Http\Request;

use App\Models\Categorymodel;

use App\models\Assetitem_po_mst;

use Illuminate\Support\Facades\Auth;

class WorkorderController extends Controller
{
    function workorderList(Request $request){
       
        $company        =Company::where('name','=',Auth::user()->company_name)->get();
      
        $comid          = $company[0]->id;
        $workshop       =Workshop::with('company')->where('company_id','=',$comid)->get();
       
        $assetitem      =Assetitem::with('company','user','brand','categorymodel')
                        ->where('company_id','=',$comid)
                        ->orderBy('id', 'DESC')
                        ->get();
        $count          =Workorder::where('company_id','=',$comid)->count();
        $workorder      =Workorder::with('company','user')->where('approval_stas','=','Pending')
                        ->where('company_id','=',$comid)
                        ->where('user_id','=',Auth::user()->id)
                        ->get();
        $org_workorder  =Workorder::with('company','user','assetitem','workshop')->where('approval_stas','=','Pending')
                        ->where('company_id','=',$comid)
                        ->get();
        $members        =Member::where('company_id','=',$comid)
                        ->where('department','=','Engineering')
                        ->get();
        $lastWorkorderid = Workorder::latest('id')->first();
                   //    dd($lastWorkorderid->id);
        $brand          =Brand::orderBy('name', 'asc')->get();
        $operations     =Operation::orderBy('operation_name', 'asc')->get();
        $spareparts     =Sparepart::orderBy('name', 'asc')->get();
        $categorymodel  =Categorymodel::with('categorytype')->orderBy('name', 'asc')->get();
        $subcategory    =Categorytype::with('category')->orderBy('name', 'asc')->get();

        $supplier       =Supplier::orderBy('name', 'asc')->get();
        $currency       =Currency::orderBy('name', 'asc')->get();

        $uom            =Uom::orderBy('name', 'asc')->get();


        $login          =Auth::user()->id; 
        $access         =Objectaccess::with('user','manageobject')
        ->where('user_id','=', $login)
        ->orderBy('user_id', 'asc')->get();

        $userrole       =Auth::user()->rollmanage_id;
        $roleaccess     =Objecttorole::with('user','manageobject')
        ->where('rollmanage_id','=', $userrole)->get();

        return view("pages.workOrderPages.workOrder-list",compact("company",'access' ,'roleaccess','assetitem','supplier','currency','subcategory','workshop','workorder','operations','spareparts','uom','org_workorder','members'));
       
    }
    
    function workOrderApprovalPending(Request $request){
       
        $company        =Company::where('name','=',Auth::user()->company_name)->get();
      
        $comid          = $company[0]->id;
        $workshop       =Workshop::with('company')->where('company_id','=',$comid)->get();
       
        $assetitem      =Assetitem::with('company','user','brand','categorymodel')
                        ->where('company_id','=',$comid)
                        ->orderBy('id', 'DESC')
                        ->get();
        $count          =Workorder::where('company_id','=',$comid)->count();
        $workorder      =Workorder::with('company','user')->where('approval_stas','=','Approved')
                        ->where('company_id','=',$comid)
                        ->where('user_id','=',Auth::user()->id)
                        ->get();
        $org_workorder  =Workorder::with('company','user','assetitem','workshop')->where('approval_stas','=','Approved')
                        ->where('company_id','=',$comid)
                        ->get();
        $members        =Member::where('company_id','=',$comid)
                        ->where('department','=','Engineering')
                        ->get();
        $lastWorkorderid = Workorder::latest('id')->first();
                   //    dd($lastWorkorderid->id);
        $brand          =Brand::orderBy('name', 'asc')->get();
        $operations     =Operation::orderBy('operation_name', 'asc')->get();
        $spareparts     =Sparepart::orderBy('name', 'asc')->get();
        $categorymodel  =Categorymodel::with('categorytype')->orderBy('name', 'asc')->get();
        $subcategory    =Categorytype::with('category')->orderBy('name', 'asc')->get();

        $supplier       =Supplier::orderBy('name', 'asc')->get();
        $currency       =Currency::orderBy('name', 'asc')->get();

        $uom            =Uom::orderBy('name', 'asc')->get();


        $login          =Auth::user()->id; 
        $access         =Objectaccess::with('user','manageobject')
        ->where('user_id','=', $login)
        ->orderBy('user_id', 'asc')->get();

        $userrole       =Auth::user()->rollmanage_id;
        $roleaccess     =Objecttorole::with('user','manageobject')
        ->where('rollmanage_id','=', $userrole)->get();

        return view("pages.workOrderPages.workOrder-approvalPendaing",compact("company",'access' ,'roleaccess','assetitem','supplier','currency','subcategory','workshop','workorder','operations','spareparts','uom','org_workorder','members'));
       
    }

    function workorderView(Request $request){
       
      
        $company        =Company::where('name','=',Auth::user()->company_name)->get();
      
        $comid          = $company[0]->id;
        $workshop       =Workshop::with('company')->where('company_id','=',$comid)->get();
       
        $assetitem      =Assetitem::with('company','user','brand','categorymodel')
                        ->where('company_id','=',$comid)
                        ->orderBy('id', 'DESC')
                        ->get();
        $count          =Workorder::where('company_id','=',$comid)->count();
        $workorder      =Workorder::with('company','user')->where('approval_stas','=','Pending')
                        ->where('company_id','=',$comid)
                        ->where('user_id','=',Auth::user()->id)
                        ->get();
        $org_workorder  =Workorder::with('company','user','assetitem','workshop')->where('approval_stas','=','Pending')
                        ->where('company_id','=',$comid)
                        ->get();
        $members        =Member::where('company_id','=',$comid)
                        ->where('department','=','Engineering')
                        ->get();
        $lastWorkorderid = Workorder::latest('id')->first();
                   //    dd($lastWorkorderid->id);
        $brand          =Brand::orderBy('name', 'asc')->get();
        $operations     =Operation::orderBy('operation_name', 'asc')->get();
        $spareparts     =Sparepart::orderBy('name', 'asc')->get();
        $categorymodel  =Categorymodel::with('categorytype')->orderBy('name', 'asc')->get();
        $subcategory    =Categorytype::with('category')->orderBy('name', 'asc')->get();

        $supplier       =Supplier::orderBy('name', 'asc')->get();
        $currency       =Currency::orderBy('name', 'asc')->get();

        $uom            =Uom::orderBy('name', 'asc')->get();


        $login          =Auth::user()->id; 
        $access         =Objectaccess::with('user','manageobject')
        ->where('user_id','=', $login)
        ->orderBy('user_id', 'asc')->get();

        $userrole       =Auth::user()->rollmanage_id;
        $roleaccess     =Objecttorole::with('user','manageobject')
        ->where('rollmanage_id','=', $userrole)->get();

        return view("pages.workOrderPages.workOrder-create",compact("company",'access' ,'roleaccess','assetitem','supplier','currency','subcategory','workshop','workorder','operations','spareparts','uom','org_workorder','members'));
       
    }

 

    public function store(Request $request)
    {
        $company        =Company::where('name','=',Auth::user()->company_name)->get();
        $comid          =$company[0]->id;
        $count          =Workorder::where('company_id','=',$comid)->count();
        $lastWorkorderid = Workorder::latest('id')->first();
        
        
        $validatedData = $request->validate([
           
            'failure_cause'         => 'required',
            'workorder_type'        => 'required',
            'priority'              => 'required',
            'before_efficiency'     => 'required',
            'approve_stats_by'      => 'required',
            'workshop_id'           => 'required',
            'assetitem_id'          => 'required',

           
        ]);


        $data                           = [];
        $data['workorder_no']           = 'WO'.date('ymd').'--'. $lastWorkorderid->id+1;
        $data['failure_cause']          = $request->failure_cause;
        $data['workorder_type']         = $request->workorder_type;
        $data['priority']               = $request->priority;
        $data['before_efficiency']      = $request->before_efficiency;
        $data['approve_stats_by']       = $request->approve_stats_by;
        $data['workshop_id']            = $request->workshop_id;
        $data['assetitem_id']           = $request->assetitem_id;
        $data['company_id']             = $request->company_id;
        $data['user_id']                = Auth::user()->id;
    

        $order = Workorder::create($data);

        if($order)
        {
            return redirect()->route('work_order')->with('message','supplier added Successfully');

        }else
        {
            return redirect()->back();
        }
       
    }

    public function workorderEdit($id)
    {
        $workorder  =workorder::with('company','assetitem')->where('id',$id)->first();
       
        $company        =Company::where('name','=',Auth::user()->company_name)->get();
      
        $comid          = $company[0]->id;
        $workshop       =Workshop::with('company')->where('company_id','=',$comid)->get();
       
        $assetitem      =Assetitem::with('company','user','brand','categorymodel')
                        ->where('company_id','=',$comid)
                        ->orderBy('id', 'DESC')
                        ->get();
        $count          =Workorder::where('company_id','=',$comid)->count();
       
        $org_workorder  =Workorder::with('company','user','assetitem','workshop')->where('approval_stas','=','Pending')
                        ->where('company_id','=',$comid)
                        ->get();
        $members        =Member::where('company_id','=',$comid)
                        ->where('department','=','Engineering')
                        ->get();
        $lastWorkorderid = Workorder::latest('id')->first();
                   //    dd($lastWorkorderid->id);
        $brand          =Brand::orderBy('name', 'asc')->get();
        $operations     =Operation::orderBy('operation_name', 'asc')->get();
        $spareparts     =Sparepart::orderBy('name', 'asc')->get();
        $categorymodel  =Categorymodel::with('categorytype')->orderBy('name', 'asc')->get();
        $subcategory    =Categorytype::with('category')->orderBy('name', 'asc')->get();

        $supplier       =Supplier::orderBy('name', 'asc')->get();
        $currency       =Currency::orderBy('name', 'asc')->get();

        $uom            =Uom::orderBy('name', 'asc')->get();


        $login          =Auth::user()->id; 
        $access         =Objectaccess::with('user','manageobject')
        ->where('user_id','=', $login)
        ->orderBy('user_id', 'asc')->get();

        $userrole       =Auth::user()->rollmanage_id;
        $roleaccess     =Objecttorole::with('user','manageobject')
        ->where('rollmanage_id','=', $userrole)->get();

        return view("pages.workOrderPages.workOrder-edit",compact("company",'access' ,'roleaccess','assetitem','supplier','currency','subcategory','workshop','workorder','operations','spareparts','uom','org_workorder','members'));
        
    }

    public function workorderUpate(Request $request)
    {

        $data                   = [];
        $data['approval_stas']           = $request->approval_stas;
       
        $update = Workorder::where('id', $request->id)->limit(1)->update($data);

        if($update){
                    return redirect()->route('work_order_list')->with('message','Workorder Updated Successfully');
                    
                }else{
                    return redirect()->back();
                }
    }
    
    

    public function workorderMaintenance($id)
    {
        $workorder  =workorder::with('company','assetitem')->where('id',$id)->first();
       
        $company        =Company::where('name','=',Auth::user()->company_name)->get();
      
        $comid          = $company[0]->id;
        $workshop       =Workshop::with('company')->where('company_id','=',$comid)->get();
       
        $assetitem      =Assetitem::with('company','user','brand','categorymodel')
                        ->where('company_id','=',$comid)
                        ->orderBy('id', 'DESC')
                        ->get();
        $count          =Workorder::where('company_id','=',$comid)->count();
       
        $org_workorder  =Workorder::with('company','user','assetitem','workshop')->where('approval_stas','=','Pending')
                        ->where('company_id','=',$comid)
                        ->get();
        $members        =Member::where('company_id','=',$comid)
                        ->where('department','=','Engineering')
                        ->get();
        $lastWorkorderid = Workorder::latest('id')->first();
                   //    dd($lastWorkorderid->id);
        $brand          =Brand::orderBy('name', 'asc')->get();
        $operations     =Operation::orderBy('operation_name', 'asc')->get();
        $spareparts     =Sparepart::orderBy('name', 'asc')->get();
        $categorymodel  =Categorymodel::with('categorytype')->orderBy('name', 'asc')->get();
        $subcategory    =Categorytype::with('category')->orderBy('name', 'asc')->get();

        $supplier       =Supplier::orderBy('name', 'asc')->get();
        $currency       =Currency::orderBy('name', 'asc')->get();

        $uom            =Uom::orderBy('name', 'asc')->get();


        $login          =Auth::user()->id; 
        $access         =Objectaccess::with('user','manageobject')
        ->where('user_id','=', $login)
        ->orderBy('user_id', 'asc')->get();

        $userrole       =Auth::user()->rollmanage_id;
        $roleaccess     =Objecttorole::with('user','manageobject')
        ->where('rollmanage_id','=', $userrole)->get();

        return view("pages.workOrderPages.workOrder-maintenance",compact("company",'access' ,'roleaccess','assetitem','supplier','currency','subcategory','workshop','workorder','operations','spareparts','uom','org_workorder','members'));
        
    }

    public function workorderMaintenanceStore(Request $request)
    {

        $workorder =$request->id;


        $checkdata = $request->validate([
           
            'operations[0][resoulation]'             => 'required',
            // 'operation_id'            => 'required',
            // 'member_id'               => 'nullable',
            // 'duration'                => 'required',
            // 'started_at'              => 'required',
            // 'ended_at'                => 'required',

           
        ]);

        // Validate the request data
        $validatedData = $request->validate([
            // protected $fillable = [ 'workorder_id', 'operation_id','resoulation',
            // 'member_id','duration','started_at','ended_at'];
            
            // 'resoulation'             => 'required',
            // 'operation_id'            => 'required',
            // 'member_id'               => 'nullable',
            // 'duration'                => 'required',
            // 'started_at'              => 'required',
            // 'ended_at'                => 'required',

            // protected $fillable = [ 'activities', 'quantity','sparepart_id',
            // 'uom_id','company_id','workorder_id','operation_id','user_id'];

            // 'activities.*'             => 'nullable|numeric',
            // 'quantity.*'               => 'nullable|numeric',
            // 'operation_id.*'           => 'nullable|numeric',
            // 'sparepart_id.*'           => 'nullable|numeric',
            // 'uom_id.*'                 => 'required|exists:uoms,id',
        ]);

       
            //  user_id with the authenticated user's ID
            $validatedData['updated_by']        = Auth::user()->id;
            $validatedData['company_id']        = Auth::user()->company_id;
            $validatedData['status']            = 'Completed';
            $validatedData['approval_stas']     = 'Released';
           
        
            $dataupdate = Workorder::where('id', $request->id)->limit(1)->update($validatedData);
       
            
            foreach ($request->input('operations') as $operation) {
                Wooperation::create([
                    'workorder_id' => $workorder,
                    'resoulation' => $operation['resoulation'],
                    'operation_id' => $operation['operation_id'],
                    'member_id' => $operation['member_id'],
                    'duration' => $operation['duration'],
                    'started_at' => $operation['started_at'],
                    'ended_at' => $operation['ended_at'],
                ]);
            }
    
            return redirect()->route('workOrderApprovalPending')->with('success', 'Work Order created successfully');


    }

    



    public function workorderDeleteCreator($id){
        $result = Workorder::find($id)->delete();
        if($result){
            return redirect()->route('work_order')->with('message','Data deleted successfully');
        }else{
            return redirect()->back();
        }
    }

    public function workorderDeleteApprover($id){
        $result = Workorder::find($id)->delete();
        if($result){
            return redirect()->route('work_order_list')->with('message','Data deleted successfully');
        }else{
            return redirect()->back();
        }
    }
}
