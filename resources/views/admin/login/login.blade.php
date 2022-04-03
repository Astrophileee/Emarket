@include('admin.partials.header')


<div class="container">
    
    <div class="card card-primary" style="height: 650px">
        <div class="card-header text-center">
            <h4 style="color: black">Login</h4>
        </div>
        <div class="card-body center">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" tabindex="1"
                        autofocus>
                    @error('email')
                        <div class="form-text text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <div class="d-block">
                        <label for="password" class="control-label">Password</label>
                    </div>
                    <input id="password" type="password" class="form-control" name="password" value="{{ old('password') }}"
                        tabindex="2">
                    @error('password')
                        <div class="form-text text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="remember" class="custom-control-input"
                            tabindex="3" id="remember-me">
                        <label class="custom-control-label" for="remember-me">Remember Me</label>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                        Login
                    </button>
                </div>
            </form>

            <div class="mt-3">
                <a href="/forgot-password" class="mx-auto">Lupa Password?</a>
            </div>
        </div>
    </div>
</div>
@include('admin.partials.footer')