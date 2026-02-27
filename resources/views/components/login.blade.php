<div class="login-page">
    <div class="login-card">
        <h2 class="login-title">Iniciar sesión</h2>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div class="login-field">
                <label for="email" class="login-label">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus class="login-input" />
                <x-input-error :messages="$errors->get('email')" class="login-error" />
            </div>

            <!-- Password -->
            <div class="login-field">
                <label for="password" class="login-label">Contraseña</label>
                <input id="password" type="password" name="password" required class="login-input" />
                <x-input-error :messages="$errors->get('password')" class="login-error" />
            </div>

            <!-- Remember Me -->
            <div class="login-field login-remember">
                <label for="remember_me">
                    <input id="remember_me" type="checkbox" name="remember" />
                    Recordarme
                </label>
            </div>

            <div class="login-field login-actions">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="forgot-password">¿Olvidaste tu contraseña?</a>
                @endif

                <button type="submit" class="login-button">Iniciar sesión</button>
            </div>
        </form>
    </div>
</div>