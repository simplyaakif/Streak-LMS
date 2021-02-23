@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.emailTemplate.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.email-templates.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.emailTemplate.fields.id') }}
                        </th>
                        <td>
                            {{ $emailTemplate->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.emailTemplate.fields.title') }}
                        </th>
                        <td>
                            {{ $emailTemplate->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.emailTemplate.fields.email_message') }}
                        </th>
                        <td>
                            {!! $emailTemplate->email_message !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.emailTemplate.fields.active') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $emailTemplate->active ? 'checked' : '' }}>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.email-templates.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection