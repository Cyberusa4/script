(function($) {

    "use strict";

    document.querySelectorAll('[data-year]').forEach((el) => {
        el.textContent = " " + new Date().getFullYear();
    });

    let dropdown = document.querySelectorAll('[data-dropdown]'),
        dropdownv2 = document.querySelectorAll('[data-dropdown-v2]'),
        itemHeight = 45;

    if (dropdown !== null) {
        dropdown.forEach((el) => {
            let dropdownFunc = () => {
                let sideBarLinksMenu = el.querySelector('.vironeer-sidebar-link-menu');
                if (el.classList.contains('active')) {
                    sideBarLinksMenu.style.height = sideBarLinksMenu.children.length * itemHeight + 'px';
                } else {
                    sideBarLinksMenu.style.height = 0;
                }
            };

            el.querySelector('.vironeer-sidebar-link-title').onclick = () => {
                el.classList.toggle('active');
                dropdownFunc();
            };
            window.addEventListener('load', dropdownFunc);
        });
    }

    if (dropdownv2 !== null) {
        dropdownv2.forEach(function(el) {
            window.addEventListener('click', function(e) {
                if (el.contains(e.target)) {
                    el.classList.toggle('active');
                    setTimeout(function() {
                        el.classList.toggle('animated');
                    }, 0);
                } else {
                    el.classList.remove('active');
                    el.classList.remove('animated');
                }
            });
        });
    }

    let counterCards = document.querySelectorAll('.counter-card');
    let dashCountersOP = () => {
        counterCards.forEach((el) => {
            let itemWidth = 350,
                clientWidthX = el.clientWidth;
            if (clientWidthX > itemWidth) {
                el.classList.remove('active');
            } else {
                el.classList.add('active');
            }
        });
    };

    window.addEventListener('load', dashCountersOP);
    window.addEventListener('resize', dashCountersOP);

    let sideBar = document.querySelector('.vironeer-sidebar'),
        pageContent = document.querySelector('.vironeer-page-content'),
        sideBarIcon = document.querySelector('.vironeer-sibebar-icon');
    if (sideBar !== null) {
        sideBarIcon.onclick = () => {
            sideBar.classList.toggle('active');
            pageContent.classList.toggle('active');
            setTimeout(dashCountersOP, 150);

        };

        sideBar.querySelector('.overlay').onclick = () => {
            sideBar.classList.remove('active');
            pageContent.classList.remove('active');
        };

        window.addEventListener('resize', () => {
            if (window.innerWidth < 1200) {
                sideBar.classList.remove('active');
                pageContent.classList.remove('active');
            }
        });
    }

    let sidebarLinkCounter = document.querySelectorAll(".vironeer-sidebar-link-title .counter");
    if (sidebarLinkCounter) {
        sidebarLinkCounter.forEach((el) => {
            if (el.innerHTML == 0) {
                el.classList.add("disabled");
            }
        });
    }

    let navbarLinkCounter = document.querySelectorAll(".vironeer-notifications-title .counter");
    if (navbarLinkCounter) {
        navbarLinkCounter.forEach((el) => {
            if (el.innerHTML == 0) {
                el.classList.add("disabled");
            } else {
                el.classList.add("flashit");
            }
        });
    }

    if ($('#datatable').length) {
        $('#datatable').DataTable({
            "language": {
                searchPlaceholder: "Start typing to search...",
                search: "",
                sLengthMenu: "Rows per page _MENU_",
                info: "Showing page _PAGE_ of _PAGES_",
            },
            order: [
                [0, "desc"]
            ],
            "dom": '<"top"f><"table-wrapper"rt><"bottom"ilp><"clear">',
            drawCallback: function() {
                document.querySelector('.dataTables_wrapper .pagination').classList.add('pagination-sm');
                $('.dataTables_filter input').attr('type', 'text');
            }
        });
    }

    if ($('.datatable-50').length) {
        $('.datatable-50').DataTable({
            "pageLength": 50,
            "language": {
                searchPlaceholder: "Start typing to search...",
                search: "",
                sLengthMenu: "Rows per page _MENU_",
                info: "Showing page _PAGE_ of _PAGES_",
            },
            order: [
                [0, "desc"]
            ],
            "dom": '<"top"f><"table-wrapper"rt><"bottom"ilp><"clear">',
            drawCallback: function() {
                document.querySelector('.dataTables_wrapper .pagination').classList.add('pagination-sm');
                $('.dataTables_filter input').attr('type', 'text');
            }
        });
    }

    if ($('#datatable2').length) {
        $('#datatable2').DataTable({
            "language": {
                searchPlaceholder: "Start typing to search...",
                search: "",
                sLengthMenu: "Rows per page _MENU_",
                info: "Showing page _PAGE_ of _PAGES_",
            },
            order: [
                [0, "desc"]
            ],
            "dom": '<"top"f><"table-wrapper"rt><"bottom"ilp><"clear">',
            drawCallback: function() {
                document.querySelector('.dataTables_wrapper .pagination').classList.add('pagination-sm');
                $('.dataTables_filter input').attr('type', 'text');
            }
        });
    }

    if ($('#unsort-datatable').length) {
        $('#unsort-datatable').DataTable({
            "language": {
                searchPlaceholder: "Start typing to search...",
                search: "",
                sLengthMenu: "Rows per page _MENU_",
                info: "Showing page _PAGE_ of _PAGES_",
            },
            "dom": '<"top"f><"table-wrapper"rt><"bottom"ilp><"clear">',
            drawCallback: function() {
                document.querySelector('.dataTables_wrapper .pagination').classList.add('pagination-sm');
                $('.dataTables_filter input').attr('type', 'text');
            }
        });
    }

    if ($('#unsort-datatable-50').length) {
        $('#unsort-datatable-50').DataTable({
            "pageLength": 50,
            "language": {
                searchPlaceholder: "Start typing to search...",
                search: "",
                sLengthMenu: "Rows per page _MENU_",
                info: "Showing page _PAGE_ of _PAGES_",
            },
            "dom": '<"top"f><"table-wrapper"rt><"bottom"ilp><"clear">',
            drawCallback: function() {
                document.querySelector('.dataTables_wrapper .pagination').classList.add('pagination-sm');
                $('.dataTables_filter input').attr('type', 'text');
            }
        });
    }


    if ($('#content').length) {
        var $ckfield = CKEDITOR.replace('content', {
            height: 500,
        });
        $ckfield.on('change', function() {
            $ckfield.updateElement();
        });
    }

    if ($('#content-small').length) {
        var $ckfield = CKEDITOR.replace('content-small');
        $ckfield.on('change', function() {
            $ckfield.updateElement();
        });
    }

    if ($('.ckeditor').length) {
        $('.ckeditor').each(function() {
            CKEDITOR.replace($(this).prop('id'));
        });
    }


    let selectFileBtn = $('#selectFileBtn'),
        selectedFileInput = $("#selectedFileInput"),
        filePreviewBox = $('.file-preview-box'),
        filePreviewImg = $('#filePreview');

    selectFileBtn.on('click', function() {
        selectedFileInput.trigger('click');
    });

    selectedFileInput.on('change', function() {
        var file = true,
            readLogoURL;
        if (file) {
            readLogoURL = function(input_file) {
                if (input_file.files && input_file.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        filePreviewBox.removeClass('d-none');
                        filePreviewImg.attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input_file.files[0]);
                }
            }
        }
        readLogoURL(this);
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    let createSlug = $("#create_slug"),
        showSlug = $('#show_slug');

    createSlug.on('input', function() {
        $.ajax({
            type: 'GET',
            url: GET_SLUG_URL,
            data: {
                content: $(this).val(),
            },
            success: function(data) {
                showSlug.val(data.slug);
            }
        });
    });

    let articleLang = $('#articleLang'),
        articleCategory = $('#articleCategory');

    articleLang.on('change', function() {
        const langCode = $(this).val();
        if (langCode) {
            $.ajax({
                url: BASE_URL + '/blog/articles/categories/' + langCode,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    if ($.isEmptyObject(data.info)) {
                        articleCategory.empty();
                        $.each(data, function(key, value) {
                            articleCategory.append('<option value="' + key + '">' + value + '</option>');
                        });
                    } else {
                        articleCategory.empty();
                        articleCategory.append('<option value="" selected disabled>Choose</option>');
                        toastr.info(data.info);
                    }
                }
            });
        } else {
            articleCategory.empty();
        }
    });


    let ableToDeleteBtn = $('.vironeer-able-to-delete');
    ableToDeleteBtn.on('click', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'question',
            showCancelButton: true,
            allowOutsideClick: false,
            confirmButtonColor: PRIMARY_COLOR,
            confirmButtonText: 'Yes, delete it!',
        }).then((result) => {
            if (result.isConfirmed) {
                $(this).parents('form')[0].submit();
            }
        })
    });

    let confirmFormBtn = $('.vironeer-form-confirm');
    confirmFormBtn.on('click', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you really want do this action?",
            icon: 'question',
            showCancelButton: true,
            allowOutsideClick: false,
            confirmButtonColor: PRIMARY_COLOR,
            confirmButtonText: 'Yes, Do it!',
        }).then((result) => {
            if (result.isConfirmed) {
                $(this).parents('form')[0].submit();
            }
        })
    });

    let confirmActionLink = $('.vironeer-link-confirm');
    confirmActionLink.on('click', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you really want do this action?",
            icon: 'question',
            showCancelButton: true,
            allowOutsideClick: false,
            confirmButtonColor: PRIMARY_COLOR,
            confirmButtonText: 'Yes, Do it!',
        }).then((result) => {
            if (result.isConfirmed) {
                location.href = $(this).attr('href');
            }
        })
    });

    let SelectImagebButton = $('.vironeer-select-image-button');
    SelectImagebButton.on('click', function() {
        var dataId = $(this).data('id');
        let targetedImageInput = $('#vironeer-image-targeted-input-' + dataId),
            targetedImagePreview = $('#vironeer-preview-img-' + dataId);

        targetedImageInput.trigger('click');
        targetedImageInput.on('change', function() {
            var file = true,
                readLogoURL;
            if (file) {
                readLogoURL = function(input_file) {
                    if (input_file.files && input_file.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            targetedImagePreview.attr('src', e.target.result);
                        }
                        reader.readAsDataURL(input_file.files[0]);
                    }
                }
            }
            readLogoURL(this);
        });
    });


    let select2 = $(".select2");
    if (select2.length) {
        select2.select2({
            theme: "bootstrap-5",
            placeholder: "Choose",
        });
    }

    let select2Modal = $(".select2Modal"),
        addModal = $('#addModal');
    if (select2Modal.length) {
        select2Modal.select2({
            dropdownParent: addModal,
            theme: "bootstrap-5",
            placeholder: "Choose",
        });
    }

    let removeSpaces = $(".remove-spaces");
    removeSpaces.on('input', function() {
        $(this).val($(this).val().replace(/\s/g, ""));
    });

    if ($('#cssContent').length) {
        var element = document.getElementById("cssContent");
        var editor = CodeMirror.fromTextArea(element, {
            lineNumbers: true,
            mode: "text/css",
            theme: "monokai",
            keyMap: "sublime",
            autoCloseBrackets: true,
            matchBrackets: true,
            showCursorWhenSelecting: true,
        });
        editor.setSize(null, 700);
    }

    if ($('#jsContent').length) {
        var element = document.getElementById("jsContent");
        var editor = CodeMirror.fromTextArea(element, {
            lineNumbers: true,
            mode: "htmlmixed",
            theme: "monokai",
            keyMap: "sublime",
            autoCloseBrackets: true,
            matchBrackets: true,
            showCursorWhenSelecting: true,
        });
        editor.setSize(null, 400);
    }

    let logsBtn = $('.vironeer-getlog-btn'),
        logModal = $('#logModal');

    logsBtn.on('click', function(e) {
        e.preventDefault();
        const userID = $(this).data('user');
        const logID = $(this).data('log');
        $.ajax({
            url: BASE_URL + '/users/' + userID + '/edit/logs/get/' + logID,
            type: 'get',
            dataType: "JSON",
            success: function(response) {
                if ($.isEmptyObject(response.error)) {
                    $('#ip').attr('href', response.ip_link).html(response.ip);
                    $('#location').html(response.location);
                    $('#timezone').html(response.timezone);
                    $('#latitude').html(response.latitude);
                    $('#longitude').html(response.longitude);
                    $('#browser').html(response.browser);
                    $('#os').html(response.os);
                    logModal.modal('show');
                } else {
                    toastr.error(response.error);
                }
            },
        });
    });

    let changeUserAvatarInput = $('.vironeer-user-avatar'),
        changeUserAvatarForm = $('#changeUserAvatarForm'),
        changeUserAvatarError = $('.image-error-icon');

    changeUserAvatarInput.on('change', function(e) {
        e.preventDefault();
        const fileExtension = ['jpeg', 'jpg', 'png'];
        const userId = $(this).data('id');
        const formData = new FormData($(this).parents('form')[0]);
        if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
            toastr.error('File type not allowed');
        } else {
            $.ajax({
                url: BASE_URL + '/users/' + userId + '/edit/change/avatar',
                type: 'POST',
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                success: function(response) {
                    if ($.isEmptyObject(response.error)) {
                        changeUserAvatarError.addClass('d-none');
                        changeUserAvatarForm.trigger("reset");
                        toastr.success(response.success);
                    } else {
                        changeUserAvatarError.removeClass('d-none');
                        changeUserAvatarForm.trigger("reset");
                        toastr.error(response.error);
                    }
                },
            });
        }
    });

    let input2Fa = $('#2faCheckbox');
    input2Fa.on('change', function() {
        if ($(this).is(':checked')) {
            Swal.fire({
                icon: "info",
                title: "Be careful",
                text: "If the user does not scan the QR code or have a code already it can't access to his account",
                confirmButtonColor: PRIMARY_COLOR,
                confirmButtonText: 'Ok',
            });
        }
    });

    let vironeerTargetMenu = $('.vironeer-sort-menu'),
        idsArray = $('#ids');

    if (vironeerTargetMenu.length) {
        vironeerTargetMenu.sortable({
            handle: '.vironeer-navigation-handle',
            placeholder: 'vironeer-navigation-placeholder',
            axis: "y",
            update: function() {
                const vironeerSortData = vironeerTargetMenu.sortable('toArray', {
                    attribute: 'data-id'
                })
                idsArray.attr('value', vironeerSortData.join(','));
            }
        });
    }

    let commentView = $('.vironeer-view-comment'),
        viewCommentModal = $('#viewComment'),
        deleteCommentForm = $('#deleteCommentForm'),
        publishCommentForm = $('#publishCommentForm'),
        publishCommentBtn = $('.publish-comment-btn'),
        commentInput = $('#comment');
    commentView.on('click', function(e) {
        e.preventDefault();
        const id = $(this).data('id');
        $.ajax({
            url: BASE_URL + '/blog/comments/' + id + '/view',
            type: 'GET',
            dataType: 'JSON',
            success: function(response) {
                if ($.isEmptyObject(response.error)) {
                    commentInput.val(response.comment);
                    deleteCommentForm.attr('action', response.delete_link);
                    if (response.status === 1) {
                        publishCommentBtn.addClass('disabled');
                    } else {
                        publishCommentBtn.removeClass('disabled');
                        publishCommentForm.attr('action', response.publish_link);
                    }
                    viewCommentModal.modal('show');
                } else {
                    toastr.error(response.error);
                }
            },
        });
    });

    let menuLinkType = $('#menuLinkType'),
        menuLink = $('#menuLink');

    menuLinkType.on('change', function() {
        const type = $(this).val();
        menuLink.empty();
        if (type == 0) {
            menuLink.append('<div class="mb-2"> <label class="form-label">Link : <span class="red">*</span></label> <input type="text" name="link" class="form-control" placeholder="/" required> </div>');
        } else {
            if (LICENCE_TYPE == 2) {
                menuLink.append('<div class="mb-2"> <label class="form-label">Section :<span class="red">*</span></label> <select name="link" class="form-select"> <option value="#features">Features</option> <option value="#pricing">Pricing</option> <option value="#blog">Blog</option> <option value="#faq">Faq</option> <option value="#contact">Contact Us</option> </select> </div>');
            } else {
                menuLink.append('<div class="mb-2"> <label class="form-label">Section :<span class="red">*</span></label> <select name="link" class="form-select"> <option value="#features">Features</option> <option value="#blog">Blog</option> <option value="#faq">Faq</option> <option value="#contact">Contact Us</option> </select> </div>');
            }
        }
    });

    let slideshowFileSource = $('#slideshowFileSource'),
        slideshowFileBox = $('.slideshow-file-box');
    if (slideshowFileSource) {
        slideshowFileSource.on('change', function() {
            slideshowFileBox.empty();
            if (slideshowFileSource.val() == 1) {
                slideshowFileBox.append('<div class="slideshow-upload mt-3"> <label class="form-label">Upload file : <span class="red">*</span></label> <input type="file" name="file" class="form-control" required> </div> <div class="slideshow-types-alert alert alert-warning mt-3 mb-0"> <p class="mb-2">Supported Types</p> <ul class="mb-0"> <li class="mb-1"><strong>Image :</strong> JPG, JPEG, PNG / (2560x1600px) </li> <li><strong>Video :</strong> MP4, WEBM</li> </ul> </div>');
            } else if (slideshowFileSource.val() == 2) {
                slideshowFileBox.append('<div class="slideshow-url mt-3"> <label class="form-label">Enter URL :<span class="red">*</span></label> <input type="url" name="file" class="form-control" required> </div>');
            }
        });
    }

    let inputPrice = $('.input-price');
    if (inputPrice.length) {
        inputPrice.priceFormat({
            prefix: '',
            thousandsSeparator: '',
            clearOnEmpty: true
        });
    }

    let freePlanCheckbox = $('.free-plan-checkbox'),
        planPriceInput = $('.plan-price input'),
        planPriceSpan = $('.plan-price span'),
        requireLogin = $('.require-login');

    freePlanCheckbox.on('change', function() {
        if ($(this).prop('checked') == true) {
            planPriceInput.val('');
            planPriceInput.prop('disabled', true);
            planPriceSpan.addClass('disabled');
            requireLogin.removeClass('d-none');
        } else {
            planPriceInput.prop('disabled', false);
            requireLogin.addClass('d-none');
            planPriceSpan.removeClass('disabled');
        }
    });

    let unlimitedStorageSpaceCheckbox = $('.unlimited-storage-space-checkbox'),
        planStorageSpaceInput = $('.plan-storage-space input'),
        planStorageSpaceSpan = $('.plan-storage-space span');

    unlimitedStorageSpaceCheckbox.on('change', function() {
        if ($(this).prop('checked') == true) {
            planStorageSpaceInput.val('');
            planStorageSpaceInput.prop('disabled', true);
            planStorageSpaceSpan.addClass('disabled');
        } else {
            planStorageSpaceInput.prop('disabled', false);
            planStorageSpaceSpan.removeClass('disabled');
        }
    });

    let unlimitedFileSizeCheckbox = $('.unlimited-file-size-checkbox'),
        planFileSizeInput = $('.plan-file-size input'),
        planFileSizeSpan = $('.plan-file-size span');

    unlimitedFileSizeCheckbox.on('change', function() {
        if ($(this).prop('checked') == true) {
            planFileSizeInput.val('');
            planFileSizeInput.prop('disabled', true);
            planFileSizeSpan.addClass('disabled');
        } else {
            planFileSizeInput.prop('disabled', false);
            planFileSizeSpan.removeClass('disabled');
        }
    });

    let filesDurationCheckbox = $('.files-duration-checkbox'),
        planFilesDurationInput = $('.plan-files-duration input'),
        planFilesDurationSpan = $('.plan-files-duration span');

    filesDurationCheckbox.on('change', function() {
        if ($(this).prop('checked') == true) {
            planFilesDurationInput.val('');
            planFilesDurationInput.prop('disabled', true);
            planFilesDurationSpan.addClass('disabled');
        } else {
            planFilesDurationInput.prop('disabled', false);
            planFilesDurationSpan.removeClass('disabled');
        }
    });

    let customFeatures = $('#customFeatures'),
        addCustomFeature = $('#addCustomFeature'),
        customFeaturesCard = $('#customFeaturesCard');

    if (customFeatures.length) {
        addCustomFeature.on('click', function() {
            customFeatureI++;
            if (customFeatureI == 0) {
                customFeaturesCard.removeClass('d-none');
            }
            customFeatures.append('<li id="customFeature' + customFeatureI + '" class="list-group-item"> <div class="row g-2 align-items-center"> <div class="col"> <select name="custom_features[' + customFeatureI + '][status]" class="form-select"> <option value="0">Not Included</option> <option value="1">Included</option> </select> </div> <div class="col"> <input type="text" name="custom_features[' + customFeatureI + '][name]" placeholder="Feature name" class="form-control" required> </div> <div class="col-auto"> <button type="button" data-id="' + customFeatureI + '" class="removeFeature btn btn-danger"><i class="fa fa-trash-alt"></i></button> </div> </div> </li>');
        });

        $(document).on('click', '.removeFeature', function() {
            const id = $(this).data('id');
            $('#customFeature' + id).remove();
            customFeatureI--;
            if (customFeatureI == -1) {
                customFeaturesCard.addClass('d-none');
            }
        });
    }

    let clipboardBtn = document.querySelector("#copy-btn");
    if (clipboardBtn) {
        let clipboard = new ClipboardJS(clipboardBtn);
        clipboard.on('success', function(e) {
            toastr.success('Copied to clipboard');
        });
    }

    let clipboardCopyBtn = document.querySelectorAll(".copy-btn");
    if (clipboardCopyBtn) {
        clipboardCopyBtn.forEach((el) => {
            let clipboardCopy = new ClipboardJS(clipboardCopyBtn);
            clipboardCopy.on('success', function(e) {
                toastr.success('Copied to clipboard');
            });
        });
    }

    let subscriptionPlan = $('#subscriptionPlan'),
        expirydateInput = $('.expirydateInput');
    subscriptionPlan.on('change', function(e) {
        e.preventDefault();
        let lifetime = subscriptionPlan.find(':selected').data('lifetime');
        if (lifetime == 0) {
            expirydateInput.empty();
            expirydateInput.append('<div class="mb-1 mt-3"> <label class="form-label">Expiry at : <span class="red">*</span></label> <input type="datetime-local" name="expiry_at" class="form-control form-control-lg" required> </div>');
        } else if (lifetime == 1) {
            expirydateInput.empty();
        }
    });

    let couponCodeInput = $('#couponCodeInput'),
        generateCouponBtn = $('#generateCouponBtn');
    if (couponCodeInput.length) {
        couponCodeInput.val(generateCoupon(12));

        function generateCoupon(length) {
            var result = '';
            var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            var charactersLength = characters.length;
            for (var i = 0; i < length; i++) {
                result += characters.charAt(Math.floor(Math.random() *
                    charactersLength));
            }
            return result;
        }
        couponCodeInput.on('input', function(e) {
            this.value = this.value.replace(/[^a-zA-Z0-9 _]/g, '').toUpperCase();
        });
        generateCouponBtn.on('click', function(e) {
            e.preventDefault();
            couponCodeInput.val(generateCoupon(12));
        });
    }

    let multipleSelectSearchForm = $('.multiple-select-search-form'),
        multipleSelectDeleteForm = $('.multiple-select-delete-form'),
        multipleSelectDeleteIds = $('.multiple-select-delete-ids'),
        multipleSelectCheckAll = $('.multiple-select-check-all'),
        multipleSelectCheckbox = $('.multiple-select-checkbox');
    if (multipleSelectCheckAll.length) {
        var multipleSelectDeleteIdsArr = [];
        multipleSelectCheckAll.on('click', function() {
            if ($(this).is(':checked', true)) {
                multipleSelectCheckbox.prop('checked', true);
                multipleSelectPushDeleteIds();
                multipleSelectSearchForm.addClass('d-none');
                multipleSelectDeleteForm.removeClass('d-none');
            } else {
                multipleSelectRemoveDeleteIds();
                multipleSelectCheckbox.prop('checked', false);
                multipleSelectSearchForm.removeClass('d-none');
                multipleSelectDeleteForm.addClass('d-none');
            }
        });
        multipleSelectCheckbox.on('click', function() {
            multipleSelectPushDeleteIds()
            if ($('.multiple-select-checkbox:checked').length == multipleSelectCheckbox.length) {
                multipleSelectCheckAll.prop('checked', true);
            } else {
                multipleSelectCheckAll.prop('checked', false);
            }
            if ($(this).is(':checked', true)) {
                multipleSelectSearchForm.addClass('d-none');
                multipleSelectDeleteForm.removeClass('d-none');
            } else {
                if ($('.multiple-select-checkbox:checked').length == 0) {
                    multipleSelectSearchForm.removeClass('d-none');
                    multipleSelectDeleteForm.addClass('d-none');
                }
            }
        });
        let multipleSelectPushDeleteIds = () => {
            multipleSelectDeleteIdsArr = [];
            $(".multiple-select-checkbox:checked").each(function() {
                multipleSelectDeleteIdsArr.push($(this).attr('data-id'));
            });
            multipleSelectDeleteIds.val(multipleSelectDeleteIdsArr);
        }
        let multipleSelectRemoveDeleteIds = () => {
            multipleSelectDeleteIdsArr = [];
            multipleSelectDeleteIds.val(multipleSelectDeleteIdsArr);
        }
    }
})(jQuery);