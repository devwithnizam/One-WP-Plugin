jQuery(document).ready(function ($) {
    $('.one-wp-like-button').on('click', function (e) {
        e.preventDefault();
        var post_id = $(this).data('post-id');
        var user_id = $(this).data('user-id');

        if (!user_id) {
            alert('You must be logged in to vote.');
        } else {
            alert('Success!')
            $.ajax({
                url: one_wp_ajax_object.ajax_url,
                type: 'POST',
                data: {
                    action: 'one_wp_handle_vote',
                    post_id: post_id,
                    user_id: user_id,
                    vote_type: 'like'
                },
                success: function (response) {
                    if (response.success) {
                        alert(response.data.message);
                    } else {
                        alert('Error: ' + response.data.message);
                    }
                }
            })
        }
    });
    $('.one-wp-dislike-button').on('click', function (e) {
        e.preventDefault();
        var post_id = $(this).data('post-id');
        var user_id = $(this).data('user-id');

        if (!user_id) {
            alert('You must be logged in to vote.');
        } else {
            alert('Success!')
            $.ajax({
                url: one_wp_ajax_object.ajax_url,
                type: 'POST',
                data: {
                    action: 'one_wp_handle_vote',
                    post_id: post_id,
                    user_id: user_id,
                    vote_type: 'dislike'
                },
                success: function (response) {
                    if (response.success) {
                        alert(response.data.message);
                    } else {
                        alert('Error: ' + response.data.message);
                    }
                }
            })
        }
    });
});