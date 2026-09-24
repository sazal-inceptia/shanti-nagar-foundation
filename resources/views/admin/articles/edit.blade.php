@extends('admin.app')
@section('title')
    Edit Article: {{ $article->title }}
@endsection

@push('custom-style')
    <style>
        .dropzone-box {
            border: 2px dashed #cbd5e1;
            border-radius: 10px;
            background-color: #f8fafc;
            padding: 24px 16px;
            text-align: center;
            cursor: pointer;
            transition: all 0.25s ease;
            position: relative;
        }

        .dropzone-box:hover,
        .dropzone-box.dragover {
            border-color: #f95716;
            background-color: #fff7ed;
            transform: translateY(-1px);
        }

        .dropzone-box.dragover {
            box-shadow: 0 0 0 4px rgba(249, 87, 22, 0.15);
        }

        .dropzone-icon {
            width: 52px;
            height: 52px;
            line-height: 52px;
            border-radius: 50%;
            background-color: rgba(249, 87, 22, 0.1);
            color: #f95716;
            font-size: 26px;
            margin: 0 auto 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.2s ease;
        }

        .dropzone-box:hover .dropzone-icon {
            transform: scale(1.08);
        }

        .upload-btn {
            background-color: #f95716;
            border-color: #f95716;
            color: #ffffff;
            font-weight: 600;
            font-size: 13px;
            border-radius: 6px;
            transition: all 0.15s ease;
        }

        .upload-btn:hover {
            background-color: #ea580c;
            color: #ffffff;
        }

        .preview-remove-btn {
            position: absolute;
            top: 6px;
            right: 6px;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: rgba(239, 68, 68, 0.9);
            color: #ffffff;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            cursor: pointer;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            transition: all 0.2s ease;
            z-index: 5;
        }

        .preview-remove-btn:hover {
            background: #dc2626;
            transform: scale(1.15);
        }

    </style>
@endpush

@section('content')
    <div class="container-fluid my-3">
        <form id="articleEditForm" action="{{ route('articles.update', $article->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                {{-- Left Column: Main Article Details --}}
                <div class="col-lg-8 col-12">
                    <div class="card table-card mb-4">
                        <div class="card-header table-header">
                            <div class="title-with-breadcrumb">
                                <div class="table-title">Edit Article</div>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb mb-0">
                                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="{{ route('articles.index') }}">News &
                                                Articles</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                                    </ol>
                                </nav>
                            </div>
                            <div class="d-flex gap-2">
                                <a href="{{ route('articles.show', $article->id) }}" class="add-new"
                                    style="background-color: #f1f5f9; color: #334155;">
                                    <i class="ri-eye-line me-1"></i> Preview
                                </a>
                                <a href="{{ route('articles.index') }}" class="add-new">
                                    <i class="ri-list-check me-1"></i> Articles List
                                </a>
                            </div>
                        </div>
                        <div class="card-body custom-form p-4">
                            <div class="row g-3">
                                {{-- Article Title --}}
                                <div class="col-md-7 col-12">
                                    <label for="title" class="form-label custom-label">Article Title <span
                                            class="text-danger">*</span></label>
                                    <input type="text"
                                        class="form-control custom-input @error('title') is-invalid @enderror" name="title"
                                        id="title" value="{{ old('title', $article->title) }}" required>
                                    @error('title')
                                        <div class="text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Slug --}}
                                <div class="col-md-5 col-12">
                                    <label for="slug" class="form-label custom-label">URL Slug</label>
                                    <input type="text" class="form-control custom-input @error('slug') is-invalid @enderror"
                                        name="slug" id="slug" value="{{ old('slug', $article->slug) }}">
                                    @error('slug')
                                        <div class="text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Category & Read Time --}}
                                <div class="col-md-8 col-12">
                                    <div class="d-flex align-items-center justify-content-between mb-1">
                                        <label for="category_id" class="form-label custom-label mb-0">Category</label>
                                        <div class="d-flex align-items-center gap-2">
                                            <a href="{{ route('article-categories.index') }}" target="_blank"
                                                class="text-decoration-none text-muted"
                                                style="font-size: 12px; font-weight: 500;"
                                                title="Manage Categories in full view">
                                                <i class="ri-settings-3-line text-primary me-1"></i>Manage Categories
                                            </a>
                                            @canany(['article-category-create', 'blog-create'])
                                                <button type="button"
                                                    class="btn btn-sm btn-outline-primary d-inline-flex align-items-center justify-content-center p-0 rounded-circle"
                                                    style="width: 22px; height: 22px; border-width: 1.5px;"
                                                    title="Quick Add Category" data-bs-toggle="modal"
                                                    data-bs-target="#quickCategoryModal">
                                                    <i class="ri-add-line" style="font-size: 14px; font-weight: 700;"></i>
                                                </button>
                                            @endcanany
                                        </div>
                                    </div>
                                    <select class="form-select custom-input @error('category_id') is-invalid @enderror"
                                        name="category_id" id="category_id">
                                        <option value="">Select Category (None)</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id', $article->category_id) == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <div class="text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4 col-12">
                                    <label for="read_time" class="form-label custom-label">Read Time (Mins)</label>
                                    <input type="number"
                                        class="form-control custom-input @error('read_time') is-invalid @enderror"
                                        name="read_time" id="read_time" value="{{ old('read_time', $article->read_time) }}"
                                        min="1" max="120">
                                    @error('read_time')
                                        <div class="text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Excerpt / Short Summary --}}
                                <div class="col-12">
                                    <label for="summary" class="form-label custom-label">Excerpt / Short Summary</label>
                                    <textarea class="form-control custom-input @error('summary') is-invalid @enderror"
                                        name="summary" id="summary"
                                        rows="3">{{ old('summary', $article->summary) }}</textarea>
                                    @error('summary')
                                        <div class="text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Full Content (CKEditor) --}}
                                <div class="col-12">
                                    <label for="editor" class="form-label custom-label">Full Article Content</label>
                                    <textarea class="form-control custom-input @error('content') is-invalid @enderror"
                                        name="content" id="editor"
                                        rows="12">{{ old('content', $article->content) }}</textarea>
                                    @error('content')
                                        <div class="text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Search Engine Optimization (SEO) --}}
                    <div class="card table-card mb-4">
                        <div class="card-header table-header">
                            <div class="table-title">SEO &amp; Search Metadata</div>
                        </div>
                        <div class="card-body custom-form p-4">
                            <div class="row g-3">
                                <div class="col-12">
                                    <label for="meta_title" class="form-label custom-label">Meta Title</label>
                                    <input type="text" class="form-control custom-input" name="meta_title" id="meta_title"
                                        value="{{ old('meta_title', $article->meta_title) }}">
                                </div>
                                <div class="col-12">
                                    <label for="meta_description" class="form-label custom-label">Meta Description</label>
                                    <textarea class="form-control custom-input" name="meta_description"
                                        id="meta_description"
                                        rows="2">{{ old('meta_description', $article->meta_description) }}</textarea>
                                </div>
                                <div class="col-12">
                                    <label class="form-label custom-label">SEO Meta Image (Open Graph / Social Sharing)</label>
                                    @include('admin.includes.image-uploader', [
                                        'name' => 'meta_image',
                                        'id' => 'article_meta_image',
                                        'label' => 'Upload Meta Image',
                                        'modalTitle' => 'Upload Article SEO Meta Image',
                                        'helpText' => 'JPG, PNG, WebP up to 5MB (1200×630px recommended)',
                                        'currentImage' => $article->hasMedia('meta_image') ? $article->meta_image_url : null,
                                        'currentName' => $article->getFirstMedia('meta_image')?->file_name ?? $article->meta_title ?? 'SEO Image',
                                        'shape' => 'rectangle',
                                        'height' => '140px'
                                    ])
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Right Column: Controls, Actions & Cover Photo --}}
                <div class="col-lg-4 col-12">
                    <div class="row g-3">
                        {{-- Publish Actions --}}
                        <div class="col-12">
                            <div class="card table-card">
                                <div class="card-header table-header">
                                    <div class="table-title">Publish Actions</div>
                                </div>
                                <div class="card-body custom-form p-4">
                                    <div class="d-flex flex-column gap-3 mb-4">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="is_published"
                                                id="is_published" value="1" {{ old('is_published', $article->is_published) ? 'checked' : '' }} style="cursor: pointer;">
                                            <label class="form-check-label fw-semibold" for="is_published"
                                                style="font-size: 13.5px; cursor: pointer;">
                                                Visible on Website
                                            </label>
                                        </div>

                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="featured" id="featured"
                                                value="1" {{ old('featured', $article->featured) ? 'checked' : '' }}
                                                style="cursor: pointer;">
                                            <label class="form-check-label fw-semibold" for="featured"
                                                style="font-size: 13.5px; cursor: pointer;">
                                                Feature on Homepage
                                            </label>
                                        </div>

                                        <div>
                                            <label for="published_at" class="form-label custom-label mb-1">Publication
                                                Date</label>
                                            <input type="datetime-local" class="form-control custom-input"
                                                name="published_at" id="published_at"
                                                value="{{ old('published_at', $article->published_at ? $article->published_at->format('Y-m-d\TH:i') : '') }}" onclick="this.showPicker()">
                                        </div>

                                        <div>
                                            <label for="sort_order" class="form-label custom-label mb-1">Display Priority
                                                Order</label>
                                            <input type="number" class="form-control custom-input" name="sort_order"
                                                id="sort_order" value="{{ old('sort_order', $article->sort_order) }}"
                                                min="0">
                                            <div class="text-muted" style="font-size: 11px;">Lower numbers appear first
                                                (e.g. 0, 1, 2)</div>
                                        </div>
                                    </div>

                                    <div class="row g-2">
                                        <div class="col-6">
                                            <button type="submit" class="btn submit-button w-100">
                                                <i class="ri-check-line me-1"></i> Update
                                            </button>
                                        </div>
                                        <div class="col-6">
                                            <a href="{{ route('articles.index') }}" class="btn leave-button w-100">
                                                Cancel
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Featured Cover Photo --}}
                        <div class="col-12">
                            <div class="card table-card">
                                <div class="card-header table-header">
                                    <div class="table-title">Featured Cover Photo</div>
                                </div>
                                <div class="card-body custom-form p-3">
                                    @include('admin.includes.image-uploader', [
                                        'name' => 'image',
                                        'label' => 'Cover Photo',
                                        'modalTitle' => 'Upload Article Cover Photo',
                                        'currentImage' => $article->hasMedia('image') ? $article->image_url : null,
                                        'currentName' => $article->getFirstMedia('image')?->file_name ?? $article->title,
                                        'shape' => 'rectangle',
                                        'height' => '170px'
                                    ])
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('custom-script')
    <script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            // Initialize CKEditor
            if (typeof CKEDITOR !== 'undefined' && document.getElementById('editor')) {
                CKEDITOR.replace('editor', {
                    filebrowserUploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}",
                    filebrowserUploadMethod: 'form',
                    height: 350
                });
            }



            // Quick Category Form AJAX Handler
            $('#quickCategoryForm').on('submit', function (e) {
                e.preventDefault();
                var $form = $(this);
                var $btn = $('#btnSaveQuickCategory');
                var $spinner = $('#saveCategorySpinner');
                var name = $('#quick_category_name').val().trim();

                if (!name) {
                    $('#quick_category_name').addClass('is-invalid');
                    $('#quick_category_name_error').text('Category name is required.');
                    return;
                }

                $btn.prop('disabled', true);
                $spinner.removeClass('d-none');
                $('#quick_category_name').removeClass('is-invalid');
                $('#quick_category_name_error').text('');

                $.ajax({
                    url: "{{ route('article-categories.store') }}",
                    type: 'POST',
                    data: $form.serialize(),
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    success: function (res) {
                        $btn.prop('disabled', false);
                        $spinner.addClass('d-none');

                        if (res.success) {
                            var cat = res.data;
                            // Append to category select and select it
                            var newOption = new Option(cat.name, cat.id, true, true);
                            $('#category_id').append(newOption).trigger('change');

                            // Reset form and close modal
                            $form[0].reset();
                            var modalEl = document.getElementById('quickCategoryModal');
                            var modal = bootstrap.Modal.getInstance(modalEl);
                            if (modal) {
                                modal.hide();
                            } else {
                                $('#quickCategoryModal').modal('hide');
                            }

                            if (typeof toastr !== 'undefined') {
                                toastr.success(res.message || 'Category created and selected!', 'Success');
                            }
                        }
                    },
                    error: function (xhr) {
                        $btn.prop('disabled', false);
                        $spinner.addClass('d-none');

                        if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                            var errors = xhr.responseJSON.errors;
                            if (errors.name) {
                                $('#quick_category_name').addClass('is-invalid');
                                $('#quick_category_name_error').text(errors.name[0]);
                            }
                            if (errors.description) {
                                $('#quick_category_description').addClass('is-invalid');
                                $('#quick_category_description_error').text(errors.description[0]);
                            }
                        } else {
                            var errMsg = (xhr.responseJSON && xhr.responseJSON.message) ? xhr.responseJSON.message : 'Failed to save category.';
                            if (typeof toastr !== 'undefined') {
                                toastr.error(errMsg, 'Error');
                            } else {
                                alert(errMsg);
                            }
                        }
                    }
                });
            });
        });
    </script>

    {{-- Quick Add Category Modal --}}
    <div class="modal fade" id="quickCategoryModal" tabindex="-1" aria-labelledby="quickCategoryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;">
                <div class="modal-header border-bottom py-3 px-4" style="background-color: #f8fafc;">
                    <div class="d-flex align-items-center gap-2">
                        <div class="d-flex align-items-center justify-content-center rounded"
                            style="width: 32px; height: 32px; background-color: #fff3ee; color: #f95716;">
                            <i class="ri-price-tag-3-line" style="font-size: 17px;"></i>
                        </div>
                        <div>
                            <h6 class="modal-title fw-bold text-dark mb-0" id="quickCategoryModalLabel"
                                style="font-size: 15px;">Add Article Category</h6>
                            <span class="text-muted" style="font-size: 12px;">Create a new category for articles</span>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="quickCategoryForm">
                    @csrf
                    <div class="modal-body p-4">
                        <div class="mb-3">
                            <label for="quick_category_name" class="form-label custom-label required">Category Name <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control custom-input" id="quick_category_name" name="name"
                                required placeholder="e.g. Sustainable Architecture, Civil Engineering">
                            <div class="invalid-feedback" id="quick_category_name_error"></div>
                        </div>
                        <div class="mb-2">
                            <label for="quick_category_description" class="form-label custom-label">Description <span
                                    class="text-muted fw-normal">(Optional)</span></label>
                            <textarea class="form-control custom-input" id="quick_category_description" name="description"
                                rows="3" placeholder="Brief description of articles in this category..."></textarea>
                            <div class="invalid-feedback" id="quick_category_description_error"></div>
                        </div>
                    </div>
                    <div class="modal-footer border-top py-2 px-4 d-flex justify-content-between"
                        style="background-color: #f8fafc;">
                        <a href="{{ route('article-categories.index') }}" target="_blank"
                            class="text-primary text-decoration-none fw-semibold" style="font-size: 12.5px;">
                            <i class="ri-external-link-line me-1"></i>Manage Categories
                        </a>
                        <div class="d-flex align-items-center gap-2">
                            <button type="button" class="btn btn-sm btn-light border" data-bs-dismiss="modal"
                                style="font-size: 13px; font-weight: 500; padding: 6px 14px; border-radius: 6px;">Cancel</button>
                            <button type="submit" id="btnSaveQuickCategory" class="btn btn-sm text-white"
                                style="background-color: #f95716; border-color: #f95716; font-size: 13px; font-weight: 600; padding: 6px 16px; border-radius: 6px;">
                                <span class="spinner-border spinner-border-sm me-1 d-none" id="saveCategorySpinner"
                                    role="status"></span>
                                <span>Save Category</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endpush