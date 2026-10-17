<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use App\Models\IglTailorInvProductGroup;
use App\Models\IglTailorInvProductType;
use App\Models\IglTailorSupplier;
use App\Models\IglTailorInvProduct;
use App\Models\IglTailorInvProductName;
use App\Models\IglTailorInvProductLocation;

class ProductInformationController extends Controller
{
    //Product Group
    public function AddGroup()
    {
        return view('user.product_information.add_group');
    }
    public function AddGroupInsert(Request $request)
    {
        $submit_by = Auth::user()->its_slno;
        $submit_at = Carbon::now()->format('Y-m-d H:i:s');
        $com = Auth::user()->UserDetails->its_user_com_id;
        $bran = Auth::user()->UserDetails->its_user_bran_id;
        $user = Auth::user()->UserDetails->its_user_user_id;
        $reg = Carbon::now()->format('Y-m-d');

        $message = ([
            'name.required' => "You Can't Submit Without Mention Any Group Name"
        ]);
        $request->validate([
            'name' => 'required'
        ],$message);

        if(IglTailorInvProductGroup::where('its_inv_progrp_com_id',$com)->where('its_inv_progrp_bran_id',$bran)->where('its_inv_progrp_name',$request->name)->exists())
        {
           return redirect()->back()->with(['already_insert' => 'Group Name Insert']);
        }
        else
        {
            $group_name = new IglTailorInvProductGroup();
            $group_name->its_inv_progrp_com_id = $com;
            $group_name->its_inv_progrp_bran_id = $bran;
            $group_name->its_inv_progrp_user_id = $user;
            $group_name->its_inv_progrp_name = $request->name;
            $group_name->its_inv_progrp_regdate = $reg;
            $group_name->its_inv_progrp_submit_by = $submit_by;
            $group_name->its_inv_progrp_submit_at = $submit_at;
            $group_name->save();
        }

        return redirect()->back()->with(['group' => 'Group Name Insert']);
    }
    public function ViewGroup()
    {
        $com = Auth::user()->UserDetails->its_user_com_id;
        $bran = Auth::user()->UserDetails->its_user_bran_id;

        $groups = IglTailorInvProductGroup::where('its_inv_progrp_com_id',$com)
                                          ->where('its_inv_progrp_bran_id',$bran)
                                          ->orderBy('its_inv_progrp_slno','desc')
                                          ->get();

        return view('user.product_information.view_group',compact('groups'));
    }
    public function groupEditAjax(Request $request)
    {
        $com = Auth::user()->UserDetails->its_user_com_id;
        $bran = Auth::user()->UserDetails->its_user_bran_id;
       
        $group_edit = IglTailorInvProductGroup::where('its_inv_progrp_slno',$request->grp_id)->first();

        return view('user.product_information.ajax.pro_group_ajax',compact('group_edit'));
    }
    public function productGroupUpdate(Request $request)
    {   
        $com = Auth::user()->UserDetails->its_user_com_id;
        $bran = Auth::user()->UserDetails->its_user_bran_id;

        $message = ([
            'name.required' => "Enter Your Group Name",
        ]);
        $request->validate([
            'name' => 'required',
        ],$message);

        if(IglTailorInvProductGroup::where('its_inv_progrp_com_id',$com)->where('its_inv_progrp_bran_id',$bran)->where('its_inv_progrp_slno',"!=",$request->grp_id)->where('its_inv_progrp_name',$request->name)->exists())
        {
             return redirect()->back()->with(['already_insert' => 'Group Name Insert']);
        }
        else
        {
            IglTailorInvProductGroup::where('its_inv_progrp_slno',$request->grp_id)->update([
                'its_inv_progrp_name'    => $request->name,
            ]);
        }

        return redirect()->back()->with(['grp_up' => 'Product Group Updated']);
                                               
    }
    public function productGroupDelete($id)
    {
        $group_delete = IglTailorInvProductGroup::find($id);
        $group_delete->delete();

        return redirect()->back()->with(['group_del' => 'Product Group Deleted!']);
    }
    //Product Group
    //Product Type
    public function AddProductType()
    {
        $com = Auth::user()->UserDetails->its_user_com_id;
        $bran = Auth::user()->UserDetails->its_user_bran_id;

        $groups = IglTailorInvProductGroup::where('its_inv_progrp_com_id',$com)
                                          ->where('its_inv_progrp_bran_id',$bran)
                                          ->orderBy('its_inv_progrp_slno','desc')
                                          ->get();

        return view('user.product_information.add_type',compact('groups'));
    }
    public function ProductTypeInsert(Request $request)
    {
        $submit_by = Auth::user()->its_slno;
        $com = Auth::user()->UserDetails->its_user_com_id;
        $bran = Auth::user()->UserDetails->its_user_bran_id;
        $user = Auth::user()->UserDetails->its_user_user_id;
        $submit_at = Carbon::now()->format('Y-m-d H:i:s');
        $reg = Carbon::now()->format('Y-m-d');

       $message = ([
            'group_id.required' => "Select Group Name",
            'type_name.required' => "Enter Your Type Name",
        ]);
        $request->validate([
            'group_id' => 'required',
            'type_name' => 'required',
        ],$message);

        if(
            IglTailorInvProductType::where('its_protype_com_id',$com)
                                    ->where('its_protype_bran_id',$bran)
                                    ->where('its_protype_group_id',$request->group_id)
                                    ->where('its_protype_name',$request->type_name)
                                    ->exists()
        )
        {
           return redirect()->back()->with(['already_insert' => 'Product Type Insert']);
        }
        else
        {
            $type_name = new IglTailorInvProductType();
            $type_name->its_protype_com_id    = $com;
            $type_name->its_protype_bran_id   = $bran;
            $type_name->its_protype_user_id   = $user;
            $type_name->its_protype_group_id  = $request->group_id;
            $type_name->its_protype_name      = $request->type_name;
            $type_name->its_protype_date      = $reg;
            $type_name->its_protype_submit_by = $submit_by;
            $type_name->its_protype_submit_at = $submit_at;
            $type_name->save();
        }

        return redirect()->back()->with(['type' => 'Product Type Insert']);
    }
    public function ViewType()
    {
        $com = Auth::user()->UserDetails->its_user_com_id;
        $bran = Auth::user()->UserDetails->its_user_bran_id;

        $types = IglTailorInvProductType::with('groupInfo')->where('its_protype_com_id',$com)
                                        ->where('its_protype_bran_id',$bran)
                                        ->orderBy('its_protype_slno','desc')
                                        ->get();

        return view('user.product_information.view_type',compact('types'));
    }
    public function typeEditAjax(Request $request)
    {
        $com = Auth::user()->UserDetails->its_user_com_id;
        $bran = Auth::user()->UserDetails->its_user_bran_id;

        $groups = IglTailorInvProductGroup::where('its_inv_progrp_com_id',$com)
                                          ->where('its_inv_progrp_bran_id',$bran)
                                          ->orderBy('its_inv_progrp_slno','desc')
                                          ->get();

        $type_edit = IglTailorInvProductType::where('its_protype_slno',$request->type_id)
                                            ->first();

        return view('user.product_information.ajax.pro_type_ajax',compact('type_edit','groups'));
    }
    public function productTypeUpdate(Request $request)
    {   
        $message = ([
            'group_id.required' => "Select Group Name",
            'type_name.required' => "Enter Your Type Name",
        ]);
        $request->validate([
            'group_id' => 'required',
            'type_name' => 'required',
        ],$message);
        
        
        $com = Auth::user()->UserDetails->its_user_com_id;
        $bran = Auth::user()->UserDetails->its_user_bran_id;

        if(
            IglTailorInvProductType::where('its_protype_com_id',$com)
                                    ->where('its_protype_bran_id',$bran)
                                    ->where('its_protype_group_id',$request->group_id)
                                    ->where('its_protype_name',$request->type_name)
                                    ->where('its_protype_slno',"!=",$request->type_id)
                                    ->exists()
        )
        {
            return redirect()->back()->with(['already_insert' => 'Product Type Insert']);
        }
        else
        {
            IglTailorInvProductType::where('its_protype_slno',$request->type_id)->update([
                'its_protype_group_id' => $request->group_id,
                'its_protype_name'     => $request->type_name,
            ]);
        }

        return redirect()->back()->with(['type_up' => 'Product Type Updated']);
    }
    public function productTypeDelete($id)
    {
        $type_delete = IglTailorInvProductType::find($id);
        $type_delete->delete();

        return redirect()->back()->with(['type_del' => 'Product Type Deleted!']);
    }
    //Product Type
    //Product Name
    public function AddProductName()
    {
        $com = Auth::user()->UserDetails->its_user_com_id;
        $bran = Auth::user()->UserDetails->its_user_bran_id;

        $groups = IglTailorInvProductGroup::where('its_inv_progrp_com_id',$com)
                                          ->where('its_inv_progrp_bran_id',$bran)
                                          ->get();
        $suppliers = IglTailorSupplier::where('its_sup_com_id',$com)
                                      ->where('its_sup_bran_id',$bran)
                                      ->get();
        return view('user.product_information.add_name',compact('groups','suppliers'));
    }
    public function groupAjaxForType(Request $request)
    {
        $com = Auth::user()->UserDetails->its_user_com_id;
        $bran = Auth::user()->UserDetails->its_user_bran_id;

        $types = IglTailorInvProductType::where('its_protype_com_id',$com)
                                        ->where('its_protype_bran_id',$bran)
                                        ->where('its_protype_group_id',$request->group_id)
                                        ->orderBy('its_protype_slno','desc')
                                        ->get();

        return view('user.product_information.ajax.typeNameAjax',compact('types'));
    }
    public function AddProductNameInsert(Request $request)
    {
        $submit_by = Auth::user()->its_slno;
        $com = Auth::user()->UserDetails->its_user_com_id;
        $bran = Auth::user()->UserDetails->its_user_bran_id;
        $user = Auth::user()->UserDetails->its_user_user_id;
        $submit_at = Carbon::now()->format('Y-m-d H:i:s');

        $message = ([
            'supplier_id.required' => "Select Supplier Name",
            'group_id.required'    => "Select Group Name",
            'type_id.required'     => "Select Type Name",
            'product_name.required'=> "Enter Your Product Name",
            'description.required' => "Enter Your Product Description",
        ]);
        $request->validate([
            'supplier_id'  => 'required',
            'group_id'     => 'required',
            'type_id'      => 'required',
            'product_name' => 'required|unique:igl_tailor_inv_product_names,its_proname_product_name',
            'description'  => 'required',
        ],$message);

        $product_name = new IglTailorInvProductName();
        $product_name->its_proname_com_id = $com;
        $product_name->its_proname_bran_id = $bran;
        $product_name->its_proname_user_id = $user;
        $product_name->its_proname_sup_id = $request->supplier_id;
        $product_name->its_proname_group_id = $request->group_id;
        $product_name->its_proname_type_id = $request->type_id;
        $product_name->its_proname_product_name = $request->product_name;
        $product_name->its_proname_product_desc = $request->description;
        $product_name->its_proname_submit_by = $submit_by;
        $product_name->its_proname_submit_at = $submit_at;
        $product_name->save();

        return redirect()->back()->with(['pro_name' => 'Product Name Insert']);
    }
    public function ViewName()
    {
        $com = Auth::user()->UserDetails->its_user_com_id;
        $bran = Auth::user()->UserDetails->its_user_bran_id;

        $names = IglTailorInvProductName::with('supplier_name','type_name')->where('its_proname_com_id',$com)
                                         ->where('its_proname_bran_id',$bran)
                                         ->orderBy('its_proname_slno','desc')
                                         ->get();

        return view('user.product_information.view_name',compact('names'));
    }
    public function nameEditAjax(Request $request)
    {
        $com = Auth::user()->UserDetails->its_user_com_id;
        $bran = Auth::user()->UserDetails->its_user_bran_id;

        $name_edit = IglTailorInvProductName::where('its_proname_slno',$request->name_id)->first();

        $suppliers = IglTailorSupplier::where('its_sup_com_id',$com)
                                        ->where('its_sup_bran_id',$bran)
                                        ->orderBy('its_sup_slno','desc')
                                        ->get();

        $groups = IglTailorInvProductGroup::where('its_inv_progrp_com_id',$com)
                                            ->where('its_inv_progrp_bran_id',$bran)
                                            ->get();

        $types = IglTailorInvProductType::where('its_protype_com_id',$com)
                                         ->where('its_protype_bran_id',$bran)
                                         ->where('its_protype_group_id',$name_edit->its_proname_group_id)
                                         ->orderBy('its_protype_slno','desc')
                                         ->get();

        return view('user.product_information.ajax.pro_name_ajax',compact('name_edit','suppliers','groups','types'));
    }
    public function nameUpdate(Request $request)
    {   
        $com = Auth::user()->UserDetails->its_user_com_id;
        $bran = Auth::user()->UserDetails->its_user_bran_id;
        
        $message = ([
            'supplier_id.required' => "Select Supplier Name",
            'group_id.required'    => "Select Group Name",
            'type_id.required'     => "Select Type Name",
            'product_name.required'=> "Enter Your Product Name",
            'description.required' => "Enter Your Product Description",
        ]);

        $request->validate([
            'supplier_id'  => 'required',
            'group_id'     => 'required',
            'type_id'      => 'required',
            'product_name' => 'required',
            'description'  => 'required',
        ],$message);
        
        if(
            IglTailorInvProductName::where('its_proname_com_id',$com)
                                    ->where('its_proname_bran_id',$bran)
                                    ->where('its_proname_slno','!=',$request->pro_name_id)
                                    ->where('its_proname_product_name',$request->product_name)
                                    ->exists()
        )
        {
            return redirect()->back()->with(['already_insert' => 'Product Name Already Insert']);
        }
        else{
            $name_update = IglTailorInvProductName::where('its_proname_slno',$request->pro_name_id)->update([
                'its_proname_sup_id'       => $request->supplier_id,
                'its_proname_group_id'     => $request->group_id,
                'its_proname_type_id'      => $request->type_id,
                'its_proname_product_name' => $request->product_name,
                'its_proname_product_desc' => $request->description,
            ]);

            return redirect()->back()->with(['name_update' => 'Product Name Updated']);
        }
    }
    public function nameDelete($id)
    {
        $name_delete = IglTailorInvProductName::find($id);
        $name_delete->delete();

        return redirect()->back()->with(['pro_name_del' => 'Product Name Deleted!']);
    }
    //End Product Name

