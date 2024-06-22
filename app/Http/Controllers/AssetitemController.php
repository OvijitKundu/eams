<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Company;
use App\models\Currency;
use App\Models\Supplier;
use App\Models\Assetitem;
use App\Models\Categorytype;
use App\Models\Objectaccess;
use App\Models\Objecttorole;
use Illuminate\Http\Request;
use App\Models\Categorymodel;
use App\models\Assetitem_po_mst;

use Illuminate\Support\Facades\Auth;

class AssetitemController extends Controller
{
    

    function assetList(Request $request){
       
        $company        =Company::where('name','=',Auth::user()->company_name)->get();
        $assetitem      =Assetitem::with('company','user','brand','categorymodel')->orderBy('id', 'DESC')->get();
       
        $brand          =Brand::orderBy('name', 'asc')->get();
       // $categorymodel  =Categorymodel::orderBy('name', 'asc')->get();

        $categorymodel  =Categorymodel::with('categorytype')->orderBy('name', 'asc')->get();
        $subcategory    =Categorytype::with('category')->orderBy('name', 'asc')->get();

        $supplier       =Supplier::orderBy('name', 'asc')->get();
        $currency       =Currency::orderBy('name', 'asc')->get();

        $login          =Auth::user()->id; 
        $access         =Objectaccess::with('user','manageobject')
        ->where('user_id','=', $login)
        ->orderBy('user_id', 'asc')->get();

        $userrole       =Auth::user()->rollmanage_id;
        $roleaccess     =Objecttorole::with('user','manageobject')
        ->where('rollmanage_id','=', $userrole)->get();

        return view("pages.assetItemPages.assetitem-list",compact("company",'access' ,'roleaccess','assetitem','supplier','currency','subcategory'));
        
    }
    
    
    function assetView(Request $request){
       
        $company        =Company::where('name','=',Auth::user()->company_name)->get();
        $assetitem      =Assetitem::with('company','user','brand','categorymodel')->orderBy('id', 'desc')->get();
        
        $pomst          =Assetitem_po_mst::where('status','=','Active')->orderBy('po_gen_id', 'asc')->get();
        $brand          =Brand::orderBy('name', 'asc')->get();

        $categorymodel  =Categorymodel::with('categorytype')->orderBy('name', 'asc')->get();
        $subcategory    =Categorytype::with('category')->orderBy('name', 'asc')->get();
        
        $supplier       =Supplier::orderBy('name', 'asc')->get();
        $currency       =Currency::orderBy('name', 'asc')->get();

        $login          =Auth::user()->id; 
        $access         =Objectaccess::with('user','manageobject')
        ->where('user_id','=', $login)
        ->orderBy('user_id', 'asc')->get();

        $userrole       =Auth::user()->rollmanage_id;
        $roleaccess     =Objecttorole::with('user','manageobject')
        ->where('rollmanage_id','=', $userrole)->get();

        return view("pages.assetItemPages.assetitem-create",compact("company",'access' ,'roleaccess','assetitem','brand','categorymodel','supplier','currency','pomst','subcategory'));
        
    }


