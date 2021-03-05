@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.query.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.queries.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.query.fields.id') }}
                        </th>
                        <td>
                            {{ $query->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.query.fields.name') }}
                        </th>
                        <td>
                            {{ $query->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.query.fields.mobile_number') }}
                        </th>
                        <td>
                            {{ $query->mobile_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.query.fields.email') }}
                        </th>
                        <td>
                            {{ $query->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.query.fields.courses') }}
                        </th>
                        <td>
                            @foreach($query->courses as $key => $courses)
                                <span class="label label-info">{{ $courses->title }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.query.fields.dealt_by') }}
                        </th>
                        <td>
                            {{ $query->dealt_by->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.query.fields.address') }}
                        </th>
                        <td>
                            {{ $query->address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.query.fields.comments_remarks') }}
                        </th>
                        <td>
                            {{ $query->comments_remarks }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.query.fields.interaction_type') }}
                        </th>
                        <td>
                            {{ $query->interaction_type->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.query.fields.status') }}
                        </th>
                        <td>
                            {{ $query->status->title ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.queries.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection