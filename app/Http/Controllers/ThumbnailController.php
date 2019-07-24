<?php

namespace App\Http\Controllers;

use App\Thumbnail;
use Illuminate\Http\Request;
use Auth;

class ThumbnailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('content.thumbnail.index', [
            'data' => Thumbnail::orderBy('status')->orderBy('updated_at','desc')->get(),
            'thum' => Thumbnail::where('status','active')->orderBy('updated_at','desc')->get()
        ]);
    }

    public function active()
    {
        return view('content.thumbnail.index',[
            'data' => Thumbnail::where('status','active')->orderBy('updated_at','desc')->get(),
            'thum' => Thumbnail::where('status','active')->orderBy('updated_at','desc')->get()
        ]);
    }

    public function inactive()
    {
        return view('content.thumbnail.index',[
            'data' => Thumbnail::where('status','inactive')->orderBy('updated_at','desc')->get(),
            'thum' => Thumbnail::where('status','active')->orderBy('updated_at','desc')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('content.thumbnail.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->hasfile('image')) 
        { 
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename = "thumbnail-".time().'.'.$extension;
            $file->move('image/thumbnail', $filename);
        }else{
            $filename = "default-avatar.jpg";
        }

        $cek = Thumbnail::where('status','active')->count();

        if ($cek < 5) {
            $status = "active";
        }else{
            $status = "inactive";
        }

        $data = new Thumbnail($request->all());
        $data->image = $filename;
        $data->status = $status;
        $data->admin_id = Auth::id();
        $data->save();

        if ($data) {
            $response = ['code'=>200,'status'=>'success'];
        }else{
            $response = ['code'=>201,'status'=>'error'];
        }

        return redirect()->route('thumbnail.index')->with('message','menambahkan data');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Thumbnail  $thumbnail
     * @return \Illuminate\Http\Response
     */
    public function show(Thumbnail $thumbnail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Thumbnail  $thumbnail
     * @return \Illuminate\Http\Response
     */
    public function edit(Thumbnail $thumbnail)
    {
        return view('content.thumbnail.edit',[
            'data' => $thumbnail
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Thumbnail  $thumbnail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Thumbnail $thumbnail)
    {
        if($request->hasfile('image')) 
        { 
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename = "thumbnail-".time().'.'.$extension;
            $file->move('image/thumbnail', $filename);

            if ($thumbnail->image != 'default-avatar.jpg') {
                unlink('image/thumbnail/'.$thumbnail->image);
            }

        }else{
            $filename = $thumbnail->image;
        } 

        $thumbnail->update([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $filename
        ]);

        return redirect()->route('thumbnail.index')->with('message','mengubah data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Thumbnail  $thumbnail
     * @return \Illuminate\Http\Response
     */
    public function destroy(Thumbnail $thumbnail)
    {
        if ($thumbnail->image != 'default-avatar.jpg') {
           unlink('image/thumbnail/'.$thumbnail->image);
        }
        $thumbnail->delete();
        return redirect()->route('thumbnail.index')->with('message','menghapus thumbnail');
    }

    public function setactive(Thumbnail $thumbnail)
    {
        $cek = Thumbnail::where('status','active')->count();

        if ($cek == 5){
            $change = Thumbnail::where('status','active')->orderBy('updated_at','asc')->first();
            $change->update([
                'status' => 'inactive'
            ]);

            $thumbnail->update([
                'status' => 'active'
            ]);
        }else{
            $thumbnail->update([
                'status' => 'active'
            ]);
        }

        return redirect()->route('thumbnail.index')->with('message','mengaktifkan thumbnail');
    }
}
