<?php
namespace src\models\Blog;

use src\models\User;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * Class Comment
 * @package src\models\Blog
 *
 * @property int $id
 * @property int $created_at
 * @property int $post_id
 * @property int $user_id
 * @property int $parent_id
 * @property string $text
 * @property bool $active
 *
 * @property Post $post
 */
class Comment extends ActiveRecord
{
    public static function create($userId, $parentId, $text) : self
    {
        $review = new self();
        $review->user_id = $userId;
        $review->parent_id = $parentId;
        $review->text = $text;
        $review->created_at = time();
        $review->active = true;
        return $review;
    }

    public function edit($parentId, $text) : void
    {
        $this->parent_id = $parentId;
        $this->text = $text;
    }

    public function activate() : void
    {
        $this->active = true;
    }

    public function draft() : void
    {
        $this->active = false;
    }

    public function isActive() : bool
    {
        return $this->active == true;
    }

    public function isIdEqualTo($id) : bool
    {
        return $this->id == $id;
    }

    public function isChildOf($id) : bool
    {
        return $this->parent_id == $id;
    }

    public function getPost() : ActiveQuery
    {
        return $this->hasOne(Post::class, ['id' => 'post_id']);
    }

    public function isAuthor() : bool
    {
        $author_id = Post::findOne([$this->user_id, 'user_id'])->user_id;
        if ($this->user_id === $author_id) {
            return true;
        } else {
            return false;
        }
    }

    public function getUser() : ?User
    {
        return User::findOne([$this->user_id, 'id']);
    }

    public static function tableName() : string
    {
        return '{{%blog_comments}}';
    }
}
