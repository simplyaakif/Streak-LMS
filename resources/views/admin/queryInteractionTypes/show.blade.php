@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.queryInteractionType.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.query-interaction-types.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.queryInteractionType.fields.id') }}
                        </th>
                        <td>
                            {{ $queryInteractionType->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.queryInteractionType.fields.title') }}
                        </th>
                        <td>
                            {{ $queryInteractionType->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.queryInteractionType.fields.comment') }}
                        </th>
                        <td>
                            {{ $queryInteractionType->comment }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.query-interaction-types.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection