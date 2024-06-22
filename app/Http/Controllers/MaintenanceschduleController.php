<?php

namespace App\Http\Controllers;

use App\Models\Uom;
use App\Models\Workshop;
use App\Models\Assetitem;
use App\Models\Objecttorole;
use Illuminate\Http\Request;
use App\Models\Maintenanceschdule;
use Illuminate\Support\Facades\Auth;

class MaintenanceschduleController extends Controller
{
    public function maintenanceSchduleView()
    {
        //$maintenanceschdule = Maintenanceschdule::with('workshop', 'user')->orderBy('id', 'desc')->get();
        $maintenanceschdule = Maintenanceschdule::orderBy('id', 'desc')->get();
        $assets = Assetitem::get();
        $workshops = Workshop::get();
        $umos = Uom::get();

        $userrole = Auth::user()->rollmanage_id;
        $roleaccess = Objecttorole::with('user', 'manageobject')
            ->where('rollmanage_id', '=', $userrole)->get();

        //return view("pages.meterPages.meter-create", compact('roleaccess', 'meters', 'assets'));
        return view("pages.maintenanceschdule.maintenanceschdule-create", compact('roleaccess', 'assets', 'workshops', 'maintenanceschdule', 'umos'));
    }
    public function maintenanceSchduleStore(Request $request)
    {
        // $request->validate([

        // ]);

        $data = [];
        $data['assetitem_id'] = $request->assetitem_id;
        $data['maint_date'] = $request->maintain_date;
        $data['maint_sts'] = $request->maintain_status;
        $data['totla_amount'] = $request->total_amount;
        $data['uom_id'] = $request->uom_id;
        $data['workshop_id'] = $request->workshop_id;

        $data['user_id'] = Auth::user()->id;
        $data['updated_by'] = Auth::user()->id;

        $meters = Maintenanceschdule::insert($data);

        if ($meters) {
            return redirect()->route('maintenanceschdule-view')->with('message', 'Maintenanceschdule view added Successfully');

        } else {
            return redirect()->back();
        }
    }
    

    function maintscheduleList(Request $request)
    {
        $maintenanceschdule = Maintenanceschdule::orderBy('id', 'desc')->get();

        $userrole = Auth::user()->rollmanage_id;
        $roleaccess = Objecttorole::with('user', 'manageobject')
            ->where('rollmanage_id', '=', $userrole)->get();
            return view('pages.maintenanceschdule.maintenanceschdule-list', compact('roleaccess', 'maintenanceschdule'));
    }

    
    // function maintenanceSchduleList(Request $request)
    // {
    //     //$meters = Maintenanceschdule::with('assetitem', 'user')->orderBy('id', 'desc')->get();
    //     $maintenanceschdule = Maintenanceschdule::orderBy('id', 'desc')->get();

    //     $userrole = Auth::user()->rollmanage_id;
    //     $roleaccess = Objecttorole::with('user', 'manageobject')
    //         ->where('rollmanage_id', '=', $userrole)->get();

    //     //return view("pages.maintenanceschdule.maintenanceschdule-list", compact('roleaccess', 'maintenanceschdule'));
    //     return view('pages.maintenanceschdule.maintenanceschdule-list', compact('roleaccess', 'maintenanceschdule'));
    // }
    public function maintenanceSchduleEdit($id)
    {
        $maintenanceschdule = Maintenanceschdule::where('id', $id)->first();

        $userrole = Auth::user()->rollmanage_id;
        $roleaccess = Objecttorole::with('user', 'manageobject')
            ->where('rollmanage_id', '=', $userrole)->get();

        return view("pages.maintenanceschdule.maintenanceschdule-edit", compact('roleaccess', 'maintenanceschdule'));
    }

    public function maintenanceSchduleUpate(Request $request)
    {
        // $request->validate([
        //     'meter_no' => 'required',
        //     'description' => 'required|max:255',
        // ]);

        $data = [];
        $data['maint_date'] = $request->maintain_date;
        $data['maint_sts'] = $request->maintain_status;
        $data['totla_amount'] = $request->total_amount;

        $update = Maintenanceschdule::where('id', $request->id)->limit(1)->update($data);

        if ($update) {
            return redirect()->route('maintenanceschdule-view')->with('message', 'Maintenance Schdule Updated Successfully');

        } else {
            return redirect()->back();
        }
    }
    public function maintenanceSchduleDelete($id)
    {
        $maintenanceschdule = Maintenanceschdule::find($id)->delete();
        if ($maintenanceschdule) {
            return redirect()->route('maintenanceschdule-view')->with('message', 'Data deleted successfully');
        } else {
            return redirect()->back();
        }
    }

}
