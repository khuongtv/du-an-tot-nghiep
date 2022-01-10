@extends('admin.layout.layout')
@section('links')
    <link rel="stylesheet" type="text/css" href="{{asset('theme/admin/plugins/select2/select2.min.css')}}">
    <style>
        .error {
            font-size: 12px !important;
            color: red !important;
        }

        /* Start by setting display:none to make this hidden.
        Then we position it in relation to the viewport window
        with position:fixed. Width, height, top and left speak
        for themselves. Background we set to 80% white with
        our animation centered, and no-repeating */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            background: rgba(255, 255, 255, .8) url('http://i.stack.imgur.com/FhHRx.gif') 50% 50% no-repeat;
        }

        /* When the body has the loading class, we turn
                   the scrollbar off with overflow:hidden */
        body.loading .modal {
            overflow: hidden;
        }

        /* Anytime the body has the loading class, our
                   modal element will be visible */
        body.loading .modal {
            display: block;
        }

        .sp {
            font-size: 18px;
            font-weight: lighter;
            color: white;
            /* color: #2196F3; */
        }

        p {
            font-size: 16px;
            /* color: #2196F3; */
            color: burlywood;
        }

        .dropify-wrapper {
            background: none;
            border: none;
        }

        .dropify-wrapper:hover {
            background: none;
        }
    </style>
@endsection
@section('title', 'Sửa tài khoản')
@section('route', 'Sửa tài khoản')
@section('user-menu', 'actives')
@section('main-content')
    <br>
    <div class="col-lg-12 col-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-content widget-content-area">
                <form action="{{route('users.updated',['id'=>$user->id])}}" id="edit-user-form" method="post"
                      enctype="multipart/form-data" novalidate>
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <label for="exampleFormControlInput2">Name</label>
                            <input type="text" name="name"
                                   @if(isset($userAdmin)) value="{{old('name', $userAdmin->name)}}"
                                   @else value="{{old('name')}}" @endif class="form-control name" id=""
                                   placeholder="name">
                        </div>
                        <div class="col-md-6">
                            <label for="exampleFormControlInput2">Email</label>
                            <input type="email" name="email" readonly value="{{old('email',$user->email)}}"
                                   class="form-control email" id="" placeholder="example@gmail.com">
                            @error("email")
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="exampleFormControlInput2">Phone</label>
                            <input type="text" name="phone_number"
                                   @if(isset($userAdmin)) value="{{old('phone_number', $userAdmin->phone_number)}}"
                                   @else value="{{old('phone_number')}}" @endif class="form-control phone_number" id=""
                                   placeholder="Phone">
                        </div>
                        <div class="col-md-6">
                            <label>Role</label>
                            <select class="form-control role basic" name="role">
                                @foreach(config('common.users') as $u => $item)
                                    <option @if(old('role')==$user->role || $u == $user->role ) selected
                                            @endif value="{{$u}}">{{$item}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Avatar</label>
                            <div class="upload">
                                <input type="file" name="avatar" id="input-file-max-fs logo " class="dropify "
                                       data-default-file="" data-max-file-size="2M"/>
                                @error('avatar')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <br>
                            <div class="div">
                                @isset($userAdmin->avatar)
                                    <img src="{{asset('storage/' . $userAdmin->avatar)}}" height="200px"
                                         alt="">
                                @endisset
                            </div>
                        </div>
                    </div>
                    <br>
                    <button type="submit" name="time" class="mt-4 mb-4 btn btn-primary">Cập nhật</button>
                    <a href="{{route('users.index')}}" type="submit" name="time" class="mt-4 mb-4 btn btn-danger">Quay
                        lại</a>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('datatable-script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        /**
         * Validate
         */
        $('#edit-user-form').validate({
            rules: {
                name: {
                    required: true
                },
                email: {
                    required: true,
                    email: true,
                    regex: /^\b[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i,
                },
                phone_number: {
                    required: true,
                    number: true
                },
            },
            messages: {
                name: {
                    required: "Yêu cầu bắt buộc"
                },
                phone_number: {
                    required: "Yêu cầu bắt buộc",
                    number: "Yêu cầu là số"
                },
                email: {
                    required: "Yêu cầu bắt buộc ",
                    email: "Vui lòng nhập đúng định dạng email",
                    regex: "Email không đúng định dạng"
                },

            },
            submitHandler: function (form) {
                form.submit();
            }
        });

        // add method regex to validate email
        $.validator.addMethod(
            "regex",
            /* The function that tests a given string against a given regEx. */
            function (value, element, regexp) {
                /* Check if the value is truthy (avoid null.constructor) & if it's not a RegEx. (Edited: regex --> regexp)*/

                if (regexp && regexp.constructor !== RegExp) {
                    /* Create a new regular expression using the regex argument. */
                    regexp = new RegExp(regexp);
                }

                /* Check whether the argument is global and, if so set its last index to 0. */
                else if (regexp.global) regexp.lastIndex = 0;

                /* Return whether the element is optional or the result of the validation. */
                return this.optional(element) || regexp.test(value);
            });
    </script>
@endsection