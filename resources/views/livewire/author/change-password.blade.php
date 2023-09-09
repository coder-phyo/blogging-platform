<div>
    <form wire:submit.prevent="changePassword">
        <div class="row">
            @if (session()->has('passwordUpdatedSuccess'))
                <div class="alert alert-green alert-tr fade show offset-8 col-auto opacity-90" role="alert">
                    <strong>{{ session('passwordUpdatedSuccess') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="mb-3">
                    <label class="form-label">Current Password</label>
                    <input type="password" class="form-control @error('current_pass') is-invalid @enderror"
                        wire:model.debounce.500ms="current_pass" placeholder="Current Password">
                    @error('current_pass')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    @if (Session::has('fail'))
                        <div class="alert alert-danger">{{ Session::get('fail') }}</div>
                    @endif

                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label class="form-label">New Password</label>
                    <input type="password" class="form-control @error('new_pass') is-invalid @enderror"
                        wire:model.debounce.500ms="new_pass" placeholder="New Password">
                    @error('new_pass')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label class="form-label">Confirm Password</label>
                    <input type="password" class="form-control @error('confirm_new_pass') is-invalid @enderror"
                        wire:model.debounce.500ms="confirm_new_pass" placeholder="Retype New Password">
                    @error('confirm_new_pass')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-2">
                <button class="btn btn-primary">Change Password</button>
            </div>
        </div>
    </form>

</div>
