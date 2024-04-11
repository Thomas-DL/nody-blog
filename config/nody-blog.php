<?php

// config for Nody/NodyBlog
return [

    /**
     * The model to use for the user relationship on the Post model.
     *
     * This is useful if you have a custom User model that you want to use for the relationship.
     */
    'user_model' => App\Models\User::class,

    /**
     * Configure parameters for GetPosts component
     *
     * posts_per_page: The number of posts to show per page
     * load_more: Whether to show a load more button or not
     */
    'posts_per_page' => 9,
    'load_more' => true,
    'searchbar' => true,

];
