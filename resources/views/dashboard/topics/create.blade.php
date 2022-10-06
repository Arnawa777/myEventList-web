{{-- ambil dari halaman layouts/main --}}
@extends('dashboard.layouts.main')


@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-3 border-bottom"
     style="padding: 30px 0px 20px 0px">
    <h2>Create New Topic</h2>
</div>

<div class="col-lg-8">
    {{-- otomatis ke store karena menggunakan resource --}}
    <form method="post" action="/dashboard/topics" enctype="multipart/form-data">
        @csrf
        
        {{-- Topic --}}
        <div class="mb-3">
            <label for="topic" class="form-label">Topic</label>
            <select class="form-select" name="topic" value="{{ old('topic')}}">
                @if (old('topic'))
                    <option value="">Select Topic</option>
                    <option {{ old('topic') == 'MyEventList' ? 'selected' : '' }}  value="MyEventList">MyEventList</option>
                    <option {{ old('topic') == 'Event' ? 'selected' : '' }}  value="Event">Event</option>
                    <option {{ old('topic') == 'General' ? 'selected' : '' }}  value="General">General</option>
                @else
                    <option value="">Select Topic</option>
                    <option value="MyEventList">MyEventList</option>
                    <option value="Event">Event</option>
                    <option value="General">General</option>
                @endif
            </select>
            @error('topic')
               <div style="color: red">
                   {{ $message }}
               </div>
           @enderror
        </div>

        <div class="mb-3">
          <label for="sub_topic" class="form-label">Sub Topic Name</label>
          <input type="text" class="form-control @error('sub_topic') is-invalid @enderror" 
           id="sub_topic" name="sub_topic" value="{{ old('sub_topic') }}" autofocus>
           @error('sub_topic')
               <div style="color: red">
                   {{ $message }}
               </div>
           @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <input type="text" class="form-control @error('description') is-invalid @enderror" 
             id="description" name="description" value="{{ old('description') }}">
             @error('description')
                 <div style="color: red">
                     {{ $message }}
                 </div>
             @enderror
        </div>
        
        {{-- Button Action --}}
        <div class="footer-submit-right">
            <button name="action" value="cancel" id="btn-cancel">Cancel</button>
            <button type="submit" name="action" value="create" id="btn-reply"><i class="fa-regular fa-pen-to-square"></i> Submit</button>
        </div> 
    </form>
</div>

@endsection