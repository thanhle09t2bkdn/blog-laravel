<div class="form-group">
    <label for="content">Content</label>
    <textarea id="content" class="form-control {{ $errors->has('content') ? 'is-invalid' : '' }}" name="content" rows="5" placeholder="Enter Content">{{ old('content') }}</textarea>
    @if ($errors->has('content'))
        <span class="error invalid-feedback">{{ $errors->first('content') }}</span>
    @endif
</div>
