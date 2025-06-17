<?php

namespace App\Services;

use App\Models\Page;

class PagesService
{
    /**
     * @param array $data
     * @return void
     */
    public function save(array $data): void
    {
        $page = $data['is_create'] ? new Page() : Page::find($data['id']);
        $page->list_title = $data['list_title'];
        $page->page_title = $data['page_title'];
        $page->description = $data['description'];
        $page->slug = $data['slug'];
        $page->keywords = $data['keywords'];
        if (isset($data['uploaded_og_image'])) {
            $page->og_image = $data['uploaded_og_image'];
        }
        $block1 = [
            'title' => $data['block1_title'],
            'points' => $data['block1_points'],
        ];

        if (isset($data['uploaded_block1_image'])) {
            $block1['image'] = $data['uploaded_block1_image'];
        } else {
            $block1['image'] = $page->block1['image'];
        }

        $block2 = [
            'title' => $data['block2_title'],
            'points' => $data['block2_points'],
        ];

        if (isset($data['uploaded_block2_image'])) {
            $block2['image'] = $data['uploaded_block2_image'];
        } else {
            $block2['image'] = $page->block2['image'];
        }

        $page->block1 = $block1;
        $page->block2 = $block2;

        $page->save();
    }

    /**
     * @param int $id
     * @return Page
     */
    public function getForUpdate(int $id): Page
    {
        $page = Page::where('id', $id)->first();
        $page->old_og_image = $page->og_image;
        $page->og_image = CommonService::fileUrl($page->og_image);
        $block1 = $page->block1;
        $block2 = $page->block2;

        $block1['old_image'] = $block1['image'];
        $block2['old_image'] = $block2['image'];
        $block1['image'] = CommonService::fileUrl($block1['image']);
        $block2['image'] = CommonService::fileUrl($block2['image']);

        $page->block1 = $block1;
        $page->block2 = $block2;

        return $page;
    }
}
