<?php

namespace App\Http\Controllers\Backend\Auth\Credit;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use File;
use App\Models\Auth\Auction\CreditPackInfo;

class CreditController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $credits = DB::select('select * from credit_pack_infos');
        $credits = json_decode(json_encode($credits,true),true);
        return view('backend.auth.credit.index',['credits' => $credits]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.auth.credit.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $upload_path = public_path().'\credit_pack_images';
        if(!File::isDirectory($upload_path)){
            File::makeDirectory($upload_path, 0777, true, true);
        }

        $file = $request->file('image');
        $file_name = time().$file->getClientOriginalName();

        $credit = new CreditPackInfo([
            'name' => $request->get('name'),
            'image' => $file_name,
            'price' => $request->get('price'),
            'unit' => $request->get('unit'),
        ]);
       
        $file->move($upload_path,$file_name);

        $credit->save();
        
        return redirect()->route('admin.auth.credit.index')->withFlashSuccess(__('alerts.backend.credit.created'));   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $credits = DB::select('select * from credit_pack_infos where id = '.$id.' ');
        $credits = json_decode(json_encode($credits,true),true);
        return view('backend.auth.credit.edit',['credits' => $credits]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    
        $upload_path = public_path().'\credit_pack_images';
        if(!File::isDirectory($upload_path)){
            File::makeDirectory($upload_path, 0777, true, true);
        }

        $file = $request->file('image');
        $file_name = time().$file->getClientOriginalName();

        $credit = CreditPackInfo::find($id);

        $credit->name = $request->get('name');
        $credit->image = $file_name;
        $credit->price = $request->get('price');
        $credit->unit = $request->get('unit');

        $file->move($upload_path,$file_name);

        $credit_image = DB::select('select image from credit_pack_infos where id = '.$id.' ');
        $old_image = public_path('credit_pack_images').'\\'.$credit_image[0]->image;
        if(File::exists($old_image))
        {
            File::delete($old_image);
        }
        $credit->save();

        return redirect()->route('admin.auth.credit.index')->withFlashSuccess(__('alerts.backend.credit.updated'));;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $credits = DB::select('select * from credit_pack_infos where id = '.$id.' ');
        $old_image = public_path('credit_pack_images').'\\'.$credits[0]->image;
        
        if(File::exists($old_image))
        {
            File::delete($old_image);
        }
        $credit = CreditPackInfo::find($id);
        $credit->delete();
    
        return redirect()->route('admin.auth.credit.index')->withFlashSuccess(__('alerts.backend.credit.deleted'));
    }
}
