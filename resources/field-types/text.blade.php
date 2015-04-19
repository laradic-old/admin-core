<input type="text" name="{{ $name }}" value="{{ $value }}"
@foreach($attributes as $key => $val)
{{ $key . '="' . $val . '"'}}
@endforeach
>
