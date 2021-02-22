<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreMarketingAdRequest;
use App\Http\Requests\UpdateMarketingAdRequest;
use App\Http\Resources\Admin\MarketingAdResource;
use App\Models\MarketingAd;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MarketingAdsApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('marketing_ad_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MarketingAdResource(MarketingAd::all());
    }

    public function store(StoreMarketingAdRequest $request)
    {
        $marketingAd = MarketingAd::create($request->all());

        if ($request->input('ad_design', false)) {
            $marketingAd->addMedia(storage_path('tmp/uploads/' . $request->input('ad_design')))->toMediaCollection('ad_design');
        }

        return (new MarketingAdResource($marketingAd))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(MarketingAd $marketingAd)
    {
        abort_if(Gate::denies('marketing_ad_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MarketingAdResource($marketingAd);
    }

    public function update(UpdateMarketingAdRequest $request, MarketingAd $marketingAd)
    {
        $marketingAd->update($request->all());

        if ($request->input('ad_design', false)) {
            if (!$marketingAd->ad_design || $request->input('ad_design') !== $marketingAd->ad_design->file_name) {
                if ($marketingAd->ad_design) {
                    $marketingAd->ad_design->delete();
                }

                $marketingAd->addMedia(storage_path('tmp/uploads/' . $request->input('ad_design')))->toMediaCollection('ad_design');
            }
        } elseif ($marketingAd->ad_design) {
            $marketingAd->ad_design->delete();
        }

        return (new MarketingAdResource($marketingAd))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(MarketingAd $marketingAd)
    {
        abort_if(Gate::denies('marketing_ad_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $marketingAd->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