    //Product Location
    public function AddLocation()
    {
        $com = Auth::user()->UserDetails->its_user_com_id;
        $bran = Auth::user()->UserDetails->its_user_bran_id;

        $groups = IglTailorInvProductGroup::where('its_inv_progrp_com_id',$com)
                                          ->where('its_inv_progrp_bran_id',$bran)
                                          ->get();

        return view('user.product_information.add_location',compact('groups'));
    }
    public function typeAjaxForProName(Request $request)
    {
        $com = Auth::user()->UserDetails->its_user_com_id;
        $bran = Auth::user()->UserDetails->its_user_bran_id;

        $product_names = IglTailorInvProductName::where('its_proname_com_id',$com)
                                                ->where('its_proname_bran_id',$bran)
                                                ->where('its_proname_type_id',$request->pro_type_id)
                                                ->get();

       return view('user.product_information.ajax.pro_name_show_ajax',compact('product_names'));
    }
    public function productLocationInsert(Request $request)
    {   
        $message = ([
            'group_id.required'    => "Select Product Group Name",
            'type_id.required'     => "Select Product Type Name",
            'pro_name_id.required' => "Select Product Name",
            'block.required'       => "Enter Your Block Name",
        ]);

        $request->validate([
            'group_id'    => 'required',
            'type_id'     => 'required',
            'pro_name_id' => 'required',
            'block'       => 'required',
        ],$message);
        
        $com = Auth::user()->UserDetails->its_user_com_id;
        $bran = Auth::user()->UserDetails->its_user_bran_id;
        $user = Auth::user()->UserDetails->its_user_user_id;

        $submit_at = Carbon::now()->format('Y-m-d H:i:s');
        $submit_by = Auth::user()->its_slno;

        if(
            IglTailorInvProductLocation::where('its_inv_proloc_com_id',$com)
                                        ->where('its_inv_proloc_bran_id',$bran)
                                        ->where('its_inv_proloc_group_id',$request->group_id)
                                        ->where('its_inv_proloc_type_id',$request->type_id)
                                        ->where('its_inv_proloc_product_id',$request->pro_name_id)
                                        ->where('its_inv_proloc_block',$request->block)
                                        ->where('its_inv_proloc_self',$request->self)
                                        ->exists()
        )
        {
            return redirect()->back()->with(['already_insert' => 'Product Location Already Insert']);
        }
        else{
            $pro_location = new IglTailorInvProductLocation();
            $pro_location->its_inv_proloc_com_id     = $com;
            $pro_location->its_inv_proloc_bran_id    = $bran;
            $pro_location->its_inv_proloc_user_id    = $user;
            $pro_location->its_inv_proloc_group_id   = $request->group_id;
            $pro_location->its_inv_proloc_type_id    = $request->type_id;
            $pro_location->its_inv_proloc_product_id = $request->pro_name_id;
            $pro_location->its_inv_proloc_block      = $request->block;
            $pro_location->its_inv_proloc_self       = $request->self;
            $pro_location->its_inv_proloc_submit_at  = $submit_at;
            $pro_location->its_inv_proloc_submit_by  = $submit_by;
            $pro_location->save();
        }
        return redirect()->back()->with(['location' => 'Product Location Insert']);
    }
    public function ViewLocation()
    {
        $com = Auth::user()->UserDetails->its_user_com_id;
        $bran = Auth::user()->UserDetails->its_user_bran_id;

        $locations = IglTailorInvProductLocation::with('groupInfo','typeInfo')->where('its_inv_proloc_com_id',$com)
                                                ->where('its_inv_proloc_bran_id',$bran)
                                                ->orderBy('its_inv_proloc_slno','desc')
                                                ->get();

        return view('user.product_information.view_location',compact('locations'));
    }
    public function locationEditAjax(Request $request)
    {
        $com = Auth::user()->UserDetails->its_user_com_id;
        $bran = Auth::user()->UserDetails->its_user_bran_id;
        
        $location_edit = IglTailorInvProductLocation::where('its_inv_proloc_slno',$request->loc_id)->first();
    

        $groups = IglTailorInvProductGroup::where('its_inv_progrp_com_id',$com)
                                          ->where('its_inv_progrp_bran_id',$bran)
                                          ->get();

        $types = IglTailorInvProductType::where('its_protype_com_id',$com)
                                         ->where('its_protype_bran_id',$bran)
                                         ->where('its_protype_group_id',$location_edit->its_inv_proloc_group_id)
                                         ->orderBy('its_protype_slno','desc')
                                         ->get();

        $pro_names = IglTailorInvProductName::where('its_proname_com_id',$com)
                                            ->where('its_proname_bran_id',$bran)
                                            ->where('its_proname_group_id',$location_edit->its_inv_proloc_group_id)
                                            ->get();
       
        return view('user.product_information.ajax.pro_location_ajax',compact('location_edit','groups','types','pro_names'));
    }
    public function locationUpdate(Request $request)
    {   
         $request->validate([
            'group_id'    => 'required',
            'type_id'     => 'required',
            'pro_name_id' => 'required',
            'block'       => 'required',
        ]);

        $com = Auth::user()->UserDetails->its_user_com_id;
        $bran = Auth::user()->UserDetails->its_user_bran_id;
        
        $update_by = Auth::user()->its_slno;
        $update_at = Carbon::now()->format('Y-m-d H:i:s');

        if(
            IglTailorInvProductLocation::where('its_inv_proloc_com_id',$com)
                                        ->where('its_inv_proloc_bran_id',$bran)
                                        ->where('its_inv_proloc_group_id',$request->group_id)
                                        ->where('its_inv_proloc_type_id',$request->type_id)
                                        ->where('its_inv_proloc_product_id',$request->pro_name_id)
                                        ->where('its_inv_proloc_block',$request->block)
                                        ->where('its_inv_proloc_self',$request->self)
                                        ->where('its_inv_proloc_slno','!=',$request->loc_id)
                                        ->exists()
        )
        {
            return redirect()->back()->with(['already_insert' => 'Product Location Already Insert']);
        }
        else{
            $loc_update = IglTailorInvProductLocation::where('its_inv_proloc_slno',$request->loc_id)->first();
            $loc_update->its_inv_proloc_group_id   = $request->group_id;
            $loc_update->its_inv_proloc_type_id    = $request->type_id;
            $loc_update->its_inv_proloc_product_id = $request->pro_name_id;
            $loc_update->its_inv_proloc_block      = $request->block;
            $loc_update->its_inv_proloc_self       = $request->self;
            $loc_update->its_inv_proloc_update_at  = $update_at;
            $loc_update->its_inv_proloc_update_by  = $update_by;
            $loc_update->save();
        }

        return redirect()->back()->with(['loc_update' => 'Product Location Updated']);
    }
    public function locationDelete($id)
    {
        $locationDelete = IglTailorInvProductLocation::find($id);
        $locationDelete->delete();
        return redirect()->back()->with(['loc_del' => 'Product Location Deleted!']);
    }
    //End Product Location
   
