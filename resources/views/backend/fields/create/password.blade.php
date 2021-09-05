<div class="form-group">
    <label for="password">Password</label>
    <input type="password" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" id="password" placeholder="Password">
    @if ($errors->has('password'))
        <span class="error invalid-feedback">{{ $errors->first('password') }}</span>
    @endif
</div>
