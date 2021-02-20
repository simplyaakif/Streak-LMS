@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.recovery.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.recoveries.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.recovery.fields.id') }}
                        </th>
                        <td>
                            {{ $recovery->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.recovery.fields.student') }}
                        </th>
                        <td>
                            {{ $recovery->student->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.recovery.fields.batch') }}
                        </th>
                        <td>
                            {{ $recovery->batch->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.recovery.fields.amount') }}
                        </th>
                        <td>
                            {{ $recovery->amount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.recovery.fields.is_paid') }}
                        </th>
                        <td>
                            {{ App\Models\Recovery::IS_PAID_RADIO[$recovery->is_paid] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.recovery.fields.paid_on') }}
                        </th>
                        <td>
                            {{ $recovery->paid_on }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.recovery.fields.payment_type') }}
                        </th>
                        <td>
                            {{ $recovery->payment_type->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.recovery.fields.reference_number') }}
                        </th>
                        <td>
                            {{ $recovery->reference_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.recovery.fields.comments') }}
                        </th>
                        <td>
                            {{ $recovery->comments }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.recoveries.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection