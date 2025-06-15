<div class="modal fade" id="userPreviewModal" tabindex="-1" aria-labelledby="userPreviewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content border-0 shadow rounded-4 overflow-hidden">
            <div class="modal-header bg-primary-color text-white py-3">
                <h5 class="modal-title d-flex align-items-center gap-2" id="userPreviewModalLabel">
                    <i class="fa-solid fa-user-circle"></i> Kullanıcı Profili
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Kapat"></button>
            </div>

            <div class="modal-body text-center bg-light">
                <div class="d-flex justify-content-center mb-3">
                    <img id="previewAvatar" class="rounded-circle shadow object-fit-cover" width="120" height="120" alt="Kullanıcı">
                </div>

                <h5 id="previewUsername" class="fw-bold mb-4 text-primary-color"></h5>

                <div class="row justify-content-center text-secondary mb-3">
                    <div class="col-auto">
                        <i class="fa-solid fa-calendar-alt me-1"></i> 
                        <small><strong>Katılım:</strong> <span id="previewJoinDate"></span></small>
                    </div>
                    <div class="col-auto">
                        <i class="fa-solid fa-school me-1"></i> 
                        <small><span id="previewCityUniv"></span></small>
                    </div>
                </div>

                <div class="row border-top border-bottom py-3 text-center">
                    <div class="col-6 border-end">
                        <div class="text-dark">
                            <i class="fa-solid fa-comments fa-lg text-primary-color mb-1"></i>
                            <p class="mb-0 fw-bold"><span id="previewCommentCount">0</span></p>
                            <small class="text-muted">Yorum</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-dark">
                            <i class="fa-solid fa-pen fa-lg text-primary-color mb-1"></i>
                            <p class="mb-0 fw-bold"><span id="previewTopicCount">0</span></p>
                            <small class="text-muted">Konu</small>
                        </div>
                    </div>
                </div>
            </div>

            {{-- <div class="modal-footer bg-white py-3">
                <button type="button" class="btn btn-outline-secondary w-100" data-bs-dismiss="modal">
                    Kapat
                </button>
            </div> --}}
        </div>
    </div>
</div>
