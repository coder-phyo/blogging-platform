<div>
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header">
                <ul class="nav nav-pills card-header-pills">
                    <li class="nav-item">
                        <h2>Categories</h2>
                    </li>
                    <li class="nav-item ms-auto">
                        <a class="btn btn-primary" href="#" data-bs-toggle="modal" data-bs-target="#add-category">
                            Add Category
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="card">
                    <div class="table-responsive">
                        <table class="table table-vcenter card-table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>CATEGORY NAME</th>
                                    <th>DATE</th>
                                    <th class="w-1"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($categories as $category)
                                <tr>
                                    <td>{{$category->category_id}}</td>
                                    <td>
                                        {{$category->category_name}}
                                    </td>
                                    <td>{{$category->updated_at->format('F-j-Y')}}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="#" wire:click.prevent="editCategory({{$category->category_id}})" class="btn btn-outline-azure">Edit</a> &nbsp;
                                            <a href="#" wire:click.prevent="deleteCategory({{$category->category_id}})" class="btn btn-outline-youtube">Delete</a>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="3"><span class="text-danger">No category found</span></td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- modal --}}
    <div wire:ignore.self class="modal modal-blur fade" id="add-category" tabindex="-1" style="display: none;" aria-hidden="true"
        data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <form class="modal-content" method="POST" @if ($updateCategoryMode) wire:submit.prevent='updateCategory'
             @else wire:submit.prevent='addCategory' @endif>
                <div class="modal-header">
                    <h5 class="modal-title">{{ $updateCategoryMode ? 'Update Category' : 'Add Category' }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if ($updateCategoryMode)
                        <input type="hidden" wire:model.debounce.500ms="selected_category_id">
                    @endif
                    <div class="mb-3">
                        <label class="form-label">Category name</label>
                        <input type="text" class="form-control" wire:model.debounce.500ms="category_name"
                            placeholder="Enter category name...">
                            @error('category_name')
                            <span class="text-danger">{{$message}}</span>
                         @enderror
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn {{ $updateCategoryMode ? 'btn-warning' : 'btn-primary' }}"
                        >{{ $updateCategoryMode ? 'Update' : 'Add' }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        $(window).on('hidden.bs.modal', function(){
            Livewire.emit('resetForm');
        });
        window.addEventListener('hide-modal',function(){
            $('#add-category').modal('hide');
        });
        window.addEventListener('show-modal',function(){
            $('#add-category').modal('show');
        });
    </script>
@endpush
