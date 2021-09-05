<div class="form-group">
    <label for="code">Code</label>
    <input type="text" name="code" class="form-control {{ $errors->has('code') ? 'is-invalid' : '' }}"
           id="code" placeholder="Enter code" value="{{ old('code', $item->code) }}">
    @if ($errors->has('code'))
        <span class="error invalid-feedback">{{ $errors->first('code') }}</span>
    @endif
</div>
