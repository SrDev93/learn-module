@extends('layouts.admin')

@push('stylesheets')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css"/>
@endpush

@section('content')
    <!-- CONTAINER -->
    <div class="main-container container-fluid">
        <!-- PAGE-HEADER -->
    @include('learn::partial.header')
    <!-- PAGE-HEADER END -->

        <!-- ROW -->
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h3 class="card-title">{{ __('learn::custom.learn_edit') }}</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('learn.update', $learn->id) }}" method="post" enctype="multipart/form-data" class="row g-3 needs-validation" novalidate>
                            <div class="col-md-6">
                                <label for="title" class="form-label">عنوان</label>
                                <input type="text" name="title" class="form-control" id="title" required value="{{ $learn->title }}">
                                <div class="invalid-feedback">لطفا عنوان را وارد کنید</div>
                            </div>
                            <div class="col-md-6">
                                <label for="slug" class="form-label">نامک</label>
                                <input type="text" name="slug" class="form-control" id="slug" required value="{{ $learn->slug }}">
                                <div class="invalid-feedback">لطفا نامک را وارد کنید</div>
                            </div>
                            <div class="col-md-12">
                                <label for="short_text" class="form-label">متن کوتاه</label>
                                <textarea name="short_text" class="form-control" id="short_text" required rows="2">{{ $learn->short_text }}</textarea>
                                <div class="invalid-feedback">لطفا متن کوتاه را وارد کنید</div>
                            </div>
                            <div class="col-md-12">
                                <label for="type" class="form-label">نوع آموزش</label>
                                <select name="type" class="form-control" required>
                                    <option value="text" @if($learn->type == 'text') selected @endif>متنی</option>
                                    <option value="video" @if($learn->type == 'video') selected @endif>ویدئو</option>
                                </select>
                                <div class="invalid-feedback">لطفا نوع آموزش را انتخاب کنید</div>
                            </div>
                            <div class="col-md-12">
                                <label for="body" class="form-label">متن کامل</label>
                                <textarea id="editor1" name="body" class="cke_rtl">{{ $learn->body }}</textarea>
                            </div>

                            <div class="col-md-5">
                                <label for="image" class="form-label">تصویر شاخص</label>
                                <input type="file" name="image" class="form-control" aria-label="تصویر شاخص" id="image" accept="image/*" @if(!$learn->image) required @endif>
                                <div class="invalid-feedback">لطفا یک تصویر انتخاب کنید</div>
                            </div>
                            <div class="col-md-1" style="padding-top: 30px;">
                                @if($learn->image)
                                    <a href="{{ url($learn->image) }}" data-fancybox><img src="{{ url($learn->image) }}" style="max-width: 50%"></a>
                                @endif
                            </div>
                            <div class="col-md-5">
                                <label for="video" class="form-label">ویدئو آموزش</label>
                                <input type="file" name="video" class="form-control" aria-label="ویدئو آموزش" id="video" accept="video/*">
                                <div class="invalid-feedback">لطفا ویدئو آموزش را بارگزاری نمایید</div>
                            </div>
                            <div class="col-md-1" style="padding-top: 30px;">
                                @if($learn->video)
                                    <a href="{{ url($learn->video) }}" data-fancybox class="btn btn-primary">مشاهده</a>
                                @endif
                            </div>


                            <div class="col-12">
                                <button class="btn btn-primary" type="submit">{{ __('learn::custom.form_submit') }}</button>
                                @csrf
                                @method('PATCH')
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- ROW CLOSED -->


    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
        @include('ckfinder::setup')
        <script>
            var editor = CKEDITOR.replace('editor1', {
                // Define the toolbar groups as it is a more accessible solution.
                toolbarGroups: [
                    {
                        "name": "basicstyles",
                        "groups": ["basicstyles"]
                    },
                    {
                        "name": "links",
                        "groups": ["links"]
                    },
                    {
                        "name": "paragraph",
                        "groups": ["list", "blocks"]
                    },
                    {
                        "name": "document",
                        "groups": ["mode"]
                    },
                    {
                        "name": "insert",
                        "groups": ["insert"]
                    },
                    {
                        "name": "styles",
                        "groups": ["styles"]
                    },
                    {
                        "name": "about",
                        "groups": ["about"]
                    },
                    {   "name": 'paragraph',
                        "groups": ['list', 'blocks', 'align', 'bidi']
                    }
                ],
                // Remove the redundant buttons from toolbar groups defined above.
                removeButtons: 'Underline,Strike,Subscript,Superscript,Anchor,Styles,Specialchar,PasteFromWord'
            });
            CKFinder.setupCKEditor( editor );
        </script>

    @endpush
@endsection
