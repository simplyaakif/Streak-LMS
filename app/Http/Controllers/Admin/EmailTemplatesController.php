<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyEmailTemplateRequest;
use App\Http\Requests\StoreEmailTemplateRequest;
use App\Http\Requests\UpdateEmailTemplateRequest;
use App\Models\EmailTemplate;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class EmailTemplatesController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('email_template_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $emailTemplates = EmailTemplate::all();

        return view('admin.emailTemplates.index', compact('emailTemplates'));
    }

    public function create()
    {
        abort_if(Gate::denies('email_template_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.emailTemplates.create');
    }

    public function store(StoreEmailTemplateRequest $request)
    {
        $emailTemplate = EmailTemplate::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $emailTemplate->id]);
        }

        return redirect()->route('admin.email-templates.index');
    }

    public function edit(EmailTemplate $emailTemplate)
    {
        abort_if(Gate::denies('email_template_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.emailTemplates.edit', compact('emailTemplate'));
    }

    public function update(UpdateEmailTemplateRequest $request, EmailTemplate $emailTemplate)
    {
        $emailTemplate->update($request->all());

        return redirect()->route('admin.email-templates.index');
    }

    public function show(EmailTemplate $emailTemplate)
    {
        abort_if(Gate::denies('email_template_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.emailTemplates.show', compact('emailTemplate'));
    }

    public function destroy(EmailTemplate $emailTemplate)
    {
        abort_if(Gate::denies('email_template_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $emailTemplate->delete();

        return back();
    }

    public function massDestroy(MassDestroyEmailTemplateRequest $request)
    {
        EmailTemplate::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('email_template_create') && Gate::denies('email_template_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new EmailTemplate();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
