@props([

   'name',
   'id',
   'title',
   'type' => 'text',
   'placeholder', 
   'label',
   'value' => null,
])



<div class="form-group">
        <label for="{{ $id }}" class="col-sm-2 control-label">{{ $label }}</label>
        <div class="col-sm-10">
            <input value="{{ $value }}" {{ $attributes->class(['form-control', 'is-invalid' => $errors->has($name)]) }}  style="font-size:16px;" type="{{ $type }}" name="{{ $name }}" class="form-control" id="{{ $id }}" placeholder="{{ $placeholder }}">
        </div>
</div>