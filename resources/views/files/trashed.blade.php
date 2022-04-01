@extends('layouts.main-page')

@section('content')



<table class="table table-striped">
    <tr style="color:black;">
        <th>No.</th>
        <th>File Name</th>
        <th>Description</th>
        <th class="text-center">Downloaded No.</th>
        <th>status</th>
        <th class="text-center">Accessible From</th>
        <th>Actions</th>        
    </tr>
    @foreach($files as $file)
        <tr>
            <td>{{ $loop->index + 1 }}</td>
            <td>{{ $file->file_name }}</td>
            <td>{{ $file->description }}</td>
            <td class="text-center">{{-- $file->number_of_downloads --}}</td>

            
            <td class="col-centered">
                <div style="width:100px; text-align:center;" class="btn-round  btn-sm btn-{{ $status[$file->status] }}"> {{ $file->status }} </div>
            </td>
            
            
            <td style="text-align: center;">{{ $file->number_of_people }}</td>
            <td>    

                <form hidden id="delete" method="post" action="{{ route('files.destroy',$file->id) }}">
                    @csrf
                    @method('delete')
                </form>

                <form hidden id="restore" method="post" action="{{ route('files.restore',$file->id) }}">
                    @csrf
                    @method('put')
                </form>

                <button onclick="document.getElementById('delete').submit()" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                <button onclick="document.getElementById('restore').submit()" class="btn btn-success btn-sm">&#x21bb;</button>

                <a href="{{ route('files.download',$file->id) }} " class="btn btn-primary btn-sm"><i class="fa fa-download"></i></a>
            </td>        
        </tr>
    @endforeach
</table>




@endsection