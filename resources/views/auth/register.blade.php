<x-guest-layout>
    <div id="auth-left">
        <div class="auth-logo">
            <a href="{{ route('register') }}"><img src="{{ asset('/images/logo/logo.png') }}" alt="Logo"></a>
        </div>
        <h1 class="auth-title">Daftar</h1>
        <p class="auth-subtitle mb-5">Satu langkah lagi untuk bergabung bersama kami</p>

        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="form-group position-relative has-icon-left mb-4">
                <input type="text" class="form-control form-control-xl" name="nama" placeholder="Nama Lengkap" required>
                <div class="form-control-icon">
                    <i class="bi bi-person"></i>
                </div>
            </div>
            <div class="form-group position-relative has-icon-left mb-4">
                <input type="email" class="form-control form-control-xl" name="email" placeholder="Email" required>
                <div class="form-control-icon">
                    <i class="bi bi-envelope"></i>
                </div>
            </div>
            <div class="form-group position-relative has-icon-left mb-4">
                <input type="password" class="form-control form-control-xl" name="password" placeholder="Password" required>
                <div class="form-control-icon">
                    <i class="bi bi-shield-lock"></i>
                </div>
            </div>
            <div class="form-group position-relative has-icon-left mb-4">
                <input type="password" class="form-control form-control-xl" name="password_confirmation" placeholder="Confirm Password" required>
                <div class="form-control-icon">
                    <i class="bi bi-shield-lock"></i>
                </div>
            </div>
            <div class="form-group position-relative has-icon-left mb-4">
                <textarea class="form-control form-control-xl" name="alamat" placeholder="Alamat" required></textarea>
                <div class="form-control-icon">
                    <i class="bi bi-house"></i>
                </div>
            </div>
            <div class="form-group position-relative has-icon-left mb-4">
                <input placeholder="Tanggal lahir" class="form-control form-control-xl type="text" onfocus="(this.type='date')" id="date" name="tgl_lahir" required>
                <div class="form-control-icon">
                    <i class="bi bi-calendar"></i>
                </div>
            </div>
            <div class="form-group position-relative mb-4">
                <p style="color: #6c757d; font-size: 22px;">Jenis kelamin</p>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="jenis_kelamin"
                        id="radio_pria" value="pria" required>
                    <label class="form-check-label" for="radio_pria">
                        Pria
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="jenis_kelamin"
                        id="radio_wanita" value="wanita" required>
                    <label class="form-check-label" for="radio_wanita">
                        Wanita
                    </label>
                </div>
            </div>
            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-jet-label for="terms">
                        <div class="flex items-center">
                            <x-jet-checkbox name="terms" id="terms"/>

                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-jet-label>
                </div>
            @endif
            <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Daftar</button>
        </form>
        <div class="text-center mt-5 text-lg fs-4">
            <p class='text-gray-600'>Sudah memiliki akun ? <br/> <a href="{{ route('login') }}"
                    class="font-bold">Log
                    in</a>.</p>
        </div>
    </div>
</x-guest-layout>
