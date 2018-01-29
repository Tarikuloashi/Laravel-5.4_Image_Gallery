<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Photo;

class photosController extends Controller
{
    public function create($album_id){
      return view('photos.create')->with('album_id',$album_id);
    }

    public function store(Request $request){
      $this->validate($request,[
        'title' => 'required',
        'photo' => 'image|max:1999'
      ]);

      //get filename with extension
      $filenameWithExt = $request->file('photo')->getClientOriginalName();
      // get just tihe $filename
      $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
      //get file extension
      $extension = $request->file('photo')->getClientOriginalExtension();
      // store file with time and file name
      $filenameToStore = $filename.'_'.time().'.'.$extension;
      //store image
      $path = $request->file('photo')->storeAs('public/photos/'.$request->input('album_id'), $filenameToStore);
      //upload photo
      $photo = new Photo;
      $photo->album_id = $request->input('album_id');
      $photo->title = $request->input('title');
      $photo->description = $request->input('description');
      $photo->size = $request->file('photo')->getclientSize();
      $photo->photo = $filenameToStore;

      $photo->save();

      return redirect('/albums/'.$request->input('album_id'))->with('success','Photo Upladed Successfully');
    }

    public function show($id){
      $photo = Photo::find($id);
      return view('photos.show')->with('photo',$photo);

    }

    public function destroy($id){
      $photo = Photo::find($id);
      if(Storage::delete('public/photos/'.$photo->album_id.'/'.$photo->photo)){
        $photo->delete();

       return redirect('/')->with('success','Photo Deleted successfully');
      }

    }
}
