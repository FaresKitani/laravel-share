<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Url;
use Illuminate\Support\str;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\ValidationException;

class FileController extends Controller
{
    public function index()
    {
        //$file = File::with('link')->findOrFail();

        // $yousef = $file->url;
        // foreach($yousef as $url){
        //     dd($url->url);
        // }

        //dd($file->link->url);

        //$files = File::where('user_id', '=', Auth::user()->id)->get();

        $files = File::all();

        // $link = Url::where('file_id','=',$files->id);

        return view('files.index')->with([
            'files' => $files,
            'status' => File::statusOptions(),
        ]);
    }

    public function create()
    {
        return view('files.create')
                ->with(['status' => File::statusOptions()])
                ->with('file', new File());
    }

    public function store(Request $request)
    {
        $request->validate($this->rules());
        $data = $request->all();
     
        // if($request->hasFile('file')){   
        //     $data['file_path'] = $this->uploadFile($request->file('file'));
        // }

        if($request->hasFile('file')){
            $file = $request->file('file');
            if($file->isValid()){
                $data['file_path'] = $file->store('files',['disk' => 'local']);
            } else {
                throw ValidationException::withMessages(['file' => 'in-valid File']);
            }
        }

        $data['user_id'] = Auth::user()->id;
        File::create($data);

        return redirect()->route('files.my-files');
    }

    public function edit($fileID)
    {
        $fileData = File::findOrFail($fileID);

        return view('files.edit')
                ->with('file',$fileData)
                ->with('status',File::statusOptions());
    }

    public function update(Request $request,$fileID)
    {
        //$request->validate($this->rules());

        $file = File::findOrFail($fileID);

        $file->update($request->except('file'));
        
        return redirect()->route('files.my-files');
        //dd($fileID);

        
    }

    public function destroy($fileID)
    {
        $file = File::withTrashed()->findOrFail($fileID);

        if($file->deleted_at){
         
            $file->forceDelete();
            Storage::disk('local')->delete($file->file_path);
        } else {
            $file->delete();
   
        }
        return redirect()->route('files.my-files');
    }

    public function restore($id)
    {
        $file = File::onlyTrashed()->findOrFail($id);
        $file->restore();

        return redirect()->route('files.my-files');
    }

    public function trashed()
    {
        $files = File::onlyTrashed()->get();
        return view('files.trashed')
                    ->with('status',File::statusOptions())
                    ->with('files',$files);
    }

    public  function download($id) // model binding
    {
        $file = File::withoutGlobalScope('user-files')->withTrashed()->find($id);
        $url = Url::find($id);
    
        if($file){
            $file_path = $file->file_path;
            $deleted = $file->deleted_at;
        } else if ($url) {
            $file = File::find($url->file_id);
            $deleted = $file->deleted_at;
            $file_path = $file->file_path;
        } else{
            $file_path = null;
        }

        if(isset($deleted)){
            if($file->user_id == Auth::user()->id){
                return Storage::download($file_path);
             } else return abort(401);
        }

        return Storage::download($file_path ?? abort(404));    
    }

    public function fileInfo($fileID) // model binding
    {
        $file = File::findOrFail($fileID);
        return view('files.file-info')
                    ->with([
                        'file' => $file,
                        'link' => $file->link->url,
                    ]);
    }

    private function rules()
    {
        return [
            'status' => 'in:private,public,accessible',
            'file' => 'required|image',
            'file_name' => 'required|string|min:3|max:70',
            'description' => 'nullable|string|min:5',
            //'number_of_people' ///////////////////////////////////////////////////////////////////////////////////////////////////////////
        ];
    }

    private function uploadFile(UploadedFile $file)
    {
         if($file->isValid()){
             return $file->store('files',[
                 'disk' => 'local',
             ]); 
         } else{
             throw ValidationException::withMessages([
                 'file' => 'File corrupted !!!'
             ]);
         }
    }
}
