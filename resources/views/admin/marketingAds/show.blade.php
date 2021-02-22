@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.marketingAd.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.marketing-ads.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.marketingAd.fields.id') }}
                        </th>
                        <td>
                            {{ $marketingAd->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.marketingAd.fields.title') }}
                        </th>
                        <td>
                            {{ $marketingAd->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.marketingAd.fields.ad') }}
                        </th>
                        <td>
                            {!! $marketingAd->ad !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.marketingAd.fields.publish_at') }}
                        </th>
                        <td>
                            {{ $marketingAd->publish_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.marketingAd.fields.valid_till') }}
                        </th>
                        <td>
                            {{ $marketingAd->valid_till }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.marketingAd.fields.ad_design') }}
                        </th>
                        <td>
                            @if($marketingAd->ad_design)
                                <a href="{{ $marketingAd->ad_design->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $marketingAd->ad_design->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.marketing-ads.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection