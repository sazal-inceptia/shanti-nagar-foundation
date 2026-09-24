@extends('admin.app')
@section('title')
    User
@endsection

@section('content')

    <div class="container-fluid my-3">
        <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
            @csrf
            <div class="row">
                <div class="col-md-8 col-12">
                    <div class="card table-card">
                        <div class="card-header table-header">
                            <div class="title-with-breadcrumb">
                                <div class="table-title">User</div>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb mb-0">
                                        <li class="breadcrumb-item">
                                            <a href="{{route('dashboard')}}">Dashboard</a>
                                        </li>
                                        <li class="breadcrumb-item">
                                            <a href="{{route('users')}}">User</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page"> Create User</li>
                                    </ol>
                                </nav>
                            </div>
                            <a href="{{route('users')}}" class="add-new">User List<i class="ms-1 ri-list-ordered-2"></i></a>
                        </div>
                        <div class="card-body custom-form">

                            <div class="row">
                                <div class="col-md-6">
                                    <label for="name" class="form-label custom-label custom-label">Name</label>
                                    <input type="text" class="form-control custom-input" name="name" placeholder="Name"
                                        id="name">
                                    @if($errors->has('name'))
                                        <div class="error_msg">
                                            {{ $errors->first('name') }}
                                        </div>
                                    @endif
                                </div>

                                <div class="col-md-6">
                                    <label for="email" class="form-label custom-label">Email</label>
                                    <input type="email" class="form-control custom-input" name="email" placeholder="Email"
                                        id="email">
                                    @if($errors->has('email'))
                                        <div class="error_msg">
                                            {{ $errors->first('email') }}
                                        </div>
                                    @endif
                                </div>

                                <div class="col-md-6">
                                    <label for="" class="form-label custom-label">Password</label>
                                    <input type="password" class="form-control custom-input" name="password"
                                        placeholder="Password">
                                    @if($errors->has('password'))
                                        <div class="error_msg">
                                            {{ $errors->first('password') }}
                                        </div>
                                    @endif
                                </div>

                                <div class="col-md-6">
                                    <label for="" class="form-label custom-label">Confirm Password</label>
                                    <input type="password" class="form-control custom-input" name="password_confirmation"
                                        placeholder="Confirm Password">
                                    @if($errors->has('password_confirmation'))
                                        <div class="error_msg">
                                            {{ $errors->first('password_confirmation') }}
                                        </div>
                                    @endif
                                </div>

                                <div class="col-md-6">
                                    <label for="" class="form-label custom-label">Phone No</label>
                                    <input type="text" class="form-control custom-input" name="phone_no"
                                        placeholder="Phone No">
                                    @if($errors->has('phone_no'))
                                        <div class="error_msg">
                                            {{ $errors->first('phone_no') }}
                                        </div>
                                    @endif
                                </div>

                                <div class="col-md-6">
                                    <label for="role" class="form-label custom-label">Assign Role</label>
                                    <select class="form-select custom-input" name="role" id="role">
                                        @if(isset($roles))
                                            @foreach($roles as $role)
                                                <option value="{{ $role }}" {{ $role === 'user' ? 'selected' : '' }}>
                                                    {{ ucwords(str_replace('-', ' ', $role)) }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @if($errors->has('role'))
                                        <div class="error_msg">
                                            {{ $errors->first('role') }}
                                        </div>
                                    @endif
                                </div>


                                <div class="col-12">
                                    <label for="" class="form-label custom-label">Description</label>
                                    <textarea class="form-control custom-input" name="description" id="description" rows="5"
                                        placeholder="Description" style="resize: none; height: auto"></textarea>
                                    @if($errors->has('description'))
                                        <div class="error_msg">
                                            {{ $errors->first('description') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>




                <div class="col-md-4 col-12">
                    <div class="row g-3">
                        <div class="col-12 order-last order-md-first">
                            <div class="card table-card">
                                <div class="table-header">
                                    <div class="table-title">Action</div>
                                </div>
                                <div class="custom-form card-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <button type="submit" class="btn submit-button">Save
                                                <span class="ms-1 spinner-border spinner-border-sm d-none" role="status">
                                                </span>
                                            </button>
                                        </div>
                                        <div class="col-6">
                                            <a href="{{route('users')}}" class="btn leave-button">Leave</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-12">
                            @include('admin.includes.image-uploader', [
                                'name' => 'image',
                                'id' => 'cover_image',
                                'label' => 'Profile Image',
                                'modalTitle' => 'Upload Profile Image',
                                'helpText' => 'JPG, PNG, WebP up to 5MB',
                                'shape' => 'circle',
                                'height' => '130px'
                            ])
                        </div>

                    </div>
                </div>


            </div>
        </form>
    </div>

@endsection

@push('custom-script')
    <script>
        $('.submit-button').click(function () {
            $(this).css('opacity', '1');
            $(this).find('.spinner-border').removeClass('d-none');
            $(this).attr('disabled', true);
            $(this).closest('form').submit();
        });
    </script>

    {{-- CK Editor --}}
    <script src="{{asset('vendor/ckeditor/ckeditor.js')}}"></script>
    <script type="text/javascript">
        setTimeout(function () {
            CKEDITOR.replace('description', {
                filebrowserUploadUrl: "{{route('ckeditor.upload', ['_token' => csrf_token()])}}",
                filebrowserUploadMethod: 'form'
            });
        }, 100);
    </script>

    <script>
        $(document).ready(function () {
            $('#name').keyup(function () {
                var name = $(this).val();
                if (name == '') {
                    $('#setName').html('Your Name');
                } else {
                    $('#setName').html(name);
                }

            });
            $('#email').keyup(function () {
                var email = $(this).val();
                if (email == '') {
                    $('#setEmail').html('example@gmail.com');
                } else {
                    $('#setEmail').html(email);
                }
            });
        });
    </script>


@endpush