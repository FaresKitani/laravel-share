@extends('layouts.main-page')

@section('title','Upload New File')

@php

    $uploadFile = true;
@endphp


@section('content')

<form style="color:black; font-size:16px" class="form-horizontal" action="{{ route('files.store') }}" method="post" enctype="multipart/form-data" >
    @csrf

    @include('files._form')    

</form>

@endsection