<?php

namespace Phpmvc\Comment;

/**
 * To attach comments-flow to a page or some content.
 *
 */
class CommentsInSession implements \Anax\DI\IInjectionAware
{
    use \Anax\DI\TInjectable;



    /**
     * Add a new comment.
     *
     * @param array $comment with all details.
     *
     * @return void
     */
    public function add($comment, $pageid)
    {
        $comments = $this->session->get('comments', []);
        $comments[$pageid][] = $comment;
        $this->session->set('comments', $comments);
    }

    /**
     * Find and return all comments.
     *
     * @return array with all comments.
     */
    public function findAll($pageid)
    {
     $comments = $this->session->get('comments', []);
        if(array_key_exists($pageid, $comments)){
            return $comments[$pageid];
        }else{
            return "No comments found.";
        }

    }
 public function edit($comment, $pageid, $id)
    {
        $comments = $this->session->get('comments', []);
        $comments[$pageid][$id] = $comment;
        $this->session->set('comments', $comments);
    }


    /**
     * Delete all comments.
     *
     * @return void
     */
    public function deleteAll($pageid)
    {
        $comments = $this->session->get('comments', []);
         unset($comments[$pageid]);
         $this->session->set('comments', $comments);
    }

    public function deleteOne($id, $pageid)
    {
         $comments = $this->session->get('comments', []);
         unset($comments[$pageid][$id]);
         $this->session->set('comments', $comments);
    }
}
