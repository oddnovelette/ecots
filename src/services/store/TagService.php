<?php
namespace src\services\Store;

use src\models\Store\Tag;
use src\forms\Store\TagForm;

/**
 * Class TagService
 * @package src\services\Store
 */
class TagService
{
    /**
     * @param TagForm $form
     * @return Tag
     * @throws \RuntimeException
     */
    public function create(TagForm $form) : Tag
    {
        $tag = Tag::create($form->name, $form->slug);
        if (!$tag->save()) {
            throw new \RuntimeException('Store tag saving error occured.');
        }
        return $tag;
    }

    /**
     * @param int $id
     * @param TagForm $form
     * @return void
     * @throws \RuntimeException
     */
    public function edit(int $id, TagForm $form) : void
    {
        if (!$tag = Tag::findOne($id)) {
            throw new \RuntimeException('Store tag is not found.');
        }

        $tag->edit($form->name, $form->slug);
        if (!$tag->save()) {
            throw new \RuntimeException('Store tag saving error occured.');
        }
        return;
    }

    /**
     * @param int $id
     * @return void
     * @throws \RuntimeException
     */
    public function remove(int $id) : void
    {
        if (!$tag = Tag::findOne($id)) {
            throw new \RuntimeException('Store tag is not found.');
        }
        if (!$tag->delete()) {
            throw new \RuntimeException('Store tag removing error occured.');
        }
    }
}