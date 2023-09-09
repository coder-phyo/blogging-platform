<div>
    <form wire:submit.prevent='addAuthors'>
        <div class="modal-body">
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" class="form-control" wire:model.debounce.500ms="name"
                    placeholder="Enter author name">
                    @error('name')
                   <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control"
                wire:model.debounce.500ms="email" placeholder="Enter author email">
                    @error('email')
                   <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="mb-3">
                <div class="form-label">Role</div>
                <select class="form-select" wire:model.debounce.500ms="role">
                  <option value="noSelected">---No selected---</option>
                  <option value="0">Admin/Super Author</option>
                  <option value="1">Author</option>
                </select>
                @error('role')
                   <span class="text-danger">{{$message}}</span>
                @enderror
              </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" name="password" wire:model.debounce.500ms="password"
                    placeholder="Enter author password">
                    @error('password')
                   <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Confirm Password</label>
                <input type="password" class="form-control" name="confirmPassword" wire:model.debounce.500ms="confirmPassword"
                    placeholder="Enter confirm password">
                    @error('confirmPassword')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" >Save</button>
        </div>
    </form>
</div>

