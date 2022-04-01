@extends('layouts.main-page')

@section('content')

          <!-- top tiles -->
          <div class="row tile_count">
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Users</span>
              <div class="count">2500</div>
              <span class="count_bottom"><i class="green">4% </i> From last Week</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-clock-o"></i> Average Time</span>
              <div class="count">123.50</div>
              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>3% </i> From last Week</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Males</span>
              <div class="count green">2,500</div>
              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Females</span>
              <div class="count">4,567</div>
              <span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i>12% </i> From last Week</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Collections</span>
              <div class="count">2,315</div>
              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Connections</span>
              <div class="count">7,325</div>
              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
            </div>
          </div>
          <!-- /top tiles -->

    <div  style="font-size: 18px;" class="my-content">

        <div class="form-group row">
            <label class="col-sm-2 control-label">File Name: </label>
            <div class="col-sm-10">{{ $file->file_name }}</div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 control-label">Description: </label>
            <div class="col-sm-10">{{ $file->description }}</div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 control-label">Status: </label>
            <div class="col-sm-10">{{ $file->status }}</div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 control-label">Created At: </label>
            <div class="col-sm-10">{{ $file->created_at }}</div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 control-label">Downloaded Number: </label>
            <div class="col-sm-10">{{ $file->number_of_downloads }}</div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 control-label">Accessible From: </label>
            <div class="col-sm-10"> just me &#128526;</div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 control-label">Download Link: </label>
            <div class="col-sm-10"><a href="{{ route('files.download',$file->id) }}">Click To Download</a> <button onclick="CopyLink(' {{config('app.url') .'/down/'.  $link }}');" class="btn  btn-success">or Copy</button></div>
        </div>

    </div>

@endsection

@push('script')
<script src="{{ asset('js/copyLink.js') }}"></script>
@endpush
