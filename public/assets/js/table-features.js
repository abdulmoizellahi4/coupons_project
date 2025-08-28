function initDataTableWithFeatures(options) {
    const tableSelector = options.tableSelector || '#dataTable';
    const bulkDeleteBtnSelector = options.bulkDeleteBtnSelector || '#bulk-delete-btn';
    const selectAllSelector = options.selectAllSelector || '#selectAll';
    const rowHandleSelector = options.rowHandleSelector || 'td.reorder-handle';
    const reorderUrl = options.reorderUrl || null;
    const csrfToken = options.csrfToken || $('meta[name="csrf-token"]').attr('content');
    const bulkDeleteUrl = options.bulkDeleteUrl || null; // <-- added

    // init DataTable
    const table = $(tableSelector).DataTable({
        pageLength: 10,
        order: [[2, 'asc']],
        rowReorder: {
            selector: rowHandleSelector
        },
        columnDefs: [
            { orderable: false, targets: [0, 1, -1] }
        ]
    });

    // RowReorder
    if (reorderUrl) {
        table.on('row-reorder', function (e, diff) {
            if (!diff || diff.length === 0) return;

            const changes = diff.map(chg => {
                const $row = $(chg.node);
                return { id: $row.data('id'), sort_order: chg.newPosition + 1 };
            });

            diff.forEach(chg => {
                table.cell($(chg.node), 2).data(chg.newPosition + 1).draw(false);
            });

            $.post(reorderUrl, { _token: csrfToken, order: changes })
                .done(() => {
                    Swal.fire({ toast: true, position: 'top-end', icon: 'success', title: 'Order saved', showConfirmButton: false, timer: 1200 });
                })
                .fail(() => {
                    Swal.fire({ icon: 'error', title: 'Failed to save order' });
                });
        });
    }

    // Select all
    $(document).on('change', selectAllSelector, function () {
        $(tableSelector + ' .rowCheckbox').prop('checked', this.checked);
        toggleBulkDeleteBtn();
    });

    // Row checkbox
    $(document).on('change', tableSelector + ' .rowCheckbox', function () {
        const all = $(tableSelector + ' .rowCheckbox').length;
        const checked = $(tableSelector + ' .rowCheckbox:checked').length;
        $(selectAllSelector).prop('checked', all === checked);
        toggleBulkDeleteBtn();
    });

    function toggleBulkDeleteBtn() {
        $(bulkDeleteBtnSelector).prop('disabled', $(tableSelector + ' .rowCheckbox:checked').length === 0);
    }

    // Single delete
    $(document).on('click', tableSelector + ' .delete-btn', function (e) {
        e.preventDefault();
        const form = $(this).closest('form')[0];
        Swal.fire({
            title: "Are you sure?",
            text: "This record will be deleted permanently.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "Cancel",
            customClass: {
                confirmButton: "btn btn-primary me-3 waves-effect waves-light",
                cancelButton: "btn btn-outline-secondary waves-effect"
            },
            buttonsStyling: false
        }).then(result => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });

    // Bulk delete (no outer form)
    $(document).on('click', bulkDeleteBtnSelector, function (e) {
        e.preventDefault();
        const ids = $(tableSelector + ' .rowCheckbox:checked').map(function () {
            return $(this).val();
        }).get();

        if (ids.length === 0) return;

        Swal.fire({
            title: "Are you sure?",
            text: "Selected records will be deleted permanently.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, delete them!",
            cancelButtonText: "Cancel",
            customClass: {
                confirmButton: "btn btn-primary me-3 waves-effect waves-light",
                cancelButton: "btn btn-outline-secondary waves-effect"
            },
            buttonsStyling: false
        }).then(result => {
            if (result.isConfirmed && bulkDeleteUrl) {
                // Dynamically create and submit form
                let form = $('<form>', {
                    method: 'POST',
                    action: bulkDeleteUrl
                });

                form.append($('<input>', {
                    type: 'hidden',
                    name: '_token',
                    value: csrfToken
                }));
                form.append($('<input>', {
                    type: 'hidden',
                    name: '_method',
                    value: 'DELETE'
                }));

                ids.forEach(id => {
                    form.append($('<input>', {
                        type: 'hidden',
                        name: 'ids[]',
                        value: id
                    }));
                });

                $(document.body).append(form);
                form.submit();
            }
        });
    });
}
