@extends('employee.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Add New Product</h4>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('employee.products.store') }}" enctype="multipart/form-data">
                        @csrf
                        
                        <!-- Basic Information -->
                        <div class="mb-4">
                            <h5>Basic Information</h5>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Product Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                           name="name" value="{{ old('name') }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Category</label>
                                    <select class="form-select @error('category') is-invalid @enderror" 
                                            name="category" required>
                                        <option value="">Select Category</option>
                                        <option value="electronics" {{ old('category') == 'electronics' ? 'selected' : '' }}>Electronics</option>
                                        <option value="clothing" {{ old('category') == 'clothing' ? 'selected' : '' }}>Clothing</option>
                                        <option value="furniture" {{ old('category') == 'furniture' ? 'selected' : '' }}>Furniture</option>
                                        <option value="books" {{ old('category') == 'books' ? 'selected' : '' }}>Books</option>
                                    </select>
                                    @error('category')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Brand</label>
                                    <input type="text" class="form-control @error('brand') is-invalid @enderror" 
                                           name="brand" value="{{ old('brand') }}">
                                    @error('brand')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Model</label>
                                    <input type="text" class="form-control @error('model') is-invalid @enderror" 
                                           name="model" value="{{ old('model') }}">
                                    @error('model')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Pricing and Stock -->
                        <div class="mb-4">
                            <h5>Pricing & Stock</h5>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label">Price ($)</label>
                                    <input type="number" class="form-control @error('price') is-invalid @enderror" 
                                           name="price" step="0.01" min="0" value="{{ old('price') }}" required>
                                    @error('price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">MOQ (Minimum Order Quantity)</label>
                                    <input type="number" class="form-control @error('moq') is-invalid @enderror" 
                                           name="moq" min="1" value="{{ old('moq', 1) }}" required>
                                    @error('moq')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Stock Quantity</label>
                                    <input type="number" class="form-control @error('stock_quantity') is-invalid @enderror" 
                                           name="stock_quantity" min="0" value="{{ old('stock_quantity') }}" required>
                                    @error('stock_quantity')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="mb-4">
                            <h5>Description</h5>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      name="description" rows="4" required>{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Specifications -->
                        <div class="mb-4">
                            <h5>Specifications</h5>
                            <div id="specifications-container">
                                @if(old('specifications'))
                                    @foreach(old('specifications') as $index => $spec)
                                        <div class="row g-3 mb-2 specification-row">
                                            <div class="col-md-5">
                                                <input type="text" class="form-control @error('specifications.'.$index.'.key') is-invalid @enderror" 
                                                       name="specifications[{{ $index }}][key]" 
                                                       value="{{ $spec['key'] ?? '' }}" 
                                                       placeholder="Specification Name">
                                                @error('specifications.'.$index.'.key')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-5">
                                                <input type="text" class="form-control @error('specifications.'.$index.'.value') is-invalid @enderror" 
                                                       name="specifications[{{ $index }}][value]" 
                                                       value="{{ $spec['value'] ?? '' }}" 
                                                       placeholder="Specification Value">
                                                @error('specifications.'.$index.'.value')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-2">
                                                <button type="button" class="btn btn-danger remove-spec">Remove</button>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="row g-3 mb-2 specification-row">
                                        <div class="col-md-5">
                                            <input type="text" class="form-control" 
                                                   name="specifications[0][key]" 
                                                   placeholder="Specification Name">
                                        </div>
                                        <div class="col-md-5">
                                            <input type="text" class="form-control" 
                                                   name="specifications[0][value]" 
                                                   placeholder="Specification Value">
                                        </div>
                                        <div class="col-md-2">
                                            <button type="button" class="btn btn-danger remove-spec" style="display: none;">Remove</button>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <button type="button" class="btn btn-secondary mt-2" id="add-specification">Add Specification</button>
                        </div>

                        <!-- Images -->
                        <div class="mb-4">
                            <h5>Product Images</h5>
                            @error('images')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            @error('images.*')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div class="row" id="image-preview-container">
                                <div class="col-md-3 mb-3">
                                    <div class="image-upload-box">
                                        <input type="file" name="images[]" class="image-upload" accept="image/*" required>
                                        <div class="upload-placeholder">
                                            <i class="fas fa-cloud-upload-alt fa-2x mb-2"></i>
                                            <div>Click to upload</div>
                                            <div class="small text-muted">Max 2MB (JPG, PNG)</div>
                                        </div>
                                        <img class="preview-image" style="display: none;">
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-secondary mt-2" id="add-image">Add More Images</button>
                        </div>

                        <!-- Status -->
                        <div class="mb-4">
                            <h5>Product Status</h5>
                            <select class="form-select @error('status') is-invalid @enderror" name="status" required>
                                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                <option value="out_of_stock" {{ old('status') == 'out_of_stock' ? 'selected' : '' }}>Out of Stock</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="text-end">
                            <button type="button" class="btn btn-secondary me-2" onclick="window.history.back()">Cancel</button>
                            <button type="submit" class="btn btn-primary">Add Product</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
.image-upload-box {
    border: 2px dashed #ddd;
    border-radius: 8px;
    padding: 20px;
    text-align: center;
    cursor: pointer;
    position: relative;
    height: 200px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #f8f9fa;
    transition: all 0.3s ease;
}

.image-upload-box:hover {
    border-color: #adb5bd;
    background: #f1f3f5;
}

.image-upload {
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    opacity: 0;
    cursor: pointer;
}

.preview-image {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
}

.upload-placeholder {
    color: #6c757d;
}

.remove-image {
    position: absolute;
    top: 5px;
    right: 5px;
    background: rgba(255, 255, 255, 0.9);
    border: none;
    border-radius: 50%;
    width: 25px;
    height: 25px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    color: #dc3545;
    z-index: 1;
}

.remove-image:hover {
    background: #fff;
    color: #bb2d3b;
}
</style>
@endpush

@push('scripts')
<script>
$(document).ready(function() {
    // Handle specification rows
    let specCount = {{ old('specifications') ? count(old('specifications')) : 1 }};
    
    $('#add-specification').click(function() {
        const newRow = `
            <div class="row g-3 mb-2 specification-row">
                <div class="col-md-5">
                    <input type="text" class="form-control" 
                           name="specifications[${specCount}][key]" 
                           placeholder="Specification Name">
                </div>
                <div class="col-md-5">
                    <input type="text" class="form-control" 
                           name="specifications[${specCount}][value]" 
                           placeholder="Specification Value">
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-danger remove-spec">Remove</button>
                </div>
            </div>
        `;
        $('#specifications-container').append(newRow);
        specCount++;
        
        // Show all remove buttons if there's more than one row
        if ($('.specification-row').length > 1) {
            $('.remove-spec').show();
        }
    });
    
    // Handle remove specification
    $(document).on('click', '.remove-spec', function() {
        $(this).closest('.specification-row').remove();
        
        // Hide remove buttons if only one row remains
        if ($('.specification-row').length === 1) {
            $('.remove-spec').hide();
        }
    });
    
    // Show remove buttons if there's more than one row initially
    if ($('.specification-row').length > 1) {
        $('.remove-spec').show();
    }

    // Handle image upload preview
    function readURL(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            const preview = $(input).closest('.image-upload-box').find('.preview-image');
            const placeholder = $(input).closest('.image-upload-box').find('.upload-placeholder');
            
            reader.onload = function(e) {
                preview.attr('src', e.target.result);
                preview.show();
                placeholder.hide();
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }

    $(document).on('change', '.image-upload', function() {
        readURL(this);
    });

    // Handle adding more image upload boxes
    $('#add-image').click(function() {
        const newImageUpload = `
            <div class="col-md-3 mb-3">
                <div class="image-upload-box">
                    <input type="file" name="images[]" class="image-upload" accept="image/*">
                    <div class="upload-placeholder">
                        <i class="fas fa-cloud-upload-alt fa-2x mb-2"></i>
                        <div>Click to upload</div>
                        <div class="small text-muted">Max 2MB (JPG, PNG)</div>
                    </div>
                    <img class="preview-image" style="display: none;">
                    <button type="button" class="remove-image">&times;</button>
                </div>
            </div>
        `;
        $('#image-preview-container').append(newImageUpload);
    });

    // Handle removing image upload boxes
    $(document).on('click', '.remove-image', function() {
        $(this).closest('.col-md-3').remove();
    });
});
</script>
@endpush
@endsection 