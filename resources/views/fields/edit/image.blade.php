<div class="form-group">
    <label for="image">Image</label>
    <div class="input-group">
        <div class="input-group-prepend">
            <button type="button" data-input="image" data-preview="preview-image" class="btn btn-primary image-manager">
                <i class="far fa-image"></i> Choose
            </button>
        </div>
        <input id="image" type="text" name="image" class="form-control {{ $errors->has('image') ? 'is-invalid' : '' }}" placeholder="https://" value="{{ old('image', $item->image) }}">
        @if ($errors->has('image'))
            <span class="error invalid-feedback">{{ $errors->first('image') }}</span>
        @endif
    </div>
    <p id="preview-image" class="my-3">
        @if (old('image'))
            <img src="{{ old('image', $item->image) }}" style="height: 5rem;">
        @endif
    </p>
</div>