    public function asseyStore(Request $request)
    {
       
        $request->validate([
            
            'asset_no'              => 'required|unique:assetitems|max:255',
            'manufacture_no'        => 'required|unique:assetitems|max:255',
            'supplier_id'           => 'required',
            'assetitem_po_mst_id'   => 'required',
            'brand_id'              => 'required',
            'categorymodel_id'      => 'required',
            'currency_id'           => 'required',

            'pruchase_date'         => 'required',
            'unit_price'            => 'required',
            // 'gov_registration_no'   => 'unique:assetitems|max:255',
            // 'chassis_no'            => 'unique:assetitems|max:255',
            // 'enginee_no'            => 'unique:assetitems|max:255',
            
        ]);

        // <!-- `asset_no`, `manufacture_no`, `gov_registration_no`, `chassis_no`, `enginee_no`, `stock_sts`, `pruchase_date`, `unit_price`, `WarrantyEndDate`, `DepreciationRate`, `supplier_id`, `brand_id`, `categorymodel_id`,currency_id, `user_id`, `company_id`, `updated_by`, `created_at`, `updated_at` -->

        $data                           = [];
        $data['assetitem_po_mst_id']    = $request->assetitem_po_mst_id;
        $data['asset_no']               = $request->asset_no;
        $data['manufacture_no']         = $request->manufacture_no;
        $data['pruchase_date']          = $request->pruchase_date;
        $data['unit_price']             = $request->unit_price;
        $data['WarrantyEndDate']        = $request->WarrantyEndDate;
        $data['DepreciationRate']       = $request->DepreciationRate;
        $data['supplier_id']            = $request->supplier_id;
        $data['currency_id']            = $request->currency_id;
        $data['gov_registration_no']    = $request->gov_registration_no;
        $data['chassis_no']             = $request->chassis_no;
        $data['enginee_no']             = $request->enginee_no;
        $data['stock_sts']              = "Stock in hand";
        $data['asset_status']           = "Active";
        $data['categorymodel_id']       = $request->categorymodel_id;
        $data['brand_id']               = $request->brand_id;
        $data['company_id']             = $request->company_id;
        $data['user_id']                = Auth::user()->id;
       

        $assetitem = Assetitem::insert($data);

        if($assetitem)
        {
            return redirect()->route('asset_view')->with('message','supplier added Successfully');

        }else
        {
            return redirect()->back();
        }
    }


    public function assetEdit($id)
    {
       
        $assetitem      =Assetitem::with('company')->where('id',$id)->first();
        $pomst          =Assetitem_po_mst::where('status','=','Active')->orderBy('po_gen_id', 'asc')->get();
        $brand          =Brand::orderBy('name', 'asc')->get();
       // $categorymodel  =Categorymodel::orderBy('name', 'asc')->get();
        
        $categorymodel  =Categorymodel::with('categorytype')->orderBy('name', 'asc')->get();
        $subcategory    =Categorytype::with('category')->orderBy('name', 'asc')->get();

        $supplier       =Supplier::orderBy('name', 'asc')->get();
        $currency       =Currency::orderBy('name', 'asc')->get();
        $login          =Auth::user()->id; 
        $access         = Objectaccess::with('user','manageobject')
        ->where('user_id','=', $login)
        ->orderBy('user_id', 'asc')->get();

        $userrole=Auth::user()->rollmanage_id;
        $roleaccess=Objecttorole::with('user','manageobject')
        ->where('rollmanage_id','=', $userrole)->get();

        return view("pages.assetItemPages.assetitem-edit",compact('access','roleaccess','assetitem' ,'brand','categorymodel','supplier','currency','pomst','subcategory'));
        
    }


    public function assetUpate(Request $request)
    {
        $data                           = [];
        $data['assetitem_po_mst_id']    = $request->assetitem_po_mst_id;
        $data['asset_no']               = $request->asset_no;
        $data['manufacture_no']         = $request->manufacture_no;
        $data['pruchase_date']          = $request->pruchase_date;
        $data['unit_price']             = $request->unit_price;
        $data['WarrantyEndDate']        = $request->WarrantyEndDate;
        $data['DepreciationRate']       = $request->DepreciationRate;
        $data['supplier_id']            = $request->supplier_id;
        $data['currency_id']            = $request->currency_id;
        $data['gov_registration_no']    = $request->gov_registration_no;
        $data['chassis_no']             = $request->chassis_no;
        $data['enginee_no']             = $request->enginee_no;
        $data['stock_sts']              = $request->stock_sts;
        $data['asset_status']           = $request->asset_status;
        $data['categorymodel_id']       = $request->categorymodel_id;
        $data['brand_id']               = $request->brand_id;
        // $data['company_id']             = $request->company_id;
        // $data['user_id']                = Auth::user()->id;


       
       
        $update = Assetitem::where('id', $request->id)->limit(1)->update($data);

        if($update){
                    return redirect()->route('asset_view')->with('message','Supplier Updated Successfully');
                    
                }else{
                    return redirect()->back();
                }
    }


    public function assetDelete($id){
        $result = Assetitem::find($id)->delete();
        if($result){
            return redirect()->route('asset_view')->with('message','Data deleted successfully');
        }else{
            return redirect()->back();
        }
    }

}
