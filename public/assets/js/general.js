// Tüm AJAX isteklerine CSRF token'ı otomatik ekle
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


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

$(document).on('click', '.delete-topic', function (e) {
    e.preventDefault();

    const topicId = $(this).data('id');
    const topicType = $(this).data('type');

    Swal.fire({
        title: 'Emin misiniz?',
        text: "Bu yorumu silmek istiyor musunuz?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Evet, sil',
        cancelButtonText: 'Vazgeç'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '/topic-delete',
                method: 'GET',
                data: {
                    id: topicId,
                    type: topicType
                },
                success: function (response) {
                    if (response.success) {
                        Swal.fire({
                            title: 'Silindi!',
                            text: response.message,
                            icon: 'success',
                            confirmButtonText: 'Tamam',
                            customClass: {
                                confirmButton: 'btn btn-success'
                            }
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire('Hata!', response.message, 'error');
                    }
                },
                error: function () {
                    Swal.fire('Hata!', 'İşlem sırasında bir hata oluştu.', 'error');
                }
            });
        }
    });
});


$(document).on('click', '.copy-link', function (e) {
    e.preventDefault();

    const link = $(this).data('link');

    // Panoya kopyala
    navigator.clipboard.writeText(link).then(() => {
        toastr.success('Bağlantı panoya kopyalandı!', 'Başarılı', {
            timeOut: 3000,
            positionClass: 'toast-top-right'
        });
    }).catch(() => {
        toastr.error('Bağlantı kopyalanamadı!', 'Hata', {
            timeOut: 3000,
            positionClass: 'toast-top-right'
        });
    });
});

