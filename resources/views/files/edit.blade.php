@extends('layouts.main-page')

@section('title','Upload New File')


@php

    $uploadFile = false;
@endphp


@section('content')

<form style="color:black; font-size:16px" class="form-horizontal" action="{{ route('files.update' , $file->id) }}" method="post" enctype="multipart/form-data" >
    @csrf
    @method('put')

    @include('files._form')

</form>

@endsection