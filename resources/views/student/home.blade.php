@extends('layouts.student')

@section('content')
    <div class="">
{{--        <x-student.dashProfile></x-student.dashProfile>--}}

        <!-- This example requires Tailwind CSS v2.0+ -->
        <div class="relative  pt-4 pb-20 px-4 sm:px-6 lg:pt-4 lg:pb-28 lg:px-8">
            <div class="absolute inset-0">
                <div class="h-1/3 sm:h-2/3"></div>
            </div>
            <div class="relative max-w-7xl mx-auto">
                <div class="text-left">
                    <h2 class="text-3xl mb-1 tracking-tight font-extrabold text-gray-900 sm:text-4xl">
                        Sessions
                    </h2>
                    <p class=" max-w-2xl text-lg text-gray-500 md:mt-0 sm:mt-4">
                        Currently Active Courses
                    </p>
                    <img src="{{}}" alt="">
                </div>
                <div class="mt-4 max-w-lg mx-auto grid gap-5 lg:grid-cols-4 lg:max-w-none">
                    <x-student.dashCourse></x-student.dashCourse>
                </div>
            </div>
        </div>

    </div>
@endsection
