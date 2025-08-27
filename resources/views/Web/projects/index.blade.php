@extends('master')
@section('title' , 'فريلانقو | البروفيل')
@section('content')
<div class="profile-layout">
    @include('web.parts.side')
    <div class="row">
        <div class="col-12 col-lg-12 col-xl-12 d-flex">
            <div class="card radius-10 w-100">
                <div class="card-header bg-transparent">
                    <div class="row g-3 align-items-center">
                        <div class="col">
                            <h5 class="mb-0">@lang('البروفيل')</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="profile-content">
                        {{-- هنا يمكنك عرض بيانات البروفيل --}}
                        <div class="row">
                            <div class="col-md-4">
                                <strong>@lang('الاسم الكامل'):</strong>
                            </div>
                            <div class="col-md-8">
                                {{ Auth::user()->name }}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-4">
                                <strong>@lang('البريد الإلكتروني'):</strong>
                            </div>
                            <div class="col-md-8">
                                {{ Auth::user()->email }}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-4">
                                <strong>@lang('نبذة عني'):</strong>
                            </div>
                            <div class="col-md-8">
                                {{ Auth::user()->bio ?? 'لا يوجد' }}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-4">
                                <strong>@lang('رقم الهاتف'):</strong>
                            </div>
                            <div class="col-md-8">
                                {{ Auth::user()->phone ?? 'لا يوجد' }}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-4">
                                <strong>@lang('البلد'):</strong>
                            </div>
                            <div class="col-md-8">
                                {{ Auth::user()->country ?? 'لا يوجد' }}
                            </div>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-end">
                            <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#edit-profile-modal">
                                @lang('تعديل البروفيل')
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="edit-profile-modal" tabindex="-1" aria-labelledby="edit-profile-modal-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit-profile-modal-label">@lang('تعديل البروفيل')</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form_edit_profile" action="{{ route('web.profile.update') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="edit_name" class="form-label">@lang('الاسم الكامل')</label>
                        <input type="text" class="form-control" id="edit_name" name="name" value="{{ Auth::user()->name }}">
                    </div>
                    <div class="mb-3">
                        <label for="edit_email" class="form-label">@lang('البريد الإلكتروني')</label>
                        <input type="email" class="form-control" id="edit_email" name="email" value="{{ Auth::user()->email }}">
                    </div>
                    <div class="mb-3">
                        <label for="edit_bio" class="form-label">@lang('نبذة عني')</label>
                        <textarea class="form-control" id="edit_bio" name="bio">{{ Auth::user()->bio }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="edit_phone" class="form-label">@lang('رقم الهاتف')</label>
                        <input type="text" class="form-control" id="edit_phone" name="phone" value="{{ Auth::user()->phone }}">
                    </div>
                    <div class="mb-3">
                        <label for="edit_country" class="form-label">@lang('البلد')</label>
                        <input type="text" class="form-control" id="edit_country" name="country" value="{{ Auth::user()->country }}">
                    </div>
                    <div class="modal-footer d-flex justify-content-end">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('إغلاق')</button>
                        <button type="submit" class="btn text-white" style="background-color: #7212df">@lang('حفظ التغييرات')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop

@section('js')
<script>
    $(document).ready(function() {
        $('#form_edit_profile').submit(function(e) {
            e.preventDefault();
            var form = $(this);
            var url = form.attr('action');
            var formData = form.serialize();

            $.ajax({
                type: 'POST',
                url: url,
                data: formData,
                success: function(response) {
                    if (response.success) {
                        alert(response.message);
                        $('#edit-profile-modal').modal('hide');
                        // Reload the page or update the profile info dynamically
                        location.reload(); 
                    } else {
                        alert(response.message);
                    }
                },
                error: function(xhr) {
                    var errors = xhr.responseJSON.errors;
                    var errorMessage = '';
                    $.each(errors, function(key, value) {
                        errorMessage += value + '\n';
                    });
                    alert(errorMessage);
                }
            });
        });
    });
</script>
@stop