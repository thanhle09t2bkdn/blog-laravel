<div class="form-group">
    <label for="email">Email</label>
    <input type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" id="email" placeholder="Enter Email" value="{{ old('email') }}">
    @if ($errors->has('email'))
        <span class="error invalid-feedback">{{ $errors->first('email') }}</span>
    @endif
</div>
