$(document).on('click', '.user-avatar-component', function(e) {
    e.preventDefault();
    const userId = $(this).data('userid');

    $.ajax({
        url: '/user-preview/' + userId,
        method: 'GET',
        success: function(response) {
            $('#previewAvatar').attr('src', response.user_image);
            $('#previewUsername').text(response.username);
            $('#previewJoinDate').text(response.joined_at);
            $('#previewCityUniv').text(response.university);
            $('#previewCommentCount').text(response.user_comments_count);

            $('#userPreviewModal').modal('show');
        },
        error: function() {
            alert("Kullanıcı bilgisi alınamadı.");
        }
    });
});


/**
 * Dinamik kullanıcı avatarı HTML'sini döner.
 *
 * @param {Object} user Kullanıcı nesnesi
 * @param {number} user.id
 * @param {string} user.username
 * @param {string|null} user.user_image
 * @returns {string} Avatar HTML'i
 */
function renderUserAvatar(user) {
    console.log('renderUserAvatar', user.username);
    const username = user.username || 'Anonim';
    const imageName = user.user_image || null;

    const imagePath = imageName
        ? `/storage/profile_images/${imageName}`
        : `/assets/images/icons/user.png`;

    let bgColor = 'transparent';

    if (imageName === 'man.png') bgColor = '#95bdff';
    else if (imageName === 'woman.png') bgColor = '#ffbdd3';

    return `
        <a href="javascript:void(0);" class="avatar user-avatar-component" data-userid="${user.user_id}">
            <img class="avatar"
                 style="background-color: ${bgColor}; width: 40px; height: 40px; border-radius: 50%;"
                 src="${imagePath}"
                 data-default="/img/default-profile-picture-light.svg"
                 alt="${username}"
                 title="${username}">
        </a>
    `;
}
