<?php

namespace App\Http\Controllers;

use App\Http\Requests\Pages\GetRequest;
use App\Http\Requests\Pages\SaveRequest;
use App\Models\Page;
use App\Services\CommonService;
use App\Services\PagesService;
use App\Services\UploadService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function __construct(protected PagesService $service)
    {
        parent::__construct();
    }

    /**
     * @param SaveRequest $request
     * @return JsonResponse
     */
    public function save(SaveRequest $request): JsonResponse
    {
        try {
            $data = $request->validated();
            if ($request->hasFile('new_og_image')) {
                $data['uploaded_og_image'] = UploadService::save(
                    $request->file('new_og_image'),
                    'pages/images'
                );
            }

            if ($request->hasFile('block1_image')) {
                $data['uploaded_block1_image'] = UploadService::save(
                    $request->file('block1_image'),
                    'pages/images'
                );
            }

            if ($request->hasFile('block2_image')) {
                $data['uploaded_block2_image'] = UploadService::save(
                    $request->file('block2_image'),
                    'pages/images'
                );
            }

            $this->service->save($data);
            $this->success('Səhifə yadda saxlandı');
        } catch (\Exception $e) {
            $this->errorWithLog($e->getMessage());
        }

        return $this->response();
    }


    /**
     * @param GetRequest $request
     * @return JsonResponse
     */
    public function get(GetRequest $request): JsonResponse
    {
        $page = $this->service->getForUpdate($request->id);

        return response()->json([
            'page' => $page
        ]);
    }

    /**
     * @param GetRequest $request
     * @return JsonResponse
     */
    public function delete(GetRequest $request): JsonResponse
    {
        try {
            $page = Page::find($request->id);
            $page->delete();
            $this->success('Səhifə silindi');
        } catch (\Exception $e) {
            $this->errorWithLog($e->getMessage());
        }

        return $this->response();
    }

    /**
     * @return JsonResponse
     */
    public function getForSlides(): JsonResponse
    {
        $pages = Page::select('id', 'list_title')->get();
        return response()->json(['pages' => $pages]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getBySlug(Request $request): JsonResponse
    {
        $page = Page::where('slug', $request->slug)->first();
        if (!empty($page)) {
            $page->views++;
            $page->save();
        }
        return response()->json(['page' => $page]);
    }
}
