<div class="form-group">
    <label for="description">Description</label>
    <textarea type="text" name="description" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"
           id="description" placeholder="Enter Description" rows="4">
        {{ old('description', $item->description) }}
    </textarea>
    @if ($errors->has('description'))
        <span class="error invalid-feedback">{{ $errors->first('description') }}</span>
    @endif
</div>
