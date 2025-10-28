<section class="mb-4">
    <header class="mb-3">
        <h2 class="h5 fw-bold text-dark">
            {{ __('Delete Account') }}
        </h2>
        <p class="small text-muted">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
        {{ __('Delete Account') }}
    </button>

    <!-- Modal -->
    <div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-labelledby="deleteAccountModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                @if (auth()->user()->google_id && !auth()->user()->getAuthPassword())
                    <!-- TAMPILAN UNTUK SOCIAL USERS (GOOGLE AUTH) -->
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteAccountModalLabel">
                            {{ __('Delete Google Account') }}
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <strong>Akun Google Terdeteksi</strong>
                        </div>

                        <p class="small text-muted">
                            {{ __('Your account is connected to Google. To delete your account:') }}
                        </p>

                        <ol class="small text-muted">
                            <li>{{ __('Set a password first in your profile page') }}</li>
                            <li>{{ __('Then come back here to delete your account') }}</li>
                        </ol>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            {{ __('Cancel') }}
                        </button>
                        <a href="{{ route('profile.edit') }}#password" class="btn btn-warning">
                            <i class="fas fa-key me-1"></i>
                            {{ __('Set Password') }}
                        </a>
                    </div>
                @else
                    <!-- TAMPILAN NORMAL UNTUK USER DENGAN PASSWORD -->
                    <form method="POST" action="{{ route('profile.destroy') }}">
                        @csrf
                        @method('delete')

                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteAccountModalLabel">
                                {{ __('Are you sure you want to delete your account?') }}
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <p class="small text-muted">
                                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                            </p>

                            <div class="mb-3">
                                <label for="password" class="form-label">{{ __('Password') }}</label>
                                <input id="password" name="password" type="password"
                                    class="form-control @error('password', 'userDeletion') is-invalid @enderror"
                                    placeholder="{{ __('Password') }}" required>

                                @error('password', 'userDeletion')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                {{ __('Cancel') }}
                            </button>
                            <button type="submit" class="btn btn-danger">
                                {{ __('Delete Account') }}
                            </button>
                        </div>
                    </form>
                @endif

            </div>
        </div>
    </div>
</section>
