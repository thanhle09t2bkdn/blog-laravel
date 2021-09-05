<div class="form-group">
    <label for="password_confirmation">Password Confirmation</label>
    <input type="password" name="password_confirmation" class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}" id="password_confirmation" placeholder="Password Confirmation">
    @if ($errors->has('password_confirmation'))
        <span class="error invalid-feedback">{{ $errors->first('password_confirmation') }}</span>
    @endif
</div>
