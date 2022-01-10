@extends('admin.layout.layout')
@section('links')
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
@section('title', 'Thêm tài khoản')
@section('route', 'Thêm tài khoản')
@section('user-menu', 'actives')
@section('main-content')
    <div class="page_loader"></div>

    <div class="col-lg-12 col-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-content widget-content-area">
                <form action="{{route('users.store')}}" method="post" id="add-user-submit" enctype="multipart/form-data"
                      novalidate>
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <label for="exampleFormControlInput2">Tên tài khoản</label>
                            <input type="text" name="name" value="{{old('name')}}" class="form-control name" id=""
                                   placeholder="">
                        </div>
                        <div class="col-md-6">
                            <label for="exampleFormControlInput2">Email</label>
                            <input type="email" name="email" value="{{old('email')}}" class="form-control email" id=""
                                   placeholder="">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="exampleFormControlInput2">Phone</label>
                            <input type="text" name="phone_number" value="{{old('phone_number')}}"
                                   class="form-control" id="" placeholder="">
                        </div>
                        <div class="col-md-6">
                            <label>Password</label>
                            <input type="password" class="form-control password" placeholder="" name="password">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Avatar</label>
                            <div class="upload">
                                <input type="file" name="avatar" id="input-file-max-fs logo " class="dropify "
                                       data-default-file="" data-max-file-size="2M"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>Role</label>
                            <select class="form-control role basic" name="role">
                                @foreach(config('common.users') as $u => $item)
                                    <option @if(old('role')==$u) selected @endif value="{{$u}}">{{$item}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <br>
                    <!-- <div class="d-flex justify-content-center"> -->
                    <div>
                        <button type="submit" class=" mb-4 btn btn-primary btn-submit">Thêm mới</button>
                        <a href="{{route('users.index')}}" class=" mb-4 mx-2 btn btn-warning">Quay lại</a>
                    </div>
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
        $('#add-user-submit').validate({
            rules: {
                name: {
                    required: true
                },
                email: {
                    required: true,
                    remote: {
                        url: "{{route('check.email')}}",
                        type: "post",
                        data: {
                            "_token": "{{ csrf_token() }}",
                        }
                    },
                    email: true,
                },
                phone_number: {
                    required: true,
                    number: true
                },
                avatar: {
                    required: true,
                },
                password: {
                    required: true,
                    rangelength: [8, 100]
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

                password: {
                    required: "Yêu cầu bắt buộc",
                    rangelength: "Mật khẩu chứa 8 kí tự"
                },
                avatar: {
                    required: "Yêu cầu bắt buộc",
                },
                email: {
                    required: "Yêu cầu bắt buộc ",
                    email: "Vui lòng nhập đúng định dạng email",
                    regex: "Vui lòng nhập đúng định dạng email",
                    remote: "Email đã tồn tại",
                },

            },
            submitHandler: function (form) {
                $('.btn-submit').attr('disabled', true).css('cursor', 'not-allowed');
                $("body").addClass("loading");
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
            }
        );
    </script>
@endsection