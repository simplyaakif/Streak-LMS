@extends('layouts.admin')
@section('content')

    <div class="row">

    @foreach($batches as $k =>$batch)
            <div class="col-sm-6 col-md-3 ">
                <div class="card">
                    <div class="card-body">
                    {{$batch->title}}
                        <div class="text-sm">
                            <span>{{$batch->class_time}}</span>
                            <span></span>
                        </div>
                        <a href="{{ route('admin.batch-wise-students', $batch->id) }}"><i class="fas
                        fa-eye"></i></a>
                    </div>
                </div>
            </div>
    @endforeach

    </div>

@endsection
@section('scripts')
@endsection
