<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyMarketingAdRequest;
use App\Http\Requests\StoreMarketingAdRequest;
use App\Http\Requests\UpdateMarketingAdRequest;
use App\Models\MarketingAd;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class MarketingAdsController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('marketing_ad_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $marketingAds = MarketingAd::with(['media'])->get();

        return view('admin.marketingAds.index', compact('marketingAds'));
    }

    public function create()
    {
        abort_if(Gate::denies('marketing_ad_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.marketingAds.create');
    }

    public function store(StoreMarketingAdRequest $request)
    {
        $marketingAd = MarketingAd::create($request->all());

        if ($request->input('ad_design', false)) {
            $marketingAd->addMedia(storage_path('tmp/uploads/' . $request->input('ad_design')))->toMediaCollection('ad_design');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $marketingAd->id]);
        }

        return redirect()->route('admin.marketing-ads.index');
    }

    public function edit(MarketingAd $marketingAd)
    {
        abort_if(Gate::denies('marketing_ad_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.marketingAds.edit', compact('marketingAd'));
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

        return redirect()->route('admin.marketing-ads.index');
    }

    public function show(MarketingAd $marketingAd)
    {
        abort_if(Gate::denies('marketing_ad_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.marketingAds.show', compact('marketingAd'));
    }

    public function destroy(MarketingAd $marketingAd)
    {
        abort_if(Gate::denies('marketing_ad_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $marketingAd->delete();

        return back();
    }

    public function massDestroy(MassDestroyMarketingAdRequest $request)
    {
        MarketingAd::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('marketing_ad_create') && Gate::denies('marketing_ad_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new MarketingAd();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
