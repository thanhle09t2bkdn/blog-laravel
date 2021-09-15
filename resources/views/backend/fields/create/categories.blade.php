<div class="form-group">
    <label for="content">Categories</label>
    <select class="form-control select2 {{ $errors->has('category_id') ? 'is-invalid' : '' }}" name="categories[]" id="categories" multiple="multiple">
        @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                {{ $category->title }}
            </option>
        @endforeach
    </select>
    @if ($errors->has('categories'))
        <span class="error invalid-feedback">{{ $errors->first('categories') }}</span>
    @endif
</div>
