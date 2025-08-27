@extends('master')
@section('title', 'فريلانقو | الملف الشخصي')
@section('content')
    <div class="profile-layout">
        {{-- <div class="modal fade" id="edit-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                         <form class="form_edit" id="form_edit" enctype="multipart/form-data"
                        action="{{ route('web.profile.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" id="id" value="{{ $user->id }}" class="form-control">

                        <div class="mb-2 form-group">
                            <label class="form-label">@lang(' الاسم الكامل')</label>
                            <input id="edit_name" placeholder="@lang('الاسم الكامل')" name="fullname" class="form-control"
                                type="text" value="{{ $user->fullname }}">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-2 form-group">
                            <label class="form-label">@lang(' اسم المستخدم ')</label>
                            <input id="edit_username" placeholder="@lang('اسم المستخدم')" name="username" class="form-control"
                                type="text" value="{{ $user->username }}">
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="mb-2 form-group">
                            <label class="form-label">@lang(' البريد الالكتروني ')</label>
                            <input id="edit_email" placeholder="@lang('البريد الالكتروني ')" name="email" class="form-control"
                                type="text" value="{{ $user->email }}">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-2 form-group">
                            <label class="form-label">@lang('الدولة')</label>
                            <select id="edit_country" name="country" class="form-control">
                                <option selected disabled> اختر الدولة </option>
                                @foreach ($countries as $c)
                                    <option {{ $c->id == $user->country_id ? 'selected' : '' }} value="{{ $c->id }}">{{ $c->name_ar }} | "{{ $c->code }}"
                                    </option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="mb-2 form-group">
                            <label class="form-label">@lang('رقم الهاتف ')<span> "بدون مقدمة الدولة"</span></label>
                            <input id="edit_phone" placeholder="@lang(' رقم الهاتف ')" name="phone" class="form-control" value="{{ $user->phone }}">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-2 form-group">
                            <label class="form-label">@lang('النبذة الشخصية  ')</label>
                            <textarea id="edit_bio" placeholder="@lang('النبذة الشخصية  ')" name="bio" class="form-control">{{ $user->bio }}</textarea>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="modal-footer d-flex justify-content-end">
                            <button type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal">@lang('اغلاق')</button>
                            <button type="submit" style="background-color: #7212df"
                                class="btn text-white">@lang('تعديل')</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div> --}}


        @include('web.part.side')


    </div>
@stop