<?php

use Illuminate\Support\Facades\Auth;
?>
@extends('client.company.layout.layout')
@section('title', 'Chi tiết đơn ứng tuyển')
@section('name', 'Chi tiết đơn ứng tuyển')
@section('main-content')
<style>
    .dropdown-menu>li>a{
        padding-right: 5px !important;
    }
</style>
<div class="dashboard-box margin-top-0">
    <div class="headline">
        @foreach($blog as $b)
        <h3>Đơn ứng tuyển: {{$b->title}}</h3>
        @endforeach
    </div>
    <div class="content">
        <ul class="utf-dashboard-box-list">
            @foreach($apply as $a)
            <li>
                <div class="utf-manage-resume-overview-aera utf-manage-candidate">
                    <div class="utf-manage-resume-overview-aera-inner">
                        <div class="utf-manage-resume-avatar">
                            <?php $id_candidate = \App\Models\UserCandidate::find($a->user_candidate_id)->id;
                            ?>
                            <a href="{{route('candidate', ['id'=>$id_candidate])}}"><img src="{{asset('storage/' . $a->usercandidate->avatar )}}" alt=""></a>
                        </div>
                        <div class="utf-manage-resume-item">
                            <h4><a href="{{route('candidate', ['id'=>$id_candidate])}}">{{$a->name_candidate}}</a><span class="dashboard-status-button ">
                                    <div class="select">
                                        <select id="action" data-id="{{$a->id}}">
                                            @foreach(config('common.apply_status') as $key => $val)
                                            <option @if($a->status == $key) selected @endif value="{{$key}}">{{$val}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </span></h4>
                            <span class="utf-manage-resume-detail-item" style=" margin-top: 10px !important;"><a href="#"><i class="icon-feather-mail"></i>{{$a->email_candidate}}</a></span>
                            <span class="utf-manage-resume-detail-item" style=" margin-top: 10px !important;"><i class="icon-feather-phone"></i> {{$a->phone_candidate}}</span>
                            <span class="utf-manage-resume-detail-item" style=" margin-top: 10px !important;"><i style="color: #40b660;" class="icon-material-outline-date-range"></i> {{ date("d-m-Y", strtotime($a->created_at))}}</span>

                            <div class="utf-buttons-to-right">
                                <a onclick="sendMail(<?= $a->id ?>, '<?= App\Models\UserRecruitment::find(Auth::user()->id)->name ?>')" href="javascript:void(0)" class="button ripple-effect" title="Gửi Mail" data-tippy-placement="top"><i class="icon-feather-mail"></i>Gửi Mail</a>
                                <a onclick="getDetail(<?= $a->id ?>)" href="#small-dialog" class="popup-with-zoom-anim button green ripple-effect ico" data-id="{{$a->id}}" href="#small-dialog" title="Ghi chú" data-tippy-placement="top"><i class="icon-material-outline-note-add"></i></a>
                                <a onclick="getMess(<?= $a->id ?>)" href="#small-dialog-1" class="popup-with-zoom-anim button red ripple-effect ico" title="Nội dung đơn ứng tuyển" data-tippy-placement="top"><i class="icon-feather-message-circle"></i></a>
                                <a href="{{asset('storage/' . $a->file)}}" target="_blank" class="button yellow ripple-effect ico" title="Xem file" data-tippy-placement="top"><i class="icon-feather-file-text"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
</div>
<!-- Pagination -->
<div class="clearfix"></div>
<div class="utf-pagination-container-aera margin-top-20 margin-bottom-0">
    <nav class="pagination">
        <ul>
            {{$apply-> links()}}
        </ul>
    </nav>
</div>
<div class="clearfix"></div>
</div>
</div>
<script>
    function getDetail(id) {
        $('#apply_id').val(id);
        $.ajax({
            url: '/api/ghi-chu/' + id,
            type: 'GET',
            data: {
                id: id
            },
            success: function(data) {
                $('#tab').html(data);
            }
        });
    }
    function getMess(id) {
        $.ajax({
            url: '/api/noi-dung-don/' + id,
            type: 'GET',
            success: function(data) {
                $('#tab-1').html(data);
            }
        });
    }

    function sendMail(apply_id, company) {
        alertify.success('Gửi thông báo thành công!');
        $.ajax({
            type: 'GET',
            url: '<?= asset('/') ?>' + 'api/gui-mail/' + apply_id + '/' + company
        })
    }
</script>

<script>
    $(document).ready(function() {
        $('select#action').change(function() {
            var act = $(this).val();
            var id = $(this).data('id');
            $.ajax({
                type: 'GET',
                url: "{{route('apply.update')}}",
                data: {
                    'id': id,
                    'act': act
                },
                success: function(data) {
                    alertify.success('Sửa trạng thái thành công !');
                },
                error: function(data) {
                    alertify.error('Sửa trạng thái thất bại !');
                },
            });

        });
    });
</script>
<!-- <script>
function load() {
    var id = $('#apply_id').val();
    $('#apply_id').val(id);
    $.ajax({
        url: '/api/ghi-chu/' + id,
        type: 'POST',
        data: {
            id: id
        },
        success: function(data) {
            console.log(data);
            $('#tab').html(data);
        }
    });

}

</script> -->



<div style="z-index: 10 !important;" id="small-dialog" class="zoom-anim-dialog mfp-hide dialog-with-tabs">
    <div class="utf-signin-form-part">
        <ul class="utf-popup-tabs-nav-item">
            <li class="modal-title">Ghi chú</li>
        </ul>
        <div class="utf-popup-container-part-tabs">
            <div class="utf-popup-tab-content-item" id="tab" style="padding:30px 20px; height:300px;
            overflow-x:hidden;
            overflow-y:auto; ">

            </div>
            <input type="hidden" id="apply_id" value="" style="">
            <div style="position: relative;">
                <div style="margin-top: 10px !important;  " class="utf-no-border">
                    <input style="    padding-right: 57px;" type="text" class="utf-with-border" name="name" id="name_note" placeholder="Ghi chú..." />
                </div>
                <button style="position: absolute; top:15px; right:30px" id="submit_add" type="submit"> <i class="icon-feather-send"></i></button>
            </div>
            </ul>
        </div>
    </div>
</div>

<div style="z-index: 10 !important;" id="small-dialog-1" class="zoom-anim-dialog mfp-hide dialog-with-tabs">
    <div class="utf-signin-form-part">
        <ul class="utf-popup-tabs-nav-item">
            <li class="modal-title">Nội dung đơn ứng tuyển</li>
        </ul>
        <div class="utf-popup-container-part-tabs">
            <div class="utf-popup-tab-content-item" id="tab-1" style="padding:30px 20px; height:300px;
            overflow-x:hidden;
            overflow-y:auto; ">
                {{$a->message}}
            </div>
        </div>
    </div>
</div>

<!-- <script>

    function getDetail(id) {
        function load() {

    }
    load();
}
</script> -->

<script>
    $(document).ready(function() {
        $('#submit_add').on('click', function() {
            var name = $('#name_note').val();
            var id = $('#apply_id').val();
            // alert(id);

            $.ajax({
                type: 'POST',
                url: "{{route('note')}}",
                data: 'apply_id=' + id + '&name=' + name,
                success: function(data) {
                    getDetail(id);
                    // alertify.success('Thêm ghi chú thành công !');
                },
                error: function(data) {
                    alertify.error('Thêm ghi chú thất bại !');
                },
            })

            $('#name_note').val("");
        })
    })
</script>

<script>
    function ConfirmDelete(id, apply_id) {
        $.ajax({
            type: "POST",
            url: "{{route('delete.listnote')}}",
            data: "note_id=" + id,
            success: function(data) {
                getDetail(apply_id);
                // alertify.success("Xóa ghi chú thành công !");
            }
        })

    }
</script>

@endsection
