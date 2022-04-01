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
                <button onclick="CopyLink(' {{config('app.url') . '/down/'.  $file->link->url }}');" class="btn btn-info btn-sm"><i class="fa fa-link"></i></button>
                <a href="{{ route('files.info',$file->id) }}" class="btn btn-info btn-sm"><i class="fa fa-info"></i></a>
                            
                <a href="{{ route('files.edit', $file->id) }}" class="btn btn-warning btn-sm">&#9998;</a>

                <form hidden id="delete" method="post" action="{{ route('files.destroy',$file->id) }}">
                    @csrf
                    @method('delete')
                </form>
                <button onclick="document.getElementById('delete').submit()" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                
                <a href="{{ route('files.download',$file->id) }} " class="btn btn-danger btn-sm"><i class="fa fa-download"></i></a>
            </td>        
        </tr>
    @endforeach
</table>

@endsection

@push('script')
<script src="{{ asset('js/copyLink.js') }}"></script>
@endpush
