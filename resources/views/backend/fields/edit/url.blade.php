<div class="form-group">
    <label for="url">Url</label>
    <input type="text" name="url" class="form-control {{ $errors->has('url') ? 'is-invalid' : '' }}"
           id="url" placeholder="Enter url" value="{{ old('url', $item->url) }}">
    @if ($errors->has('url'))
        <span class="error invalid-feedback">{{ $errors->first('url') }}</span>
    @endif
</div>
