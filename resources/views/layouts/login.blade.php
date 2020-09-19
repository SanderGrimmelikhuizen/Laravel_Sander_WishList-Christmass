<div class="form-group row">
    <label for="username" class="col-md-4 col-form-label text-md-right">Username Or Email</label>

    <div class="col-md-6">
        <input id="username" type="username" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required  autofocus>

        @error('username')
        <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
