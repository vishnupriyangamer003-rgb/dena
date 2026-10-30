$(function () {
    // Sidebar toggle (mobile)
    $('#sidebarToggleBtn').on('click', function () {
        $('#adminSidebar, #sidebarOverlay').toggleClass('show');
    });
    $('#sidebarOverlay').on('click', function () {
        $('#adminSidebar, #sidebarOverlay').removeClass('show');
    });

    // WhatsApp number field: digits only, no spaces (country code prefix is fixed in markup)
    $(document).on('input', '#whatsappSuffixInput', function () {
        var digitsOnly = $(this).val().replace(/\D/g, '');
        $(this).val(digitsOnly);
    });

    // Auto-apply filters on change (select) / input (search box, debounced)
    $(document).on('change', '.filter-select', function () {
        $(this).closest('form').trigger('submit');
    });
    var filterSearchTimer;
    $(document).on('input', '.filter-search', function () {
        var $form = $(this).closest('form');
        clearTimeout(filterSearchTimer);
        filterSearchTimer = setTimeout(function () {
            $form.trigger('submit');
        }, 400);
    });

    // Delete via AJAX
    $(document).on('click', '.btn-delete-ajax', function (e) {
        e.preventDefault();
        var $btn = $(this);
        if (!confirm($btn.data('confirm') || 'Delete this item? This cannot be undone.')) {
            return;
        }
        var $row = $btn.closest('tr');
        $.post($btn.data('url'), { action: 'delete', id: $btn.data('id'), csrf_token: window.csrfToken }, function (res) {
            if (res.success) {
                $row.fadeOut(200, function () { $(this).remove(); });
                showAlert('success', res.message || 'Deleted successfully.');
            } else {
                showAlert('danger', res.message || 'Delete failed.');
            }
        }, 'json').fail(function () {
            showAlert('danger', 'Something went wrong.');
        });
    });

    // Status toggle via AJAX
    $(document).on('change', '.status-toggle', function () {
        var $chk = $(this);
        $.post($chk.data('url'), { action: 'toggle_status', id: $chk.data('id'), csrf_token: window.csrfToken }, function (res) {
            if (res.success) {
                showAlert('success', res.message || 'Status updated.');
            } else {
                showAlert('danger', res.message || 'Update failed.');
                $chk.prop('checked', !$chk.prop('checked'));
            }
        }, 'json').fail(function () {
            showAlert('danger', 'Something went wrong.');
            $chk.prop('checked', !$chk.prop('checked'));
        });
    });

    // Enquiry status dropdown (list page)
    $(document).on('change', '.enquiry-status-select', function () {
        var $sel = $(this);
        var $badge = $sel.closest('tr').find('.status-badge-cell');
        $.post('../ajax/enquiries.php', { action: 'update_status', id: $sel.data('id'), status: $sel.val(), csrf_token: window.csrfToken }, function (res) {
            if (res.success) {
                showAlert('success', res.message || 'Status updated.');
                if ($badge.length) {
                    $badge.attr('data-status', $sel.val());
                }
            } else {
                showAlert('danger', res.message || 'Update failed.');
            }
        }, 'json').fail(function () {
            showAlert('danger', 'Something went wrong.');
        });
    });

    // Slug auto-fill from title (only until user manually edits the slug field)
    var slugManuallyEdited = $('#slugInput').val() ? true : false;
    $('#slugInput').on('input', function () { slugManuallyEdited = true; });
    $('#titleInput').on('input', function () {
        if (!slugManuallyEdited && $('#slugInput').length) {
            $('#slugInput').val(slugify($(this).val()));
        }
    });

    // Repeatable rows (specs / applications / features / points)
    $(document).on('click', '.add-row-btn', function () {
        var $group = $($(this).data('target'));
        var $tpl = $group.find('.repeat-row').first().clone();
        $tpl.find('input, textarea').val('');
        $group.append($tpl);
    });
    $(document).on('click', '.remove-row-btn', function () {
        var $group = $(this).closest('.repeat-group');
        if ($group.find('.repeat-row').length > 1) {
            $(this).closest('.repeat-row').remove();
        } else {
            $(this).closest('.repeat-row').find('input, textarea').val('');
        }
    });

    // Icon live preview (Programming module)
    $(document).on('input', '#iconInput', function () {
        var val = $(this).val().trim();
        $('#iconPreview').attr('class', 'fa-light ' + (val || 'fa-question'));
    });

    // Generic AJAX form submit (Add/Edit forms with file upload support)
    $(document).on('submit', '.ajax-form', function (e) {
        e.preventDefault();
        var $form = $(this);

        // Serialize repeat-groups into hidden JSON fields before building FormData
        $form.find('.repeat-group').each(function () {
            var $group = $(this);
            var mode = $group.data('mode'); // 'kv' or 'list'
            var result = mode === 'kv' ? {} : [];
            $group.find('.repeat-row').each(function () {
                if (mode === 'kv') {
                    var k = $(this).find('.repeat-key').val();
                    var v = $(this).find('.repeat-val').val();
                    if (k) { result[k] = v; }
                } else {
                    var v2 = $(this).find('.repeat-val').val();
                    if (v2) { result.push(v2); }
                }
            });
            $form.find('input[name="' + $group.data('field') + '"]').val(JSON.stringify(result));
        });

        var fd = new FormData(this);
        var $btn = $form.find('button[type="submit"]');
        var originalHtml = $btn.html();
        $btn.prop('disabled', true).html('<i class="fa-light fa-spinner fa-spin"></i> Saving...');

        $.ajax({
            url: $form.attr('action'),
            type: 'POST',
            data: fd,
            processData: false,
            contentType: false,
            dataType: 'json'
        }).done(function (res) {
            if (res.success) {
                window.location.href = $form.data('redirect') || 'index.php';
            } else {
                showAlert('danger', res.message || 'Please correct the errors and try again.');
                $btn.prop('disabled', false).html(originalHtml);
            }
        }).fail(function () {
            showAlert('danger', 'Something went wrong. Please try again.');
            $btn.prop('disabled', false).html(originalHtml);
        });
    });

    // Settings forms (no file upload) - plain AJAX submit
    $(document).on('submit', '.ajax-form-simple', function (e) {
        e.preventDefault();
        var $form = $(this);
        var $btn = $form.find('button[type="submit"]');
        var originalHtml = $btn.html();
        $btn.prop('disabled', true).html('<i class="fa-light fa-spinner fa-spin"></i> Saving...');

        $.post($form.attr('action'), $form.serialize(), function (res) {
            if (res.success) {
                showAlert('success', res.message || 'Saved successfully.');
                if ($form.data('reset-on-success')) { $form[0].reset(); }
            } else {
                showAlert('danger', res.message || 'Please correct the errors and try again.');
            }
        }, 'json').fail(function () {
            showAlert('danger', 'Something went wrong. Please try again.');
        }).always(function () {
            $btn.prop('disabled', false).html(originalHtml);
        });
    });
});

function slugify(text) {
    return text.toString().toLowerCase().trim()
        .replace(/[^a-z0-9]+/g, '-')
        .replace(/(^-|-$)+/g, '');
}

function showAlert(type, message) {
    var $container = $('#ajaxAlertContainer');
    if ($container.length === 0) {
        $container = $('<div id="ajaxAlertContainer" style="position:fixed; top:75px; right:20px; z-index:2000; max-width:340px;"></div>');
        $('body').append($container);
    }
    var $alert = $('<div class="alert alert-' + type + ' alert-dismissible fade show shadow-sm" role="alert">' + message + '<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>');
    $container.append($alert);
    setTimeout(function () { $alert.alert('close'); }, 4000);
}