    //Add Product
    public function AddProduct()
    {
        $com = Auth::user()->UserDetails->its_user_com_id;
        $bran = Auth::user()->UserDetails->its_user_bran_id;

        $suppliers = IglTailorSupplier::where('its_sup_com_id',$com)
                                      ->where('its_sup_bran_id',$bran)
                                      ->where('its_sup_status',2)
                                      ->orderBy('its_sup_slno','desc')
                                      ->get();

        return view('user.product_information.add_product',compact('suppliers'));
    }
    public function supplierAjaxForGroup(Request $request)
    {
        $com = Auth::user()->UserDetails->its_user_com_id;
        $bran = Auth::user()->UserDetails->its_user_bran_id;

        $group_names = IglTailorInvProductName::where('its_proname_com_id',$com)
                                ->where('its_proname_bran_id',$bran)
                                ->where('its_proname_sup_id',$request->supplier_id)
                                ->groupBy('its_proname_group_id')
                                ->get();

        return view('user.product_information.ajax.groupNameAjax',compact('group_names'));
    }
    public function addProductInsert(Request $request)
    {
        $submit_at = Carbon::now()->format('Y-m-d H:i:s');
        $reg = Carbon::now()->format('Y-m-d');
        $submit_by = Auth::user()->its_slno;
        
        $com = Auth::user()->UserDetails->its_user_com_id;
        $bran = Auth::user()->UserDetails->its_user_bran_id;
        $user = Auth::user()->UserDetails->its_user_user_id;

        $message = ([
            'supplier_id.required' => 'Select Supplier Name',
            'group_id.required'    => 'Select Group Name',
            'type_id.required'     => 'Select Type Name',
            'pro_name.required'    => 'Enter Your Product Amount',
            'buy.required'         => 'Enter Your Buy Amount',
            'sell.required'        => 'Enter Your Sale Amount',
        ]);

        $request->validate([
            'supplier_id' => 'required',
            'group_id' => 'required',
            'type_id' => 'required',
            'pro_name' => 'required',
            'buy' => 'required|numeric',
            'sell' => 'required|numeric',
        ],$message);

        if(
            IglTailorInvProduct::where('its_inv_pro_com_id',$com)
                                ->where('its_inv_pro_bran_id',$bran)
                                ->where('its_inv_pro_product_name',$request->pro_name)
                                ->exists()
        )
        {
            return redirect()->back()->with(['already_insert' => 'Product Information Already Insert']);
        }
        else{
            $addProduct = new IglTailorInvProduct();
            $addProduct->its_inv_pro_com_id       = $com;
            $addProduct->its_inv_pro_bran_id      = $bran;
            $addProduct->its_inv_pro_user_id      = $user;
            $addProduct->its_inv_pro_sup_id       = $request->supplier_id;
            $addProduct->its_inv_pro_group        = $request->group_id;
            $addProduct->its_inv_pro_product_name = $request->pro_name;
            $addProduct->its_inv_pro_type         = $request->type_id;
            $addProduct->its_inv_pro_buy_price    = $request->buy;
            $addProduct->its_inv_pro_sell_price   = $request->sell;
            $addProduct->its_inv_pro_short        = $request->short;
            $addProduct->its_inv_pro_reg_date     = $reg;
            $addProduct->its_inv_pro_submit_by    = $submit_by; 
            $addProduct->its_inv_pro_submit_at    = $submit_at;
            $addProduct->save();
        }

        return redirect()->back()->with(['product' => 'Product Information Insert']);
    }
    public function ViewProduct()
    {
        $com = Auth::user()->UserDetails->its_user_com_id;
        $bran = Auth::user()->UserDetails->its_user_bran_id;

        $products = IglTailorInvProduct::where('its_inv_pro_com_id',$com)
                                        ->where('its_inv_pro_bran_id',$bran)
                                        ->get();

        return view('user.product_information.view_product',compact('products'));
    }
    public function productEditAjax(Request $request)
    {
        $com = Auth::user()->UserDetails->its_user_com_id;
        $bran = Auth::user()->UserDetails->its_user_bran_id;

        $pro_edit = IglTailorInvProduct::where('its_inv_pro_slno',$request->pro_id)->first();

        $suppliers = IglTailorSupplier::where('its_sup_com_id',$com)
                                      ->where('its_sup_bran_id',$bran)
                                      ->get();

        $group_names = IglTailorInvProductName::where('its_proname_com_id',$com)
                                              ->where('its_proname_bran_id',$bran)
                                              ->where('its_proname_sup_id',$pro_edit->its_inv_pro_sup_id)
                                              ->groupBy('its_proname_group_id')
                                              ->get();

        $types = IglTailorInvProductType::where('its_protype_com_id',$com)
                                        ->where('its_protype_bran_id',$bran)
                                        ->where('its_protype_group_id',$pro_edit->its_inv_pro_group)
                                        ->get();                            

        $names = IglTailorInvProductName::where('its_proname_com_id',$com)
                                        ->where('its_proname_bran_id',$bran)
                                        ->where('its_proname_type_id',$pro_edit->its_inv_pro_type)
                                        ->get();
        
        return view('user.product_information.ajax.product_edit_ajax',compact('pro_edit','suppliers','group_names','names','types'));
    }
    public function productUpdate(Request $request)
    {
        $request->validate([
            'supplier_id' => 'required',
            'group_id'    => 'required',
            'type_id'     => 'required',
            'pro_name'    => 'required',
            'buy'         => 'required|numeric',
            'sell'        => 'required|numeric',
        ]);

        $com = Auth::user()->UserDetails->its_user_com_id;
        $bran = Auth::user()->UserDetails->its_user_bran_id;

        $update_at = Carbon::now()->format('Y-m-d H:i:s');
        $update_by = Auth::user()->its_slno;

        if(
            IglTailorInvProduct::where('its_inv_pro_com_id',$com)
                                ->where('its_inv_pro_bran_id',$bran)
                                ->where('its_inv_pro_slno','!=',$request->pro_id)
                                ->where('its_inv_pro_product_name',$request->pro_name)
                                ->exists()
        )
        {
            return redirect()->back()->with(['already_insert' => 'Product Information Already Insert']);
        }   
        else{
            $productUpdate = IglTailorInvProduct::where('its_inv_pro_slno',$request->pro_id)->first();
            $productUpdate->its_inv_pro_sup_id       = $request->supplier_id;
            $productUpdate->its_inv_pro_group        = $request->group_id;
            $productUpdate->its_inv_pro_type         = $request->type_id;
            $productUpdate->its_inv_pro_product_name = $request->pro_name;
            $productUpdate->its_inv_pro_buy_price    = $request->buy;
            $productUpdate->its_inv_pro_sell_price   = $request->sell;
            $productUpdate->its_inv_pro_short        = $request->short;
            $productUpdate->its_inv_pro_update_at    = $update_at;
            $productUpdate->its_inv_pro_update_by    = $update_by;
            $productUpdate->save();
        }
        
        return redirect()->back()->with(['pro_up' => 'Product Information Updated']);
    }
    public function productDelete($id)
    {
        $productDelete = IglTailorInvProduct::find($id);
        $productDelete->delete();
        
        return redirect()->back()->with(['pro_del' => 'Product Deleted!']);
    }
    //End Add Product
}
