@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            <h4>{{$batch->title}}</h4>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                <tr>
                    <td>Sr. No.</td>
                    <td>Name</td>
                    <td>Start Date</td>
                    <td>End Date</td>
                    <td>View</td>
                </tr>
                </thead>
                <tbody>
                @foreach($batch_students as $batch_student)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$batch_student->student->name}}</td>
                        <td>{{$batch_student->session_start_date}}</td>
                        <td>{{$batch_student->session_end_date}}</td>
                        <td><a href="{{route('admin.students.show',['student'=>$batch_student->student])}}">View</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>


@endsection
