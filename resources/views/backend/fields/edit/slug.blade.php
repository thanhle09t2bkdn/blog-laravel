<div class="form-group">
    <label for="slug">Slug</label>
    <input type="text" name="slug" class="form-control {{ $errors->has('slug') ? 'is-invalid' : '' }}"
           id="slug" placeholder="Enter Slug" value="{{ old('slug', $item->slug) }}">
    @if ($errors->has('slug'))
        <span class="error invalid-feedback">{{ $errors->first('slug') }}</span>
    @endif
</div>
