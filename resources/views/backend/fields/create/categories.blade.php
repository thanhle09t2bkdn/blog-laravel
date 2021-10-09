<div class="form-group">
    <label for="categories">Categories</label>
    <select class="form-control select2 {{ $errors->has('categories') ? 'is-invalid' : '' }}" name="categories[]" id="categories" multiple="multiple">
        @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ old('categories') && in_array($category->id, old('categories')) ? 'selected' : '' }}>
                {{ $category->title }}
            </option>
        @endforeach
    </select>

    @if ($errors->has('categories'))
        <span class="error invalid-feedback">{{ $errors->first('categories') }}</span>
    @endif
</div>
