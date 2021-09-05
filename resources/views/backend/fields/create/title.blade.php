<div class="form-group">
    <label for="title">Title</label>
    <input type="text" name="title" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
           id="title" placeholder="Enter Title" value="{{ old('title') }}">
    @if ($errors->has('title'))
        <span class="error invalid-feedback">{{ $errors->first('title') }}</span>
    @endif
</div>
